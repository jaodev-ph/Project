<?php
include_once("../classes/pmdetails.php");

session_start();

$line = $_GET['line'];

$name = $_GET['name'];

$machine = Machine::SelectMachinedetails($line,$name);
/*$machineid = $machine->getmachineid();
$machinetypeid = $machine->getmachinetypeid();*/

echo $machine[0]->getmachineid()."_".$machine[0]->getmachinetypeid();

?>