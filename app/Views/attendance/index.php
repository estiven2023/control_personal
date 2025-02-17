<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Asistencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">
    <div class="max-w-5xl mx-auto p-6 rounded-xl bg-gray-800 shadow-xl">
        <h2 class="text-3xl font-bold text-center mb-6">Registro de Asistencia</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-600 p-4 mb-4 rounded-md"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-600 p-4 mb-4 rounded-md"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <table class="w-full border-collapse bg-gray-700 rounded-lg overflow-hidden">
            <thead class="bg-gray-600">
                <tr>
                    <th>ID</th><th>Empleado</th><th>Entrada</th><th>Salida</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendanceRecords as $record): ?>
                    <tr class="border-b border-gray-600">
                        <td><?= $record['id'] ?></td>
                        <td><?= $record['name'] ?></td>
                        <td><?= $record['check_in'] ?: 'No registrado' ?></td>
                        <td><?= $record['check_out'] ?: 'No registrado' ?></td>
                        <td>
                            <?php 
                            $checkIn = $record['check_in'] ?? null;
                            $checkOut = $record['check_out'] ?? null;

                            if (!$checkIn): ?>
                                <a href="<?= base_url('/asistencia/entrada/' . $record['id']) ?>" class="text-blue-600">📌 Check-in</a>
                            <?php elseif (!$checkOut): ?>
                                <a href="<?= base_url('/asistencia/salida/' . $record['id']) ?>" class="text-green-600">✅ Check-out</a>
                            <?php else: ?>
                                🕒 Completado
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
