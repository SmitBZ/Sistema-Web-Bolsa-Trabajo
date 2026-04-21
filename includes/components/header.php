<?php
    require_once __DIR__ . '/../../config/Database/Conexion.php';
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit();
    }
    $usuario = $_SESSION['usuario'];
    $usr_id_header = $_SESSION['id'];
    try {
        $database = new Database();
        $pdo = $database->getConnection();
        $sql = "SELECT usr_foto FROM sc_bolsa.tb_usuario WHERE usr_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usr_id_header]);
        $u_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $foto_header = !empty($u_data['usr_foto']) ? $u_data['usr_foto'] : '../../assets/img/perfil.png';
    } catch (Exception $e) {
        $foto_header = '../../assets/img/perfil.png';
    }
?>
<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Workly'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/general.js" defer></script>
    <link href="../../assets/css/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; color: #4a516d; background-color: #f8fafc; }
        /* Colores personalizados */
        .text-workly-gray { color: #656c89; }
        .text-workly-dark { color: #4a516d; }
        .bg-workly-blue { background-color: #385cb4; }
        .border-workly { border-color: #e2e8f0; }

        /* Dropdown Animation */
        #profileMenu.hidden { display: none; }
        #profileMenu { animation: fadeIn 0.2s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

<nav class="bg-white border-b border-workly sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <div class="flex items-center gap-2">
                <a href="../../views/postulante/home.php" class="flex items-center gap-2">
                    <img class="h-8 w-auto" src="../../assets/img/logo.png" alt="Workly">
                    <span class="text-xl font-bold tracking-tight" style="color: #385cb4;">Workly</span>
                </a>
            </div>

            <div class="flex items-center gap-6">
                <div class="relative">
                    <button id="notiBtn" class="relative p-2 text-[#656c89] hover:text-[#385cb4] transition-colors focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1.5 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>

                    <div id="notificationsMenu" class="hidden absolute right-0 mt-3 w-80 bg-white border border-gray-100 rounded-2xl shadow-2xl py-2 z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50">
                            <h3 class="text-xs font-black text-gray-800 uppercase tracking-widest">Notificaciones</h3>
                        </div>
                        <div class="max-h-72 overflow-y-auto">
                            <!-- Ejemplo de Notificación 1 -->
                            <a href="#" class="flex items-start gap-3 px-4 py-4 hover:bg-blue-50 transition border-b border-gray-50 group">
                                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-blue-600 group-hover:text-white transition">
                                    <i class="fas fa-briefcase text-sm"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-bold text-gray-800 leading-tight">Nueva oferta: Desarrollador Backend</p>
                                    <p class="text-[10px] text-gray-500 line-clamp-1">Empresa Tech Chiclayo busca tu perfil.</p>
                                    <p class="text-[9px] text-blue-500 font-bold uppercase">Hace 2 horas</p>
                                </div>
                            </a>
                            <!-- Ejemplo de Notificación 2 -->
                            <a href="#" class="flex items-start gap-3 px-4 py-4 hover:bg-blue-50 transition border-b border-gray-50 group">
                                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition">
                                    <i class="fas fa-eye text-sm"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-bold text-gray-800 leading-tight">¡Tu perfil fue visto!</p>
                                    <p class="text-[10px] text-gray-500 line-clamp-1">Una empresa de Lima revisó tu CV.</p>
                                    <p class="text-[9px] text-blue-500 font-bold uppercase">Hace 5 horas</p>
                                </div>
                            </a>
                        </div>
                        <a href="notificaciones.php" class="block w-full py-3 text-center text-[10px] font-black text-blue-600 uppercase tracking-widest hover:bg-blue-600 hover:text-white transition bg-gray-50/50 mt-1">
                            Mostrar todas las notificaciones
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <button id="profileBtn" class="flex items-center gap-3 focus:outline-none group">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-[#4a516d] group-hover:text-[#385cb4] transition-colors"><?php echo $usuario; ?></p>
                            <p class="text-xs text-[#656c89]">Postulante</p>
                        </div>
                        <img class="h-9 w-9 rounded-full object-cover border-2 border-transparent group-hover:border-[#385cb4] transition-all"
                             src="<?php echo $foto_header; ?>" alt="Usuario">
                    </button>

                    <div id="profileMenu" class="hidden absolute right-0 mt-3 w-52 bg-white border border-gray-100 rounded-xl shadow-xl py-2 z-50">
                        <a href="perfil.php" class="flex items-center gap-3 px-4 py-2 text-sm text-[#4a516d] hover:bg-gray-50 hover:text-[#385cb4] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Mi Perfil
                        </a>
                        <a href="mis_postulaciones.php" class="flex items-center gap-3 px-4 py-2 text-sm text-[#4a516d] hover:bg-gray-50 hover:text-[#385cb4] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Postulaciones
                        </a>
                        <a href="configuracion.php" class="flex items-center gap-3 px-4 py-2 text-sm text-[#4a516d] hover:bg-gray-50 hover:text-[#385cb4] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Configuración
                        </a>
                        <hr class="my-1 border-gray-100">
                        <a href="../../src/Controllers/salir_conexion.php" class="flex items-center gap-3 px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">