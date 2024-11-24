const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const loginForm = document.querySelector('.form-box.login form');
const registerForm = document.querySelector('.form-box.register form');

// Toggle entre formularios
registerLink.addEventListener('click', () => {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', () => {
    wrapper.classList.remove('active');
});

// Manejar registro
registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(registerForm);
    formData.append('action', 'register');
    
    try {
        const response = await fetch('/backend/api.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Registro exitoso. Por favor inicia sesión.');
            wrapper.classList.remove('active');
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en el registro');
    }
});

// Manejar login
loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(loginForm);
    formData.append('action', 'login');
    
    try {
        const response = await fetch('/backend/api.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Bienvenido ' + result.user.username);
            window.location.href = '/dashboard.html'; // Redirigir al dashboard
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en el inicio de sesión');
    }
});

// Manejar "Forgot password"
const forgotPasswordLink = document.querySelector('.remember-forgot a');
forgotPasswordLink.addEventListener('click', async (e) => {
    e.preventDefault();
    
    const email = prompt('Ingresa tu email para resetear la contraseña:');
    if (!email) return;
    
    try {
        const response = await fetch('/backend/api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'reset-password',
                email: email
            })
        });
        
        const result = await response.json();
        alert(result.message);
    } catch (error) {
        console.error('Error:', error);
        alert('Error al procesar la solicitud');
    }
});
