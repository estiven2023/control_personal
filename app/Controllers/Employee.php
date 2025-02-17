<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class Employee extends Controller
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        $model = new EmployeeModel();
        $search = $this->request->getGet('search');
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;

        if ($search) {
            $model->groupStart()
                  ->like('name', $search)
                  ->orLike('email', $search)
                  ->orLike('position', $search)
                  ->groupEnd();
        }

        $data['employees'] = $model->paginate($perPage);
        $data['pager'] = $model->pager;
        $data['search'] = $search;

        return view('employees/index', $data);
    }

    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        return view('employees/create');
    }

    public function store()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        $model = new EmployeeModel();

        // Validar los datos
        $rules = [
            'name'     => 'required|min_length[3]|max_length[255]',
            'email'    => 'required|valid_email|is_unique[employees.email]',
            'position' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Guardar los datos
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'position' => $this->request->getPost('position'),
            'created_by' => session()->get('user_id'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/empleados')->with('success', 'Empleado creado con éxito');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        $model = new EmployeeModel();
        $data['employee'] = $model->find($id);

        if (!$data['employee']) {
            return redirect()->to('/empleados')->with('error', 'Empleado no encontrado.');
        }

        return view('employees/edit', $data);
    }

    public function update($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        $model = new EmployeeModel();

        // Validar los datos
        $rules = [
            'name'     => 'required|min_length[3]|max_length[255]',
            'email'    => "required|valid_email|is_unique[employees.email,id,{$id}]",
            'position' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Guardar los datos
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'position' => $this->request->getPost('position'),
            'updated_by' => session()->get('user_id'),
        ];

        $model->update($id, $data);

        return redirect()->to('/empleados')->with('success', 'Empleado actualizado correctamente.');
    }

    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        $model = new EmployeeModel();
        $model->delete($id);
        return redirect()->to('/empleados')->with('success', 'Empleado eliminado correctamente.');
    }
}