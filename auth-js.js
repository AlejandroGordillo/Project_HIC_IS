async function checkAuth() {
    try {
        const response = await fetch('../check-session.php');
        const data = await response.json();
        
        if (!data.isLoggedIn) {
            window.location.href = '../Login_Register/index.html';  // Solo redirige al login
            return false;
        }
        return true;
    } catch (error) {
        console.error('Error:', error);
        window.location.href = '../Login_Register/index.html';
        return false;
    }
}

// Solo verifica auth
document.addEventListener('DOMContentLoaded', checkAuth);

function updateUIWithUserInfo(user) {
    // Actualizar elementos de la UI con la información del usuario
    const userNameElements = document.querySelectorAll('.user-name');
    const userEmailElements = document.querySelectorAll('.user-email');
    
    userNameElements.forEach(element => {
        element.textContent = user.username;
    });
    
    userEmailElements.forEach(element => {
        element.textContent = user.email;
    });
}

// Verificar autenticación al cargar la página
document.addEventListener('DOMContentLoaded', checkAuth);
