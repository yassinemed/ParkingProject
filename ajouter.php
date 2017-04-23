<?php 
	
	session_start();


	$idabo= $_POST['abo'];
	$idclient= $_SESSION['client'][0];

	include('connexion_serveur.php');

	if(!isset($_SESSION['panier'])){

		$_SESSION['panier'] = array();
	}

	array_push($_SESSION['panier'], $idabo);
	
	echo '<meta http-equiv="refresh" content="0; URL=panier.php">';
?>
