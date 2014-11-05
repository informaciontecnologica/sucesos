
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

        <aside id="lado"> 
             <?php menu(); ?>          
            <div id="el"></div>
        </aside>
        <section id="seccion"> 
            <article><div class="gracias">
                    <div>Contacto</div>
                   <?php
if(isset($_POST['mail'])) {

// Debes editar las prÃ³ximas dos lÃ­neas de cÃ³digo de acuerdo con tus preferencias
$email_to = "jorge.daniel.castro.formosa@gmail.com";
$email_subject = "Contacto desde el sitio web";

// AquÃ­ se deberÃ­an validar los datos ingresados por el usuario
if(!isset($_POST['nombre']) ||
!isset($_POST['mail']) ||
!isset($_POST['comentario'])) {

echo "<b>OcurriÃ³ un error y el formulario no ha sido enviado. </b><br />";
echo "Por favor, vuelva atrÃ¡s y verifique la informaciÃ³n ingresada<br />";
die();
}

$email_message = "Detalles del formulario de contacto:\n\n";
$email_message .= "Nombre: " . $_POST['nombre'] . "\n..";
$email_message .= "Apellido: " . $_POST['mail'] . "\n..";
$email_message .= "E-mail: " . $_POST['comentario'] . "\n\n..";

$email_from='jorge.daniel.castro.formosa@gmail.com';

// Ahora se envÃ­a el e-mail usando la funciÃ³n mail() de PHP
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers);

echo "Â¡El formulario se ha enviado con Ã©xito!";
}

?>
                
                </div> </article>
        
        </section>
        <footer>
           <?php pie(); ?>

        </footer>


    </body>
</html>