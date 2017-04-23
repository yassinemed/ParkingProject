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

<div id="cadre">
<h1>Abonnement</h1>

<?php

	include('connexion_serveur.php');

	$req= 'select offresabonnement.IdentifiantPark ,parking.LibellePark FROM offresabonnement,parking WHERE offresabonnement.IdentifiantPark=parking.IdentifiantPark GROUP by offresabonnement.IdentifiantPark';
	$sql=$conn->query($req);
	?>
<p>Sélectionner un Parking : </p>
	<form method="post" action="abonnement.php" name="form2">
	<select OnChange="document.form2.submit();"name="parking">
	

	<?php
	while($ligne= $sql->fetch()) {
	?>

	<option value="<?php echo $ligne[0];?>"><?php echo $ligne[1];?></option>

	<?php
	}
	?>

	</select>
	</form>
<br>
<br>
		<?php
		if(isset($_POST['parking'])){
		$req1= 'select * from offresabonnement where IdentifiantPark="'.$_POST['parking'].'"';
		$sql1=$conn->query($req1);

		echo '<form action="abonner.php" method="post">';
		echo '<table class="tab">';
		echo '<tr>';
		echo '<th>Abonnement</th><th>prix</th><th>choix</th>';

		while($ligne1=$sql1->fetch()){

		echo '<tr>';
		echo'<td>'.$ligne1[2].'</td><td>'.$ligne1[3].' €</td><td><input type="radio" name="abo" value="'.$ligne1[0].'"></td>';
		}
		echo '</table><br>';
		echo "<input type='hidden' name ='parking' value=".$_POST['parking'].">";
		echo '<input type="submit" value="Choisir">';

	}

	?>

	
	</form>
</div>
<footer>
<a href="contact.php" >contact</a> 
</footer>
</body>
</html>
