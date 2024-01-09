<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Jogador;

class GameController extends Controller
{
    public function index()
    {
        return view('pagina1');
    }
    public function form(Request $request)
    {
        $nome = $request->input('nome');
        $idade = $request->input('idade');
        $dificuldade = $request->input('dificuldade');

        if ($dificuldade == 'facil') {
            return redirect()->route('pagina2', compact('nome'));
        } elseif ($dificuldade == 'dificil') {
            return redirect()->route('pagina3', compact('nome', 'idade'));
        } else {
            echo "<script>alert ('Nível de dificuldade não reconhecido')</script>";
        }
    }


    public function formNumero(Request $request)
    {
        $nome = $request->input('nome');
        $tentativas = Session::get('tentativas', 0);
        $valor_correto = $this->calcularValorCorreto($nome);

        // Incrementa o número de tentativas
        $tentativas++;

        // Salva o novo valor da contagem de tentativas na sessão
        Session::put('tentativas', $tentativas);

        // Lógica para verificar o chute do jogador e fornecer as dicas
        $chute = $request->input('chute');
        $dica = $this->calcularDica($chute, $valor_correto);


        return view('pagina2', compact('nome', 'dica', 'tentativas'));
    }

    private function calcularValorCorreto($nome)
    {
        $somatorio_letras = array_sum(array_map('ord', str_split(strtolower($nome))));
        while ($somatorio_letras > 50) {
            $somatorio_letras -= 50;
        }
        return $somatorio_letras;
    }

    private function calcularDica($chute, $valor_correto)
    {
        $diferenca = abs($chute - $valor_correto);

        if ($diferenca > 20) {
            return "Muito frio";
        } elseif ($diferenca <= 20 && $diferenca > 10) {
            return "Friozinho";
        } elseif ($diferenca <= 10 && $diferenca > 5) {
            return "Esquentando!";
        } else {
            return "Quente";
        }
    }

    public function pagina3($nome, $idade)
    {
        // Gerar o número correto baseado na multiplicação dos números do nome
        $numeroCorreto = $this->calcularNumeroCorreto($nome, $idade);

        return view('pagina3', compact('nome', 'idade', 'numeroCorreto'));
    }

    private function calcularNumeroCorreto($nome, $idade)
    {
        // Calcula o número correto multiplicando os caracteres do nome
        $numeroCorreto = 1;
        for ($i = 0; $i < strlen($nome); $i++) {
            $numeroCorreto *= ord($nome[$i]);
        }
        // Se o número for maior que 100, subtrai pela idade até ser menor que 100
        while ($numeroCorreto > 100) {
            $numeroCorreto -= $idade;
        }
        return $numeroCorreto;
    }


    public function pagina4(Request $request)
    {
        // Obtenha o número de tentativas a partir dos parâmetros da URL
        $tentativas = $request->query('tentativas', 0);
        $usuarioAtual = [
            'nome' => Session::get('nome'),
            'idade' => Session::get('idade'),
            'tentativas' => Session::get('tentativas', 0),
        ];

        // Salvar informações no banco de dados
        Jogador::create([
            'nome' => $usuarioAtual['nome'],
            'idade' => $usuarioAtual['idade'],
            'tentativas' => $usuarioAtual['tentativas'],
        ]);

        // Obter lista de jogadores ordenada por tentativas
        $usuarios = Jogador::orderBy('tentativas')->get();

        return view('pagina4', compact('usuarios', 'usuarioAtual'));
    }

}
