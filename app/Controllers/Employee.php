<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class Employee extends Controller
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $model = new EmployeeModel();
        $data['employees'] = $model->findAll();

        return view('employees/index', $data);
    }

    public function create()
    {
        return view('employees/create');
    }

    public function store()
{
    $validation = \Config\Services::validation();

    // Definir reglas de validación
    $validation->setRules([
        'name'     => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|is_unique[employees.email]',
        'position' => 'required|min_length[3]|max_length[50]',
    ]);

    // Si la validación falla, redirigir con errores
    if (!$this->validate($validation->getRules())) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Guardar el empleado en la base de datos si la validación es exitosa
    $model = new EmployeeModel();
    $model->insert([
        'name'     => $this->request->getPost('name'),
        'email'    => $this->request->getPost('email'),
        'position' => $this->request->getPost('position'),
    ]);

    return redirect()->to('/employees')->with('success', 'Empleado creado con éxito');
}



}

