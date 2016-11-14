<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<style>
 #map {
   width: 50%;
   height: 500px;											
   background-color: grey;
 }
</style>

<title>Untitled 1</title>
</head>

<body>
<font face="Verdana" size="12"><b>
localizer 1.0
</b></font>
<p>

<form method="POST" action="redirect.php">

<select name="tipo">
<option value=0>Seleziona un'attività</option>
<option value=1>ristoranti</option>								<!--lista delle attività commericali di cui si è calcolata la mappa; il passaggio della pagina avviene tramite la pagina redirect.php-->
<option value=2>bar</option>
<option value=3>B&B</option>
</select>
<p>
<input type="submit" value="Localize"></input>
<input type="button" onclick="window.location.href='index.html';" value="Clear"></input>

</form> 

<div id="map" style="position:absolute; left:500px; top:20px;"></div>


<?php
 $conn=mysqli_connect("localhost","ecosoftwhere",""); 
 $DB= mysqli_select_db($conn,"my_ecosoftwhere");
 $query="SELECT val_loc_a FROM info_zona";
  $result=mysqli_query($conn,$query);
 $valori = array();
 
 while($row = mysqli_fetch_array($result)){
    $valori[] = $row['val_loc_a'];
}    
	

?>

<script type="text/javascript">

 function initMap() {

 
   var val_loc_a = <?php echo json_encode($valori); ?>;
	var color = [];
	var i;
	for(i=0;i<100;i++){
    if(val_loc_a[i]<800000 && val_loc_a[i]>=100000) {color[i]="#00FF00";}
	if(val_loc_a[i]<100000 && val_loc_a[i]>=15000) {color[i]="#FFFF00";}					//calcolo colori zona
    if(val_loc_a[i]<15000 && val_loc_a[i]>=1000) {color[i]="#FF8100";}
    if(val_loc_a[i]<1000 && val_loc_a[i]>=0) {color[i]="#FF0000";}
}	

  var Lecce = {lat: 40.353692,   lng: 18.177436};
   var map = new google.maps.Map(document.getElementById('map'), {							// mappa di lecce
          zoom: 12,
          center: Lecce
        });
		
		



   var a;
   var b; 
   var n=1;
   i=0;
	for (a=0;a<8;a++){

	var lat_min = 40.3880 - 0.008*a;
    var lat_max = 40.3880 - 0.008*(a+1);
	
	for (b=0; b<10; b++){

var lon_min = 18.1114 + 0.0107*b;
var lon_max = 18.1114 + 0.0107*(b+1);

		var coor_zona = [
    {lat: lat_min, lng: lon_min }, // north west
    {lat: lat_max, lng: lon_min}, // south west
    {lat: lat_max, lng: lon_max}, // south east
    {lat: lat_min, lng: lon_max}  // north east
  ];
  
  if( n<5 || (n>9 && n<14) || (n>20 && n<23)|| (n>30 && n<33) || n==41 || n==50 || n==60 || (n>=70 && n<75) || (n>76 && n<=80)){
var  zona= new google.maps.Polygon({
    paths: coor_zona,
    strokeColor: '#000000',
    strokeOpacity: 0,																				//queste zone sono state volutamente oscurate perchè non utili ai fini del calcolo 
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0
  });
}  
  else {
  if(n==46 || n==36){
  var  zona= new google.maps.Polygon({
    paths: coor_zona,
    strokeColor: '#000000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#8F8F8F',
    fillOpacity: 0.5
    
  });}
  
  
  else
  {var  zona= new google.maps.Polygon({
    paths: coor_zona,
    strokeColor: '#000000',																			//colorazione zone
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: color[i],
    fillOpacity: 0.5
  });}
  }
 zona.setMap(map);
 n++;
 i++;
}

  }
}		 
        
    

</script>
<script async defer src ="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDuDFSep6E2Xj4zFllxLH4H_q3XbfoC6Q&callback=initMap">
</script>
<div style="position:absolute;  top:550px;">
<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Licenza Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />Quest'opera è distribuita con Licenza <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribuzione 4.0 Internazionale</a>.
</div>
</body >

</html>
