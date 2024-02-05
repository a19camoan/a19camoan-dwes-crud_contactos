<?php
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\Usuarios;

    class AuthController extends BaseController
    {
        public function loginAction()
        {
            if (isset($_POST)) {
                $user = $_POST["user"];
                $password = $_POST["password"];
                
                $usuario = Usuarios::getInstancia();
                $auth = $usuario->getByCredentials($user, $password);

                if ($auth) {
                    $_SESSION["perfil"] = "usuario";
                    $_SESION["usuario"] = $auth;
                }
            }
            header("Location: /");
        }

        public function logoutAction()
        {
            session_unset();
            session_destroy();
            header("Location: /");
        }
    }
