<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Panel de Control</h1>
            <a href="<?= base_url('/cerrar-sesion') ?>" class="text-white hover:text-gray-200">Cerrar Sesión</a>
        </div>
    </div>

    <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Bienvenido, <?= session()->get('username') ?></h2>

        <!-- Menú de navegación -->
        <div class="mb-6">
            <a href="<?= base_url('/panel') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Inicio</a>
            <a href="<?= base_url('/empleados') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Empleados</a>
            <a href="<?= base_url('/asistencia') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Asistencia</a>
            <a href="<?= base_url('/reporte/asistencia') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Reportes</a>
        </div>

        <!-- Contenido del panel de control -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p>Este es el panel de control. Aquí puedes gestionar empleados, ver registros de asistencia y generar reportes.</p>
        </div>
    </div>
</body>
</html>