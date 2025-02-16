<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white">
    <div class="flex flex-col items-center justify-center min-h-screen p-6">
        <div class="w-full max-w-2xl p-8 bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 animate-fadeIn text-center">
            <h1 class="text-4xl font-bold animate-bounceIn">Bienvenido al Dashboard</h1>
            <p class="mt-4 text-lg text-gray-300">Has iniciado sesión correctamente.</p>
            
            <a href="<?= base_url('logout'); ?>" 
                class="inline-block mt-6 px-6 py-3 text-lg font-semibold text-white bg-red-600 rounded-md shadow-md hover:bg-red-700 transition-all duration-300 transform hover:scale-105">
                Cerrar sesión
            </a>
        </div>
    </div>
</body>
</html>
