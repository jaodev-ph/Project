<?php

include_once("../classes/partcode.php");

session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$partcode = trim($_GET['partcode']);
$description = $_GET['description'];
$model = $_GET['model'];
$modelfamily = $_GET['modelfamily'];
$remarks = $_GET['remarks'];
$activemode = $_GET['active'];
$mode = $_GET['mode'];

  if($activemode == 'true'){
        $active = 1;
    }else{
        $active = 0;
    }


if ($mode == 0) {

$add = new Partcode();
$add->setAccount($account);
$add->setPartcode($partcode);
$add->setDescription($description);
$add->setModel($model);
$add->setModelFamily($modelfamily);
$add->setRemarks($remarks);
$add->setLastupdatedBy($name);
$add->setActive($active);    
  
$add->addPartcode();


}elseif ($mode == 1){

$update = new Partcode();
	$update->setAccount($account);
	$update->setPartcode($partcode);
	$update->setDescription($description);
	$update->setModel($model);
	$update->setModelFamily($modelfamily);
	$update->setRemarks($remarks);
	$update->setActive($active);
	$update->setLastUpdatedBy($name);
	$update->setActive($active);    		

    $update->Updatepartcode();

}
echo 'success_'.$partcode."_".$active."_".$mode;

?>