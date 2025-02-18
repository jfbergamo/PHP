<?php

// Bergamasco Jacopo & Loris G. Mandra, 5AIA, A.S. 2024-2025

include_once "../connessione.php";

$acquisto = $_GET['acquisto'] ?? '';

$query = "DELETE FROM vendite WHERE idVendita = '$acquisto'";
$db->query($query);

?>