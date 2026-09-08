<?php
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/config/database.php';

try {
    $client = findClient($pdo);
} catch (PDOException $exception) {
    error_log($exception->getMessage());
    showError('No se pudo cargar el cliente.', 500);
}
$id = $client['id'];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkPostToken();
    [$client, $errors] = validateClient($_POST, $fields);
    if (!$errors) {
        try {
            $statement = $pdo->prepare('UPDATE clients SET name = :name, last_name = :last_name, email = :email, phone = :phone, address = :address, city = :city, country = :country WHERE id = :id');
            $statement->execute(array_merge($client, ['id' => $id]));
            header('Location: index.php', true, 303);
            exit;
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            $errors[] = 'No se pudieron guardar los cambios. Intentá nuevamente.';
        }
    }
}
$pageTitle = 'Modificar cliente';
$submitLabel = 'Guardar cambios';
require __DIR__ . '/includes/header.php';
?>
<h1 class="h2 mb-3">Modificar cliente</h1>
<?php
require __DIR__ . '/includes/client_form.php';
require __DIR__ . '/includes/footer.php';
