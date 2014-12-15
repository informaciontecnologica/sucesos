
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
                      <div id="viga"></div>
            </nav>
        </header>

        <aside id="menu"> 
             <?php menu(); ?>          
            
        </aside>
        <section id="seccion"> 
            <article><div >
                    <span>QUIENES SOMOS</span><p class="somos1">
fundada en el año 1994 a partir de un grupo de personas con una amplia trayectoria en la industria informática de Formosa, es una empresa dedicada a generar soluciones integrales en informática bajo el concepto de proveer productos y servicios con la característica que hace de nuestro eslogan todo un símbolo, la  INNOVACION EN TECNOLOGIA INFORMATICA.
En este camino de generar la solución integral con lo más innovador de la tecnología, ofrecemos a nuestros clientes la solución  a su requerimiento informático con todo el know how de nuestros grupos de trabajos y el de la trayectoria de nuestra empresa aplicando el producto ó desarrollo más conveniente y eficiente maximizando el resguardo  de la inversión de nuestros clientes.
En IT trabajamos con absoluta dedicación hacia nuestros clientes bajo un concepto que aumenta nuestro compromiso hacia ellos, y es el de considerarlo un socio, compenetrándonos de su problemática y guiándolo para la toma de la decisión más acertada.
El personal que nos acompaña en cada sector de nuestra empresa sabe que nuestro cliente es lo primero y por ello todo su esfuerzo y dedicación lo complementamos con una constante capacitación y actualización manteniendo nuestra característica de liderazgo en soluciones informáticas para afrontar con solvencia cualquier desafío.
Porque en un mundo globalizado, donde la informática está presente cada vez más en todos los ámbitos, Esta mas cerca para ayudar a la integración aportando Soluciones y Servicios. 
            </p></div> </article>
        
        </section>
        <footer>
           <?php pie(); ?>

        </footer>


    </body>
</html>