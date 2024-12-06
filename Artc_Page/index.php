
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Blog Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <!-- Fonts -->
    <link href="https://fonts.cdnfonts.com/css/futura-pt" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Enlace a CSS-->
    <link rel="stylesheet" href="blog.rtl.css">
    <link rel="stylesheet" href="blog.css">
    <link rel="stylesheet" href="style.css">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
  </head>

  <body>
    <?php
    // Configuración de conexión a la base de datos
    $host = "localhost";
    $user = "root"; // Usuario por defecto de XAMPP
    $password = ""; // Contraseña por defecto de XAMPP (vacía)
    $database = "prueba_hic"; // Cambiar al nombre de tu base de datos

    // Crear conexión
    $conn = new mysqli($host, $user, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener el último registro
    $sql = "SELECT text_blog, titulo, categoria, main_image FROM news ORDER BY id_noticia DESC LIMIT 1";
    $result = $conn->query($sql);

    // Variables para almacenar los datos del último registro
    $blogContent = "";
    $blogTitle = "";
    $blogCategory = "";
    $blogMainImage = "";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $blogContent = $row["text_blog"];
        $blogTitle = $row["titulo"];
        $blogCategory = $row["categoria"];
        $blogMainImage = $row["main_image"];
    } else {
        $blogContent = "No hay contenido disponible.";
    }

    // Cerrar conexión
    $conn->close();
  ?>

    <header class="header">
        <nav class="header-navbar"> 
            <button class="nav-menu_toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>

            <a href="#" class="logo">
                <img src="Resources/LogoHIC.png">
            </a>

            <div class="nav_menu">
                <button class="nav-menu_close">
                    <i class='bx bx-x'></i>
                </button>

                <ul class="nav_list">
                    <li>
                        <a href="#" class="nav_link">Inicio</a>
                    </li>
                    <li>
                        <a href="#" class="nav_link">Agendar Cita</a>
                    </li>
                    <li>
                        <a href="#" class="nav_link">Cirugia Ambulatoria</a>
                    </li>
                    <li>
                        <a href="#" class="nav_link">Especialidades Pediatricas</a>
                    </li>
                    <li>
                        <a href="#" class="nav_link">CIAPPI</a>
                    </li>
                    <li>
                        <a href="#" class="nav_link">Telesalud</a>
                    </li>
                    <li>
                        <a href="#" class="nav_link">Noticias</a>
                    </li>
                    <li>
                        <a href="#" class="nav_link">Contacto</a>
                    </li>
                </ul>
            </div>

            <div class="right-content">
                <a href="#" class="nav-btn">Sign In</a>

            </div>

            <!-- <div class="header_actions">
                 <button class="search_bar">
                    <i class='bx bx-search'></i>
                </button> 

                 <button class="right_header-toggle">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button> 
            </div> -->
        </nav>
    </header>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>

    
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="aperture" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
    <circle cx="12" cy="12" r="10"/>
    <path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/>
  </symbol>
  <symbol id="cart" viewBox="0 0 16 16">
    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
  <symbol id="chevron-right" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
  </symbol>
</svg>

