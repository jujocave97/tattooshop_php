<?php

require_once "./models/UsuarioModel.php";
require_once "./controllers/CitaController.php";

class UsuarioController
{

    private $usuarioModel;

    /*
        CONSTRUCTOR DE CLASE
        El constructor de clase lo utilizamos para inicializar el atributo
        $citaModel. (Recordemos que con Model realizaremos las operaciones CRUD con la Base de Datos)
        */
    public function __construct()
    {
        $this->usuarioModel = new UsuariosModel();
    }

    /**
     * Método para mostrar el view de AltaCita -> Contiene la página para dar de alta una cita
     */
    public function showLogin($errores = [])
    {
        require_once "./views/citasViews/LoginView.php";
    }

    public function doLogin($datos = [])
    {

        // EXTRAER LOS DATOS DEL FORMULARIO Y ALMACENARLOS EN VARIABLES
        $input_email = $datos["input_email"] ?? "";
        $input_password = $datos["input_password"] ?? "";

        // COMPROBAMOS SI LOS DATOS DEL FORMULARIO SON CORRECTOS -> SI NO VIENEN VACIOS
        $errores = [];
        if ($input_email == "" || $input_password == "") {

            // COMPROBAMOS QUÉ CAMPO ESTÁ VACÍO Y LO AÑADÁIS A UN ARRAY DE ERRORES
            $errores["error_credenciales"] = "Las credenciales son incorrectas";
        }

        // SI $errores NO ESTÁ EMPTY, SIGNIFICA QUE HA HABIDO ERRORES
        if (!empty($errores)) {
            $this->showLogin($errores);
        } else {

            $operacionExitosa = $this->usuarioModel->login($input_email, $input_password);


            if ($operacionExitosa) {
                // LLAMAR A UNA PÁGINA QUE MUESTRE UN MENSAJE DE ÉXITO
                $_SESSION["usuario"] = $input_email;

                $citaController = new CitaController();
                $citaController->showAltaCita();
            } else {
                // LLAMAR A ALGÚN SITIO Y MOSTRAR UN MENSAJE DE ERROR
                $errores["error_db"] = "Error, intentelo de nuevo más tarde";
                $this->showLogin($errores);
            }
        }
    }
}