<?php

include_once("connessione.php");

$query = "SELECT CONCAT(nome, CONCAT(' ', cognome)) AS cliente, desMod, prezzo, dataVendita, agente
          FROM vendite JOIN clienti ON cliente = idCliente JOIN modelli ON modello = idMod";
$vendite = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);

mysqli_close($db);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendite</title>
</head>
<body>
    <h1>Vendite:</h1>
    <table>
        <tr>
            <th>Cliente</th>
            <th>Modello</th>
            <th>Prezzo</th>
            <th>Data Vendita</th>
            <th>Agente</th>
        </tr>
        <?php foreach ($vendite as $vendita): ?>
            <tr>
                <td><?php echo $vendita['cliente']; ?></td>
                <td><?php echo $vendita['desMod']; ?></td>
                <td><?php echo $vendita['prezzo']; ?></td>
                <td><?php echo $vendita['dataVendita']; ?></td>
                <td><?php echo $vendita['agente']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>