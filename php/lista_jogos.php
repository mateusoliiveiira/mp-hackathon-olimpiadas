<?php
$ch = curl_init();

// Configurar URL
curl_setopt($ch, CURLOPT_URL, "https://apis.codante.io/olympic-games/events");

// Retornar a transferência como uma string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contém a string de saída
$output = curl_exec($ch);

// Decodificar a resposta JSON
$response = json_decode($output, true);

// Fechar o recurso curl para liberar recursos do sistema
curl_close($ch);

// Acessar a chave 'data'
$events = isset($response['data']) ? $response['data'] : [];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/listajogos.css">
    <title>Eventos Olímpicos</title>
    <style>
        /* Estilos básicos para a tabela */
       
    </style>
</head>
<body>
<header><h1 class="marque" id="marquee">Site Oficial Das @OlimpiadasParis2024</h1></header>
<h1>Eventos Olímpicos</h1>
<a class="volt" href="Index.php">Voltar</a>

<table>
    <thead>
        <tr>
            <th>Evento Detalhado</th>
            <th>Disciplina</th>
            <th>Data</th>
            <th>Local</th>
            <th>Status</th>
            <th>Competidores</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo htmlspecialchars($event['detailed_event_name']); ?></td>
                <td><?php echo htmlspecialchars($event['discipline_name']); ?></td>
                <td><?php echo htmlspecialchars($event['day']); ?></td>
                <td><?php echo htmlspecialchars($event['venue_name']); ?></td>
                <td><?php echo htmlspecialchars($event['status']); ?></td>
                <td>
                    <div class="competitors">
                        <?php foreach ($event['competitors'] as $competitor): ?>
                            <div class="competitor">
                                <img src="<?php echo htmlspecialchars($competitor['country_flag_url']); ?>" alt="<?php echo htmlspecialchars($competitor['country_id']); ?> flag" class="country-flag">
                                <span><?php echo htmlspecialchars($competitor['competitor_name']); ?> - <?php echo htmlspecialchars($competitor['result_winnerLoserTie'] === 'W' ? 'Vencedor' : 'Perdedor'); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
