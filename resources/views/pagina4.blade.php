<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: linear-gradient(to bottom,  #ff9999, #ffffff); /* Gradiente linear em tons de vermelho */
            color: #fff;
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

        table {
            border-collapse: collapse;
            width: 50%;
            margin: auto;
            margin-top: 20px;
            background-color: #f5deb3;
            border-radius: 10px; /* Bordas levemente arredondadas */
            overflow: hidden; /* Para sobrepor ao fundo */
           
        }

        th,
        td {
            border: 1px solid white;
            text-align: left;
            padding: 8px;
            color: black;
        }

        th {
            background-color: #e74c3c; /* Fundo vermelho para a parte de legenda (cabeçalho) */
            color: white;
        }

        .usuario-atual {
            background-color: #f39c12;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Página 4</h1>

    <h2>Lista de Jogadores</h2>
    <table>
        <tr>
            <th>Posição</th>
            <th>Usuário</th>
            <th>Idade</th>
            <th>Tentativas</th>
        </tr>
        @foreach (Session::get('usuarios', []) as $index => $usuario)
        @if ($usuario['dificuldade'] === session('dificuldade'))
        <tr class="{{ $usuario['nome'] === $usuarioAtual['nome'] ? 'usuario-atual' : '' }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $usuario['nome'] }}</td>
            <td>{{ $usuario['idade'] }}</td>
            <td>{{ $usuario['tentativas'] }}</td>
        </tr>
        @endif
        @endforeach
    </table>
</body>

</html>
