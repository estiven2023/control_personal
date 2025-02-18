<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Reporte de Asistencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            AOS.init();
            
            // Validación para evitar fechas incorrectas
            const startDateInput = document.getElementById("start_date");
            const endDateInput = document.getElementById("end_date");

            startDateInput.addEventListener("change", function () {
                endDateInput.min = startDateInput.value;
            });

            endDateInput.addEventListener("change", function () {
                startDateInput.max = endDateInput.value;
            });
        });
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 flex items-center justify-center font-sans antialiased">

    <div class="bg-white p-8 rounded-xl shadow-2xl w-96 bg-opacity-90 backdrop-blur-md" data-aos="zoom-in" data-aos-duration="800">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Filtrar Reporte de Asistencia</h2>

        <form action="<?= base_url('/reporte/pdf') ?>" method="get" class="space-y-6">
            <div>
                <label for="start_date" class="block text-sm font-semibold text-gray-700">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date" required 
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition-all duration-300 bg-white bg-opacity-70">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-semibold text-gray-700">Fecha de Fin</label>
                <input type="date" name="end_date" id="end_date" required 
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition-all duration-300 bg-white bg-opacity-70">
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    📄 Generar PDF
                </button>
            </div>
        </form>
    </div>

</body>
</html>
