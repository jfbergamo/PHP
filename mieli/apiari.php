<?php

// Bergamasco Jacopo, Mandra Loris, Polo Nicolò - Mieli - 5AIA, A.S. 2024-2025

$title = "Numero complessivo di apiari per ciascuna regione";

include_once "conn.php";

$query = "SELECT l.Regione AS regione, COUNT(*) AS n
          FROM Localita l
            JOIN Apiari a ON a.FK_ID_localita = l.ID_localita
          GROUP BY l.Regione";
$apiari = $db->query($query)->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="favicon.ico">
</head>
<body>
    <div class="container text-center mt-5">
        <h1><?= $title ?></h1>
        <!-- Tabella per il controllo dei dati, se non ci sono dati non mostra la tabella -->
        <?php if (count($apiari) > 0): ?>
        <table class="table table-stripped mt-5">
            <tr>
                <th>Regione</th>
                <th>Numero di apiari</th>
            </tr>
            <?php foreach ($apiari as $apiario): ?>
            <tr>
                <td><?= $apiario['regione']; ?></td>
                <td><?= $apiario['n']; ?></td>
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