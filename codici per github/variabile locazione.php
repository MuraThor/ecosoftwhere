<html>

<head>

<body>

<?php
$conn=mysqli_connect("localhost","root",""); 
$DB= mysqli_select_db($conn,"progetto"); 
$query="SELECT * FROM info_zona";
$result=mysqli_query($conn,$query);

while( $row = mysqli_fetch_array($result)){
$k_stop=1.18;
$k_wifi=1.05; 																	//costanti di attrazione 
$k_mon=1.7;
$k_par=1.45;
$k_scu=1.3;
$k_cs=2;


if ($row['n_ab']==0) {$d=1.1473;} else {$d=$row['n_ab']/0.8716;}

$d_az_a=($row['n_aziende_a']+1)/0.8716;
$d_az_b=($row['n_aziende_b']+1)/0.8716;													//densità della popolazione e delle aziende per zona
$d_b_b=($row['n_b_b']+1)/0.8716;

if ($row['n_fermate_bus']==0) {$stop=1; $k_stop=1;} else {$stop=$row['n_fermate_bus'];}
if ($row['n_hotspot']==0) {$wifi=1; $k_wifi=1;} else {$wifi=$row['n_hotspot'];}
if ($row['n_monumenti']==0) {$mon=1; $k_mon=1;} else {$mon=$row['n_monumenti'];}
if ($row['n_parchi']==0) {$par=1; $k_par=1;} else {$par=$row['n_parchi'];}
if ($row['n_scuole']==0) {$scu=1; $k_scu=1;} else {$scu=$row['n_scuole'];}

if ($row['zona']==46) 
{$p=$k_cs*($stop*$k_stop)*($wifi*$k_wifi)*($mon*$k_mon)*($par*$k_par)*($scu*$k_scu);}
else
{$p=($stop*$k_stop)*($wifi*$k_wifi)*($mon*$k_mon)*($par*$k_par)*($scu*$k_scu);}

$val_loc_a=($d*$p)/$d_az_a;
$val_loc_b=($d*$p)/$d_az_b;																	//variabili di locazione
$val_loc_b_b=($d*$p)/$d_b_b;

$query="UPDATE info_zona SET val_loc_a=$val_loc_a, val_loc_b=$val_loc_b, val_loc_b_b=$val_loc_b_b WHERE zona=$row[0]" ;     //caricamento nel database
 mysqli_query($conn,$query);
  }
?>
</body>
</head>
</html>