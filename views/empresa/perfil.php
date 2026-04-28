<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}
$activePage = 'perfil';
$title = "Workly - Perfil de Empresa";

include '../../includes/components/header_empresa.php';
?>

<div class="space-y-8 max-w-5xl mx-auto">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Perfil de Empresa</h1>
            <p class="text-slate-500 font-medium mt-1">Gestiona la información pública de tu organización.</p>
        </div>
        <button type="submit" form="perfilForm" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition transform active:scale-95 text-sm flex items-center gap-2">
            <i class="fas fa-save"></i> Guardar Cambios
        </button>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 text-center">
                <div class="relative w-32 h-32 mx-auto mb-4 group cursor-pointer">
                    <img src="../../assets/img/empresa_default.png" alt="Logo Empresa" class="w-full h-full object-cover rounded-3xl border-4 border-slate-50 shadow-sm group-hover:opacity-50 transition">
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-camera text-3xl text-indigo-600"></i>
                    </div>
                </div>
                <h2 class="text-xl font-black text-slate-800">Tech Chiclayo SAC</h2>
                <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">RUC: 20123456789</p>
                <hr class="my-4 border-slate-100">
                <div class="flex justify-center gap-2">
                    <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold uppercase tracking-widest rounded-md">Perfil Verificado</span>
                </div>
            </div>

            <div class="bg-indigo-600 rounded-[2rem] shadow-lg shadow-indigo-200 p-6 text-white text-center">
                <i class="fas fa-star text-3xl mb-3 text-indigo-200"></i>
                <h3 class="font-black mb-1">Mejora tu alcance</h3>
                <p class="text-sm text-indigo-100 mb-4">Completar tu perfil al 100% aumenta la confianza de los postulantes.</p>
                <div class="w-full bg-indigo-800/50 rounded-full h-2 mb-2">
                    <div class="bg-white h-2 rounded-full" style="width: 75%"></div>
                </div>
                <p class="text-xs font-bold uppercase tracking-widest">75% Completado</p>
            </div>
        </div>

        <div class="lg:col-span-2">
            <form id="perfilForm" class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 space-y-8">
                <section>
                    <h3 class="text-lg font-black text-slate-800 mb-4 border-b border-slate-100 pb-2">Información General</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5 md:col-span-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Razón Social</label>
                            <input type="text" value="Tech Chiclayo SAC" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Sector / Industria</label>
                            <select class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                                <option>Tecnología</option>
                                <option>Finanzas</option>
                                <option>Salud</option>
                                <option>Educación</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Tamaño de Empresa</label>
                            <select class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                                <option>1-10 empleados</option>
                                <option selected>11-50 empleados</option>
                                <option>51-200 empleados</option>
                                <option>+200 empleados</option>
                            </select>
                        </div>
                        <div class="space-y-1.5 md:col-span-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Descripción de la Empresa</label>
                            <textarea rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 resize-none">Somos una empresa dedicada al desarrollo de software y soluciones tecnológicas...</textarea>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-black text-slate-800 mb-4 border-b border-slate-100 pb-2">Contacto y Ubicación</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Sitio Web</label>
                            <input type="url" placeholder="https://" value="https://techchiclayo.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Teléfono</label>
                            <input type="tel" value="074-123456" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                        <div class="space-y-1.5 md:col-span-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Dirección Principal</label>
                            <input type="text" value="Av. Balta 123, Of 402, Chiclayo" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

<?php include '../../includes/components/footer_empresa.php'; ?>
