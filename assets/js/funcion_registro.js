const urlParams = new URLSearchParams(window.location.search);
const status = urlParams.get('status');

function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
const passwordInput = document.getElementById('registro_password');
const strengthBar = document.getElementById('strength_bar');
const strengthText = document.getElementById('strength_text');
passwordInput.addEventListener('input', function() {
    const val = passwordInput.value;
    let strength = 0;
    let message = "";
    let color = "bg-red-500";
    if (val.length > 8) strength += 25;
    if (/[a-zA-Z]/.test(val)) strength += 25;
    if (/[0-9]/.test(val)) strength += 25;
    if (/[^a-zA-Z0-9]/.test(val)) strength += 25;

    if (strength <= 25) {
        message = "MUY DÉBIL";
        color = "bg-red-500";
    } else if (strength <= 50) {
        message = "DÉBIL";
        color = "bg-orange-500";
    } else if (strength <= 75) {
        message = "BUENA";
        color = "bg-yellow-500";
    } else {
        message = "FUERTE";
        color = "bg-green-500";
    }
    strengthBar.style.width = strength + "%";
    strengthBar.className = `h-full transition-all duration-300 ${color}`;
    strengthText.innerText = message;
    strengthText.className = `text-[10px] font-bold uppercase tracking-widest ${color.replace('bg-', 'text-')}`;
});
document.querySelector('form').addEventListener('submit', function(e) {
    const val = passwordInput.value;
    const regex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{9,}$/;
    if (!regex.test(val)) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Contraseña poco robusta',
            text: 'Tu contraseña debe tener más de 8 caracteres e incluir letras, números y símbolos especiales.',
            confirmButtonColor: '#2563eb'
        });
    }
});
if (status === 'success') {
    Swal.fire({
        icon: 'success',
        title: '¡Registro Exitoso!',
        text: 'Tu cuenta ha sido creada correctamente. ¡Bienvenido a Chambea Ya!',
        confirmButtonColor: '#2563eb',
        confirmButtonText: 'Ir al Dashboard',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'principal.php';
        }
    });
} else if (status === 'error') {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Hubo un problema al procesar tu registro. Intente nuevamente.',
        confirmButtonColor: '#ef4444'
    });
} else if (status === 'exists') {
    Swal.fire({
        icon: 'warning',
        title: 'Atención',
        text: 'Este correo electrónico ya se encuentra registrado.',
        confirmButtonColor: '#f59e0b'
    });
}