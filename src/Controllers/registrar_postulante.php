<?php
    session_start();
    require_once __DIR__ . '/../../config/Database/Conexion.php';
    require_once __DIR__ . '/../Models/usuario.php';

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $id_rol = 2;

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    try {
        $db = new Database();
        $pdo = $db->getConnection();
        $usuarioModel = new usuario($pdo);
        $resultado = $usuarioModel->registrar($nombre, $apellido, $correo, $passwordHash, $id_rol);

        if ($resultado && ($resultado['success'] === true || $resultado['success'] === 't')) {

            $user_data = $usuarioModel->obtenerPorCorreo($correo);
            if ($user_data) {
                $_SESSION['id'] = $user_data['usr_id'];
                $_SESSION['rol'] = $user_data['rl_id'];
                header("Location: ../../views/postulante/login.php?status=success&msg=¡Registro exitoso!");
                exit();
            }
        } else {
            header("Location: ../../views/postulante/registro.php?error=exists");
            exit();
        }
    } catch (Exception $e) {
        header("Location: ../../views/postulante/registro.php?error=db_error");
    }
?>