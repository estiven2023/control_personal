<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion'); // Cambiado a /iniciar-sesion
        }

        // Mostrar la vista del panel de control
        return view('dashboard');
    }
}