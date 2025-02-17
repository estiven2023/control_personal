<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Listado de Empleados</h1>
            <a href="<?= base_url('/cerrar-sesion') ?>" class="text-white hover:text-gray-200">Cerrar Sesión</a>
        </div>
    </div>

    <div class="container mx-auto p-4">
        <!-- Botón para crear un nuevo empleado -->
        <a href="<?= base_url('/empleados/crear') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Crear Empleado</a>

        <!-- Barra de búsqueda -->
        <form action="<?= base_url('/empleados') ?>" method="get" class="my-4">
            <input type="text" name="search" placeholder="Buscar empleados..." class="px-4 py-2 border border-gray-300 rounded-md">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Buscar</button>
        </form>

        <!-- Tabla de empleados -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Correo Electrónico</th>
                        <th class="px-4 py-2">Puesto</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td class="px-4 py-2"><?= $employee['name'] ?></td>
                        <td class="px-4 py-2"><?= $employee['email'] ?></td>
                        <td class="px-4 py-2"><?= $employee['position'] ?></td>
                        <td class="px-4 py-2">
                            <a href="<?= base_url('/empleados/editar/' . $employee['id']) ?>" class="bg-yellow-500 text-white px-2 py-1 rounded-md hover:bg-yellow-600">Editar</a>
                            <a href="<?= base_url('/empleados/eliminar/' . $employee['id']) ?>" class="bg-red-600 text-white px-2 py-1 rounded-md hover:bg-red-700">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="mt-4">
                <?= $pager->links() ?>
            </div>
        </div>
    </div>
</body>
</html>