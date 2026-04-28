<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit();
    }

    $busqueda = $GET['buscar'] ?? '';
    $ubicacion = $_GET['ubicacion'] ?? '';

    $resultados = [
        ["id" => 1, "titulo" => "Desarrollador Web Senior", "empresa" => "Tech Chiclayo", "desc" => "Busca experto en PHP y Tailwind CSS...", "ubica" => "Chiclayo", "tipo" => "Presencial", "salario" => "S/ 3,500 - 5,000", "fecha" => "2h"],
        ["id" => 2, "titulo" => "Analista de Sistemas", "empresa" => "Banco Norte", "desc" => "Gestión de bases de datos PostgreSQL...", "ubica" => "Remoto", "tipo" => "Tiempo Completo", "salario" => "S/ 2,000 - 3,000", "fecha" => "5h"],
        ["id" => 3, "titulo" => "Especialista en Ciberseguridad", "empresa" => "SafeNet", "desc" => "Enfoque en vulnerabilidades...", "ubica" => "Lima", "tipo" => "Híbrido", "salario" => "S/ 4,000 - 6,500", "fecha" => "1d"],
        ["id" => 4, "titulo" => "Especialista QA", "empresa" => "Tech Chiclayo", "desc" => "Aseguramiento de calidad...", "ubica" => "Remoto", "tipo" => "Tiempo Completo", "salario" => "S/ 2,800 - 4,000", "fecha" => "4d"],
    ];

    $title = "Búsqueda de Empleo - Workly";
    require_once __DIR__ . '/../../includes/components/header.php';
?>

<script src="../../assets/js/department-autocomplete.js" defer></script>

