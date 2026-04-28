document.addEventListener('DOMContentLoaded', () => {
    // PREVISUALIZACIÓN DE FOTO
    const fotoInput = document.getElementById('foto_upload');
    const previewImg = document.getElementById('preview');
    if (fotoInput && previewImg) {
        fotoInput.addEventListener('change', (e) => {
            const reader = new FileReader();
            reader.onload = function () {
                previewImg.src = reader.result;
            };
            if (e.target.files[0]) {
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    }

    const addExperienceBtn = document.getElementById('addExperience');
    const experienceList = document.getElementById('experienceList');
    if (addExperienceBtn && experienceList) {
        addExperienceBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.className = 'group p-6 bg-gray-50 border border-gray-100 rounded-3xl space-y-4 relative animate-fade-in shadow-sm hover:shadow-md transition-all duration-300';
            div.innerHTML = `
                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-100 text-red-600 w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-600 hover:text-white transition shadow-sm">
                    <i class="fas fa-times text-xs"></i>
                </button>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="exp_empresa[]" placeholder="Empresa" class="w-full px-4 py-3 rounded-xl border border-gray-100 outline-none font-bold text-gray-700 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all">
                    <input type="text" name="exp_cargo[]" placeholder="Cargo" class="w-full px-4 py-3 rounded-xl border border-gray-100 outline-none font-bold text-gray-700 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all">
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Inicio</label>
                        <input type="date" name="exp_fch_inicio[]" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Fin</label>
                        <input type="date" name="exp_fch_fin[]" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all">
                    </div>
                    <textarea name="exp_desc[]" placeholder="Descripción de sus logros y responsabilidades..." class="w-full px-4 py-3 rounded-xl border border-gray-100 outline-none font-bold text-gray-700 text-sm md:col-span-2 h-20 resize-none focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all"></textarea>
                </div>
            `;
            experienceList.appendChild(div);
        });
    }

    // GESTIÓN DE EDUCACIÓN
    const addEducationBtn = document.getElementById('addEducation');
    const educationList = document.getElementById('educationList');
    if (addEducationBtn && educationList) {
        addEducationBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.className = 'group p-6 bg-gray-50 border border-gray-100 rounded-3xl space-y-4 relative animate-fade-in shadow-sm hover:shadow-md transition-all duration-300';
            div.innerHTML = `
                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-100 text-red-600 w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-600 hover:text-white transition shadow-sm">
                    <i class="fas fa-times text-xs"></i>
                </button>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="edu_institucion[]" placeholder="Institución" class="w-full px-4 py-3 rounded-xl border border-gray-100 outline-none font-bold text-gray-700 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all">
                    <input type="text" name="edu_grado[]" placeholder="Título / Grado" class="w-full px-4 py-3 rounded-xl border border-gray-100 outline-none font-bold text-gray-700 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all">
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Inicio</label>
                        <input type="date" name="edu_fch_inicio[]" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Fecha Fin</label>
                        <input type="date" name="edu_fch_fin[]" class="w-full px-4 py-3 rounded-xl border border-gray-100 font-bold text-gray-700 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all">
                    </div>
                </div>
            `;
            educationList.appendChild(div);
        });
    }

    // GESTIÓN DE HABILIDADES
    const skillInput = document.getElementById('skillInput');
    const skillsContainer = document.getElementById('skillsContainer');
    const habilidadesHidden = document.getElementById('habilidades_input');

    if (skillInput) {
        skillInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addSkill();
            }
        });
    }

    window.addSkill = function () {
        if (!skillInput || !skillsContainer || !habilidadesHidden) return;
        const value = skillInput.value.trim();
        if (value) {
            const skills = habilidadesHidden.value.split(',').filter(s => s !== '');
            if (!skills.includes(value)) {
                skills.push(value);
                habilidadesHidden.value = skills.join(',');
                const badge = document.createElement('span');
                badge.className = 'skill-badge bg-blue-50 text-blue-700 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border border-blue-100 flex items-center gap-2 animate-fade-in shadow-sm';
                badge.setAttribute('data-skill', value);
                badge.innerHTML = `${value} <button type="button" onclick="removeSkill(this)" class="hover:text-red-500 transition"><i class="fas fa-times text-[8px]"></i></button>`;
                skillsContainer.appendChild(badge);
            }
            skillInput.value = '';
        }
    }

    window.removeSkill = function (button) {
        if (!habilidadesHidden) return;
        const badge = button.parentElement;
        const skillName = badge.getAttribute('data-skill');
        let skills = habilidadesHidden.value.split(',').filter(s => s !== '');
        skills = skills.filter(s => s !== skillName);
        habilidadesHidden.value = skills.join(',');
        badge.remove();
    }

    // GESTIÓN DE IDIOMAS
    const languagesList = document.getElementById('languagesList');
    window.addLanguageRow = function () {
        if (!languagesList) return;
        const div = document.createElement('div');
        div.className = 'language-row flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-50 group hover:border-blue-100 transition-all animate-fade-in shadow-sm';
        div.innerHTML = `
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
        `;
        languagesList.appendChild(div);
    }
});
