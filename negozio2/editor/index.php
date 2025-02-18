<?php

// Bergamasco Jacopo & Loris G. Mandra, 5AIA, A.S. 2024-2025

include_once("../connessione.php");

$idCliente = $_GET['cliente'] ?? 0;

$query = "SELECT cognome, nome, indirizzo, citta, telefono
            FROM clienti
            WHERE idCliente = $idCliente";
$cliente = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC)[0];

function acquisti($idCliente) {
    global $db;
    $query = "SELECT idVendita, dataVendita, desMod, prezzo, agente
              FROM vendite JOIN clienti ON idCliente = cliente JOIN modelli ON idMod = modello
              WHERE idCliente = '$idCliente'";
    $acquisti = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);
    return $acquisti;
}

function modelli() {
    global $db;
    $query = "SELECT idMod, desMod
              FROM modelli";
    $modelli = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);
    return $modelli;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>👷🏿‍♂️</text></svg>">
    <link rel="stylesheet" href="../style.css">
    <script>
        function cancella(id) {
            if (confirm(`Vuoi davvero eliminare l'acquisto?`)) {
                fetch(`cancella.php?acquisto=${id}`).then(() => location.reload());
            }
        }
    </script>
</head>
<body>
    <h1><?php echo $cliente['nome'] . " " . $cliente['cognome']; ?></h1>
    <table>
        <tr>
            <th>INDIRIZZO</th>
            <th>CITTA</th>
            <th>TELEFONO</th>
        </tr>
        <tr>
            <td><?php echo $cliente['indirizzo']; ?></td>
            <td><?php echo $cliente['citta']; ?></td>
            <td><?php echo $cliente['telefono']; ?></td>
        </tr>
    </table>
    <h2>Acquisti di <?php echo $cliente['nome'] . " " . $cliente['cognome']; ?></h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Data Vendita</th>
            <th>Modello</th>
            <th>Prezzo</th>
            <th>Agente</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach (acquisti($idCliente) as $acquisto): ?>
        <tr>
            <td><?php echo $acquisto['idVendita']; ?></td>
            <td><?php echo $acquisto['dataVendita']; ?></td>
            <td><?php echo $acquisto['desMod']; ?></td>
            <td><?php echo $acquisto['prezzo']; ?></td>
            <td><?php echo $acquisto['agente']; ?></td>
            <td><a href="modifica.php?acquisto=<?php echo $acquisto['idVendita']; ?>"><button>Modifica</button></a></td>
            <td><button onclick="cancella(<?php echo $acquisto['idVendita'] ?>)">Cancella</button></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2>Inserisci un nuovo acquisto</h2>
    <form id="aggiungi" action="inserisci.php?cliente=<?php echo $idCliente; ?>" method="post">
        <label for="modello">Modello:</label>
        <select name="modello">
            <?php foreach (modelli() as $modello): ?>
            <option value="<?php echo $modello['idMod']; ?>"><?php echo $modello['desMod']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="dataVendita">Data vendita:</label>
        <input type="date" name="dataVendita">
        <br>
        <label for="prezzo">Prezzo:</label>
        <input type="number" name="prezzo">
        <br>
        <label for="agente">Agente:</label>
        <input type="text" name="agente">
        
        <button type="submit">Conferma</button>
        <button type="reset">Reset</button>
    </form>
</body>
</html>