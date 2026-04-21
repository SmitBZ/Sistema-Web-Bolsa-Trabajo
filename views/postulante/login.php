<?php
    session_start();
    if(isset($_SESSION['id'])){
        header("location: home.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesión - Workly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="../../assets/js/app.js" defer></script>
    <link rel="icon" href="../../assets/img/logo.png">
</head>
<body class="bg-[url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071')] bg-cover bg-center font-sans relative auth-page">

<div class="absolute inset-0 bg-black/60 backdrop-blur-sm z-0"></div>

<div class="bg-white rounded-2xl shadow-2xl w-[400px] max-w-lg z-10 overflow-hidden">

    <div class="flex h-1.5 w-full">
        <div class="w-1/4 bg-green-300"></div>
        <div class="w-1/4 bg-emerald-500"></div>
        <div class="w-1/4 bg-teal-500"></div>
        <div class="w-1/4 bg-violet-600"></div>
    </div>

    <div class="p-10 space-y-8">
        <div class="text-center space-y-3">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center border-4 border-white shadow-inner">
                <span class="text-4xl"><img src="../../assets/img/logo.png" alt="Workly" class="w-full h-full object-cover"></span>
            </div>
            <h1 class="text-xl font-bold text-gray-800 tracking-tight">Workly</h1>
            <p class="text-sm font-semibold text-gray-700">Encuentra grandes oportunidades de trabajo</p>
            <p class="text-xs text-gray-500">Inicia sesión para continuar</p>
        </div>

        <form action="../../src/Controllers/validar_login.php" method="post" class="space-y-6">
            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-gray-700">Correo Electrónico</label>
                <input type="email" name="correo" placeholder="Ingrese su correo electrónico" required
                       class="w-full px-2 py-2 rounded-md border border-gray-300 focus:ring-2 border-1 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition text-base placeholder:text-gray-400">
            </div>

            <div class="space-y-1.5">
                <div class="flex justify-between items-center">
                    <label class="block text-sm font-semibold text-gray-700">Contraseña</label>
                    <a href="#" class="text-xs text-blue-600 font-semibold hover:underline">Olvidé mi contraseña</a>
                </div>
                <div class="relative">
                    <input type="password" id="login_password" name="password" placeholder="Ingrese su contraseña" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm bg-gray-50 pr-10">
                    <button type="button" onclick="togglePassword('login_password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#005cbf] hover:bg-[#004ca8] text-white font-bold py-3.5 rounded-md shadow-lg transform active:scale-[0.98] transition duration-150 text-base flex items-center justify-center gap-2">
                <span>Iniciar Sesion</span>
            </button>

            <div class="text-center mt-5">
                <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
</body>
</html>