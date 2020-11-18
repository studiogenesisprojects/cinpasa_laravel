$(window).ready(function () {
  var maps = {};
  map.liasaMap = new google.maps.Map(document.getElementById("map"), {
    center: new google.maps.LatLng(41.2133132, 1.135152),
    zoom: 17,
    styles:
    [
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  }
]
  });

  /*----*/

  var liasacamiones = new google.maps.LatLng(41.2121516, 1.1346729); 
  var liasacamionesBox = 
   '<div id="content" class="d-flex" style="max-width:300px;">' + 
  '<div class="w-50">'+
  '<figure style="overflow:hidden;">'+
  '<img src="../images/truck.jpg" style="width:90%;">'+
  '</figure>'+
  '</div>'+
  '<div class="w-50">' + 
  '<address class="text-default">' + 
  '<p class="text-xs">Avinguda de la Llibertat, 2, 43470 La Selva del Camp,Tarragona</p>' + 
  "</address>" + 
  '<a target="_blank" href="https://goo.gl/maps/zBj6GNU9YuXcGd8r6" class="text-primary"><u>Cómo llegar</u></a>' + 
  "</div>" +
   "</div>";
  var infowindow2 = new google.maps.InfoWindow({
    content: liasacamionesBox
  });
  var liasaMarkerCamiones = new google.maps.Marker({
    position: liasacamiones,
    map: map.liasaMap,
    icon: "../images/marker.png",
    anchorPoint: new google.maps.Point(0, -13)
  });
  liasaMarkerCamiones.addListener("click", function () {
    infowindow2.open(map, liasaMarkerCamiones);
  });


  var liasaoficina = new google.maps.LatLng(41.2137305, 1.1340691);
  var liasaoficinaBox = 
  '<div id="content" class="d-flex" style="max-width:300px;">' + 
  '<div class="w-50">'+
  '<figure style="overflow:hidden;">'+
  '<img src="../images/factory1.jpg" style="width:90%;">'+
  '</figure>'+
  '</div>'+
  '<div class="w-50">' + 
  '<address class="text-default">' + 
  '<p class="text-xs">Raval de Sant Rafael, 21, 43470 La Selva del Camp,Tarragona</p>' + 
  "</address>" + 
  '<a target="_blank" href="https://goo.gl/maps/kKERg8woAoGVMcMeA" class="text-primary"><u>Cómo llegar</u></a>' + 
  "</div>" +
   "</div>";
  var infowindow = new google.maps.InfoWindow({
    content: liasaoficinaBox
  });
  var liasaMarkerOficinas = new google.maps.Marker({
    position: liasaoficina,
    map: map.liasaMap,
    icon: "../images/marker.png",
    anchorPoint: new google.maps.Point(0, -13)
  });
  liasaMarkerOficinas.addListener("click", function () {
    infowindow.open(map, liasaMarkerOficinas);
  });
});
