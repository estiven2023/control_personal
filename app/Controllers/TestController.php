<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestController extends Controller
{
    public function testSession()
    {
        session()->setFlashdata('success', 'La sesión funciona correctamente.');
        return redirect()->to(base_url('/test'))->with('success', 'Prueba de sesión exitosa.');
    }
}
