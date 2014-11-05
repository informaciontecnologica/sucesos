
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
        <link href="jquery/themes/ui.jqgrid.css" rel="stylesheet" type="text/css"/>
        <link href="jquery/themes/ui.multiselect.css" rel="stylesheet" type="text/css"/>
        <link href="jquery/themes/redmond/jquery-ui-custom.css" rel="stylesheet" type="text/css"/>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

        <script src="jquery/js/jquery.js" type="text/javascript"></script>
        <script src="jquery/js/i18n/grid.locale-es.js" type="text/javascript"></script> 
        <script type="text/javascript">
            $.jgrid.no_legacy_api = true;
            $.jgrid.useJSON = true;
        </script> 
        <script src="jquery/js/jquery.jqGrid.min.js" type="text/javascript"></script> 
        <script src="jquery/js/jquery-ui-custom.min.js" type="text/javascript"></script> 

        <script src="script/mapas.js" type="text/javascript"></script>

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
            echo "<div id=\"mapa\" > </div>  "; }
            ?>
            
        </article>
    </section>
    <footer>
        <?php pie(); ?>

    </footer>


</body>
</html>
