<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


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
        // Salva no banco apenas na página de vitória (Página 4)
        Jogador::create([
            'nome' => $nome,
            'idade' => $idade,
            'tentativas' => 0,
            'dificuldade' => $dificuldade, // Inicializa com 0 tentativas
        ]);

        if ($dificuldade == 'facil') {
            return view('pagina2', compact('nome', 'idade'));
        } elseif ($dificuldade == 'dificil') {
            // Gerar o número correto baseado na multiplicação dos números do nome
            $numeroCorreto = $this->calcularNumeroCorreto($nome, $idade);
            return view('pagina3', compact('nome', 'idade', 'numeroCorreto'));

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
            ->where('idade', $idade)
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

    public function pagina3()
    {
        return view('pagina3');
    }

    public function verificarTenta(Request $request)
    {
        $tentativa = $request->input('tentativa');
        $numeroCorreto = $request->input('numeroCorreto');
        $nome = $request->input('nome');
        $idade = $request->input('idade');
        $tempoDecorrido = $request->input('tempoDecorrido'); // Adicione esta linha para obter o tempo decorrido da Página 3


        Log::debug('Tentativa: ' . $tentativa);
        Log::debug('Número Correto: ' . $numeroCorreto);
        Log::debug('Nome: ' . $nome);
        Log::debug('Idade: ' . $idade);
        Log::debug('Tempo Decorrido: ' . $tempoDecorrido);


        if (trim($tentativa) === trim($numeroCorreto)) {
            // Salvar informações no banco de dados
            Jogador::where('nome', $nome)
                ->where('idade', $idade)
                ->update(['tempo_decorrido' => $tempoDecorrido, 'acertou' => true]);
        
            return response()->json(['acertou' => true]);
        } else {
            return response()->json(['acertou' => false]);
        }
        
    }


    private function calcularNumeroCorreto($nome, $idade)
    {
        $somatorio_letras = array_sum(array_map('ord', str_split(strtolower($nome))));

        // Calcula o número correto multiplicando o somatório das letras pela idade
        $numeroCorreto = $somatorio_letras * $idade;

        // Se o número for maior que 100, subtrai pela idade até ser menor que 100
        while ($numeroCorreto > 100) {
            $numeroCorreto = $numeroCorreto - $idade;
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
