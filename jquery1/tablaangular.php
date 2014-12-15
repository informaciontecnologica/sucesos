<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */





?>
<table>
    <thead>
        <tr><td>nombre</td><td>sucesos</td></tr> 
    </thead>
    <tbody>
        <tr ng-repeat="registro in registros">
             <td>{{registro.idsucesos}}</td>
             <td>{{registro.sucesos}}</td>
         
         </tr> 
        
    </tbody>
    <tfoot>
        
    </tfoot>
</table>