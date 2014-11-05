
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function iniciacion() {
    var mapOptions = {
        zoom: 13,
        center: new google.maps.LatLng(-26.162835, -58.194627, 5),
        mapTypeId: google.maps.MapTypeId.ROADMAP

    };
    map = new google.maps.Map(document.getElementById('mapa'),
            mapOptions);


    //Code Starts
    $(document).ready(function() {
       $.ajax({
            type: "GET",
            url: "locations.php",
            dataType: "xml",
            success: function(xml) {
                $(xml).find('marker').each(function() {
                    var slat = $(this).find('latitud').text();
                    var slong = $(this).find('longitud').text();
                    var stipodesuceso = $(this).find('tipodesuceso').text();
                    var icons = $(this).find('icons').text();
                    var image = 'imagenes/tipossucesos/' + 'Reparacion_Gas' +'.png';
                    var sdireccion = $(this).find('direccion').text();
                                $("<li></li>").html(slat + "," + slong + ",").appendTo("#corte");
                    var southWest = new google.maps.LatLng(slat, slong);

                    var contentString = '<div id="content"><p>'  +stipodesuceso + '</p><p>'
                             sdireccion 
                            '</p></div>';

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });


                    var marker = new google.maps.Marker({
                        position: southWest,
                        map: map,
                        title: stipodesuceso,
                        icon: image
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker);
                       
                    });
                     
                });
            },
            error: function() {
                alert("An error occurred while processing XML file.");
            }
        });
    });
                  

google.maps.event.addListener(map, 'click', function(e) {
     document.Alta.Latitud.value=e.latLng.lat();
     document.Alta.Longitud.value=e.latLng.lng();
                    });
                    

} // fin de load
//
function validarFormatoFecha(campo) {
      var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
      if ((campo.match(RegExPattern)) && (campo!='')) {
            
            
      } else {
            alert('No es una fecha correcta');
            document.Alta.fecha.focus();
            document.Alta.fecha.select();
      }
      
 }

 
//            function placeMarker(lat, long) { /// funcion de agregar marcas tomando datos del listner 
//                var marker = new google.maps.Marker({
//                    position: location,
//                    map: map
//                });
