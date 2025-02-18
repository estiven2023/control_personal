<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes glow {
            0% { box-shadow: 0 0 10px rgba(37, 99, 235, 0.6); }
            50% { box-shadow: 0 0 15px rgba(37, 99, 235, 0.8); }
            100% { box-shadow: 0 0 10px rgba(37, 99, 235, 0.6); }
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        .glow {
            animation: glow 2s ease-in-out infinite;
        }

        /* Neblina de fondo con malla difusa */
        .bg-neblina {
            background: url('<?= base_url("/fondo3.png") ?>') center/cover no-repeat, rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            position: relative;
        }

        /* Fondo difuso con malla */
        .bg-neblina:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');
            opacity: 0.1;
        }

        /* Estilos mejorados para los campos de entrada */
        .input-field {
            background-color: rgba(37, 99, 235, 0.2);
            color: white;
            padding: 15px 20px;
            font-size: 1.125rem;
            border-radius: 9999px;
            border: 1px solid rgba(37, 99, 235, 0.4);
            outline: none;
            transition: all 0.3s ease;
            width: 100%;
            backdrop-filter: blur(5px);
        }

        .input-field:focus {
            border-color: rgba(37, 99, 235, 1);
            box-shadow: 0 0 10px rgba(37, 99, 235, 0.8);
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Estilo de botón de inicio de sesión */
        .submit-button {
            transition: all 0.3s ease;
        }

        .submit-button:hover {
            background-color: #2563eb;
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.8);
            transform: scale(1.05);
        }
    </style>
</head>
<body class="flex h-screen w-full items-center justify-center bg-neblina">

    <!-- Contenedor con fondo difuso y neblina -->
    <div class="relative rounded-xl bg-gray-900 bg-opacity-60 px-16 py-12 shadow-2xl backdrop-blur-lg max-sm:px-8 border border-gray-700 fade-in">
        <div class="absolute inset-0 bg-black bg-opacity-50 rounded-xl"></div>
        <div class="relative z-10 text-center">
            <div class="mb-8 flex flex-col items-center">
                <img src="<?= base_url('/logo.svg') ?>" width="150" alt="Logo Empresa" class="mb-4" />
                
                <h1 class="mb-4 text-4xl font-extrabold text-blue-400 glow">Acceso Empresarial</h1>
                <span class="text-gray-300 text-lg mb-6">Ingrese sus credenciales para continuar</span>
            </div>
            
            <!-- Mostrar mensajes de error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-500 bg-opacity-70 text-white px-4 py-2 rounded-lg mb-4 text-center border border-red-700 animate-bounce">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <!-- Formulario -->
            <form action="<?= base_url('/autenticar') ?>" method="post" class="space-y-6">
                <div class="text-lg">
                    <input class="input-field" type="text" name="username" placeholder="Usuario" required />
                </div>
                <div class="text-lg">
                    <input class="input-field" type="password" name="password" placeholder="Contraseña" required />
                </div>
                <div class="mt-8 flex justify-center text-lg">
                    <button type="submit" class="submit-button rounded-xl bg-blue-600 text-white px-12 py-3 font-semibold shadow-xl backdrop-blur-md">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
