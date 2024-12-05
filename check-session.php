<?php
session_start();

function checkSession() {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        $response = [
            'authenticated' => false,
            'redirect' => '/Project_HIC_IS/Login_Register/index.html'
        ];
        echo json_encode($response);
        exit();
    }
    
    return [
        'authenticated' => true,
        'user' => [
            'username' => $_SESSION['usuario'],
            'email' => $_SESSION['email']
        ]
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(checkSession());
}
?>
