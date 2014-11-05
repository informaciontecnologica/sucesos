<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//tomo el valor de un elemento de tipo texto del formulario 
$cadenatexto = $_FILES["cadenatexto"]; 
echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>"; 

//datos del arhivo 

$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
//compruebo si las características del archivo son las que deseo 
if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 100000))) { 
   	echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>"; 
}else{ 
   	if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_archivo)){ 
      	echo "El archivo ha sido cargado correctamente."; 
   	}else{ 
      	echo "Ocurrió algún error al subir el fichero. No pudo guardarse."; 
   	} 
} 
        
 echo "<form action=\"\" method=\"post\" enctype=\"multipart/form-data\"> 
   	<b>Campo de tipo texto:</b> 
   	<br> 
   	<input type=\"text\" name=\"cadenatexto\" size=\"20\" maxlength=\"100\"> 
   	<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"100000\"> 
   	<br> 
   	<br> 
   	<b>Enviar un nuevo archivo: </b> 
   	<br> 
   	<input name=\"userfile\" type=\"file\"> 
   	<br> 
   	<input type=\"submit\" value=\"Enviar\"> 
</form>";
    ?>


