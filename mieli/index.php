<?php

// Bergamasco Jacopo, Mandra Loris, Polo Nicolò - Mieli - 5AIA, A.S. 2024-2025

include_once "conn.php";

// Ottiene tutte le regioni
$query = "SELECT DISTINCT regione
          FROM Localita";
$regioni = array_map(function($item) { return $item['regione']; }, $db->query($query)->fetch_all(MYSQLI_ASSOC));

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mieli</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="favicon.ico">
    <style>
        body {
            background-color: #181818;
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <h1>🍯 <strong>MIELI ITALIANI</strong> 🇮🇹</h1>
        <h2>Esempi di esecuzione query</h2>
        <div class="d-inline-flex justify-content-center">
            <!-- Menù di selezione delle 3 query -->
            <div class="container mt-3 bg-dark rounded">
                <!-- Query 1 -->
                <form action="apicoltori.php" method="POST" class="mt-3 ms-2">
                    <label for="regione">
                        Elenco degli apicoltori che producono miele DOP in:
                    </label>
                    <div class="d-flex">
                        <select name="regione" class="form-select my-1">
                            <?php foreach ($regioni as $regione): ?>
                            <option value="<?= $regione; ?>"><?= $regione; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn btn-success mx-3" type="submit">Vai</button>
                    </div>
                </form>
                <!-- Query 2 -->
                <form action="apiari.php" method="GET" class="mt-3 ms-2">
                    <button class="btn btn-success mx-3" type="submit">Ottieni il numero complessivo di apiari per ciascuna regione.</button>
                </form>
                <!-- Query 3 -->
                <form action="miele.php" method="GET" class="my-3 ms-2">
                    <button class="btn btn-success mx-3" type="submit">Ottieni le quantità di miele prodotto in Italia lo scorso anno per ciascuna delle quattro tipologie.</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>