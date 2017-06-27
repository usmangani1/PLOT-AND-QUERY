<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>

          <style>
    .button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
    div.relative {
    position: absolute;
    left: 0px;
    width: 238px;
    height: 240px;
    
    background-color: #87CEFA;
}
div.new {
    position: absolute;
    left: 0px;
    top:250px;
    width: 238px;
    height: 200px;
    
    background-color: #90EE90;
}
div.old {
    position: absolute;
    left: 0px;
    top:455px;
    width: 238px;
    height: 150px;
    
    background-color: #FFD700;
}
div.home {
    position: absolute;
    left: 0px;
    top:610px;
    width: 238px;
    height: 200px;
    
    background-color: #C71585;
}
</style>

</head> 
<body>

<div class="relative">

<form method="post" action="selectsome.php">
  <br>
      <br>
ENTER AND PLOT
<br>
      <br>
      
      Enter the Starttime:
    
     <input type="text" name="fromtime" id="starttime">
      <br>
      <br>
      Enter the Endtime:
      <input type="text" name="totime"  id="endtime">
      

      <br>
      <br>
      <input type="SUBMIT" class="button"  value="PLOT ">
      
</form>
</div>

<div class="new">

<form method="post" action="geocoding.php">
      <br>
      <br>
      GET THE ADDRESS
      <br>
      <br>

      Enter the Timestamp:
    
     <input type="text" name="Timestamp" id="starttime">
      <br>
      
      <br>
      <input type="SUBMIT" class="button"  value="GET LOCATION INFO ">
      
</form>
</div>

<div class="old">
<form method="post" action="mostvisitedplace.php">
<br>
      <br>
      
<input type="SUBMIT" class="button" value="MOST VISITED PLACE">

</form>
</div>
<div class="home">
<form method="post" action="newpath.php">
<br>
      
    FROM TIME:
    <br>
<input type="text" name="fromtime1" >
      <br>
      <br>
      TO TIME:
      <br>
<input type="text" name="endtime1" >
<br>
      <br>
<input type="SUBMIT" class="button" value="GET PATHTRAVELLED">
</div>

</form>
</div>



  <div id="map" style="width: 1200px; height: 800px;left:230px"></div>

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
        var datereq=[];
        var lattituderecovered;
        var longituderecovered;


        
        var data;
    
            //JSON INPUT//
            $.getJSON('location.json', function(data) {
                //PARSING JSON INPUT//
                $.each(data, function(idx, obj){ 
                    $.each(obj , function(key , value){ 
                        //if(key == "FORWARD_4D_MODEL"){
                            $.each(value , function(key1 , value1){
                                //$.each(value1 , function(key2 , value2){
                                    if(key1 == "timestampMs"){
                                        ts.push(value1);
                                    }
                                    else if(key1 == "latitudeE7"){
                                        lat.push(value1/10000000);
                                    }
                                    else if(key1 == "longitudeE7"){
                                        lon.push(value1/10000000);
                                    }
                                    else if(key1 == "accuracy"){
                                        accur.push(value1/10000000);
                                    }
                                    if(key1 == "activity"){
                                        flag=1;
                                        activity_type.push(value1[0].activity[0].type);
                                    }
                                    if(flag==0){
                                        activity_type.push("STILL");
                                    }
                                    flag=0;
                                //})
                            })                  
                        //}
                    });
                });

                
                
           
for(var i=0; i<ts.length; i++){

                    timeStamp.push(new Date(ts[i]*1000/1000));

                    var dateVal ="/Date(1490679532304)/";
                    var date = new Date( parseFloat( dateVal.substr(6 )));
                     
                        datereq[i]=(date.getMonth() + 1) + "/" +
                        date.getDate() + "/" +
                        date.getFullYear();                   
                    
                }
                console.log(timeStamp);
                console.log(ts);
                console.log(datereq)


                



  
   
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
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

  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
</body>
</html>