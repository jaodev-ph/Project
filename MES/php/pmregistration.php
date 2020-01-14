<?php
include_once("../classes/pmregistration.php");
include_once("../classes/pmdetails.php");

session_start();

$date = date("mdyhis");
/*$id1 = "PM-$date";*/
$id= $_GET['jobOrder'];
$lineid= $_GET['line'];
$jobtype= $_GET['jobType'];
$datestart= $_GET['dateStart'];
$dateend= $_GET['dateEnd'];
$timestart= $_GET['timeStart'];
$timeend= $_GET['timeEnd'];
$status= $_GET['status'];


$registration = new Registration();
$registration->setjobOrder($id);
$registration->setproductionLineId($lineid);
$registration->setjobType($jobtype);
$registration->setdateStart($datestart);
$registration->setdateEnd($dateend);
$registration->settimeStart($timestart);
$registration->settimeEnd($timeend);
$registration->setplannedBy($_SESSION['name']);
$registration->setstatus($status);

$registration->addschedule();
$registration->schedulelogs();

$machine = Machine::getmachinechecklist($lineid,$jobtype);
for($i=0;$i<count($machine);$i++){
$machine[$i]->getproductionlineid();
$machine[$i]->getjobtype();
$machine[$i]->getname();
$machine[$i]->getmachineid();
$machine[$i]->getmachinetypeid();
$machine[$i]->getseq();
$machine[$i]->getjoblist();
$machine[$i]->getjobsequence();

$checklist = new Registration();
$checklist->setjobOrder($id);
$checklist->setproductionLineId($lineid);
$checklist->setjobType($jobtype);
$checklist->setname($machine[$i]->getname());
$checklist->setmachineId($machine[$i]->getmachineId());
$checklist->setmachineTypeId($machine[$i]->getmachineTypeId());
$checklist->setmachinesequence($machine[$i]->getseq());
$checklist->setjoblists($machine[$i]->getjoblist());
$checklist->setjobSequence($machine[$i]->getjobSequence());

$checklist->machinechecklist();
}




echo 'Success_'.$id;

?>
