<?php

require_once '../Connections/localhost.php';

if (isset($_GET['cerrar'])) {
    if ($_GET['cerrar'] = 'cerrar') {
        unset($_SESSION["nombre"]);
        session_destroy();
        header("Location: sesion.php");
        
       
    }
}



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
                    echo '<form name = "sesiones" action = "sesion.php" method = "POST">
            <label>Nombre</label>
        <input type = "text" name = "Nombre" value = "" size = "16" />
        
            <label>Clave </label>
        <input type = "text" name = "Clave" value = "" size = "16" />
        <input type = "submit" value = "Ingresar" name = "Enviar" />
            </form>';
                }
                

if (!empty($_SESSION['Nombre']) ){
         echo "dedos1";
         echo 'dedos2';
            } else {
         echo "no"; 

             }
?>
<a href="sesion.php?cerrar=cerrar" >cerrar</a>