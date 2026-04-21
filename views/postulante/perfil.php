<?php
    require_once __DIR__ . '/../../config/Database/conexion.php';
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit();
    }

    $usr_id = $_SESSION['id'];

    try {
        $db = new Database();
        $pdo = $db->getConnection();
        $sql = "SELECT * FROM sc_bolsa.sp_obtener_datos_perfil(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $usr_id]);
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        $nombre_completo = $datos['usr_nombre'] . " " . $datos['usr_apellido'];
        $correo = $datos['usr_corrreo'];
        $foto = !empty($datos['usr_foto']) ? $datos['usr_foto'] : '../../assets/img/perfil.png';
        $descripcion = $datos['prf_descripcion'] ?? 'Aún no has añadido una descripción a tu perfil.';
        $cargo = $datos['prf_cargo_principal'] ?? 'Postulante';
        $departamento = $datos['prf_departamento'] ?? 'No especificado';
        $prf_id = $datos['prf_id'];

        $experiencias = []; $educaciones = []; $habilidades = []; $idiomas = [];

        if ($prf_id) {
            //Consulta de expeeriencia
            $stmt_exp = $pdo->prepare("SELECT * FROM sc_bolsa.tb_experiencia WHERE prf_id = ? ORDER BY exp_fch_inicio DESC");
            $stmt_exp->execute([$prf_id]);
            $experiencias = $stmt_exp->fetchAll(PDO::FETCH_ASSOC);

            //Consulta de educacion
            $stmt_edu = $pdo->prepare("SELECT * FROM sc_bolsa.tb_educacion WHERE prf_id = ? ORDER BY edu_fch_inicio DESC");
            $stmt_edu->execute([$prf_id]);
            $educaciones = $stmt_edu->fetchAll(PDO::FETCH_ASSOC);

            //Consulta de habilidades
            $stmt_hab = $pdo->prepare("SELECT hab_nombre FROM sc_bolsa.tb_habilidad WHERE prf_id = ?");
            $stmt_hab->execute([$prf_id]);
            $habilidades = $stmt_hab->fetchAll(PDO::FETCH_COLUMN);

            //Consulta de idiomas
            $stmt_idm = $pdo->prepare("SELECT idm_nombre, idm_nivel FROM sc_bolsa.tb_idioma WHERE prf_id = ?");
            $stmt_idm->execute([$prf_id]);
            $idiomas = $stmt_idm->fetchAll(PDO::FETCH_ASSOC);
    }
    } catch (PDOException $e) {
        error_log("Error al cargar perfil: " . $e->getMessage());
        die("Error al cargar perfil");
    }
    function format_periodo($inicio, $fin) {
        if (!$inicio) return "No especificado";
            $meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
            $f_inicio = new DateTime($inicio);
            $res = $meses[$f_inicio->format('n')-1] . " " . $f_inicio->format('Y');
            $res .= ($fin) ? " — " . $meses[(new DateTime($fin))->format('n')-1] . " " . (new DateTime($fin))->format('Y') : " — Actualidad";
            return $res;
        }
    $activePage = 'perfil';
    $title = "Mi Perfil - Workly";
    include __DIR__ .  '/../../includes/components/header.php';
