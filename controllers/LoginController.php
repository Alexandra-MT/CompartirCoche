<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){

        $router->render('auth/login',[
            'titulo' => 'Iniciar Sesión'
        ]);
    }

    public static function logout(){
        echo 'desde Logout';
    }

    public static function olvide(Router $router){
        $router->render('auth/olvide-password',[
            'titulo' => 'Olvide Password'
        ]);
    }

    public static function recuperar(){
        echo 'desde recuperar';
    }

    public static function crear(Router $router){
        //Instancia usuario
        $usuario = new Usuario;
        //alertas vacias
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
           
            //Revisar que $alertas está vacío
            if(empty($alertas)){
                //Verificar que el usuario no esté registrado
                $existeUsuario = Usuario::where('email', $usuario->email);
                if($existeUsuario){
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                }else{
                    //No está registrado

                    //Hashear el password
                    $usuario->hashPassword();
                    //Crear token
                    $usuario->crearToken();
                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location:/mensaje');
                    }else{
                        $alertas = Usuario::setAlerta('error', 'Lo sentimos, hubo un error. Por favor, inténtelo más tarde.');
                    }
                }
            $alertas = Usuario::getAlertas();
            }
        }
        $router->render('auth/crear-cuenta',[
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){

        $router->render('auth/mensaje',[
            'titulo' => 'Confirmar Cuenta'
        ]);
    }
}