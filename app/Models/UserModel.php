<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'role'     => 'required|in_list[admin,employee]',
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'El nombre de usuario es obligatorio.',
            'min_length' => 'El nombre de usuario debe tener al menos 3 caracteres.',
            'max_length' => 'El nombre de usuario no puede exceder los 100 caracteres.'
        ],
        'email' => [
            'required' => 'El correo electrónico es obligatorio.',
            'valid_email' => 'Debe ingresar un correo electrónico válido.',
            'is_unique' => 'Este correo electrónico ya está registrado.'
        ],
        'password' => [
            'required' => 'La contraseña es obligatoria.',
            'min_length' => 'La contraseña debe tener al menos 8 caracteres.'
        ],
        'role' => [
            'required' => 'El rol es obligatorio.',
            'in_list' => 'El rol debe ser "admin" o "employee".'
        ],
    ];

    /**
     * Valida los datos del usuario.
     *
     * @param array $data Datos a validar.
     * @param int|null $id ID del usuario (para actualización).
     * @return array|true
     */
    public function validateUser($data, $id = null)
    {
        if ($id) {
            $this->validationRules['email'] = "required|valid_email|is_unique[users.email,id,{$id}]";
        }

        if (!$this->validate($data)) {
            return $this->errors();
        }

        return true;
    }

    /**
     * Guarda o actualiza un usuario.
     *
     * @param array $data Datos del usuario.
     * @param int|null $id ID del usuario (para actualización).
     * @return bool
     */
    public function saveUser($data, $id = null)
    {
        if ($id) {
            return $this->update($id, $data);
        } else {
            return $this->insert($data);
        }
    }
}