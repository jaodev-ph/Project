<?php

include_once("../classes/pmmaintenance.php");
include_once("../classes/pmdetails.php");

session_start();

	$id = $_GET['pmid'];


$machine = Maintenance::getmachinejobid($id);

for($i=0;$i<count($machine);$i++){
echo $machine[$i]->getmachinename()."_".$machine[$i]->getjobtype()."_".$machine[$i]->getjoblist()."_".$machine[$i]->getjobseq()."_".$machine[$i]->getmachinetypeid()."&";
}

?>