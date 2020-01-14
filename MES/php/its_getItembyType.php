<?php
include_once('../classes/its_additem.php');
session_start();

$type = $_GET['type'];

$itemtype = Its_Additem::getItembyType($type);

for($i=0;$i<count($itemtype);$i++){

   		echo $itemtype[$i]->getSerial().":".$itemtype[$i]->getItemModel().":".$itemtype[$i]->getItemBrand()."_";

}









?>