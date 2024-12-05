async function checkAuth() {
    try {
        const response = await fetch('../check_session.php');
        const data = await response.json();
        
        if (!data.authenticated) {
            window.location.href = data.redirect;
            return false;
        }
        
        // Actualizar elementos de la UI si es necesario
        updateUIWithUserInfo(data.user);
        return true;
    } catch (error) {
        console.error('Error checking authentication:', error);
        window.location.href = '../Login_Register/index.html';
        return false;
    }
}

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
