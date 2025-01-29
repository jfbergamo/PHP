<?php

include_once("connessione.php");

$query = "SELECT idCliente, CONCAT(nome, CONCAT(' ', cognome)) AS cliente
          FROM clienti";

$clienti = mysqli_fetch_all($db->query($query), MYSQLI_ASSOC);

mysqli_close($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negozio</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏪</text></svg>">
</head>
<body>
    <form method="post" action="modelli-e-clienti/">
        Elenca tutti i clienti e tutti i modelli del negozio.
        <button type="submit">Conferma</button>
    </form>
    <form method="post" action="vendite/">
        Elenca tutte le vendite del negozio.
        <button type="submit">Conferma</button>
    </form>
    <form method="post" action="acquisti/">
        <select name="cliente">
            <?php foreach ($clienti as $cliente): ?>
            <option value="<?php echo $cliente['idCliente']; ?>"><?php echo $cliente['cliente'];?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Conferma</button>
        <button type="reset">Cancella!</button>
    </form>
    <div>
        <a href="editor"><button>Modifica i campi.</button></a>
    </div>
</body>
</html>