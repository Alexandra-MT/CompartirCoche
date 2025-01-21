<?php

namespace Controllers;

use MVC\Router;

class LoginController{
    public static function login(Router $router){

        $router->render('auth/login',[
            'titulo' => 'Iniciar Sesión'
        ]);
    }

    public static function logout(){
        echo 'desde Logout';
    }

    public static function olvide(){
        echo 'desde olvide';
    }

    public static function recuperar(){
        echo 'desde recuperar';
    }

    public static function crear(Router $router){
        $router->render('auth/crear-cuenta',[
            'titulo' => 'Crear Cuenta'
        ]);
    }
}