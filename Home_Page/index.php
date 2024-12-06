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
        require_once '../db-conexion.php';

        // Consulta para obtener los últimos 5 registros 
        $sql = "SELECT id_noticia, text_blog, titulo, categoria, main_image, Fecha_publicacion FROM news ORDER BY id_noticia DESC"; $result = $conn->query($sql); 
        // Variables para almacenar los datos de los últimos 5 registros 
        $blogData = []; 
        if ($result->num_rows > 0) { 
            while ($row = $result->fetch_assoc()) { 
                $blogData[] = [ 
                    'id_noticia' => $row["id_noticia"], 
                    'text_blog' => $row["text_blog"], 
                    'titulo' => $row["titulo"], 
                    'categoria' => $row["categoria"], 
                    'main_image' => $row["main_image"],
                    'Fecha_publicacion' => $row["Fecha_publicacion"]
                ]; 
            } 
        } else { 
            $blogData[] = [ 
                'id_noticia' => '', 
                'text_blog' => 'No hay contenido disponible.', 
                'titulo' => '', 
                'categoria' => '', 
                'main_image' => '',
                'Fecha_publicacion' => '' 
            ]; 
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
                <a href="http://localhost/hic_test/Login_Register" class="nav-btn">Sign In</a>

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
                            <a href="#" class="nav_link-sub">Telesalud</a>
                        </li>
                    </ul>
                    <a href="http://localhost/hic_test/Edit_Page/" class="header-top_btn">Crear Noticia</a>
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

                    <a href="http://localhost/hic_test/Artc_Page?param1=<?php echo htmlspecialchars($blogData[0]['id_noticia']); ?>" class="gallery_item">
                        <div class="img-holder">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($blogData[0]['main_image']); ?>" alt="Imagen de noticia">
                            
                            <div class="gallery_content">
                                <span class="badge secondary"><?php echo htmlspecialchars($blogData[0]['categoria']); ?></span>
                                <h3 class="gallery_title"><?php echo htmlspecialchars($blogData[0]['titulo']); ?>

                                </h3>

                                <ul class="gallery-info">
                                    <li>
                                        <p>
                                            By Dr. Robert Bartolo
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php echo htmlspecialchars($blogData[0]['Fecha_publicacion']); ?>
                                        </p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                    </a>

                    <a href="http://localhost/hic_test/Artc_Page?param1=<?php echo htmlspecialchars($blogData[1]['id_noticia']); ?>" class="gallery_item">
                        <div class="img-holder">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($blogData[1]['main_image']); ?>" alt="Imagen de noticia">

                            <div class="gallery_content">
                                <span class="badge secondary"><?php echo htmlspecialchars($blogData[1]['categoria']); ?></span>
                                <h3 class="gallery_title"><?php echo htmlspecialchars($blogData[1]['titulo']); ?></h3>

                                <ul class="gallery-info">
                                    <li>
                                        <p>
                                            By Dr. Robert Bartolo
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php echo htmlspecialchars($blogData[1]['Fecha_publicacion']); ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </a>

                    <div class="gallery_item g2">

                        <a href="http://localhost/hic_test/Artc_Page?param1=<?php echo htmlspecialchars($blogData[2]['id_noticia']); ?>" class="img-holder">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($blogData[2]['main_image']); ?>" alt="Imagen de noticia">
                            <div class="gallery_content">
                                <span class="badge secondary"><?php echo htmlspecialchars($blogData[2]['categoria']); ?></span> 
                                <h3 class="gallery_title"><?php echo htmlspecialchars($blogData[2]['titulo']); ?></h3>
                                
                                <ul class="gallery-info">
                                    <li>
                                        <p>
                                            By Dra. Ines
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php echo htmlspecialchars($blogData[2]['Fecha_publicacion']); ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </a>

                        <a href="http://localhost/hic_test/Artc_Page?param1=<?php echo htmlspecialchars($blogData[3]['id_noticia']); ?>" class="img-holder">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($blogData[3]['main_image']); ?>" alt="Imagen de noticia">

                            <div class="gallery_content">
                                <span class="badge secondary"><?php echo htmlspecialchars($blogData[3]['categoria']); ?></span>
                                <h3 class="gallery_title"><?php echo htmlspecialchars($blogData[3]['titulo']); ?></h3>
                                <ul class="gallery-info">
                                    <li>
                                        <p>
                                            By Dra. Ines
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php echo htmlspecialchars($blogData[3]['Fecha_publicacion']); ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="highlight">
            <div class="container">
                <h2 class="section_title has-before has-after">Noticias Generales</h2>

                <div class="highlight_container grid">
                    <div class="left_highlights grid">
                        <?php 
                        // Dividir las noticias en dos grupos
                        $halfPoint = ceil(count($blogData));
                        
                        // Primera columna
                        for($i = 4; $i < $halfPoint; $i++): 
                            $noticia = $blogData[$i];
                        ?>
                            <a href="http://localhost/hic_test/Artc_Page?param1=<?php echo htmlspecialchars($noticia['id_noticia']); ?>" class="highlights_item">
                                <div class="img-holder">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($noticia['main_image']); ?>" alt="img-cover">
                                    <span class="badge primary"><?php echo htmlspecialchars($noticia['categoria']); ?></span>
                                </div>

                                <div class="card_content">
                                    <h2 class="card_title"><?php echo htmlspecialchars($noticia['titulo']); ?></h2>

                                    <ul class="card-info">
                                        <li>
                                            <img src="Resources/user-1.jpg" alt="" class="img-cover_user">
                                        </li>
                                        <li>
                                            <p>By Dr. Adain</p>
                                        </li>
                                        <li>
                                            <p><?php echo htmlspecialchars($noticia['Fecha_publicacion']); ?></p>
                                        </li>
                                    </ul>

                                </div>
                            </a>
                        <?php endfor; ?>
                    </div>

                    
                </div>
            </div>
        </section>

        <section class="section newsletter">
            <div class="container">
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