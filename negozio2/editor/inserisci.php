<?php

include_once "../connessione.php";

$idCliente = $_GET['cliente'] ?? '';
$dataVendita = $_POST['dataVendita'] ?? '';
$idModello = $_POST['modello'] ?? '';
$prezzo = $_POST['prezzo'] ?? '';
$agente = $_POST['agente'] ?? '';

// CREATE TABLE `vendite` (
//     `idVendita` int(11) NOT NULL,
//     `cliente` int(11) DEFAULT NULL,
//     `dataVendita` date DEFAULT NULL,
//     `modello` int(11) DEFAULT NULL,
//     `prezzo` decimal(7,2) DEFAULT NULL,
//     `agente` varchar(20) DEFAULT NULL
//   ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

$query = "INSERT INTO vendite VALUES (NULL, $idCliente, DATE('$dataVendita'), $idModello, $prezzo, '$agente')";
$db->query($query);

header("Location: index.php?cliente=$idCliente");

?>