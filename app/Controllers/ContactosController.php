<?php
    namespace App\Controllers;

    use App\Models\Contactos;

    class ContactosController extends BaseController
    {
        public function indexAction($request)
        {
            $contacto = Contactos::getInstancia();
            $data = ["contacto" => $contacto->getAll()];
            $data["perfil"] = $_SESSION["perfil"];
            $this->renderHTML("../app/Views/index_view.php", $data);
        }

        public function setAction()
        {
            $data["perfil"] = $_SESSION["perfil"];

            if (!isset($_POST["add"])) {
                $this->renderHTML("../app/Views/add_view.php", $data);
            } else {
                $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
                $telefono = filter_var($_POST["telefono"], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
                $contacto = Contactos::getInstancia();
                
                $contacto->setNombre($nombre);
                $contacto->setTelefono($telefono);
                $contacto->setEmail($email);
                $contacto->set();

                header("Location: http://localhost");
            }
        }
    }
