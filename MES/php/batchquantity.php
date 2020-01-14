<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
session_start();


	$account = trim($_SESSION['account']);
	$modelno = $_GET['modelno'];

	$Model = new Model($account,$modelno);
	echo $Model->getBatch()."_".$Model->getModelFamily();


?>