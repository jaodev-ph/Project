<?php

include_once("../classes/its_workstation.php");
session_start();

		$itsget = new Its_workstation();
		//$itsget->setPCname($_GET['pcname']);


		$itsget->getRecordMobile($_GET['IMEI']);
	

		echo $itsget->getIMEI()."_".$itsget->getTypes()."_".$itsget->getSimSerial()."_".$itsget->getMobileBrand()."_".$itsget->getMobileModel()."_".$itsget->getMobileNo()."_".$itsget->getMACadd()."_".$itsget->getDispatchTo()."_".$itsget->getCompany()."_".$itsget->getDepartment()."_".$itsget->getPurpose()."_".$itsget->getStatus()."_".$itsget->getAccno()."_".$itsget->getColor()."_".$itsget->getPlan()."_".$itsget->getAccessories()."_".$itsget->getPlanInclu();

		
?>