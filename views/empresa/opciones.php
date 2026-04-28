<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}
$activePage = 'opciones';
$title = "Workly - Configuración Empresa";

include '../../includes/components/header_empresa.php';
?>

<div class="space-y-8 max-w-4xl mx-auto">
    <header>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Opciones de Cuenta</h1>
        <p class="text-slate-500 font-medium mt-1">Configura la seguridad y preferencias de tu cuenta corporativa.</p>
    </header>

    <div class="space-y-6">
        <!-- Cambio de Contraseña -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fas fa-lock text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-black text-slate-800">Cambiar Contraseña</h2>
                    <p class="text-sm font-medium text-slate-500">Asegúrate de usar una contraseña larga y segura.</p>
                </div>
            </div>
            
            <form class="space-y-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Contraseña Actual</label>
                    <input type="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Nueva Contraseña</label>
                        <input type="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Confirmar Nueva Contraseña</label>
                        <input type="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm">
                    </div>
                </div>
                <div class="flex justify-end pt-2">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition transform active:scale-95 text-sm">
                        Actualizar Contraseña
                    </button>
                </div>
            </form>
        </div>

        <!-- Notificaciones -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fas fa-bell text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-black text-slate-800">Preferencias de Notificación</h2>
                    <p class="text-sm font-medium text-slate-500">Controla qué correos te enviamos.</p>
                </div>
            </div>

            <div class="space-y-4">
                <label class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:bg-slate-50 cursor-pointer transition">
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Nuevos postulantes</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Te avisamos cuando alguien aplique a tus ofertas.</p>
                    </div>
                    <div class="relative">
                        <input type="checkbox" class="peer sr-only" checked>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </div>
                </label>
                
                <label class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:bg-slate-50 cursor-pointer transition">
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Resumen semanal</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Estadísticas de tus ofertas publicadas.</p>
                    </div>
                    <div class="relative">
                        <input type="checkbox" class="peer sr-only">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Zona de Peligro -->
        <div class="bg-red-50 rounded-[2rem] border border-red-100 p-8">
            <h2 class="text-lg font-black text-red-800 mb-2">Eliminar Cuenta</h2>
            <p class="text-sm font-medium text-red-600 mb-4">Una vez que elimines tu cuenta, no hay vuelta atrás. Todas tus ofertas y postulantes serán eliminados.</p>
            <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition transform active:scale-95 text-sm">
                Eliminar cuenta de Empresa
            </button>
        </div>
    </div>
</div>

<?php include '../../includes/components/footer_empresa.php'; ?>
