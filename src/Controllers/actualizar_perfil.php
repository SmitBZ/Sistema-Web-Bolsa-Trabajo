<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once __DIR__ . '/../../config/Database/Conexion.php';

    $db = new Database();
    $pdo = $db->getConnection();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usr_id = $_SESSION['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $descripcion = $_POST['descripcion'];
        $departamento = $_POST['departamento'];
        $cargo = $_POST['cargo'];

        try {
            $pdo->beginTransaction();

            $sql_u = "UPDATE sc_bolsa.tb_usuario SET usr_nombre = ?, usr_apellido = ? WHERE usr_id = ?";
            $pdo->prepare($sql_u)->execute([$nombre, $apellido, $usr_id]);

            if (!empty($_FILES['foto']['name'])) {
                $ruta_foto = "../../assets/uploads/perfiles/" . $usr_id . ".jpg";
            if (!file_exists('../../assets/uploads/perfiles/')) {
                mkdir('../../assets/uploads/perfiles/', 0777, true);
            }
            move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_foto);
            $pdo->prepare("UPDATE sc_bolsa.tb_usuario SET usr_foto = ? WHERE usr_id = ?")->execute([$ruta_foto, $usr_id]);
        }

        $stmt_check = $pdo->prepare("SELECT prf_id FROM sc_bolsa.tb_perfil WHERE usr_id = ?");
        $stmt_check->execute([$usr_id]);
        $perfil = $stmt_check->fetch();

        if (!$perfil) {
            $stmt_ins = $pdo->prepare("INSERT INTO sc_bolsa.tb_perfil (usr_id, prf_descripcion, prf_cargo_principal, prf_departamento) VALUES (?, ?, ?, ?) RETURNING prf_id");
            $stmt_ins->execute([$usr_id, $descripcion, $cargo, $departamento]);
            $prf_id = $stmt_ins->fetchColumn();
        } else {
            $prf_id = $perfil['prf_id'];
            $pdo->prepare("UPDATE sc_bolsa.tb_perfil SET prf_descripcion = ?, prf_cargo_principal = ?, prf_departamento = ? WHERE prf_id = ?")
                ->execute([$descripcion, $cargo, $departamento, $prf_id]);
        }

        $pdo->prepare("DELETE FROM sc_bolsa.tb_experiencia WHERE prf_id = ?")->execute([$prf_id]);
        if (isset($_POST['exp_empresa'])) {
            foreach ($_POST['exp_empresa'] as $key => $empresa) {
                if (!empty($empresa)) {
                    $sql_exp = "INSERT INTO sc_bolsa.tb_experiencia (prf_id, exp_empresa, exp_cargo, exp_fch_inicio, exp_fch_fin, exp_descripcion) VALUES (?,?,?,?,?,?)";
                    $pdo->prepare($sql_exp)->execute([
                        $prf_id,
                        $empresa,
                        $_POST['exp_cargo'][$key],
                        !empty($_POST['exp_fch_inicio'][$key]) ? $_POST['exp_fch_inicio'][$key] : null,
                        !empty($_POST['exp_fch_fin'][$key]) ? $_POST['exp_fch_fin'][$key] : null,
                        $_POST['exp_desc'][$key]
                    ]);
                }
            }
        }

        $pdo->prepare("DELETE FROM sc_bolsa.tb_educacion WHERE prf_id = ?")->execute([$prf_id]);
        if (isset($_POST['edu_institucion'])) {
            foreach ($_POST['edu_institucion'] as $key => $institucion) {
                if (!empty($institucion)) {
                    $sql_edu = "INSERT INTO sc_bolsa.tb_educacion (prf_id, edu_institucion, edu_titulo, edu_fch_inicio, edu_fch_fin) VALUES (?,?,?,?,?)";
                    $pdo->prepare($sql_edu)->execute([
                        $prf_id,
                        $institucion,
                        $_POST['edu_grado'][$key],
                        !empty($_POST['edu_fch_inicio'][$key]) ? $_POST['edu_fch_inicio'][$key] : null,
                        !empty($_POST['edu_fch_fin'][$key]) ? $_POST['edu_fch_fin'][$key] : null
                    ]);
                }
            }
        }

        $pdo->prepare("DELETE FROM sc_bolsa.tb_habilidad WHERE prf_id = ?")->execute([$prf_id]);
        if (isset($_POST['habilidades'])) {
            $habs = explode(',', $_POST['habilidades']);
            foreach ($habs as $h) {
                $h = trim($h);
                if (!empty($h)) {
                    $pdo->prepare("INSERT INTO sc_bolsa.tb_habilidad (prf_id, hab_nombre) VALUES (?,?)")->execute([$prf_id, $h]);
                }
            }
        }

        $pdo->prepare("DELETE FROM sc_bolsa.tb_idioma WHERE prf_id = ?")->execute([$prf_id]);
        if (isset($_POST['idm_nombre'])) {
            foreach ($_POST['idm_nombre'] as $key => $nombre_idm) {
                if (!empty($nombre_idm)) {
                    $pdo->prepare("INSERT INTO sc_bolsa.tb_idioma (prf_id, idm_nombre, idm_nivel) VALUES (?,?,?)")
                        ->execute([$prf_id, $nombre_idm, $_POST['idm_nivel'][$key]]);
                }
            }
        }

        $pdo->commit();
        header("Location: ../../views/postulante/perfil.php?status=updated");

    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Error al actualizar: " . $e->getMessage());
    }
}