<?php
    session_start();
    require_once __DIR__ . '/../../config/Database/conexion.php';
    require_once __DIR__ . '/../Models/usuario.php';

    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $database = new Database();
        $pdo = $database->getConnection();
        $usuarioModel = new usuario($pdo);
        $usuario = $usuarioModel->obtenerPorCorreo($correo);

        if ($usuario && password_verify($password, $usuario['usr_password'])) {
            $_SESSION['id'] = $usuario['usr_id'];
            $_SESSION['usuario'] = $usuario['usr_nombre'] . " " . $usuario['usr_apellido'];
            $_SESSION['email'] = $usuario['usr_correo'];
            $_SESSION['rol'] = $usuario['rl_id'];

            $ruta = ($usuario['rl_id'] == 2) ? 'postulante/home.php' : 'empresa/home.php';
            header("Location: ../../views/$ruta?status=success&msg=¡Bienvenido a Workly!");
            exit();
        } else {
            header("Location: ../../views/postulante/login.php?error=invalid_credentials");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Error en Login: " . $e->getMessage());
        header("Location: ../../views/postulante/login.php?error=db_error");
    }