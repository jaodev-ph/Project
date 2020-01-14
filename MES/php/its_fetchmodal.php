<?php

include_once("../classes/its_workstation.php");
include_once("../classes/its_pcitem.php");
session_start();

$pcname = trim($_GET['pcname']);
		$itsget = new Its_Workstation();
		//$itsget1 = new Its_Pcitem();
		//$itsget->setPCname($_GET['pcname']);


		//$itsget->getRecord($_GET['pcname']);

		$itsget->getRecord($pcname);
		$pcrecord = Its_Pcitem::getPCRecordItem1($pcname);
		//echo $pcname;
	

		     for($x=0;$x<count($pcrecord);$x++){
	
          echo $itsget->getPCname()."_".$itsget->getIPaddress()."_".$itsget->getMACaddress()."_".$itsget->getModel()."_".$itsget->getOperatingSystem()."_".$itsget->getLicense()."_".$itsget->getStatus()."_".$itsget->getDispatchTo()."_".$itsget->getCompany()."_".$itsget->getDepartment()."_".$pcrecord[$x]->getSerial()."_".$pcrecord[$x]->getItem()."&";
          }
          
		echo $itsget->getPCname()."_".$itsget->getIPaddress()."_".$itsget->getMACaddress()."_".$itsget->getModel()."_".$itsget->getOperatingSystem()."_".$itsget->getLicense()."_".$itsget->getStatus()."_".$itsget->getDispatchTo()."_".$itsget->getCompany()."_".$itsget->getDepartment();

		

?>