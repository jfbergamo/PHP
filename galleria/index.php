<?php

// Bergamasco Jacopo, 5AIA, A.S. 2024-2025
// File: index.php
// Pagina principale della webapp
// La pagina è formata da una schermata che mostra tutte le immagini caricate nell'app
// L'utente non loggato può visualizzare tutte le immagini inserite il loro conteggio dei like,
//  ma non può né caricare, né mettere like alle immagini
// Nella pagina è presente una navbar in cui è possibile recarsi alla schermata di login o di registrazione.
//  L'utente loggato vedrà nella stessa navbar un bottone per eseguire il logout e uno per caricare un'immagine
//  Il form di caricamento dell'immagine compare attraverso una finestra modale dinamica creata col framework Bootstrap5
// L'utente loggato può caricare immagini, mettere e rimuovere like dalle immagini e rimuovere le immagini caricate da lui

session_start();

include_once "utils.php";

// Logica di controllo del login
$login = isset($_SESSION['userID']) && userExists($_SESSION['userID']);

// Logica per l'inserimento di un like a un'immagine
// Il parametro GET 'like' contiene l'ID dell'immagine
if (isset($_GET['like'])) {
    if ($login) {
        $stmt = $db->prepare("INSERT INTO likes VALUES (?,?)");
        $stmt->bind_param("ii", $_SESSION['userID'], $_GET['like']);
        $stmt->execute();
    }
    die();
}

// Logica per la rimozione di un like a un'immagine
// In caso un'immagine abbia già il like dell'utente, quest'ultimo può ripremere sul tasto del like per rimuoverlo
// Il parametro GET 'dislike' contiene l'ID dell'immagine
if (isset($_GET['dislike'])) {
    if ($login) {
        $stmt = $db->prepare("DELETE FROM likes WHERE FK_ID_utente = ? AND FK_ID_immagine = ?");
        $stmt->bind_param("ii", $_SESSION['userID'], $_GET['dislike']);
        $stmt->execute();
    }
    die();
}

// Logica per la cancellazione di un'immagine
// L'utente può cancellare solo le immagini caricate da lui
if (isset($_POST['delete'])) {
    $img = $_POST['img']; // L'ID dell'immagine è contenuto nel parametro 'img'
    $query = "DELETE FROM immagini WHERE ID_immagine = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $img);
    $stmt->execute();
}

// Parametri per il caricamento del file
$filename = null;
$error = null;

// Logica per l'upload del file
if ($login && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['upload'])) {
    [$filename, $error] = uploadFile("file");
    if ($error == null) {
        // ^ In caso di caricamento riuscito l'immagine viene inserita nel db
        $query = "INSERT INTO immagini (FK_ID_utente, data_upload, descrizione) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("iss", $_SESSION["userID"], $filename, $_POST['descrizione']);
        $stmt->execute();
    }
}

// Ottiene tutte le immagini presenti nel db
function getImgs() {
    global $db;
    $query = "SELECT *
              FROM immagini JOIN utenti ON FK_ID_utente = ID_utente";
    $imgs = $db->query($query)->fetch_all(MYSQLI_ASSOC);
    if (count($imgs) === 0) return array(array(
        // ^ se non ci sono immagini, crea un placeholder che invita l'utente a registrarsi
        "username" => "Non ci sono immagini",
        "ID_utente" => 0,
        "ID_immagine" => 0,
        "descrizione" => 'Caricane una tu!',
        "data_upload" => 'uploads/placeholder.png'
    ));
    return $imgs;
}

// Ottiene tutti i like di un'immagine dato il suo ID
function getLikes($id) {
    global $db;
    // Nessun preparedStatement necessario in quanto la funzione e' interna al programma
    $query = "SELECT username
              FROM likes JOIN utenti ON FK_ID_utente = ID_utente
              WHERE FK_ID_immagine = $id";
    return array_map(fn($e) => $e['username'], $db->query($query)->fetch_all(MYSQLI_ASSOC));
}

