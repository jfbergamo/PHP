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

    $autore = $_POST['autore'];
    $query = "SELECT Titolo FROM Libri JOIN Autori ON ID_Autore = FK_ID_Autore WHERE Cognome = '$autore'";
    $res = $conn->query($query);
    if ($res == false) {
        echo("Errore nella query! " . mysqli_error($conn));
    } else {
        echo "<h1>Libri dell'autore</h1>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Titolo</th>";
        echo "</tr>";

        while ($riga = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $titolo = $riga["titolo"];
            echo "<tr>";
            echo "<td>$titolo</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    ?>
</body>
</html>