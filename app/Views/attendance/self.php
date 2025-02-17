<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Registro de Asistencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white p-6">
    <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-xl shadow-xl">
        <h2 class="text-3xl font-bold text-center mb-6">Mi Registro de Asistencia</h2>

        <div class="space-y-4">
            <p><strong>Empleado:</strong> <?= session()->get('user_name') ?></p>
            <p><strong>Fecha de Hoy:</strong> <?= date('Y-m-d') ?></p>

            <?php if (!$attendance): ?>
                <a href="<?= base_url('/asistencia/entrada/' . session()->get('user_id')) ?>" 
                   class="block w-full text-center py-3 bg-green-600 text-white rounded-md hover:bg-green-700 transition-all">
                    ✅ Registrar Entrada
                </a>
            <?php elseif (!$attendance['check_out']): ?>
                <a href="<?= base_url('/asistencia/salida/' . $attendance['id']) ?>" 
                   class="block w-full text-center py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all">
                    ⏳ Registrar Salida
                </a>
            <?php else: ?>
                <p class="text-center text-green-400 font-bold">✔️ Asistencia completada</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Historial de Asistencia -->
    <div class="mt-8">
        <h3 class="text-xl font-bold mb-4">Historial de Asistencia (Últimos 7 días)</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-4 py-2 text-left">Fecha</th>
                    <th class="px-4 py-2 text-left">Entrada</th>
                    <th class="px-4 py-2 text-left">Salida</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $record): ?>
                    <tr class="border-b border-gray-700">
                        <td class="px-4 py-2"><?= date('d/m/Y', strtotime($record['check_in'])) ?></td>
                        <td class="px-4 py-2"><?= date('H:i', strtotime($record['check_in'])) ?></td>
                        <td class="px-4 py-2"><?= $record['check_out'] ? date('H:i', strtotime($record['check_out'])) : 'No registrada' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>