<?php

include_once("connessione.php");

$queryClienti = "SELECT cognome, nome, indirizzo
                 FROM clienti";

$clienti = mysqli_fetch_all($db->query($queryClienti), MYSQLI_ASSOC);

$queryModelli = "SELECT desMod, tipoLegno, colore
                 FROM modelli";
$modelli = mysqli_fetch_all($db->query($queryModelli), MYSQLI_ASSOC);

mysqli_close($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostra</title>
</head>
<body>
    <h1>Clienti:</h1>
    <table>
        <tr>
            <th>Cognome</th>
            <th>Nome</th>
            <th>Indirizzo</th>
        </tr>
        <?php foreach ($clienti as $cliente): ?>
        <tr>
            <td><?php echo $cliente['cognome']; ?></td>
            <td><?php echo $cliente['nome']; ?></td>
            <td><?php echo $cliente['indirizzo']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h1>Modelli:</h1>
    <table>
        <tr>
            <th>Descrizione</th>
            <th>Tipo legno</th>
            <th>Colore</th>
        </tr>
        <?php foreach ($modelli as $modello): ?>
        <tr>
            <td><?php echo $modello['desMod']; ?></td>
            <td><?php echo $modello['tipoLegno']; ?></td>
            <td><?php echo $modello['colore']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>