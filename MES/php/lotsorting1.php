<?php
include_once("../classes/card.php");

session_start();

$serialno = $_GET['serialno'];
$lastupdateby = $GET['lastupdateby'];
$account = $_GET['account'];

$SerialCard = new Card();
$SerialCard->setSerialNo($serialno);
$SerialCard->setAccount($account);
$SerialCard->setLastUpdatedBy($lastupdateby);

$SerialCard->emptyLotno($serialno, $lastupdatedby, $account);

echo "$serialno";

?>