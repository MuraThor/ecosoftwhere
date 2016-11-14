<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>

<?php  
$conn=mysqli_connect("localhost","root","");    																									//codice PHP per l'estrazione
$DB= mysqli_select_db($conn,"progetto"); 																											//dell'indirizzo da una generica tabella
$query="SELECT Indirizzo FROM tabella LIMIT 1" ;																									//viene caricato solo il primo record 
?>
<script type="text/javascript">

function httpGet()
{    

 var via = "<?php $result=mysqli_query($conn,$query); $row = mysqli_fetch_array($result); echo $row[0]; ?>";
 
 
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "https://maps.googleapis.com/maps/api/geocode/json?address="+via+",%20lecce&key=AIzaSyAYlhh0NeF3kgNYLO4qgK1tJ57vVKOoztw", false ); // richiesta a google maps per riceevre i dati della via in formato JSON
    xmlHttp.send( null );
    var val = new String(xmlHttp.responseText);
    var lat_in  = val.match("lat(.*),");																													//comando match per estrarre i valori
    var lng_in  = val.match("lng(.*)");																														//di longitudine e latitudine (ho usato anche substring per delle difficoltà
	var lat = lat_in[1].substr(4,10);																														// riscontrate con le regular expression
	var lng = lng_in[1].substr(4,10);
	window.location.href = "loadlatlng.php?lat="+lat+"&lng="+lng+"&via="+via;																				//invio dei dati alla pagina loadlatlng.php

		}

</script>   


</head>

<body onload="javascript:httpGet()">

</body>

</html>
