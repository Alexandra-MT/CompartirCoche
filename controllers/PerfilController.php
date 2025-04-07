<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class PerfilController{
    public static function perfil(Router $router){
        isAuth();
        $usuario = Usuario::find($_SESSION['id']);
        $resultado = $_GET['exito'] ?? null;
        $alertas = [];
        $router->render('dashboard/perfil/perfil',[
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'resultado' => $resultado,
            'alertas' => $alertas
        ]);

    }

    public static function fotoCrear(Router $router){
        isAuth();
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        //Redireccionar si el $id no existe
        if(!$id){
            header('Location: /dashboard');
        }
        //Buscar Galeria por $id en la BBDD
        $usuario = Usuario::find($id);
        if(!$usuario){
            header('Location: /dashboard');
        }
        //Alertas
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $foto = $_FILES['foto'];
                //Si no hay foto previa
                if(!$usuario->foto){
                    //Subida de archivos
                    $carpetaFotos = $_SERVER['DOCUMENT_ROOT'].'/build/img/perfil/';
                    //Crear carpeta
                    if(!is_dir($carpetaFotos)){
                        mkdir($carpetaFotos);
                    }
                    //Nombre imagen
                    $nombreNuevaFoto = md5(uniqid(rand(), true)).".jpg";
                    //Subir la imagen
                    move_uploaded_file($foto['tmp_name'], $carpetaFotos.$nombreNuevaFoto); 
                    $usuario->foto = $nombreNuevaFoto; 
                }else{
                    //Subida de archivos
                    $carpetaFotos = $_SERVER['DOCUMENT_ROOT'].'/build/img/perfil/';
                    //Crear carpeta
                    if(!is_dir($carpetaFotos)){
                        mkdir($carpetaFotos);
                    }
                    //Comprobar si el usuario subio otra imagen
                    $foto = $_FILES['foto'];
                    $nombreFoto = $usuario->foto; // para que no borre la anterior si no subimos otra imagen
                    
                    if($foto['name']){
                        //Eliminar imagen previa
                        unlink($carpetaFotos.$nombreFoto);

                        //Nombre imagen
                        $nombreNuevaFoto = md5(uniqid(rand(), true)).".jpg";
                        //Subir la imagen
                        move_uploaded_file($foto['tmp_name'], $carpetaFotos.$nombreNuevaFoto); 
                        $usuario->foto = $nombreNuevaFoto; 
                    }
                }
                $resultado = $usuario->guardar();
                //Redireccionar, alerta
                if($resultado){
                    header('Location:/perfil?exito=2');
                }
            }

        $router->render('dashboard/perfil/foto',[
            'titulo' => 'Actualiza tu foto de perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function fotoEliminar(){
        isAuth();
        //POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Recibir el $id mediante POST
            $id = $_POST['id']; //viene como string
            //Convertir valor $id a integer
            $id = intval($id); //numero
            //Redireccionar si no hay $id
            if(!$id){
                header('Location: /perfil');
            }
            //Buscar $id en la BBDD
            $usuario = Usuario::find($id);
            //Eliminar imagen
            $carpetaFotos = $_SERVER['DOCUMENT_ROOT'].'/build/img/perfil/';
            $nombreFoto = $usuario->foto;
            unlink($carpetaFotos.$nombreFoto);
            //BBDD
            $usuario->foto = '';
            $usuario->guardar();
            //Redireccionar, alerta exito
            header('Location:/perfil?exito=4');  
        }    
    }

    public static function infoPersonal(Router $router){
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarInfo();
            if(empty($alertas)){
                //Verificar que el email modificado no pertenezca a otro usuario
                $existeUsuario = Usuario::where('email', $usuario->email);
                if($existeUsuario && $existeUsuario->id !== $usuario->id){
                    $alertas = Usuario::setAlerta('error', 'Email No Válido, cuenta ya registrada');
                }else{
                    //Guardar
                    $resultado = $usuario->guardar();
                    //Asignar el nombre nuevo a la barra
                    $_SESSION['nombre'] = $usuario->nombre;
                    //Redireccionar
                    if($resultado){
                        header('Location: /perfil?exito=2');
                    }
                }   
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('dashboard/perfil/infoPersonal', [
            'titulo' => 'Información Personal',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function cambiarPass(Router $router){
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);
        //Identificar usuario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Sincronizar con los datos del usuario
            $usuario->sincronizar($_POST);

            $alertas = $usuario->nuevoPass();
            
            if(empty($alertas)){
                $resultado = $usuario->comprobarPass();
                if($resultado){
                    //Asignar el nuevo password
                    $usuario->password = $usuario->password_nuevo;
                    //Eliminar atributos temporales
                    unset($usuario->password2);
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);
                    unset($usuario->password_nuevor);
                    //Hashear password
                    $usuario->hashPassword();
                    //Actualizar BBDD
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location:perfil?exito=2');
                    }

                }else{
                    Usuario::setAlerta('error', 'Contraseña Actual Incorrecta');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('dashboard/perfil/cambiarPass', [
            'titulo' => 'Cambiar Contraseña',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function infoAdicional(Router $router){
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            debuguear($_POST);
            //$alertas = $usuario->validarInfoAdicional();
            if(empty($alertas)){
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /perfil?exito=2');
                }
            }
        }
        $router->render('dashboard/perfil/infoAdicional', [
            'titulo' => 'Información Adicional',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function vehiculo(Router $router){
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarVehiculo();
            if(empty($alertas)){
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /perfil?exito=2');
                } 
            }
        }
    $router->render('dashboard/perfil/vehiculo', [
        'titulo' => 'Tu vehículo',
        'usuario' => $usuario,
        'alertas' => $alertas
    ]);
    }
}