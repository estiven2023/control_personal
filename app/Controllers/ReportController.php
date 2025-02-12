<?php

namespace App\Controllers;
use App\Models\AttendanceModel;
use CodeIgniter\HTTP\RequestInterface;

class ReportController extends BaseController
{
    public function generateReport()
    {
        helper('pdf');

        $attendanceModel = new AttendanceModel();

        // Obtener filtros de la solicitud
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        // Obtener datos con el total de horas trabajadas por empleado
        $data['records'] = $attendanceModel->getTotalHoursWorked($start_date, $end_date);
        
        // Obtener el total general de horas trabajadas
        $data['grand_total'] = $attendanceModel->getGrandTotalHours($start_date, $end_date)['grand_total'];

        // Generar el PDF con la vista
        $html = view('reports/total_hours', $data);
        generatePDF($html, "Reporte_Total_Horas.pdf");
    }
}
