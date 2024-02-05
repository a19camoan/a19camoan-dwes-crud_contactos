<?php
    namespace App\Models;

    class Usuarios extends DBAsbtractModel
    {
        private static $instancia;

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

        public function login($usuario, $password)
        {
            # password_verify()
            $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";
            $this->params["usuario"] = $usuario;
            $this->params["password"] = $password;

            $this->getResultsFromQuery();
            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $propiedad => $valor) {
                    $this->$propiedad = $valor;
                }
                $this->mensaje = "sh encontrado";
            } else {
                $this->mensaje = "sh no encontrado";
            }

            return $this->rows[0] ?? null;
        }

        public function getByCredentials($usuario = "", $password = "")
        {
            if ($usuario != "" && $password != "") {
                $this -> query = "SELECT * FROM usuarios
                WHERE usuario = :usuario AND password = :password";
                $this -> params["usuario"] = $usuario;
                $this -> params["password"] = $password;
                $this -> getResultsFromQuery();
            }

            if (count($this -> rows) == 1) {
                foreach ($this -> rows[0] as $propiedad => $valor) {
                    $this -> $propiedad = $valor;
                }
                $this -> mensaje = "Usuario encontrado";
            } else {
                $this -> mensaje = "Usuario no encontrado";
            }

            return $this -> rows[0] ?? null;
        }

        public function get($id = "")
        {
            # Not implemented
        }
        public function set()
        {
            # Not implemented
        }
        public function edit()
        {
            # Not implemented
        }
        public function delete()
        {
            # Not implemented
        }
    }
