<?php

$db = new mysqli('localhost', 'root', '', 'userlogin');

function checkLogin($email, $password) {
    global $db;
    $query = "SELECT id FROM account WHERE email = ? AND pwd = md5(?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['id'] ?? false;
}