<!DOCTYPE html>
<?php
require_once('funciones/Top.php');
require_once('Connections/localhost.php');
?>

<html>
    <head>
        <title>Sistema de Sucesos Urbanos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="mapas.js" type="text/javascript"></script>
        <script src="https://apis.google.com/js/platform.js" async defer>
            {
                lang: 'es'
            }
        </script>
    </head>
    <body  onload="iniciacion()" >
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
            <div  id="logo"><img src="imagenes/logo2.jpg" width="377" height="134" alt="Sucesos Urbanos"/>
            </div> 
            <div id="Titulo"> <h1>Sistema de Sucesos Urbanos</h1>
                <h3>Localizacion de accidentes Transito, reparacion de: calles, caños de agua, electricos, semaforos</h3> </div>          
            <nav>
                <?php navegacion();
                ?>
                <div id="viga"></div>
            </nav>

        </header>

        <aside id="menu"> 

            <div ><?php echo Top(); ?> </div>
             
        </aside>
        <section id="seccion"> 
            <article>
                <div id="mapa" style="width: 75%; height: 450px"> </div>
           </article>
                <article>
           
            </article>
        </section>
        <footer>
            <?php pie(); ?>

        </footer>


    </body>
</html>
