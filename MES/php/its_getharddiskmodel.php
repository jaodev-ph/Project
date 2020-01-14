<?php

include_once("../classes/its_brandmodel.php");
session_start();

	$harddisk = $_GET['harddisk'];
	$type = $_GET['type'];

	$select = Its_Brandmodel::selectBrandModelType($harddisk,$type);
	$getModelDesc = Its_Brandmodel::selectBrandModelID($select);
	
	for($i=0; $i < count($getModelDesc);$i++)
	{
		echo $getModelDesc[$i]->getModel()."_";
	}
?>