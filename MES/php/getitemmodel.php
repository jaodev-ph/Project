<?php

include_once("../classes/its_brandmodel.php");
session_start();

	$brand = $_GET['brand'];
	$type1 = $_GET['type'];

	$select = Its_Brandmodel::selectBrandModelType($brand,$type1);
	$getModelDesc = Its_Brandmodel::selectBrandModelID($select);
	
	for($i=0; $i < count($getModelDesc);$i++)
	{
		echo $getModelDesc[$i]->getModel()."_";
	}
?>