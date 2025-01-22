<!-- TODO: schema concettuale -->
<?php

$ricerca = $_GET['ricerca'] ?? '';

include_once('connessione.php');

switch ($ricerca) {
    case 1:
        $query_clienti = "SELECT *
                          FROM clienti";
        $clienti = mysqli_fetch_all($db->query($query_clienti), MYSQLI_ASSOC);

        $query_mod = "SELECT desMod, tipoLegno, colore
                      FROM modelli";
        $modelli = mysqli_fetch_all($db->query($query_mod), MYSQLI_ASSOC);
        break;
    case 2:
        // ID, nome cliente, cognome cliente, data, nome modello, prezzo, agente
        $query = "SELECT idVendita, CONCAT(nome, CONCAT(' ', cognome)) AS cliente, dataVendita, desMod, prezzo, agente
                  FROM vendite JOIN clienti ON cliente = idCliente JOIN modelli ON modello = idMod";
        $vendite = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);
        break;
    case 3:
        $cliente = $_POST['cliente'] ?? 'Sconosciuto';
        $query = "SELECT idVendita, desMod, dataVendita, prezzo, agente
                  FROM vendite JOIN clienti ON cliente = idCliente JOIN modelli ON modello = idMod
                  WHERE cognome = '$cliente'";
        $acquisti = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);
        break;
}
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
                <th>Nome</th>
                <th>Tipo di Legno</th>
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
    </div>
    <?php elseif ($ricerca == 2): ?>
    <h1>Vendite:</h1>
    <table>
        <tr>
            <th>ID Vendita</th>
            <th>Cliente</th>
            <th>Data vendita</th>
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
    <?php elseif ($ricerca == 3): ?>
    <h1>Acquisti di <?php echo $cliente; ?></h1>
    <!-- idVendita, desMod, dataVendita, prezzo, agente -->
    <table>
        <tr>
            <th>ID Vendita</th>
            <th>Nome modello</th>
            <th>Data Vendita</th>
            <th>Prezzo</th>
            <th>Agente</th>
        </tr>
        <?php foreach ($acquisti as $acquisto): ?>
        <tr>
            <td><?php echo $acquisto['idVendita']; ?></td>
            <td><?php echo $acquisto['desMod']; ?></td>
            <td><?php echo $acquisto['dataVendita']; ?></td>
            <td><?php echo $acquisto['prezzo']; ?></td>
            <td><?php echo $acquisto['agente']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>