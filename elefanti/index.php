<?php

function stampa_filastrocca($i) {
    $first = $i <= 1;
    ?>
    <p>
        <?php echo($first ? "Un" : $i)?> elefant<?php echo($first ? "e" : "i")?> si dondolava<?php echo($first ? "" : "no")?>
        <br>
        sopra il filo di una ragnatela
        <br>
        e ritenendo la cosa interessante
        <br>
        and<?php echo($first ? "ò" : "arono")?>  a chiamare un altro elefante!
        <br>
    </p>
    <?php
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elefante</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🐘</text></svg>">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
            color: #333;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    $elefanti = $_POST['elefanti'] ?? 1;
    $n = (is_numeric($elefanti)) ? $elefanti : 1;

    for ($i = 1; $i <= $n; $i++) {
        stampa_filastrocca($i);
    }
    
    if ($n > 1) {
    ?>
        <p>
            Il ragno che li vide pensò tutt'in un botto:
            <br>
            "Un altro che ne arriva, andiam tutti di sotto!"
            <br>
        </p>
        
        <?php
        for ($i = $n; $i > 0; $i--) {
            stampa_filastrocca($i);
        } ?>
        
        <p>
            Il ragno sospirò, si sentiva sollevato!
            <br>
            Mangiò una mosca mora e si leccò il palato.
            <br>
        </p>
    <?php
    }
    ?>

    <div display="flex">
        <img height="250" src="imgs/elefante.png">
        
        <?php
        if ($n == 20) {
        ?>
            <img height='250' src='imgs/spider.png'>
        <?php
        }
        ?>
        
    </div>
</body>
</html>