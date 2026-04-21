<?php
    session_start();
    $activePage = 'notificaciones';
    $title = "Notificaciones - Workly";
    require_once __DIR__ . '/../../includes/components/header.php';

    $notificaciones = [
        [
            "titulo" => "Nueva oferta: Desarrollador Backend",
            "descripcion" => "Empresa Tech Chiclayo busca un perfil como el tuyo para su nuevo proyecto de e-commerce.",
            "fecha" => "Hace 2 horas",
            "icon" => "fa-briefcase",
            "color" => "blue",
            "leida" => false
        ],
        [
            "titulo" => "¡Tu perfil fue visto!",
            "descripcion" => "Un reclutador de una importante empresa de Lima revisó tu perfil y experiencia laboral.",
            "fecha" => "Hace 5 horas",
            "icon" => "fa-eye",
            "color" => "indigo",
            "leida" => true
        ],
        [
            "titulo" => "Sugerencia de empleo",
            "descripcion" => "Basado en tus habilidades en PHP, podrías estar interesado en: Senior Software Engineer.",
            "fecha" => "Ayer",
            "icon" => "fa-lightbulb",
            "color" => "orange",
            "leida" => true
        ],
        [
            "titulo" => "Actualización de sistema",
            "descripcion" => "Hemos mejorado la velocidad de búsqueda de empleo. ¡Pruébala ahora!",
            "fecha" => "Hace 2 días",
            "icon" => "fa-info-circle",
            "color" => "emerald",
            "leida" => true
        ]
    ];
?>

<div class="max-w-4xl mx-auto">
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h1 class="text-4xl font-black text-gray-800 uppercase tracking-tighter flex items-center gap-4">
                <span class="w-2 h-12 bg-blue-600 rounded-full"></span>
                Mis Notificaciones
            </h1>
            <p class="text-gray-500 font-medium mt-2">Mantente al tanto de tus postulaciones y nuevas oportunidades.</p>
        </div>
        <button class="bg-blue-50 text-blue-600 font-black text-[10px] px-6 py-3 rounded-xl uppercase tracking-widest hover:bg-blue-600 hover:text-white transition shadow-sm">
            Marcar todas como leídas
        </button>
    </div>

    <div class="space-y-4">
        <?php foreach ($notificaciones as $noti): ?>
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:border-blue-100 transition-all duration-300 group relative overflow-hidden">
                <?php if (!$noti['leida']): ?>
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-600"></div>
                <?php endif; ?>
                
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-<?php echo $noti['color']; ?>-50 text-<?php echo $noti['color']; ?>-600 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-<?php echo $noti['color']; ?>-600 group-hover:text-white transition-all duration-500 shadow-sm">
                        <i class="fas <?php echo $noti['icon']; ?> text-xl"></i>
                    </div>
                    
                    <div class="flex-grow space-y-2">
                        <div class="flex justify-between items-start">
                            <h2 class="text-lg font-black text-gray-800 tracking-tight group-hover:text-blue-600 transition">
                                <?php echo $noti['titulo']; ?>
                            </h2>
                            <span class="text-[10px] font-black text-gray-400 border border-gray-100 px-3 py-1 rounded-lg uppercase tracking-widest">
                                <?php echo $noti['fecha']; ?>
                            </span>
                        </div>
                        <p class="text-gray-500 font-medium leading-relaxed">
                            <?php echo $noti['descripcion']; ?>
                        </p>
                        <div class="pt-2 flex gap-3">
                            <button class="text-[10px] font-black text-blue-600 uppercase tracking-widest hover:underline">Ver detalles</button>
                            <button class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-red-500">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-12 flex justify-center items-center gap-4">
        <button class="w-12 h-12 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-gray-50 transition shadow-sm">
            <i class="fas fa-chevron-left text-xs"></i>
        </button>
        <span class="text-xs font-black text-blue-600 tracking-widest uppercase">Página 1 de 1</span>
        <button class="w-12 h-12 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-gray-50 transition shadow-sm opacity-50 cursor-not-allowed">
            <i class="fas fa-chevron-right text-xs"></i>
        </button>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/components/footer.php'; ?>
