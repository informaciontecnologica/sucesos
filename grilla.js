
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    // prepare the data
    var source ={
        datatype: "json",
        datafields: [{ name: 'Items' },{ name: 'Tipo' },{ name: 'Hora' },{ name: 'Descripcion' },{ name: 'Direccion' },{ name: 'Duracion' },{ name: 'Latitud' },{ name: 'Longitud' },{ name: 'Modificar' },{ name: 'Baja' }],
        url: 'funciones/grillasuceso.php'
    };
    $("#jqxgrid").jqxGrid({
        source: source,
        theme: 'classic',
        columns: [{ text: 'Items', datafield: 'Items', width: 250 },{ text: 'Tipo', datafield: 'Tipo', width: 150 },{ text: 'Descripcion', datafield: 'Descripcion', width: 180 },{ text: 'Direccion', datafield: 'Direcccion', width: 200 },{ text: 'Duracion', datafield: 'Duracion', width: 120 },{ text: 'Latitud', datafield: 'Latitud', width: 120 },{ text: 'Longitud', datafield: 'Longitud', width: 120 },{ text: 'Modificar', datafield: 'Modificar', width: 120 },{ text: 'Baja', datafield: 'Baja', width: 120 }]
    });
});
