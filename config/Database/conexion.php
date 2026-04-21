<?php
    require_once 'settings.php';
    class Database{
        private $pdo;

        public function getConnection(){
            $this->pdo = null;

            $dsn = "pgsql:host=" . DB_HOST. ";" ."port=" . DB_PORT . ";" . "dbname=" . DB_NAME . ";";

            try {
                $this->pdo = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);

                return $this->pdo;
            } catch (PDOException $e) {
                error_log ("Error de conexión: " . $e->getMessage());
                die("Lo sentimos, no se pudo conectar al servidor");
            }
        }
    }
