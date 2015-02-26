<?php

session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');

function nombre() {
    if (isset($_SESSION['nombre'])) {
        if (!empty($_SESSION['nombre'])) {
            echo $_SESSION['nombre'];
//} else {
//    if (isset($_SESSION['nombre'])) {
//        echo "Has iniciado Sesion: " . $_SESSION['nombre'];
//    } else {
//        echo "Acceso Restringido";
        }
    }
}
?>
<script src="script/funciones.js" type="text/javascript"></script> 
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function Top() { // modulo "ultimo sucesos"
    echo "<p class=\"ultimosucesos\">Ultimos sucesos</p>";
        
    $query = "select * from sucesos   left join tiposucesos"
            . " on id_tipo_suceso=id_tiposucesos order by fecha,hora LIMIT 10 ";
    $consulta = mysql_db_query("sucesos", $query);
    
    echo "<table class=\"ultimos\">".
            "</tr><td>Duracion</td><td>Icon</td><td>Tipo</td><td>Direccion</td></tr>"
    ;
    while ($result = mysql_fetch_assoc($consulta)) {
        echo "<tr><td>" . $result['duracion'] ."<td>";
       echo  " <img id=\"iconicos\" alt=\"".$result['TipoSuceso']."\" src =\"imagenes/tipossucesos/" . $result['icons'] . "\"></td>";
        echo "<td>".$result['TipoSuceso']."</td>"
                .  "<td>" . $result['direccion'] . "</td></tr>";
    }
    echo "</table>";
     TipodeColores ();
    
}

function Listasucesos() {
    $query = "select * from tiposucesos"
            . " LIMIT 0,10";
    $consulta = mysql_db_query("sucesos", $query);
    echo "<table>";
    while ($result = mysql_fetch_assoc($consulta)) {
        echo "<tr><td>" . $result['TipoSuceso'] . "</td></tr>";
    }
    echo "</table>";
}

