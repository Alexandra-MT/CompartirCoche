<?php

namespace Controllers;
use MVC\Router;

use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){
        
        $router->render('paginas/home/index',[
            'titulo' => 'Inicio',
            'textoHeader' => 'Únete y comparte tus viajes y vehículos',
        ]);  
    }
}