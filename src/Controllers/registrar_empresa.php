<?php
    session_start();
    require_once __DIR__ . '/../../config/Database/Conexion.php';
    require_once __DIR__ . '/../Models/usuario.php';

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ruc = $_POST['ruc'];
    $rzn_social = $_POST['razon_social'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $id_rol = 3;

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    try {
        $db = new Database();
        $pdo = $db->getConnection();
        $usuarioModel = new usuario($pdo);
        $resultado = $usuarioModel->registrarEmpresa($nombre, $apellido,$ruc, $rzn_social, $correo, $passwordHash, $id_rol);

        if ($resultado && ($resultado['success'] === true || $resultado['success'] === 't')) {

            $user_data = $usuarioModel->obtenerPorCorreo($correo);
            if ($user_data) {
                $_SESSION['id'] = $user_data['usr_id'];
                $_SESSION['rol'] = $user_data['rl_id'];
                header("Location: ../../views/empresa/login.php?status=success&msg=¡Registro exitoso!");
                exit();
            }
        } else {
            header("Location: ../../views/empresa/registro.php?error=exists");
            exit();
        }
    } catch (Exception $e) {
        header("Location: ../../views/empresa/registro.php?error=db_error");
    }
?>
