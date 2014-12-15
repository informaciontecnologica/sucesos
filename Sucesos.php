
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
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="mapas.js" type="text/javascript"></script>

    </head>
    <body  onload="load()" onunload="GUnload()">
    </head>
<body>

    <header> 
        <div  id="logo"><img src="imagenes/logo.jpg" width="377" height="134" alt="Sucesos Urbanos"/>
        </div> 
        <div id="Titulo"> <h1>Sistema de Sucesos Urbanos</h1>
            <h3>Localizacion de accidentes Transito, reparacion de: calles, caÃ±os de agua, electricos, semaforos</h3> </div>          
        <nav>
            <?php navegacion(); ?>
        </nav>
    </header>

    <aside id="Menusucesos">
        <div style=" display: inline;    text-align: center;   float: right; "> <ul>
            <li><a href="formularioSucesos.php">Tipo de Sucesos</a></li>
                                   
        </ul></div>
        <div style=" display: inline;    text-align: center;   float: left; "> 
        <ul>
            <li style="float: left; "><a href="Sucesos.php?Nuevo=N">Nuevo</a></li>
             <li style="float: left; margin-left: 20px;"><a href="Sucesos.php?Listado=0">Listado</a></li>
                       
        </ul></div>
       
        
    </aside>
    <section class="sectionsucesos"> 
        <article id="art1">
            <div class="marco">
                <?php 
                ABMSucesos();
                
                Forsuceso(); ?>  
            </div>
        </article>
        <article id="art">
            <?php 
            if (isset($_GET['Listado'])){
            echo "<div id=\"tablero\">".Listadosucesos(0). "</div>";
            } else {
            echo "<div id=\"mapa\" style=\"width: 75%; height: 450px\" >aaaaaa </div>  "; }
            ?>
            
        </article>
    </section>
    <footer>
        <?php pie(); ?>

    </footer>


</body>
</html>
