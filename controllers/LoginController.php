<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){
        //Alertas
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();

            if(empty($alertas)){
                //Verificar que el usuario exista
                $usuario = Usuario::where('email', $usuario->email);

                if(!$usuario || !$usuario->confirmado){
                    //El usuario no existe o no esta confirmado
                    Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                }else{
                    //El usuario existe
                    if(password_verify($_POST['password'], $usuario->password)){
                        //Iniciar sesión
                        session_start();
                        $_SESSION['id'] = $usuario->id;// que usuario publica los viajes
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['telefono'] = $usuario->telefono;
                        $_SESSION['login'] = true;

                        //Redireccionar
                        header('Location: /dashboard');
        
                    }else{
                        Usuario::setAlerta('error', 'Contraseña incorrecta');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login',[
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];  
        header('Location: /');
    }

    public static function olvide(Router $router){
        //Alertas
        $alertas = [];
        $mostrar = true;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Sincronizar el email
            $usuario = new Usuario($_POST);
            //Validar el campo email que contenga un email válido
            $alertas = $usuario->validarEmail();
            if(empty($alertas)){
                //Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);
                if($usuario && $usuario->confirmado){
                    //Encontro al usuario
                    
                    //Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);
                    //Guardar fecha 
                    $usuario->fechaCrear = date('Y-m-d');
                    //Actualizar el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        //Imprimir la alerta
                        Usuario::setAlerta('exito', 'Hemos enviado las intrucciones a tu email');
                        //Enviar el email
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarInstrucciones();
                        $mostrar = false;
                    }else{
                        Usuario::setAlerta('error', 'Lo sentimos, hubo un error. Por favor, inténtelo más tarde.');
                    } 
                }else{
                    //No encontro al usuario
                    Usuario::setAlerta('error', 'El Usuario No Existe o No Está Confirmado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        //Vistas
        $router->render('auth/olvide-password',[
            'titulo' => 'Olvide Contraseña',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }

    public static function restablecer(Router $router){
        $alertas = [];
        $mostrar = true;
        $token = s($_GET['token']);
        if(!$token) header('Location: /');

        //Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Lo sentimos, el enlace de restablecimiento de la contraseña ha caducado o su contraseña ya ha sido restablecida.');
            $mostrar = false;
        }else{
            //VERIFICAR FECHA PARA ELIMINAR TOKEN
            $fechaCrear = $usuario->fechaCrear;
            $fechaActual = date('Y-m-d');
            if($fechaCrear !== $fechaActual){
                $usuario->token = null;
                $usuario->guardar();
                Usuario::setAlerta('error', 'Lo sentimos, el enlace de restablecimiento  de la contraseña ha caducado.');
                $mostrar = false;
            }
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                //Añadir el nuevo password
                $usuario->sincronizar($_POST);
                //Validar el password
                $alertas = $usuario->validarPassword();
                if(empty($alertas)){
                    //Hashear el nuevo password
                    $usuario->hashPassword();
                    //Eliminar password2, atributo temporal
                    unset($usuario->password2);
                    //Eliminar el token
                    $usuario->token = null;
                    //Guardar en la BBDD
                    $resultado = $usuario->guardar();
                    //Redireccionar
                    if($resultado){
                        Usuario::setAlerta('exito', 'Contraseña restablecida correctamente');
                        $mostrar = false;
                        header("refresh: 3; url = /login");
                    }else{
                        Usuario::setAlerta('error', 'Lo sentimos, hubo un error. Por favor, inténtelo más tarde.');
                    }
                }   
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/restablecer',[
            'titulo' => 'Restablecer Contraseña',
            'alertas' => $alertas,
            'mostrar' => $mostrar
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
                    if($resultado){
                        //Si se guarda en la bbdd, enviamos un email.
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();
                        header('Location:/mensaje');
                    }else{
                        Usuario::setAlerta('error', 'Lo sentimos, hubo un error. Por favor, inténtelo más tarde.');
                    }
                }
            }
            $alertas = Usuario::getAlertas();
        }
        $router->render('auth/crear-cuenta',[
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function confirmar(Router $router){
        //Alertas
        $alertas = [];
        //Token
        $token = s($_GET['token']);
        //Si no hay token, lo redirigimos
        if(!$token) header('Location:/');

        //Encontrar al usuario que tiene el token
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            //No se encontró un usuario con ese token.
            Usuario::setAlerta('error', 'Lo sentimos, el enlace de confirmación de la cuenta ha caducado o su nueva cuenta ya ha sido confirmada.');
        }else{
             //VERIFICAR FECHA PARA ELIMINAR TOKEN
            $fechaCrear = $usuario->fechaCrear;
            $fechaActual = date('Y-m-d');
            if($fechaCrear !== $fechaActual){
                $usuario->eliminar();
                Usuario::setAlerta('error', 'Lo sentimos, el enlace de confirmación de la cuenta ha caducado.');
            }else{
                //Confirmar la cuenta
                $usuario->confirmado = 1;
                $usuario->token = null;
                //$usuario->fecha = NULL;
                unset($usuario->password2);
    
                //Guardar en la BBDD
                $resultado = $usuario->guardar();
                if($resultado){
                    Usuario::setAlerta('exito', 'Cuenta confirmada correctamente.');
                    header("refresh: 3; url = /login");
                }else{
                    Usuario::setAlerta('error', 'Lo sentimos, hubo un error. Por favor, inténtelo más tarde.');
                }
            }
        }

        $alertas = Usuario::getAlertas();
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

?>