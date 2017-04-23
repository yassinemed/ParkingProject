<?php

	$park = $_POST['park'];

	session_start();

	include 'connexion_serveur.php';

	$req = "Delete from parking where IdentifiantPark=".$park;
	$conn->exec($req);

}