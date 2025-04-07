<?php

namespace Controllers;

use MVC\Router;
use Model\Viaje;
use Model\Usuario;
use Model\BuscarViaje;



class DashboardController{
    public static function index(Router $router){
        // Está autenticado
        isAuth();
        $id = $_SESSION['id'];
        $viajes = Viaje::belongsTo('propietarioId', $id);
        $usuario = Usuario::find($id);
        $resultado = $_GET['exito'] ?? null;
        $router->render('dashboard/index',[
            'titulo' => 'Tus Viajes',
            'viajes' => $viajes,
            'usuario' => $usuario,
            'resultado' => $resultado
        ]);
    }
    public static function buscar(Router $router){
        isAuth();
        $alertas = [];
        $viajes = new Viaje();
        $buscarViaje = [];
        $mostrar = false;
        $usuario = Usuario::find($_SESSION['id']);
      
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Consultar la BBDD
            $viajes = new Viaje($_POST);
            $alertas = $viajes->validarBusqueda();
            if(empty($alertas)){
                $buscarViaje = BuscarViaje::filterFind($viajes->origen, $viajes->destino, $viajes->fecha, $viajes->plazas);
                $mostrar = true;
            }  
        }
        $router->render('dashboard/buscar',[
            'titulo' => 'Buscar un Viaje',
            'buscarViaje' => $buscarViaje,
            'viajes' => $viajes,
            'usuario' => $usuario,
            'mostrar' => $mostrar,
            'alertas' => $alertas
        ]);

    }
    
}

?>
