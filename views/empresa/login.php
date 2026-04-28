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
    <title>Acceso Empresas - Workly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="../../assets/js/general.js" defer></script>
    <link rel="icon" href="../../assets/img/logo.png">
</head>
<body class="bg-[url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071')] bg-cover bg-center font-sans relative auth-page">
<div class="absolute inset-0 bg-black/60 backdrop-blur-sm z-0"></div>
<div class="bg-white rounded-2xl shadow-2xl w-[400px] max-w-lg z-10 overflow-hidden">
    <div class="flex h-1.5 w-full">
        <div class="w-1/3 bg-blue-400"></div>
        <div class="w-1/3 bg-blue-600"></div>
        <div class="w-1/3 bg-slate-800"></div>
    </div>
    <div class="p-10 space-y-8">
        <div class="text-center space-y-3">
            <div class="mx-auto w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center border border-gray-100 shadow-sm">
                <img src="../../assets/img/logo.png" alt="Workly" class="w-12 h-12">
            </div>
            <div>
                <h1 class="text-2xl font-black text-gray-800 uppercase tracking-tighter">Portal Empresas</h1>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Gestiona tu talento hoy mismo</p>
            </div>
        </div>

        <form action="../../src/Controllers/validar_login.php" method="post" class="space-y-6">
            <div class="space-y-1.5">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Correo Corporativo</label>
                <div class="relative">
                    <input type="email" name="correo" placeholder="correo@gmail.com" required
                           class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:ring-2 border-1 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all text-base placeholder:text-gray-500">
                </div>
            </div>

            <div class="space-y-1.5">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Contraseña</label>
                    <a href="#" class="text-[10px] text-blue-600 font-black uppercase tracking-widest hover:underline">¿Olvidaste la clave?</a>
                </div>
                <div class="relative">
                    <input type="password" id="login_password" name="password" placeholder="Ingrese su contraseña" required class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:ring-2 border-1 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all text-base placeholder:text-gray-500">
                    <button type="button" onclick="togglePassword('login_password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#005cbf] hover:bg-[#004ca8] text-white font-bold py-3.5 rounded-md shadow-lg transform active:scale-[0.98] transition duration-150 text-base flex items-center justify-center gap-2">
                <span>Iniciar Sesion</span>
            </button>
            <div class="text-center pt-4 border-t border-gray-50">
                <p class="text-sm font-medium text-gray-500">¿Aún no publicas con nosotros? <br>
                    <a href="registro.php" class="text-blue-600 font-black hover:underline mt-2 inline-block uppercase text-xs tracking-widest">Registra tu Empresa</a>
                </p>
            </div>
            <div class="text-center">
                <a href="../../index.php" class="text-[10px] text-gray-400 font-bold uppercase tracking-widest hover:text-gray-600 transition">
                    <i class="fas fa-arrow-left mr-1"></i> Volver al inicio
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>