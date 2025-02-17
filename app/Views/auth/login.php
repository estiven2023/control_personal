<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
    </style>
</head>
<body class="flex h-screen w-full items-center justify-center bg-black bg-cover bg-no-repeat" 
    style="background-image: url('<?= base_url('/fondo2.jpg') ?>')">
    
    <div class="rounded-xl bg-gray-900 bg-opacity-80 px-16 py-12 shadow-2xl backdrop-blur-lg max-sm:px-8 border border-gray-700 fade-in">
        <div class="text-white text-center">
            <div class="mb-8 flex flex-col items-center">
                <img src="<?= base_url('/logo.svg') ?>" width="150" alt="Empresa Logo" 
                    class="mb-4 animate-pulse" />
                
                <h1 class="mb-2 text-4xl font-bold tracking-wide text-blue-400">Acceso Empresarial</h1>
                <span class="text-gray-300 text-lg">Ingrese sus credenciales para continuar</span>
            </div>
            
            <!-- Mostrar mensajes de error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-500 bg-opacity-70 text-white px-4 py-2 rounded-lg mb-4 text-center border border-red-700 animate-bounce">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= base_url('/autenticar') ?>" method="post" class="space-y-6">
                <div class="text-lg">
                    <input class="rounded-xl border-none bg-blue-600 bg-opacity-40 px-6 py-3 text-center text-white placeholder-gray-300 shadow-lg outline-none backdrop-blur-md w-full focus:ring-2 focus:ring-blue-400 transition-all duration-300 hover:scale-105" 
                        type="text" name="username" placeholder="Usuario" required />
                </div>
                <div class="text-lg">
                    <input class="rounded-xl border-none bg-blue-600 bg-opacity-40 px-6 py-3 text-center text-white placeholder-gray-300 shadow-lg outline-none backdrop-blur-md w-full focus:ring-2 focus:ring-blue-400 transition-all duration-300 hover:scale-105" 
                        type="password" name="password" placeholder="Contraseña" required />
                </div>
                <div class="mt-8 flex justify-center text-lg">
                    <button type="submit" class="rounded-xl bg-blue-500 bg-opacity-70 px-12 py-3 text-white font-semibold shadow-xl backdrop-blur-md transition-transform duration-300 hover:bg-blue-700 hover:scale-110 hover:shadow-2xl">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
