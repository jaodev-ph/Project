<?php
include_once("../classes/lotnumber.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	
	$lotno = explode(" ",$_GET['lotno']);
	$model = explode(" ",$_GET['model']);
	$qty	= $_GET["qty"];
	$station = explode(" ",$_GET['station']);
	$status = $_GET['status'];

	$exist = LotNumber::lotcheckExist($account,$lotno[0]);
			
			if($exist == 'true'){
				if($status == 'REJECT'){

$lot = new lotnumber($account,$lotno[0]);
$lot->setAccount($account);
$lot->setlotno($lotno[0]);
$lot->setstage($station[0]);
$lot->setstatus('GOOD');
$lot->setQuantity($qty);
$lot->setlastupdatedby($name);
$lot->updateLotSorting();

echo 'success_'.$lotno[0]."_".$model[0]."_".$qty."_".$station[0];
}else{
	echo 'lotreject_';
}
}else{					
	echo 'lotnotexist_'.$lotno[0];
			}
?>