<?php

$agente = $_POST["agente"] ?? "";

include_once("connessione.php");

$query = "SELECT agente, CONCAT(nome, CONCAT(' ', cognome)) AS cliente, desMod, dataVendita, prezzo
          FROM vendite JOIN clienti ON cliente = idCliente JOIN modelli ON modello = idMod
          WHERE agente = '$agente'";
$vendite = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);

mysqli_close($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendite di <?php echo $agente?></title>
</head>
<body>
    <h1>Vendite di <?php echo $agente; ?></h1>
    <table>
        <tr>
            <th>Agente</th>
            <th>Cliente</th>
            <th>Modello</th>
            <th>Data Vendita</th>
            <th>Prezzo</th>
        </tr>
        <?php foreach ($vendite as $vendita): ?>
        <tr>
            <td><?php echo $vendita['agente'];?></td>
            <td><?php echo $vendita['cliente'];?></td>
            <td><?php echo $vendita['desMod'];?></td>
            <td><?php echo $vendita['dataVendita'];?></td>
            <td><?php echo $vendita['prezzo'];?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>