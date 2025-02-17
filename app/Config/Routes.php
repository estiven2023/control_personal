<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');
$routes->get('/iniciar-sesion', 'Auth::login');
$routes->post('/autenticar', 'Auth::authenticate');
$routes->get('/cerrar-sesion', 'Auth::logout');
$routes->get('/panel', 'Dashboard::index', ['filter' => 'authGuard']);
$routes->get('/empleados', 'Employee::index', ['filter' => 'authGuard']);

// Rutas para empleados
$routes->get('/empleados/crear', 'Employee::create');
$routes->post('/empleados/guardar', 'Employee::store');
$routes->get('/empleados/editar/(:num)', 'Employee::edit/$1');
$routes->post('/empleados/actualizar/(:num)', 'Employee::update/$1');
$routes->post('/empleados/eliminar/(:num)', 'Employee::delete/$1');

// Rutas para asistencias
$routes->get('/asistencia', 'Attendance::index');
$routes->get('/asistencia/entrada/(:num)', 'Attendance::checkIn/$1');
$routes->get('/asistencia/salida/(:num)', 'Attendance::checkOut/$1');

// Rutas para reportes
$routes->get('/reporte/asistencia', 'ReportController::generateReport');
$routes->get('/reporte/filtro', 'ReportController::filterForm');
$routes->get('/reporte/pdf', 'ReportController::attendancePDF');


// Ruta para el usuario autenticado
$routes->get('/mi-asistencia', 'Attendance::selfAttendance', ['filter' => 'authGuard']);