// Controlla se l'utente attualmente loggato ha messo like a un'immagine, dato il suo ID
function liked($id) {
    global $db;
    $stmt = $db->prepare("SELECT *
                          FROM likes
                          WHERE FK_ID_immagine = ? AND FK_ID_utente = ?");
    $stmt->bind_param("ii", $id, $_SESSION['userID']);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc() != null;
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galleria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- ^ I fogli di stile utilizzati sono parte del framework Bootstrap5 (https://getbootstrap.com/) -->
    <link rel="icon" type="x-icon" href="favicon.ico">
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
    <!-- NAVBAR -->
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
                    <li class="nav-item">
                        <a class="nav-link active" href="signup.php">Registrati</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <main class="container text-center">
        <?php if ($error != null): ?>
        <!-- In caso di errore mostra un alert col suo messaggio (es: errori nel car del file) -->
        <div class="mt-3 alert alert-danger">
            <?= $error; ?>
        </div>
        <?php endif; ?>

        <h1 class="mt-3">Immagini</h1>
        
        <!-- Ciclo di visualizzazione delle immagini -->
        <?php foreach (getImgs() as $img): ?>
        <div class="container rounded img-btn my-4" style="width: 500px">
            <div class="text-start ps-3 pe-1 pt-3 pb-1 d-flex justify-content-between">
                <h4><?= $img['username']; ?></h4>
                <?php if ($login && $img['ID_utente'] == $_SESSION['userID']): ?>
                <!-- ^ controlla che l'immagine sia dell'utente loggato -->
                <!-- in caso affermativo mostra il pulsante per cancellarla -->
                <form method="POST" id="delete">
                    <input type="hidden" name="img" value="<?= $img['ID_immagine'] ?>">
                    <input type="hidden" name="delete">
                    <button class="btn btn-danger">🗑</button>
                </form>
                <?php endif; ?>
            </div>
            <img class="rounded" src="<?= $img['data_upload']; ?>" width="100%">
            <div class="d-flex justify-content-between">
                <div class="text-start px-2 pt-3 pb-1">
                    <p><?= $img['descrizione'] ?></p>
                </div>
                <!-- Logica per mostrare il pulsante dei like -->
                <!-- L'utente loggato può mettere e togliere like alle immagini -->
                <!-- Il pulsante, inoltre, mostra i nomi degli utenti che hanno messo like -->
                <?php $likes = getLikes($img['ID_immagine']); ?>
                <?php if ($login && $img['ID_immagine'] != 0): ?>
                <div class="btn-group py-2">
                    <?php if (liked($img['ID_immagine'])): ?>
                    <button class="btn btn-secondary" onclick="dislike(<?= $img['ID_immagine']; ?>)"><?= count($likes) ?> <span>💘</span></button>
                    <?php else: ?>
                    <button class="btn btn-secondary" onclick="like(<?= $img['ID_immagine']; ?>)"><?= count($likes) ?> <span>🖤</span></button>
                    <?php endif; ?>
                    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php foreach ($likes as $utente): ?>
                        <li class="dropdown-item"><?= $utente; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php else: ?>
                <div class="btn-group py-2">
                    <button class="btn btn-secondary"><?= count($likes) ?> <span>❤</span></button>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>

    </main>

    <!-- MODALI -->
    <div class="modal fade" id="carica" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Form di caricamento dell'immagine -->
                <form enctype="multipart/form-data" id="upload-form" method="POST">
                    <div class="modal-body container text-center">
                        <h2 class="mb-3">Carica un file</h2>
                        <input type="file" name="file" required>
                        <textarea class="mt-3" name="descrizione" placeholder="Descrizione"></textarea>
                        <p class="mt-3">
                            <input type="hidden" name="upload">
                            <button type="submit"class="btn btn-primary">Carica</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- ^ componente JavaScript del framework Bootstrap5 -->
    <script>
        // Controllo per quando si elimina un'immagine
        // Prima di confermare la cancellazione viene mostrata una finestra di dialogo all'utente
        //  per confermare l'operazione
        const deleteForm = document.getElementById('delete');
        if (deleteForm) {
            deleteForm.addEventListener('submit', (e) => {
                e.preventDefault();
                if (confirm("Sei sicuro di voler eliminare l'elemento?")) {
                    deleteForm.submit();
                }
            })
        }

        // Le chiamate di like e dislike delle immagini vengono fatte attraverso chiamate asincrone
        function like(id) {
            fetch(`?like=${id}`).then(() => location.reload());
        }
        function dislike(id) {
            fetch(`?dislike=${id}`).then(() => location.reload());
        }
    </script>
</body>
</html>
<!-- eof -->