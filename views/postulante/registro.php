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
    <script src="../../assets/js/funcion_registro.js"></script>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="/../../assets/css/output.css" rel="stylesheet">
</head>
<body class="bg-[url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071')] bg-cover bg-center font-sans relative auth-page">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm z-0"></div>
    <div class="bg-white rounded-2xl shadow-2xl w-[400px] max-w-lg z-10 overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="flex h-1.5 w-full">
            <div class="w-1/4 bg-green-300"></div>
            <div class="w-1/4 bg-emerald-500"></div>
            <div class="w-1/4 bg-teal-500"></div>
            <div class="w-1/4 bg-violet-600"></div>
        </div>
        <div class="p-8 space-y-4">
            <div class="text-center space-y-1">
                <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center border-4 border-white shadow-inner">
                    <img src="../../assets/img/logo.png" alt="WorKly" class="w-10 h-10 object-contain">
                </div>
                <h1 class="text-xl font-bold text-gray-800 tracking-tight">Crea tu cuenta</h1>
                <p class="text-xs text-gray-500 italic">¡Únete a miles de profesionales!</p>
            </div>
            <form action="../../src/Controllers/registrar_postulante.php" method="POST" class="space-y-4">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Nombre</label>
                    <input type="text" name="nombre" placeholder="Ej. Juan" required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm">
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Apellidos</label>
                    <input type="text" name="apellido" placeholder="Ej. Pérez" required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm">
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Correo Electrónico</label>
                    <input type="email" name="correo" placeholder="juan@ejemplo.com" required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm">
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Contraseña</label>
                    <div class="relative">
                        <input type="password" id="registro_password" name="password" placeholder="••••••••" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm bg-gray-50 pr-10">
                        <button type="button" onclick="togglePassword('registro_password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="mt-2 space-y-1.5">
                        <div class="h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                            <div id="strength_bar" class="h-full w-0 transition-all duration-300"></div>
                        </div>
                        <p id="strength_text" class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Introduce una contraseña</p>
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