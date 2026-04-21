</main>
    <footer class="bg-white border-t border-workly py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <img class="h-6 opacity-50 grayscale" src="../../assets/img/logo.png" alt="Workly">
                <p class="text-sm text-[#656c89]">&copy; 2026 Workly. Todos los derechos reservados.</p>
            </div>
            <div class="flex gap-6">
                <a href="#" class="text-xs text-[#656c89] hover:text-[#385cb4]">Términos</a>
                <a href="#" class="text-xs text-[#656c89] hover:text-[#385cb4]">Privacidad</a>
                <a href="#" class="text-xs text-[#656c89] hover:text-[#385cb4]">Ayuda</a>
            </div>
        </div>
    </footer>
    <script>
        const profileBtn = document.getElementById('profileBtn');
        const profileMenu = document.getElementById('profileMenu');

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', () => {
            profileMenu.classList.add('hidden');
        });
    </script>
</body>
</html>