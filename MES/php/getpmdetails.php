<?php

include_once("../classes/pmdetails.php");

session_start();

	$lineid = $_GET['lineid'];
	$jobtypeid = $_GET['jobtypeid'];

$machine = Machine::getmachinechecklist($lineid,$jobtypeid);
for($i=0;$i<count($machine);$i++){
echo $machine[$i]->getproductionlineid()."_".$machine[$i]->getjobtype()."_".$machine[$i]->getname()."_".$machine[$i]->getmachineid()."_".$machine[$i]->getmachinetypeid()."_".$machine[$i]->getseq()."_".$machine[$i]->getjoblist()."_".$machine[$i]->getjobsequence()."&";
}

?>