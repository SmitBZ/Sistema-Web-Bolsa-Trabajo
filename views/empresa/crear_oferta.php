<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}
$activePage = 'ofertas';
$title = "Workly - Publicar Oferta";

include '../../includes/components/header_empresa.php';
?>

<div class="space-y-8 max-w-4xl mx-auto">
    <header>
        <a href="mis_ofertas.php" class="text-xs font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition flex items-center gap-2 mb-4">
            <i class="fas fa-arrow-left"></i> Volver a Mis Ofertas
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Publicar Oferta</h1>
        <p class="text-slate-500 font-medium mt-1">Completa los detalles para encontrar al candidato ideal.</p>
    </header>

    <form class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 space-y-6">
            <div class="space-y-1.5">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Título del Puesto</label>
                <input type="text" placeholder="Ej. Desarrollador Fullstack" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Modalidad</label>
                    <select class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        <option>Presencial</option>
                        <option>Remoto</option>
                        <option>Híbrido</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Tipo de Contrato</label>
                    <select class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        <option>Tiempo Completo</option>
                        <option>Medio Tiempo</option>
                        <option>Prácticas</option>
                        <option>Freelance</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Ubicación</label>
                    <input type="text" placeholder="Ej. Lima, Perú" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Salario (Opcional)</label>
                    <input type="text" placeholder="Ej. S/ 3,000 - 4,000" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Descripción del Puesto</label>
                <textarea rows="6" placeholder="Describe las responsabilidades, requisitos y beneficios..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 resize-none"></textarea>
            </div>
            
            <div class="space-y-1.5">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Requisitos (Habilidades clave separadas por coma)</label>
                <input type="text" placeholder="Ej. PHP, MySQL, Trabajo en equipo" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
            </div>
        </div>

        <div class="p-6 border-t border-slate-100 bg-slate-50 flex justify-end gap-4">
            <button type="button" class="px-6 py-2.5 rounded-xl font-bold text-slate-500 hover:bg-slate-200 hover:text-slate-700 transition text-sm">
                Cancelar
            </button>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-lg shadow-indigo-200 transition transform active:scale-95 text-sm uppercase tracking-widest flex items-center gap-2">
                <i class="fas fa-paper-plane"></i> Publicar
            </button>
        </div>
    </form>
</div>

<?php include '../../includes/components/footer_empresa.php'; ?>
