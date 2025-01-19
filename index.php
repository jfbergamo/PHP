<?php

$esercizio = isset($_GET['esercizio']) ? $_GET['esercizio'] : "biblioteca";

switch ($esercizio) {
    case "elefante":
    case "biblioteca":
    case "test":
        break;
    default: $esercizio = "elefante";
}

function nomeEsercizio($esercizio) {
    switch ($esercizio) {
        case "elefante": return "Elefante";
        case "biblioteca": return "Biblioteca";
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
        <?php
        echo nomeEsercizio($esercizio);
        ?>
    </title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <style>
        /* Impostazioni di base per il body */
        body {
            font-family: Arial, sans-serif;
            background-color: #181818;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        
        /* Stile per l'header */
        nav {
            background-color: #40194d;
            padding: 10px;
            color: white;
            text-align: center;
        }
        
        nav form {
            display: inline-block;
            margin: 0;
        }
        
        /* Stile per il selettore e il bottone nell'header */
        nav select {
            padding: 8px;
            margin-right: 10px;
            font-size: 16px;
        }
        
        nav button {
            padding: 8px 16px;
            background-color: #45a049;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        
        nav button:hover {
            background-color: #388e3c;
        }
        
        /* Stile per il form principale */
        form {
            background-color: #696969;
            border: 1px solid #696969;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        /* Stile per i label, input e bottone nel form */
        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        form input[type="text"] {
            width: 95%;
            padding: 10px;
            border: 1px solid #727272;
            border-radius: 4px;
            font-size: 16px;
            background-color: #727272;
            color:#fff
        }
        
        form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            margin-right: 10px;
        }
        
        form button:hover {
            background-color: #45a049;
        }
        
        /* Stile per il bottone di reset */
        form button[type="reset"] {
            background-color: #f44336;
        }
        
        form button[type="reset"]:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <nav>
        <form method="get">
            <select name="esercizio">
                <option value="biblioteca">02 - Biblioteca</option>
                <option value="elefante">01 - Elefante</option>
            </select>
            <button action="submit">Conferma</button>
        </form>
    </nav>
    <?php
    switch ($esercizio) {
    case "elefante": ?>
        <form method="post" action="elefanti/">
            Quanti elefanti vuoi veder dondolare?
            <input type="number" name="elefanti" min="1" max="200" value="3">
            <br>
            <button type="submit">Conferma!</button>
            <button type="reset">Cancella!</button>
        </form>
        <?php break;
    case "biblioteca": ?>
        <form method="post" action="biblioteca/">
            Quale autore vuoi trovare? [Cognome]
            <input type="text" name="autore">
            <br>
            <button type="submit">Conferma!</button>
            <button type="reset">Cancella!</button>
        </form>
        <?php break;
    }
    ?>
</body>
</html>