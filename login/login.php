<?php

session_start();

include_once 'utils.php';

$failed = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $userId = checkLogin($email, $pass);
    if ($userId) {
        $_SESSION['userId'] = $userId;
    } else {
        $failed = true;
    }
}

if (isset($_SESSION['userId'])) {
    header('Location: index.php');
    die();
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center mt-5">
        <?php if ($failed): ?>

        <div class="alert alert-danger">
            Accesso negato!
        </div>

        <?php endif; ?>
        <h1>Login</h1>

        <form method="post" class="m-4">
            <div class="mb-2">
                <label for="login" class="mx-3">Email</label>
                <input type="email" id="login" name="email">
            </div>
            <div class="mb-2">
                <label for="passw" class="mx-3">Password</label>
                <input type="password" id="passw" name="password">
            </div>
            <button class="btn btn-success">Conferma</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>