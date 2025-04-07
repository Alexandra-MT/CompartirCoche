<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\CompartirController;
use Controllers\DashboardController;
use Controllers\PerfilController;

$router = new Router();

//INICIAR SESIÓN
$router->get('/login',[LoginController::class, 'login']);
$router->post('/login',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);

//REESTABLECER PASSWORD
$router->get('/olvide',[LoginController::class, 'olvide']);
$router->post('/olvide',[LoginController::class, 'olvide']);
$router->get('/restablecer',[LoginController::class, 'restablecer']);
$router->post('/restablecer',[LoginController::class, 'restablecer']);

//CREAR CUENTA
$router->get('/crear-cuenta',[LoginController::class, 'crear']);
$router->post('/crear-cuenta',[LoginController::class, 'crear']);

//CONFIRMAR CUENTA
$router->get('/confirmar-cuenta',[LoginController::class, 'confirmar']);
$router->get('/mensaje',[LoginController::class, 'mensaje']);

//PAGINAS- ZONA PUBLICA
$router->get('/',[PaginasController::class,'index']);
$router->get('/buscar-viajes',[PaginasController::class, 'buscarViaje']);
$router->post('/buscar-viajes',[PaginasController::class, 'buscarViaje']);

//ZONA PRIVADA USUARIO
$router->get('/dashboard',[DashboardController::class, 'index']);
$router->get('/buscar',[DashboardController::class, 'buscar']);
$router->post('/buscar',[DashboardController::class, 'buscar']);


//CRUD COMPARTIR VIAJE
$router->get('/compartir-crear',[CompartirController::class, 'compartir']);
$router->post('/compartir-crear',[CompartirController::class, 'compartir']);
$router->get('/compartir-actualizar',[CompartirController::class, 'actualizar']);
$router->post('/compartir-actualizar',[CompartirController::class, 'actualizar']);
$router->post('/compartir-cancelar',[CompartirController::class, 'cancelar']);

//PERFIL USUARIO
$router->get('/perfil',[PerfilController::class, 'perfil']);
$router->post('/perfil',[PerfilController::class, 'perfil']);
$router->get('/perfil-foto',[PerfilController::class, 'fotoCrear']);
$router->post('/perfil-foto',[PerfilController::class, 'fotoCrear']);
$router->post('/foto-eliminar',[PerfilController::class, 'fotoEliminar']);
$router->get('/perfil-info',[PerfilController::class, 'infoPersonal']);
$router->post('/perfil-info',[PerfilController::class, 'infoPersonal']);
$router->get('/perfil-pass',[PerfilController::class, 'cambiarPass']);
$router->post('/perfil-pass',[PerfilController::class, 'cambiarPass']);
$router->get('/perfil-infoad',[PerfilController::class, 'infoAdicional']);
$router->post('/perfil-infoad',[PerfilController::class, 'infoAdicional']);
$router->get('/perfil-vehiculo',[PerfilController::class, 'vehiculo']);
$router->post('/perfil-vehiculo',[PerfilController::class, 'vehiculo']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();