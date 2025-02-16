<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-900 text-white p-6">
    <div class="max-w-4xl mx-auto bg-gray-800 p-6 rounded-xl shadow-xl">
        <h2 class="text-3xl font-bold text-center mb-6">Lista de Empleados</h2>
        
        <form method="get" action="<?= base_url('/employees') ?>" class="mb-4 flex">
            <input type="text" name="search" placeholder="Buscar empleados..." value="<?= esc($search) ?>" class="px-4 py-2 w-full text-black rounded-l-md">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Buscar</button>
        </form>

        <a href="<?= base_url('/employees/create') ?>" class="mb-4 inline-block px-4 py-2 bg-green-600 rounded-md hover:bg-green-700">
            ➕ Nuevo Empleado
        </a>

        <table class="w-full border-collapse bg-gray-700 rounded-lg overflow-hidden">
            <thead class="bg-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Nombre</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Cargo</th>
                    <th class="px-4 py-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($employees)): ?>
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-gray-400">No hay empleados registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($employees as $employee): ?>
                        <tr class="border-b border-gray-600 hover:bg-gray-800 transition-all">
                            <td class="px-4 py-3"><?= $employee['id'] ?></td>
                            <td class="px-4 py-3"><?= $employee['name'] ?></td>
                            <td class="px-4 py-3"><?= $employee['email'] ?></td>
                            <td class="px-4 py-3"><?= $employee['position'] ?></td>
                            <td class="px-4 py-3 flex space-x-2">
                                <a href="<?= base_url('/employees/edit/' . $employee['id']) ?>" 
                                   class="px-3 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                    ✏️ Editar
                                </a>
                                <form action="<?= base_url('/employees/delete/' . $employee['id']) ?>" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar este empleado?');">
                                    <button type="submit" class="px-3 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        
        <div class="mt-4">
            <?= $pager->links() ?>
        </div>
    </div>
</body>
</html>
