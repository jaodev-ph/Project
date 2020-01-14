<?php
include_once("../classes/test2.php");
session_start();

$Test = new Test();
$serialno = $_GET['value1'];
$cardno = $_GET['value2'];
$system21 = $_GET['value3'];
$workorder = $_GET['value4'];
$partnum = $_GET['value5'];
$revision = $_GET['value6'];
$linecode = $_GET['value7'];
$holdflag = $_GET['value8'];
$packflag = $_GET['value9'];
$shipflag = $_GET['value10'];
$rtvflag = $_GET['value11'];
$status = $_GET['value12'];
$lotnum = $_GET['value13'];
$lottype = $_GET['value14'];
$curtstation = $_GET['value15'];
$starttime = $_GET['value16'];
$lastupdate = $_GET['value17'];
$lastupdateby = $_GET['value18'];


$Test->setValue1($serialno);
$Test->setValue2($cardno);
$Test->setValue3($system21);
$Test->setValue4($workorder);
$Test->setValue5($partnum);
$Test->setValue6($revision);
$Test->setValue7($linecode);
$Test->setValue8($holdflag);
$Test->setValue9($packflag);
$Test->setValue10($shipflag);
$Test->setValue11($rtvflag);
$Test->setValue12($status);
$Test->setValue13($lotnum);
$Test->setValue14($lottype);
$Test->setValue15($curtstation);
$Test->setValue16($starttime);
$Test->setValue17($lastupdate);
$Test->setValue18($lastupdateby);

$Test->update();
echo 'updated successfully';



?>