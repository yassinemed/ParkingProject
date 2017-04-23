<?php 

include('connexion.php');

$idpark = $_GET['id_park'];

$sql=$conn->query('select * from parking where identifiantPark='.$idpark);

$res= $sql->fetch();

echo "<html>";
echo "<head>";
echo "<meta http-equiv="."Content-Type"." content="."text/html; charset=UTF-8"."/>";
echo $res['lien'];
echo "</html>";
echo "</head>";

?>
