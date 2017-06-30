<html>
<head>
<title>Google Maps API v3 : Reverse Geocoding</title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="parsejson.js"></script>
  
<script type="text/javascript">

var geocoder;
var map;
var infowindow = new google.maps.InfoWindow();
var marker;
var mf = 1;
var m = 0;
var mvlat;
var mvlon;

    
            //JSON INPUT//
$.getJSON('location.json', function(data) 
{
                //PARSING JSON INPUT//
                
        for(var i=0; i<ts.length; i++)
                {

                    timeStamp.push(new Date(ts[i]*1000/1000));
                    date = timeStamp[i];
                    datareq[i]=
                    (date.getMonth() + 1) + "/" +
                    date.getDate() + "/" +
                    date.getFullYear() ;
                }
        console.log(datareq);

        for (var i = 0; i < lat.length; i++) 
        {
            for (var j = i; j < lat.length; j++) 
                {
                    if (lat[i] == lat[j]) m++;
                    if (mf < m) 
                    {
                      mf = m;
                      mvlat = lat[i];
                      mvlon=lon[i];
                     }
                 }
          m = 0;
        }
        console.log(mvlat);
        console.log(mvlon);
});

        function initialize()
        {
            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById("map"),
            {
                zoom: 8,
                center: new google.maps.LatLng(mvlat,mvlon),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        }

        function codeLatLng()
        {
            var input = document.getElementById("latlng").value;
            var latlngStr = input.split(",",2);
            var lat = parseFloat(latlngStr[0]);
            var lng = parseFloat(latlngStr[1]);
            var latlng = new google.maps.LatLng(mvlat, mvlon);
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
</script>
</head>
<body onload="initialize()">
<div align="center" style="height: 30px; width: 430px">
<input id="latlng" type="text" value="mvlat,mvlon">
<input type="button" value=" GET THE MOST VISITED PLACE " onclick="codeLatLng()">
</div>
<div id="map" style="height: 700px; width: 1200px"></div>
<center>
<form method="post" action="googlemapphpwithoutcalender.php">
<br>
<br>
<input type="submit" name="submit" value="BACK TO HOME PAGE ">
</form>
</center>
</body>
</html>