<?php
    namespace App\Models;

    #[\AllowDynamicProperties]
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

        public function set($sh_data = array())
        {
            $this->query = "INSERT INTO contactos (nombre, telefono, email) VALUES (:nombre, :telefono, :email)";
            $this->params["nombre"] = $this->nombre;
            $this->params["telefono"] = $this->telefono;
            $this->params["email"] = $this->email;
            $this->getResultsFromQuery();
            $this->mensaje = "Contacto añadido";
        }

        public function getAll()
        {
            $this->query = "SELECT * FROM contactos";
            $this->getResultsFromQuery();
            return $this->rows;
        }

        public function get($id = "")
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

        public function edit()
        {
            $this->query = "UPDATE contactos SET nombre=:nombre, telefono=:telefono, email=:email WHERE id=:id";

            $this->params["id"] = $this->id;
            $this->params["nombre"] = $this->nombre;
            $this->params["telefono"] = $this->telefono;
            $this->params["email"] = $this->email;
            $this->getResultsFromQuery();

            $this->mensaje = "Contacto modificado";
        }

        public function delete($id = "")
        {
            $this->query = "DELETE FROM contactos WHERE id = :id";
            $this->params["id"] = $id;
            $this->getResultsFromQuery();
            $this->mensaje = "Contacto eliminado";
        }
    }
