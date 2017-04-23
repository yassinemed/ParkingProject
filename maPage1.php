<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type"content="text/html; charset=UTF-8" />
<link rel="stylesheet"	href="CSS/style.css"	type="text/css"	media="screen"	/>

<title>Parking Montpellier </title>

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

<div id="cadre">

<h1>Réservation</h1>

	 <table>
	 <tr>
		<th>Date Debut</th>
		<th>Heure Debut</th>
		<th>Date Fin</th>
		<th>Heure Fin</th>
		<th>Parking</th>
		<th>Place</th>
		<th>Prix</th>
		<th>Etat</th>
	</tr>
<?php
include 'connexion_serveur.php' ;
$req = "select * from reservation r, parking p where r.id_park =p.IdentifiantPark and id_client='".$_SESSION['client'][0]."'" ;
$sql=$conn->query($req);

$dt = new DateTime("now", new DateTimeZone('Europe/Paris'));

//recup données bd
while ($ligne = $sql->fetch()) {
	//variables utilisées pour le calcul
	$debut = date_create($ligne['DateDebut']) ;
	$fin = date_create($ligne['DateFin']) ;

	echo "<tr >\n";
	echo "<td>".date_format($debut,'Y-m-d')."</td>\n";
	echo "<td>".date_format($debut,'H:i')."</td>\n";
	echo "<td>".date_format($fin,'Y-m-d')."</td>\n";
	echo "<td>".date_format($fin,'H:i')."</td>\n";
	echo "<td>".$ligne['LibellePark']."</td>\n";
	echo "<td>".$ligne[id_place]."</td>\n";
	echo "<td>".$ligne[prix]."€"."</td>\n";

	if($debut>$dt){
		echo "<td>Pas encore commencé</td>\n";
	}
	elseif($fin<$dt){
		echo "<td>Expiré</td>\n";
	}
	else{
		echo "<td>Actif</td>\n";
	}
	echo "</tr>\n";
}
?>

<div id="contact">
<p>
 <a href="contact.php" >nous contacter</a> 
 </p>
</div>

</div>



</body>
</html>
