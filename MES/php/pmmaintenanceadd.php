<?php

include_once("../classes/pmmaintenance.php");

session_start();

	$name = $_GET['name'];
	$jobtype = $_GET['jobtype'];
	$typeid = $_GET['typeid'];
	$job = $_GET['job'];
	$seq = $_GET['seq'];
	$active = $_GET['active'];

	$add = new Maintenance();
	$add->setmachinename($name);
	$add->setmachinetypeid($typeid);
	$add->setjobtype($jobtype);
	$add->setjoblist($job);
	$add->setjobseq($seq);
	$add->setactive($active);
	$add->add();

echo 'succes_'.$name."_".$jobtype."_".$job."_".$seq;



?>