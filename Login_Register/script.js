const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const loginForm = document.querySelector('.form-box.login form');
const registerForm = document.querySelector('.form-box.register form');

// Toggle entre formularios
registerLink?.addEventListener('click', () => {
    wrapper.classList.add('active');
});

loginLink?.addEventListener('click', () => {
    wrapper.classList.remove('active');
});

// Manejar registro
registerForm?.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(registerForm);
    
    try {
        const response = await fetch('../Login_Register/register-handler.php', {
            method: 'POST',
            body: formData
        });
    
        // Verificar si la respuesta es JSON válido
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
            // Si no es JSON, manejar como texto
            const text = await response.text();
            console.error('Respuesta no JSON:', text);
            alert('Error en el registro: Respuesta del servidor inválida');
          
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en el registro');

    }
});

// Manejar login
loginForm?.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(loginForm);
    
    try {
        const response = await fetch('../Login_Register/login-handler.php', {
            method: 'POST',
            body: formData
        });
        
        // Verificar si la respuesta es JSON válido
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.indexOf("application/json") !== -1) {
            const result = await response.json();
            if (result.success) {
                localStorage.setItem('user', JSON.stringify(result.user));
                window.location.href = '../Home_Page/index.html'; // Ruta actualizada
            } else {
                alert(result.message || 'Error en el inicio de sesión');
            }
        } else {
            // Si no es JSON, manejar como texto
            const text = await response.text();
            console.error('Respuesta no JSON:', text);
            alert('Error en el inicio de sesión: Respuesta del servidor inválida');
        }
    } catch (error) {
        console.error('Error de conexión:', error);
        alert('Error de conexión al servidor');
    }
});