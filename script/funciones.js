
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function myFunction(){
    alert('dasd');
};
// Solo permite ingresar numeros.
function soloNumeros(e){
    
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
//        <input type="text" id="txtCosto" name="txtCosto" value="" onKeyPress="return soloNumeros(event)" />
}
