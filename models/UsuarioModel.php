<?php
    require_once './database/DBHandler.php';

    class UsuariosModel{
        private $dbHandler; // instancia de la clase dbhandler
        private $conexion; // conexion con la bd
        private $tabla = "usuarios"; // nombre de la tabla

        public function __construct() {
            // inicializar DBHandler
            $this->dbHandler = new DBHandler("localhost","root","","tattoos_bd", "3306");
        }

        public function getUSuario($idUsuario){
            // Realizar conexion
            $this->conexion = $this->dbHandler->conectar();

            // crear y ejecutar sentencia sql

            $sql = "SELECT * FROM $this->tabla WHERE id = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("i",$idUsuario);   

            $stmt->execute(); // ejecuta query
            $resultado = $stmt->get_result(); // extraemos una lista de registros de la bd

            $usuarios = [];
            while ($fila = $resultado->fetch_assoc()){
                $usuarios[] = $fila;
            }

            print_r($usuarios);

        }

        public function login($email, $password){
            // Realizar conexion
            $this->conexion = $this->dbHandler->conectar();

            // crear y ejecutar sentencia sql

            $sql = "SELECT email, password FROM $this->tabla WHERE email = ? AND password = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ss", $email, $password);   

            $stmt->execute(); // ejecuta query
            $resultado = $stmt->get_result(); // extraemos una lista de registros de la bd

            $usuarios = [];
            while ($fila = $resultado->fetch_assoc()){
                $usuarios[] = $fila;
            }

            if(!empty($usuarios)){
                return true;
            }else{
                return false;
            }

        }
        public function insertUsuario($email, $password){
            // Realizar conexion
            $this->conexion = $this->dbHandler->conectar();

            // crear y ejecutar sentencia sql

            $sql = "INSERT INTO $this->tabla (email,password) VALUES (?,?)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ss", $email, $password);   

            $stmt->execute(); // ejecuta query
        }

    }
?>