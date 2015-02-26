<?php
require_once('Connections/localhost.php');

$query = sprintf('select * from sucesos left join  tiposucesos on id_tiposucesos = id_tipo_suceso where estado="AL"');
$result = mysql_db_query("sucesos", $query);
function cacularletra($xmlData){
    $base =  array ("á","é","í","ó","ú","É","Ó","Ú","ñ","Ñ");
    $remplazo =array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Eacute;","&Oacute;","&Uacute;","&ntilde;","&Ntilde;");
        $conversion = str_replace($base,$remplazo,$xmlData );
          
        return $conversion;
}


$rowXml = '<marker> '
        . '<direccion>%s</direccion>'
        . '<idsuceso>%s</idsuceso>'
        . '<tipodesuceso>%s</tipodesuceso>'
        . '<icons>%s</icons>'
        . '<fecha>%s</fecha>'
        . '<hora>%s</hora> '
        . '<descripcion>%s</descripcion>'
        . '<duracion>%s</duracion> '
        . '<latitud>%s</latitud>'
        . '<longitud>%s</longitud>'
        . '</marker>';
$xml = "<markers>";

while ($row = mysql_fetch_assoc($result)) {
    $d= cacularletra($row['descripcion']);
    $xml .= sprintf($rowXml . "\n",
            htmlentities(cacularletra($row['direccion'])),
            htmlentities($row['id_tiposucesos']),
            htmlentities($row['TipoSuceso']),
            htmlentities($row['icons']),
            htmlentities($row['fecha']), 
            htmlentities($row['hora']),
            htmlentities(cacularletra($row['descripcion'])), 
            htmlentities($row['duracion']),
            htmlentities($row['Latitud']), 
            htmlentities($row['Longitud']));

  
}

$xml .= "</markers>";
header('Content-type: text/xml');
echo $xml;
?>
 
