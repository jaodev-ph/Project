<?php

include_once("../classes/its_brandmodel.php");
session_start();

	$monitor = $_GET['monitor'];

	$select = Its_Brandmodel::selectBrandModel($monitor);
	$getModelDesc = Its_Brandmodel::selectBrandModelID($select);
	
	for($i=0; $i < count($getModelDesc);$i++)
	{
		echo $getModelDesc[$i]->getModel()."_";
	}
?>