<?php

function stampa_filastrocca($i) {
    $first = $i <= 1;
    echo "<p>";
    echo ($first ? "Un" : $i) . " elefant" . ($first ? "e" : "i") . " si dondolava" . ($first ? "" : "no") . "<br>";
    echo "sopra il filo di una ragnatela" . "<br>";
    echo "e ritenendo la cosa interessante" . "<br>";
    echo "and" . ($first ? "o'" : "arono") . " a chiamare un altro elefante!" . "<br>";
    echo "</p>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elefante</title>
</head>
<body>
    <form method="get">
        Quanti elefanti vuoi veder dondolare?
        <input type="number" name="elefanti" min="1" max="200">
        <button type="submit">Conferma!</button>
    </form>

    <?php
    
    $n = $_GET['elefanti'];

    for ($i = 1; $i <= $n; $i++) {
        stampa_filastrocca($i);
    }
    
    if ($n > 1) {
        echo "<p>";
        echo "Il ragno che li vide pensò tutt'in un botto:" . "<br>";
        echo "\"Un altro che ne arriva, andiam tutti di sotto!\"." . "<br>";
        echo "</p>";
        
        for ($i = $n; $i > 0; $i--) {
            stampa_filastrocca($i);
        }
        
        echo "<p>";
        echo "Il ragno sospirò, si sentiva sollevato!" . "<br>";
        echo "Mangiò una mosca mora e si leccò il palato." . "<br>";
        echo "</p>";
    }

    ?>
    <div display="flex">
        <img height="250" src="imgs/elefante.gif">
        <?php

        if ($n == 20) {
            echo "<img height='250' src='imgs/spider.png'>";
        }
        
        ?>
    </div>
</body>
</html>