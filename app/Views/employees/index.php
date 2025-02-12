<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white p-6">
    <div class="max-w-5xl mx-auto bg-gray-800 p-6 rounded-xl shadow-xl border border-gray-700 animate-fadeIn">
        <h2 class="text-3xl font-bold text-center mb-6">Lista de empleados</h2>
        
        <div class="flex justify-end mb-4">
            <a href="<?= base_url('/employees/create') ?>" 
                class="px-6 py-2 text-lg font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all duration-300">
                Agregar empleado
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-gray-700 rounded-lg overflow-hidden">
                <thead class="bg-gray-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Nombre</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Puesto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                    <tr class="border-b border-gray-600 hover:bg-gray-800 transition-all">
                        <td class="px-4 py-3"> <?= $employee['id'] ?> </td>
                        <td class="px-4 py-3"> <?= $employee['name'] ?> </td>
                        <td class="px-4 py-3"> <?= $employee['email'] ?> </td>
                        <td class="px-4 py-3"> <?= $employee['position'] ?> </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>