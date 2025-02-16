<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de sesión</title>
</head>
<body>
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success">
            <?= session('success'); ?>
        </div>
    <?php endif; ?>
</body>
</html>
