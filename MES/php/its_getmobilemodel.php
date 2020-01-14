<?php

include_once("../classes/its_mobile.php");
session_start();

	$brand = $_GET['brand'];
	$MobileType =$_GET['MobileType'];

	$select = Its_Mobile::selectMobileBrandModel($brand,$MobileType);
	$getModelDesc = Its_Mobile::selectMobileBrandModelID($select);
	
	for($i=0; $i < count($getModelDesc);$i++)
	{
		echo $getModelDesc[$i]->getMobileModel()."_";
	}
?>