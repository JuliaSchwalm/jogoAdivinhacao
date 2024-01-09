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
        var tentativas = 0; // Inicializa o contador de tentativas

        function verificarTentativa() {
            // Verifica se o limite de 10 tentativas foi atingido
            if (tentativas >= 10) {
                alert('Você atingiu o limite de 10 tentativas. O jogo será reiniciado.');
                window.location.href = '/pagina1';
                return;
            }
            if (tentativa == numeroCorreto) {
            // Adiciona o número de tentativas como parâmetro na URL de redirecionamento
            window.location.href = '/pagina4?tentativas=' + tentativas;
            return;
        }
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

            // Incrementar a contagem de tentativas
            tentativas++;

            // Exibir a contagem de tentativas na página
            document.getElementById('contagemTentativas').innerText = 'Tentativas: ' + tentativas;

            // Adicionar lógica adicional conforme necessário
        }
    </script>

   <!-- ... restante do código ... -->
<script>
    var numeroCorreto = {{ $numeroCorreto }};
    var nome = '{{ $nome }}';
    var idade = {{ $idade }};
</script>

<form method="post" action="{{ route('verificarTentativa') }}">
    @csrf
    <input type="hidden" name="numeroCorreto" value="{{ $numeroCorreto }}">
    <input type="hidden" name="nome" value="{{ $nome }}">
    <input type="hidden" name="idade" value="{{ $idade }}">
    <label for="tentativa">Sua Tentativa:</label>
    <input type="number" name="tentativa" id="tentativa" required>
    <button type="submit">Verificar</button>
</form>

<!-- ... restante do código ... -->

    <p id="contagemTentativas">Tentativas: 0</p>

</body>
</html>
