<?php

// Bergamasco Jacopo & Loris G. Mandra, 5AIA, A.S. 2024-2025

$acquisto = $_GET['acquisto'] ?? '';

include_once "../connessione.php";

$query = "SELECT idCliente, idMod, dataVendita, prezzo, agente
          FROM vendite JOIN clienti ON idCliente = cliente JOIN modelli ON idMod = modello
          WHERE idVendita = $acquisto";
$vendita = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC)[0];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['modello']) && isset($_POST['dataVendita']) && isset($_POST['prezzo']) && isset($_POST['agente'])):

    $idModello =   $_POST['modello'];
    $dataVendita = $_POST['dataVendita'];
    $prezzo =      $_POST['prezzo'];
    $agente =      $_POST['agente'];

    $updateQuery = "UPDATE vendite
                    SET modello = $idModello, dataVendita = DATE('$dataVendita'), prezzo = $prezzo, agente = '$agente'
                    WHERE idVendita = $acquisto";
    $db->query($updateQuery);

    endif;

    header("Location: index.php?cliente=" . $vendita['idCliente']);
    die();
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
    <title>Modifica</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>👷🏿‍♂️</text></svg>">
</head>
<body>
    <h1>Modifica acquisto</h1>
    <form action="" method="post">
        <label for="modello">Modello:</label>
        <select name="modello">
            <?php foreach (modelli() as $modello): ?>
            <option value="<?php echo $modello['idMod']; ?>" <?php echo $modello['idMod'] == $vendita['idMod'] ? "selected" : "" ?>><?php echo $modello['desMod']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="dataVendita">Data vendita:</label>
        <input type="date" name="dataVendita" value="<?php echo $vendita['dataVendita']; ?>">
        <br>
        <label for="prezzo">Prezzo:</label>
        <input type="number" name="prezzo" value="<?php echo $vendita['prezzo']; ?>">
        <br>
        <label for="agente">Agente:</label>
        <input type="text" name="agente" value="<?php echo $vendita['agente']; ?>">
        
        <button type="submit">Conferma</button>
        <button type="reset">Reset</button>
    </form>
</body>
</html>