function Grillasucesos() {
    echo "<div class=\"nuevo\">Tipos de sucesos</div>";
    if (isset($_GET['Operacion'])) {
        $opcion = $_GET['Operacion'];
//        echo $opcion;
        if ($opcion == 'Editar') {
            $valor = $_GET["suceso"];
            $tipoBoton = 'Modificar';
            $Editar = $_GET["Editar"];
        } else {
            $valor = '';
            $tipoBoton = 'Agregar';
            $Editar = 'Agregar';
        }
    } else {
        $opcion = "";
    }
    if (isset($_POST['Modificar'])) {  //modificar los registros de tipos de sucesos 
        $ingreso = $_POST['Sucesos'];
        $id = $_POST['identificacion'];
        $nombre_archivo = $_FILES['userfile']['name'];
        $tipo_archivo = $_FILES['userfile']['type'];
        $tamano_archivo = $_FILES['userfile']['size'];
        echo $_FILES['userfile']['tmp_name'];
        echo $_FILES['userfile']['error'];
        $uploaddir = 'imagenes/tipossucesos/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
//compruebo si las características del archivo son las que deseo 
        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 10000000))) {
            echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
        } else {
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                echo "El archivo ha sido cargado correctamente.";
                print_r($_FILES);
                $query = "update tiposucesos set TipoSuceso='$ingreso' ,icons='$nombre_archivo' where id_tiposucesos=$id";
                $consulta = mysql_db_query("sucesos", $query);
            } else {
                echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
            }
        }
    }

    switch ($opcion) {
//    insertar registros nuevos en Tipos de sucesos  
        case "Agregar":
            $ingreso = $_GET['Sucesos'];
            $icons = $_GET['files'];
            $query = "insert into tiposucesos (TipoSuceso) values ('$ingreso')";
            $consulta = mysql_db_query("sucesos", $query);
            break;

        case "Editar":
            $tipoBoton = "Modificar";
            echo"<div id=\"Formulariosucesos\">
                   <form name=\"FSucesos\"  method=\"post\"  action=\"formularioSucesos.php?Operacion=Modificar\" enctype=\"multipart/form-data\" >
                    <p><lavel>Sucesos</lavel> id: $Editar</p>
                    <p><input class=\"contacto\" type=\"text\" name=\"Sucesos\" value=\"$valor\" size=\"45\" /></p>
                    <p><input class=\"contacto\" name=\"userfile\" type=\"file\"> 
                    <p><img src =\"imagenes/tipossucesos/" . $_GET['imagen'] . "\"/>
                    <p><input class=\"contacto\" type=\"submit\" value=\"$tipoBoton\" name=\"Operacion\" />
                    <input class=\"contacto\" type=\"hidden\" name=\"identificacion\" value=\"$Editar\" /> 
                    <input class=\"contacto\" type=\"button\" value=\"Cancelar\" name=\"Cancelar\"  onClick=\"location.href = '?Operacion=default'\"/></p>
                    </form>
                    </div>";
            break;
        case "Nuevo":  // formulario para agregar tipo de sucesos
            echo 
            "<script type=\"text/javascript\">
             function setSrc()   {
            var x=document.images
            x[0].src=\"foto1.gif\"
                }
            </script>";

            echo"<div id=\"Formulariosucesos\">
                   <form enctype=\"multipart/form-data\"  name=\"NTipoSucesos\"  method=\"post\"  action=\"formularioSucesos.php?Operacion=TAgregar\"  >
                    Sucesos <input type=\"text\" name=\"Sucesos\" value=\"$valor\" size=\"45\" />
                        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"30000\" />
                    <input name=\"userfile\" type=\"file\"> 
                    
                    <input type=\"submit\" value=\"$tipoBoton\" name=\"Operacion\" />
                    <input type=\"hidden\" name=\"identificacion\" value=\"$Editar\" /> 
                    <input type=\"button\" value=\"Cancelar\" name=\"Cancelar\"  onClick=\"location.href = '?Operacion=default'\"/>
                    </form>
                </div>";
            break;
        case "TAgregar":
                    AgregarFilesTS();
            $ingreso = $_POST['Sucesos'];
            $icons = $_FILES['userfile']['name'];
            if (!empty($ingreso)){
            $query = "insert into tiposucesos (TipoSuceso,icons) values ('$ingreso','$icons')";
            $consulta = mysql_db_query("sucesos", $query);}
            break;   
        default :
//            lista de tipos de sucesos 
            
            $query = "select * from tiposucesos";
            $consulta = mysql_db_query("sucesos", $query);
            echo "<div class=\"formlariosuc\"> <table>";
            echo "<tr><td>Tipo de Sucesos</td><td>Accion</td><td>icons</td></tr>";
            while ($result = mysql_fetch_assoc($consulta)) {
                echo "<tr><td>" . $result['TipoSuceso'] . "</td>" . "<td>" . "<a href='?Operacion=Editar&Editar=" . $result['id_tiposucesos'] . "&suceso=" . $result['TipoSuceso'] . "&imagen=" . $result['icons'] . "'>Editar</a>" . "</td><td><img src =\"imagenes/tipossucesos/" . $result['icons'] . "\"/></td></tr>";
            }
            echo "</table></div>";
    }
    if (isset($_POST['Modificar'])) {
        
    }
    
}


function navegacion() {
    echo "<ul>
                    <li><a href=\"index.php\">Inicio</a></li>
                    <li><a href=\"somos.php\">Somos</a></li>
                    <li><a href=\"contacto.php\">Contacto</a></li>
          </ul>";
    Ingreso();
}

function Ingreso() { //verifiCar el USARIO Y CLAVE DE ACCESO
    if (isset($_POST['Nombre'])) {
        $Nombre = $_POST['Nombre'];
        $Clave = $_POST['Clave'];
        $sql = "select * from usuarios where nombre_usuario='$Nombre' and clave='$Clave'";
        $resultado = mysql_db_query("sucesos", $sql);
        if ($campo = mysql_fetch_assoc($resultado)) {
            $_SESSION['Nombre'] = $campo['nombre_usuario'];
        }
    }

    if (isset($_SESSION['Nombre'])) {
        echo "<li><a href=\"index.php?cerrar=cerrar\">Salir/" . $_SESSION['Nombre'] . "</a></li>";
        MenuAdministracion();
    } else {
        echo "<li><a href=\"Administracion.php\">Ingresar</a></li>";
    }
}

