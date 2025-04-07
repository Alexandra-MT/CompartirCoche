<?php

namespace Controllers;
use MVC\Router;

use Model\Viaje;
use Model\BuscarViaje;


class PaginasController{

    public static function index(Router $router){
        $viajes = new Viaje();
        $router->render('paginas/home/index',[
            'titulo' => 'Inicio',
            'viajes' => $viajes,
            'textoHeader' => 'Únete y comparte tus viajes y vehículos',
        ]);  
    }

    public static function buscarViaje(Router $router){
        $alertas = [];
        $viajes = new Viaje();
        $viajes->origen = $_GET['origen'] ?? '';
        $viajes->destino = $_GET['destino'] ?? '';
        $viajes->fecha = $_GET['fecha'] ?? '';
        $viajes->plazas = $_GET['plazas'] ?? '';
        $buscarViaje = [];
        $mostrar = false;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $viajes = new Viaje($_POST);
            $alertas = $viajes->validarBusqueda();
            if(empty($alertas)){
                $buscarViaje = BuscarViaje::filterFind($viajes->origen, $viajes->destino, $viajes->fecha, $viajes->plazas);
                $mostrar = true;
            }  
        }
        $router->render('paginas/home/buscarViajes',[
            'titulo' => 'Busca un viaje',
            'viajes' => $viajes,
            'buscarViaje' => $buscarViaje,
            'mostrar' => $mostrar,
            'alertas' => $alertas,
        ]);
    }
}

?>