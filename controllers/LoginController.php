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

    public static function reestablecer(Router $router){
       
        $router->render('auth/reestablecer',[
            'titulo' => 'Reestablecer Password'
        ]);
    }

    public static function crear(Router $router){
        //Instancia usuario
        $usuario = new Usuario;
        //alertas vacias
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Sincronizar datos
            $usuario->sincronizar($_POST);
            //Validación
            $alertas = $usuario->validarNuevaCuenta();
           
            //Revisar que $alertas está vacío, datos correctos
            if(empty($alertas)){
                //Verificar que el usuario no esté registrado
                $existeUsuario = Usuario::where('email', $usuario->email);
                if($existeUsuario){
                    //Si está registrado
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                }else{
                    //Si NO está registrado

                    //Hashear el password
                    $usuario->hashPassword();
                    //Eliminar password2, atributo temporal
                    unset($usuario->password2);
                    //Crear token
                    $usuario->crearToken();
                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if(!$resultado){
                        //Si se guarda en la bbdd, enviamos un email.
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();
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

    public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET['token']);
        Usuario::where('token',$token);
        $router->render('auth/confirmar-cuenta',[
            'titulo' => 'Confirmar Cuenta',
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){

        $router->render('auth/mensaje',[
            'titulo' => 'Confirmar Cuenta'
        ]);
    }
}