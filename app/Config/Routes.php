<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); // Página principal
$routes->get('/login', 'Auth::login'); // Formulario de login
$routes->post('/auth', 'Auth::authenticate'); // Acción de login
$routes->get('/logout', 'Auth::logout'); // Cerrar sesión
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authGuard']); // Panel restringido
$routes->get('/empleados', 'Empleados::index', ['filter' => 'authGuard']); // Gestión de empleados

// Rutas para empleados
$routes->get('/employees', 'Employee::index');
$routes->get('/employees/create', 'Employee::create');
$routes->post('/employees/store', 'Employee::store');

// Rutas para asistencias
$routes->get('/attendance', 'Attendance::index');
$routes->get('/attendance/checkin/(:num)', 'Attendance::checkIn/$1');
$routes->get('/attendance/checkout/(:num)', 'Attendance::checkOut/$1');

// Rutas para reportes
$routes->get('reporte/asistencia', 'ReportController::generateReport');
$routes->get('reporte/filtro', function() {
    echo view('reports/filter_form');
});

$routes->get('/test', 'TestController::testSession');

// Rutas para el usuario autenticado
$routes->get('/mi-asistencia', 'Attendance::selfAttendance', ['filter' => 'authGuard']);

