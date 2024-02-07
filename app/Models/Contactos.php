<?php
    namespace App\Models;

    #[\AllowDynamicProperties]
    /**
     * Represents a Contactos model.
     *
     * This class extends the DBAsbtractModel class and provides functionality
     * for interacting with the Contactos table in the database.
     */
    class Contactos extends DBAsbtractModel
    {
        private static $instance;

        private $id;
        private $nombre;
        private $telefono;
        private $email;
        private $createdAt;
        private $updatedAt;

        /**
         * Returns an instance of the Contactos class.
         *
         * @return Contactos The instance of the Contactos class.
         */
        public static function getInstancia(): Contactos
        {
            if (!isset(self::$instance)) {
                $miclase = __CLASS__;
                self::$instance = new $miclase;
            }
            return self::$instance;
        }

        /**
         * Prevents cloning of the Contactos object.
         *
         * @return void
         */
        public function __clone(): void
        {
            trigger_error("La clonación no está permitida", E_USER_ERROR);
        }

        # getter y setter de los atrubutos
        public function setId($id): void
        {
            $this->id = $id;
        }

        public function getId($id): int
        {
            return $this->id;
        }

        public function setNombre($nombre): void
        {
            $this->nombre = $nombre;
        }

        public function getNombre($nombre): string
        {
            return $this->nombre;
        }

        public function setTelefono($telefono): void
        {
            $this->telefono = $telefono;
        }

        public function getTelefono($telefono): string
        {
            return $this->telefono;
        }

        public function setEmail($email): void
        {
            $this->email = $email;
        }

        public function getEmail($email): string
        {
            return $this->email;
        }

        public function getCreatedAt($createdAt): string
        {
            return $this->createdAt;
        }

        public function setUpdatedAt($updatedAt): void
        {
            $this->updatedAt = $updatedAt;
        }

        public function getUpdatedAt($updatedAt): string
        {
            return $this->updatedAt;
        }

        /**
         * Sets the values of the contact properties and inserts a new contact record into the database.
         *
         * @param array $contact_data The data array containing the contact information.
         * @return void
         */
        public function set($contact_data = array()): void
        {
            $this->query = "INSERT INTO contactos (nombre, telefono, email) VALUES (:nombre, :telefono, :email)";
            $this->params["nombre"] = $this->nombre;
            $this->params["telefono"] = $this->telefono;
            $this->params["email"] = $this->email;
            $this->getResultsFromQuery();
            $this->mensaje = "Contacto añadido";
        }

        /**
         * Retrieves all contact records from the database.
         *
         * @return array An array containing all contact records.
         */
        public function getAll(): array
        {
            $this->query = "SELECT * FROM contactos";
            $this->getResultsFromQuery();
            return $this->rows;
        }

        /**
         * Retrieves a contact from the database based on the given ID.
         *
         * @param string $id The ID of the contact to retrieve. Defaults to an empty string.
         * @return array|null The contact data as an associative array, or null if the contact is not found.
         */
        public function get($id = ""): array
        {
            if ($id != "") {
                $this->query = "SELECT * FROM contactos WHERE id = :id";
                $this->params["id"] = $id;
                $this->getResultsFromQuery();
            }

            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $propiedad => $valor) {
                    $this->$propiedad = $valor;
                }
                $this->mensaje = "Contacto encontrado";
            } else {
                $this->mensaje = "Contacto no encontrado";
            }

            return $this->rows[0] ?? null;
        }

    /**
     * Updates the contact information in the database.
     *
     * @return void
     */
    public function edit(): void
    {
        $this->query = "UPDATE contactos SET nombre=:nombre, telefono=:telefono, email=:email WHERE id=:id";

        $this->params["id"] = $this->id;
        $this->params["nombre"] = $this->nombre;
        $this->params["telefono"] = $this->telefono;
        $this->params["email"] = $this->email;
        $this->getResultsFromQuery();

        $this->mensaje = "Contacto modificado";
    }

    /**
     * Deletes a contact from the database based on the given ID.
     *
     * @param string $id The ID of the contact to delete.
     * @return void
     */
    public function delete($id = ""): void
    {
        $this->query = "DELETE FROM contactos WHERE id = :id";
        $this->params["id"] = $id;
        $this->getResultsFromQuery();
        $this->mensaje = "Contacto eliminado";
    }

    /**
     * Retrieves contact records from the database based on the provided search criteria.
     *
     * @param string $nombre The name or partial name to search for.
     * @return array An array of contact records matching the search criteria.
     */
    public function getByAll($nombre = ""): array
    {
        $this->query = "SELECT * FROM contactos
            WHERE nombre LIKE :nombre OR telefono LIKE :telefono OR email LIKE :email";
        $this->params["nombre"] = "%$nombre%";
        $this->params["telefono"] = "%$nombre%";
        $this->params["email"] = "%$nombre%";
        $this->getResultsFromQuery();
        return $this->rows;
    }
    }
