<?php 
session_start() ;
?>

<!DOCTYPE html>
<html>
<head>
 	<meta http-equiv="Content-Type"content="text/html; charset=UTF-8" /> 
 	<link rel="stylesheet"	href="CSS/style.css"	type="text/css"	media="screen"	/>
 		

 	<title>INFO</title>
 
 
</head>

<body>

<ul class="topnav" id="myTopnav">
<li><a href="index.php" ><img src="IMG/LOGO.png"  > </a> </li>
<li><a href="info.php">Parking</a></li>
<?php
if (!isset($_SESSION['client'])){
	echo "<li><a href='connexion.php'>Connexion / Inscription</a></li>" ;
}
else {
	echo "<li><a href='abonnement.php'>S'abonner</a></li>" ;
	echo '<li><a href="reservation.php">Réserver</a></li>' ;
	echo "<li id='small'><a href='maPage.php'>MonCompte<br>( ".$_SESSION['client'][2]." ".$_SESSION['client'][1]." )</a></li><li id='small'><a  href='deconnexion.php'><img src='IMG/Q1.png' width='40' height='40'></a></li>" ;
}
?>
</ul>

<div id="cadre1">
<h1>Info</h1>

<?php
	include 'connexion_serveur.php';
	$req= 'select * from parking';
	$sql=$conn->query($req);
	
	?>
	
	<p>Sélectionner un Parking : </p>
<form method="post" action="info.php" name="form1">
<select OnChange="document.form1.submit();"name="parking">	
<?php
$i=0;
while($ligne= $sql->fetch()) {
?>
<option value="<?php echo $ligne[0];?>"><?php  echo $ligne[1];  ?>


<?php } ?>

</select>
</form> 

<?php
// recupere toute les infos 
	if(isset($_POST['parking'])){
		$req1= 'select * from parking where IdentifiantPark="'.$_POST['parking'].'"';
		$sql1=$conn->query($req1);
		$ligne1= $sql1->fetch();

		echo "<div id='carte'>";
		echo $ligne1[5];
		echo "</div>";
		
		echo "<div id='info'><h2>Information </h2>";
		echo   '<p id="titleP"> '.$ligne1[1].'</p>';
		echo   '<p><strong>Adresse :</strong> '.$ligne1[4].'</p>';
		echo   '<p><strong>Type :</strong> '.$ligne1[2].'</p>';
		echo   '<p><strong>Nombre de niveau : </strong>'.$ligne1[7].'</p>';
		echo   '<p><strong>Nombre de place : </strong>'.$ligne1[8].'</p>';
		echo   '<p><strong>Place Mobilité Réduite: </strong>'.$ligne1[11].'</p>';
		echo   '<p><strong>Prix 15 min (jour) : </strong>'.$ligne1[12].'0€</p>';
		echo   '<p><strong>Prix 15 min (nuit) : </strong>'.$ligne1[13].'0€</p>';

		echo '</div>';
	}
?>

<?php 
//récupération nb places disponibles
//date Actuelle
$dt = date_format(new DateTime("now", new DateTimeZone('Europe/Paris')),'YmdHis');

//nb place indicponibles car résrvées:
$req2 = "select count(id_reserv) from reservation where DateDebut < ".$dt." and DateFin > ".$dt." and id_park=".$_POST['parking'] ;
$sql2 = $conn -> query($req2);
$placeIndispo = $sql2->fetch() ;


//nb place indicponibles car abonnement:
$req4 = "select count(id_abonnement) from abonnement, offresabonnement where abonnement.DateDeb < ".$dt." and abonnement.DateFin > ".$dt." and offresabonnement.IdentifiantOffre = abonnement.id_offre and offresabonnement.IdentifiantPark=".$_POST['parking']  ;
$sql4 = $conn -> query($req4);
$placeIndispo1 = $sql4->fetch() ;


//nb place total:
$req3 = "SELECT count(identifiantPlace) FROM place WHERE IdentifiantPark=".$_POST['parking'] ;
$sql3 = $conn -> query($req3);
$placeTotal = $sql3->fetch() ;

//nb place dicponibles = nb place total - nb paces indicpponibles :
$nbPlaceDispo = $placeTotal[0] - $placeIndispo[0] - $placeIndispo1[0];
echo "<div id='infoo'> ";
echo "<p><strong>Nombre de place diponble actuellment :</strong> " .$nbPlaceDispo.'</p>';
echo"</div>";

?>

</div>

<footer>
<a href="contact.php" >contact</a> 
</footer>

</body>
</html>