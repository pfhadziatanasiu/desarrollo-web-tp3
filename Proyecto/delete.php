<?php
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/config/database.php';

try {
    $client = findClient($pdo);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        checkPostToken();
        $statement = $pdo->prepare('DELETE FROM clients WHERE id = :id');
        $statement->execute(['id' => $client['id']]);
        header('Location: index.php', true, 303);
        exit;
    }
} catch (PDOException $exception) {
    error_log($exception->getMessage());
    showError('No se pudo procesar la solicitud del cliente.', 500);
}
$pageTitle = 'Borrar cliente';
require __DIR__ . '/includes/header.php';
?>
<h1 class="h2 mb-3">Borrar cliente</h1>
<div class="card card-body">
    <p>¿Querés borrar al cliente <strong><?= escape($client['name'] . ' ' . $client['last_name']) ?></strong> (ID <?= escape($client['id']) ?>)?</p>
    <p class="text-danger">Esta acción no se puede deshacer.</p>
    <form method="post" class="d-flex gap-2">
        <input type="hidden" name="csrf_token" value="<?= escape($_SESSION['csrf_token']) ?>">
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-danger">Borrar cliente</button>
    </form>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
