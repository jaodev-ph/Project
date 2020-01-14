<?php

include_once("../classes/pmmaintenance.php");

session_start();

	$name = $_GET['name'];
	$jobtype = $_GET['jobtype'];
	$typeid = $_GET['typeid'];
	$job = $_GET['job'];
	$seq = $_GET['seq'];


	$update = new Maintenance();
	$update->setmachinename($name);
	$update->setmachinetypeid($typeid);
	$update->setjobtype($jobtype);
	$update->setjobseq($seq);
	$update->setjoblist($job);
	
	
	$update->updateJobs();

echo 'success_'.$name."_".$jobtype."_".$job."_".$seq;



?>