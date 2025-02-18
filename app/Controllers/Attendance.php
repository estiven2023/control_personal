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
            return redirect()->to('/iniciar-sesion');
        }

        $attendanceModel = new AttendanceModel();
        $employeeModel = new EmployeeModel();

        $data['attendanceStats'] = $attendanceModel->getAttendanceStatsLast7Days();

        // Asegurar que se listan todos los empleados, aunque no hayan hecho check-in
        $attendanceRecords = $employeeModel->select('employees.id, employees.name, attendance.check_in, attendance.check_out')
            ->join('attendance', 'attendance.employee_id = employees.id AND DATE(attendance.check_in) = CURDATE()', 'left')
            ->orderBy('employees.id', 'ASC')
            ->findAll();

            return view('attendance/index', [
                'attendanceRecords' => $attendanceRecords,
                'attendanceStats' => $data['attendanceStats']  // Agrega esta línea
            ]);

            
            
    }

    public function selfAttendance()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        $attendanceModel = new AttendanceModel();
        $employee_id = session()->get('user_id');

        // Obtener el registro de asistencia actual del día
        $attendance = $attendanceModel->where('employee_id', $employee_id)
            ->where('DATE(check_in)', date('Y-m-d'))
            ->first();

        // Obtener el historial de asistencia de los últimos 7 días
        $history = $attendanceModel->where('employee_id', $employee_id)
            ->where('check_in >=', date('Y-m-d', strtotime('-7 days')))
            ->orderBy('check_in', 'DESC')
            ->findAll();


        return view('attendance/self', [
            'attendance' => $attendance,
            'history' => $history
        ]);
    }

    public function checkIn($employee_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        $model = new AttendanceModel();

        log_message('debug', "Intentando registrar Check-in para empleado: {$employee_id}");

        $existingCheckIn = $model->where('employee_id', $employee_id)
            ->where('DATE(check_in)', date('Y-m-d'))
            ->where('check_out', null)
            ->first();

        if ($existingCheckIn) {
            log_message('debug', "El empleado {$employee_id} ya tiene un check-in registrado hoy.");
            return redirect()->to('/asistencia')->with('error', 'Ya tienes un check-in pendiente.');
        }

        $data = [
            'employee_id' => $employee_id,
            'check_in' => date('Y-m-d H:i:s'),
        ];

        log_message('debug', "Datos a insertar: " . json_encode($data));

        $inserted = $model->insert($data);

        if ($inserted) {
            log_message('debug', "Check-in exitoso para empleado: {$employee_id}");
        } else {
            log_message('error', "Error al registrar el check-in.");
        }

        return redirect()->to('/asistencia')->with('success', 'Check-in registrado correctamente.');
    }

    public function checkOut($employee_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        $model = new AttendanceModel();

        // Buscar el último check-in del empleado que aún no tiene check-out
        $attendance = $model->where('employee_id', $employee_id)
            ->where('check_out', null)
            ->orderBy('check_in', 'DESC')
            ->first();

        if (!$attendance) {
            return redirect()->to('/asistencia')->with('error', 'No tienes un check-in pendiente.');
        }

        // Verificar que el Check-out sea el mismo día del Check-in
        if (date('Y-m-d', strtotime($attendance['check_in'])) !== date('Y-m-d')) {
            return redirect()->to('/asistencia')->with('error', 'Solo puedes hacer Check-out el mismo día del Check-in.');
        }

        // Registrar la salida
        $model->update($attendance['id'], ['check_out' => date('Y-m-d H:i:s')]);

        return redirect()->to('/asistencia')->with('success', 'Check-out registrado correctamente.');
    }
}