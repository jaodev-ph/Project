<?php 
include_once("../classes/pmchecklist.php");

session_start();

$joborder = $_GET['joborder'];
$machineid = $_GET['machineid'];
$jobtype = $_GET['jobtype'];
$sheet = "";

$checksheet = Checklist::getChecksheet($joborder,$machineid,$jobtype);

for($i=0;$i<count($checksheet);$i++){


$sheet .= $checksheet[$i]->getjobSequence()."_".$checksheet[$i]->getjobLists()."_".$checksheet[$i]->getStatus()."_".$checksheet[$i]->getflag()."&";


}
echo $sheet;


?>