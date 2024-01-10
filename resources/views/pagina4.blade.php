<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 4</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: auto;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        .usuario-atual {
            background-color: #f39c12;
            font-weight: bold;
            /* Adiciona negrito para o usuário atual */
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
