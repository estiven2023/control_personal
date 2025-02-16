<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\EmployeeModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class Attendance extends Controller
{

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
    
        $attendanceModel = new AttendanceModel();
        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->findAll();
        $attendanceRecords = [];
    
        foreach ($employees as $employee) {
            $attendance = $attendanceModel->where('employee_id', $employee['id'])
                                            ->where('DATE(check_in)', date('Y-m-d'))
                                            ->first();
    
            $attendanceRecords[] = [
                'id' => $attendance['id'] ?? null,
                'employee_id' => $employee['id'],
                'name' => $employee['name'],
                'check_in' => isset($attendance['check_in']) ? Time::parse($attendance['check_in'])->toLocalizedString('d M Y, h:i A') : 'No registrado',
                'check_out' => isset($attendance['check_out']) ? Time::parse($attendance['check_out'])->toLocalizedString('d M Y, h:i A') : 'No registrado',
            ];
        }
    
        return view('attendance/index', ['attendanceRecords' => $attendanceRecords]);
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