?>
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="h-48 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 relative">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    </div>
    <div class="px-8 pb-10">
        <div class="relative flex flex-col md:flex-row justify-between items-end -mt-16 gap-6">
            <div class="flex flex-col md:flex-row items-end gap-6 w-full md:w-auto">
                <div class="relative group">
                    <img src="<?php echo $foto; ?>" class="h-40 w-40 rounded-3xl border-8 border-white shadow-2xl object-cover bg-white transition-transform duration-300">
                </div>
                <div class="pb-2 w-full text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-3">
                        <h1 class="text-3xl font-black text-gray-900"><?php echo $nombre_completo; ?></h1>
                        <span class="bg-green-100 text-green-700 text-[10px] font-black px-2 py-1 rounded-lg uppercase tracking-widest">Verificado</span>
                    </div>
                    <p class="text-blue-600 font-black text-sm uppercase tracking-tighter mt-1 opacity-80"><?php echo $cargo; ?></p>
                    <div class="flex flex-wrap justify-center md:justify-start items-center gap-6 mt-4 text-xs font-bold text-gray-400">
                        <span class="flex items-center gap-2"><i class="fas fa-map-marker-alt text-blue-500"></i> <?php echo htmlspecialchars($departamento); ?>, Perú</span>
                        <span class="flex items-center gap-2"><i class="fas fa-envelope text-blue-500"></i> <?php echo htmlspecialchars($correo); ?></span>
                    </div>
                </div>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <a href="perfil_edit.php" class="flex-1 md:flex-none text-center bg-gray-50 hover:bg-gray-100 text-gray-700 font-black py-4 px-8 rounded-2xl transition-all border border-gray-100 text-sm uppercase tracking-tighter">
                    <i class="fas fa-edit mr-2 opacity-50"></i>Editar Perfil
                </a>
                <button class="flex-1 md:flex-none text-center bg-blue-600 hover:bg-blue-800 text-white font-black py-4 px-10 rounded-2xl shadow-xl shadow-blue-100 transition-all text-sm uppercase tracking-tighter">
                    Descargar CV
                </button>
            </div>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="space-y-8">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-50 group">
            <h2 class="text-lg font-black text-gray-800 uppercase tracking-tighter mb-6">Habilidades</h2>
            <div class="flex flex-wrap gap-2">
                <?php if (empty($habilidades)): ?>
                    <p class="text-gray-400 italic text-xs">No hay habilidades registradas.</p>
                <?php else: ?>
                    <?php foreach($habilidades as $h): ?>
                        <span class="bg-blue-50 text-blue-700 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest ring-1 ring-blue-100"><?php echo htmlspecialchars($h); ?></span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-50 group">
            <h2 class="text-lg font-black text-gray-800 uppercase tracking-tighter mb-6">Idiomas</h2>
            <div class="space-y-4">
                <?php if (empty($idiomas)): ?>
                    <p class="text-gray-400 italic text-xs">No hay idiomas registrados.</p>
                <?php else: ?>
                    <?php foreach($idiomas as $i): ?>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-gray-700 uppercase tracking-tighter"><?php echo htmlspecialchars($i['idm_nombre']); ?></span>
                            <span class="bg-green-50 text-green-700 text-[10px] font-black px-3 py-1 rounded-lg uppercase tracking-widest"><?php echo htmlspecialchars($i['idm_nivel']); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-50 relative overflow-hidden group">
            <h2 class="text-xl font-black text-gray-800 mb-6 uppercase tracking-tighter flex items-center gap-3">
                <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                Sobre mí
            </h2>
            <p class="text-gray-500 font-medium leading-relaxed text-lg max-w-2xl">
                <?php echo nl2br($descripcion); ?>
            </p>
        </div>
        <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <h3 class="text-xl font-black text-slate-900 mb-10 tracking-tight flex items-center gap-3">
                Experiencia Laboral
            </h3>
            <div class="space-y-10">
                <?php foreach ($experiencias as $exp): ?>
                    <div class="group relative pl-8 border-l-2 border-slate-100 hover:border-blue-500 transition-colors">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 bg-white border-2 border-slate-200 rounded-full group-hover:border-blue-500 group-hover:bg-blue-500 transition-all"></div>
                        <div class="flex flex-col mb-2">
                            <h4 class="text-lg font-black text-slate-800 uppercase tracking-tight"><?php echo $exp['exp_cargo']; ?></h4>
                            <span class="text-blue-600 font-bold text-sm"><?php echo $exp['exp_empresa']; ?></span>
                            <span class="text-slate-400 text-xs font-medium mt-1">
                                    <i class="far fa-calendar-alt mr-1"></i> <?php echo format_periodo($exp['exp_fch_inicio'], $exp['exp_fch_fin']); ?>
                                </span>
                        </div>
                        <p class="text-slate-500 text-sm font-medium leading-relaxed bg-slate-50/50 p-5 rounded-2xl border border-slate-50">
                            <?php echo htmlspecialchars($exp['exp_descripcion']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-50">
            <h2 class="text-xl font-black text-gray-800 mb-10 uppercase tracking-tighter flex items-center gap-3">
                <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                Educación
            </h2>
            <div class="space-y-12">
                <?php if (empty($educaciones)): ?>
                    <p class="text-gray-400 italic text-sm">Aún no has registrado información académica.</p>
                <?php else: ?>
                    <?php foreach ($educaciones as $edu): ?>
                        <div class="flex gap-6 relative">
                            <div class="flex-shrink-0 w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 text-xl border border-indigo-100 shadow-sm z-10">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div>
                                <h3 class="font-black text-gray-900 text-lg uppercase tracking-tighter"><?php echo htmlspecialchars($edu['edu_titulo']); ?></h3>
                                <p class="text-indigo-600 text-sm font-black uppercase tracking-widest opacity-80 mt-1"><?php echo htmlspecialchars($edu['edu_institucion']); ?></p>
                                <div class="flex items-center gap-3 text-xs font-bold text-gray-400 mt-2">
                                    <span class="flex items-center gap-1.5"><i class="far fa-calendar-alt"></i> <?php echo format_periodo($edu['edu_fch_inicio'], $edu['edu_fch_fin']); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../../includes/components/footer.php' ?>