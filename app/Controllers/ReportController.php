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
    
        // Crear nuevo PDF con orientación horizontal
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Control Personal');
        $pdf->SetTitle('Reporte de Asistencia');
    
        // Configurar encabezado personalizado
        $pdf->setPrintHeader(false); // Desactivar encabezado por defecto
        $pdf->setPrintFooter(false); // Desactivar pie de página por defecto
        $pdf->SetMargins(10, 20, 10); // Márgenes (izq, top, der)
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->AddPage();
    
        // Crear el encabezado manualmente
        $pdf->SetFillColor(30, 64, 175); // Azul oscuro
        $pdf->SetTextColor(255, 255, 255); // Texto blanco
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 12, 'Reporte de Asistencia', 0, 1, 'C', true);
        
        // Subtítulo con la fecha de generación
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, 8, 'Generado el: ' . date('d/m/Y H:i'), 0, 1, 'C');
    
        // Estilos CSS mejorados
        $html = '
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th {
                background-color: #1E40AF;
                color: white;
                padding: 10px;
                font-size: 14px;
                text-align: center;
            }
            td {
                padding: 10px;
                font-size: 12px;
                text-align: center;
                border-bottom: 1px solid #ddd;
            }
            tr:nth-child(even) {
                background-color: #E0E7FF;
            }
        </style>';
    
        // Construcción de la tabla
        $html .= '<table border="0">
                    <tr>
                        <th>Empleado</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                    </tr>';
    
        foreach ($data as $row) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($row['name']) . '</td>
                        <td>' . htmlspecialchars($row['check_in']) . '</td>
                        <td>' . htmlspecialchars($row['check_out']) . '</td>
                      </tr>';
        }
    
        $html .= '</table>';
    
        // Escribir la tabla en el PDF
        $pdf->writeHTML($html, true, false, true, false, '');
    
        // Agregar pie de página
        $pdf->SetY(-15);
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->Cell(0, 10, 'Reporte generado automáticamente por el sistema de Control Personal.', 0, 0, 'L');
        $pdf->Cell(0, 10, 'Página ' . $pdf->getAliasNumPage() . ' de ' . $pdf->getAliasNbPages(), 0, 0, 'R');
    
        // Salida del PDF
        $pdf->Output('reporte_asistencia.pdf', 'D');
    }
    


}