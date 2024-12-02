document.addEventListener("DOMContentLoaded", function (event) {
    document.getElementById('registro').addEventListener('submit', validar)
});

function validar(e) {
    e.preventDefault();
    const errorMessage = document.getElementById('error-message');

    const email = document.querySelector('.email');
    const user_name = document.querySelector('.user_name');
    const password = document.querySelector('.password');

    if (!EmailValidator.isValidEmail(email.value)) {
        errorMessage.textContent = 'El correo no es válido';
        return;
    }else if (!(password.value.length >= 8 && password.value.length <= 16 && /[A-Z]/.test(password.value) && /[!@#$%^&*]/.test(password.value))) {
        errorMessage.textContent = 'La contraseña debe tener entre 8 y 16 caracteres, al menos una letra mayúscula y un carácter especial(!@#$%^&*)';
        return;
    }

    this.submit()
}

class EmailValidator {

    static isValidEmail(email) {
        if (!email || email.trim() === '') {
            return false;
        }

        try {
            const normalizedEmail = email.replace(/(@)(.+)$/, (_, at, domain) => {
                const normalizedDomain = EmailValidator.normalizeDomain(domain);
                return `${at}${normalizedDomain}`;
            });

            return EmailValidator.basicEmailValidation(normalizedEmail);
        } catch (error) {
            return false;
        }
    }

    static normalizeDomain(domain) {
        try {
            return domain
                ? new URL(`http://${domain}`).hostname
                : '';
        } catch {
            throw new Error('Invalid domain');
        }
    }

    static basicEmailValidation(email) {
        const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
        return emailRegex.test(email);
    }
}
