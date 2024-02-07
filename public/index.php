<?php
    use App\Core\Router;
    use App\Controllers\ContactosController;
    use App\Controllers\AuthController;

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
            "action" => [AuthController::class, "loginAction"],
            "auth" => ["invitado", "usuario"]
        ]
    );
    $router->add(
        [
            "name" => "logout",
            "path" => "/^\/logout$/",
            "action" => [AuthController::class, "logoutAction"],
            "auth" => ["invitado", "usuario"]
        ]
    );
    $router->add(
        [
            "name" => "add",
            "path" => "/^\/add$/",
            "action" => [ContactosController::class, "setAction"],
            "auth" => ["usuario"]
        ]
    );
    $router->add(
        [
            "name" => "delete",
            "path" => "/^\/del\/(\d+)$/",
            "action" => [ContactosController::class, "delAction"],
            "auth" => ["usuario"]
        ]
    );
    $router->add(
        [
            "name" => "delete confirm",
            "path" => "/^\/delc\/(\d+)$/",
            "action" => [ContactosController::class, "delCorfmAction"],
            "auth" => ["usuario"]
        ]
    );
    $router->add(
        [
            "name" => "edit",
            "path" => "/^\/edit\/(\d+)$/",
            "action" => [ContactosController::class, "editAction"],
            "auth" => ["usuario"]
        ]
    );
    $router->add([
        "name" => "search",
        "path" => "/^\/search\?q=.+$/",
        "action" => [ContactosController::class, "searchAction"],
        "auth" => ["invitado","usuario"]
    ]);

    $request = $_SERVER["REQUEST_URI"];
    $route = $router->match($request);

    if ($route) {
        if (in_array($_SESSION["perfil"], $route["auth"])) {
            $className = $route["action"][0];
            $classMethod = $route["action"][1];
            $object = new $className;
            $object->$classMethod($request);
        } else {
            include_once "../app/Views/403_view.php";
        }
    } else {
        include_once "../app/Views/404_view.php";
    }
