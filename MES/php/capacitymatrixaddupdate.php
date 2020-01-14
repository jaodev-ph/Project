<?php

include_once("../classes/capacitymatrix1.php");

session_start();

$name = $_SESSION['name'];


$id = $_GET['id'];
$lineid = $_GET['lineid'];
$vendor = $_GET['vendor'];
$model = $_GET['model'];
$side = $_GET['side'];
$uph = $_GET['uph'];
$multiplier = $_GET['multiplier'];
$remarks = $_GET['remarks'];
$mode = $_GET['mode'];
$message ="All Field are Required!";
$mode=0;








if($id == ''){
	$mode = 0;
}
else
{
	$mode=1;
}
	
		if ($mode == 0) {
		
			$add = new CapacityMatrix();
			$add->setLineID($lineid);
			$add->setModel($model);
			$add->setSide($side);
			$add->setUph($uph);
			$add->setVendor($vendor);
			$add->setMultiplier($multiplier);
			$add->setRemarks($remarks);
			$add->setUpdatedBy($name); 
			$add->addCapacityMatrix();
		
		


			}elseif ($mode == 1){

			$update = new CapacityMatrix();
			$update->update($id,$lineid,$model,$side,$uph,$vendor,$multiplier,$remarks,$name);

	
			}
	
		


	


?>
