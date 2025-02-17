<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Asistencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Registro de Asistencia</h2>

        <!-- Mensajes de éxito/error -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Tabla de asistencia -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Empleado</th>
                        <th class="px-4 py-2 text-left">Entrada</th>
                        <th class="px-4 py-2 text-left">Salida</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendanceRecords as $record): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?= $record['id'] ?></td>
                            <td class="px-4 py-2"><?= $record['name'] ?></td>
                            <td class="px-4 py-2"><?= $record['check_in'] ?: 'No registrado' ?></td>
                            <td class="px-4 py-2"><?= $record['check_out'] ?: 'No registrado' ?></td>
                            <td class="px-4 py-2">
                                <?php if (!$record['check_in']): ?>
                                    <a href="<?= base_url('/asistencia/entrada/' . $record['id']) ?>" class="text-blue-600 hover:text-blue-800">📌 Check-in</a>
                                <?php elseif (!$record['check_out']): ?>
                                    <a href="<?= base_url('/asistencia/salida/' . $record['id']) ?>" class="text-green-600 hover:text-green-800">✅ Check-out</a>
                                <?php else: ?>
                                    🕒 Completado
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>