<?php

// Bergamasco Jacopo, 5AIA, A.S. 2024-2025

// File: utils.php
// Insieme di utilità per la webapp.
// Contiene: 
// - Funzioni prestabilite per query al DB
// - Funzioni per il caricamento dei file

// ==================================== DB ====================================

// Inizializza la connessione al database nella variabile $db
$db = new mysqli("localhost", "jbergamo", "lozanusso", "galleriadb");

// Ottiene l'ID dell'utente dato il suo username
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

// Controlla se l'utente di un ID dato esiste nel db
function userExists($id) {
    global $db;
    $query = "SELECT *
              FROM utenti
              WHERE ID_utente = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc() != null;
}

// Verifica le credenziali di un utente
// Ritorna un bool che indica la riuscita autenticazione
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
        //              ^ La password criptata viene verificata con la funzione password_verify()
    } // In caso non esistano utenti nel db con tale ID l'autenticazione fallisce in automatico
    return false;
}

// Inserisce un nuovo utente nel db dati nome utente e password
function addUser($username, $password) {
    if (userExists(getUserID($username))) return false;
    // ^ Se esiste gia' un utente con quel nome ritorna un errore
    global $db;
    $query = "INSERT IGNORE INTO utenti (username, password_hash) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    // ^ La password viene criptata con un algoritmo di hashing e inserita nel database
    $stmt->bind_param("ss", $username, $hash);
    $stmt->execute();
    return true;
}

// ==================================== FILES ====================================

// Carica un file nel filesystem del server
// $file è il nome che il file assume nella richiesta POST
// La funzione ritorna un array codificato in forma [$target, $error],
//  in cui $target è il percorso del file salvato e $error è l'eventuale errore riscontrato durante l'esecuzione
function uploadFile($file) {
    $filename = $_FILES[$file]["name"];
    $dir = "uploads/";
    $upload = true;
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $target = $dir . date("Y-m-d-H-i-s") . "." . $ext;
    $size = $_FILES[$file]["size"];


    if ($size > 2 * 1024 * 1024) {  // 2MB in byte
        return [null, "Errore: il file è troppo grande. La dimensione massima è 2MB."];
    }

    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    if (!in_array($ext, $allowedTypes)) {
        return [null, "Errore: solo file con estensione JPG, JPEG, PNG, GIF sono permessi."];
    }

    if (file_exists($target)) {
        return [null, "Errore: il file esiste già."];
    }

    if (!$upload) {
        return [null, "Errore: il file non è stato caricato."];
    } else {
        if (!move_uploaded_file($_FILES[$file]["tmp_name"], $target)) {
            return [null, "Errore durante il caricamento del file."];
        }
    }

    return [$target, null];
}

// Ottiene il nome del file di un'immagine dato il suo ID
function getFileName($id) {
    global $db;
    $stmt = $db->prepare("SELECT data_upload
                          FROM immagini
                          WHERE ID_immagine = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()['data_upload'] ?? '';
}

// eof