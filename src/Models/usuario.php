<?php
    class usuario{
        private $pdo;
        public function __construct($conexion){
            $this->pdo = $conexion;
        }
        public function obtenerPorCorreo($correo){
            $sql = "SELECT * FROM sc_bolsa.sp_obtener_usuario_login(:correo)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['correo' => $correo]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function registrar($nombre, $apellido, $correo, $password, $id_rol){
            $sql = "SELECT * FROM sc_bolsa.sp_registrar_usuario(:nombre, :apellido, :correo, :password, :id_rol)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':correo' => $correo,
                ':password' => $password,
                ':id_rol' => $id_rol
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function registrarEmpresa($nombre, $apellido, $ruc, $razon_social, $correo, $password, $id_rol){
            $sql = "SELECT * FROM sc_bolsa.sp_regisgtrar_empresa(:nombre, :apellido, :ruc, :razon_social, :correo, :password, :id_rol)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':ruc' => $ruc,
                ':razon_social' => $razon_social,
                ':correo' => $correo,
                ':password' => $password,
                ':id_rol' => $id_rol
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>