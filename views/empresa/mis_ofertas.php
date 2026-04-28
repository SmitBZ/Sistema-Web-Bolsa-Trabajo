<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}
$activePage = 'ofertas';
$title = "Workly - Mis Ofertas";

include '../../includes/components/header_empresa.php';
?>

<div class="space-y-8">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Mis Ofertas</h1>
            <p class="text-slate-500 font-medium mt-1">Gestiona las vacantes que has publicado.</p>
        </div>
        <a href="crear_oferta.php" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition transform active:scale-95 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Nueva Oferta
        </a>
    </header>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <div class="relative w-72">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" placeholder="Buscar oferta..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition text-sm">
            </div>
            <select class="bg-white border border-slate-200 rounded-lg px-4 py-2 text-sm font-medium text-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                <option>Todas las ofertas</option>
                <option>Activas</option>
                <option>Pausadas</option>
                <option>Cerradas</option>
            </select>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-xs uppercase tracking-widest font-bold text-slate-400">
                        <th class="px-6 py-4">Puesto</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-center">Postulantes</th>
                        <th class="px-6 py-4 text-center">Fecha Publicación</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium text-slate-600">
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800 text-base">Desarrollador Backend PHP</p>
                            <p class="text-xs text-slate-400 mt-0.5"><i class="fas fa-map-marker-alt mr-1"></i> Chiclayo, Perú</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-green-50 text-green-600 uppercase tracking-widest">Activa</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="postulantes.php?id=1" class="text-indigo-600 hover:text-indigo-800 font-bold hover:underline">12</a>
                        </td>
                        <td class="px-6 py-4 text-center text-slate-400">
                            24 Oct, 2023
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-indigo-50 hover:text-indigo-600 transition flex items-center justify-center" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 transition flex items-center justify-center" title="Pausar/Cerrar">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800 text-base">Diseñador UI/UX Senior</p>
                            <p class="text-xs text-slate-400 mt-0.5"><i class="fas fa-map-marker-alt mr-1"></i> Remoto</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-orange-50 text-orange-600 uppercase tracking-widest">Pausada</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="postulantes.php?id=2" class="text-indigo-600 hover:text-indigo-800 font-bold hover:underline">45</a>
                        </td>
                        <td class="px-6 py-4 text-center text-slate-400">
                            15 Sep, 2023
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-indigo-50 hover:text-indigo-600 transition flex items-center justify-center" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-green-50 hover:text-green-600 transition flex items-center justify-center" title="Activar">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../includes/components/footer_empresa.php'; ?>
