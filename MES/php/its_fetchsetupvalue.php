<?php 

include_once("../classes/Its_Additem.php");
session_start();


 $itemserial = Its_Additem::getpcitemsByPC($_GET['PCserial']);

 for($i=0; $i <count($itemserial); $i++){

 	echo $itemserial[$i]->getPCSerial().",".$itemserial[$i]->getItemType()."_";

 }



?>