<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            AOS.init();
        });
    </script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 font-sans antialiased flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-400 to-blue-300 text-white shadow-xl sticky top-0 z-20" data-aos="fade-down" data-aos-duration="1200">
        <div class="container mx-auto flex justify-between items-center p-6">
            <h1 class="text-4xl font-extrabold tracking-wider">Registro de Asistencia</h1>
            <a href="<?= base_url('/cerrar-sesion') ?>" class="text-lg font-semibold hover:text-blue-200 transition-all duration-300 transform hover:scale-105">Cerrar Sesión</a>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="container mx-auto p-6 space-y-8 flex-grow">

        <!-- Menú de navegación -->
        <nav class="flex justify-center space-x-8 bg-gradient-to-r from-blue-500 to-blue-400 p-4 rounded-lg shadow-xl mb-8" data-aos="fade-left" data-aos-duration="1200">
            <a href="<?= base_url('/panel') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Inicio</a>
            <a href="<?= base_url('/empleados') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Empleados</a>
            <a href="<?= base_url('/asistencia') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Asistencia</a>
            <a href="<?= base_url('/reporte/filtro') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Reportes</a>
        </nav>

        <!-- Tabla de asistencia -->
        <section class="bg-white p-8 rounded-xl shadow-2xl bg-opacity-90 backdrop-blur-md" data-aos="fade-up" data-aos-duration="1200">
            <h3 class="text-2xl font-semibold text-center text-gray-800 mb-6">Registro de Asistencia</h3>

            <!-- Mensajes de éxito/error -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-300 rounded-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left text-gray-700">ID</th>
                            <th class="px-6 py-3 text-left text-gray-700">Empleado</th>
                            <th class="px-6 py-3 text-left text-gray-700">Entrada</th>
                            <th class="px-6 py-3 text-left text-gray-700">Salida</th>
                            <th class="px-6 py-3 text-left text-gray-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($attendanceRecords as $record): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-3"><?= $record['id'] ?></td>
                                <td class="px-6 py-3"><?= $record['name'] ?></td>
                                <td class="px-6 py-3"><?= $record['check_in'] ?: 'No registrado' ?></td>
                                <td class="px-6 py-3"><?= $record['check_out'] ?: 'No registrado' ?></td>
                                <td class="px-6 py-3">
                                    <?php if (!$record['check_in']): ?>
                                        <a href="<?= base_url('/asistencia/entrada/' . $record['id']) ?>" class="text-blue-600 hover:text-blue-800">📌 Check-in</a>
                                    <?php elseif (!$record['check_out']): ?>
                                        <a href="<?= base_url('/asistencia/salida/' . $record['id']) ?>" class="text-green-600 hover:text-green-800">✅ Check-out</a>
                                    <?php else: ?>
                                        🕒 Completado
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-8 mt-16 rounded-t-xl shadow-xl">
        <div class="container mx-auto text-center">
            <p class="text-lg font-medium">© 2025 Todos los derechos reservados | Registro de Asistencia</p>
            <p class="text-sm mt-2">Desarrollado por Pablo</p>
        </div>
    </footer>

</body>
</html>
