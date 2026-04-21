<?php
    session_start();
    require_once __DIR__ . '/../../config/Database/conexion.php';

    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';
    try {

        $database = new Database();
        $pdo = $database->getConnection();

        $sql = "SELECT * FROM sc_bolsa.sp_obtener_usuario_login(:correo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['correo' => $correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['usr_password'])) {

            $_SESSION['id'] = $usuario['usr_id'];
            $_SESSION['usuario'] = $usuario['usr_nombre'] . " " . $usuario['usr_apellido'];
            $_SESSION['email'] = $usuario['usr_correo'];
            $_SESSION['nombre'] = $usuario['usr_nombre'];
            $_SESSION['apellido'] = $usuario['usr_apellido'];
            $_SESSION['rol'] = $usuario['rl_id'];

            if($usuario['rl_id'] == 2){
                header('location: ../../views/postulante/home.php');
            }else if($usuario['rl_id'] == 3){
                header('location: ../../views/empresa/home.php');
            }
            exit();

        } else {
            header("Location: ../views/login.php?error=invalid_credentials");
            exit();
        }

    } catch (PDOException $e) {
        error_log("Error en Login: " . $e->getMessage());
        header("Location: ../views/login.php?error=db_error");
        exit();
    }