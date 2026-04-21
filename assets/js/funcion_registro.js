const passwordInput = document.getElementById('registro_password');
const strengthBar = document.getElementById('strength_bar');
const strengthText = document.getElementById('strength_text');

if (passwordInput) {
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
}

const form = document.querySelector('form');
if (form) {
    form.addEventListener('submit', function(e) {
        if (!passwordInput) return;
        
        const val = passwordInput.value;
        const regex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{9,}$/;
        
        if (!regex.test(val)) {
            e.preventDefault();
            window.Notifications.warning(
                'Contraseña poco robusta',
                'Tu contraseña debe tener más de 8 caracteres e incluir letras, números y símbolos especiales.'
            );
        }
    });
}