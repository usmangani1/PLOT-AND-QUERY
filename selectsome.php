<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
  <script src="parsejson.js"></script>

</head> 
<body>

 <div id="map" style="width: 1200px; height: 700px;"></div>

  <script type="text/javascript">
  
   var starttime = <?php echo json_encode($_POST["fromtime"]); ?>;
   var endtime =<?php echo json_encode($_POST["totime"]); ?>;


        
        var found=0;
        var index1;
        var index2;
        var validlat=[];
        var validlon=[];
        var starttimeStamp;
        var endtimeStamp;

              //JSON INPUT//
  $.getJSON('location.json', function(data) {
                //PARSING JSON INPUT//
               
console.log(validlat);
console.log(validlon);



if(found==0)
{

alert("The times entered dosent have correspoding data");

}



      var map = new google.maps.Map(document.getElementById('map'), 
      {
      zoom: 12,
      center: new google.maps.LatLng(lat[0], lon[0]),
      mapTypeId: google.maps.MapTypeId.ROADMAP
     });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < validlat.length; i++)
     {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(validlat[i], validlon[i]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) 
      {
        return function() {
          infowindow.setContent(activity_type[i]);
          infowindow.setContent(reqaccur[i]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    
     
    var line = new google.maps.Polyline ({
    path: [new google.maps.LatLng(validlat[i], validlon[i]), new google.maps.LatLng(validlat[i+1],validlon[i+1])],
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 10,
    geodesic: true,
    map: map
     });
      }
    });
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=map"></script>
  <center>
  <form method="post" action="googlemapphpwithoutcalender.php">
    <br>
    <br>
<input type="submit" name="submit" value="GO BACK AND TRY ANOTHER ">


</form>
</center>
</body>
</html>