<?php
    use App\Core\Router;
    use App\Controllers\ContactosController;

    require_once "../bootstrap.php";

    session_start();

    if (!isset($_SESSION["perfil"])) {
        $_SESSION["perfil"] = "invitado";
    }

    $router = new Router();
    $router->add(
        [
            "name" => "home",
            "path" => "/^\/$/",
            "action" => [ContactosController::class, "indexAction"],
            "auth" => ["invitado", "usuario"]
        ]
    );
    $router->add(
        [
            "name" => "login",
            "path" => "/^\/login$/",
            "action" => [ContactosController::class, "loginAction"],
            "auth" => ["invitado"]
        ]
    );

    $request = $_SERVER["REQUEST_URI"];
    $route = $router->match($request);

    if ($route) {
        if (in_array($_SESSION["perfil"], $route["auth"])) {
            $className = $route["action"][0];
            $classMethod = $route["action"][1];
            $object = new $className;
            $object->$classMethod($request);
        } else {
            echo "No autorizado";
        }
    } else {
        include_once "../app/Views/404_view.php";
    }
