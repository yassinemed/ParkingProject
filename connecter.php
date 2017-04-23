<?php
include 'connexion_serveur.php' ;

session_start();

if($mail=null or $mdp=null){
 	echo '<meta http-equiv="refresh" content="1; URL=connexion.php">';
 }
else{

$req = 'select * from client where mail="'.$_POST['mail'].'" and MotDePasse ="'.$_POST['mdp1'].'"' ;
	$sql=$conn->query($req);
	if($ligne= $sql->fetch()){

		$_SESSION['client']=array($_POST['mail'],$ligne['Nom'],$ligne['Prenom'],$ligne['PMR']);
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
	}
	else{
		echo '<meta http-equiv="refresh" content="0; URL=connexion.php">';
	}
	
	
}
?>