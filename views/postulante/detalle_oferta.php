<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit();
    }
    
    // Simulación de datos (En un sistema real vendrían de la DB usando $_GET['id'])
    $id_oferta = $_GET['id'] ?? 1;
    $oferta = [
        "id" => $id_oferta,
        "titulo" => "Desarrollador Web Senior (PHP & JavaScript)",
        "empresa" => "Tech Chiclayo Solutions",
        "id_empresa" => 101, // Para el enlace al perfil de la empresa
        "ubica" => "Chiclayo, Lambayeque",
        "tipo" => "Tiempo Completo",
        "modalidad" => "Híbrido",
        "fecha" => "Publicado hace 2 días",
        "salario" => "S/ 3,500 - 5,000",
        "desc" => "Buscamos un Desarrollador Web Senior apasionado por la tecnología para unirse a nuestro equipo en constante crecimiento. Serás responsable del desarrollo y mantenimiento de aplicaciones web escalables, colaborando estrechamente con diseñadores y otros desarrolladores para ofrecer la mejor experiencia de usuario.",
        "requisitos" => [
            "Mínimo 4 años de experiencia en desarrollo PHP (Laravel o similar).",
            "Experiencia sólida con frameworks front-end (React, Vue o Vanilla JS moderno).",
            "Dominio de bases de datos relacionales (MySQL/PostgreSQL).",
            "Conocimiento profundo de arquitectura de software y patrones de diseño.",
            "Excelentes habilidades de comunicación y trabajo en equipo."
        ],
        "beneficios" => [
            "Salario competitivo acorde al mercado.",
            "Seguro de salud privado (EPS).",
            "Ambiente de trabajo dinámico y joven.",
            "Oportunidades de capacitación constante.",
            "Horario flexible y días de home office."
        ]
    ];

    $title = $oferta['titulo'] . " - Workly";
    require_once __DIR__ . '/../../includes/components/header.php';
?>

