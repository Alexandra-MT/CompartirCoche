<?php 

namespace Controllers;

use MVC\Router;
use Model\Viaje;
use Model\Usuario;

class CompartirController{
    public static function compartir(Router $router){
        isAuth();
        $alertas = [];
        $viaje = new Viaje;
        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $viaje = new Viaje($_POST);
            
            //Validación
            $alertas = $viaje->validarViaje();
            if(empty($alertas)){
                //Almacenar el creador del viaje
                $viaje->propietarioId = $_SESSION['id'];
                //Guardar Viaje
                $resultado = $viaje->guardar();
                //Redireccionar
                if($resultado){
                    header('Location: /dashboard?exito=1');
                }else{
                    Viaje::setAlerta('error', 'Lo sentimos, hubo un error. Por favor, inténtelo más tarde.');
                } 
            }
        }
        $alertas = Viaje::getAlertas();
        $router->render('dashboard/compartir/crear',[
            'titulo' => 'Comparte tu Coche',
            'alertas' => $alertas,
            'viaje' => $viaje,
            'usuario' => $usuario
        ]);
    }

    public static function actualizar(Router $router){
        isAuth();
        $alertas=[];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        //Redireccionar si el $id no existe
        if(!$id){
            header('Location: /dashboard');
        }
        //Buscar Galeria por $id en la BBDD
        $viaje = Viaje::find($id);
        if(!$viaje){
            header('Location: /dashboard');
        }
        $usuario = Usuario::find($_SESSION['id']);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $viaje->sincronizar($_POST);
            $alertas = $viaje->validarViaje();
            if(empty($alertas)){
                $resultado = $viaje->guardar();
                if($resultado){
                    header('Location: /dashboard?exito=2');
                }else{
                    Viaje::setAlerta('error', 'Lo sentimos, hubo un error. Por favor, inténtelo más tarde.');
                } 
            }
        }
        $alertas = Viaje::getAlertas();
        $router->render('dashboard/compartir/actualizar',[
            'titulo' => 'Actualizar Viaje Compartido',
            'alertas' => $alertas,
            'viaje' => $viaje,
            'usuario' => $usuario
        ]);
    }
    public static function cancelar(){
        //Proteger ruta
        isAuth();
        //POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Recibir el $id mediante POST
            $id = $_POST['id']; //viene como string
            //Convertir valor $id a integer
            $id = intval($id); //numero
             //Redireccionar si no hay $id
            if(!$id){
                header('Location: /dashboard');
            }
            $viaje = Viaje::find($id);
            $resultado = $viaje->eliminar();
            if($resultado){
                header('Location: /dashboard?exito=3');
                }else{
                    Viaje::setAlerta('error', 'Lo sentimos, hubo un error. Por favor, inténtelo más tarde.');  
                }
        }
    }
}