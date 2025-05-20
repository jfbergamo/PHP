<?php

// Bergamasco Jacopo, Mandra Loris, Polo Nicolò - Mieli - 5AIA, A.S. 2024-2025

$regione = $_POST['regione'] ?? '';

$title = "Elenco degli apicoltori che producono miele DOP in $regione";

include_once "conn.php";

$query = "SELECT api.nome AS nome, api.cognome AS cognome
          FROM Apicoltori api
            JOIN Apiari apa ON api.ID_apicoltore = apa.FK_ID_apicoltore
            JOIN Mieli m ON apa.FK_ID_miele = m.ID_miele
            JOIN Tipi_Miele t ON m.FK_ID_tipo_miele = t.ID_tipo_miele
            JOIN Localita l ON apa.FK_ID_localita = l.ID_localita
          WHERE t.nome = 'DOP'
            AND l.Regione = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $regione);
$stmt->execute();
$apicoltori = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

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
        <!-- Tabella per il controllo dei dati, se non ci sono dati non mostra la tabella -->
        <?php if (count($apicoltori) > 0): ?>
        <table class="table table-stripped mt-5">
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
            </tr>
            <?php foreach ($apicoltori as $apicoltore): ?>
            <tr>
                <td><?= $apicoltore['nome']; ?></td>
                <td><?= $apicoltore['cognome']; ?></td>
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