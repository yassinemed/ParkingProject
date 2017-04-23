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



</body>
</html> 
