<?php
    require_once "./models/TatuadorModel.php";
    require_once "./models/Tatuador.php";
    class TatuadoresController{
        private $tatuadorModel;

        public function __construct(){
            $this->tatuadorModel = new TatuadorModel();
        }

        public function showAltaTatuador($errores = []){
            // mostrar la pg para insertar tatuador
            require_once "./views/tatuadoresViews/AltaTatuador.php";
        }

        public function insertarTatuador($datos = []){
            // comprobar los datos e insertar en la base de datos al tatuador
            $nombre = $datos["input_nombre"] ?? "";
            $email = $datos["input_email"] ?? "";
            $password = $datos["input_password"] ?? "";
            $foto = $datos["input_foto"] ?? "";
            
            $errores = [];

            if($nombre == "")
                $errores["error_nombre"] = "El campo nombre es obligatorio";
            if($email == "")
                $errores["error_email"] = "El campo email es obligatorio";
            if($password == "")
                $errores["error_password"] = "El campo contraseña es obligatorio";
            if($foto == "")
                $errores["error_foto"] = "El campo foto es obligatorio";

            if(!empty($errores)) {
                $this->showAltaTatuador($errores);
            } else {
                // insertar el tatuador
                $comprobarEmail = $this->tatuadorModel->checkEmailExists($email);
                if(empty($comprobarEmail)) {
                    $tatuador = new Tatuador(null, $nombre, $email,$password, $foto);
                    $insertCorrecto = $this->tatuadorModel->insertTatuador($tatuador);
                    if($insertCorrecto) {
                        // LLAMAR A UNA PÁGINA QUE MUESTRE UN MENSAJE DE ÉXITO
                        require_once "./views/tatuadoresViews/TatuadorAltaCorrectaView.php";
                    } else {
                        // LLAMAR A ALGÚN SITIO Y MOSTRAR UN MENSAJE DE ERROR
                        $errores["error_db"] = "Error al insertar el tatuador, intentelo de nuevo más tarde";
                        $this->showAltaTatuador($errores);
                    }
                }else{
                    $errores["error_emailExistente"] = "El email introducido ya existe";
                    $this->showAltaTatuador($errores);
                }
            }
        }

        public function getAllTatuadores(){
            $tatuadores = $this->tatuadorModel->getAll();
            require_once "./views/tatuadoresViews/AllTatuadoresView.php";
        }

    }
?>