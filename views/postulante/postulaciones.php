<?php
    session_status() === PHP_SESSION_NONE ? session_start() : null;
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit();
    }

    $postulaciones = [
        [
            "id" => 1,
            "empresa" => "Tech Chiclayo Solutions",
            "puesto" => "Desarrollador Backend Senior",
            "fch_postulacion" => "20 Oct, 2024",
            "estado" => "En Revisión",
            "progreso" => 50,
            "pasos" => ["Enviada", "Visto", "En Revisión", "Entrevista", "Finalizada"],
            "paso_actual" => 2 // Índice de "En Revisión"
        ],
        [
            "id" => 2,
            "empresa" => "Banco del Norte",
            "puesto" => "Analista de Datos",
            "fch_postulacion" => "15 Oct, 2024",
            "estado" => "Entrevista",
            "progreso" => 75,
            "pasos" => ["Enviada", "Visto", "En Revisión", "Entrevista", "Finalizada"],
            "paso_actual" => 3
        ],
        [
            "id" => 3,
            "empresa" => "SafeNet Ciberseguridad",
            "puesto" => "Especialista en Redes",
            "fch_postulacion" => "10 Oct, 2024",
            "estado" => "Enviada",
            "progreso" => 25,
            "pasos" => ["Enviada", "Visto", "En Revisión", "Entrevista", "Finalizada"],
            "paso_actual" => 0
        ]
    ];

    $title = "Mis Postulaciones - Workly";
    require_once __DIR__ . '/../../includes/components/header.php';
?>

<div class="max-w-6xl mx-auto py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-gray-800 uppercase tracking-tighter flex items-center gap-4">
            <span class="w-2 h-12 bg-blue-600 rounded-full"></span>
            Seguimiento de Postulaciones
        </h1>
        <p class="text-gray-500 font-medium mt-2">Monitorea el progreso de tus aplicaciones en tiempo real.</p>
    </div>

    <div class="space-y-8">
        <?php if (!empty($postulaciones)): ?>
            <?php foreach ($postulaciones as $app): ?>
                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 overflow-hidden hover:border-blue-100 transition-all duration-300">
                    <div class="p-8 md:p-10">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 bg-slate-50 border border-gray-50 rounded-2xl flex items-center justify-center shrink-0">
                                    <i class="fas fa-briefcase text-slate-300 text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-black text-gray-800 group-hover:text-blue-600 transition"><?php echo $app['puesto']; ?></h3>
                                    <p class="text-blue-600 font-bold text-sm"><?php echo $app['empresa']; ?></p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Postulado el <?php echo $app['fch_postulacion']; ?></p>
                                </div>
                            </div>
                            <div class="shrink-0">
                                <span class="px-6 py-3 bg-blue-50 text-blue-600 rounded-2xl text-xs font-black uppercase tracking-widest border border-blue-100 shadow-sm shadow-blue-100/20">
                                    <?php echo $app['estado']; ?>
                                </span>
                            </div>
                        </div>

                        <!-- Línea de Progreso -->
                        <div class="relative pt-4">
                            <div class="flex mb-2 items-center justify-between">
                                <div class="text-[10px] font-black uppercase tracking-widest text-slate-400">Progreso del Proceso</div>
                                <div class="text-right">
                                    <span class="text-xs font-black inline-block text-blue-600 bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                                        <?php echo $app['progreso']; ?>%
                                    </span>
                                </div>
                            </div>
                            <!-- Barra de progreso visual -->
                            <div class="overflow-hidden h-3 mb-8 text-xs flex rounded-full bg-slate-100 border border-slate-50">
                                <div style="width:<?php echo $app['progreso']; ?>%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600 rounded-full transition-all duration-1000"></div>
                            </div>

                            <!-- Pasos/Hitos -->
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                <?php foreach ($app['pasos'] as $index => $paso): ?>
                                    <?php 
                                        $isCompleted = $index <= $app['paso_actual'];
                                        $isCurrent = $index === $app['paso_actual'];
                                    ?>
                                    <div class="flex flex-col items-center text-center space-y-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-500 <?php echo $isCompleted ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'bg-slate-100 text-slate-300'; ?> <?php echo $isCurrent ? 'ring-4 ring-blue-100 scale-110' : ''; ?>">
                                            <?php if ($isCompleted && !$isCurrent): ?>
                                                <i class="fas fa-check text-xs"></i>
                                            <?php else: ?>
                                                <span class="text-xs font-black"><?php echo $index + 1; ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="text-[10px] font-black uppercase tracking-widest <?php echo $isCompleted ? 'text-blue-600' : 'text-slate-400'; ?>">
                                            <?php echo $paso; ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="bg-white rounded-[2.5rem] border border-dashed border-gray-200 p-20 text-center">
                <i class="fas fa-paper-plane text-5xl text-gray-100 mb-6"></i>
                <p class="text-gray-400 font-bold text-lg">Aún no has postulado a ninguna vacante.</p>
                <a href="home.php" class="mt-6 inline-block bg-blue-600 text-white font-black py-4 px-10 rounded-2xl shadow-xl shadow-blue-100 transition-all active:scale-95 text-xs uppercase tracking-widest">
                    Explorar Empleos
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/components/footer.php'; ?>
