<?php
    class postulante{
        private $pdo;
        public function __construct($conexion){
            $this->pdo = $conexion;
        }
        public function mostrarDatos($usr_id){
            $sql = "SELECT * FROM sc_bolsa.sp_obtener_datos_perfil(:id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $usr_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function mostrarExperiencia($prf_id){
            $stmt = $this->pdo->prepare("SELECT * FROM sc_bolsa.tb_experiencia WHERE prf_id = ? ORDER BY exp_fch_inicio DESC");
            $stmt->execute([$prf_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function mostrarEducacion($prf_id){
            $stmt = $this->pdo->prepare("SELECT * FROM sc_bolsa.tb_educacion WHERE prf_id = ? ORDER BY edu_fch_inicio DESC");
            $stmt->execute([$prf_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function mostrarHabilidades($prf_id){
            $stmt = $this->pdo->prepare("SELECT hab_nombre FROM sc_bolsa.tb_habilidad WHERE prf_id = ?");
            $stmt->execute([$prf_id]);
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        public function mostrarIdiomas($prf_id){
            $stmt = $this->pdo->prepare("SELECT idm_nombre, idm_nivel FROM sc_bolsa.tb_idioma WHERE prf_id = ?");
            $stmt->execute([$prf_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
