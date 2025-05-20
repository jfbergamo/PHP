<?php

// Bergamasco Jacopo, Mandra Loris, Polo Nicolò - Mieli - 5AIA, A.S. 2024-2025

$title = 'Quantità di miele prodotto in Italia lo scorso anno per ciascuna delle quattro tipologie';

include_once "conn.php";

$query = "SELECT t.Nome AS nome, SUM(p.Quantita) AS quantita
          FROM Tipi_Miele t 
            JOIN Mieli m ON t.ID_tipo_miele = m.FK_ID_tipo_miele
            JOIN Apiari a ON a.FK_ID_Miele = m.ID_miele 
            JOIN Produzioni p ON p.FK_ID_Apiario = a.ID_apiario
          WHERE p.anno = EXTRACT(YEAR FROM NOW()) - 1
          GROUP BY t.Nome";
$mieli = $db->query($query)->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="favicon.ico">
</head>
<body>
    <div class="container text-center mt-5">
        <h1><?= $title; ?></h1>
        <!-- Tabella per il controllo dei dati, se non ci sono dati non mostra la tabell -->
        <?php if (count($mieli) > 0): ?>
        <table class="table table-stripped mt-5">
            <tr>
                <th>Miele</th>
                <th>Quantità</th>
            </tr>
            <?php foreach ($mieli as $miele): ?>
            <tr>
                <td><?= $miele['nome']; ?></td>
                <td><?= $miele['quantita']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
        <p class="mt-5">Non ci sono dati</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>