<?php
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$model = $_GET['model'];
	$lot = explode(" ",$_GET['lot']);

     $exist = LotNumber::referencelotcheckExist1($account,$lot[0]);

      $qty = LotNumber::getQty($account,$lot[0]);
		 
		if($exist == 'true'){

              echo 'lotexist_';

               }else{
                    
                    echo 'success_'.$lot[0]."_".$qty;
               }
			
?>