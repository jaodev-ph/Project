<?php

include_once("../classes/its_workstation.php");
session_start();

		$itsget = new Its_Workstation();
		//$itsget->setPCname($_GET['pcname']);


		echo $itsget->getworkstationcount($_GET['comp'],$_GET['type']);
?>