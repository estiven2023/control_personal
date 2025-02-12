<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Filtrar Reporte de Asistencia</title>
</head>
<body>
    <h2>Filtrar Reporte de Asistencia</h2>
    <form method="GET" action="<?= base_url('reporte/asistencia') ?>">
        <label for="employee_id">ID Empleado:</label>
        <input type="text" name="employee_id" id="employee_id">

        <label for="start_date">Fecha inicio:</label>
        <input type="date" name="start_date" id="start_date">

        <label for="end_date">Fecha fin:</label>
        <input type="date" name="end_date" id="end_date">

        <button type="submit">Generar PDF</button>
    </form>
</body>
</html>
