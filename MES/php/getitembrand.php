<?php

include_once("../classes/its_brandmodel.php");
session_start();

	$type = $_GET['type'];

	$select = Its_Brandmodel::selectTypeModel($type);
	for($i=0; $i < count($select);$i++)
	{
		echo $select[$i]->getBrand()."_";
	}
?>