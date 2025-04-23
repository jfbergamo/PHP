<?php

session_start();

include_once "utils.php";

if (isset($_POST['username'], $_POST['password'])) {
    if (login($_POST['username'], $_POST['password'])) {
        $_SESSION['userID'] = getUserID($_POST['username']);
    } else {
        $error = "Accesso negato!";
    }
}

$login = isset($_SESSION['userID']) && userExists($_SESSION['userID']);

if ($login) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galleria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center my-4">
      
        <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?= $error; ?>
        </div>
        <?php endif; ?>
            
        <h1>Accedi</h1>
        <form method="POST" class="mt-3">
            <p>
                <input type="text" placeholder="Nome utente" name="username" required>
            </p>
            <input class="mb-3" type="password" placeholder="Password" name="password" required>
            <p>
                <button type="submit" class="btn btn-success">Accedi</button>
            </p>
        </form>
        <a class="link-secondary" href="signup.php">Registrati</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>