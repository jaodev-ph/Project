<?php
include_once("../classes/cardlink_check.php");
session_start();


$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$serial1_model = $_GET['model1'];
$result = "";

$model = new Check;
$model2 = Check::getAllmodellink($account,$serial1_model); 

	for($i=0;$i<count($model2);$i++){
		
		$result .= $model2[$i]->getserial2_model()."_";
	}

	echo $result;


?> 