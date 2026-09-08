<?php if ($errors): ?>
    <div class="alert alert-danger" role="alert">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= escape($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="post" class="card card-body">
    <input type="hidden" name="csrf_token" value="<?= escape($_SESSION['csrf_token']) ?>">
    <p class="text-secondary">Los campos con * son obligatorios.</p>
    <div class="row g-3">
        <?php foreach ($fields as $key => $field): ?>
            <div class="col-md-6">
                <label for="<?= escape($key) ?>" class="form-label"><?= escape($field['label']) ?><?= $field['required'] ? ' *' : '' ?></label>
                <input class="form-control" id="<?= escape($key) ?>" name="<?= escape($key) ?>"
                    type="<?= $key === 'email' ? 'email' : ($key === 'phone' ? 'tel' : 'text') ?>"
                    value="<?= escape($client[$key] ?? '') ?>" maxlength="<?= $field['max'] ?>"
                    <?= $field['required'] ? 'required' : '' ?>>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex gap-2 mt-4">
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary"><?= escape($submitLabel) ?></button>
    </div>
</form>
