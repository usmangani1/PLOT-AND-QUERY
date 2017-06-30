<html>

<style>
html,
body,
#map {
  height: 100%;
  width: 100%;
  margin: 0px;
  padding: 0px
}
</style>
<body>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="parsejson.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
<div id="map"></div>

<script>


 var starttime = <?php echo json_encode($_POST["fromtime1"]); ?>;
 var endtime = <?php echo json_encode($_POST["endtime1"]); ?>;

        var date=[];
        var plotlat=[];
        var plotlon=[];
        var validlat=[];
        var validlon=[];
        var starttimeStamp;
        var endtimeStamp;
        var validact=[];
        var validaccur=[];
        var plotaccur=[];
        
        var startlan;
        var startlon;
        var endlat;
        var endlon;
        var found=0;
        var count=0;

    
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
validaccur.push(accur[i]);
found=1;
}
}

console.log(validaccur);


for(var i=0;i<validlat.length;i++)
{
  if((i==0)||(i==validlat.length-1))
  {
    
    plotlat.push(validlat[i]);
    plotlon.push(validlon[i]);
    plotaccur.push(validaccur[i]);

  }

if((validact[i]=="STILL")&&(validaccur[i]>0.000005)&& (count<23))
{

plotlat.push(validlat[i]);
plotlon.push(validlon[i]);
plotaccur.push(validaccur);
count++;

}
}
console.log(count);
console.log(plotlat);
console.log(plotlon);

var k=plotlat.length-1;
console.log(k);

if(found==0)
{
    alert("the requested data not found");
}



var geocoder;
var map;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
  

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();


  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng(lat[0], lon[0]),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  directionsDisplay.setMap(map);
  var infowindow = new google.maps.InfoWindow();

  var marker, i;
  var request = {
    travelMode: google.maps.TravelMode.DRIVING
  };
  for (i = 0; i < plotlat.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(plotlat[i], plotlon[i]),
      map: map
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        
        infowindow.open(map, marker);
      }
    })(marker, i));

    if (i == 0) request.origin = marker.getPosition();

    else if (i == plotlat.length - 1) request.destination = marker.getPosition();
    else {
      if (!request.waypoints) request.waypoints = [];
      request.waypoints.push({
        location: marker.getPosition(),
        stopover: true
      });
    }

  }
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(result);
    }
  });
}
google.maps.event.addDomListener(window, "load", initialize);
});

</script>
</body>
</html>
