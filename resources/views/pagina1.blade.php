<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 1</title>
    <style>
        body {
            background: linear-gradient(to bottom, #e6e6fa, #800080);
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        h1 {
            color: #fff;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            display: block;
            width: 100%; /* 100% da largura do container */
            padding: 10px;
            margin: 10px auto;
            text-align: left;
            box-sizing: border-box; /* Garante que padding não afete a largura total */
        }

        input[type="radio"] {
            display: inline-block; /* Alterado para 'inline-block' para colocar lado a lado */
            width: auto; /* Ajusta a largura automaticamente */
            margin-right: 10px; /* Espaço entre os botões de rádio */
        }

        button {
            background-color: #800080;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #6a006a;
        }
    </style>
</head>

<body>
    <h1>Formulário</h1>
    <form action="{{ route('formulario') }}" method="post">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" required>
        <label for="facil"><input type="radio" name="dificuldade" id="facil" value="facil" required> Fácil</label>
        <label for="dificil"><input type="radio" name="dificuldade" id="dificil" value="dificil" required> Difícil</label>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>
