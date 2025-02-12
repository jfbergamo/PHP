<?php

include_once "../connessione.php";

$acquisto = $_GET['acquisto'] ?? '';

$query = "DELETE FROM vendite WHERE idVendita = '$acquisto'";
$db->query($query);

?>