<?php

// Bergamasco Jacopo & Loris G. Mandra, 5AIA, A.S. 2024-2025

include_once "../connessione.php";

$idCliente = $_GET['cliente'] ?? '';
$dataVendita = $_POST['dataVendita'] ?? '';
$idModello = $_POST['modello'] ?? '';
$prezzo = $_POST['prezzo'] ?? '';
$agente = $_POST['agente'] ?? '';

$query = "INSERT INTO vendite VALUES (NULL, $idCliente, DATE('$dataVendita'), $idModello, $prezzo, '$agente')";
$db->query($query);

header("Location: index.php?cliente=$idCliente");

?>