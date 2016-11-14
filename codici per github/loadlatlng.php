<html>
<head>
<body>

<?php
$lat = $_GET['lat'];																								
$lng = $_GET['lng'];
$via = $_GET['via'];
 $conn=mysqli_connect("localhost","root",""); 
 $DB= mysqli_select_db($conn,"progetto"); 
 $query= "SELECT dati FROM tabella LIMIT 1";											//vengono richiamati i restanti dati del record precedentemente analizzato in getaddress.php
 $result=mysqli_query($conn,$query);
 $row = mysqli_fetch_array($result);
 $query= "INSERT INTO tabella(dati) VALUES ('$row[0]','$via','$lat','$lng')";			//inserimento dei dati sopra richiamati insieme ai valori di longitudine e latidudine	
 mysqli_query($conn,$query);
 
$query= "SELECT COUNT(*) FROM tabella";													//verifica se esistono ancora record da analizzare nella tabella
 $result=mysqli_query($conn,$query);
 $row = mysqli_fetch_array($result);
 
 
if($row[0]!=0){		
 
 $query="DELETE FROM parchi_indirizzi LIMIT 1";											//l'eliminazione del record permette di passare a quello successivo una volta ritornari in getaddress.php
 mysqli_query($conn,$query);
 
header("Location:getaddress.php");
 }
 
 else {echo conversione terminata;}
?>

</body>
</head>
</html>