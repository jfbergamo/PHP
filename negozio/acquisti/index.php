<!-- Acquisti di un cliente -->
<?php 

include_once("../connessione.php");

$cliente = $_POST['cliente'] ?? 'Sconosciuto';

$query = "SELECT idVendita, dataVendita, desMod, prezzo, agente
          FROM vendite JOIN clienti ON idCliente = cliente JOIN modelli ON idMod = modello
          WHERE cognome = '$cliente'";
$acquisti = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acquisti di <?php echo $cliente ?></title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <h1>Acquisti di <?php echo $cliente ?></h1>
    <table>
        <tr>
            <th>ID Vendita</th>
            <th>Data Vendita</th>
            <th>Modello</th>
            <th>Prezzo</th>
            <th>Agente</th>
        </tr>
        <?php foreach ($acquisti as $acquisto): ?>
        <tr>
            <td><?php echo $acquisto['idVendita']; ?></td>
            <td><?php echo $acquisto['dataVendita']; ?></td>
            <td><?php echo $acquisto['desMod']; ?></td>
            <td><?php echo $acquisto['prezzo']; ?></td>
            <td><?php echo $acquisto['agente']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>