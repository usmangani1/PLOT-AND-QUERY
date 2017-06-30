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
        var reqlat=[];
        var reqlon=[];
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


                 
           
for(var i=0; i<ts.length; i++)
{

                  timeStamp.push(new Date(ts[i]*1000/1000));

                  date = timeStamp[i];
                  datareq[i]=
                      (date.getMonth() + 1) + "/" +
                      date.getDate() + "/" +
                      date.getFullYear() ;
                }
               
                 console.log(accur);
                
            });