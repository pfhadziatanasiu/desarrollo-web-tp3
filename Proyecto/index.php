<?php
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/config/database.php';

try {
    $statement = $pdo->prepare('SELECT id, name, last_name, email, phone, address, city, country, created_at, updated_at FROM clients ORDER BY id DESC');
    $statement->execute();
    $clients = $statement->fetchAll();
} catch (PDOException $exception) {
    error_log($exception->getMessage());
    showError('No se pudo cargar el listado de clientes.', 500);
}
$pageTitle = 'Clientes';
require __DIR__ . '/includes/header.php';
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <h1 class="h2 mb-0">Clientes</h1>
    <a class="btn btn-primary" href="create.php">+ Nuevo cliente</a>
</div>
<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <?php foreach ($fields as $field): ?>
                    <th scope="col"><?= escape($field['label']) ?></th>
                <?php endforeach; ?>
                <th scope="col">Fecha de alta</th>
                <th scope="col">Última modificación</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= escape($client['id']) ?></td>
                    <?php foreach ($fields as $key => $field): ?>
                        <td><?= escape($client[$key]) ?></td>
                    <?php endforeach; ?>
                    <td class="text-nowrap"><?= escape($client['created_at']) ?></td>
                    <td class="text-nowrap"><?= escape($client['updated_at']) ?></td>
                    <td class="text-nowrap">
                        <a class="btn btn-sm btn-outline-primary" href="edit.php?id=<?= escape($client['id']) ?>">Modificar</a>
                        <a class="btn btn-sm btn-outline-danger" href="delete.php?id=<?= escape($client['id']) ?>">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$clients): ?>
                <tr><td colspan="11" class="text-center text-secondary py-4">No hay clientes registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
