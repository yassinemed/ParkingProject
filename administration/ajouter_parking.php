<?php

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


include 'connexion_serveur.php';

session_start();


if(empty($nom) || empty($type) || empty($pro) || empty($adr) || empty($lien) || empty($surface) || empty($niveau) || empty($placetot) || empty($placepub) || empty($placeres) || empty($placepmr) || empty($prixj) || empty($prixn)){

		echo '<meta http-equiv="refresh" content="0; URL=ajouter_parking.html">';	
	}
else{

	$req= "insert into parking(LibellePark,TypePark,Propriataire,Adresse,lien,Surface,NbrNiveau,PlaceTotal,PlacePublique,PlaceRes,PlacePMR,PrixQuartHeure_Jour,PrixQuartHeure_Nuit) values ('$nom','$type','$pro','$adr','$lien',$surface,$niveau,$placetot,$placepub,$placeres,$placepmr,$prixj,$prixn)";

	$conn->exec($req);
}

?>
