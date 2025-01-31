<?php

    require_once "./database/DBHAndler.php";
    class CitaModel {
        private $nombreTabla = "citas"; // NOMBRE DE LA TABLA DE LA BASE DE DATOS
        private $conexion;              // ATRIBUTO QUE ALMACENARÁ LA CONEXIÓN A LA BASE DE DATOS
        private $dbHandler;             // ATRIBUTO QUE ALMACENA LA INSTANCIA DE DBHAndler

        public function __construct() {
            $this->dbHandler = new DBHandler("localhost","root","","tattoos_bd","3306");
        }
        
        public function insertCita($cita) {

            $citaJSON = json_encode($cita);
            $this->conexion = $this->dbHandler->conectar();
            // b) Escribimos una sentencia SQL tal cual, poniendo ? por cada columna de la tabla de la BD
            $sql = "INSERT INTO $this->nombreTabla (datos_cita) VALUES (?)";
            // c.1) Realizamos un prepared statement con el método .prepare() del objeto $this->conexion
            $stmt = $this->conexion->prepare($sql);
            // c.2) Intercambiamos las interrogaciones por nuestros valores. Cada s corresponde a una ?, y con la s le decimos que se trata de un string
            // s -> string, d -> double/float, i -> integer
            $stmt-> bind_param("s", $citaJSON); // "bindear"/unir cada parámetro a su interrogación. "qué tipo de datos vamos a intercambiar", "los datos en sí"

            try {
                return $stmt->execute(); // EXECUTE DEVUELVE UN TRUE O FALSE -> SI HA SIDO EXITOSA LA OPERACION O NO
            } catch(Exception $e) {
                return false;
            } finally {
                $this->dbHandler->desconectar(); // USAMOS FINALLY PARA ASEGURARNOS QUE HEMOS CERRADO LA CONEXIÓN A LA BASE DE DATOS
            }
        }
    }

?>
