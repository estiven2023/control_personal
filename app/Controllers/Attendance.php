<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class Attendance extends Controller
{

public function index()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $attendanceModel = new AttendanceModel();
    $employeeModel = new EmployeeModel();

    // Obtener todos los empleados
    $employees = $employeeModel->findAll();

    // Inicializar un array de registros de asistencia vacíos
    $attendanceRecords = [];

    // Obtener registros de asistencia, si los hay
    foreach ($employees as $employee) {
        $attendance = $attendanceModel->where('employee_id', $employee['id'])
                                      ->where('DATE(check_in)', date('Y-m-d'))
                                      ->first();

        if ($attendance) {
            // Si tiene registros de asistencia en el día de hoy, añádelos al array
            $attendanceRecords[] = [
                'id' => $attendance['id'],
                'employee_id' => $attendance['employee_id'],
                'name' => $employee['name'],
                'check_in' => $attendance['check_in'],
                'check_out' => $attendance['check_out'],
            ];
        } else {
            // Si no tiene registros de asistencia, también lo añades, pero con valores vacíos
            $attendanceRecords[] = [
                'id' => null,
                'employee_id' => $employee['id'],
                'name' => $employee['name'],
                'check_in' => 'No registrado',
                'check_out' => 'No registrado',
            ];
        }
    }

    // Pasar los datos a la vista
    $data['attendanceRecords'] = $attendanceRecords;

    return view('attendance/index', $data);
}




    public function checkIn($employee_id)
    {
        $model = new AttendanceModel();

        $data = [
            'employee_id' => $employee_id,
            'check_in' => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);

        return redirect()->to('/attendance');
    }

    public function checkOut($id)
    {
        $model = new AttendanceModel();

        $data = [
            'check_out' => date('Y-m-d H:i:s'),
        ];

        $model->update($id, $data);

        return redirect()->to('/attendance');
    }

    public function selfAttendance()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $model = new AttendanceModel();
    $user_id = session()->get('user_id');

    // Obtener la asistencia del empleado en el día actual
    $attendance = $model->where('employee_id', $user_id)
                        ->where('DATE(check_in)', date('Y-m-d'))
                        ->first();

    return view('attendance/self', ['attendance' => $attendance]);
}

}
