<?php

include_once("../classes/its_additem.php");
session_start();

		$itsget = new Its_Additem();
		//$itsget->setPCname($_GET['pcname']);


		echo $itsget->countitems();
?>