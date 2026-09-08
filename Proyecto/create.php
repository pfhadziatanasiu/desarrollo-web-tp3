<?php
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/config/database.php';

$client = [];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkPostToken();
    [$client, $errors] = validateClient($_POST, $fields);
    if (!$errors) {
        try {
            $statement = $pdo->prepare('INSERT INTO clients (name, last_name, email, phone, address, city, country) VALUES (:name, :last_name, :email, :phone, :address, :city, :country)');
            $statement->execute($client);
            header('Location: index.php', true, 303);
            exit;
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            $errors[] = 'No se pudo guardar el cliente. Intentá nuevamente.';
        }
    }
}
$pageTitle = 'Nuevo cliente';
$submitLabel = 'Guardar cliente';
require __DIR__ . '/includes/header.php';
?>
<h1 class="h2 mb-3">Nuevo cliente</h1>
<?php
require __DIR__ . '/includes/client_form.php';
require __DIR__ . '/includes/footer.php';
