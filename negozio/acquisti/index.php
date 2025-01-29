<!-- Acquisti di un cliente -->
<?php 

include_once("../connessione.php");

$cliente = $_POST['cliente'] ?? 0;

$query = "SELECT idVendita, dataVendita, desMod, prezzo, agente
          FROM vendite JOIN clienti ON idCliente = cliente JOIN modelli ON idMod = modello
          WHERE idCliente = '$cliente'";
$acquisti = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);

$nome = mysqli_fetch_all($db->query("SELECT CONCAT(nome, CONCAT(' ', cognome)) AS nome FROM clienti WHERE idCliente = '$cliente'") , MYSQLI_ASSOC)[0]["nome"];

mysqli_close($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acquisti di <?php echo $nome ?></title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏪</text></svg>">
</head>
<body>
    <h1>Acquisti di <?php echo $nome ?></h1>
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