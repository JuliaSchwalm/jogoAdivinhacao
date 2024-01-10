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
            flex-direction: column; /* Adicionado para melhorar o alinhamento */
            height: 100vh;
            background-color: #3498db;
            /* Cor inicial (azul) */
            transition: background-color 0.5s ease;
        }
    </style>
</head>

<body>
    <h1>Nível Difícil</h1>
    <p>Nome: {{ $nome }}</p>
    <p>Idade: {{ $idade }}</p>
    <p>Tente adivinhar o número correto!</p>
    <form id="formTentativa">
        @csrf
        <input type="hidden" name="nome" value="{{ $nome }}">
        <input type="hidden" name="idade" value="{{ $idade }}">
        <label for="tentativa">Sua Tentativa:</label>
        <input type="number" name="tentativa" id="tentativa" required>
        <button type="button" onclick="verificarTentativa()">Verificar</button>
    </form>

    <!-- Adicionado elemento para exibir a contagem de tempo -->
    <p id="contagemTempo">Tempo decorrido: 0 segundos</p>

    <script>
  console.log("Numero Correto:", {{ $numeroCorreto }});
var numeroCorreto = {{ $numeroCorreto }};
var inicioJogo = Date.now(); // Armazena o tempo de início do jogo

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

    // Atualizar a cor de fundo imediatamente
    document.body.style.backgroundColor = cor;

    // Exibir o tempo decorrido na página
    var tempoDecorrido = Math.ceil((Date.now() - inicioJogo) / 1000);
    document.getElementById('contagemTempo').innerText = 'Tempo decorrido: ' + tempoDecorrido + ' segundos';

    // Enviar a tentativa para o servidor de forma assíncrona
    enviarTentativaAssincrona(tentativa, tempoDecorrido);
}


function enviarTentativaAssincrona(tentativa, tempoDecorrido) {
    // Utilize fetch para enviar a tentativa ao servidor
    fetch('{{ route('verificarTenta') }}', {  // Certifique-se de que esta rota esteja correta
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            nome: '{{ $nome }}',
            idade: '{{ $idade }}',
            tentativa: tentativa,
            numeroCorreto: numeroCorreto,
            tempoDecorrido: tempoDecorrido
        })
    })
    .then(response => response.json())
    .then(data => {
        // A resposta do servidor pode conter informações adicionais que você pode processar se necessário
        console.log('Resposta do servidor:', data);

        // Verificar se o jogador acertou e redirecionar para a Página 4
        if (data.acertou) {
            window.location.href = '/pagina4';
        }
    })
    .catch(error => console.error('Erro ao enviar tentativa:', error));
}


    </script>
</body>

</html>
