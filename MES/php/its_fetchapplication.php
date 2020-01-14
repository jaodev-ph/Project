<?php 

include_once("../classes/its_workstation.php");
session_start();


 $apps = new its_workstation();

 $apps->getAppByPC($_GET['PCserial']); 

 echo $apps->getApplications();
 

?>