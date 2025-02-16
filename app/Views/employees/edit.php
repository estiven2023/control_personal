<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-900 text-white p-6">
    <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-xl shadow-xl">
        <h2 class="text-3xl font-bold text-center mb-6">Editar Empleado</h2>

        <form action="<?= base_url('/employees/update/' . $employee['id']) ?>" method="post" onsubmit="return validateForm()">
            <label class="block text-gray-300">Nombre:</label>
            <input type="text" id="name" name="name" value="<?= $employee['name'] ?>" required minlength="3" maxlength="100"
                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">

            <label class="block text-gray-300">Email:</label>
            <input type="email" id="email" name="email" value="<?= $employee['email'] ?>" required
                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">

            <label class="block text-gray-300">Cargo:</label>
            <input type="text" id="position" name="position" value="<?= $employee['position'] ?>" required minlength="3" maxlength="50"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">

            <button type="submit" class="w-full py-3 mt-4 bg-blue-600 rounded-md hover:bg-blue-700">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
