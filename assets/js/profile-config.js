document.addEventListener('DOMContentLoaded', () => {
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
    const addEducationBtn = document.getElementById('addEducation');
    const educationList = document.getElementById('educationList');

    function createDeleteBtn(parent) {
        const btn = document.createElement('button');
        btn.innerHTML = '<i class="fas fa-trash-alt"></i>';
        btn.className = 'absolute -top-3 -right-3 w-8 h-8 rounded-full bg-red-100 text-red-600 border border-red-200 hover:bg-red-200 transition shadow-sm flex items-center justify-center';
        btn.onclick = () => parent.remove();
        return btn;
    }
    if (addExperienceBtn && experienceList) {
        addExperienceBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.className = 'group p-6 bg-gray-50 border border-gray-100 rounded-3xl space-y-4 relative animate-in slide-in-from-top-2 duration-300';
            div.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="exp_empresa[]" placeholder="Empresa" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm">
                    <input type="text" name="exp_cargo[]" placeholder="Cargo" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm">
                    <input type="text" name="exp_fecha[]" placeholder="Periodo (Ej. 2022 - Presente)" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm md:col-span-2">
                    <textarea name="exp_desc[]" placeholder="Logros y responsabilidades" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm md:col-span-2 h-20 resize-none"></textarea>
                </div>
            `;
            div.appendChild(createDeleteBtn(div));
            experienceList.appendChild(div);
        });
    }
    if (addEducationBtn && educationList) {
        addEducationBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.className = 'group p-6 bg-gray-50 border border-gray-100 rounded-3xl space-y-4 relative animate-in slide-in-from-top-2 duration-300';
            div.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="edu_institucion[]" placeholder="Institución" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm">
                    <input type="text" name="edu_grado[]" placeholder="Título o Grado" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm">
                    <input type="text" name="edu_periodo[]" placeholder="Periodo" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition font-bold text-gray-700 text-sm md:col-span-2">
                </div>
            `;
            div.appendChild(createDeleteBtn(div));
            educationList.appendChild(div);
        });
    }
});
