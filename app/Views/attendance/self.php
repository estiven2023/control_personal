<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Registro de Asistencia</title>
</head>
<body>
    <h2>Mi Registro de Asistencia</h2>

    <p>Empleado: <strong><?= session()->get('user_name') ?></strong></p>
    <p>Fecha de Hoy: <strong><?= date('Y-m-d') ?></strong></p>

    <?php if (!$attendance): ?>
        <a href="<?= base_url('/attendance/checkin/' . session()->get('user_id')) ?>">✅ Registrar Entrada</a>
    <?php elseif (!$attendance['check_out']): ?>
        <a href="<?= base_url('/attendance/checkout/' . $attendance['id']) ?>">⏳ Registrar Salida</a>
    <?php else: ?>
        <p>✔️ Asistencia completada</p>
    <?php endif; ?>
</body>
</html>
