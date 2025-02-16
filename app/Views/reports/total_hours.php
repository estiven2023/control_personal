<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Total de Horas Trabajadas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reporte Total de Horas Trabajadas</h2>
    <p>Rango de fechas: <?= esc($_GET['start_date'] ?? '') ?> - <?= esc($_GET['end_date'] ?? '') ?></p>
    
    <table>
        <thead>
            <tr>
                <th>Nombre del Empleado</th>
                <th>Total de Horas Trabajadas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= esc($record['employee_name']) ?></td>
                    <td><?= esc($record['total_hours']) ?> horas</td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td><strong>Total General de Horas Trabajadas</strong></td>
                <td><strong><?= esc($grand_total) ?> horas</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
