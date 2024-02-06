<?php
    namespace App\Controllers;

    use App\Models\Contactos;

    define("REDIRECT_URL", "Location: http://localhost");

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
                ob_start();
                $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
                $telefono = filter_var($_POST["telefono"], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
                $contacto = Contactos::getInstancia();

                $contacto->setNombre($nombre);
                $contacto->setTelefono($telefono);
                $contacto->setEmail($email);
                $contacto->set();

                header(REDIRECT_URL);
                ob_end_flush();
                exit;
            }
        }

        public function delAction($request)
        {
            ob_start();
            $id = explode("/", $request);
            $id = end($id);

            $contacto = Contactos::getInstancia();
            $contacto->delete($id);

            header(REDIRECT_URL);
            ob_end_flush();
            exit;
        }

        public function editAction($request)
        {
            ob_start();
            $data["perfil"] = $_SESSION["perfil"];

            $parts = explode("/", $request);
            $id = $parts[2];

            $contacto = Contactos::getInstancia();

            $datosContacto = $contacto->get($id);

            if ($datosContacto) {
                $procesaForm = false;

                $data["nombre"] = $datosContacto["nombre"];
                $data["telefono"] = $datosContacto["telefono"];
                $data["email"] = $datosContacto["email"];

                if (isset($_POST["edit"])) {
                    $procesaForm = true;

                    $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
                    $telefono = filter_var($_POST["telefono"], FILTER_SANITIZE_STRING);
                    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

                    $data["nombre"] = $nombre;
                    $data["telefono"] = $telefono;
                    $data["email"] = $email;

                    # Validación de servidor
                    if (empty($nombre)) {
                        $procesaForm = false;
                    }

                    if ($procesaForm) {
                        $contacto->setNombre($nombre);
                        $contacto->setTelefono($telefono);
                        $contacto->setEmail($email);
                        $contacto->edit();

                        header(REDIRECT_URL);
                        ob_end_flush();
                        exit;
                    }
                } else {
                    $this->renderHTML("../app/Views/edit_view.php", $data);
                }
            } else {
                $this->renderHTML("../app/Views/not_contact_view.php", $data);
            }
        }
    }
