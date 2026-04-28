class NotificationManager {
    constructor() {
        this.Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    }
    showToast(message, icon = 'success') {
        this.Toast.fire({
            icon: icon,
            title: message
        });
    }
    success(title, text) {
        Swal.fire({
            icon: 'success',
            title: title,
            text: text,
            confirmButtonColor: '#2563eb'
        });
    }
    error(title, text) {
        Swal.fire({
            icon: 'error',
            title: title,
            text: text,
            confirmButtonColor: '#ef4444'
        });
    }
    warning(title, text) {
        Swal.fire({
            icon: 'warning',
            title: title,
            text: text,
            confirmButtonColor: '#f59e0b'
        });
    }
    handleUrlParams() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const error = urlParams.get('error');
        const msg = urlParams.get('msg');

        if (status === 'updated') {
            this.showToast('¡Perfil actualizado con éxito!');
        } else if (status === 'success') {
            this.showToast(msg || 'Operación realizada correctamente');
        }

        if (error) {
            let title = 'Error';
            let text = 'Ocurrió un error inesperado.';
            let icon = 'error';

            if (error === 'invalid_credentials') {
                title = 'Acceso Denegado';
                text = 'El correo o la contraseña son incorrectos.';
            } else if (error === 'db_error') {
                text = 'Error en la conexión con la base de datos.';
            } else if (error === 'exists') {
                title = 'Registro Fallido';
                text = 'Este correo electrónico ya se encuentra registrado.';
                icon = 'warning';
            }

            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                confirmButtonColor: '#2563eb'
            });
        }
    }
}
window.Notifications = new NotificationManager();
document.addEventListener('DOMContentLoaded', () => {
    window.Notifications.handleUrlParams();
    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');
    const notiBtn = document.getElementById('notiBtn');
    const notiMenu = document.getElementById('notificationsMenu');
    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (notiMenu) notiMenu.classList.add('hidden'); // Cerrar el otro menu
            profileMenu.classList.toggle('hidden');
        });
    }
    if (notiBtn && notiMenu) {
        notiBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (profileMenu) profileMenu.classList.add('hidden'); // Cerrar el otro menu
            notiMenu.classList.toggle('hidden');
        });
    }
    window.addEventListener('click', () => {
        if (profileMenu && !profileMenu.classList.contains('hidden')) {
            profileMenu.classList.add('hidden');
        }
        if (notiMenu && !notiMenu.classList.contains('hidden')) {
            notiMenu.classList.add('hidden');
        }
    });

    // Form Email Validation Logic
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const emailInput = form.querySelector('input[type="email"][name="correo"]');
            if (emailInput) {
                const email = emailInput.value.toLowerCase().trim();
                const isEmpresa = window.location.href.includes('/empresa/');
                const isPostulante = window.location.href.includes('/postulante/');
                
                const domain = email.substring(email.lastIndexOf("@") + 1);
                
                if (isPostulante) {
                    if (domain.includes('.edu')) {
                        e.preventDefault();
                        window.Notifications.warning(
                            'Correo no permitido',
                            'Los postulantes no pueden ingresar o registrarse con correos educativos (.edu).'
                        );
                        return false;
                    }
                } else if (isEmpresa) {
                    const freeDomains = ['gmail.com', 'hotmail.com', 'outlook.com', 'outlook.es', 'live.com', 'yahoo.com', 'yahoo.es', 'aol.com', 'icloud.com'];
                    if (freeDomains.includes(domain)) {
                        e.preventDefault();
                        window.Notifications.warning(
                            'Correo no permitido',
                            'Las empresas deben usar un correo corporativo o educativo válido. No se permiten correos gratuitos.'
                        );
                        return false;
                    }
                }
            }
        });
    });
});
window.togglePassword = function(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
};

