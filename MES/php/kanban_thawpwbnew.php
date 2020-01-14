<?php
include_once("../classes/kanban_partsrecords.php");
include_once("../classes/kanban_thawpwb.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	

	$did =  $_GET['DID'];



	$exist = Partsrecords::didCheck($account, strtoupper($did));


	if ($exist == 'true'){



			$Partsrecords = new Partsrecords();
			 $new_time = Partsrecords::StartTime();
			 $Partsrecords->didInfo($did);
			 $Thawbake = new Thawbake();
			 $Thawbake->setAccount($account);
			 $Thawbake->setModule($_SESSION['module']);
			 $Thawbake->setType($Partsrecords->getCompotype());
			 $Thawbake->setMaker($Partsrecords->getMaker());
			 $Thawbake->SelectThawHours();
		
			if($Partsrecords->getThawdate() == '1900-01-01' || $Partsrecords->getThawdate() == '2000-01-01')
			{

			
 			if($Thawbake->getHours() == "0" && $Partsrecords->getCompotype() == 'P-PWB'){
 				echo "nohours";
 				}else{

				
					if($Partsrecords->getCompotype() == 'SP-Solder Paste' || $Partsrecords->getCompotype() == 'NM-NAMICS'){
					$new_time2 = date('Y-m-d h:i:s a',strtotime('+2 hours',strtotime($new_time)));
					}else if($account == 'C9' && $Partsrecords->getCompotype() == 'SP-Solder Paste' || $account == 'C9' && $Partsrecords->getCompotype() == 'NM-NAMICS'){
					$new_time2 = date('Y-m-d h:i:s a',strtotime('+4 hours',strtotime($new_time)));
					}else if($Partsrecords->getCompotype() == 'P-PWB'){
					$new_time2 = date('Y-m-d h:i:s a',strtotime('+'.$Thawbake->getHours().' hours',strtotime($new_time))); 	
					}


			
			echo 'ok_'.$Partsrecords->getPartno()."_".$Partsrecords->getIPN()."_".$Partsrecords->getDescription()."_".$Partsrecords->getMaker()."_".$Partsrecords->getMakercode()."_".$Partsrecords->getLotno()."_".$Partsrecords->getCompotype()."_".$Partsrecords->getQty()."_".$Partsrecords->getStatus()."_".$Partsrecords->getPrintedby()."_".$Partsrecords->getInvoiceno()."_".$Partsrecords->getLine()."_".$new_time2."_".$new_time;
		
			}
		 }else{
			echo "alreadyscan";
		 }
	}else{
		echo "notok";
	}


			
	
?>