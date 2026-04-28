<?php
session_start();
if (isset($_SESSION['id'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Workly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/general.js" defer></script>
    <script src="../../assets/js/funcion_registro.js" defer></script>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="../../assets/img/logo.png">
</head>
<body class="bg-[url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=2069')] bg-cover bg-center font-sans relative min-h-screen flex items-center justify-center py-12">
<div class="absolute inset-0 bg-black/60 backdrop-blur-sm z-0"></div>
<div class="bg-white rounded-2xl shadow-2xl w-[400px] max-w-lg z-10 overflow-hidden animate-in fade-in zoom-in duration-300">
    <div class="flex h-1.5 w-full">
        <div class="w-1/3 bg-blue-400"></div>
        <div class="w-1/3 bg-blue-600"></div>
        <div class="w-1/3 bg-slate-800"></div>
    </div>
    <div class="p-8 space-y-4">
        <div class="text-center space-y-1">
            <div class="mx-auto w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center border border-gray-100 shadow-sm">
                <img src="../../assets/img/logo.png" alt="Workly" class="w-12 h-12">
            </div>
            <div>
                <h1 class="text-2xl font-black text-gray-800 uppercase tracking-tighter">Únete como Empresa</h1>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Encuentra al candidato ideal para tu equipo</p>
            </div>
        </div>
        <form action="../../src/Controllers/registrar_postulante.php" method="POST" class="space-y-4">
            <div class="space-y-1.5">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Nombre</label>
                <div class="relative">
                    <input type="text" name="nombre" placeholder="Ingrese su nombre " required
                           class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:ring-2 border-1 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all text-base placeholder:text-gray-500">
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Apellidos</label>
                <div class="relative">
                    <input type="text" name="apellido" placeholder="Ingrese su apellido" required
                           class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:ring-2 border-1 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all text-base placeholder:text-gray-500">
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">RUC</label>
                <input type="text" name="ruc" placeholder="11 dígitos" required pattern="[0-9]{11}" maxlength="11"
                       class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:ring-2 border-1 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all text-base placeholder:text-gray-500">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Razón Social</label>
                <input type="text" name="razon_social" placeholder="Nombre de la empresa" required
                       class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:ring-2 border-1 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all text-base placeholder:text-gray-500">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Correo Corporativo</label>
                <div class="relative">
                    <input type="email" name="correo" placeholder="Ingresa su correo corporativo" required
                           class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:ring-2 border-1 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all text-base placeholder:text-gray-500">
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Contraseña</label>
                <div class="relative">
                    <input type="password" id="registro_password" name="password" placeholder="••••••••" required
                           class="w-full pl-5 pr-12 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-600 outline-none transition-all font-bold text-gray-700 text-sm">
                    <button type="button" onclick="togglePassword('registro_password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="mt-2 space-y-1.5">
                    <div class="h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                        <div id="strength_bar" class="h-full w-0 transition-all duration-300"></div>
                    </div>
                    <p id="strength_text" class="text-[10px] font-bold uppercase tracking-widest text-gray-400"></p>
                </div>
            </div>
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-200 transform active:scale-[0.98] transition duration-150 text-sm uppercase tracking-widest mt-4">
                Registrarse Gratis
            </button>
            <div class="text-center pt-2">
                <p class="text-xs text-gray-500">¿Ya tienes cuenta? <a href="login.php" class="text-blue-600 font-bold hover:underline">Inicia sesión</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>