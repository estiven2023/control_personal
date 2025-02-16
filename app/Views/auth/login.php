<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        fadeIn: "fadeIn 1s ease-in-out",
                        bounceIn: "bounceIn 0.8s ease-in-out",
                        pulseSlow: "pulse 2s infinite"
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        bounceIn: {
                            '0%': { transform: 'scale(0.8)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' }
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900">
    <div class="w-full max-w-md p-8 space-y-6 bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 animate-fadeIn relative">
        <div class="absolute top-0 left-0 w-full h-1 bg-blue-500 rounded-t-xl animate-pulseSlow"></div>
        <h2 class="text-3xl font-extrabold text-center text-white animate-bounceIn">Bienvenido</h2>
        
        <?php if (session()->getFlashdata('error')): ?>
            <p class="text-red-500 text-sm text-center animate-fadeIn"><?= session()->getFlashdata('error') ?></p>
        <?php endif; ?>

        <form action="<?= base_url('/auth') ?>" method="post" class="space-y-6">
            <div class="animate-fadeIn" style="animation-delay: 0.2s;">
                <label class="block text-gray-300">Usuario:</label>
                <input type="text" name="username" required 
                    class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300">
            </div>
            
            <div class="animate-fadeIn" style="animation-delay: 0.4s;">
                <label class="block text-gray-300">Contraseña:</label>
                <input type="password" name="password" required 
                    class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300">
            </div>
            
            <button type="submit" 
                class="w-full py-3 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 animate-bounceIn" style="animation-delay: 0.6s;">Ingresar</button>
        </form>
    </div>
</body>
</html>
