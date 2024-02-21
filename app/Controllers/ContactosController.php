<?php
    namespace App\Controllers;

    use App\Models\Contactos;

    class ContactosController extends BaseController
    {
        /**
         * Renders the index view of the ContactosController.
         *
         * @param mixed $request The request object.
         * @return void
         */
        public function indexAction($request) : void
        {
            $contacto = Contactos::getInstancia();
            $data = ["contacto" => $contacto->getAll()];
            $data["perfil"] = $_SESSION["perfil"];
            $this->renderHTML("../app/Views/index_view.php", $data);
        }

        /**
         * Sets the action for adding a contact.
         *
         * This method is responsible for handling the logic when adding a contact.
         * It retrieves the contact details from the POST request, sanitizes the input,
         * and sets the contact details using the Contactos class. Finally, it redirects
         * the user to the specified URL.
         *
         * @return void
         */
        public function setAction() : void
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

        /**
         * Deletes a contact based on the given request.
         *
         * @param string $request The request containing the contact ID.
         * @return void
         */
        public function delAction($request) : void
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

        /**
         * Edit action for the ContactosController.
         *
         * This method is responsible for handling the edit functionality for a contact.
         * It retrieves the contact details from the database, processes the form data,
         * and updates the contact information if the form is submitted successfully.
         *
         * @param string $request The request URL.
         * @return void
         */
        public function editAction($request) : void
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

        /**
         * Search action method.
         * Retrieves contact data based on a search query and renders the index view.
         *
         * @return void
         */
        public function searchAction() : void
        {
            $data["perfil"] = $_SESSION["perfil"];
            $contacto = Contactos::getInstancia();
            $data["contacto"] = $contacto->getByAll($_GET["q"]);
            $this->renderHTML("../app/Views/index_view.php", $data);
        }

        public function searchActionAjax()
        {
            $contacto = Contactos::getInstancia();

            header('Content-Type: application/json');
            echo json_encode($contacto->getByAll($_GET["q"]));
            var_dump(json_encode($contacto->getByAll($_GET["q"])));
        }
    }
