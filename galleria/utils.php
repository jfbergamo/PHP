<?php

// ==================================== DB ====================================

$db = new mysqli("localhost", "jbergamo", "lozanusso", "galleriadb");

function getUserID($username): int {
    global $db;
    $query = "SELECT ID_utente
              FROM utenti
              WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    return $stmt->get_result()->fetch_assoc()['ID_utente'] ?? 0;
}

function login($username, $password) {
    global $db;
    $query = "SELECT password_hash
              FROM utenti
              WHERE ID_utente = ?";
    $stmt = $db->prepare($query);
    $userID = getUserID($username);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    if ($user = $stmt->get_result()->fetch_assoc()) {
        return password_verify($password, $user['password_hash']);
    }
    return false;
}

function addUser($username, $password) {
    global $db;
    $query = "INSERT INTO utenti (username, password_hash) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("ss", $username, $hash);
    $stmt->execute();
}

// ==================================== FILES ====================================

function uploadFile() {
    $filename = $_FILES["file"]["name"];
    $dir = "uploads/";
    $upload = true;
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $target = $dir . date("Y-m-d-H-i-s") . "." . $ext;
    $size = $_FILES["file"]["size"];


    if ($size > 2 * 1024 * 1024) {  // 2MB in byte
        return "Errore: il file è troppo grande. La dimensione massima è 2MB.";
    }

    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    if (!in_array($ext, $allowedTypes)) {
        return "Errore: solo file con estensione JPG, JPEG, PNG, GIF sono permessi.";
    }

    if (file_exists($target)) {
        return "Errore: il file esiste già.";
    }

    if (!$upload) {
        return "Errore: il file non è stato caricato.";
    } else {
        if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target)) {
            return "Errore durante il caricamento del file.";
        }
    }

    return '';
}