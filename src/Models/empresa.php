<?php
    class empresa{
        private $pdo;
        public function __construct($conexion){
            $this->pdo = $conexion;
        }

        public function mostrarEmpresa($empr_id){
            $sql = "SELECT * FROM empresa";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $empr_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
