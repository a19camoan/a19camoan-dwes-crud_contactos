<?php
    namespace App\Controllers;

    use App\Models\Usuarios;

    class AuthController
    {
        public function loginAction()
        {
            ob_start();
            if (isset($_POST)) {
                $user = $_POST["user"];
                $password = $_POST["password"];
                
                $usuario = Usuarios::getInstancia();
                $auth = $usuario->getByCredentials($user, $password);

                if ($auth) {
                    $_SESSION["perfil"] = "usuario";
                    $_SESSION["usuario"] = $auth;
                }
            }
            header("Location: ../");
            ob_end_flush();
        }

        public function logoutAction()
        {
            session_unset();
            session_destroy();
            header("Location: ../");
        }
    }
