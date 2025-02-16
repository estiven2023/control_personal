<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencia</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reporte de Asistencia</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre del Empleado</th>
                <th>Fecha de Entrada</th>
                <th>Fecha de Salida</th>
                <th>Horas Trabajadas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= esc($record['employee_name']) ?></td>
                    <td><?= esc($record['check_in']) ?></td>
                    <td><?= esc($record['check_out']) ?></td>
                    <td><?= esc($record['hours_worked']) ?> horas</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
