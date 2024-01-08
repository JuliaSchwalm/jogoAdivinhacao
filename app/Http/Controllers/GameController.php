<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $valor_correto = $this->calcularValorCorreto($nome);

        // Lógica para verificar o chute do jogador e fornecer as dicas
        $chute = $request->input('chute');
        $dica = $this->calcularDica($chute, $valor_correto);

        return view('pagina2', compact('nome', 'dica'));
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

}
