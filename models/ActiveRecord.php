<?php
namespace Model;
class ActiveRecord {

    //Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    //Alertas y Mensajes
    protected static $alertas = [];

    //FUNCIONES
    
    //Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    //Setear alarma
    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    //Obtener alarma
    public static function getAlertas() {
        return static::$alertas;
    }

    //Consulta BBDD
    public static function consultarSQL($query) {
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    //Crear un objeto
    protected static function crearObjeto($registro) {
        //Nuevo objeto
        $objeto = new static;
        //Iterrar
        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                //Crear un objeto con los datos que recibimos de la BBDD
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    //Sanitizar los atributos
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Sincronizar
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    //Crear un nuevo registro
    public function crear() {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . "(";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('"; 
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        //Resultado de la consulta
        $resultado = self::$db->query($query);

        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

    //Actualizar registro
    public function actualizar() {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    
    // Registros - CRUD
    public function guardar() {
        $resultado = '';
        if(!is_null($this->id)) {
            //Actualizar si existe $id
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    //Traer todos los registros de una tabla
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Buscar un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = ".$id;
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ; //Solo trae el primero
    }

    //Obtener un numero de registros definido por LIMIT
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ".$limite;
        $resultado = self::consultarSQL($query);
        return  $resultado ;
    }

    //Obtener un numero de registros definido por LIMIT y a partir de una posición definido por OFFSET
    public static function getFrom($limite,$desde) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ".$limite." OFFSET ".$desde;
        $resultado = self::consultarSQL($query);
        return $resultado  ;
    }

    //Obtener un registro donde su valor es igual a una columna de BBDD 
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ".$columna." = '".$valor."'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ; //solo trae un resultado
    }

    //Obtener todos los registros donde su valor es igual a una columna de BBDD 
    public static function belongsTo($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ".$columna. " = '".$valor."'";
        $resultado = self::consultarSQL($query);
        return $resultado  ;
    }

    //Filtrar ascendiente
    public static function filterAsc($columna, $valor, $orden) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ".$columna. " = '".$valor."' ORDER BY ".$orden." ASC " ;
        $resultado = self::consultarSQL($query);
        return $resultado  ;
    } 

    //Filtro varios campos
    public static function filterFind($valor1, $valor2, $valor3, $valor4){
        $query= "SELECT viajes.id, viajes.origen, viajes.destino, viajes.direccionRecogida, viajes.fecha, viajes.hora, viajes.plazas, viajes.precio, viajes.automatico, viajes.mascota, viajes.informacion, usuarios.nombre as usuario, usuarios.foto, usuarios.telefono, usuarios.email FROM ".static::$tabla." LEFT OUTER JOIN usuarios ON viajes.propietarioId=usuarios.id WHERE origen='".$valor1."' AND destino='".$valor2."' AND fecha='".$valor3."' AND plazas>='".$valor4."' ORDER BY hora";
        $resultado = self::consultarSQL($query);
        return $resultado  ;
    }
}