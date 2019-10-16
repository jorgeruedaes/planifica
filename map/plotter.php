<?php
include('../Admin/php/consultas.php');
include('../Admin/php/funciones.php');

$lat = $_GET["lat"];
$lng = $_GET["lng"];
$actividad = $_GET["actividad"];

$info = Get_Ruta_Usuario($actividad);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <style>
       body { margin:0; padding:0; font-family: arial; }
       #map { position:absolute; top:0; bottom:0; width:100%; }
      </style>
</head>
<body>
    <div id="map" data-lat="<?php  echo $lat  ?>" data-lng="<?php  echo $lng ?>" data-vector='<?php echo $info ?>' ></div>
    <script src="src_js/leaflet.js"></script>
    <script src="src_js/leaflet.plotter.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="src_js/leaflet.css" />
    <link rel="stylesheet" href="src_js/plotter.css" />
    <link rel="stylesheet" href="src_js/leaflet-routing-machine.css" />
       <script src="src_js/leaflet-routing-machine.js"></script> 
    
    
 <!--<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>-->   
    
   <script type="text/javascript">
   var lat = $('#map').data('lat');
   var lng = $('#map').data('lng');
   
   var map = L.map('map').setView([lat,lng], 18);

   L.tileLayer('https://{s}.tile.openstreetmap.se/hydda/full/{z}/{x}/{y}.png', {
   attribution: 'Tiles courtesy of <a href="http://openstreetmap.se/" target="_blank">OpenStreetMap Sweden</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
   	L.marker([lat, lng]).addTo(map);
   	
   	    L.Routing.control({

        waypoints: [
            L.latLng(7.09098283, -73.106686),
            L.latLng(7.09389724,-73.109800),
            L.latLng(7.1148835,-73.115966)
        ],
       draggableWaypoints: false,
       show : true,
       lineOptions: {
    styles: [{color: 'red', opacity: 0.6, weight: 6}]
  }
    }).addTo(map);
   	
   	var array = [];

 
   	$.each($('#map').data('vector'), function(i,item){
   	var item = [];
   	
   	item.push($('#map').data('vector')[i].lat);
   	item.push($('#map').data('vector')[i].lon);
   array.push(item);	    
   	});

	//lat lon
    var plottedPolyline = L.Polyline.Plotter(array,{
        weight: 3,
       //plottedPolyline.getLatLngs(),
        readOnly :true
          }).addTo(map);

    // Trigger for toggling readonly property
      var readOnly = false;
      function toggle(actual){
		  if (actual== "read"){
			plottedPolyline.setReadOnly(readOnly);
		  } else  if (actual== "edit"){
			plottedPolyline.setReadOnly(!readOnly);
		  }
		   if (actual== "read"){
			return 'Editing';
		  }else if (actual == "edit"){
			return 'ReadOnly';  }
		  }
		function getpoints(){
		var Points = plottedPolyline.getLatLngs();
		for(var i=0; i < Points.length; i++) {
			if(map.getBounds().contains(Points[i])) {
			   return Points;
			}
		}
		};
      </script>
    </body>
   </html>
