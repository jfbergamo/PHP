<?php

$first = false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if ($first) {
            echo "Elefante";
        } else {
            echo "Biblioteca";
        }
        ?>
    </title>
    <style>
        /* Impostazioni di base per il body */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        color: #333;
    }
    
    /* Stile per l'header */
    header {
        background-color: #4CAF50;
        padding: 10px;
        color: white;
        text-align: center;
    }
    
    header form {
        display: inline-block;
        margin: 0;
    }
    
    /* Stile per il selettore e il bottone nell'header */
    header select {
        padding: 8px;
        margin-right: 10px;
        font-size: 16px;
    }
    
    header button {
        padding: 8px 16px;
        background-color: #45a049;
        border: none;
        color: white;
        cursor: pointer;
        font-size: 16px;
    }
    
    header button:hover {
        background-color: #388e3c;
    }
    
    /* Stile per il form principale */
    form {
        background-color: #fff;
        border: 1px solid #ddd;
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
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
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
    <header>
        <form method="get">
            <select name="esercizio">
                <option value="elefante">Elefante</option>
                <option value="biblioteca">Biblioteca</option>
            </select>
            <button action="submit"></button>
        </form>
    </header>
    <?php
    if ($first) {
        echo '    <form method="post" action="elefanti/">';
        echo '        Quanti elefanti vuoi veder dondolare?';
        echo '        <input type="number" name="elefanti" min="1" max="200" value="3">';
        echo '        <br>';
        echo '        <button type="submit">Conferma!</button>';
        echo '        <button type="reset">Cancella!</button>';
        echo '    </form>';
    } else {
        print '    <form method="post" action="biblioteca/">' . "\n";
        print '        Quale autore vuoi trovare? [Cognome]' . "\n";
        print '        <input type="text" name="autore">' . "\n";
        print '        <br>' . "\n";
        print '        <button type="submit">Conferma!</button>' . "\n";
        print '        <button type="reset">Cancella!</button>' . "\n";
        print '    </form>' . "\n";
    }
    ?>
</body>
</html>