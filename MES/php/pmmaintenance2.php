<?php

include_once("../classes/pmmaintenance.php");

session_start();

	$name = $_GET['name'];
	$jobtype = $_GET['jobtype'];
	$type = new Maintenance;
	$type->setmachinename($name);	
	$type->getmachinetype();

	$val="";

	$sequence = Maintenance::getsequence($name,$jobtype);
/*	$getmaxsequence = Maintenance::getmaxsequence($name,$jobtype);*/

for($i=0;$i<count($sequence);$i++){
	$val.=$sequence[$i]->getjobseq()."_";
}

	echo 'success_'.$name."_".$jobtype."_".$type->getmachinetypeid()."_&".$val;


?>