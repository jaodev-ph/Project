<?php

include_once("../classes/its_workstation.php");
session_start();

		$itsget = new Its_workstation();
		//$itsget->setPCname($_GET['pcname']);


		$itsget->getworkstationvalue($_GET['PCserial']);
	

	echo $itsget->getPCname()."_".$itsget->getIPaddress()."_".$itsget->getMACaddress()."_".$itsget->getOperatingSystem()."_".$itsget->getLicense()."_".$itsget->getStatus()."_".$itsget->getDispatchTo()."_".$itsget->getCompany()."_".$itsget->getDepartment()."_".$itsget->getType()."_".$itsget->getStatus()."_".$itsget->getTag()."_".$itsget->getModel();

		
?>