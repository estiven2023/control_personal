<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 font-sans antialiased">

    <!-- Barra de navegación -->
    <header class="bg-gradient-to-r from-blue-400 to-blue-300 text-white shadow-xl sticky top-0 z-20" data-aos="fade-down" data-aos-duration="1200">
        <div class="container mx-auto flex justify-between items-center p-6">
            <h1 class="text-4xl font-extrabold tracking-wider">Panel de Control</h1>
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

        <!-- Sección de reportes -->
        <section class="bg-white p-8 rounded-xl shadow-2xl space-y-8 bg-opacity-90 backdrop-blur-md" data-aos="fade-up" data-aos-duration="1200">
            <h3 class="text-2xl font-semibold text-gray-800 text-center">Generar Reportes</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <form action="<?= base_url('/reporte/asistencia') ?>" method="GET" class="space-y-4">
                    <div class="flex flex-col">
                        <label for="fecha_inicio" class="text-sm text-gray-600 font-semibold">Fecha de inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" required class="border-2 border-gray-300 rounded-lg p-4 text-lg focus:ring-2 focus:ring-blue-400 transition-all duration-300 ease-in-out bg-white bg-opacity-70">
                    </div>
                    <div class="flex flex-col">
                        <label for="fecha_fin" class="text-sm text-gray-600 font-semibold">Fecha de fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" required class="border-2 border-gray-300 rounded-lg p-4 text-lg focus:ring-2 focus:ring-blue-400 transition-all duration-300 ease-in-out bg-white bg-opacity-70">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-110">Ver Reporte</button>
                </form>
                <form action="<?= base_url('/reporte/pdf') ?>" method="GET" class="space-y-4">
                    <div class="flex flex-col">
                        <label for="fecha_inicio_pdf" class="text-sm text-gray-600 font-semibold">Fecha de inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio_pdf" required class="border-2 border-gray-300 rounded-lg p-4 text-lg focus:ring-2 focus:ring-blue-400 transition-all duration-300 ease-in-out bg-white bg-opacity-70">
                    </div>
                    <div class="flex flex-col">
                        <label for="fecha_fin_pdf" class="text-sm text-gray-600 font-semibold">Fecha de fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin_pdf" required class="border-2 border-gray-300 rounded-lg p-4 text-lg focus:ring-2 focus:ring-blue-400 transition-all duration-300 ease-in-out bg-white bg-opacity-70">
                    </div>
                    <button type="submit" class="w-full bg-blue-700 text-white py-4 rounded-lg hover:bg-blue-800 transition-all duration-300 transform hover:scale-110">Descargar PDF</button>
                </form>
            </div>
        </section>

        <!-- Gráfico de asistencias -->
        <section class="bg-white p-8 rounded-xl shadow-2xl bg-opacity-90 backdrop-blur-md" data-aos="fade-up" data-aos-duration="1200">
            <h3 class="text-2xl font-semibold text-center text-gray-800 mb-6">Gráfico de Asistencias</h3>
            <canvas id="attendanceChart"></canvas>
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
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($attendanceStats, 'date')) ?>,
                datasets: [{
                    label: 'Asistencias por Día',
                    data: <?= json_encode(array_column($attendanceStats, 'total_attendances')) ?>,
                    backgroundColor: 'rgba(37, 99, 235, 0.3)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true },
                    x: { grid: { display: false } }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        AOS.init(); // Inicia las animaciones AOS
    </script>

</body>
</html>
