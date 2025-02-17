<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100">
    <!-- Barra de navegación -->
    <div class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Panel de Control</h1>
            <a href="<?= base_url('/cerrar-sesion') ?>" class="text-white hover:text-gray-200 transition-all duration-300">Cerrar Sesión</a>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Bienvenido, <?= session()->get('username') ?></h2>

        <!-- Menú de navegación -->
        <div class="mb-6 flex space-x-4">
            <a href="<?= base_url('/panel') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all duration-300">Inicio</a>
            <a href="<?= base_url('/empleados') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all duration-300">Empleados</a>
            <a href="<?= base_url('/asistencia') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all duration-300">Asistencia</a>
            <a href="<?= base_url('/reporte/asistencia') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all duration-300">Reportes</a>
        </div>

        <!-- Contenido del panel -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="text-gray-700">Este es el panel de control. Aquí puedes gestionar empleados, ver registros de asistencia y generar reportes.</p>
        </div>
    </div>
</body>
</html>