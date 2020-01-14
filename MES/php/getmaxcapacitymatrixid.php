<?php
include_once("../classes/capacitymatrix1.php");

session_start();

	$name = $_SESSION['name'];
	
	
	$id = CapacityMatrix::SelectMaxid();
	


	echo $id;

?>