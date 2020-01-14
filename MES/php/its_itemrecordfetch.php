<?php

include_once("../classes/its_additem.php");
session_start();

$mode =1;
		$itsget = new Its_Additem();
		//$itsget->setPCname($_GET['pcname']);


		$itsget->GetitemrecordsByserial($_GET['serial']);

		echo $itsget->getPCSerial()."_".$itsget->getSerial()."_".$itsget->getItemType()."_".$itsget->getItemBrand()."_".$itsget->getItemModel()."_".$itsget->getItemDesc()."_".$itsget->getStatus()."_".$itsget->getTrackingNo();
?>