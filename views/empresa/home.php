<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit();
    }
    $activePage = 'home';
    $title = "Workly - Dashboard Empresa";

    // Dummy data for dashboard
    $stats = [
        'ofertas_activas' => 5,
        'postulantes_nuevos' => 12,
        'vistas_perfil' => 48,
        'entrevistas_hoy' => 2
    ];

include '../../includes/components/header_empresa.php';
?>

<div class="space-y-8">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Panel de Control</h1>
            <p class="text-slate-500 font-medium mt-1">Resumen de tu actividad de reclutamiento hoy.</p>
        </div>
        <div class="text-sm text-slate-400 font-bold uppercase tracking-widest bg-white border border-slate-100 px-4 py-2 rounded-full shadow-sm">
            <?php echo date('d M, Y'); ?>
        </div>
    </header>

    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>
            <p class="text-3xl font-black text-slate-800"><?php echo $stats['ofertas_activas']; ?></p>
            <p class="text-xs font-bold text-slate-400 uppercase mt-1">Ofertas Activas</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <p class="text-3xl font-black text-slate-800"><?php echo $stats['postulantes_nuevos']; ?></p>
            <p class="text-xs font-bold text-slate-400 uppercase mt-1">Nuevos Postulantes</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
            <p class="text-3xl font-black text-slate-800"><?php echo $stats['vistas_perfil']; ?></p>
            <p class="text-xs font-bold text-slate-400 uppercase mt-1">Vistas de Perfil</p>
        </div>
        <div class="bg-indigo-600 p-6 rounded-3xl shadow-lg shadow-indigo-200 text-white flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
            <div>
                <p class="text-3xl font-black"><?php echo $stats['entrevistas_hoy']; ?></p>
                <p class="text-xs font-bold text-indigo-200 uppercase mt-1">Entrevistas Hoy</p>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <section class="lg:col-span-2 bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-black text-slate-800">Ofertas Recientes</h2>
                <a href="mis_ofertas.php" class="text-xs font-bold text-indigo-600 uppercase tracking-widest hover:underline">Ver todas</a>
            </div>
            <div class="space-y-4">
                <!-- Oferta Item -->
                <div class="flex items-center justify-between p-4 rounded-2xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition cursor-pointer group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 group-hover:text-indigo-600 group-hover:bg-indigo-50 transition">
                            <i class="fas fa-code"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Desarrollador Backend PHP</h3>
                            <p class="text-xs font-medium text-slate-500 mt-0.5">Chiclayo, Perú • Presencial</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-green-50 text-green-600 uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Activa
                        </span>
                        <p class="text-xs font-bold text-slate-400 mt-1">12 Postulantes</p>
                    </div>
                </div>
                <!-- Oferta Item -->
                <div class="flex items-center justify-between p-4 rounded-2xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition cursor-pointer group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 group-hover:text-indigo-600 group-hover:bg-indigo-50 transition">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Diseñador UI/UX</h3>
                            <p class="text-xs font-medium text-slate-500 mt-0.5">Remoto • Tiempo Completo</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-orange-50 text-orange-600 uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Pausada
                        </span>
                        <p class="text-xs font-bold text-slate-400 mt-1">45 Postulantes</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-3xl flex items-center justify-center mb-6">
                <i class="fas fa-rocket text-3xl"></i>
            </div>
            <h3 class="text-lg font-black text-slate-800 mb-2">Encuentra al mejor talento</h3>
            <p class="text-sm text-slate-500 font-medium mb-8">Publica una nueva oferta de trabajo y llega a miles de profesionales calificados hoy mismo.</p>
            <a href="crear_oferta.php" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-indigo-200 transition transform active:scale-[0.98] text-sm uppercase tracking-widest">
                Crear Oferta
            </a>
        </section>
    </div>
</div>

<?php include '../../includes/components/footer_empresa.php'; ?>
