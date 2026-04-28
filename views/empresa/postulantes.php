<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}
$activePage = 'postulantes';
$title = "Workly - Gestión de Postulantes";

include '../../includes/components/header_empresa.php';
?>

<div class="space-y-8">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Postulantes</h1>
            <p class="text-slate-500 font-medium mt-1">Revisa y gestiona los candidatos de tus ofertas activas.</p>
        </div>
        <div class="relative w-full md:w-72">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" placeholder="Buscar por nombre o habilidad..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition shadow-sm text-sm">
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Sidebar Filtros -->
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-4">Filtrar por Oferta</h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="radio" name="oferta" class="peer appearance-none w-5 h-5 border-2 border-slate-200 rounded-full checked:border-indigo-600 checked:bg-indigo-600 transition" checked>
                            <i class="fas fa-circle text-[8px] text-white absolute opacity-0 peer-checked:opacity-100"></i>
                        </div>
                        <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-600 transition">Todas</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="radio" name="oferta" class="peer appearance-none w-5 h-5 border-2 border-slate-200 rounded-full checked:border-indigo-600 checked:bg-indigo-600 transition">
                            <i class="fas fa-circle text-[8px] text-white absolute opacity-0 peer-checked:opacity-100"></i>
                        </div>
                        <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-600 transition">Desarrollador Backend PHP</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="radio" name="oferta" class="peer appearance-none w-5 h-5 border-2 border-slate-200 rounded-full checked:border-indigo-600 checked:bg-indigo-600 transition">
                            <i class="fas fa-circle text-[8px] text-white absolute opacity-0 peer-checked:opacity-100"></i>
                        </div>
                        <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-600 transition">Diseñador UI/UX Senior</span>
                    </label>
                </div>
            </div>

            <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-4">Estado</h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" class="w-5 h-5 rounded-md border-2 border-slate-200 text-indigo-600 focus:ring-indigo-500 transition">
                        <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-600">Nuevos</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" class="w-5 h-5 rounded-md border-2 border-slate-200 text-indigo-600 focus:ring-indigo-500 transition">
                        <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-600">En Revisión</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" class="w-5 h-5 rounded-md border-2 border-slate-200 text-indigo-600 focus:ring-indigo-500 transition">
                        <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-600">Entrevistados</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Lista de Postulantes -->
        <div class="md:col-span-3 space-y-4">
            
            <!-- Tarjeta Postulante -->
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row sm:items-center gap-6 relative overflow-hidden group">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-green-500 opacity-0 group-hover:opacity-100 transition"></div>
                
                <img src="https://i.pravatar.cc/150?img=11" alt="Perfil" class="w-16 h-16 rounded-2xl object-cover shadow-sm">
                
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2">
                        <h3 class="text-lg font-black text-slate-800">Carlos Mendoza</h3>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-green-50 text-green-600 uppercase tracking-widest mt-2 sm:mt-0 w-max">
                            Nuevo
                        </span>
                    </div>
                    <p class="text-sm text-indigo-600 font-bold mb-1">Postuló a: Desarrollador Backend PHP</p>
                    <p class="text-xs font-medium text-slate-500 mb-3"><i class="fas fa-map-marker-alt mr-1"></i> Lima, Perú • <i class="fas fa-clock mr-1 ml-2"></i> Hace 2 horas</p>
                    <div class="flex gap-2">
                        <span class="px-2 py-1 bg-slate-50 border border-slate-100 text-slate-500 rounded-md text-[10px] font-bold">PHP</span>
                        <span class="px-2 py-1 bg-slate-50 border border-slate-100 text-slate-500 rounded-md text-[10px] font-bold">Laravel</span>
                        <span class="px-2 py-1 bg-slate-50 border border-slate-100 text-slate-500 rounded-md text-[10px] font-bold">MySQL</span>
                    </div>
                </div>

                <div class="flex sm:flex-col gap-2">
                    <button class="flex-1 sm:flex-none px-4 py-2 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-xl text-xs font-bold transition">
                        Ver CV
                    </button>
                    <button class="flex-1 sm:flex-none px-4 py-2 bg-slate-50 text-slate-600 hover:bg-slate-200 rounded-xl text-xs font-bold transition">
                        Mensaje
                    </button>
                </div>
            </div>

            <!-- Tarjeta Postulante -->
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row sm:items-center gap-6 relative overflow-hidden group">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-blue-500 opacity-0 group-hover:opacity-100 transition"></div>
                
                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 text-2xl font-bold shadow-sm">
                    AL
                </div>
                
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2">
                        <h3 class="text-lg font-black text-slate-800">Ana Lopez</h3>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-blue-50 text-blue-600 uppercase tracking-widest mt-2 sm:mt-0 w-max">
                            En Revisión
                        </span>
                    </div>
                    <p class="text-sm text-indigo-600 font-bold mb-1">Postuló a: Diseñador UI/UX Senior</p>
                    <p class="text-xs font-medium text-slate-500 mb-3"><i class="fas fa-map-marker-alt mr-1"></i> Arequipa, Perú • <i class="fas fa-clock mr-1 ml-2"></i> Ayer</p>
                    <div class="flex gap-2">
                        <span class="px-2 py-1 bg-slate-50 border border-slate-100 text-slate-500 rounded-md text-[10px] font-bold">Figma</span>
                        <span class="px-2 py-1 bg-slate-50 border border-slate-100 text-slate-500 rounded-md text-[10px] font-bold">UI/UX</span>
                    </div>
                </div>

                <div class="flex sm:flex-col gap-2">
                    <button class="flex-1 sm:flex-none px-4 py-2 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-xl text-xs font-bold transition">
                        Ver CV
                    </button>
                    <button class="flex-1 sm:flex-none px-4 py-2 bg-slate-50 text-slate-600 hover:bg-slate-200 rounded-xl text-xs font-bold transition">
                        Mensaje
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include '../../includes/components/footer_empresa.php'; ?>
