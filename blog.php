<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor pagina-blog seccion">
        <h1>Nuestro Blog</h1>
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
        <article class="blog-entrada">
            <picture>
                <source srcset="build/img/full/blog3.webp" type="image/webp">
                <img src="build/img/full/blog3.jpg" alt="casa blog">
            </picture>
            <div class="entrada-contenido">
                <a href="entrada.php">
                    <h4>Iluminación LED para exteriores: Ahorra energía y embellece tu jardín</h4>
                </a>
                <p class="informacion-meta">Escrito el: <span>01/01/2025</span> por: <span>Admin</span></p>
                <p>Descubre cómo elegir las mejores luces LED para exteriores, crear ambientes acogedores y reducir tu consumo eléctrico.</p>
            </div>
        </article>
        <article class="blog-entrada">
            <picture>
                <source srcset="build/img/full/blog4.webp" type="image/webp">
                <img src="build/img/full/blog4.jpg" alt="casa blog">
            </picture>
            <div class="entrada-contenido">
                <a href="entrada.php">
                    <h4>Decoración rústica moderna: Ideas para darle calidez a tu hogar</h4>
                </a>
                <p class="informacion-meta">Escrito el: <span>01/01/2025</span> por: <span>Admin</span></p>
                <p>Conoce los materiales, colores y muebles ideales para lograr un estilo rústico con un toque contemporáneo.</p>
            </div>
        </article>
    </main>

    <?php incluirTemplate('footer'); ?>
