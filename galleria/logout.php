<?php

// Bergamasco Jacopo, 5AIA, A.S. 2024-2025
// File: logout.php
// Esegue il logout dell'utente, eliminando la sessione e reindirizzando l'utente alla home page

session_start();

session_destroy();

header('Location: index.php');

// eof