<html>

<head>

<body>
<?php

$conn=mysqli_connect("localhost","root",""); 														//il codice analizza i dati utili per il calcolo delle aree
$DB= mysqli_select_db($conn,"progetto"); 

$query_aziende="SELECT lat, lng, A,B FROM aziende_coordinate"; 										//inizializzazione query  di SELECT 
$query_b_b="SELECT lat,lng FROM b_b_coordinate";
$query_fermate="SELECT stop_lat,stop_lon FROM fermate_bus_coordinate";
$query_hotspot="SELECT LATITUDINE, LONGITUDINE FROM hotspot_wi_fi_coordinate";
$query_monumenti="SELECT lon,lat FROM monumenti_coordinate";
$query_parchi="SELECT lat,lng FROM parchi_coordinate";
$query_residenti="SELECT lat, lng, n_ab FROM residenti_coordinate";
$query_scuole="SELECT LAT,LON FROM scuole_coordinate";

$zona=1;

for ($a=0; $a<10;$a++){
  $lat_min = 40.3880 - 0.008*$a;																	//calcolo dei punti della zona in esame
  $lat_max = 40.3880 - 0.008*($a+1); 

  for ($b=0; $b<10; $b++){
$az_a=0;
$az_b=0;
$n_b_b=0;
$n_fermate=0;
$n_hotspot=0;
$n_monumenti=0;
$n_parchi=0;
$n_ab_z=0;
$n_scuole=0;


$result_aziende=mysqli_query($conn,$query_aziende);
$result_b_b=mysqli_query($conn,$query_b_b);
$result_fermate=mysqli_query($conn,$query_fermate);
$result_hotspot=mysqli_query($conn,$query_hotspot);
$result_monumenti=mysqli_query($conn,$query_monumenti);
$result_parchi=mysqli_query($conn,$query_parchi);
$result_residenti=mysqli_query($conn,$query_residenti);
$result_scuole=mysqli_query($conn,$query_scuole);

$lon_min = 18.1114 + 0.0107*$b;
$lon_max = 18.1114 + 0.0107*($b+1);																	//da questo punto avviene il conteggio dei servizi, degli abitanti e delle aziende nella zona

	while ($row = mysqli_fetch_array($result_aziende)){
		
	if($row['lat']>$lat_max && $row['lat']<$lat_min && $row['lng']<$lon_max && $row['lng']>$lon_min) 
	{
	
	if($row['A']=='A') { $az_a++;}
	if($row['B']=='B') { $az_b++;}
	
	}
	}
	
	while ($row = mysqli_fetch_array($result_b_b)){
		
	if($row['lat']>$lat_max && $row['lat']<$lat_min && $row['lng']<$lon_max && $row['lng']>$lon_min)  {$n_b_b++;}
}											


	while ($row = mysqli_fetch_array($result_fermate)){
		
	if($row['stop_lat']>$lat_max && $row['stop_lat']<$lat_min && $row['stop_lon']<$lon_max && $row['stop_lon']>$lon_min)  {$n_fermate++;}
}

	while ($row = mysqli_fetch_array($result_hotspot)){
		
	if($row['LATITUDINE']>$lat_max && $row['LATITUDINE']<$lat_min && $row['LONGITUDINE']<$lon_max && $row['LONGITUDINE']>$lon_min)  {$n_hotspot++;}
}										

	while ($row = mysqli_fetch_array($result_monumenti)){
		
	if($row['lat']>$lat_max && $row['lat']<$lat_min && $row['lon']<$lon_max && $row['lon']>$lon_min)  {$n_monumenti++;}
}										

	while ($row = mysqli_fetch_array($result_parchi)){
		
	if($row['lat']>$lat_max && $row['lat']<$lat_min && $row['lng']<$lon_max && $row['lng']>$lon_min)  {$n_parchi++;}
}										

	while ($row = mysqli_fetch_array($result_residenti)){
		
	if($row['lat']>$lat_max && $row['lat']<$lat_min && $row['lng']<$lon_max && $row['lng']>$lon_min)  {$n_ab_z=$n_ab_z+$row['n_ab'];}
}										

	while ($row = mysqli_fetch_array($result_scuole)){
		
	if($row['LAT']>$lat_max && $row['LAT']<$lat_min && $row['LON']<$lon_max && $row['LON']>$lon_min)  {$n_scuole++;}
}										


										
										
										 
//caricamento dei dati 
	

$load_query="INSERT INTO info_zona (zona, n_aziende_a, n_aziende_b, n_b_b, n_fermate_bus, n_hotspot, n_monumenti, n_parchi, n_scuole,n_ab) VALUES ($zona, $az_a, $az_b, $n_b_b, $n_fermate, $n_hotspot, $n_monumenti, $n_parchi, $n_scuole, $n_ab_z)";
mysqli_query($conn,$load_query);
$zona++;
						}
					 }
?>

</body>
</head>

</html>
