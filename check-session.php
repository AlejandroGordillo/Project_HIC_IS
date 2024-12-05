<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo json_encode([
        'isLoggedIn' => true,
        'user' => [
            'username' => $_SESSION['usuario'],
            'email' => $_SESSION['email']
        ]
    ]);
} else {
    echo json_encode(['isLoggedIn' => false]);
}
?>