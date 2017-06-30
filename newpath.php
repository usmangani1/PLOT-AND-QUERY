<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
 <script src="parsejson.js"></script>
<script type="text/javascript">


        var starttime = <?php echo json_encode($_POST["fromtime1"]); ?>;
        var endtime =<?php echo json_encode($_POST["endtime1"]); ?>;
        var date=[];
        var plotlat=[];
        var plotlon=[];
        var validlat=[];
        var validlon=[];
        var starttimeStamp;
        var endtimeStamp;
        var validact=[];
        
        var startlan;
        var startlon;
        var endlat;
        var endlon;
        var found=0;

    
            //JSON INPUT//
$.getJSON('location.json', function(data) {
                //PARSING JSON INPUT/

starttimeStamp=new Date(starttime).getTime();
            console.log(starttimeStamp);

endtimeStamp=new Date(endtime).getTime();
            console.log(endtimeStamp);


for(var i=0;i<ts.length;i++)
{           
if( (ts[i]>=starttimeStamp) && (ts[i]<=endtimeStamp) )
{ 
validlat.push(lat[i]);
validlon.push(lon[i]);
validact.push(activity_type[i]);
found=1;
}
}

console.log(validlat);
console.log(validlon);


for(var i=0;i<validlat.length;i++)
{
if(validact[i]=="STILL")
{
plotlat.push(validlat[i]);
plotlon.push(validlon[i]);

}
}

console.log(plotlat);
console.log(plotlon);

var k=plotlat.length-1;
console.log(k);

if(found==0)
{
    alert("the requested data not found");
}

  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;



  function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var myOptions = {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);

for(var i=0;i<plotlat.length;i++)
{
    var start = new google.maps.LatLng(plotlat[i],plotlon[i]);
    var end = new google.maps.LatLng(plotlat[i+k],plotlon[i+k]);
    var request = {
      origin:start, 
      destination:end,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        var myRoute = response.routes[0];
        
        }
     
    });
  }

}
  google.maps.event.addDomListener(window, "load", initialize);
   });
</script>
</head>

<div id="map_canvas" style="width:1200px;height:700px;"></div>
<center>
<form method="post" action="googlemapphpwithoutcalender.php">
    <br>
    <br>

<input type="submit" name="submit" value="GO BACK AND TRY ANOTHER ">


</form>
</center>
</body>
</html>