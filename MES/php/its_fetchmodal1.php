<?php

include_once("../classes/its_workstation.php");
include_once("../classes/its_applications.php");
session_start();

$pcname = trim($_GET['pcname']);
    $itsget = new Its_Workstation();
    //$itsget1 = new Its_Pcitem();
    //$itsget->setPCname($_GET['pcname']);


    //$itsget->getRecord($_GET['pcname']);

    $itsget->getRecord($pcname);
    $pcapps = Its_Applications::getRecordPCApp1($pcname);
    //echo $pcname;


    for($a=0;$a<count($pcapps);$a++)
    {
      echo $itsget->getPCname()."_".$itsget->getIPaddress()."_".$itsget->getMACaddress()."_".$itsget->getModel()."_".$itsget->getOperatingSystem()."_".$itsget->getLicense()."_".$itsget->getStatus()."_".$itsget->getDispatchTo()."_".$itsget->getCompany()."_".$itsget->getDepartment()."_".$pcapps[$a]->getID()."_".$pcapps[$a]->getApps()."&";
          }
          
    echo $itsget->getPCname()."_".$itsget->getIPaddress()."_".$itsget->getMACaddress()."_".$itsget->getModel()."_".$itsget->getOperatingSystem()."_".$itsget->getLicense()."_".$itsget->getStatus()."_".$itsget->getDispatchTo()."_".$itsget->getCompany()."_".$itsget->getDepartment();

    

?>