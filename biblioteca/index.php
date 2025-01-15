<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    include_once("connessione.php");

    $autore = isset($_POST['autore']) ? $_POST['autore'] : '';
    $query = "SELECT Titolo, Nome, Cognome
              FROM Libri JOIN Autori ON ID_Autore = FK_ID_Autore 
              WHERE Cognome = '$autore'";
    $res = $db->query($query);
    
    if ($res->num_rows <= 0) {
        echo "    <h1>Nessun libro e' stato trovato per l'autore $autore!</h1>" . "\n";
    } else {
        echo '<h1>Libri dell\'autore</h1>' . "\n";
        echo '    <table>' . "\n";
        echo '        <tr>' . "\n";
        echo '            <th>Nome</th>' . "\n";
        echo '            <th>Cognome</th>' . "\n";
        echo '            <th>Titolo</th>' . "\n";
        echo '        </tr>' . "\n";

        while ($riga = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            echo '        <tr>' . "\n";
            echo '            <td>' . $riga["Nome"] . '</td>' . "\n";
            echo '            <td>' . $riga["Cognome"] . '</td>' . "\n";
            echo '            <td>' . $riga["Titolo"] . '</td>' . "\n";
            echo '        </tr>' . "\n";
        }
        echo '    </table>' . "\n";
    }
    
    ?>
</body>
</html>