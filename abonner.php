<?php 
session_start() ;
?>
<?php
//fonction pour inscrire un abonnement
function abonner($debut,$fin,$place,$client,$offre){
	include 'connexion_serveur.php' ;
	$sql = "insert into abonnement(DateDeb,DateFin,id_place,id_client,id_offre) values (".$debut.",".$fin.",".$place.",'".$client."',".$offre.")";
	$conn->query($sql);
}
?>

<?php

//recupération données offreAbonnement
include 'connexion_serveur.php' ;
$req1 = "select * from offresabonnement where IdentifiantOffre = ".$_POST['abo'] ;
$BDoffre=$conn->query($req1);
$offre= $BDoffre->fetch();

//abonnement commence au moment de l'achat
$debut = date_format(new DateTime("now", new DateTimeZone('Europe/Paris')),'YmdHis');
$fin = date('YmdHis', strtotime($debut.' + '.$offre[4].'days'));


//place indisponibles car déjà occupés sur la plage horaire désirée
$req1 = "(select distinct(id_place) from reservation where reservation.id_park=".$_POST['parking']." and ((DateDebut<=".$debut." and DateFin>".$debut.") or (DateDebut<".$fin." and DateFin>".$fin.")))" ;

//place indisponibles car déjà occupés par un abonnement
$req4 = "(select distinct(id_place) from abonnement, place where abonnement.id_place = place.IdentifiantPlace and place.IdentifiantPark=".$_POST['parking']." and ((DateDeb<=".$debut." and DateFin>".$debut.") or (DateDeb<".$fin." and DateFin>".$fin.")))" ;

//place disponibles = places - places indisponibles
$req2 = "SELECT identifiantPlace from place WHERE IdentifiantPark =".$_POST['parking']." and PMR =".$_SESSION['client'][3]." and identifiantPlace not in".$req1. "and identifiantPlace not in ".$req4 ;
$placesDicpo=$conn->query($req2);
$premierePlaceDispo= $placesDicpo->fetch();

//abonnement
abonner($debut,$fin,$premierePlaceDispo[0],$_SESSION['client'][0],$_POST['abo']);
echo '<meta http-equiv="refresh" content="0; URL=maPage.php">';
?>


