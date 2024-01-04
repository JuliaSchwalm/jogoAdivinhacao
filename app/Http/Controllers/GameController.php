<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(){
        return view ('pagina1');
    }
    public function form(Request $request){
        $nome = $request->input('nome');
        $idade = $request->input('idade');
        $dificuldade = $request->input('dificuldade');

        if ($dificuldade == 'facil') {
            return redirect()->route('pagina2', compact('nome', 'idade'));
        } elseif ($dificuldade == 'dificil') {
            return redirect()->route('pagina3', compact('nome', 'idade'));
        } else{
            echo "<script>alert ('Nível de dificuldade não reconhecido')</script>";
        }
    }

}
