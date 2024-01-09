<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 3</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #3498db; /* Cor inicial (azul) */
            transition: background-color 0.5s ease;
        }
    </style>
</head>
<body>
    <h1>Nível Difícil</h1>
    <p>Nome: {{ $nome }}</p>
    <p>Idade: {{ $idade }}</p>
    <p>Tente adivinhar o número correto!</p>

    <script>
        var numeroCorreto = {{ $numeroCorreto }};
    </script>

    <form>
        <label for="tentativa">Sua Tentativa:</label>
        <input type="number" id="tentativa" required>
        <button type="button" onclick="verificarTentativa()">Verificar</button>
    </form>

    <script>
    function verificarTentativa() {
        var tentativa = document.getElementById('tentativa').value;
        var diferenca = Math.abs(tentativa - numeroCorreto);
        var cor;

        // Definir a cor com base na diferença
        if (diferenca > 20) {
            cor = '#3498db'; // Muito frio (azul)
        } else if (diferenca <= 20 && diferenca > 10) {
            cor = '#5dade2'; // Friozinho (tom mais claro de azul)
        } else if (diferenca <= 10 && diferenca > 5) {
            cor = '#e1b12c'; // Esquentando (tom de laranja)
        } else {
            cor = '#e74c3c'; // Quente (vermelho)
        }

        // Atualizar a cor de fundo
        document.body.style.backgroundColor = cor;

        // Adicionar lógica adicional conforme necessário
    }
</script>

</body>
</html>
