<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
include_once("../classes/mothermatrix.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$model = explode(" ",$_GET['model']);
	$Serial = new Card($account,$serialno[0]);

	$proceed = false;
	
	
	$SerialFormat = SerialFormat::SelectSerialFormatValuegetModel(trim($account),$serialno[0]);

	$countchild = MotherMatrix::getCountChild($account,$model[0]);
	
	$sub_serial = substr($serialno[0],intval($SerialFormat[0]->getStart()),intval($SerialFormat[0]->getLast()));
	


$selectchildmodel = Model::getchildmodel($account,$model[0],$SerialFormat[0]->getModelNo());


	if($SerialFormat[0]->getAllowFormat() == 0){
		$proceed =true;
	
	}else{
		if($SerialFormat[0]->getValue() == $sub_serial)
		{
		$proceed = true;
		}else{
		$proceed = false;
		}
	}

	if(strlen($serialno[0]) == $SerialFormat[0]->getSerialLength()){

		if($proceed  == true)
		{
			$exist = Card::checkExist($account,$serialno[0]);

			if($exist == 'true'){

				echo 'error1_'.$_GET['serialno'];

			}else if ($selectchildmodel1 == 'true'){

					echo 'success_'.$serialno[0]."_"."GOOD"."_".$SerialFormat[0]->getModelNo()."_".$countchild."_".$selectchildmodel;
				}else{
		
			echo 'error4_'.$SerialFormat[0]->getModelNo()."_".$selectchildmodel;
			}	
		}else{
			echo 'error2_'.$_GET['serialno'];
		}
	}else{
		echo 'error3_'.$_GET['serialno'];
	}
	
	
	



			





?>