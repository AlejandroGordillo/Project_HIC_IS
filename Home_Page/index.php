<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home_Page_HIC</title>
    
    <!-- Swiper -->
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <!-- Fonts -->
    <link href="https://fonts.cdnfonts.com/css/futura-pt" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Enlace a CSS-->
    <link rel="stylesheet" href="style.css">
</head>

<body id="top">
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
                <a href="http://localhost/hic_local_host/Login_Register" class="nav-btn">Sign In</a>

            </div>

        </nav>
        
        <div class="container">

            <div class="header-top">
                <div class="header-top_contact">
                    <ul class="nav_list">
                        <li>
                            <a href="#" class="nav_link-sub">Logros y reconocimientos</a>
                        </li>
                        <li>
                            <a href="#" class="nav_link-sub">Voluntariado</a>
                        </li>
                        <li>
                            <a href="#" class="nav_link-sub">Preguntas Frecuentes</a>
                        </li>
                        <li>
                            <a href="#" class="nav_link-sub">Notas de salud y consejos para papas</a>
                        </li>
                        <li>
                            <a href="#" class="nav_link-sub">Bolsa de trabajo</a>
                        </li>
                        <li>
                            <a href="http://localhost/hic_test/Edit_Page/" class="nav_link-sub">Editar</a>
                        </li>
                    </ul>
                    <button class="header-top_btn">Donar</Button>
                </div>

                    <!-- <ul class="header-top_social">
                        <li>
                            <i class='bx bxl-facebook'></i>
                        </li>
                        <li>
                            <i class='bx bxl-instagram' ></i>
                        </li>
                        <li>
                            <i class='bx bxl-youtube'></i>
                        </li>
                        <li>
                            <i class='bx bxl-twitter'></i>
                        </li>
                    </ul> -->
            </div>

        </div>
    </header>

    <main>
        <section class="home">
            <div class="container">
                <div class="gallery grid">

                    <a href="http://localhost/hic_test/Artc_Page/" class="gallery_item">
                        <div class="img-holder">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($blogMainImage); ?>" alt="Imagen de noticia">

                            <div class="gallery_content">
                                <span class="badge secondary"><?php echo htmlspecialchars($blogCategory); ?></span>
                                <h3 class="gallery_title"><?php echo htmlspecialchars($blogTitle); ?>

                                </h3>
                                <!-- <p class="gallery_text">
                                    Con gran dolor les comunicamos la triste noticia del fallecimiento de nuestra querida Dra. Betty Jones, Presidenta Honoraria y Co Fundadora de la Fundación para los Niños de las Californias.
                                </p> -->

                                <!-- <ul class="gallery-info">
                                    <li>
                                        <img src="Resources/user-1.jpg"  alt="" class="img-cover_user">
                                    </li>
                                    <li>
                                        <p>
                                            By Dr. Robert Bartolo
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            20 Nov 2023
                                        </p>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                    </a>

                    <div class="gallery_item">
                        <div class="img-holder">
                            <img src="Resources/post-5.jpg" alt="" class="img-cover">

                            <div class="gallery_content">
                                <span class="badge secondary">Oficial</span>
                                <h3 class="gallery_title">Taylor Guitars entrega donativo de 2 mil cubrebocas</h3>

                                <ul class="gallery-info">
                                    <li>
                                        <p>
                                            By Dr. Robert Bartolo
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            20 Nov 2023
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="gallery_item g2">

                        <div class="img-holder">
                            <img src="Resources/post-21.jpg" alt="" class="img-cover">
                            <div class="gallery_content">
                                <span class="badge secondary">Oficial</span> 
                                <h3 class="gallery_title">Anuncian Expo Peques</h3>
                                
                                <ul class="gallery-info">
                                    <li>
                                        <p>
                                            By Dra. Ines
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            20 Nov 2023
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="img-holder">
                            <img src="Resources/post-7.jpg" alt="" class="img-cover">

                            <div class="gallery_content">
                                <span class="badge secondary">Oficial</span>
                                <h3 class="gallery_title">Visita de REACH y Baja Health Cluster</h3>
                                <ul class="gallery-info">
                                    <li>
                                        <p>
                                            By Dra. Ines
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            20 Nov 2023
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section class="section breaking">
            <div class="container">

                <div class="b-title">
                    <span class="breaking_title">Breaking News</span>
                </div>

                <div class="breaking_container swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide breaking_box">
                            <div class="img-banner">
                                <img src="Resources/post-9.jpg" alt="">
                            </div>

                            <div class="breaking_content">
                                <span class="date">22 Sep 2022</span>
                                <h2 class="breaking_content-title">Healthy runtime for your healthy lifestyle.</h2>
                            </div>
                        </div>

                        <div class="swiper-slide breaking_box">
                            <div class="img-banner">
                                <img src="Resources/post-8.jpg" alt="">
                            </div>

                            <div class="breaking_content">
                                <span class="date">22 Sep 2022</span>
                                <h2 class="breaking_content-title">Best tourism site all over the world.</h2>
                            </div>
                        </div>

                        <div class="swiper-slide breaking_box">
                            <div class="img-banner">
                                <img src="Resources/post-7.jpg" alt="">
                            </div>

                            <div class="breaking_content">
                                <span class="date">22 Sep 2022</span>
                                <h2 class="breaking_content-title">5 Unbelievable secret about choosing right furniture.</h2>
                            </div>
                        </div>

                        <div class="swiper-slide breaking_box">
                            <div class="img-banner">
                                <img src="Resources/post-9.jpg" alt="">
                            </div>

                            <div class="breaking_content">
                                <span class="date">22 Sep 2022</span>
                                <h2 class="breaking_content-title">Healthy runtime for your healthy lifestyle.</h2>
                            </div>
                        </div>

                        <div class="swiper-slide breaking_box">
                            <div class="img-banner">
                                <img src="Resources/post-8.jpg" alt="">
                            </div>

                            <div class="breaking_content">
                                <span class="date">22 Sep 2022</span>
                                <h2 class="breaking_content-title">Best tourism site all over the world.</h2>
                            </div>
                        </div>

                        <div class="swiper-slide breaking_box">
                            <div class="img-banner">
                                <img src="Resources/post-7.jpg" alt="">
                            </div>

                            <div class="breaking_content">
                                <span class="date">22 Sep 2022</span>
                                <h2 class="breaking_content-title">5 Unbelievable secret about choosing right furniture.</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <section class="highlight">
            <div class="container">
                <h2 class="section_title has-before has-after">Noticias Generales</h2>

                <div class="highlight_container grid">
                    <div class="left_highlights grid">

                        <div class="highlights_item">
                            <div class="img-holder">
                                <img src="Resources/post-10.jpg" alt="" class="img-cover">

                                <span class="badge primary">Pediatría</span>
                            </div>

                            <div class="card_content">
                                <h2 class="card_title">Alimentacion en la diabetes</h2>

                                <ul class="card-info">
                                    <li>
                                        <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                    </li>
                                    <li>
                                        <p>
                                            By Dr. Adain
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            25 Sep 2023
                                        </p>
                                    </li>
                                </ul>

                                <p class="card_text">
                                    Departamento de Nutrición del Hospital Infantil de las Californias. En caso de presentar síntomas de diabetes o tener factores de riesgo es necesario realizar estudios como: Glucosa plasmática en ayunas. 
                                </p>
                            </div>
                        </div>

                        <div class="highlights_item">
                            <div class="img-holder">
                                <img src="Resources/post-11.jpg" alt="">

                                <span class="badge primary">Nutricion</span>
                            </div>

                            <div class="card_content">
                                <h2 class="card_title">Consejos nutricionales para florecer esta primavera</h2>

                                <ul class="card-info">
                                    <li>
                                        <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                    </li>
                                    <li>
                                        <p>
                                            By Dr. Adain
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            25 Sep 2023
                                        </p>
                                    </li>
                                </ul>

                                <p class="card_text">
                                    Incluye alimentos reales y naturales: Nos referimos a alimentos reales cuando hablamos de ingredientes naturales, principalmente frutas y verduras, legumbres, carnes magras, frutos secos, semillas y cereales lo más enteras posible.
                                </p>
                            </div>
                        </div>

                        <div class="highlights_item">
                            <div class="img-holder">
                                <img src="Resources/post-12.jpg" alt="">

                                <span class="badge primary">Terapia Fisica</span>
                            </div>

                            <div class="card_content">
                                <h2 class="card_title">Retraso Psicomotor</h2>

                                <ul class="card-info">
                                    <li>
                                        <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                    </li>
                                    <li>
                                        <p>
                                            By Dr. Adain
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            25 Sep 2023
                                        </p>
                                    </li>
                                </ul>

                                <p class="card_text">
                                    El retraso psicomotor implica un retardo en el desarrollo de las destrezas cognitivas y motoras del bebe, los hitos del desarrollo que requieren durante determinada edad no aparecen o lo están haciendo de forma anómala.
                                </p>
                            </div>
                        </div>

                        <div class="highlights_item">
                            <div class="img-holder">
                                <img src="Resources/post-13.jpg" alt="">

                                <span class="badge primary">Oficial</span>
                            </div>

                            <div class="card_content">
                                <h2 class="card_title">Firma de convenio con Fronteras Unidas Pro Salud</h2>

                                <ul class="card-info">
                                    <li>
                                        <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                    </li>
                                    <li>
                                        <p>
                                            By Dr. Adain
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            25 Sep 2023
                                        </p>
                                    </li>
                                </ul>

                                <p class="card_text">
                                    El Hospital Infantil de las Californias (HIC) y Fronteras Unidas Pro Salud A.C. firmaron la renovación del Convenio de Colaboración que tienen desde hace más de 20 años al apoyarse mutuamente cuando ambas organizaciones iniciaron con su labor. 
                                </p>
                            </div>
                        </div>

                        <div class="highlights_item">
                            <div class="img-holder">
                                <img src="Resources/post-14.jpg" alt="" class="img-cover">

                                <span class="badge primary">Oficial</span>
                            </div>

                            <div class="card_content">
                                <h2 class="card_title">Feria de salud “Prevenir es Vivir”.</h2>

                                <ul class="card-info">
                                    <li>
                                        <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                    </li>
                                    <li>
                                        <p>
                                            By Dr. Adain
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            25 Sep 2023
                                        </p>
                                    </li>
                                </ul>

                                <p class="card_text">
                                    Nuestra Institución fue invitada a participar en la 5ta. feria de la salud “Prevenir es Vivir” que organiza Tijuana Agradecida A.C., organismo conformado por empresarios que impulsan el fortalecimiento de la seguridad pública en la ciudad.
                                </p>
                            </div>
                        </div>

                        <div class="highlights_item">
                            <div class="img-holder">
                                <img src="Resources/post-15.jpg" alt="">

                                <span class="badge primary">Nutricion</span>
                            </div>

                            <div class="card_content">
                                <h2 class="card_title">Jornada de Nutrición</h2>

                                <ul class="card-info">
                                    <li>
                                        <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                    </li>
                                    <li>
                                        <p>
                                            By  Dr. Adain
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            25 Sep 2023
                                        </p>
                                    </li>
                                </ul>

                                <p class="card_text">
                                    Se llevó a cabo la 6ta edición de la Jornada de Nutrición Pediátrica: “Panorama Global de Alergias e Intolerancias Alimentarias” el 07 de junio de 2019.
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="right_highlights grid">
                        <div class="trending">
                            <h3 class="section_subtitle has-before has-after">Filtro</h3>
                            <div class="trending_list grid">
    
                                <div class="trending_item">
                                    <div class="trending_wrapper">
                                        <i class='bx bx-chevron-right'></i>
        
                                        <span class="trending_name">Oficial</span>
                                    </div>
        
                                    <span class="trending_count">(05)</span>
                                </div>
        
                                <div class="trending_item">
                                    <div class="trending_wrapper">
                                        <i class='bx bx-chevron-right'></i>
        
                                        <span class="trending_name">Pediatria</span>
                                    </div>
        
                                    <span class="trending_count">(07)</span>
                                </div>
        
                                <div class="trending_item">
                                    <div class="trending_wrapper">
                                        <i class='bx bx-chevron-right'></i>
        
                                        <span class="trending_name">Nutricion</span>
                                    </div>
        
                                    <span class="trending_count">(03)</span>
                                </div>
        
                                <div class="trending_item">
                                    <div class="trending_wrapper">
                                        <i class='bx bx-chevron-right'></i>
        
                                        <span class="trending_name">Oftalmologia</span>
                                    </div>
        
                                    <span class="trending_count">(06)</span>
                                </div>
        
                                <div class="trending_item">
                                    <div class="trending_wrapper">
                                        <i class='bx bx-chevron-right'></i>
        
                                        <span class="trending_name">Dermatologia</span>
                                    </div>
        
                                    <span class="trending_count">(12)</span>
                                </div>
        
                                <div class="trending_item">
                                    <div class="trending_wrapper">
                                        <i class='bx bx-chevron-right'></i>
        
                                        <span class="trending_name">Neumologia</span>
                                    </div>
        
                                    <span class="trending_count">(08)</span>
                                </div>
        
                            </div>
                        </div>

                        <!-- <div class="popular_post">
                            <h3 class="section_subtitle has-before has-after">Popular Post</h3>

                            <div class="popular_post-list grid">

                                <div class="popular_post-item">
                                    <div class="popular-banner">
                                        <img src="Resources/post-20.jpg" alt="">
                                    </div>

                                    <div class="popular-content">
                                        <span class="date">19 Jun 2022</span>

                                        <h3 class="popular-title">Perfect Photo Clicking Idea You Must Know.</h3>
                                    </div>
                                </div>

                                <div class="popular_post-item">
                                    <div class="popular-banner">
                                        <img src="Resources/post-19.jpg" alt="">
                                    </div>

                                    <div class="popular-content">
                                        <span class="date">19 Jun 2022</span>

                                        <h3 class="popular-title">Perfect Photo Clicking Idea You Must Know.</h3>
                                    </div>
                                </div>

                                <div class="popular_post-item">
                                    <div class="popular-banner">
                                        <img src="Resources/post-18.jpg" alt="">
                                    </div>

                                    <div class="popular-content">
                                        <span class="date">19 Jun 2022</span>

                                        <h3 class="popular-title">Perfect Photo Clicking Idea You Must Know.</h3>
                                    </div>
                                </div>

                                <div class="popular_post-item">
                                    <div class="popular-banner">
                                        <img src="Resources/post-17.jpg" alt="">
                                    </div>

                                    <div class="popular-content">
                                        <span class="date">19 Jun 2022</span>

                                        <h3 class="popular-title">Perfect Photo Clicking Idea You Must Know.</h3>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="brand">
                            <img src="Resources/post-21.png" alt="" >
                        </div> -->
                    </div>

                    <div class="box">
                        <button type="button" class="prev"><a href="#">Prev</a></button>

                        <ul class="ul">
                            <!-- <li><a href="#" class="page_number">1</a></li>
                            <li><a href="#" class="page_number">2</a></li>
                            <li><a href="#" class="page_number">3</a></li>
                            <li><a href="#" class="page_number">4</a></li>
                            <li><a href="#" class="page_number">5</a></li> -->
                        </ul>

                        <button type="button" class="next"><a href="#">Next</a></button>
                    </div>
                </div>

            </div>
        </section>

        <!-- <section class="section sponsor">
            <div class="container">
                <h2 class="section_title has-before has-after">Sponsored News</h2>

                <ul class="sponsor_list grid">

                    <li class="sponsor_item">
                        <div class="img-holder">
                            <img src="Resources/post-11.jpg" alt="" class="img-banner">

                            <span class="badge primary">Travel</span>
                        </div>

                        <div class="card_content">
                            <h2 class="card_title">Top Most Beautiful Scenery in The World</h2>

                            <ul class="card-info">
                                <li>
                                    <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                </li>
                                
                                <li>
                                    <p>
                                        By Admin
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        26 Sep 2022
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="sponsor_item">
                        <div class="img-holder">
                            <img src="Resources/post-10.jpg" alt="">

                            <span class="badge primary">Travel</span>
                        </div>

                        <div class="card_content">
                            <h2 class="card_title">Top Most Beautiful Scenery in The World</h2>

                            <ul class="card-info">
                                <li>
                                    <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                </li>
                                
                                <li>
                                    <p>
                                        By Admin
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        26 Sep 2022
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="sponsor_item">
                        <div class="img-holder">
                            <img src="Resources/post-8.jpg" alt="">

                            <span class="badge primary">Travel</span>
                        </div>

                        <div class="card_content">
                            <h2 class="card_title">Top Most Beautiful Scenery in The World</h2>

                            <ul class="card-info">
                                <li>
                                    <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                </li>
                                
                                <li>
                                    <p>
                                        By Admin
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        26 Sep 2022
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="sponsor_item">
                        <div class="img-holder">
                            <img src="Resources/post-9.jpg" alt="">

                            <span class="badge primary">Travel</span>
                        </div>

                        <div class="card_content">
                            <h2 class="card_title">Top Most Beautiful Scenery in The World</h2>

                            <ul class="card-info">
                                <li>
                                    <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                </li>
                                
                                <li>
                                    <p>
                                        By Admin
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        26 Sep 2022
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </section> -->

        <section class="section newsletter">
            <div class="container">
                <!-- <div class="news_content">
                    <h2 class="news_title">Never miss any Update</h2>
                    <p class="news_text">
                        Get the freshest headlines and updates sent uninterrupted to your inbox.
                    </p>

                    <form action="" class="news_form">
                        <input type="email" placeholder="Enter your email" class="new_field">
                        <a href="#" class="form_btn">
                            <span class="span">Subscribe</span>
                            <i class='bx bx-user' ></i>
                        </a>
                    </form>
                </div> -->
            </div>
        </section>
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

    <a href="#top" class="back-top-btn">
        <i class='bx bx-up-arrow-alt' ></i>
    </a>

    <!-- Enlace a swiperJs-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Enlace a javaScript-->
    <script src="script.js"></script>
</body>
</html>