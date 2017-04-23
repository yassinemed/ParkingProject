<?php

$park = $_POST['park'];

$nom = $_POST['nom'];
$type = $_POST['type'];
$pro = $_POST['pro'];
$adr = $_POST['adr'];
$lien = $_POST['lien'];
$surface = $_POST['surface'];
$niveau = $_POST['niveau'];
$placetot = $_POST['placetot'];
$placepub = $_POST['placepub'];
$placeres = $_POST['placeres'];
$placepmr = $_POST['placepmr'];
$prixj = $_POST['prixj'];
$prixn = $_POST['prixn'];

	session_start();

	include 'connexion_serveur.php';

	$req = "update parking set LibellePark='$nom' ,TypePark='$type' ,Propriataire ='$pro' ,Adresse='$adr' ,lien='$lien' ,Surface=$surface ,NbrNiveau=$niveau ,PlaceTotal=$placetot ,PlacePublique=$placepub ,PlaceRes=$placeres ,PlacePMR=$placepmr ,PrixQuartHeure_Jour=$prixj ,PrixQuartHeure_Nuit=$prixn where IdentifiantPark=".$park;

	$conn->exec($req);

?>