<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white">
    <div class="w-full max-w-lg p-8 bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 animate-fadeIn">
        <h2 class="text-3xl font-bold text-center animate-bounceIn">Agregar Empleado</h2>

        <!-- Mostrar mensaje de éxito (si existe) -->
        <?php if (session('success')): ?>
            <div class="mb-4 p-3 bg-green-500 text-white rounded-md">
                <?= esc(session('success')) ?>
            </div>
        <?php endif; ?>

        <!-- Mostrar errores globales -->
        <?php if (session()->has('errors')): ?>
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/employees/store') ?>" method="post" class="space-y-6 mt-6">
            <?= csrf_field() ?> <!-- Token de seguridad -->

            <!-- Campo: Nombre -->
            <div class="relative">
                <label for="name" class="block text-gray-300">Nombre:</label>
                <input type="text" name="name" id="name" value="<?= old('name') ?>" required
                    class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-blue-500 outline-none
                    <?php if (isset(session('errors')['name'])): ?> border-red-500 <?php endif; ?>"
                    aria-describedby="name-error">
                
                <!-- Mostrar error específico para "name" -->
                <?php if (isset(session('errors')['name'])): ?>
                    <div id="name-error" class="text-red-500 text-sm mt-1"><?= esc(session('errors')['name']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Campo: Email -->
            <div class="relative">
                <label for="email" class="block text-gray-300">Email:</label>
                <input type="email" name="email" id="email" value="<?= old('email') ?>" required
                    class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-blue-500 outline-none
                    <?php if (isset(session('errors')['email'])): ?> border-red-500 <?php endif; ?>"
                    aria-describedby="email-error">
                
                <!-- Mostrar error específico para "email" -->
                <?php if (isset(session('errors')['email'])): ?>
                    <div id="email-error" class="text-red-500 text-sm mt-1"><?= esc(session('errors')['email']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Campo: Puesto -->
            <div class="relative">
                <label for="position" class="block text-gray-300">Puesto:</label>
                <input type="text" name="position" id="position" value="<?= old('position') ?>" required
                    class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-blue-500 outline-none
                    <?php if (isset(session('errors')['position'])): ?> border-red-500 <?php endif; ?>"
                    aria-describedby="position-error">
                
                <!-- Mostrar error específico para "position" -->
                <?php if (isset(session('errors')['position'])): ?>
                    <div id="position-error" class="text-red-500 text-sm mt-1"><?= esc(session('errors')['position']) ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" 
                class="w-full py-3 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                Guardar
            </button>
        </form>
    </div>
</body>
</html>
