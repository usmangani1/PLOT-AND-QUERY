<html>
<head>
<title>Google Maps API v3 : Reverse Geocoding</title>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="parsejson.js"></script>
<script type="text/javascript">

var geocoder;
var map;
var infowindow = new google.maps.InfoWindow();
var marker;

var starttime = <?php echo json_encode($_POST["Timestamp"]); ?>;        
        
        var validlat=[];
        var validlon=[];
        var lattitude;
        var longitude;
        var found=0;
        var datareq=[];
        var starttimeStamp;
    
            //JSON INPUT//
$.getJSON('location.json', function(data) {
               
starttimeStamp=new Date(starttime).getTime();

console.log(starttimeStamp);
console.log(starttime);

endtimeStamp=starttimeStamp+86400000;

console.log(endtimeStamp);
console.log(ts);
      

for(var i=0;i<ts.length;i++)
{           
if( (ts[i]>=starttimeStamp) && (ts[i]<=endtimeStamp) )
{ 
validlat.push(lat[i]);
validlon.push(lon[i]);
found=1;
}
}


if (found==0)
	{
		alert("WE ARE SO SORRY TO LET YOU KNOW THAT THE DATA YOU ENTERED DOSENT EXISTS IN OUR RECORDS");
			}

    });

function initialize()
{
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById("map"),
    {
        zoom: 8,
        center: new google.maps.LatLng(validlat[0],validlon[0]),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
}

function codeLatLng()
{
    var input = document.getElementById("latlng").value;
    var latlngStr = input.split(",",2);
    var lat = parseFloat(latlngStr[0]);
    var lng = parseFloat(latlngStr[1]);
    var latlng = new google.maps.LatLng(validlat[0], validlon[0]);

   
    {
    geocoder.geocode({'latLng': latlng}, function(results, status)
    {
        if (status == google.maps.GeocoderStatus.OK)
        {
            if (results[0])
            {
                map.setZoom(11);
                marker = new google.maps.Marker(
                {
                    position: latlng,
                    map: map
                });
                infowindow.setContent(results[0].formatted_address);

                infowindow.open(map, marker);
            }
            else
            {
                alert("No results found");
            }
        }
        else
        {
            alert("Geocoder failed due to: " + status);
        }
    });
}
}
</script>
</head>
<body onload="initialize()">
<div align="center" style="height: 30px; width: 430px background-color:#4CAF50";>
<input id="latlng" type="text" value="lattitude,longitude">
<input type="button" value="GET LOCATION INFORMATION" onclick="codeLatLng()">
</div>
<div id="map" style="height: 700px; width: 1200px"></div>
<center>
<form method="post" action="googlemapphpwithoutcalender.php">
	<br>
    <br>
<input type="submit" name="submit" value="GO BACK AND TRY ANOTHER ">


</form>
</center>
</body>
</html>