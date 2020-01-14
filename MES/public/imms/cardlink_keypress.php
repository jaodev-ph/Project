<?php
include_once("../classes/card.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serial1']);
	$Serial = new Card($account,$serialno[0]);
	$exist = Card::checkExist($account,$serialno[0]);

		if($exist == 'true'){

			echo 'ok_'.'duane';
		}
			
		

?>