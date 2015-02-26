<?php session_start(); ?>
<script src="script/funciones.js" type="text/javascript"></script> 
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//function Top() {
//    $query = "select * from sucesos   left join tiposucesos"
//            . " on id_tipo_suceso=id_tiposucesos order by fecha,hora LIMIT 10 ";
//    $consulta = mysql_db_query("sucesos", $query);
//    echo "<lu>";
//    while ($result = mysql_fetch_assoc($consulta)) {
//        echo "<li>" . $result['TipoSuceso'] . "-" . $result['direccion'] . "</li>";
//    }
//    echo "</lu>";
//}

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
    echo "<div class=\"nuevo\"><a  href='?Operacion=Nuevo'>Nuevo</a></div>";
//    insertar registros nuevos en Tipos de sucesos
    if (isset($_POST['Operacion'])) {
        $ingreso = $_POST['Sucesos'];
        $query = "insert into tiposucesos (TipoSuceso) values ('$ingreso')";
        $consulta = mysql_db_query("sucesos", $query);
    }
//    modificar Registros en Tipos de sucesos
    if ((isset($_POST['Operacion'])) && ($_POST['Operacion'] == 'Modificar')) {
        $ingreso = $_POST['Sucesos'];
        $id = $_POST['identificacion'];
        $query = "update tiposucesos set TipoSuceso='$ingreso' where id_tiposucesos=$id";
        $consulta = mysql_db_query("sucesos", $query);
    }

    if (isset($_GET['Cancelar'])) {
        if ($_GET['Cancelar'] == 'Cancelar') {
            unset($Operacion);
        }
    }
    if (!isset($_GET['Operacion'])) {


        $query = "select * from tiposucesos"
                . " LIMIT 0,10";
        $consulta = mysql_db_query("sucesos", $query);

        $aaa = 'Editar';


        echo "<div class=\"formlariosuc\"> <table>";
        echo "<tr><td>Tipo de Sucesos</td><td>Accion</td></tr>";
        while ($result = mysql_fetch_assoc($consulta)) {
            echo "<tr><td>" . $result['TipoSuceso'] . "</td>" . "<td>" . "<a href='?Operacion=Editar&Editar=" . $result['id_tiposucesos'] . "&suceso=" . $result['TipoSuceso'] . "'>Editar</a>" . '</td>' . "</tr>";
        }
        echo "</table></div>";
    } else {
        if ($_GET['Operacion'] == 'Editar') {
            $valor = $_GET["suceso"];
            $tipoBoton = 'Modificar';
            $Editar = $_GET["Editar"];
        } else {
            $valor = '';
            $tipoBoton = 'Agregar';
            $Editar = 'Agregar';
        }

        echo"<div id=\"Formulariosucesos\">
                       
                    <form name=\"FSucesos\" action=\"?nuevoregistro\" method = \"POST\" >
                    Sucesos <input type=\"text\" name=\"Sucesos\" value=\"$valor\" size=\"45\" />
                     <input type=\"submit\" value=\"$tipoBoton\" name=\"Operacion\" />
                       <input type=\"hidden\" name=\"identificacion\" value=\"$Editar\" /> 
                    <input type=\"submit\" value=\"Cancelar\" name=\"Cancelar\" />
                    </form>
                </div>";
    }
}

function navegacion() {
    echo "<ul>
                    <li><a href=\"index.php\">Inicio</a></li>
                    <li><a href=\"Administracion.php\">Administracion</a></li>
                    <li><a href=\"somos.php\">Somos</a></li>
                    <li><a href=\"contacto.php\">Contacto</a></li>
                </ul>";
    Ingreso();
}

function Ingreso() {
    if (isset($_SESSION['Nombre'])) {
        echo $_SESSION['Nombre'];
        echo "</br><a href=\"" . $_SERVER['REQUEST_URI'] . "?cerrar=cerrar\">cerrar</a>";
    } 
    if (isset($_GET['cerrar'])) {
      
        session_destroy();
    }
}



function menu() {
    echo "<ul>
            <li><a href=\"formularioSucesos.php\">Tipo de Sucesos</a></li>
            <li><a href=\"Administracion.php\">Administracion</a></li>
            <li><a href=\"Sucesos.php?Nuevo=n\">Sucesos</a></li>
         </ul>";
}

// altas bajas y modificaciones de los Sucesos

function ABMSucesos() {
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
                    echo $asignacion . "\n";
                }
                $fecha = date_format($fecha, 'm-d-y');

                $update = "update sucesos set "
                        . ",fecha ='$fecha' "
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
            case 'Baja':
                $id = $_POST['identificacion'];
                $query = "update sucesos set estado='BA' where id_sucesos=$id";
                $consulta = mysql_db_query("sucesos", $query);
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
    <option Value=\"2\">Clorinda</option>
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


        echo "<tr>"
        . "<td>" . $resultado['TipoSuceso'] . "</td>"
        . "<td>" . $resultado['fecha'] . "</td>"
        . "<td>" . $resultado['hora'] . "</td>"
        . "<td>" . $resultado['direccion'] . "</td>"
        . "<td><a href=\"Sucesos.php?Editar=" . $resultado['id_sucesos'] . "\">Editar</a></td></td>"
        . "<td><a href=\"Sucesos.php?Baja=" . $resultado['id_sucesos'] . "\">Baja</a></td>"
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
?>

