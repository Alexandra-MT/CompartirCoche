<?php

namespace Model;

class Usuario extends ActiveRecord{
    //BBDD
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'foto', 'ubicacion', 'genero', 'fechaNacimiento', 'telefono', 'email', 'password', 'descripcionPersonal', 'preferenciaNotificacion', 'idiomas', 'vehiculo', 'admin', 'confirmado', 'token', 'fechaCrear'];

    //Atributos
    public $id;
    public $nombre;
    public $apellido;
    public $foto;
    public $ubicacion;
    public $genero;
    public $fechaNacimiento;
    public $telefono;
    public $email;
    public $password;
    public $password2; //atributo temporal
    public $password_actual; //atributo temporal
    public $password_nuevo; //atributo temporal
    public $password_nuevor; //atributo temporal
    public $descripcionPersonal;
    public $preferenciaNotificacion;
    public $idiomas;
    public $vehiculo;
    public $admin;
    public $confirmado;
    public $token;
    public $fechaCrear;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->foto = $args['foto'] ?? '';
        $this->ubicacion = $args['ubicacion'] ?? '';
        $this->genero = $args['genero'] ?? '';
        $this->fechaNacimiento = date('Y/m/d');
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->password_nuevor = $args['password_nuevor'] ?? '';
        $this->descripcionPersonal = $args['descripcionPersonal'] ?? '';
        $this->preferenciaNotificacion = $args['prefererenciaNotificacion'] ?? '';
        $this->idiomas = $args['idiomas'] ?? '';
        $this->vehiculo = $args['vehiculo'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->fechaCrear = date('Y/m/d');
    }
    
    //Validar el inicio de sesión de los usuarios
    public function validarLogin(){
        if(!$this->email){
            self::setAlerta('error','El Email es Obligatorio');
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::setAlerta('error','Email No Válido');
        }
        if(!$this->password){ //ojo con la negación se aplica a las dos
            self::setAlerta('error','La Contraseña es Obligatoria');
        }
        return self::getAlertas();
    }

    //Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::setAlerta('error', 'El Nombre es Obligatorio');
        }
        if(!$this->apellido){
            self::setAlerta('error', 'El Apellido es Obligatorio');
        }
        if(!($this->telefono && preg_match('`[0-9]`', $this->telefono))){
            self::setAlerta('error', 'El Teléfono es Obligatorio');
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::setAlerta('error','El Email es Obligatorio');
        }
        if(!$this->password){ //ojo con la negación se aplica a las dos
            self::setAlerta('error','La Contraseña es Obligatoria');
        }
        if(!(strlen($this->password) > 8 && preg_match('`[a-z]`',$this->password) && preg_match('`[A-Z]`',$this->password) && preg_match('`[0-9]`',$this->password) && preg_match('`[\W]`', $this->password))){
            self::setAlerta('error', 'La Contraseña debe tener al menos 8 caracteres, una letra minúscula, una letra mayúscula, un número y un carácter especial');
        }
        if($this->password !== $this->password2){
            self::setAlerta('error', 'Las contraseñas son diferentes');
        }
        return self::getAlertas();
    }

    //Valida un email
    public function validarEmail(){
        if(!$this->email){
            self::setAlerta('error','El Email es Obligatorio');
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::setAlerta('error','Email No Válido');
        }
        return self::getAlertas();
    }

    public function validarPassword(){
        if(!$this->password){ 
            self::setAlerta('error','La Contraseña es Obligatoria');
        }
        if(!(strlen($this->password) > 8 && preg_match('`[a-z]`',$this->password) && preg_match('`[A-Z]`',$this->password) && preg_match('`[0-9]`',$this->password) && preg_match('`[\W]`', $this->password))){
            self::setAlerta('error', 'La Contraseña debe tener al menos 8 caracteres, una letra minúscula, una letra mayúscula, un número y un carácter especial');
        }
        if($this->password !== $this->password2){
            self::setAlerta('error', 'Las contraseñas son diferentes');
        }
        return self::getAlertas();
    }

    public function validarFoto(){
        if(!$this->foto){
            self::setAlerta('error', 'Por favor, actualice su foto de perfil');
        }
        return self::getAlertas();
    }

    public function validarInfo(){
        if(!$this->nombre){
            self::setAlerta('error', 'El Nombre es Obligatorio');
        }
        if(!$this->apellido){
            self::setAlerta('error', 'El Apellido es Obligatorio');
        }
        if(!$this->fechaNacimiento){
            self::setAlerta('error', 'La Fecha de Nacimiento es Obligatoria');
        }
        if(!($this->telefono && preg_match('`[0-9]`', $this->telefono))){
            self::setAlerta('error', 'El Teléfono es Obligatorio');
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::setAlerta('error','El Email es Obligatorio');
        }
        return self::getAlertas();
    }

    public function validarVehiculo(){
        if(!$this->vehiculo){
            self::setAlerta('error', 'El campo vehículo no puede ir vacío');
        }
        return self::getAlertas();
    }

    public function nuevoPass(){
        if(!$this->password_actual || !$this->password_nuevo || !$this->password_nuevor){
            self::setAlerta('error', 'Todos los Campos son Obligatorios' );
        }
        if(!(strlen($this->password_nuevo) > 8 && preg_match('`[a-z]`',$this->password_nuevo) && preg_match('`[A-Z]`',$this->password_nuevo) && preg_match('`[0-9]`',$this->password_nuevo) && preg_match('`[\W]`', $this->password_nuevo))){
            self::setAlerta('error', 'La Contraseña debe tener al menos 8 caracteres, una letra minúscula, una letra mayúscula, un número y un carácter especial');
        }
        if($this->password_nuevo !== $this->password_nuevor){
            self::setAlerta('error', 'Las Nuevas Contraseñas son Diferentes');
        }
        return self::getAlertas();
    }

    public function comprobarPass(){
        return password_verify($this->password_actual, $this->password);
    }

    public function hashPassword(){
        //reescribimos el password
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = md5(uniqid()); //retorna 32 caracteres
    }
       
}