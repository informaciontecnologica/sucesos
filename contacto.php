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

    </head>
    <body  onload="load()" onunload="GUnload()">

        <header> 
            <div  id="logo"><img src="imagenes/logo.jpg" width="377" height="134" alt="Sucesos Urbanos"/>
            </div> 
            <div id="Titulo"> <h1>Sistema de Sucesos Urbanos</h1>
                <h3>Localizacion de accidentes Transito, reparacion de: calles, caÃ±os de agua, electricos, semaforos</h3> </div>          
            <nav>
          <?php navegacion(); ?>
            </nav>
        </header>

        <aside id="menu"> 
             <?php menu(); ?>          
            
        </aside>
        <section id="seccion"> 
            <article><div class="titulos">
                    <div>Contacto</div>
                    <form name="contacto" action="mail.php" method="POST">
                        <p>Nombre:<input type="text" name="nombre" value="" size="45"/></p>
                        <p>Mail:<input type="text" name="mail" value="" size="45"/></p>
                        <p>Comentario:<textarea name="comentario" rows="4" cols="45">
                        </textarea></p>
                        <p><input type="submit" value="Enviar" name="Enviar" /></p>
                        
                    
                    </form>
                
                </div> </article>
        
        </section>
        <footer>
           <?php pie(); ?>

        </footer>


    </body>
</html>
