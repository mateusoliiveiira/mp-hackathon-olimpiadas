<?php
$ch = curl_init();

// Set URL
curl_setopt($ch, CURLOPT_URL, "https://apis.codante.io/olympic-games/countries");

// Return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// Decode the JSON response
$response = json_decode($output, true);

// Close curl resource to free up system resources
curl_close($ch);

// Access the 'data' key
$countries = isset($response['data']) ? $response['data'] : [];

// Inicializa a variável $searchQuery como uma string vazia
$searchQuery = '';

// Check if there is a search query
if (isset($_GET['search'])) {
    $searchQuery = htmlspecialchars($_GET['search']);
    // Filter countries based on the search query
    $countries = array_filter($countries, function($country) use ($searchQuery) {
        return stripos($country['name'], $searchQuery) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Países Olímpicos</title>
    <link rel="stylesheet" href="../css/listapaises.css">
</head>
<body>
<a class="volt" href="index.php">VOLTAR</a>
<div class="container">
    <h1>Lista de Países Olímpicos</h1>
    <div id="div" class='content'> 
        <form onsubmit="searchCountries(event)">
            <input type="text" id="search-input" name="search" placeholder="Pesquisar país" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Pesquisar</button>
        </form>

        <div class="scrollable-list"> 
            <table>
                <thead>
                    <tr>
                        <th>Bandeira</th>
                        <th>Nome do País</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($countries)): ?>
                        <tr>
                            <td colspan="3">Nenhum país encontrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($countries as $country): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($country['flag_url'])): ?>
                                        <img src="<?php echo htmlspecialchars($country['flag_url']); ?>" alt="Bandeira de <?php echo htmlspecialchars($country['name']); ?>" width="50">
                                    <?php else: ?>
                                        <img src="../img/placeholder.png" alt="Bandeira não disponível" width="50"> <!-- Imagem de placeholder -->
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($country['name']); ?></td>
                                <td>
                                    <form action="country_details.php" method="get" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($country['id']); ?>">
                                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($country['name']); ?>">
                                        <input type="hidden" name="gold_medals" value="<?php echo htmlspecialchars($country['gold_medals']); ?>">
                                        <input type="hidden" name="silver_medals" value="<?php echo htmlspecialchars($country['silver_medals']); ?>">
                                        <input type="hidden" name="bronze_medals" value="<?php echo htmlspecialchars($country['bronze_medals']); ?>">
                                        <input type="hidden" name="total_medals" value="<?php echo htmlspecialchars($country['total_medals']); ?>">
                                        <button type="submit">Ver Medalhas</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
