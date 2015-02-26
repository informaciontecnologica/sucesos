<!DOCTYPE html>
<?php
require_once('Connections/localhost.php');
require_once('funciones/Top.php');
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Sistema de Sucesos Urbanos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="script/funciones.js" type="text/javascript"></script>
        <script src="https://apis.google.com/js/platform.js" async defer>
            {
                lang: 'es'
            }
        </script>
    </head>

    <body>
<div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <header> 
            <div  id="logo"><img src="imagenes/logo.jpg" width="377" height="134" alt="Sucesos Urbanos"/>
            </div> 
            <div id="Titulo"> <h1>Sistema de Sucesos Urbanos</h1>
                <h3>Localizacion de accidentes Transito, reparacion de: calles, caÃ±os de agua, electricos, semaforos</h3> </div>          
            <nav>
                <?php navegacion(); ?>
                <div id="viga"></div>
            </nav>
        </header>

        <aside id="menu"> 
            <?php Top(); ?>          

        </aside>
        <section id="seccion"> 
            <article><div class="titulos"> 
                    <div>Contacto</div>
                    <form name="contacto" action="mail.php" method="POST">
                        <p><input placeholder="nombre" type="text"  class="contacto" name="nombre" value="" size="45"/></p>
                        <p><input placeholder="mail" type="text" class="contacto" name="mail" value="" size="45"/></p>
                        <p><textarea class="contacto" placeholder="comentario" name="comentario"rows="4" cols="45"></textarea></p>
                        <p><input  class="contacto" type="submit" value="Enviar" name="Enviar" /></p>
                 </form>

                </div> </article>

        </section>
        <footer>
            <div style=" display: table;">
                <?php pie() ?>


        </footer>


    </body>
</html>
