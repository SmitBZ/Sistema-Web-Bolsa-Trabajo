<?php
    session_start();
    require_once __DIR__ . '/../../config/Database/Conexion.php';

    $nombre   = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo   = $_POST['correo'];
    $password = $_POST['password'];
    $id_rol   = 2;

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    try {
        $db = new Database();
        $pdo = $db->getConnection();
        $sql = "SELECT * FROM sc_bolsa.sp_registrar_usuario(:nombre, :apellido, :correo, :password, :id_rol)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
        ':nombre'   => $nombre,
        ':apellido' => $apellido,
        ':correo'   => $correo,
        ':password' => $passwordHash,
        ':id_rol'   => $id_rol
    ]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado && ($resultado['success'] === true || $resultado['success'] === 't')) {

        $sql_session = "SELECT * FROM sc_bolsa.sp_obtener_usuario_login(:correo)";
        $stmt_s = $pdo->prepare($sql_session);
        $stmt_s->execute([':correo' => $correo]);
        $user_data = $stmt_s->fetch(PDO::FETCH_ASSOC);

            if ($user_data) {
                $_SESSION['id']      = $user_data['usr_id'];
                $_SESSION['usuario'] = $user_data['usr_nombre'] . " " . $user_data['usr_apellido'];
                $_SESSION['rol']     = $user_data['rl_id'];
                header("Location: ../../views/postulante/login.php?status=success&msg=¡Registro exitoso! Bienvenido a Workly.");
                exit();
            }
        } else {
            header("Location: ../../views/postulante/registro.php?error=exists");
            exit();
        }
    } catch(Exception $e) {
        header("Location: ../../views/postulante/registro.php?error=db_error");
        exit();
    }
