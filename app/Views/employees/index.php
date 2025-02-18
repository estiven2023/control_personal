<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 font-sans antialiased">

    <!-- Barra de navegación -->
    <header class="bg-gradient-to-r from-blue-400 to-blue-300 text-white shadow-xl sticky top-0 z-20" data-aos="fade-down" data-aos-duration="1200">
        <div class="container mx-auto flex justify-between items-center p-6">
            <h1 class="text-4xl font-extrabold tracking-wider">Listado de Empleados</h1>
            <a href="<?= base_url('/cerrar-sesion') ?>" class="text-lg font-semibold hover:text-blue-200 transition-all duration-300 transform hover:scale-105">Cerrar Sesión</a>
        </div>
    </header>

    <main class="container mx-auto p-6 space-y-8">
        <!-- Bienvenida -->
        <section data-aos="fade-up" data-aos-duration="1200">
            <h2 class="text-3xl font-semibold text-gray-800 text-center">Bienvenido, <?= session()->get('username') ?></h2>
        </section>

        <!-- Menú de navegación (Navbar) -->
        <nav class="flex justify-center space-x-8 bg-gradient-to-r from-blue-500 to-blue-400 p-4 rounded-lg shadow-xl mb-8" data-aos="fade-left" data-aos-duration="1200">
            <a href="<?= base_url('/panel') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Inicio</a>
            <a href="<?= base_url('/empleados') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Empleados</a>
            <a href="<?= base_url('/asistencia') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Asistencia</a>
            <a href="<?= base_url('/reporte/filtro') ?>" class="text-white text-lg font-medium hover:text-gray-200 transition-all duration-300 transform hover:scale-110">Reportes</a>
        </nav>

        <!-- Botón para crear un nuevo empleado -->
        <section class="flex justify-between mb-6">
            <a href="<?= base_url('/empleados/crear') ?>" class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-110">Crear Empleado</a>
            <form action="<?= base_url('/empleados') ?>" method="get" class="flex items-center space-x-4">
                <input type="text" name="search" placeholder="Buscar empleados..." class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 bg-white bg-opacity-70 transition-all duration-300 ease-in-out">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-110">Buscar</button>
            </form>
        </section>

        <!-- Tabla de empleados -->
        <section class="bg-white p-8 rounded-xl shadow-2xl bg-opacity-90 backdrop-blur-md" data-aos="fade-up" data-aos-duration="1200">
            <table class="w-full table-auto border-collapse">
                <thead class="text-sm bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Nombre</th>
                        <th class="px-6 py-4 text-left">Correo Electrónico</th>
                        <th class="px-6 py-4 text-left">Puesto</th>
                        <th class="px-6 py-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <?php foreach ($employees as $employee): ?>
                    <tr class="odd:bg-white even:bg-gray-50 hover:bg-blue-50 transition-all duration-300">
                        <td class="px-6 py-4"><?= $employee['name'] ?></td>
                        <td class="px-6 py-4"><?= $employee['email'] ?></td>
                        <td class="px-6 py-4"><?= $employee['position'] ?></td>
                        <td class="px-6 py-4 space-x-4">
                            <a href="<?= base_url('/empleados/editar/' . $employee['id']) ?>" class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 transition-all duration-300 transform hover:scale-110">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="<?= base_url('/empleados/eliminar/' . $employee['id']) ?>" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-all duration-300 transform hover:scale-110">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="mt-6 flex justify-center">
                <div class="bg-blue-500 text-white py-2 px-4 rounded-md">
                    <?= $pager->links() ?>
                </div>
            </div>
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
        AOS.init();
    </script>
</body>
</html>