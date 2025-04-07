<?php
namespace Model;

class Viaje extends ActiveRecord{
    //BBDD
    protected static $tabla = 'viajes';
    protected static $columnasDB = ['id', 'origen', 'destino', 'direccionRecogida', 'fecha', 'hora', 'plazas', 'precio', 'automatico', 'mascota', 'informacion', 'propietarioId'];

    //Atributos
    public $id;
    public $origen;
    public $destino;
    public $direccionRecogida;
    public $fecha;
    public $hora;
    public $plazas;
    public $precio; //atributo temporal
    public $automatico;
    public $mascota;
    public $informacion;
    public $propietarioId;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->origen = $args['origen'] ?? '';
        $this->destino = $args['destino'] ?? '';
        $this->direccionRecogida = $args['direccionRecogida'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->plazas = $args['plazas'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->automatico = $args['automatico'] ?? '0';
        $this->mascota = $args['mascota'] ?? '0';
        $this->informacion = $args['informacion'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? '';
    }

    public function validarViaje(){
        if(!($this->origen && $this->destino && $this->direccionRecogida && $this->fecha && $this->hora && $this->plazas && $this->precio)){
            self::setAlerta('error', 'Por favor, complete todos los campos marcados con *');
        }

        return self::getAlertas();
    } 
    
    public function validarBusqueda(){
        if(!$this->origen || !$this->destino || !$this->fecha || !$this->plazas){
            self::setAlerta('info', 'Por favor, rellene todos los campos');
        }
        return self::getAlertas();
    }
    
}