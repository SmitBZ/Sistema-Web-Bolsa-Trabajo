<?php
    session_start();
    require_once __DIR__ . '/../../src/Controllers/actualizar_perfil.php';

    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
        exit();
    }

    $usr_id = $_SESSION['id'];

    try {
        $db = new Database();
        $pdo = $db->getConnection();

        $sql_perfil = "SELECT * FROM sc_bolsa.sp_obtener_datos_perfil(:id)";
        $stmt_p = $pdo->prepare($sql_perfil);
        $stmt_p->execute(['id' => $usr_id]);
        $datos = $stmt_p->fetch(PDO::FETCH_ASSOC);

        if ($datos) {
            $nombre      = $datos['usr_nombre'];
            $apellido    = $datos['usr_apellido'];
            $foto        = !empty($datos['usr_foto']) ? $datos['usr_foto'] : '../img/usuario.png';
            $descripcion = $datos['prf_descripcion'] ?? '';
            $cargo       = $datos['prf_cargo_principal'] ?? '';
            $departamento = $datos['prf_departamento'] ?? '';
            $prf_id      = $datos['prf_id'];

            $experiencias = []; $educaciones = []; $habilidades = []; $idiomas = [];

            if ($prf_id) {
            // Cargar datos usando tus procedimientos existentes
                $stmt_e = $pdo->prepare("SELECT * FROM sc_bolsa.sp_listar_experiencia_perfil(:prf_id)");
                $stmt_e->execute(['prf_id' => $prf_id]);
                $experiencias = $stmt_e->fetchAll(PDO::FETCH_ASSOC);

                $stmt_ed = $pdo->prepare("SELECT * FROM sc_bolsa.sp_listar_educacion_perfil(:prf_id)");
                $stmt_ed->execute(['prf_id' => $prf_id]);
                $educaciones = $stmt_ed->fetchAll(PDO::FETCH_ASSOC);

                $stmt_h = $pdo->prepare("SELECT hab_nombre FROM sc_bolsa.tb_habilidad WHERE prf_id = :prf_id");
                $stmt_h->execute(['prf_id' => $prf_id]);
                $habilidades = $stmt_h->fetchAll(PDO::FETCH_COLUMN);

                $stmt_i = $pdo->prepare("SELECT idm_nombre as nombre, idm_nivel as nivel FROM sc_bolsa.tb_idioma WHERE prf_id = :prf_id");
                $stmt_i->execute(['prf_id' => $prf_id]);
                $idiomas = $stmt_i->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    } catch (PDOException $e) {
        error_log("Error al cargar configuración: " . $e->getMessage());
    }

    $activePage = 'perfil';
    $title = "Configurar Perfil - Workly";
    require_once __DIR__ . '/../../includes/components/header.php';
?>
<script src="../../assets/js/profile-config.js" defer></script>
<script src="../../assets/js/department-autocomplete.js" defer></script>
<div class="max-w-5xl mx-auto">
    <div class="mb-10">
        <h1 class="text-4xl font-black text-gray-800 uppercase tracking-tighter flex items-center gap-4">
            <span class="w-2 h-12 bg-blue-600 rounded-full"></span>
            Mi Perfil Profesional
        </h1>
        <p class="text-gray-500 font-medium mt-2">Completa tu información para destacar ante los reclutadores.</p>
    </div>

    <form action="../../src/Controllers/actualizar_perfil.php" method="POST" enctype="multipart/form-data" class="space-y-8">
        <input type="hidden" name="prf_id" value="<?php echo $prf_id; ?>">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <h2 class="text-xl font-black text-gray-800 uppercase tracking-tighter mb-8 flex items-center gap-3">
                    <i class="fas fa-id-card text-blue-500"></i> Información Básica
                </h2>
                <div class="flex flex-col md:flex-row gap-12">
                    <div class="flex flex-col items-center gap-4">
                        <div class="relative group">
                            <img id="preview" src="<?php echo $foto; ?>" class="h-40 w-40 rounded-[2rem] object-cover border-8 border-gray-50 shadow-xl group-hover:scale-105 transition-transform duration-300">
                            <label for="foto_upload" class="absolute -bottom-2 -right-2 bg-blue-600 text-white p-4 rounded-2xl cursor-pointer hover:bg-blue-700 transition shadow-lg ring-4 ring-white">
                                <i class="fas fa-camera"></i>
                                <input type="file" id="foto_upload" name="foto" class="hidden" accept="image/*" onchange="previewImage(event)">
                            </label>
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Foto de Perfil</p>
                    </div>
                    <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Nombre(s)</label>
                            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition-all font-bold text-gray-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Apellidos</label>
                            <input type="text" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition-all font-bold text-gray-700">
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Cargo Principal (Ej: Desarrollador Backend)</label>
                            <input type="text" name="cargo" value="<?php echo htmlspecialchars($cargo); ?>" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition-all font-bold text-gray-700">
                        </div>
                        <div class="space-y-2 md:col-span-2 relative">
                            <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Departamento / Región</label>
                            <div class="relative">
                                <input type="text" id="departamento_busqueda" name="departamento" value="<?php echo htmlspecialchars($departamento); ?>" autocomplete="off" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition-all font-bold text-gray-700 search-input" placeholder="Ej: Lima, Lambayeque...">
                                <div id="autocomplete-results" class="absolute z-50 w-full mt-2 bg-white rounded-2xl shadow-2xl border border-gray-50 hidden max-h-60 overflow-y-auto"></div>
                            </div>
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Resumen Profesional</label>
                            <textarea name="descripcion" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition-all font-bold text-gray-700 h-32 resize-none"><?php echo htmlspecialchars($descripcion); ?></textarea>
                                <p class="text-[10px] text-gray-400 font-medium italic mt-1">* Una breve descripción de quién eres y qué haces mejor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-black text-gray-800 uppercase tracking-tighter flex items-center gap-3">
                        <i class="fas fa-briefcase text-blue-500"></i> Experiencia Laboral
                    </h2>
                    <button type="button" id="addExperience" onclick="addExperienceRow()" class="bg-blue-50 text-blue-600 font-black text-[10px] px-6 py-3 rounded-xl uppercase tracking-widest hover:bg-blue-100 transition flex items-center gap-2">
                        <i class="fas fa-plus"></i> Añadir Cargo
                    </button>
                </div>
                <div id="experienceList" class="space-y-6">
                    <?php foreach ($experiencias as $exp): ?>
                        <div class="group p-6 bg-gray-50 border border-gray-100 rounded-3xl space-y-4 relative">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="exp_empresa[]" value="<?php echo htmlspecialchars($exp['exp_empresa']); ?>" placeholder="Empresa" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                                <input type="text" name="exp_cargo[]" value="<?php echo htmlspecialchars($exp['exp_cargo']); ?>" placeholder="Cargo" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Inicio</label>
                                    <input type="date" name="exp_fch_inicio[]" value="<?php echo $exp['exp_fch_inicio']; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Fin (Vacio si es actual)</label>
                                    <input type="date" name="exp_fch_fin[]" value="<?php echo $exp['exp_fch_fin']; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                                </div>
                                <textarea name="exp_desc[]" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm md:col-span-2 h-20 resize-none"><?php echo htmlspecialchars($exp['exp_descripcion']); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-black text-gray-800 uppercase tracking-tighter flex items-center gap-3">
                        <i class="fas fa-graduation-cap text-blue-500"></i> Educación
                    </h2>
                    <button type="button" id="addEducation" onclick="addEducationRow()" class="bg-blue-50 text-blue-600 font-black text-[10px] px-6 py-3 rounded-xl uppercase tracking-widest hover:bg-blue-100 transition flex items-center gap-2">
                        <i class="fas fa-plus"></i> Añadir Grado
                    </button>
                </div>
                <div id="educationList" class="space-y-6">
                    <?php foreach ($educaciones as $edu): ?>
                        <div class="group p-6 bg-gray-50 border border-gray-100 rounded-3xl space-y-4 relative">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="edu_institucion[]" value="<?php echo htmlspecialchars($edu['edu_institucion']); ?>" placeholder="Institución" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm">
                                <input type="text" name="edu_grado[]" value="<?php echo htmlspecialchars($edu['edu_titulo']); ?>" placeholder="Título" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm">
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Inicio</label>
                                    <input type="date" name="edu_fch_inicio[]" value="<?php echo $edu['edu_fch_inicio']; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Fin</label>
                                    <input type="date" name="edu_fch_fin[]" value="<?php echo $edu['edu_fch_fin']; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-gray-100">
                <h2 class="text-xl font-black text-gray-800 uppercase tracking-tighter mb-8 flex items-center gap-3">
                    <i class="fas fa-tools text-blue-500"></i> Habilidades
                </h2>
                <div class="space-y-6">
                    <div class="flex gap-2">
                        <input type="text" id="skillInput" placeholder="Escribe una habilidad y presiona Enter..." class="flex-grow px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition-all font-bold text-gray-700 text-sm">
                        <button type="button" onclick="addSkill()" class="bg-blue-600 text-white px-6 rounded-2xl hover:bg-blue-700 transition shadow-lg shadow-blue-100 font-black text-xs uppercase">Añadir</button>
                    </div>
                    <input type="hidden" name="habilidades" id="habilidades_input" value="<?php echo implode(',', $habilidades); ?>">
                    <div id="skillsContainer" class="flex flex-wrap gap-2">
                        <?php foreach($habilidades as $h): ?>
                            <span class="skill-badge bg-blue-50 text-blue-700 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border border-blue-100 flex items-center gap-2" data-skill="<?php echo htmlspecialchars($h); ?>"><?php echo htmlspecialchars($h); ?>
                                <button type="button" onclick="removeSkill(this)" class="hover:text-red-500"><i class="fas fa-times text-[8px]"></i></button>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-gray-100">
                <h2 class="text-xl font-black text-gray-800 uppercase tracking-tighter mb-8 flex items-center gap-3">
                    <i class="fas fa-language text-blue-500"></i> Idiomas
                </h2>
                <div id="languagesList" class="space-y-4">
                    <?php foreach($idiomas as $i): ?>
                        <div class="language-row flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-50 group hover:border-blue-100 transition-all">
                            <div class="flex-grow grid grid-cols-2 gap-4 mr-4">
                                <input type="text" name="idm_nombre[]" value="<?php echo htmlspecialchars($i['nombre']); ?>" placeholder="Idioma" class="bg-transparent border-none focus:ring-0 font-black text-gray-800 uppercase tracking-tighter text-sm">
                                <select name="idm_nivel[]" class="bg-transparent border-none focus:ring-0 text-[10px] font-bold text-blue-600 uppercase tracking-widest opacity-70">
                                    <option value="Básico" <?php echo $i['nivel'] == 'Básico' ? 'selected' : ''; ?>>Básico</option>
                                    <option value="Intermedio" <?php echo $i['nivel'] == 'Intermedio' ? 'selected' : ''; ?>>Intermedio</option>
                                    <option value="Avanzado" <?php echo $i['nivel'] == 'Avanzado' ? 'selected' : ''; ?>>Avanzado</option>
                                    <option value="Nativo" <?php echo $i['nivel'] == 'Nativo' ? 'selected' : ''; ?>>Nativo</option>
                                </select>
                            </div>
                            <button type="button" onclick="this.parentElement.remove()" class="text-gray-300 hover:text-red-500 transition"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" onclick="addLanguageRow()" class="mt-4 w-full py-4 border-2 border-dashed border-gray-100 rounded-2xl text-[10px] font-black text-gray-400 uppercase tracking-widest hover:border-blue-200 hover:text-blue-500 transition">
                    <i class="fas fa-plus mr-2"></i> Añadir Idioma
                </button>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-end gap-4 pt-10 pb-20">
            <a href="perfil.php" class="px-12 py-5 rounded-3xl font-black text-sm uppercase tracking-widest text-gray-400 hover:text-gray-600 transition text-center">Cancelar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-black py-5 px-16 rounded-3xl shadow-2xl shadow-blue-100 transition-all active:scale-95 text-sm uppercase tracking-widest">
                Guardar Todo el Perfil
            </button>
        </div>
    </form>
</div>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    function addExperienceRow() {
        const container = document.getElementById('experienceList');
        const newRow = `
        <div class="group p-6 bg-gray-50 border border-gray-100 rounded-3xl space-y-4 relative animate-fade-in shadow-sm hover:shadow-md transition-all">
            <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-100 text-red-600 w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-600 hover:text-white transition">
                <i class="fas fa-times text-xs"></i>
            </button>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="exp_empresa[]" placeholder="Empresa" class="w-full px-4 py-3 rounded-xl border border-gray-100 outline-none font-bold text-gray-700 text-sm">
                <input type="text" name="exp_cargo[]" placeholder="Cargo" class="w-full px-4 py-3 rounded-xl border border-gray-100 outline-none font-bold text-gray-700 text-sm">
                <div class="space-y-1">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Inicio</label>
                    <input type="date" name="exp_fch_inicio[]" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Fin</label>
                    <input type="date" name="exp_fch_fin[]" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                </div>
                <textarea name="exp_desc[]" placeholder="Descripción de sus logros y responsabilidades..." class="w-full px-4 py-3 rounded-xl border border-gray-100 outline-none font-bold text-gray-700 text-sm md:col-span-2 h-20 resize-none"></textarea>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', newRow);
    }

    function addEducationRow() {
        const container = document.getElementById('educationList');
        const newRow = `
        <div class="group p-6 bg-gray-50 border border-gray-100 rounded-3xl space-y-4 relative animate-fade-in shadow-sm hover:shadow-md transition-all">
             <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-100 text-red-600 w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-600 hover:text-white transition">
                <i class="fas fa-times text-xs"></i>
            </button>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="edu_institucion[]" placeholder="Institución" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                <input type="text" name="edu_grado[]" placeholder="Título / Grado" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                <div class="space-y-1">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Inicio</label>
                    <input type="date" name="edu_fch_inicio[]" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Fin</label>
                    <input type="date" name="edu_fch_fin[]" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm">
                </div>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', newRow);
    }
    const skillInput = document.getElementById('skillInput');
    const skillsContainer = document.getElementById('skillsContainer');
    const habilidadesHidden = document.getElementById('habilidades_input');
    skillInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addSkill();
        }
    });
    function addSkill() {
        const value = skillInput.value.trim();
        if (value) {
            const skills = habilidadesHidden.value.split(',').filter(s => s !== '');
            if (!skills.includes(value)) {
                skills.push(value);
                habilidadesHidden.value = skills.join(',');
                const badge = document.createElement('span');
                badge.className = 'skill-badge bg-blue-50 text-blue-700 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border border-blue-100 flex items-center gap-2';
                badge.setAttribute('data-skill', value);
                badge.innerHTML = `${value} <button type="button" onclick="removeSkill(this)" class="hover:text-red-500"><i class="fas fa-times text-[8px]"></i></button>`;
                skillsContainer.appendChild(badge);
            }
            skillInput.value = '';
        }
    }
    function removeSkill(button) {
        const badge = button.parentElement;
        const skillName = badge.getAttribute('data-skill');
        let skills = habilidadesHidden.value.split(',').filter(s => s !== '');
        skills = skills.filter(s => s !== skillName);
        habilidadesHidden.value = skills.join(',');
        badge.remove();
    }
    function addLanguageRow() {
        const container = document.getElementById('languagesList');
        const newRow = `
        <div class="language-row flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-50 group hover:border-blue-100 transition-all animate-fade-in shadow-sm">
            <div class="flex-grow grid grid-cols-2 gap-4 mr-4">
                <input type="text" name="idm_nombre[]" placeholder="Idioma" class="bg-transparent border-none focus:ring-0 font-black text-gray-800 uppercase tracking-tighter text-sm">
                <select name="idm_nivel[]" class="bg-transparent border-none focus:ring-0 text-[10px] font-bold text-blue-600 uppercase tracking-widest opacity-70">
                    <option value="Básico">Básico</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Avanzado">Avanzado</option>
                    <option value="Nativo">Nativo</option>
                </select>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-gray-300 hover:text-red-500 transition"><i class="fas fa-trash-alt"></i></button>
        </div>`;
        container.insertAdjacentHTML('beforeend', newRow);
    }
</script>
<?php require_once __DIR__ . '/../../includes/components/footer.php'; ?>