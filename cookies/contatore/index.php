<?php

$conta = 0;

if (isset($_COOKIE['conta'])) {
    $conta = ++$_COOKIE['conta'];
    setcookie("conta", $conta, time() + 3600);
} else {
    setcookie("conta", 0, time() + 3600);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatore</title>
</head>
<body>
    <h1><?= $conta; ?></h1>
    <form>
        <button>Conta</button>
    </form>
</body>
</html>