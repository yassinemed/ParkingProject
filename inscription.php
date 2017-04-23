<?php 
session_start() ;

	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$adr = $_POST['adresse'];
	$mail = $_POST['mail'];
	$mdp1 = $_POST['mdp1'];
	$mdp2 = $_POST['mdp2'];
	$tel = $_POST['telephone'];
	$pmr = $_POST['pmr'];
	$abo = 0;
	$admin = 0;

	include 'connexion_serveur.php';


	if(empty($nom) || empty($prenom) || empty($adr) || empty($tel) || empty($mail) || empty($mdp1) || empty($mdp2) || is_null($pmr) || ($mdp1 != $mdp2)){
		echo '<meta http-equiv="refresh" content="0; URL=connexion.html">';	
	}
	
	else{
		$sql = "insert into client(Nom,Prenom,Adresse,mail,MotDePasse,Telephone,PMR,Abonne,admin) values ('$nom','$prenom','$adr','$mail','$mdp1','$tel',$pmr,$abo,$admin)";
		$conn->exec($sql);
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';	
		$_SESSION['client']=array($mail,$nom,$prenom,$pmr);
	}
	

?>