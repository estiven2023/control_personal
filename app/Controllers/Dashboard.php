<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $model = new AttendanceModel();
        $attendanceStats = $model->getAttendanceStatsLast7Days();


        return view('dashboard', ['attendanceStats' => $attendanceStats]);
    }
}
