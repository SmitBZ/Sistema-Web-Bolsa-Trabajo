document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('departamento_busqueda');
    const resultsContainer = document.getElementById('autocomplete-results');
    const departamentos = [
        "Amazonas", "Áncash", "Apurímac", "Arequipa", "Ayacucho",
        "Cajamarca", "Callao", "Cusco", "Huancavelica", "Huánuco",
        "Ica", "Junín", "La Libertad", "Lambayeque", "Lima",
        "Loreto", "Madre de Dios", "Moquegua", "Pasco", "Piura",
        "Puno", "San Martín", "Tacna", "Tumbes", "Ucayali"
    ];
    if (!input || !resultsContainer) return;
    input.addEventListener('input', (e) => {
        const start = e.target.selectionStart;
        const end = e.target.selectionEnd;
        const originalValue = e.target.value;

        // Reemplazar cualquier cosa que no sea letra o espacio
        const cleanValue = originalValue.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');

        if (originalValue !== cleanValue) {
            e.target.value = cleanValue;
            // Mantener la posición del cursor
            e.target.setSelectionRange(start - 1, end - 1);
        }
        showResults(cleanValue);
    });

    function showResults(query) {
        resultsContainer.innerHTML = '';
        if (!query || query.length < 1) {
            resultsContainer.classList.add('hidden');
            return;
        }
        const filtered = departamentos.filter(d =>
            d.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                .includes(query.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, ""))
        );
        if (filtered.length > 0) {
            filtered.forEach(dept => {
                const div = document.createElement('div');
                div.className = 'px-6 py-4 hover:bg-blue-50 cursor-pointer font-bold text-gray-700 transition border-b border-gray-50 last:border-none';
                div.textContent = dept;
                div.onclick = () => {
                    input.value = dept;
                    resultsContainer.classList.add('hidden');
                };
                resultsContainer.appendChild(div);
            });
            resultsContainer.classList.remove('hidden');
        } else {
            resultsContainer.classList.add('hidden');
        }
    }

    document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !resultsContainer.contains(e.target)) {
            resultsContainer.classList.add('hidden');
        }
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            resultsContainer.classList.add('hidden');
        }
    });
});
