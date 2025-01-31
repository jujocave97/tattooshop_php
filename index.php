<?php
       // Cargamos los controladores que necesitamos.
    require_once "./controllers/CitaController.php";
    require_once "./controllers/UsuarioController.php";

    // QUIERO OBTENER LA URL DE LA PETICIÓN
    $requestUri = $_SERVER["REQUEST_URI"] ?? "";

    // QUEREMOS LLAMAR A UN CONTROLLER U OTRO DEPENDIENDO DE LA $REQUESTURI
    switch ($requestUri) {
        // 1er caso -> si llamamos a la uri de alta
        case "/tattooshop_php/citas/alta":session_start();
        if(!isset($_SESSION) || !isset($_SESSION["usuario"])) {
            require_once "./views/citasViews/LoginView.php";
        }else{
            $citaController = new CitaController();
            $requestMethod = $_SERVER["REQUEST_METHOD"]; // va a ser GET o POST
            
                if($requestMethod == "GET") {
                    $citaController->showAltaCita();
                } elseif($requestMethod == "POST") {
                    $datos = $_POST ?? [];
                    $citaController->insertCita($datos);
                }
            }
            break;
        case "/tattooshop_php/tatuadores/alta":
            require_once "./controllers/TatuadoresController.php";
            session_start();
           // if(!isset($_SESSION) || !isset($_SESSION["usuario"])) {
             //   require_once "./views/citasViews/LoginView.php";
            //}else{
                $tatuadoresController = new TatuadoresController();
                $requestMethod = $_SERVER["REQUEST_METHOD"]; // va a ser GET o POST
                
                if($requestMethod == "GET") {
                    $tatuadoresController->showAltaTatuador();
                    
                } elseif($requestMethod == "POST") {
                    // registrar tatuador
                    $datos = $_POST ?? [];
                    $tatuadoresController->insertarTatuador($datos);
                }
            
            

            break;
        case "/tattooshop_php/tatuadores/lista":
                require_once "./controllers/TatuadoresController.php";
                $tatuadoresController = new TatuadoresController();
                $requestMethod = $_SERVER["REQUEST_METHOD"]; // va a ser GET o POST
                
                if($requestMethod == "GET") {
                    $tatuadoresController->getAllTatuadores();
                }else{
                    echo "cuack";
                }
                
            break;    
            case "/tattooshop_php/index":
            case "/tattooshop_php/login":
            case "/tattooshop_php/":

                $usuarioController = new UsuarioController();
                session_start(); // Para poder usar $_SESSION

                // MOSTRAMOS LA PAGINA DE LOGIN
                $requestMethod = $_SERVER["REQUEST_METHOD"]; // va a ser GET o POST

                if ($requestMethod == "GET") {
                    $usuarioController->showLogin();
                } elseif ($requestMethod == "POST") {
                    $datos = $_POST ?? [];
                    $usuarioController->doLogin($datos);
                }

                break;    
        // caso por defecto -> llamamos a 404
        default:
            echo "<h1>PAGINA NO ENCONTRADA</h1>";
            break;
    }


?>