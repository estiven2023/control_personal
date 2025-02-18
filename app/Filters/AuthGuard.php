<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario está autenticado
        $session = session();

        // Si no está autenticado, redirigir al inicio de sesión
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        // Si se necesita, puedes agregar más lógica aquí para roles específicos
        if (isset($arguments[0]) && $arguments[0] == 'admin') {
            // Solo permitir acceso a administradores
            if ($session->get('role') !== 'admin') {
                return redirect()->to('/iniciar-sesion');
            }
        }

        // Agregar validaciones adicionales si es necesario
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita hacer nada después de procesar la solicitud
    }
}
