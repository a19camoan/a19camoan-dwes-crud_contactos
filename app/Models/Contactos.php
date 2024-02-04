<?php

    namespace App\Models;

    class Contactos extends DBAsbtractModel {
        private static $instancia;

        private $id;
        private $nombre;
        private $telefono;
        private $email;
        private $created_at;
        private $updated_at;


        public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase;
            }
            return self::$instancia;
        }

        public function __clone() {
            trigger_error('La clonación no está permitida', E_USER_ERROR);
        }


        #getter y setter de los atrubutos
        public function setId ($id) {
            $this->id = $id;
        }
        public function getId ($id) {
            return $this->id;
        }

        
        public function setNombre ($nombre) {
            $this->nombre = $nombre;
        }
        public function getNombre ($nombre) {
            return $this->nombre;
        }


        public function setTelefono ($telefono) {
            $this->telefono = $telefono;
        }
        public function getTelefono ($telefono) {
            return $this->telefono;
        }

        public function setEmail ($email) {
            $this->email = $email;
        }
        public function getEmail ($email) {
            return $this->email;
        }

        public function setCreatedAt ($created_at) {
            $this->created_at = $created_at;
        }
        public function getCreatedAt ($created_at) {
            return $this->created_at;
        }

        public function setUpdatedAt ($updated_at) {
            $this->updated_at = $updated_at;
        }
        public function getUpdatedAt ($updated_at) {
            return $this->updated_at;
        }
      

        public function set($sh_data=array()) {
            $this->query = "INSERT INTO contactos (nombre, telefono, email) VALUES (:nombre, :telefono, :email)";
            $this->params['nombre'] = $this->nombre;
            $this->params['telefono'] = $this->telefono;
            $this->params['email'] = $this->email;
            $this->get_results_from_query();
            // $this->execute_single_query();
            $this->mensaje = "SH añadido";
        }
        
        public function getAll() {
            $this->query = "SELECT * FROM contactos";
            $this->get_results_from_query();
            return $this->rows;
        }

        public function get($id='') {
            if ($id != '') {
                $this->query = "SELECT * FROM contactos WHERE id = :id";
                $this->params['id'] = $id;
                $this->get_results_from_query();
            }

            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $propiedad=>$valor) {
                    $this->$propiedad = $valor;
                }
                $this->mensaje = "SH encontrado";
            } else {
                $this->mensaje = "SH no encontrado";
            }

            return $this->rows[0] ?? null;
        }

        public function edit($id='', $user_data=array()) {
            $fecha = new \DateTime();

            $this->query = "UPDATE contactos SET nombre=:nombre, telefono=:telefono, email=:email, updated_at=:fecha WHERE id=:id";

            $this->params['id'] = $this->id;
            $this->params['nombre'] = $this->nombre;
            $this->params['telefono'] = $this->telefono;
            $this->params['email'] = $this->email;
            $this->params['fecha'] = $fecha->format('Y-m-d H:i:s');

            $this->mensaje = "SH modificado";
        }

        public function delete($id='') {
            $this->query = "DELETE FROM contactos WHERE id=:id";
            $this->params['id'] = $id;
            $this->get_results_from_query();
            $this->mensaje = "SH eliminado";
        }

    }
?>