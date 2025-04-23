<?php

session_start();

include_once "utils.php";

$login = isset($_SESSION['userID']) && userExists($_SESSION['userID']);

$filename = null;
$error = null;

if ($login && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES)) {
    [$filename, $error] = uploadFile("file");
    if ($error == null) {
        $query = "INSERT INTO immagini (FK_ID_utente, data_upload) VALUES (?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("is", $_SESSION["userID"], $filename);
        $stmt->execute();
    }
}

function getImgs() {
    global $db;
    $query = "SELECT username, data_upload
              FROM immagini JOIN utenti ON FK_ID_utente = ID_utente";
    return $db->query($query)->fetch_all(MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galleria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .img-btn {
            background-color: #181818;
            transition: 0.2s;
        }

        .img-btn:hover {
            transform: scale(1.07, 1.07);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Galleria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if ($login): ?>
                    <li class="nav-item">
                        <button class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#carica">Carica</button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">Login</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <main class="container text-center">
        <?php if ($error != null): ?>
        <div class="alert alert-danger">
            <?= $error; ?>
        </div>
        <?php endif; ?>
        <h1 class="mt-3">Immagini</h1>
        
        <?php foreach (getImgs() as $img): ?>
        <div class="container rounded img-btn my-4" style="width: 500px">
            <div class="text-start px-3 pt-3 pb-1">
                <h3><?= $img['username']; ?></h3>
            </div>
            <img class="rounded pb-3" src="<?= $img['data_upload']; ?>" width="100%">
        </div>
        <?php endforeach; ?>

    </main>

    <!-- MODALI -->
    <div class="modal fade" id="carica" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form enctype="multipart/form-data" id="upload-form" method="POST">
                    <div class="modal-body container text-center">
                        <h2 class="mb-3">Carica un file</h2>
                        <input type="file" name="file" required>
                        <p class="mt-3">
                            <button type="submit" class="btn btn-primary">Carica</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>