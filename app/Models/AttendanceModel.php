<?php

namespace App\Models;
use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'check_in', 'check_out'];

    // Obtener el total de horas trabajadas por empleado y el total general en un rango de fechas
    public function getTotalHoursWorked($start_date, $end_date)
    {   
        return $this->select("employees.name as employee_name, 
                            ROUND(SUM(TIME_TO_SEC(TIMEDIFF(attendance.check_out, attendance.check_in)) / 3600), 2) as total_hours")
                    ->join('employees', 'employees.id = attendance.employee_id')
                    ->where('attendance.check_in >=', $start_date . ' 00:00:00')
                    ->where('attendance.check_out <=', $end_date . ' 23:59:59')
                    ->groupBy('attendance.employee_id')
                    ->findAll();
    }


    public function getGrandTotalHours($start_date, $end_date)
    {
        return $this->select("ROUND(SUM(TIME_TO_SEC(TIMEDIFF(check_out, check_in)) / 3600), 2) as grand_total")
                    ->where('check_in >=', $start_date . ' 00:00:00')
                    ->where('check_out <=', $end_date . ' 23:59:59')
                    ->first();
    }

}
