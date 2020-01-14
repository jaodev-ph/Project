<?php

include_once("../classes/lotnumber.php");

session_start();


	$account = trim($_SESSION['account']);
	$reference = trim($_GET['reference']);
	$lotno = trim($_GET['lotno']);
	

	$lot= Lotnumber::referencelotcheckExist($account,$lotno,$reference);
	
if ($lot == 'true'){
	 	
	 $lotbatchexist = Lotnumber::referencebatchcheckExist($account,$reference);	
	 $lotcardexist = Lotnumber::referencecardcheckExist($account,$reference);

	 if ($lotbatchexist == 'true'){

	 	echo 'true_';

	 }else{

	 	echo 'false_';

	 }

	}else{

		echo 'lotnotexist_';

	}

?>