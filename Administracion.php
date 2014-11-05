<!DOCTYPE html>
<?php
require_once('funciones/Top.php');
require_once('Connections/localhost.php');
require_once('configuracion.php');

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

        <aside id="menu"> 
            <?php menu(); ?>          

        </aside>
        <section id="seccion"> 
            <article>
                <?php
                if (isset($_POST['Nombre'])) {
                    
                    $Nombre=$_POST['Nombre'];
                    $Clave=$_POST['Clave'];
                    $sql = "select * from usuarios where nombre_usuario='$Nombre' and clave='$Clave'";
                    $resultado = mysql_db_query("sucesos",$sql);
                    if ($campo=  mysql_fetch_assoc($resultado)){
                    // 
                    // //                   $campos= mysql_fetch_assoc($resultado);
                       echo $campo['clave'];
                       $_SESSION['Nombre']=$campo['nombre_usuario'];
                         echo $_SESSION['Nombre'];                     
//                        echo mysql_num_rows($resultado);
                     
                    }
                } else {
                    echo '<form name = "sesiones" action = "Administracion.php" method = "POST">
            <label>Nombre</label>
        <input type = "text" name = "Nombre" value = "" size = "16" />
        
            <label>Clave </label>
        <input type = "text" name = "Clave" value = "" size = "16" />
        <input type = "submit" value = "Ingresar" name = "Enviar" />
            </form>';
                }
                ?>
            </article>

        </section>
        <footer>
                <?php pie(); ?>

        </footer>


    </body>
</html>