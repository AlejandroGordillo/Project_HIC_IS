const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const loginForm = document.querySelector('.form-box.login form');
const registerForm = document.querySelector('.form-box.register form');

document.addEventListener('DOMContentLoaded', async () => {
    if (window.location.search.includes('logout=true')) {
        return;
    }

    try {
        const response = await fetch('../check-session.php');
        const data = await response.json();
        
        if (data.isLoggedIn) {
            window.location.href = '../Home_Page/index.html';
        }
    } catch (error) {
        console.error('Error checking session:', error);
    }
});

registerLink?.addEventListener('click', () => {
    wrapper.classList.add('active');
});

loginLink?.addEventListener('click', () => {
    wrapper.classList.remove('active');
});

registerForm?.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(registerForm);
    
    try {
        const response = await fetch('../Login_Register/register-handler.php', {
            method: 'POST',
            body: formData
        });
    
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.indexOf("application/json") !== -1) {
            const result = await response.json();
            
            if (result.success) {
                alert('Registro exitoso. Por favor inicia sesión.');
                wrapper.classList.remove('active');
            } else {
                alert(result.message || 'Error en el registro');
            }
        } else {
            const text = await response.text();
            console.error('Respuesta no JSON:', text);
            alert('Error en el registro: Respuesta del servidor inválida');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en el registro');
    }
});

loginForm?.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(loginForm);
    
    try {
        const response = await fetch('login-handler.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        if (result.success) {
            localStorage.setItem('user', JSON.stringify(result.user));
            window.location.href = '../Home_Page/index.html';
        } else {
            alert(result.message || 'Error en el inicio de sesión');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error de conexión al servidor');
    }
});