<?php
include_once("../classes/its_mobile.php");
session_start();
$type = $_GET['type'];

$selectBrand = Its_Mobile::getAllMobileBrand($type);
for($i=0;$i<count($selectBrand);$i++)
{
		echo $selectBrand[$i]->getMobileBrand()."_";
}
	

?>