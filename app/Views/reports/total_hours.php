<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Total de Horas Trabajadas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">
    <div class="w-full max-w-4xl p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl text-center text-green-600 font-semibold mb-6">Reporte Total de Horas Trabajadas</h2>
        <p class="text-center text-gray-700 mb-6 text-lg">Rango de fechas: <span class="font-bold"><?= esc($_GET['start_date'] ?? '') ?> - <?= esc($_GET['end_date'] ?? '') ?></span></p>
        
        <table class="min-w-full table-auto border-separate border-spacing-0">
            <thead>
                <tr class="bg-green-100 text-left">
                    <th class="px-6 py-3 text-sm font-medium text-gray-700">Nombre del Empleado</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-700">Total de Horas Trabajadas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800"><?= esc($record['employee_name']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-800"><?= esc($record['total_hours']) ?> horas</td>
                    </tr>
                <?php endforeach; ?>
                <tr class="border-t bg-gray-100 font-bold">
                    <td class="px-6 py-4 text-sm text-gray-800">Total General de Horas Trabajadas</td>
                    <td class="px-6 py-4 text-sm text-gray-800"><?= esc($grand_total) ?> horas</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