function MenuAdministracion() {
    echo "   <ul class=\"BarraAdministracion\">
             <li><a href=\"formularioSucesos.php\">Tipo de Sucesos</a></li>
             <li><a href=\"formularioSucesos.php?Operacion=Nuevo\">Nuevo Tipo Suceso</a></li>
             <li ><a href=\"Sucesos.php?Nuevo=N\">Nuevo Sucesos</a></li>
             <li><a href=\"Sucesos.php?Listado=0\">Listado de Sucesos</a> </li>
             </ul>
                       ";
}

if (isset($_GET['cerrar'])) {
    if ($_GET['cerrar'] = 'cerrar') {
        unset($_SESSION["nombre"]);
        session_destroy();
        header("Location: index.php");
        exit;
        session_destroy();
    }
}

function pie() {
    echo " <div style=\" display: table;\">"
    . "<div style =\"display: table-cell;  \" class=\"pie1\"><p> Informacion Tecnologica"
    . " mail:info@informaciotecn.com.ar "
    . "Tele:543071025421"
    . "Av. 25 de mayo 1542 Formosa Argentina</p></div>"
    . "<div  style =\"display: table-cell; \" class=\"fb-like\" data-href=\"https://www.facebook.com/TecnologiaInf\" data-width=\"150\" data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"true\" data-share=\"false\"></div>"
    . "<!-- Inserta esta etiqueta donde quieras que aparezca Botón +1. -->"
    . "<div style =\"display: table-cell; \" class=\"g-plusone\" data-size=\"small\"></div></div>";
}

// altas bajas y modificaciones de los Sucesos

function ABMSucesos() {
    if (isset($_GET['Baja'])) {
        $id = $_GET['Baja'];
        $query = "update sucesos set estado='BA' where id_sucesos=$id";
        $consulta = mysql_db_query("sucesos", $query);
    } elseif (isset($_GET['Alta'])) {
        $id = $_GET['Alta'];
        $query = "update sucesos set estado='AL' where id_sucesos=$id";
        $consulta = mysql_db_query("sucesos", $query);
    }

    if (isset($_POST['opcion'])) {
        $opcion = $_POST['opcion'];
        switch ($opcion) {
            case "Agregar" :
                $fecha = date("Y/m/d", strtotime($_POST['fecha']));
                $hora = $_POST['hora'];

                $idciudad = $_POST['idciudad'];
                $descripcion = $_POST['descripcion'];
                $idTsuceso = $_POST['idTsuceso'];
                $duracion = $_POST['duracion'];
                $direccion = $_POST['direccion'];
                $Latitud = $_POST['Latitud'];
                $Longitud = $_POST['Longitud'];

                $query = "insert into sucesos (fecha,hora,id_ciudad,descripcion, id_tipo_suceso,duracion,direccion,Latitud,Longitud,estado) "
                        . "values ('$fecha' ,'$hora',$idciudad,'$descripcion',$idTsuceso,"
                        . "'$duracion','$direccion','$Latitud','$Longitud','AL')";
                $consulta = mysql_db_query("sucesos", $query);
                break;
            case 'Modificar' :
                foreach ($_POST as $nombre_campo => $valor) {
                    $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
                    eval($asignacion);
//                    echo $asignacion . "\n";
                }
              list($dd, $mm, $yy) = explode("/", $fecha); /** comviernte la fecha en formato ingles **/
              $fecha = date("Y/m/d", strtotime("$yy/$mm/$dd"));

              $update = "update sucesos set "
                        . "fecha ='$fecha' "
                        . ",hora='$hora' "
                        . ",id_ciudad=$idciudad "
                        . ",descripcion='$descripcion' "
                        . ",id_tipo_suceso=$idTsuceso "
                        . ",duracion='$duracion' "
                        . ",direccion='$direccion' "
                        . ",Latitud='$Latitud' "
                        . ",Longitud='$Longitud' "
                        . " where id_sucesos=$id";

                $result = mysql_db_query("sucesos", $update) or die('Consulta fallida: ' . mysql_error());
                break;
        }
    }
}

