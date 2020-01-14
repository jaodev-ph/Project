<?php
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$lotno = $_GET['lotno'];
	$reference = $_GET['reference'];
	$model = $_GET['model'];
	$station = explode(":",$_GET['station']);
	$RQuantity = $_GET['RQuantity'];

	$proceed = false;
	

	$SerialFormat = SerialFormat::SelectlotFormat(trim($account),$model);
	
	$sub_serial = substr($lotno,intval($SerialFormat[0]->getStart()),intval($SerialFormat[0]->getLast()));
	
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

	if(strlen($lotno) == $SerialFormat[0]->getSerialLength()){

		if($proceed  == true)
		{
			/*$exist = LotNumber::referencelotcheckExist($account,$lotno,$reference);
		
			if($exist == 'true'){*/
 				$lotnumber = new LotNumber($account,$lotno);
	
                  $lotreg = LotNumber::getAllLotandReference($account,$lotno,$reference);

             /*     if($lotreg->getExist()){*/

                  /*  $found=true;*/
                    $lotcount = Batch::getAllSerialByLotRef($account,$lotno,$reference);

                 /*   if(count($lotcount)!=120){*/

             /*          $lotMax = false;*/
                       $mdate = date('n');
                    /*   $splitted = explode('|',$partcode);*/
                       $seq = LotNumber::getSeq($account,$modelno);
                     /*  $station = trim($splitted[3]);*/

                       if($mdate>9){
                         if($mdate==10){
                           $mdate = 'X';
                         }else if($mdate==11){
                           $mdate = 'Y';
                         }else if($mdate==12){
                           $mdate = 'Z';
                         }
                       }

                      $t = microtime(true);
                      $micro = sprintf("%06d",($t - floor($t)) * 1000000);
                      $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
                      $reference = 'V'.'IONPCA'.date('y').$mdate.date('dhis').substr($d->format("u"),0,3); $disabledReference = '';
             

              /*      }else{
                      $lotMax = true;
                    }*/
/*
                  }else{
                    $found = false;

                  }*/

              
			/*}else{				
				
					
			}*/
echo 'true_';
		}else{
			echo 'error2_'.$_GET['lotno'];
		}
	}else{
		echo 'error1_'.$_GET['lotno'];
	}
	

			


?>