<div class="max-w-7xl mx-auto py-8">
    <!-- Barra de Búsqueda Centrada en Página de Resultados -->
    <section class="mb-12">
        <div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2.5rem] shadow-xl shadow-gray-200/40">
             <form action="resultados_busqueda.php" method="get" class="flex flex-col lg:flex-row gap-4">
                 <div class="flex-[2] relative">
                     <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                     <input type="text" name="buscar" value="<?php echo htmlspecialchars($busqueda); ?>" placeholder="Cargo o tecnología..."
                            class="w-full pl-12 pr-4 py-5 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-blue-100 text-gray-700 font-bold transition">
                 </div>
                 <div class="flex-1 relative">
                     <i class="fas fa-map-marker-alt absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                     <input type="text" id="departamento_busqueda" name="ubicacion" value="<?php echo htmlspecialchars($ubicacion); ?>" autocomplete="off" placeholder="Ubicación..."
                            class="w-full pl-12 pr-4 py-5 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-blue-100 text-gray-700 font-bold transition">
                     <div id="autocomplete-results" class="absolute z-50 w-full mt-2 bg-white rounded-2xl shadow-2xl border border-gray-50 hidden max-h-60 overflow-y-auto"></div>
                 </div>
                 <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-5 rounded-2xl font-black text-sm uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-blue-200">
                     Buscar
                 </button>
             </form>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
        <!-- Sidebar de Filtros -->
        <aside class="lg:col-span-1 space-y-8">
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Filtros</h3>
                    <button class="text-[10px] font-bold text-blue-600 uppercase tracking-widest hover:underline">Limpiar</button>
                </div>

                <!-- Filtro: Tipo de Empleo -->
                <div class="space-y-4 mb-10">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Modalidad</p>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded-lg border-gray-100 text-blue-600 focus:ring-blue-100 transition-all">
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-600 transition">Tiempo Completo</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded-lg border-gray-100 text-blue-600 focus:ring-blue-100 transition-all" checked>
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-600 transition">Remoto</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded-lg border-gray-100 text-blue-600 focus:ring-blue-100 transition-all">
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-600 transition">Híbrido</span>
                        </label>
                    </div>
                </div>

                <!-- Filtro: Salario -->
                <div class="space-y-4 mb-10">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Rango Salarial</p>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="salario" class="w-5 h-5 border-gray-100 text-blue-600 focus:ring-blue-100 transition-all">
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-600 transition">Menos de S/ 1,500</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="salario" class="w-5 h-5 border-gray-100 text-blue-600 focus:ring-blue-100 transition-all">
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-600 transition">S/ 1,500 - S/ 3,000</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="salario" class="w-5 h-5 border-gray-100 text-blue-600 focus:ring-blue-100 transition-all">
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-600 transition">S/ 3,000 - S/ 5,000</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="salario" class="w-5 h-5 border-gray-100 text-blue-600 focus:ring-blue-100 transition-all">
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-600 transition">S/ 5,000 o más</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="bg-blue-600 rounded-[2rem] p-8 text-white relative overflow-hidden group">
                <i class="fas fa-envelope-open-text absolute -right-4 -bottom-4 text-7xl text-white/10 group-hover:scale-110 transition-transform duration-500"></i>
                <h4 class="text-lg font-black uppercase tracking-tight mb-3">Crea una alerta</h4>
                <p class="text-blue-100 text-xs font-medium mb-6">Te avisaremos cuando aparezcan nuevos resultados para tu búsqueda.</p>
                <button class="w-full py-4 bg-white text-blue-600 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-blue-900/20">Crear Alerta</button>
            </div>
        </aside>

        <!-- Resultados -->
        <main class="lg:col-span-3 space-y-6">
            <div class="flex items-center justify-between mb-2">
                <p class="text-gray-500 text-sm font-medium">Mostrando <span class="text-gray-800 font-bold"><?php echo count($resultados); ?></span> ofertas de trabajo encontradas</p>
                <div class="flex items-center gap-3">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Ordenar por:</span>
                    <select class="bg-transparent border-none text-sm font-bold text-blue-600 focus:ring-0 cursor-pointer">
                        <option>Más recientes</option>
                        <option>Mayor salario</option>
                        <option>Más relevantes</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <?php foreach($resultados as $trabajo): ?>
                    <article class="bg-white border border-gray-100 p-8 rounded-[2rem] hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-500/5 transition-all duration-500 group flex flex-col md:flex-row items-center justify-between gap-6">
                         <div class="flex items-center gap-6 w-full">
                            <div class="w-14 h-14 bg-slate-50 rounded-[1.2rem] flex items-center justify-center border border-gray-50 group-hover:bg-blue-50 group-hover:border-blue-100 transition shrink-0">
                                <i class="fas fa-building text-slate-300 group-hover:text-blue-500 text-xl"></i>
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-2">
                                    <h4 class="text-lg font-black text-gray-800 group-hover:text-blue-600 transition">
                                        <?php echo $trabajo['titulo']; ?>
                                    </h4>
                                    <span class="text-[10px] font-black text-gray-400 uppercase">Hace <?php echo $trabajo['fecha']; ?></span>
                                </div>
                                <p class="text-blue-600 text-xs font-bold mb-4 uppercase tracking-wider"><?php echo $trabajo['empresa']; ?></p>
                                <div class="flex flex-wrap gap-3">
                                    <span class="px-3 py-1 bg-gray-50 text-gray-500 rounded-lg text-[10px] font-bold border border-gray-50 uppercase tracking-widest">
                                        <i class="fas fa-map-marker-alt mr-1 text-blue-400"></i> <?php echo $trabajo['ubica']; ?>
                                    </span>
                                    <span class="px-3 py-1 bg-gray-50 text-gray-500 rounded-lg text-[10px] font-bold border border-gray-50 uppercase tracking-widest">
                                        <i class="fas fa-briefcase mr-1 text-blue-400"></i> <?php echo $trabajo['tipo']; ?>
                                    </span>
                                     <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black border border-blue-100 uppercase tracking-widest">
                                        <?php echo $trabajo['salario']; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0 w-full md:w-auto">
                            <a href="detalle_oferta.php?id=<?php echo $trabajo['id']; ?>" class="w-full inline-flex items-center justify-center py-4 px-8 bg-slate-900 text-white rounded-xl hover:bg-blue-600 transition-all font-black text-[10px] uppercase tracking-widest shadow-lg shadow-slate-200">
                                Ver Oferta
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Paginación -->
            <div class="flex justify-center gap-2 pt-8">
                <button class="w-12 h-12 flex items-center justify-center rounded-xl border border-gray-100 text-gray-400 hover:border-blue-600 hover:text-blue-600 transition"><i class="fas fa-chevron-left"></i></button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-600 text-white font-black">1</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl border border-gray-100 text-gray-600 font-bold hover:border-blue-600 hover:text-blue-600 transition">2</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl border border-gray-100 text-gray-600 font-bold hover:border-blue-600 hover:text-blue-600 transition">3</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl border border-gray-100 text-gray-400 hover:border-blue-600 hover:text-blue-600 transition"><i class="fas fa-chevron-right"></i></button>
            </div>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/components/footer.php'; ?>
