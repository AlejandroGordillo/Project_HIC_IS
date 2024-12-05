const navToggle = document.querySelector(".nav-menu_toggle"),
      navMenu = document.querySelector(".nav_menu"),
      navClose = document.querySelector(".nav-menu_close");

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const response = await fetch('../check-session.php');
        const data = await response.json();
        const signInBtn = document.querySelector('.nav-btn');
        
        if (data.isLoggedIn) {
            signInBtn.textContent = `${data.user.username}`;
            signInBtn.href = '#';
            
            signInBtn.addEventListener('click', async (e) => {
                e.preventDefault();
                if (confirm('¿Desea cerrar sesión?')) {
                    await fetch('../logout.php');
                    window.location.href = '../Login_Register/index.html?logout=true';
                }
            });
        }
    } catch (error) {
        console.error('Error checking session:', error);
    }
});

if (navToggle) {
    navToggle.addEventListener("click", () => {
        navMenu.classList.add("show-menu")
    })
}

if (navClose) {
    navClose.addEventListener("click", () => {
        navMenu.classList.remove("show-menu")
    })
}

let ul = document.querySelector(".ul");
let prev = document.querySelector(".prev");
let next = document.querySelector(".next");
let current_page = 1;
let total_page = 10;
let active_page = "";

create_pages(current_page);

function create_pages(current_page) {
    ul.innerHTML = "";
    let before_page = current_page - 1;
    let after_page = current_page + 1;   

    if(current_page == 1) {
        after_page = Math.min(total_page, current_page + 2);
    }
    
    if(current_page == total_page) {
        before_page = Math.max(1, current_page - 2);
    }

    for (let i = Math.max(1, before_page); i <= Math.min(total_page, after_page); i++) {
        if (current_page == i) {
            active_page = "active_page";
        } else {
            active_page = "";
        }
        ul.innerHTML += '<li onclick="create_pages('+ i +')"><a href="#" class="page_number '+ active_page +'">'+ i +'</a></li>';
    }

    prev.onclick = function () {
        if (current_page > 1) {
            current_page--;
            create_pages(current_page);
        }
    }
    
    prev.style.display = current_page <= 1 ? "none" : "block";

    next.onclick = function () {
        if (current_page < total_page) {
            current_page++;
            create_pages(current_page);
        }
    }
    
    next.style.display = current_page >= total_page ? "none" : "block";
}

const backTopbtn = document.querySelector(".back-top-btn");

const showElemOnScroll = function() {
    if (window.scrollY > 150) {
        backTopbtn.classList.add("active");
    } else {
        backTopbtn.classList.remove("active");
    }
}

window.addEventListener("scroll", showElemOnScroll);