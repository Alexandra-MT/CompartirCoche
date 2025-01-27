<?php

namespace Model;

class Usuario extends ActiveRecord{
    //BBDD
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email', 'password', 'admin', 'confirmado', 'token'];

    //Atributos
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $password;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
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
            self::setAlerta('error','El Password es Obligatorio');
        }
        if(!(strlen($this->password) > 8 && preg_match('`[a-z]`',$this->password) && preg_match('`[A-Z]`',$this->password) && preg_match('`[0-9]`',$this->password) && preg_match('`[\W]`', $this->password))){
            self::setAlerta('error', 'El Password debe tener al menos 8 caracteres, una letra minúscula, una letra mayúscula, un número y un carácter especial');
        }
        return self::getAlertas();
    }

    public function hashPassword(){
        //reescribimos el password
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }
        
}