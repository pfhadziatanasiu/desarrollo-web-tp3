<?php
$host = '127.0.0.1';
$database = 'clima_integral';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $exception) {
    error_log($exception->getMessage());
    http_response_code(500);
    $pageTitle = 'Error de conexión';
    require __DIR__ . '/../includes/header.php';
    echo '<div class="alert alert-danger">No se pudo conectar con la base de datos. Revisá la configuración y que MySQL esté iniciado.</div>';
    require __DIR__ . '/../includes/footer.php';
    exit;
}
