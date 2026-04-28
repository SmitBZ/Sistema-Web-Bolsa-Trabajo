<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit();
    }
    $title = "Opciones de Cuenta - Workly";
    require_once __DIR__ . '/../../includes/components/header.php';
?>

<div class="max-w-4xl mx-auto py-12">
    <div class="mb-10 text-center md:text-left">
        <h1 class="text-4xl font-black text-gray-800 uppercase tracking-tighter flex flex-col md:flex-row items-center gap-4">
            <span class="w-2 h-12 bg-blue-600 rounded-full hidden md:block"></span>
            Configuración de Seguridad
        </h1>
        <p class="text-gray-500 font-medium mt-2">Gestiona el acceso y la seguridad de tu cuenta.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar lateral con navegación (opcional por si se añaden más cosas luego) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[2rem] border border-gray-100 p-6 shadow-sm sticky top-24">
                <nav class="space-y-2">
                    <a href="#password" class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-blue-50 text-blue-600 font-bold transition">
                        <i class="fas fa-lock"></i>
                        <span>Cambiar Contraseña</span>
                    </a>
                    <div class="px-4 py-3 text-xs font-black text-gray-300 uppercase tracking-widest mt-6">Próximamente</div>
                    <div class="flex items-center gap-3 px-4 py-3 text-gray-400 font-medium cursor-not-allowed opacity-50">
                        <i class="fas fa-bell"></i>
                        <span>Notificaciones Email</span>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-3 text-gray-400 font-medium cursor-not-allowed opacity-50">
                        <i class="fas fa-shield-alt"></i>
                        <span>Autenticación 2FA</span>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Contenido Principal -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Sección: Cambio de Contraseña -->
            <section id="password" class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 overflow-hidden">
                <div class="p-8 md:p-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-key text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-gray-800 uppercase tracking-tight">Cambiar Contraseña</h2>
                            <p class="text-xs text-gray-400 font-medium italic">Se recomienda usar una mezcla de letras, números y símbolos.</p>
                        </div>
                    </div>

                    <form action="../../src/Controllers/actualizar_password.php" method="POST" class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Contraseña Actual</label>
                            <div class="relative">
                                <input type="password" id="current_password" name="password_actual" required
                                       class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition-all font-bold text-gray-700 pr-12">
                                <button type="button" onclick="togglePassword('current_password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Nueva Contraseña</label>
                                <div class="relative">
                                    <input type="password" id="new_password" name="nueva_password" required
                                           class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition-all font-bold text-gray-700 pr-12">
                                    <button type="button" onclick="togglePassword('new_password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Confirmar Nueva</label>
                                <div class="relative">
                                    <input type="password" id="confirm_password" name="confirmar_password" required
                                           class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 outline-none transition-all font-bold text-gray-700 pr-12">
                                    <button type="button" onclick="togglePassword('confirm_password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-black py-4 px-8 rounded-2xl shadow-lg shadow-slate-200 transition-all active:scale-95 text-sm uppercase tracking-widest">
                                Actualizar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/components/footer.php'; ?>
