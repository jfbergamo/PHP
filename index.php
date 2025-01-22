<?php

define("DEFAULT_EXERCISE", 2);

$esercizio = $_GET['esercizio'] ?? DEFAULT_EXERCISE;

switch ($esercizio) {
    case 0:
    case 1:
    case 2:
    case -1:
        break;
    default: $esercizio = DEFAULT_EXERCISE;
}

function nomeEsercizio($esercizio) {
    switch ($esercizio) {
        case 0: return "Elefante";
        case 1: return "Biblioteca";
        case 2: return "Negozio";
        default: return "Sconosciuto";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo nomeEsercizio($esercizio); ?>
    </title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <form method="get">
            <select name="esercizio">
                <option value="0" <?php echo ($esercizio == 0 ? "selected" : "") ?>>01 - Elefante</option>
                <option value="1" <?php echo ($esercizio == 1 ? "selected" : "") ?>>02 - Biblioteca</option>
                <option value="2" <?php echo ($esercizio == 2 ? "selected" : "") ?>>03 - Negozio</option>
            </select>
            <button action="submit">Conferma</button>
        </form>
    </nav>
<?php switch ($esercizio): ?>
<?php case 0: ?>
    <form method="post" action="elefanti/">
        Quanti elefanti vuoi veder dondolare?
        <input type="number" name="elefanti" min="1" max="200" value="3">
        <br>
        <button type="submit">Conferma!</button>
        <button type="reset">Cancella!</button>
    </form>
<?php break; ?>
<?php case 1: ?>
    <form method="post" action="biblioteca/">
        Quale autore vuoi trovare? [Cognome]
        <input type="text" name="autore">
        <br>
        <button type="submit">Conferma!</button>
        <button type="reset">Cancella!</button>
    </form>
<?php break; ?>
<?php case 2: ?>
    <form method="post" action="negozio/modelli-e-clienti">
        Elenca tutt i clienti e tutti i modelli del negozio.
        <button type="submit">Conferma</button>
    </form>
    <form method="post" action="negozio/vendite">
        Elenca tutte le vendite del negozio.
        <button type="submit">Conferma</button>
    </form>
    <form method="post" action="negozio/acquisti/">
        <input type="text" name="cliente">
        <button type="submit">Conferma</button>
        <button type="reset">Cancella!</button>
    </form>
<?php break; ?>
<?php endswitch; ?>
</body>
</html>