<?php 
session_start() ;
?>

<!DOCTYPE html>
<html>
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
 	<link rel="stylesheet"	href="CSS/style.css"	type="text/css"	media="screen"	/>	

 	<title>PANIER</title>
 
</head>

<body>

<ul class="topnav" id="myTopnav">
<li><a href="index.php" ><img src="IMG/LOGO.png"> </a> </li>
<li><a href="info.php">Info</a></li>
<li><a href="abonnement.php">Abonnement</a></li>
<li><a href="reservation.php">Réservation</a></li>
<?php
if (!isset($_SESSION['client'])){
	echo "<li><a href='connexion.html'>Connexion <br> Inscription</a></li>" ;
}
?>
   
<?php
if (isset($_SESSION['client'])){
	echo "<li><a href='deconnexion.php'>Se deconnecter</a></li><li id='small'><a href='maPage.php'>MonCompte<br>( ".$_SESSION['client'][2]." ".$_SESSION['client'][1]." )</a></li>" ;
}
?>
   
   
</ul>

<div id="cadre">
<h1>Mon Panier</h1>

<?php

	include 'connexion_serveur.php';
	
		if(isset($_SESSION['panier'])){

		echo '<table class="tab">';
		echo '<tr>';
		$Total =0;

		foreach ($_SESSION['panier'] as $art){

			$req= 'select * from offresabonnement where IdentifiantOffre="'.$art.'"';
			$sql = $conn->query($req);
			$ligne = $sql->fetch();
			$Total = $Total + $ligne['Prix'];

		echo '<tr>';
		echo'<td>'.$ligne['Libelle'].'</td><td>'.$ligne['Prix'].'</td></tr>';
		}
	echo '</table><br>';
	echo '<p align="right"><font size="4"><b>Montant à payer : </b></font><b>'.$Total.' €</b></p><br>';
	}
?>

</div>
</body>
</html>