<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table      = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'position', 'created_by', 'updated_by'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'name'     => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|is_unique[employees.email]',
        'position' => 'required|min_length[3]|max_length[50]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'El nombre es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.',
            'max_length' => 'El nombre no puede exceder los 100 caracteres.'
        ],
        'email' => [
            'required' => 'El correo electrónico es obligatorio.',
            'valid_email' => 'Debe ingresar un correo electrónico válido.',
            'is_unique' => 'Este correo electrónico ya está registrado.'
        ],
        'position' => [
            'required' => 'La posición es obligatoria.',
            'min_length' => 'La posición debe tener al menos 3 caracteres.',
            'max_length' => 'La posición no puede exceder los 50 caracteres.'
        ],
    ];

    public function validateEmployee($data, $id = null)
    {
        if ($id) {
            $this->validationRules['email'] = "required|valid_email|is_unique[employees.email,id,{$id}]";
        }

        if (!$this->validate($data)) {
            return $this->errors();
        }

        return true;
    }

    public function saveEmployee($data, $id = null)
    {
        if ($id) {
            return $this->update($id, $data);
        } else {
            return $this->insert($data);
        }
    }
}
