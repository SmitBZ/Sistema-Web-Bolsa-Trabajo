<?php
    require_once __DIR__ . '/../../config/Database/conexion.php';
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if (!isset($_SESSION['id'])) {
        header("Location: ../../../index.php");
        exit();
    }
    $usuario = $_SESSION['usuario'] ?? 'Empresa';
    $usr_id_header = $_SESSION['id'];
    try {
        $database = new Database();
        $pdo = $database->getConnection();
        $sql = "SELECT usr_foto FROM sc_bolsa.tb_usuario WHERE usr_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usr_id_header]);
        $u_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $foto_header = !empty($u_data['usr_foto']) ? $u_data['usr_foto'] : '../../assets/img/empresa_default.png';
    } catch (Exception $e) {
        $foto_header = '../../assets/img/empresa_default.png';
    }
?>
<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Workly - Empresa'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/general.js" defer></script>
    <link href="../../assets/css/output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; color: #4a516d; background-color: #f8fafc; }
        .text-workly-gray { color: #656c89; }
        .text-workly-dark { color: #4a516d; }
        .bg-workly-blue { background-color: #4f46e5; } /* Usando un indigo/blue distinto para empresas */
        .border-workly { border-color: #e2e8f0; }

        #profileMenu.hidden { display: none; }
        #profileMenu { animation: fadeIn 0.2s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

<nav class="bg-white border-b border-workly sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <div class="flex items-center gap-6">
                <a href="home.php" class="flex items-center gap-2">
                    <img class="h-8 w-auto" src="../../assets/img/logo.png" alt="Workly">
                    <span class="text-xl font-black tracking-tight text-indigo-600">Workly <span class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Empresas</span></span>
                </a>
                
                <div class="hidden md:flex items-center gap-1 ml-4 border-l border-slate-200 pl-6">
                    <a href="home.php" class="px-4 py-2 text-sm font-semibold rounded-lg <?php echo (isset($activePage) && $activePage == 'home') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600'; ?> transition">Dashboard</a>
                    <a href="mis_ofertas.php" class="px-4 py-2 text-sm font-semibold rounded-lg <?php echo (isset($activePage) && $activePage == 'ofertas') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600'; ?> transition">Mis Ofertas</a>
                    <a href="postulantes.php" class="px-4 py-2 text-sm font-semibold rounded-lg <?php echo (isset($activePage) && $activePage == 'postulantes') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600'; ?> transition">Postulantes</a>
                </div>
            </div>

            <div class="flex items-center gap-4">
                
                <a href="crear_oferta.php" class="hidden sm:flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm hover:shadow-md hover:shadow-indigo-200">
                    <i class="fas fa-plus"></i> Publicar Oferta
                </a>

                <div class="relative ml-2">
                    <button id="notiBtn" class="relative p-2 text-slate-400 hover:text-indigo-600 transition-colors focus:outline-none">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>

                    <div id="notificationsMenu" class="hidden absolute right-0 mt-3 w-80 bg-white border border-slate-100 rounded-2xl shadow-2xl py-2 z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-50 bg-slate-50/50">
                            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Notificaciones</h3>
                        </div>
                        <div class="max-h-72 overflow-y-auto">
                            <a href="#" class="flex items-start gap-3 px-4 py-4 hover:bg-indigo-50 transition border-b border-slate-50 group">
                                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition">
                                    <i class="fas fa-user-check text-sm"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-bold text-slate-800 leading-tight">Nuevo Postulante</p>
                                    <p class="text-[10px] text-slate-500 line-clamp-1">Juan Pérez aplicó a Desarrollador Web.</p>
                                    <p class="text-[9px] text-indigo-500 font-bold uppercase">Hace 5 min</p>
                                </div>
                            </a>
                        </div>
                        <a href="notificaciones.php" class="block w-full py-3 text-center text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition bg-slate-50/50 mt-1">
                            Ver todas
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <button id="profileBtn" class="flex items-center gap-3 focus:outline-none group">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-700 group-hover:text-indigo-600 transition-colors"><?php echo $usuario; ?></p>
                            <p class="text-xs font-medium text-slate-400">Reclutador</p>
                        </div>
                        <img class="h-10 w-10 rounded-xl object-cover border-2 border-slate-100 group-hover:border-indigo-600 transition-all shadow-sm"
                             src="<?php echo $foto_header; ?>" alt="Empresa">
                    </button>

                    <div id="profileMenu" class="hidden absolute right-0 mt-3 w-56 bg-white border border-slate-100 rounded-2xl shadow-xl py-2 z-50">
                        <a href="perfil.php" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition">
                            <i class="fas fa-building w-4 text-center"></i> Mi Empresa
                        </a>
                        <a href="mis_ofertas.php" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition">
                            <i class="fas fa-briefcase w-4 text-center"></i> Mis Ofertas
                        </a>
                        <a href="opciones.php" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition">
                            <i class="fas fa-cog w-4 text-center"></i> Configuración
                        </a>
                        <hr class="my-2 border-slate-100">
                        <a href="../../src/Controllers/salir_conexion.php" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-red-500 hover:bg-red-50 transition">
                            <i class="fas fa-sign-out-alt w-4 text-center"></i> Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
