<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Draw Points onto Map</title> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="parsejson.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

</head> 
<body>

  <div id="map" style="width: 1000px; height: 800px;left:0px"></div>
  

  <script type="text/javascript">

  var timeStamp=[];
        var ts=[];
        var lat=[];
        var lon=[];
        var accur=[];

        var date=[];
        var activity_type=[];
        var flag=0;
        var month=[];
        var minutes=[];
        var seconds=[];
        var day=[];
        var datareq=[];
        var dateVal=[];
        var date=[];
        var lattituderecovered;
        var longituderecovered;
        var zoombutton=9;


        
        var data;
    
            //JSON INPUT//
  $.getJSON('location.json', function(data) {
                //PARSING JSON INPUT//
   console.log(zoombutton);


    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: zoombutton,
      center: new google.maps.LatLng(lat[0], lon[0]),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < lat.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat[i], lon[i]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(activity_type[i]);
          infowindow.setContent(accur[i]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    
     
     var line = new google.maps.Polyline({
    path: [new google.maps.LatLng(lat[i], lon[i]), new google.maps.LatLng(lat[i+1],lon[i+1])],
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 10,
    geodesic: true,
    map: map
});
 }
 });

  google.maps.event.addDomListener(zoom, 'click', function() {
  map.setZoom(map.getZoom() + 1);
  });
  </script>
  <button onclick="zoom()">Zoom</button>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
</body>
</html>