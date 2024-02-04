<?php
    namespace App\Models;

    use PDO;
    use PDOException;

    abstract class DBAsbtractModel
    {
        private static $dbHost = DBHOST; // database en docker
        private static $dbUser = DBUSER;
        private static $dbPass = DBPASS;
        private static $dbName = DBNAME;
        private static $dbPort = DBPORT;

        public $message = "";
        protected $conn; // Manejador de la BD

        # Manejo básico para consultas consultas.
        protected $query; // consulta
        protected $params = array(); // parámetros de entrada
        protected $rows = array(); // array con los datos de salida

        # Metodos abstractos para implementar en los diferentes módulos.
        abstract protected function get();
        abstract protected function set();
        abstract protected function edit();
        abstract protected function delete();

        # Crear conexión a la base de datos
        protected function openConnection()
        {
            $dsn = "mysql:host=" . self::$dbHost . ";"
                . "dbname=" . self::$dbName . ";"
                . "port=" . self::$dbPort;
            try {
                return $this->conn = new PDO(
                    $dsn,
                    self::$dbUser,
                    self::$dbPass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                );
            } catch (PDOException $e) {
                printf("Conexión fallida: %s\n", $e->getMessage());
                exit();
            }
        }

        # Método que devuelve el último id introducido.
        public function lastInsert()
        {
            return $this->conn->lastInsertId();
        }

        # Desconectar la base de datos
        private function closeConnection()
        {
            $this->conn = null;
        }

        # Traer resultados de una consulta en un Array
        # Consulta que devuelve tuplas de la tabla.
        protected function getResultsFromQuery()
        {
            $this->openConnection();
            if ($_stmt = $this->conn->prepare($this->query)) {
                # PREG_PATTERN_ORDER flag para especificar como se cargan los resultados en $named.
                if (preg_match_all('/(:\w+)/', $this->query, $_named, PREG_PATTERN_ORDER)) {
                    $_named = array_pop($_named);
                    foreach ($_named as $_param) {
                        $_stmt->bindValue($_param, $this->params[substr($_param, 1)]);
                    }
                }

                try {
                    if (!$_stmt->execute()) {
                        printf("Error de consulta: %s\n", $_stmt->errorInfo()[2]);
                    }

                    $this->rows = $_stmt->fetchAll(PDO::FETCH_ASSOC);
                    $_stmt->closeCursor();
                } catch (PDOException $e) {
                    printf("Error en consulta: %s\n", $e->getMessage());
                }
            }
        }
    }
