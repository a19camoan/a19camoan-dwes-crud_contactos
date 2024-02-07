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
        private static $instancia;

        private $id;
        private $nombre;
        private $telefono;
        private $email;
        private $createdAt;
        private $updatedAt;

        
        public static function getInstancia()
        {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase;
            }
            return self::$instancia;
        }

        public function __clone()
        {
            trigger_error("La clonación no está permitida", E_USER_ERROR);
        }

        #getter y setter de los atrubutos
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId($id)
        {
            return $this->id;
        }

        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        public function getNombre($nombre)
        {
            return $this->nombre;
        }

        public function setTelefono($telefono)
        {
            $this->telefono = $telefono;
        }
        public function getTelefono($telefono)
        {
            return $this->telefono;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }
        public function getEmail($email)
        {
            return $this->email;
        }

        public function setCreatedAt($createdAt)
        {
            $this->createdAt = $createdAt;
        }
        public function getCreatedAt($createdAt)
        {
            return $this->createdAt;
        }

        public function setUpdatedAt($updatedAt)
        {
            $this->updatedAt = $updatedAt;
        }
        public function getUpdatedAt($updatedAt)
        {
            return $this->updatedAt;
        }

        /**
         * Sets the data for the Contactos model.
         *
         * @param array $sh_data The data to be set.
         * @return void
         */
        public function set($sh_data = array()) : void
        {
            $this->query = "INSERT INTO contactos (nombre, telefono, email) VALUES (:nombre, :telefono, :email)";
            $this->params["nombre"] = $this->nombre;
            $this->params["telefono"] = $this->telefono;
            $this->params["email"] = $this->email;
            $this->getResultsFromQuery();
            $this->mensaje = "Contacto añadido";
        }

        /**
         * Retrieves all contact records.
         *
         * @return array An array containing all contact records.
         */
        public function getAll() : array
        {
            $this->query = "SELECT * FROM contactos";
            $this->getResultsFromQuery();
            return $this->rows;
        }

        /**
         * Retrieves contact information.
         *
         * @param string $id The ID of the contact to retrieve. If empty, retrieves all contacts.
         * @return array An array containing the contact information.
         */
        public function get($id = "") : array
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
         * Edit the contact.
         *
         * @return void
         */
        public function edit() : void
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
         * Deletes a contact.
         *
         * @param string $id The ID of the contact to delete.
         * @return void
         */
        public function delete($id = "") : void
        {
            $this->query = "DELETE FROM contactos WHERE id = :id";
            $this->params["id"] = $id;
            $this->getResultsFromQuery();
            $this->mensaje = "Contacto eliminado";
        }

        
        /**
         * Retrieves contact records based on the given name.
         *
         * @param string $nombre The name to search for (optional)
         * @return array The contact records matching the given name
         */
        public function getByAll($nombre = "") : array
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
