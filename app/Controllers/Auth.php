<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Mostrar la vista de inicio de sesión
        return view('auth/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();

        // Obtener los datos del formulario
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Validar campos vacíos
        if (empty($username) || empty($password)) {
            $session->setFlashdata('error', 'Usuario y contraseña son obligatorios.');
            return redirect()->to('/iniciar-sesion'); // Cambiado a /iniciar-sesion
        }

        // Buscar el usuario en la base de datos
        $user = $model->where('username', $username)->first();

        if ($user) {
            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                // Configurar la sesión del usuario
                $session->set([
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ]);

                // Redirigir según el rol
                if ($user['role'] === 'admin') {
                    return redirect()->to('/panel'); // Cambiado a /panel
                } else {
                    return redirect()->to('/mi-asistencia'); // Cambiado a /mi-asistencia
                }
            } else {
                $session->setFlashdata('error', 'Contraseña incorrecta');
                return redirect()->to('/iniciar-sesion'); // Cambiado a /iniciar-sesion
            }
        } else {
            $session->setFlashdata('error', 'Usuario no encontrado');
            return redirect()->to('/iniciar-sesion'); // Cambiado a /iniciar-sesion
        }
    }

    public function logout()
    {
        // Destruir la sesión y redirigir al login
        session()->destroy();
        return redirect()->to('/iniciar-sesion'); // Cambiado a /iniciar-sesion
    }
}