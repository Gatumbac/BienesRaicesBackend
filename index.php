<?php
    require 'includes/app.php';
    $inicio = true;
    incluirTemplate('header', $inicio);
?>

    <main class="contenedor nosotros">
        <h1>Más sobre nosotros</h1>
        <div class="contenido-nosotros">
            <div class="seccion-nosotros">
                <img src="src/img/full/icono1.svg" alt="icono nosotros">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et voluptatem unde sit ut at fuga dolores nulla aperiam laborum, corporis sed. Quia reiciendis repellat voluptatibus magnam quae asperiores provident rem?</p>
            </div>
            <div class="seccion-nosotros">
                <img src="src/img/full/icono2.svg" alt="icono nosotros">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et voluptatem unde sit ut at fuga dolores nulla aperiam laborum, corporis sed. Quia reiciendis repellat voluptatibus magnam quae asperiores provident rem?</p>
            </div>
            <div class="seccion-nosotros">
                <img src="src/img/full/icono3.svg" alt="icono nosotros">
                <h3>A tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et voluptatem unde sit ut at fuga dolores nulla aperiam laborum, corporis sed. Quia reiciendis repellat voluptatibus magnam quae asperiores provident rem?</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h2>Casas y Departamentos en Venta</h2>
        <?php
        incluirTemplate('anuncios', $inicio);
        ?>
        <div class="anuncios-verMas">
            <a class="boton-verde" href="anuncios.php">Ver Todas</a>
        </div>
    </section>

    <div class="contacto seccion">
        <section class="contenedor contacto-contenido">
            <h2>Encuentra la casa de tus sueños</h2>
            <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
            <a class="boton-contacto" href="contacto.php">Contáctanos</a>
        </section>
    </div>
    
    <div class="contenedor seccion blog-testimoniales">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="blog-entrada">
                <picture>
                    <source srcset="build/img/full/blog1.webp" type="image/webp">
                    <img src="build/img/full/blog1.jpg" alt="casa blog">
                </picture>
                <div class="entrada-contenido">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                    </a>
                    <p class="informacion-meta">Escrito el: <span>01/01/2025</span> por: <span>Admin</span></p>
                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.</p>
                </div>
            </article>
            <article class="blog-entrada">
                <picture>
                    <source srcset="build/img/full/blog2.webp" type="image/webp">
                    <img src="build/img/full/blog2.jpg" alt="casa blog">
                </picture>
                <div class="entrada-contenido">
                    <a href="entrada.php">
                        <h4>Guía para la decoración de tu hogar</h4>
                    </a>
                    <p class="informacion-meta">Escrito el: <span>01/01/2025</span> por: <span>Admin</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio.</p>
                </div>
            </article>

        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonio">
                <div class="testimonio-contenido">
                    <img src="src/img/full/comilla.svg" alt="comilla">
                    <p>El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.</p>
                </div>
                <p class="autor">- Gabriel Tumbaco</p>    
            </div>
        </section>
    </div>
    
    <?php incluirTemplate('footer'); ?>
