<?php
$fields = [
    'name' => ['label' => 'Nombre', 'max' => 100, 'required' => true],
    'last_name' => ['label' => 'Apellido', 'max' => 100, 'required' => true],
    'email' => ['label' => 'Email', 'max' => 254, 'required' => true],
    'phone' => ['label' => 'Teléfono', 'max' => 30, 'required' => false],
    'address' => ['label' => 'Dirección', 'max' => 200, 'required' => false],
    'city' => ['label' => 'Ciudad', 'max' => 100, 'required' => false],
    'country' => ['label' => 'País', 'max' => 100, 'required' => false],
];

function escape($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function validateClient(array $input, array $fields): array
{
    $client = [];
    $errors = [];
    foreach ($fields as $key => $field) {
        $value = $input[$key] ?? '';
        $client[$key] = is_string($value) ? trim($value) : '';
        if (!is_string($value)) {
            $errors[] = $field['label'] . ': valor inválido.';
        } elseif ($field['required'] && $client[$key] === '') {
            $errors[] = $field['label'] . ': este campo es obligatorio.';
        } elseif (preg_match('//u', $client[$key]) !== 1) {
            $errors[] = $field['label'] . ': contiene caracteres inválidos.';
        } elseif (preg_match_all('/./us', $client[$key]) > $field['max']) {
            $errors[] = $field['label'] . ': el máximo es de ' . $field['max'] . ' caracteres.';
        }
    }
    if ($client['email'] !== '' && !filter_var($client['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Ingresá un email válido.';
    }
    return [$client, $errors];
}

function showError(string $message, int $status): void
{
    http_response_code($status);
    $pageTitle = 'Error';
    require __DIR__ . '/header.php';
    echo '<div class="alert alert-danger">' . escape($message) . '</div>';
    echo '<a class="btn btn-secondary" href="index.php">Volver a clientes</a>';
    require __DIR__ . '/footer.php';
    exit;
}

function findClient(PDO $pdo): array
{
    $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 4294967295],
    ]);
    if ($id === false) {
        showError('El ID del cliente no es válido.', 400);
    }
    $statement = $pdo->prepare('SELECT * FROM clients WHERE id = :id');
    $statement->execute(['id' => $id]);
    $client = $statement->fetch();
    if (!$client) {
        showError('El cliente no existe.', 404);
    }
    return $client;
}
