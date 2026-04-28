<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit();
    }

    // Datos simulados de la empresa
    $empresa = [
        "id" => $_GET['id'] ?? 101,
        "nombre" => "Tech Chiclayo Solutions",
        "logo" => null, // Placeholder icon will be used
        "industria" => "Tecnología & Software",
        "ubicacion" => "Chiclayo, Lambayeque",
        "tamano" => "51-200 empleados",
        "web" => "www.techchiclayo.com",
        "fundacion" => "2014",
        "desc" => "Tech Chiclayo Solutions es una empresa peruana dedicada a brindar servicios integrales de tecnología de la información. Nuestra misión es impulsar el crecimiento de las empresas a través de la digitalización y el desarrollo de software a medida de alta calidad.",
        "portada" => "https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1200"
    ];

    $ofertas_empresa = [
        ["id" => 1, "titulo" => "Desarrollador Web Senior", "desc" => "Busca experto en PHP y Tailwind CSS...", "ubica" => "Chiclayo", "tipo" => "Presencial", "salario" => "S/ 3,500 - 5,000", "fecha" => "Hace 2 días"],
        ["id" => 4, "titulo" => "Especialista QA", "desc" => "Aseguramiento de calidad en procesos ágiles...", "ubica" => "Remoto", "tipo" => "Tiempo Completo", "salario" => "S/ 2,800 - 4,000", "fecha" => "Hace 4 días"],
        ["id" => 5, "titulo" => "UI/UX Designer", "desc" => "Diseño de interfaces modernas para apps móviles...", "ubica" => "Híbrido", "tipo" => "Tiempo Completo", "salario" => "S/ 3,000 - 4,500", "fecha" => "Hace 1 semana"],
    ];

    $title = "Perfil de " . $empresa['nombre'] . " - Workly";
    require_once __DIR__ . '/../../includes/components/header.php';
?>

<div class="max-w-7xl mx-auto py-8">
    <!-- Header de Empresa con Portada -->
    <div class="relative mb-32">
        <div class="h-64 md:h-80 w-full rounded-[2.5rem] overflow-hidden relative">
            <img src="<?php echo $empresa['portada']; ?>" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
        </div>
        
        <!-- Info Principal Flotante -->
        <div class="absolute -bottom-20 left-8 md:left-12 flex flex-col md:flex-row items-end gap-6 w-[calc(100%-4rem)]">
            <div class="w-40 h-40 bg-white p-4 rounded-[2.5rem] shadow-2xl border border-gray-100 shrink-0">
                <div class="w-full h-full bg-slate-50 rounded-[1.8rem] flex items-center justify-center border border-gray-50">
                    <i class="fas fa-building text-slate-300 text-5xl"></i>
                </div>
            </div>
            <div class="flex-grow pb-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-4xl font-black text-white drop-shadow-md"><?php echo $empresa['nombre']; ?></h1>
                        <div class="flex flex-wrap gap-4 mt-2">
                            <span class="text-white/80 font-bold text-sm flex items-center gap-2">
                                <i class="fas fa-tag"></i> <?php echo $empresa['industria']; ?>
                            </span>
                            <span class="text-white/80 font-bold text-sm flex items-center gap-2">
                                <i class="fas fa-map-marker-alt"></i> <?php echo $empresa['ubicacion']; ?>
                            </span>
                        </div>
                    </div>
                    <div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-8 rounded-2xl shadow-xl shadow-blue-500/20 transition-all active:scale-95 text-sm uppercase tracking-widest">
                            Seguir Empresa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 px-4 md:px-0">
        <!-- Columna Izquierda: Información Detallada -->
        <div class="lg:col-span-1 space-y-8">
            <section class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-8 md:p-10">
                <h3 class="text-xl font-black text-gray-800 uppercase tracking-tighter mb-6 flex items-center gap-3">
                    <i class="fas fa-info-circle text-blue-500"></i> Sobre nosotros
                </h3>
                <p class="text-gray-500 font-medium leading-relaxed mb-8">
                    <?php echo $empresa['desc']; ?>
                </p>
                
                <div class="space-y-4 border-t border-gray-50 pt-8">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">Sitio Web</span>
                        <a href="#" class="text-blue-600 font-black"><?php echo $empresa['web']; ?></a>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">Fundación</span>
                        <span class="text-gray-700 font-black"><?php echo $empresa['fundacion']; ?></span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">Tamaño</span>
                        <span class="text-gray-700 font-black"><?php echo $empresa['tamano']; ?></span>
                    </div>
                </div>
            </section>

            <section class="bg-slate-900 rounded-[2.5rem] p-8 md:p-10 text-white overflow-hidden relative">
                 <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-600/20 rounded-full blur-3xl"></div>
                 <h3 class="text-lg font-black uppercase tracking-widest mb-4">¿Buscas trabajar aquí?</h3>
                 <p class="text-slate-400 text-sm font-medium mb-6">Mantente al tanto de sus nuevas publicaciones para ser el primero en postular.</p>
                 <button class="w-full py-4 bg-slate-800 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-700 transition">Activar Alertas</button>
            </section>
        </div>

        <!-- Columna Derecha: Ofertas de la Empresa -->
        <div class="lg:col-span-2 space-y-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-black text-gray-800 tracking-tighter">Ofertas de trabajo activas</h3>
                <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-xs font-black uppercase tracking-widest border border-blue-100">
                    <?php echo count($ofertas_empresa); ?> vacantes
                </span>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <?php foreach($ofertas_empresa as $trabajo): ?>
                    <article class="bg-white border border-gray-100 p-8 rounded-[2.5rem] hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-500/5 transition-all duration-500 group flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex items-center gap-6 text-center md:text-left">
                            <div class="w-16 h-16 bg-slate-50 rounded-[1.5rem] flex items-center justify-center border border-gray-50 group-hover:bg-blue-50 group-hover:border-blue-100 transition shrink-0">
                                <i class="fas fa-briefcase text-slate-300 group-hover:text-blue-500 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-black text-gray-800 mb-2 group-hover:text-blue-600 transition">
                                    <?php echo $trabajo['titulo']; ?>
                                </h4>
                                <div class="flex flex-wrap gap-4">
                                    <span class="text-gray-400 text-[11px] font-bold uppercase tracking-widest flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt text-blue-400"></i> <?php echo $trabajo['ubica']; ?>
                                    </span>
                                    <span class="text-gray-400 text-[11px] font-bold uppercase tracking-widest flex items-center gap-2">
                                        <i class="fas fa-clock text-blue-400"></i> <?php echo $trabajo['fecha']; ?>
                                    </span>
                                    <span class="text-blue-600 text-[11px] font-black uppercase tracking-widest">
                                        <?php echo $trabajo['salario']; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <a href="detalle_oferta.php?id=<?php echo $trabajo['id']; ?>" class="inline-flex items-center justify-center py-4 px-8 bg-slate-900 text-white rounded-2xl hover:bg-blue-600 transition-all font-black text-[10px] uppercase tracking-widest shadow-lg shadow-slate-200">
                                Ver Detalles
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Botón de Cargar Más -->
            <button class="w-full py-6 border-2 border-dashed border-gray-100 rounded-[2rem] text-xs font-black text-gray-400 uppercase tracking-widest hover:border-blue-200 hover:text-blue-500 hover:bg-blue-50/10 transition-all duration-300">
                <i class="fas fa-plus mr-2"></i> Ver publicaciones anteriores
            </button>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/components/footer.php'; ?>
