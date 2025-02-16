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
        
        // Obtener el término de búsqueda
        $search = $this->request->getGet('search');

        // Configurar la paginación
        $perPage = 10;  // Puedes ajustar la cantidad de elementos por página
        $page = $this->request->getGet('page') ?? 1;

        // Construir la consulta con búsqueda si hay un término
        if ($search) {
            $model->groupStart()
                  ->like('name', $search)
                  ->orLike('email', $search)
                  ->orLike('position', $search)
                  ->groupEnd();
        }

        // Obtener los empleados con la paginación
        $data['employees'] = $model->paginate($perPage);
        $data['pager'] = $model->pager;
        $data['search'] = $search;

        return view('employees/index', $data);
    }

    public function create()
    {
        return view('employees/create');
    }

    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $model = new EmployeeModel();
        $data['employee'] = $model->find($id);

        if (!$data['employee']) {
            return redirect()->to('/employees')->with('error', 'Empleado no encontrado.');
        }

        return view('employees/edit', $data);
    }

    public function update($id)
    {
        $model = new EmployeeModel();

        // Validar los datos usando el modelo
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'position' => $this->request->getPost('position'),
            'updated_by' => session()->get('user_id'),
        ];

        $validationResult = $model->validateEmployee($data, $id);

        if ($validationResult !== true) {
            return redirect()->back()->withInput()->with('errors', $validationResult);
        }

        // Guardar los datos
        $model->saveEmployee($data, $id);

        return redirect()->to('/employees')->with('success', 'Empleado actualizado correctamente.');
    }

    public function delete($id)
    {
        $model = new EmployeeModel();
        $model->delete($id);
        return redirect()->to('/employees')->with('success', 'Empleado eliminado correctamente.');
    }

    public function store()
    {
        $model = new EmployeeModel();

        // Obtener los datos
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'position' => $this->request->getPost('position'),
            'created_by' => session()->get('user_id'),
        ];

        // Validar los datos usando el modelo
        $validationResult = $model->validateEmployee($data);

        if ($validationResult !== true) {
            return redirect()->back()->withInput()->with('errors', $validationResult);
        }

        // Guardar los datos
        $model->saveEmployee($data);

        return redirect()->to('/employees')->with('success', 'Empleado creado con éxito');
    }
}
