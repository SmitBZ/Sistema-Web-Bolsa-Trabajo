<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}
$activePage = 'home';
$title = "Workly";

$ofertas = [
    ["id" => 1, "titulo" => "Desarrollador Web Senior", "empresa" => "Tech Chiclayo", "desc" => "Busca experto en PHP y Tailwind CSS para proyectos de gran escala.", "ubica" => "Chiclayo, Perú", "tipo" => "Presencial", "salario" => "S/ 3,500 - 5,000", "fecha" => "Hace 2h"],
    ["id" => 2, "titulo" => "Analista de Sistemas", "empresa" => "Banco Norte", "desc" => "Gestión de bases de datos PostgreSQL y optimización de consultas SQL.", "ubica" => "Remoto", "tipo" => "Tiempo Completo", "salario" => "S/ 2,000 - 3,000", "fecha" => "Hace 5h"],
    ["id" => 3, "titulo" => "Especialista en Ciberseguridad", "empresa" => "SafeNet", "desc" => "Enfoque en vulnerabilidades de micro-transacciones financieras.", "ubica" => "Lima, Perú", "tipo" => "Híbrido", "salario" => "S/ 4,000 - 6,500", "fecha" => "Ayer"],
];

include '../../includes/components/header.php';
?>
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">¡Hola de nuevo! 👋</h1>
            <p class="text-slate-500 font-medium">Esto es lo que está pasando con tu búsqueda hoy.</p>
        </div>
        <div class="text-sm text-slate-400 font-bold uppercase tracking-widest bg-slate-100 px-4 py-2 rounded-full">
            <?php echo date('d M, Y'); ?>
        </div>
    </header>

    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs font-bold text-blue-600 uppercase mb-2">Postulaciones</p>
            <p class="text-3xl font-black text-slate-800">12</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs font-bold text-orange-500 uppercase mb-2">Vistas</p>
            <p class="text-3xl font-black text-slate-800">45</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs font-bold text-green-600 uppercase mb-2">Entrevistas</p>
            <p class="text-3xl font-black text-slate-800">02</p>
        </div>
        <div class="bg-indigo-600 p-6 rounded-3xl shadow-lg shadow-indigo-100 text-white">
            <p class="text-xs font-bold text-indigo-200 uppercase mb-2">Puntaje Perfil</p>
            <p class="text-3xl font-black italic">85%</p>
        </div>
    </section>

    <section class="relative">
        <div class="absolute inset-0 bg-slate-900 rounded-[2.5rem] -rotate-1 scale-[1.01] opacity-5"></div>
        <div class="relative bg-white border border-slate-100 p-8 md:p-12 rounded-[2.5rem] shadow-xl shadow-slate-200/50">
            <h2 class="text-2xl md:text-3xl font-black text-slate-800 mb-8 text-center md:text-left">¿Cuál será tu siguiente paso?</h2>
             <form action="../controller/controllerBuscar.php" method="get" class="flex flex-col lg:flex-row gap-3">
                 <div class="flex-[2] relative">
                     <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                     <input type="text" name="buscar" placeholder="Cargo o tecnología (ej. React, PHP)"
                            class="w-full pl-12 pr-4 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500/20 text-slate-700 font-medium transition">
                 </div>
                 <div class="flex-1 relative">
                     <i class="fas fa-location-arrow absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                     <input type="text" name="ubicacion" placeholder="Departamento"
                            class="w-full pl-12 pr-4 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500/20 text-slate-700 font-medium transition">
                 </div>
                 <button type="submit" class="bg-slate-900 hover:bg-blue-600 text-white px-8 py-5 rounded-2xl font-bold transition-all active:scale-95 shadow-lg shadow-slate-200">
                     Buscar Empleo
                 </button>
             </form>
        </div>
    </section>
    <section>
        <div class="flex justify-between items-center mb-8 px-2">
            <h3 class="text-xl font-black text-slate-800 tracking-tight">Recomendados para ti</h3>
            <a href="#" class="group text-sm font-bold text-slate-400 hover:text-blue-600 transition flex items-center gap-2">
                Explorar todo <i class="fas fa-chevron-right text-xs group-hover:translate-x-1 transition"></i>
            </a>
        </div>
         <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
             <?php if (!empty($ofertas)): ?>
                 <?php foreach ($ofertas as $trabajo): ?>
                     <article class="bg-white border border-slate-100 p-6 rounded-[2rem] hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-500/5 transition-all duration-500 group flex flex-col h-full">
                         <div class="flex justify-between items-start mb-6">
                             <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100 group-hover:bg-blue-50 group-hover:border-blue-100 transition">
                                 <i class="fas fa-building text-slate-300 group-hover:text-blue-500 text-xl"></i>
                             </div>
                             <span class="text-[10px] font-black bg-slate-100 text-slate-500 px-3 py-1 rounded-full uppercase tracking-widest"><?php echo $trabajo['fecha']; ?>
                            </span>
                         </div>
                         <div class="flex-grow">
                             <h4 class="text-lg font-black text-slate-800 mb-1 group-hover:text-blue-600 transition">
                                 <?php echo $trabajo['titulo']; ?>
                             </h4>
                             <p class="text-blue-600 text-sm font-bold mb-4"><?php echo $trabajo['empresa']; ?></p>
                             <div class="flex flex-wrap gap-2 mb-6">
                                 <span class="px-3 py-1 bg-slate-50 text-slate-500 rounded-lg text-[11px] font-bold border border-slate-100">
                                    <i class="fas fa-map-marker-alt mr-1 text-blue-400"></i> <?php echo $trabajo['ubica']; ?>
                                 </span>
                                 <span class="px-3 py-1 bg-slate-50 text-slate-500 rounded-lg text-[11px] font-bold border border-slate-100">
                                    <i class="fas fa-briefcase mr-1 text-blue-400"></i> <?php echo $trabajo['tipo']; ?>
                                 </span>
                             </div>
                         </div>

                         <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                             <span class="text-slate-800 font-black text-sm"><?php echo $trabajo['salario']; ?></span>
                                <a href="detalle_oferta.php?id=<?php echo $trabajo['id']; ?>"
                                   class="inline-flex items-center justify-center w-10 h-10 bg-slate-900 text-white rounded-xl hover:bg-blue-600 transition-all shadow-md active:scale-90">
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                         </div>
                     </article>
                 <?php endforeach; ?>
             <?php else: ?>
                 <div class="col-span-full py-20 text-center">
                     <p class="text-slate-400 font-medium">No hay vacantes nuevas por ahora.</p>
                 </div>
             <?php endif; ?>
         </div>
    </section>
</main>

<?php include '../../includes/components/footer.php' ?>