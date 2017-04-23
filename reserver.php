<?php 
session_start() ;

?>
<?php
//fonction pour inscrire une réservation
function reserver($debut,$fin,$place,$client,$park,$prix){
	include 'connexion_serveur.php' ;
	$sql = "insert into reservation(DateDebut,DateFin,id_place,id_client,id_park,prix) values (".$debut.",".$fin.",".$place.",'".$client."',".$park.",".$prix.")";
	$conn->query($sql);
}
?>

<?php
echo $_POST['selectPark'] ;

$debut = date_format(date_create($_POST['datedebut']),'YmdHis') ;
$fin = date_format(date_create($_POST['datefin']),'YmdHis') ;

include 'connexion_serveur.php' ;

//place indisponibles car déjà occupés sur la plage horaire désirée
$req1 = "(select distinct(id_place) from reservation where id_park=".$_POST['selectPark']." and ((DateDebut<=".$debut." and DateFin>".$debut.") or (DateDebut<".$fin." and DateFin>".$fin.")))" ;






//place indisponibles car déjà occupés par un abonnement
$req4 = "(select distinct(id_place) from abonnement where id_park=".$_POST['selectPark']." and ((DateDebut<=".$debut." and DateFin>".$debut.") or (DateDebut<".$fin." and DateFin>".$fin.")))" ;








//place disponibles = places - places indisponibles
$req2 = "SELECT identifiantPlace from place WHERE IdentifiantPark =".$_POST['selectPark']." and PMR =".$_SESSION['client'][3]." and identifiantPlace not in".$req1 ;
$placesDicpo=$conn->query($req2);
$premierePlaceDispo= $placesDicpo->fetch();

//récupération prix du quart d'heure du parking
$req3 = "select * from parking where IdentifiantPark=".$_POST['selectPark'] ;
$infoParking=$conn->query($req3);
$infoParkingFetch= $infoParking->fetch();

//calcul du prix
$tps = strtotime($debut);
$tps2 =  strtotime($fin);

$nbQuartHeure = ($tps2-$tps)/60/15 ;
$prix = $nbQuartHeure * $infoParkingFetch[12] ;

reserver($debut,$fin,$premierePlaceDispo[0],$_SESSION['client'][0],$_POST['selectPark'],$prix);
echo '<meta http-equiv="refresh" content="0; URL=maPage.php">';

?>


