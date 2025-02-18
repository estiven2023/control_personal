<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'check_in', 'check_out'];

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

    public function getAttendanceStatsLast7Days()
    {
        return $this->select("DATE(check_in) as date, COUNT(*) as total_attendances")
                    ->where('check_in >=', date('Y-m-d', strtotime('-7 days')))
                    ->groupBy('DATE(check_in)')
                    ->findAll();
    }
}