function Forsuceso() {
    if (isset($_GET['Editar'])) {
        $opcion = 'Modificar';
        $id = $_GET['Editar'];
        list($fecha, $hora, $idciudad, $descripcion, $idTsuceso, $duracion, $direccion, $Latitud, $Longitud, $estado) = EditarSucesos();
        $fecha = date("d/m/Y", strtotime($fecha));
    } elseif (isset($_GET['Nuevo'])) {
        $opcion = 'Agregar';
        $fecha = date("d/m/Y");
        $hora = date("G:i");
        $descripcion = '';
    } elseif (isset($_GET['Listado'])) {
        $fecha = date("d/m/Y");
        $hora = date("G:i");
        $descripcion = '';
    }



    echo "<form name=\"Alta\" action = \"\" method = \"POST\">
         
    <p><label>Fecha:</label>
    <input type = \"text\" name = \"fecha\" value = \"$fecha\" size = \"10\" type=\"date\" onBlur=\"return validarFormatoFecha(this.value);\" placeholder=\"01/01/2000\" required/></p>
   <p><label>Hora:</label>
    <input type = \"text\" name = \"hora\" type=\"time\"  value = \"$hora\" size = \"5\"  placeholder=\"10:00\" required /></p>
   <p> <label>Ciudad:</label>
   <select name=\"idciudad\">
    <option value=\"1\">Formosa</option>
    </select>
 
   <p> <label>Descripcion:</label>
    <input type = \"text\" name = \"descripcion\" value = \"$descripcion\" size = \"60\"  placeholder=\"Accidente, transporte de colectivo y automovil\" required /></p>
   <p> <label>Tipo de Suceso:</label>";

    $query = "select * from tiposucesos";
    $Tsucesos = mysql_db_query("sucesos", $query);

    echo "<select name=\"idTsuceso\">";

    while ($registros = mysql_fetch_assoc($Tsucesos)) {
        echo "<option value=\"" . $registros['id_tiposucesos'] . "\" ";

        if (isset($_GET['Editar'])) {
            if ($idTsuceso == $registros['id_tiposucesos']) {
                echo " selected=\"selected\" ";
            }
        }
        echo " >" . $registros['TipoSuceso'] . "</option>";
    }

    echo "</select></p>
        
   <p> <label>Duracion:</label>
    <input type = \"text\" name = \"duracion\" value = \"$duracion\" size = \"5\"  required placeholder=\"00:30\"/></p>
   <p> <label>Direccion</label>
    <input type = \"text\" name = \"direccion\" value = \"$direccion\" size = \"60\"  required placeholder=\"Av. 25 de mayo 1545\"/></p>
   <p> <label>Latitud:</label>
    <input type = \"text\" name = \"Latitud\" value = \"$Latitud\" size = \"40\"  required /></p>
   <p> <label>Longitud:</label>
    <input type = \"text\" name = \"Longitud\" value = \"$Longitud\" size = \"40\"  required /></p>
    <input type = \"hidden\" name = \"id\" value = \"$id\" />
    <p><input type = \"submit\" value = \"$opcion\" name=\"opcion\" />
    <input type = \"reset\" value = \"Cancelar\" /></p>
       
    </form>";
}

