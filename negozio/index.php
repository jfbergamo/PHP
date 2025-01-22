<!-- TODO: schema concettuale -->
<?php

$ricerca = $_GET['ricerca'] ?? '';

include_once('connessione.php');

$query_clienti = "SELECT *
                  FROM clienti";
$clienti = mysqli_fetch_all($db->query($query_clienti), MYSQLI_ASSOC);

$query_mod = "SELECT tipoLegno, colore
              FROM modelli";
$modelli = mysqli_fetch_all($db->query($query_mod), MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negozio</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📚</text></svg>">
</head>
<body>
    <?php if ($ricerca == 1): ?>
    <div>
        <h1>Clienti:</h1>
        <table>
            <tr>
                <th>Cognome</th>
                <th>Nome</th>
                <th>Citta'</th>
                <th>Indirizzo</th>
                <th>Telefono</th>
            </tr>
            <?php foreach ($clienti as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['cognome']; ?></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $cliente['citta']; ?></td>
                    <td><?php echo $cliente['indirizzo']; ?></td>
                    <td><?php echo $cliente['telefono']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <h1>Modelli:</h1>
        <table>
            <tr>
                <th>Tipo di Legno</th>
                <th>Colore</th>
            </tr>
            <?php foreach ($modelli as $modello): ?>
            <tr>
                <td><?php echo $modello['tipoLegno']; ?></td>
                <td><?php echo $modello['colore']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php elseif ($ricerca == 2): ?>
    <?php endif; ?>
</body>
</html>