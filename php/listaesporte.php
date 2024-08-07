<?php
$ch = curl_init();

// Configurar URL
curl_setopt($ch, CURLOPT_URL, "https://apis.codante.io/olympic-games/disciplines");

// Retornar a transferência como uma string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contém a string de saída
$output = curl_exec($ch);

// Decodificar a resposta JSON
$response = json_decode($output, true);

// Fechar o recurso curl para liberar recursos do sistema
curl_close($ch);

// Verifica se a resposta contém dados
if (isset($response['data']) && !empty($response['data'])) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/listaesporte.css"> <!-- Link para o CSS -->
        <title>Esportes Olímpicos</title>
    </head>
    <body>
    <header><h1 class="marque" id="marquee">Site Oficial Das @OlimpiadasParis2024</h1></header>
    <a class="volt" href="index.php">Voltar</a>
        <div class="container">
            <?php foreach ($response['data'] as $sport): ?>
                <div class="card">
                    <img src="<?php echo $sport['pictogram_url']; ?>" alt="<?php echo $sport['name']; ?>">
                    <h3><?php echo $sport['name']; ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Nenhum dado encontrado.";
}
?>