function Listadosucesos($pagina) {
    if ($pagina == 0) {
        $pagina = '0,9';
    }
    $query = "select * from sucesos   left join tiposucesos"
            . " on id_tipo_suceso=id_tiposucesos order by fecha,hora ";
    $saldo = mysql_db_query("sucesos", $query);
    $fila = mysql_num_rows($saldo);
    echo "<table class=\"formlariosuc\" ><caption>Lista de Sucesos</caption>";
    echo "<tr><th>Tipo de sucesos</th><th>Fecha</th><th>Hora</th><th>Direccion</th><th>Editar</th><th>Baja</th><th>Estado</th></tr>";

    while ($resultado = mysql_fetch_assoc($saldo)) {
        list($yy,$mm,$dd) = explode("-", $resultado['fecha']);
        $fecha = date("d/m/Y", strtotime("$yy/$mm/$dd"));
        if ($resultado['estado'] == "BA") {
            $AB = "Alta";
        } else {
            $AB = "Baja";
        };
        echo "<tr>"
        . "<td>" . $resultado['TipoSuceso'] . "</td>"
        . "<td>" . $fecha . "</td>"
        . "<td>" . $resultado['hora'] . "</td>"
        . "<td>" . $resultado['direccion'] . "</td>"
        . "<td><a href=\"Sucesos.php?Editar=" . $resultado['id_sucesos'] . "\">Editar</a></td></td>"
        . "<td><a href=\"Sucesos.php?Listado=0&" .
        $AB .
        "=" . $resultado['id_sucesos'] . "\">$AB</a></td>"
        . "<td>" . $resultado['estado'] . "</td>"
        . "</tr>";
    }
    echo "</table>";
}

function EditarSucesos() {
    if (isset($_GET['Editar'])) {
        $opcion = 'Modificar';
        $id = $_GET['Editar'];
        $query = "select * from sucesos   left join tiposucesos"
                . " on id_tipo_suceso=id_tiposucesos where id_sucesos=$id";
        $consulta = mysql_db_query("sucesos", $query);
        $resultado = mysql_fetch_assoc($consulta);
        return array(
            $resultado['fecha'],
            $resultado['hora'],
            $resultado['id_ciudad'],
            $resultado['descripcion'],
            $resultado['id_tipo_suceso'],
            $resultado['duracion'],
            $resultado['direccion'],
            $resultado['Latitud'],
            $resultado['Longitud'],
            $resultado['estado']
        );
    }
}

function cambiaf_mysql($fechadb) {
//vamos a suponer que recibmos el formato MySQL básico de YYYY-MM-DD
//lo primero es separar cada elemento en una variable
    list($yy, $mm, $dd) = explode("-", $fechadb);
//si viniera en otro formato, adaptad el explode y el orden de las variables a lo que necesitéis
//creamos un objeto DateTime (existe desde PHP 5.2)
    $fecha = new DateTime();
//definimos la fecha pasándole las variabes antes extraídas
    $fecha->setDate($yy, $mm, $dd);
//y ahora el propio objeto nos permite definir el formato de fecha para imprimir que queramos       
    echo $fecha->format('d-m-Y');
}
function TipodeColores (){
//    verde:Baja Rojo:Alta 
            
    echo "<div style=\"width: 550px;\"> "
    . "<table class=\"Tablacolores\">"
            . "<th>Escala de Estados</th>"
            . "<tr><td>Alta: Rojo </td>   <td style=\"background:red;\">&#32</td></tr>"
            . "<tr><td>verde:Baja</td>   <td style=\"background:greenyellow;\"> &#32 </td> </tr>"
            . "</table> </div> ";
    
}
function AgregarFilesTS(){ // funcion de agregar tipo de sucecos nuevos hasta hora....
              
        $nombre_archivo = $_FILES['userfile']['name'];
        $tipo_archivo = $_FILES['userfile']['type'];
        $tamano_archivo = $_FILES['userfile']['size'];
//        echo $_FILES['userfile']['tmp_name'];
//        echo $_FILES['userfile']['error'];
        $uploaddir = 'imagenes/tipossucesos/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
//compruebo si las características del archivo son las que deseo 
        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 100000))) {
            echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
        } else {
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                echo "El archivo ha sido cargado correctamente.";
//                print_r($_FILES);
            } else {
                echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
            }
        }
    }



?>
