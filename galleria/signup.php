<?php

// Bergamasco Jacopo, 5AIA, A.S. 2024-2025

// File: singup.php
// Pagina di registrazione per l'utente
// La pagina controlla l'inserimento di username, password e conferma della password e registra l'utente nel db per poi loggarlo
// Il login è controllato dalla presenza del campo 'userID' nella sessione.
//  Tale campo contiene l'ID dell'utente loggato che viene controllato quando necessario con la funzione userExists()

session_start();

include_once "utils.php";

// Logica di registrazione
if (isset($_POST['username'], $_POST['password'], $_POST['password_confirm'])) {
    if ($_POST['password'] == $_POST['password_confirm']) {
        // ^ Controllo che le password corrispondano
        if (addUser($_POST['username'], $_POST['password'])) {
            $_SESSION['userID'] = getUserID($_POST['username']);
        } else {
            $error = 'Esiste gia\' un utente con quel nome.';
        }
        // ^ Inserimento dell'ID dell'utente nella sessione
    } else {
        $error = "Le password non corrispondono!";
    }
}

// Logica del controllo del login
$login = isset($_SESSION['userID']) && userExists($_SESSION['userID']);

if ($login) {
    header('Location: index.php');
    // ^ Se l'utente ha già effettuato l'accesso viene reindirizzato alla schermata principale
}

include_once "utils.php";

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galleria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- ^ I fogli di stile utilizzati sono parte del framework Bootstrap5 (https://getbootstrap.com/) -->
</head>
<body>
    <div class="container text-center my-4 px-5">
        
        <?php if (isset($error)): ?>
        <!-- In caso di errore mostra un alert col messaggio di errore. (esempio: Le password non corrispondono) -->
        <div class="alert alert-danger">
            <?= $error; ?>
        </div>
        <?php endif; ?>

        <h1>Registrati</h1>
        <!-- Semplice form di registrazione -->
        <form id="register-form" method="POST" class="mt-3">
            <p>
                <input type="text" placeholder="Nome utente" name="username" required>
            </p>
            <p>
                <input type="password" placeholder="Password" name="password" required>
            </p>
            <p>
                <input type="password" placeholder="Conferma password" name="password_confirm" required>
            </p>
            <p>
                <button type="submit" class="btn btn-success">Registrati</button>
            </p>
        </form>
        <a class="link-secondary" href="login.php">Accedi</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- ^ componente JavaScript del framework Bootstrap5 -->
</body>
</html>
<!-- eof -->