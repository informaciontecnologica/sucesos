
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../Connections/localhost.php';

 
    $query = "select * from sucesos left join tiposucesos "
            . "on id_tipo_suceso=id_tiposucesos ";
    $result = mysql_db_query("sucesos", $query);
 
 

        $Cont = 0;
        while ($sucesos = mysql_fetch_assoc($result)) {
             
          $customers[] = array(
              'Items' => $Cont = $Cont+  1,
               'Tipo'=>  $sucesos['TipoSuceso'],
               'Hora'=>    $sucesos['hora'],   
               'Descripcion'=>    $sucesos['descripcion'],   
               'Direccion'=>    $sucesos['direccion'],   
               'Duracion'=>    $sucesos['duracion'],        
               'Latitud'=>    $sucesos['Latitud'],  
               'Longitud'=>    $sucesos['Longitud'],    
               'Modificar'=>   'Modificar', 
               'Baja'=>   'Baja' );
            
        }  

  
echo json_encode($customers);
