<!-- Elenco delle vendite -->
<?php

include_once("../connessione.php");

$query = "SELECT idVendita, CONCAT(nome, CONCAT(' ', cognome)) AS cliente, dataVendita, desMod, prezzo, agente
          FROM vendite JOIN clienti ON idCliente = cliente JOIN modelli ON idMod = modello";
$vendite = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);

mysqli_close($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendite</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏪</text></svg>">
</head>
<body>
    <h1>Vendite:</h1>
    <table>
        <tr>
            <th>ID Vendita</th>
            <th>Cliente</th>
            <th>Data Vendita</th>
            <th>Modello</th>
            <th>Prezzo</th>
            <th>Agente</th>
        </tr>
        <?php foreach ($vendite as $vendita): ?>
        <tr>
            <td><?php echo $vendita['idVendita']; ?></td>
            <td><?php echo $vendita['cliente']; ?></td>
            <td><?php echo $vendita['dataVendita']; ?></td>
            <td><?php echo $vendita['desMod']; ?></td>
            <td><?php echo $vendita['prezzo']; ?></td>
            <td><?php echo $vendita['agente']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>