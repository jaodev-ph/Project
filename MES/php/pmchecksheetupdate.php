<?php 
include_once("../classes/pmchecklist.php");

session_start();
$name = $_SESSION['name'];


   

$joborder = $_GET['joborder'];
$machineid = $_GET['machineid'];
$jobtype = $_GET['jobtype'];

$txtsequence = json_decode($_GET['txtsequence']);
$txtjoblist = json_decode($_GET['txtjoblist']);
$check = json_decode($_GET['check']);
$notcheck = json_decode($_GET['notcheck']);
$replace = json_decode($_GET['replace']);
$Remarks = json_decode($_GET['Remarks']);

/*
  for($i=0; $i<=count($txtsequence);$i++) {
    if(!empty($check[$i])) {
    	for($x=0;$x<=count($txtsequence);$x++) {  

        	if($check[$i] == "1".$x) {*/


	for($i=0;$i<count($txtsequence);$i++){

$abc = new Checklist();
$abc->setjobOrder($joborder);
$abc->setmachineId($machineid);
$abc->setjobSequence($txtsequence[$i]);
$abc->setstatus('1');
$abc->setremarks($Remarks[$i]);
$abc->setflag($replace[$i]);
$abc->setperformedBy($name);
$abc->updatechecksheet();

echo 'success_';

}

/*			}
		}
	}
}*/
	


//echo $joborder."_".$machineid."_".$jobtype;
?>