<main class="container">
  <hr>
  <div class="row g-5">
    <div class="col-md-8">
      <article class="blog-post">
      <div class="container">

        <?php if ($blogContent !== "No hay contenido disponible."): ?>
            <div class="news-item">
                <h2><?php echo htmlspecialchars($blogTitle); ?></h2>
                <p><strong>Categoría:</strong> <?php echo htmlspecialchars($blogCategory); ?></p>
                <div class="image-container">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($blogMainImage); ?>" alt="Imagen de noticia">
                </div>
                <br>
                <br>
                <div class="news-content">
                    <?php echo $blogContent; ?>
                </div>
            </div>
        <?php else: ?>
            <p><?php echo $blogContent; ?></p>
        <?php endif; ?>
    </div>
      </article>
    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          <h4 class="fst-italic">Sobre el...</h4>
          <p class="mb-0">Hospital Infantil de las Californias brinda desde 1994 servicios de salud a niños, niñas y adolescentes desde recién nacidos hasta cumplir 18 años de edad, sin importar su nivel socioeconómico, raza o religión. Cuenta con más de 20 especialidades pediátricas, cirugías de corta estancia, farmacia, rehabilitación y terapia física, Centro Integral de Psicología y Psicopedagogía Infantil, Clínica de Odontología Infantil, así como programas educativos enfocados en la nutrición y prevención.</p>
        </div>

        <div>
          <h4 class="fst-italic">Articulos Recientes</h4>
          <ul class="list-unstyled">
            <li>
              <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
                <div class="col-lg-8">
                  <h6 class="mb-0">Example blog post title</h6>
                  <small class="text-body-secondary">January 15, 2024</small>
                </div>
              </a>
            </li>
            <li>
              <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
                <div class="col-lg-8">
                  <h6 class="mb-0">This is another blog post title</h6>
                  <small class="text-body-secondary">January 14, 2024</small>
                </div>
              </a>
            </li>
            <li>
              <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
                <div class="col-lg-8">
                  <h6 class="mb-0">Longer blog post title: This one has multiple lines!</h6>
                  <small class="text-body-secondary">January 13, 2024</small>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</main>

<footer class="section footer">
    <div class="container">
        <div class="footer_container grid">
            <div class="footer_box">
                <div class="footer_logo footer_title">
                    <a href="#">
                        <img src="Resources/LogoHIC.png" alt="">
                    </a>
                </div>

                <p class="footer_text">
                    Llama a 973 7756 y 973 7757 <br>ext. 404 y 417
                    <br>Avenida Alejandro von Humboldt 11431 <br> Garita de Otay, 22430 Tijuana, Baja California
                </p>
            </div>

            <div class="footer_box">
                <div class="footer_title">
                    <h3>Important Link</h3>
                </div>

                <ul class="footer_link">
                    <li>
                        <a href="#">News</a>
                    </li>
                    <li>
                        <a href="#">Career</a>
                    </li>
                    <li>
                        <a href="#">Technology</a>
                    </li>
                    <li>
                        <a href="#">Startup</a>
                    </li>
                    <li>
                        <a href="#">Gadget</a>
                    </li>
                </ul>
            </div>

            <div class="footer_box">
                <div class="footer_title">
                    <h3>Browse by Tag</h3>
                </div>

                <ul class="tag_list">
                    <li>
                        <a href="#">Oficial</a>
                    </li>
                    <li>
                        <a href="#">Pediatria</a>
                    </li>
                    <li>
                        <a href="#">Nutricion</a>
                    </li>
                    <li>
                        <a href="#">Terapia Fisica</a>
                    </li>
                    <li>
                        <a href="#">Psicología</a>
                    </li>
                    <li>
                        <a href="#">Cardiología</a>
                    </li>
                    <li>
                        <a href="#">Odontopediatría</a>
                    </li>
                    <li>
                        <a href="#">Urología</a>
                    </li>
                </ul>
            </div>

            <div class="footer_box">
                <div class=" footer_title">
                    <h3>
                        Social Media
                    </h3>
                </div>
                
                <ul class="social_list grid">
                    <li>
                        <a href="https://www.facebook.com/hicoficial/">
                            <i class='bx bxl-facebook' ></i>
                            <span class="span">Facebook</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/hicoficial/">
                            <i class='bx bxl-instagram' ></i>
                            <span class="span">Instagram</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/user/HICoficial">
                            <i class='bx bxl-youtube' ></i>
                            <span class="span">YouTube</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://x.com/hicoficial">
                            <i class='bx bxl-twitter' ></i>
                            <span class="span">Twitter</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <p>
                Copyright &copy; 2024 Hospital Infantil de las Californias. all Rights Reseved.
            </p>
        </div>
    </div>
</footer>

<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Enlace a javaScript-->
    <script src="script.js"></script>
    </body>
    
</html>