<div class="max-w-6xl mx-auto py-8 lg:py-12">
    <!-- Breadcrumb -->
    <nav class="flex gap-2 text-[10px] font-black uppercase tracking-widest text-gray-400 mb-8 px-2">
        <a href="home.php" class="hover:text-blue-600 transition">Inicio</a>
        <span>/</span>
        <a href="resultados_busqueda.php" class="hover:text-blue-600 transition">Empleos</a>
        <span>/</span>
        <span class="text-gray-800">Detalles de la oferta</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Izquierda: Información de la Oferta -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 p-8 md:p-12 relative overflow-hidden">
                <!-- Efecto de fondo sutil -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -mr-32 -mt-32 opacity-50"></div>
                
                <div class="relative">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-10">
                        <div class="flex items-start gap-6">
                            <div class="w-20 h-20 bg-slate-50 border border-gray-100 rounded-3xl flex items-center justify-center shrink-0 shadow-sm">
                                <i class="fas fa-building text-slate-300 text-3xl"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl md:text-4xl font-black text-gray-900 leading-tight mb-2"><?php echo $oferta['titulo']; ?></h1>
                                <a href="perfil_empresa.php?id=<?php echo $oferta['id_empresa']; ?>" class="text-blue-600 font-bold hover:underline flex items-center gap-2">
                                    <?php echo $oferta['empresa']; ?>
                                    <i class="fas fa-external-link-alt text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-2 shrink-0">
                            <span class="px-4 py-2 bg-green-50 text-green-600 rounded-xl text-xs font-black uppercase tracking-widest border border-green-100">
                                Abierta
                            </span>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest"><?php echo $oferta['fecha']; ?></p>
                        </div>
                    </div>

                    <!-- Tags de información rápida -->
                    <div class="flex flex-wrap gap-3 mb-12">
                        <div class="flex items-center gap-3 px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <i class="fas fa-map-marker-alt text-blue-500"></i>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Ubicación</p>
                                <p class="text-sm font-bold text-gray-700"><?php echo $oferta['ubica']; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <i class="fas fa-briefcase text-blue-500"></i>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Tipo</p>
                                <p class="text-sm font-bold text-gray-700"><?php echo $oferta['tipo']; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <i class="fas fa-laptop-house text-blue-500"></i>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Modalidad</p>
                                <p class="text-sm font-bold text-gray-700"><?php echo $oferta['modalidad']; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <i class="fas fa-coins text-blue-500"></i>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Salario</p>
                                <p class="text-sm font-bold text-gray-700"><?php echo $oferta['salario']; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-10">
                        <!-- Descripción -->
                        <section>
                            <h3 class="text-lg font-black text-gray-800 uppercase tracking-tighter mb-4 flex items-center gap-3">
                                <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                                Descripción del Puesto
                            </h3>
                            <p class="text-gray-600 leading-relaxed font-medium">
                                <?php echo $oferta['desc']; ?>
                            </p>
                        </section>

                        <!-- Requisitos -->
                        <section>
                            <h3 class="text-lg font-black text-gray-800 uppercase tracking-tighter mb-4 flex items-center gap-3">
                                <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                                Lo que buscamos en ti
                            </h3>
                            <ul class="space-y-4">
                                <?php foreach($oferta['requisitos'] as $req): ?>
                                    <li class="flex items-start gap-4">
                                        <div class="w-6 h-6 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                                            <i class="fas fa-check text-[10px]"></i>
                                        </div>
                                        <span class="text-gray-600 font-medium"><?php echo $req; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </section>

                        <!-- Beneficios -->
                        <section>
                            <h3 class="text-lg font-black text-gray-800 uppercase tracking-tighter mb-4 flex items-center gap-3">
                                <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                                Beneficios y más
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php foreach($oferta['beneficios'] as $ben): ?>
                                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-gray-100">
                                        <i class="fas fa-gift text-blue-400"></i>
                                        <span class="text-sm font-bold text-gray-700"><?php echo $ben; ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Sidebar con Acción y Empresa -->
        <div class="space-y-8">
            <!-- Card de Acción -->
            <div class="bg-slate-900 rounded-[2.5rem] p-8 md:p-10 shadow-2xl shadow-blue-900/20 sticky top-24">
                <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-6">¿Interesado?</h3>
                <p class="text-slate-400 text-sm font-medium mb-8">No pierdas esta oportunidad, miles de postulantes también están viendo esta oferta.</p>
                <div class="space-y-4">
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-5 px-8 rounded-2xl shadow-lg shadow-blue-500/20 transition-all active:scale-95 text-sm uppercase tracking-widest">
                        Enviar mi postulación
                    </button>
                    <button class="w-full bg-slate-800 hover:bg-slate-700 text-white font-bold py-5 px-8 rounded-2xl transition-all text-sm uppercase tracking-widest flex items-center justify-center gap-3">
                        <i class="far fa-bookmark"></i>
                        Guardar Oferta
                    </button>
                </div>
                <div class="mt-8 pt-8 border-t border-slate-800">
                    <div class="flex items-center justify-between">
                        <div class="text-center">
                            <p class="text-white font-black text-xl">15</p>
                            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest">Postulantes</p>
                        </div>
                        <div class="text-center border-x border-slate-800 px-6">
                            <p class="text-white font-black text-xl">450</p>
                            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest">Vistas</p>
                        </div>
                        <div class="text-center">
                            <p class="text-green-400 font-black text-xl">Alta</p>
                            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest">Afinidad</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Empresa -->
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-8 flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mb-6 border border-gray-50">
                    <i class="fas fa-building text-gray-200 text-3xl"></i>
                </div>
                <h4 class="text-lg font-black text-gray-800 mb-1"><?php echo $oferta['empresa']; ?></h4>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-6">Tecnología & Software</p>
                <p class="text-sm font-medium text-gray-500 mb-8">Empresa líder en soluciones digitales con más de 10 años en el mercado peruano.</p>
                <a href="perfil_empresa.php?id=<?php echo $oferta['id_empresa']; ?>" class="text-xs font-black text-blue-600 uppercase tracking-widest hover:text-blue-800 transition">
                    Ver más ofertas de esta empresa <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/components/footer.php'; ?>
