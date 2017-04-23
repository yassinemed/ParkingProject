<?php 
session_start() ;
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


<?php
	include 'connexion_serveur.php';
	$req= 'select IdentifiantPark,LibellePark from parking';
	$sql=$conn->query($req);
	$ligne= $sql->fetch();
	?>

<form method="post" action="reserver.php" autocomplete="off" target ="blank" >

<!-- Menu déroulant des parking -->

<div id="resv">
<p> Sélectionner un parking </p>

<select name="selectPark">	
<?php
$i=0;
while($ligne= $sql->fetch()) {
	echo '<option value='.$ligne[0].'>'.$ligne[1].'</option>'."\n" ;
	$i++;
}
?>
</select>

<!-- selection date début et fin -->

<p>De <input type="datetime-local" name="datedebut" <?php //echo "min=".date("Y-m-d-H:i");?> step="900"></p>
<p>  à : <input type="datetime-local" name="datefin" step="900"></p>
<p><input type="submit" value="Valider"></p>
</div>
</form> 

</div>


<footer>
<a href="contact.php" >contact</a> 
</footer>
</body>
</html>