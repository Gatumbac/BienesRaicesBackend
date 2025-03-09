<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor pagina-nosotros">
        <h1>Conoce sobre Nosotros</h1>
        <div class="conoce-nosotros">
            <picture>
                <source srcset="build/img/full/nosotros.webp" type="image/webp">
                <img src="build/img/full/nosotros.jpg" alt="imagen nosotros">
            </picture>
            <div class="conoce-contenido">
                <p><span>25 Años de experiencia</span></p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta aliquam, nam neque nisi, assumenda in quae, quo tenetur quidem sunt recusandae debitis obcaecati ratione nulla consequatur rem culpa? Nobis, et.</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet, quam voluptatem beatae molestiae facilis illum autem laboriosam exercitationem earum maxime commodi nesciunt non et aut natus. Reiciendis tempora maiores animi.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum repellendus et ullam corrupti mollitia ea sequi odio, omnis voluptatem quibusdam ab! Debitis incidunt hic adipisci quia? In eos quaerat vitae.</p>
            </div>
        </div>
    </main>

    <section class="contenedor nosotros seccion">
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
    </section>
    
    <?php incluirTemplate('footer'); ?>
