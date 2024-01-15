<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 2</title>
    <style>
        body {
            background: linear-gradient(to bottom, #ffc0cb, #ff69b4);
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

        button {
            background-color: #ff69b4;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #ff1493;
        }

        p {
            color: #fff;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>De um chute</h1>
    <form action="{{ route('formNumero') }}" method="post">
        @csrf
        <input type="hidden" name="nome" value="{{ $nome }}">
        <input type="hidden" name="idade" value="{{ $idade }}">
        <label for="chute">Chute:</label>
        <input type="number" name="chute" required>
        <br>
        <button type="submit">Enviar</button>
    </form>
    @if(isset($dica))
    <p>Dica: {{ $dica }}</p>
    @endif
</body>

</html>
