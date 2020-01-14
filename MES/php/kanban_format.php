<?php
include_once("../classes/kanban_format.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$value = strtoupper($_GET['value']);
	$type = $_GET['type'];
	

	$kanbanFormat = Kanban_Format::SelectKanbanFormat(trim($account),$type);
	
	$sub_format = substr($value,intval($kanbanFormat[0]->getStart()),intval($kanbanFormat[0]->getLast()));
		if($kanbanFormat[0]->getAllowFormat() == 0){
		$proceed = true;
	
	}else{
		if($kanbanFormat[0]->getValue() == $sub_format)
		{
		$proceed = true;
		}else{
		$proceed = false;
		}
	}

	if(strlen($value) == $kanbanFormat[0]->getSerialLength()){

		if($proceed  == true)
		{
			
			echo 'success_';
				
		}else{
			echo 'error3_'.$_GET['value'];
		}
	}else{
		echo 'error3_'.$_GET['value'];
	}
	

			


?>