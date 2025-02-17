<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\EmployeeModel;
use CodeIgniter\Controller;
use TCPDF;

class ReportController extends Controller
{
    public function filterForm()
    {
        return view('reports/filter_form');
    }

    public function generateReport()
    {
        // Verificar si el usuario está autenticado
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        // Obtener fechas del formulario
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        // Cargar modelos
        $attendanceModel = new AttendanceModel();

        // Obtener datos de la base de datos
        $records = $attendanceModel->getTotalHoursWorked($start_date, $end_date);
        $grand_total = $attendanceModel->getGrandTotalHours($start_date, $end_date);

        // Pasar datos a la vista
        $data = [
            'records' => $records,
            'grand_total' => $grand_total['grand_total'],
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

        return view('reports/total_hours', $data);
    }

    public function attendancePDF()
    {
        // Verificar si el usuario está autenticado
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/iniciar-sesion');
        }

        // Cargar modelos
        $attendanceModel = new AttendanceModel();
        $employeeModel = new EmployeeModel();

        // Obtener datos de la base de datos
        $data = $employeeModel->select('employees.name, attendance.check_in, attendance.check_out')
                                ->join('attendance', 'attendance.employee_id = employees.id')
                                ->orderBy('attendance.check_in', 'DESC')
                                ->findAll();

        // Crear nuevo PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Control Personal');
        $pdf->SetTitle('Reporte de Asistencia');
        $pdf->SetHeaderData('', 0, 'Reporte de Asistencia', '');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();

        // Contenido del PDF
        $html = '<h2>Reporte de Asistencia</h2>';
        $html .= '<table border="1" cellspacing="0" cellpadding="4">';
        $html .= '<tr><th>Empleado</th><th>Entrada</th><th>Salida</th></tr>';
        
        foreach ($data as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row['name'] . '</td>';
            $html .= '<td>' . $row['check_in'] . '</td>';
            $html .= '<td>' . $row['check_out'] . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Salida del PDF
        $pdf->Output('reporte_asistencia.pdf', 'D');
    }
}