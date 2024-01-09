<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 2</title>
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
