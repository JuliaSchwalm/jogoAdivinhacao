<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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
            // Salva no banco apenas na página de vitória (Página 4)
            Jogador::create([
                'nome' => $nome,
                'idade' => $idade,
                'tentativas' => 0,
                'dificuldade' => $dificuldade, // Inicializa com 0 tentativas
            ]);

            return view('pagina2', compact('nome', 'idade'));
        } elseif ($dificuldade == 'dificil') {
            return view('pagina3', compact('nome', 'idade'));
        } else {
            echo "<script>alert ('Nível de dificuldade não reconhecido')</script>";
        }
    }

    public function formNumero(Request $request)
    {
        $nome = $request->input('nome');
        $idade = $request->input('idade');
        $chute = $request->input('chute');
        $tentativas = session()->get('tentativas', 0);
        // Lógica para verificar o chute do jogador e fornecer as dicas
        $dica = $this->calcularDica($chute, $this->calcularValorCorreto($nome));
        
            // Incrementa o número de tentativas
    $tentativas++;

    // Armazena o novo valor da contagem de tentativas na sessão
    session(['tentativas' => $tentativas]);

        Jogador::where('nome', $nome)
        ->where('idade',$idade)
        ->update(['tentativas' => $tentativas]);

        // Se o jogador acertar, redireciona para a Página 4
        if ($chute == $this->calcularValorCorreto($nome)) {
            return redirect()->route('pagina4', compact('nome', 'idade', 'tentativas'));
        }

        // Se o jogador não acertar, volta para a Página 2 com as informações atualizadas
        return view('pagina2', compact('nome', 'idade', 'dica', 'tentativas'));
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

        // Inicializar a contagem de tentativas na sessão
        Session::put('tentativas', 0);

        return view('pagina3', compact('nome', 'idade', 'numeroCorreto'));
    }

    public function verificarTentativa(Request $request)
    {
        $tentativa = $request->input('tentativa');
        $numeroCorreto = $request->input('numeroCorreto');
        $nome = $request->input('nome');
        $idade = $request->input('idade');

        // Incrementar a contagem de tentativas na sessão
        $tentativas = Session::get('tentativas', 0) + 1;
        Session::put('tentativas', $tentativas);

        // Lógica para verificar a tentativa e fornecer as dicas (mesmo código da Página 3 original)

        // Verificar se o jogador acertou ou atingiu 10 tentativas
        if ($tentativa == $numeroCorreto || $tentativas >= 10) {
            // Salvar informações no banco de dados
            Jogador::create([
                'nome' => $nome,
                'idade' => $idade,
                'tentativas' => $tentativas,
            ]);

            // Obter lista de jogadores ordenada por tentativas
            $usuarios = Jogador::orderBy('tentativas')->get();

            return view('pagina4', compact('usuarios', 'nome', 'idade', 'tentativas'));
        }

        // Adicione a lógica de exibir a Página 3 novamente ou redirecionar conforme necessário
        return redirect()->route('pagina3', compact('nome', 'idade'));
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
        // Obtenha as informações do jogador atual
        $usuarioAtual = session()->get('usuarioAtual', []);

        // Obter lista de jogadores ordenada por tentativas
        $usuarios = Jogador::orderBy('tentativas')->get();

        // Armazenar a lista de usuários na sessão
        session()->put('usuarios', $usuarios);

            // Limpar a sessão de tentativas
    session()->forget('tentativas');

        return view('pagina4', compact('usuarioAtual'));
    }







}
