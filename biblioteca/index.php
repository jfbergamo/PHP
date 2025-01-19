<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📚</text></svg>">
</head>
<body>
<?php

include_once("connessione.php");

$autore = isset($_POST['autore']) ? $_POST['autore'] : '';
$query = "SELECT Titolo, Nome, Cognome
          FROM Libri JOIN Autori ON ID_Autore = FK_ID_Autore 
          WHERE Cognome = '$autore'";
$res = $db->query($query);

?>
<?php if ($res->num_rows <= 0): ?>
    <h1>Nessun libro è stato trovato per l'autore <?php echo $autore ?>!</h1>
<?php else: ?>
    <h1>Libri dell'autore</h1>
        <table>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Titolo</th>
            </tr>

    <?php while ($riga = mysqli_fetch_array($res, MYSQLI_ASSOC)): ?>
        <tr>
            <td><?php echo $riga["Nome"]    ?></td>
            <td><?php echo $riga["Cognome"] ?></td>
            <td><?php echo $riga["Titolo"]  ?></td>
        </tr>
    <?php endwhile; ?>
    </table>
<?php endif; ?>
</body>
</html>