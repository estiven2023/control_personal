<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 font-sans antialiased">

    <!-- Barra de navegación -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-xl sticky top-0 z-20" data-aos="fade-down" data-aos-duration="1200">
        <div class="container mx-auto flex justify-between items-center p-6">
            <h1 class="text-4xl font-extrabold tracking-wider">Agregar Empleado</h1>
            <a href="<?= base_url('/cerrar-sesion') ?>" class="text-lg font-semibold hover:text-blue-200 transition-all duration-300 transform hover:scale-105">Cerrar Sesión</a>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="container mx-auto p-6 space-y-8">

        <!-- Bienvenida -->
        <section data-aos="fade-up" data-aos-duration="1200">
            <h2 class="text-3xl font-semibold text-gray-800 text-center">Bienvenido, <?= session()->get('username') ?></h2>
        </section>

        <!-- Menú de navegación -->
        <nav class="flex justify-center space-x-8 bg-gradient-to-r from-blue-500 to-blue-400 p-4 rounded-lg shadow-xl mb-8" data-aos="fade-left" data-aos-duration="1200">
            <a href="<?= base_url('/panel') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Inicio</a>
            <a href="<?= base_url('/empleados') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Empleados</a>
            <a href="<?= base_url('/asistencia') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Asistencia</a>
            <a href="<?= base_url('/reporte/filtro') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Reportes</a>
        </nav>

        <!-- Formulario para agregar empleado -->
        <section class="bg-white p-8 rounded-xl shadow-2xl bg-opacity-90 backdrop-blur-md" data-aos="fade-up" data-aos-duration="1200">
            <h3 class="text-2xl font-semibold text-gray-800 text-center">Formulario de Empleado</h3>
            
            <!-- Mostrar mensaje de éxito (si existe) -->
            <?php if (session('success')): ?>
                <div class="mb-4 p-3 bg-green-500 text-white rounded-md shadow-lg">
                    <?= esc(session('success')) ?>
                </div>
            <?php endif; ?>

            <!-- Mostrar errores globales -->
            <?php if (session()->has('errors')): ?>
                <div class="bg-red-500 text-white p-3 rounded mb-4 shadow-lg">
                    <ul>
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/empleados/guardar') ?>" method="post" class="space-y-6 mt-6">
                <?= csrf_field() ?> <!-- Token de seguridad -->

                <!-- Campo: Nombre -->
                <div class="relative">
                    <label for="name" class="block text-gray-700">Nombre:</label>
                    <input type="text" name="name" id="name" value="<?= old('name') ?>" required
                        class="w-full px-4 py-3 mt-1 bg-white border border-gray-300 rounded-md text-gray-800 focus:ring-2 focus:ring-blue-500 outline-none transition-all duration-300">
                </div>

                <!-- Campo: Email -->
                <div class="relative">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" value="<?= old('email') ?>" required
                        class="w-full px-4 py-3 mt-1 bg-white border border-gray-300 rounded-md text-gray-800 focus:ring-2 focus:ring-blue-500 outline-none transition-all duration-300">
                </div>

                <!-- Campo: Puesto -->
                <div class="relative">
                    <label for="position" class="block text-gray-700">Puesto:</label>
                    <input type="text" name="position" id="position" value="<?= old('position') ?>" required
                        class="w-full px-4 py-3 mt-1 bg-white border border-gray-300 rounded-md text-gray-800 focus:ring-2 focus:ring-blue-500 outline-none transition-all duration-300">
                </div>

                <button type="submit" 
                    class="w-full py-3 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                    Guardar
                </button>
            </form>
        </section>
        
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-8 mt-16 rounded-t-xl shadow-xl">
        <div class="container mx-auto text-center">
            <p class="text-lg font-medium">© 2025 Todos los derechos reservados | Panel de Control</p>
            <p class="text-sm mt-2">Desarrollado por Pablo</p>
        </div>
    </footer>

    <script>
        AOS.init(); // Inicia las animaciones AOS
    </script>

</body>
</html>
