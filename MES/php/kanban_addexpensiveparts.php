<?php
include_once("../classes/kanban_expensiveparts.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$model = $_GET['Model'];
	$rev = $_GET['Rev'];
	$type = $_GET['Type'];
	$location = $_GET['Location'];
	$partno = $_GET['Partno'];


	$exist = Expensiveparts::checkExpensiveparts($model, $rev);	

		if ($exist == 'false') {
				$parts = new Expensiveparts;
				$parts->setModel($model);
				$parts->setRevision($rev);
				$parts->setType($type);
				$parts->setLocation($location);
				$parts->setPartno($partno);
				$parts->addExpensiveParts();
				echo 'ok';
			} else {
				echo 'notok';
			}	
			
	
?>