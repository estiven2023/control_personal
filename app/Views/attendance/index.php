<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white p-6">
    <div class="max-w-5xl mx-auto bg-gray-800 p-6 rounded-xl shadow-xl border border-gray-700 animate-fadeIn">
        <h2 class="text-3xl font-bold text-center mb-6">Registro de Asistencia</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-gray-700 rounded-lg overflow-hidden">
                <thead class="bg-gray-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Empleado</th>
                        <th class="px-4 py-3 text-left">Hora de Entrada</th>
                        <th class="px-4 py-3 text-left">Hora de Salida</th>
                        <th class="px-4 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($attendanceRecords)): ?>  <!-- Cambié $records por $attendanceRecords -->
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-400">No hay registros de asistencia.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($attendanceRecords as $record): ?>  <!-- Cambié $records por $attendanceRecords -->
                        <tr class="border-b border-gray-600 hover:bg-gray-800 transition-all">
                            <td class="px-4 py-3"><?= $record['id'] ?></td>
                            <td class="px-4 py-3"><?= $record['name'] ?></td>
                            <td class="px-4 py-3"><?= $record['check_in'] ?: 'No registrado' ?></td>
                            <td class="px-4 py-3"><?= $record['check_out'] ?: 'No registrado' ?></td>
                            <td class="px-4 py-3">
                                <?php if (!$record['check_in']): ?>
                                    <a href="<?= base_url('/attendance/checkin/' . $record['id']) ?>" 
                                       class="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700 transition-all">
                                        ✅ Registrar Entrada
                                    </a>
                                <?php elseif (!$record['check_out']): ?>
                                    <a href="<?= base_url('/attendance/checkout/' . $record['id']) ?>" 
                                       class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all">
                                        ⏳ Registrar Salida
                                    </a>
                                <?php else: ?>
                                    <span class="text-green-400 font-bold">✔️ Asistencia completada</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
