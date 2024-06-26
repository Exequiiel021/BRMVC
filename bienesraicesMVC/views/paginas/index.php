<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <?php include 'iconos.php' ?>

</main>
<!--ANUNCIOS-->
<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>

    <!-- Aca traemos el template del anuncio y lo limitamos a 3 ya que todos los resultados estaran en anuncios, index solo 3-->
    <?php

    include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la Casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>
    <a href="contacto.php" class="boton-amarillo-block">Contactanos</a>
</section>

<!--Testimoniales-->
<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="imagen del blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el: <span>20/10/22</span> por: <span>Admin</span></p>

                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores
                        materiales y ahorrando dinero.
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="imagen del blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Guia para decorar tu hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>20/10/22</span> por: <span>Admin</span></p>

                    <p>Maximiza el espacio de tu hogar con esta guia, aprende a combinar muebles
                        y colores para darle vida a tu espacio.
                    </p>
                </a>
            </div>
        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comporto de una excelente forma, muy buena atencion y la casa que
                me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Exe Godoy</p>
        </div>
    </section>
</div>