<?php
    require_once __DIR__ . '/../../config/Database/conexion.php';
    require_once __DIR__ . '/../Models/postulante.php';
    class mostrar_perfil {
        public function cargarPerfil() {
            if (session_status() === PHP_SESSION_NONE) session_start();
            if (!isset($_SESSION['id'])) {
                header("Location: ../../index.php");
                exit();
            }
            try {
                $db = (new Database())->getConnection();
                $model = new postulante($db);
                $usr_id = $_SESSION['id'];
                $datos = $model->mostrarDatos($usr_id);
                if (!$datos) return null;
                $prf_id = $datos['prf_id'];
                return [
                    'info' => [
                        'nombre' => $datos['usr_nombre'] . " " . $datos['usr_apellido'],
                        'correo' => $datos['usr_corrreo'],
                        'foto'   => !empty($datos['usr_foto']) ? $datos['usr_foto'] : '../../assets/img/perfil.png',
                        'bio'    => $datos['prf_descripcion'] ?? 'Aún no has añadido una descripción.',
                        'cargo'  => $datos['prf_cargo_principal'] ?? 'Postulante',
                        'dep'    => $datos['prf_departamento'] ?? 'No especificado'
                    ],
                        'experiencias' => $model->mostrarExperiencia($prf_id),
                        'educaciones'  => $model->mostrarEducacion($prf_id),
                        'habilidades'  => $model->mostrarHabilidades($prf_id),
                        'idiomas'      => $model->mostrarIdiomas($prf_id)
                ];
            } catch (Exception $e) {
                error_log("Error: " . $e->getMessage());
                return null;
            }
        }
        public static function formatPeriodo($inicio, $fin) {
            if (!$inicio) return "No especificado";
            $meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
            $f_i = new DateTime($inicio);
            $res = $meses[$f_i->format('n')-1] . " " . $f_i->format('Y');
            $res .= ($fin) ? " — " . $meses[(new DateTime($fin))->format('n')-1] . " " . (new DateTime($fin))->format('Y') : " — Actualidad";
            return $res;
        }
    }
?>