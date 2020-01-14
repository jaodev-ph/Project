<?php

include_once("../classes/ifactory_machinedetails.php");

session_start();

$name = $_SESSION['name'];

$machineid = $_GET['machineid'];
$machinename = $_GET['machinename'];
$type = $_GET['type'];
$modelno = $_GET['modelno'];
$serialno = $_GET['serialno'];
$controlno = $_GET['controlno'];
$assetno = $_GET['assetno'];
$ionicsid = $_GET['ionicsid'];
$manufacturer = $_GET['manufacturer'];
$activemode = $_GET['active'];
$mode = $_GET['mode'];

  if($activemode == 'true'){
        $active = 1;
    }else{
        $active = 0;
    }


if ($mode == 0) {

$add = new machinedetails();

$add->setmachine($machinename);
$add->setmachineid($machineid);
$add->setconfigurationtype($type);
$add->setmodelnumber($modelno);
$add->setserialnumber($serialno);
$add->setcontrolnumber($controlno);
$add->setassetnumber($assetno);
$add->setionicsid($ionicsid);
$add->setmanufacturer($manufacturer);
$add->setlastupdatedby($name);
$add->setactive($active);    
  
$add->addMachineDetails();

echo 'insert_';

}elseif ($mode == 1){

$update = new machinedetails();

$update->setmachineid($machineid);
$update->setconfigurationtype($type);
$update->setmodelnumber($modelno);
$update->setserialnumber($serialno);
$update->setcontrolnumber($controlno);
$update->setassetnumber($assetno);
$update->setionicsid($ionicsid);
$update->setmanufacturer($manufacturer);
$update->setlastupdatedby($name);
$update->setactive($active);    
   		

 $update->UpdateMachineDetails();

echo 'update_';
}
//echo 'success_';

?>