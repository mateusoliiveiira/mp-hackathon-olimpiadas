<?php
// Check if required parameters are set
if (isset($_GET['id'], $_GET['name'], $_GET['gold_medals'], $_GET['silver_medals'], $_GET['bronze_medals'], $_GET['total_medals'])) {
    $id = htmlspecialchars($_GET['id']);
    $name = htmlspecialchars($_GET['name']);
    $gold_medals = htmlspecialchars($_GET['gold_medals']);
    $silver_medals = htmlspecialchars($_GET['silver_medals']);
    $bronze_medals = htmlspecialchars($_GET['bronze_medals']);
    $total_medals = htmlspecialchars($_GET['total_medals']);
} else {
    echo "Informação incompleta do país.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do País - <?php echo $name; ?></title>
    <link rel="stylesheet" href="../css/details.css">
</head>
<body>


    <div class="container">
        <h1>Medalhas de <?php echo $name; ?></h1>
        <ul>
            <li><img src="../img/medalhadeouro.jpg"width="10px" margin-top="10px"> <?php echo $gold_medals; ?></li>
            <li><img src="../img/medalhadeprata.jpg"width="10px" margin-top="10px">Prata: <?php echo $silver_medals; ?></li>
            <li><img src="../img/medalhadebronze.jpg"width="10px" margin-top="10px">Bronze: <?php echo $bronze_medals; ?></li>
            <li>Total: <?php echo $total_medals; ?></li>
        </ul>
        <a href="listapaises.php">Voltar à Lista de Países</a>
    </div>
</body>
</html>
