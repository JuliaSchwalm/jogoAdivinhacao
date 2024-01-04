<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 1</title>
</head>

<body>
    <h1>Formulário</h1>
    <form action="{{ route('processarFormulario') }}" method="post">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <br>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" required>
        <br>
        <label for="dificuldade">Nível de Dificuldade:</label>
        <select name="dificuldade" required>
            <option value="facil">Fácil</option>
            <option value="dificil">Difícil</option>
        </select>
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>