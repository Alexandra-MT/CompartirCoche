<?php

namespace Model;

class BuscarViaje extends ActiveRecord{
    protected static $tabla = 'viajes';
    protected static $columnasDB = ['id', 'origen', 'destino', 'direccionRecogida', 'fecha', 'hora', 'plazas', 'precio', 'automatico', 'mascota', 'informacion', 'usuario', 'foto', 'telefono', 'email'];

    public $id;
    public $origen;
    public $destino;
    public $direccionRecogida;
    public $fecha;
    public $hora;
    public $plazas;
    public $precio;
    public $automatico;
    public $mascota;
    public $informacion;
    public $usuario;
    public $foto;
    public $telefono;
    public $email;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->origen = $args['origen'] ?? '';
        $this->destino = $args['destino'] ?? '';
        $this->direccionRecogida = $args['direccionRecogida'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->plazas = $args['plazas'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->automatico = $args['automatico'] ?? '1';
        $this->mascota = $args['mascota'] ?? '0';
        $this->informacion = $args['informacion'] ?? '';
        $this->usuario = $args['usuario'] ?? '';
        $this->foto = $args['foto'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';

    }
}