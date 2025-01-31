<?php
    require_once "./database/DBHAndler.php";
    class TatuadorModel{
        private $nombreTabla = "tatuadores"; // NOMBRE DE LA TABLA DE LA BASE DE DATOS
        private $conexion;              // ATRIBUTO QUE ALMACENARÁ LA CONEXIÓN A LA BASE DE DATOS
        private $dbHandler;             // ATRIBUTO QUE ALMACENA LA INSTANCIA DE DBHAndler

        public function __construct() {
            $this->dbHandler = new DBHandler("localhost","root","","tattoos_bd","3306");
        }

        public function insertTatuador($tatuador) {
            // MANEJAR QUE SOLO EXISTA UN EMAIL
            try {
                // Conectar a la base de datos
                $this->conexion = $this->dbHandler->conectar();

                // Suponiendo que tienes una tabla llamada "tatuadores" y que los datos del tatuador se guardan en un campo llamado "datos_tatuador"
                $sql = "INSERT INTO $this->nombreTabla (datos_tatuador) VALUES (?)";  // 1 parámetro en la consulta

                // Preparar la sentencia SQL
                $stmt = $this->conexion->prepare($sql);

                // Serializar el objeto Tatuador en JSON
                $datos_tatuador = json_encode($tatuador); // Asegúrate de que el objeto Tatuador esté bien serializado

                // Verificar si la serialización fue exitosa
                if ($datos_tatuador === false) {
                    throw new Exception("Error al serializar el objeto Tatuador.");
                }

                // Asignar el parámetro a la sentencia preparada
                $stmt->bind_param("s", $datos_tatuador); // "s" para string

                // Ejecutar la sentencia
                return $stmt->execute();
            } catch (Exception $e) {
                error_log("Error al insertar tatuador: " . $e->getMessage());
                return false;
            } finally {
                $this->dbHandler->desconectar();
            }
        }

        public function getAll(){ 
            try {
                $this->conexion = $this->dbHandler->conectar();
                $sql = "SELECT * FROM $this->nombreTabla";

                $stmt = $this->conexion->prepare($sql);
                if (!$stmt->execute()) {
                    error_log("Error al ejecutar la consulta SQL: " . implode(", ", $stmt->errorInfo()));
                    return [];
                }
                $result = $stmt->get_result();

                if ($result->num_rows === 0) {
                    error_log("No hay tatuadores en la base de datos.");
                    return [];
                }

                $tatuadores = [];

                while ($row = $result->fetch_assoc()) {

                    if (!isset($row['datos_tatuador']) || empty($row['datos_tatuador'])) {
                        error_log("Advertencia: datos_tatuador es NULL o vacío en la BD para el ID " . $row['id']);
                        continue;
                    }

                    $datos = json_decode($row['datos_tatuador'], true);

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        error_log("Error de JSON en la BD: " . json_last_error_msg());
                        continue;
                    }

                    $datos['id'] = $row['id'];

                    $tatuadores[] = new Tatuador(
                        $datos['id'],
                        $datos['nombre'],
                        $datos['email'],
                        $datos['password'],
                        $datos['foto']
                    );
                }

                return $tatuadores;
            } catch (Exception $e) {
                error_log("Error en getAllTatuadores: " . $e->getMessage());
                return null;
            } finally {
                $this->dbHandler->desconectar();
            }
            
            
        }

        public function checkEmailExists($email) {
            try {
                $this->conexion = $this->dbHandler->conectar();

                $sql = "SELECT id FROM $this->nombreTabla WHERE JSON_UNQUOTE(JSON_EXTRACT(datos_tatuador, '$.email')) = ?";
                $stmt = $this->conexion->prepare($sql);

                if (!$stmt) {
                    error_log("Error en la preparación de la consulta: " . $this->conexion->error);
                    return false;
                }

                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                return $result->num_rows > 0;

            } catch (Exception $e) {
                error_log("Error en checkEmailExists: " . $e->getMessage());
                return false;
            } finally {
                $this->dbHandler->desconectar();
            }
        }

        public function getTatuadorID($id){
            try {
                $this->conexion = $this->dbHandler->conectar();

                $sql = "SELECT * FROM $this->nombreTabla WHERE id = ?";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bind_param("i", $id); // ID es un número entero
                $stmt->execute();
                $result = $stmt->get_result();

                $row = $result->fetch_assoc();
                if (!$row) {
                    return null; // Si no hay resultado, retorna null
                }

                // Decodificar JSON
                $datos = json_decode($row['datos_tatuador'], true);

                // Asegurarse de que se está asignando correctamente el ID
                if (!isset($datos['id'])) {
                    $datos['id'] = $row['id'];
                }

                return new Tatuador(
                    $datos['id'],
                    $datos['nombre'],
                    $datos['email'],
                    $datos['password'],
                    $datos['foto']
                );
            } catch (Exception $e) {
                error_log("Error en getTatuador: " . $e->getMessage());
                return null;
            } finally {
                $this->dbHandler->desconectar();
            }
        }

    }
?>