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

        public function loginAction($request)
        {
            $this->renderHTML("../app/Views/login_view.php");
        }
    }
