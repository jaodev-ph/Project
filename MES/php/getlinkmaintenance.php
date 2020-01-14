<?php

include_once("../classes/linking.php");

session_start();

$account = trim($_SESSION['account']);
$modelno = $_GET['modelno'];
$fullstation = explode(":",$_GET['station']);
$station = $fullstation[0];

$link = Link2::GetLinkDetails2($account,$modelno,$station,'station');

	for($i=0;$i<count($link);$i++){

echo $link[$i]->getSequence()."_".''."_".$link[$i]->getPartNo()."_".''."_".$link[$i]->getMaxQty()."&";
}


?>