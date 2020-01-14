<?php
include_once("connection.php");

class Link2{

  private $account;
  private $cardno;
  private $serialno;
  private $system21;
  private $workorder;
  private $partno;
  private $revision;
  private $linecode;
  private $holdflag;
  private $packflag;
  private $shipflag;
  private $rtvflag;
  private $rejectflag;
  private $status;
  private $lotno;
  private $lottype;
  private $curtstage;
  private $starttime;
  private $starttimeRef;
  private $lastupdate;
  private $lastupdatedby;
  private $Qty;
  private $quantity;
  private $sequence;
  private $maxqty;
  private $isreg;
  private $reduceqty;


  function __construct(){
  }



  //setter

  public function setAccount($account){
    $this->account = $account;
  }

  public function setCardNo($cardno){
    $this->cardno = $cardno;
  }


  public function setSerialNo($serialno){
    $this->serialno = $serialno;
  }

  public function setSerialNoLink($serialnoLink){
    $this->serialnoLink = $serialnoLink;
  }

  public function setSystem21($system21){
    $this->system21 = $system21;
  }

  public function setWorkorder($workorder){
    $this->workorder = $workorder;
  }

  public function setPartNo($partno){
    $this->partno = $partno;
  }

  public function setPartNoLink($partnoLink){
    $this->partnoLink = $partnoLink;
  }


  public function setRevision($revision){
    $this->revision = $revision;
  }


  public function setLineCode($linecode){
    $this->linecode = $linecode;
  }


  public function setHoldFlag($holdflag){
    $this->holdflag = $holdflag;
  }

  public function setPackFlag($packflag){
    $this->packflag = $packflag;
  }

  public function setShipFlag($shipflag){
    $this->shipflag = $shipflag;
  }

  public function setRTVFlag($rtvflag){
    $this->rtvflag = $rtvflag;
  }

  public function setRejectFlag($rejectflag){
    $this->rejectflag = $rejectflag;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function setLotno($lotno){
    $this->lotno = $lotno;
  }

  public function setLotType($lottype){
    $this->lottype = $lottype;
  }

  public function setCurtStage($curtstage){
    $this->curtstage = $curtstage;
  }

  public function setStartTime($starttime){
    $this->starttime = $starttime;
  }

  public function setStartTimeRef($starttimeRef){
    $this->starttimeRef = $starttimeRef;
  }

  public function setLastUpdate($lastupdate){
    $this->lastupdate = $lastupdate;
  }

  public function setLastUpdatedBy($lastupdatedby){
    $this->lastupdatedby = $lastupdatedby;
  }

  public function setQty($Qty){
    $this->Qty = $Qty;
  }

  public function setStation($station){
    $this->station = $station;
  }

  public function setDescription($description){
    $this->description = $description;
  }

  public function setQuantity($quantity){
    $this->Quantity = $quantity;
  }
  public function setMaxQty($maxqty){
    $this->maxQty = $maxqty;
  }
  public function setSequence($sequence){
    $this->sequence = $sequence;
  }
  public function setModelno($modelno){
    $this->modelno = $modelno;
  }

  public function setModelFamily($modelFamily){
    $this->modelFamily = $modelFamily;
  }
  public function setMacAddress($macaddress){
    $this->macaddress = $macaddress;
  }
  public function setReduceqty($reduceqty){
    $this->reduceqty = $reduceqty;
  }
  public function setIsReg($isreg){
    $this->isreg = $isreg;
  }
//getter

  public function getIsReg(){
    return $this->isreg;
  }

  public function getReduceqty(){
    return $this->reduceqty;
  }

  public function getMacAddress(){
    return $this->macaddress;
  }

  public function getModelFamily(){
    return $this->modelFamily;
  }

  public function getPartno(){
    return $this->partno;
  }

  public function getModelno(){
    return $this->modelno;
  }

  public function getDescription(){
    return $this->description;
  }

  public function getStation(){
    return $this->station;
  }

  public function getQty(){
    return $this->Qty;
  }

  public function getAccount(){
    return $this->account;
  }

  public function getCardno(){
    return $this->cardno;
  }

  public function getSerialNo(){
    return $this->serialno;
  }

  public function getSerialNoLink(){
    return $this->serialnoLink;
  }

  public function getSystem21(){
    return $this->system21;
  }

  public function getWorkorder(){
    return $this->workorder;
  }

  public function getPartNoLink(){
    return $this->partnoLink;
  }

  public function getRevision(){
    return $this->revision;
  }

  public function getLineCode(){
    return $this->linecode;
  }

  public function getHoldFlag(){
    return $this->holdflag;
  }

  public function getPackFlag(){
    return $this->packflag;
  }

  public function getShipFlag(){
    return $this->shipflag;
  }

  public function getRTVFlag(){
    return $this->rtvflag;
  }

  public function getRejectFlag(){
    return $this->rejectflag;
  }

  public function getStatus(){
    return $this->status;
  }

  public function getLotno(){
    return $this->lotno;
  }

  public function getLotType(){
    return $this->lottype;
  }

  public function getCurtStage(){
    return $this->curtstage;
  }

  public function getStartTime(){
    return $this->starttime;
  }

  public function getStartTimeRef(){
    return $this->starttimeRef;
  }

  public function getLastUpdate(){
    return $this->lastupdate;
  }

  public function getLastUpdatedBy(){
    return $this->lastupdatedby;
  }


  public function getQuantity(){
    return $this->Quantity;
  }


  public function getMaxQty(){
    return $this->maxQty;
  }


  public function getSequence(){
    return $this->sequence;
  }



  public function addCard(){
    $conn = new Connection();

    try{
      $conn->open();
      $conn->query("INSERT INTO dbo.card VALUES('".$this->getAccount()."','".$this->getCardno()."_1',  '".$this->getSerialNo()."','".$this->getSystem21()."','".$this->getWorkorder()."', '".$this->getPartNo()."', '".$this->getRevision()."', '".$this->getLineCode()."', '".$this->getHoldFlag()."', '".$this->getPackFlag()."','".$this->getShipFlag()."','".$this->getRTVFlag()."','".$this->getRejectFlag()."', '".$this->getStatus()."','".$this->getLotno()."', '".$this->getLotType()."', '".$this->getCurtStage()."', GETDATE(),GETDATE(), '".$this->getLastUpdatedBy()."')");
      $conn->close();
    }catch(Exception $e){

    } 
  }

  public function updateStatus(){
    $conn = new Connection();

    try{
      $conn->open();
      $conn->query("UPDATE dbo.card SET curtstation ='".$this->getCurtStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), rejectflag = 0 where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

      $conn->close();
    }catch(Exception $e){

    }
  }


  public function updatePacking(){
    $conn = new Connection();

    try{
      $conn->open();
      $conn->query("UPDATE dbo.card SET curtstation ='".$this->getCurtStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

      $conn->close();
    }catch(Exception $e){

    }
  }

  public function updatetheLotno(){
    $conn = new Connection();

    try{
      $conn->open();
      $conn->query("UPDATE dbo.card SET lotno ='".$this->getLotno()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

      $conn->close();
    }catch(Exception $e){

    }
  }

  public static function updateQAS($lotno,$curtstage,$updatedby){
    $conn = new Connection();

    try{
      $conn->open();
      $conn->query("UPDATE dbo.Card SET Status = 'GOOD',curtstage = '".$curtstage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where lottype = '".$lotno."'");

      $conn->close();
    }catch(Exception $e){

    }
  }

  public static function replaceSerial($oldserial, $newserial, $updatedby){
    $conn = new Connection();
    $success = true;
    try{
      $conn->open();
      $dataset = $conn->query("SELECT * FROM dbo.card where serialno = '".$newserial."'");

      if (!$conn->has_rows($dataset)){
        $conn->query("UPDATE dbo.Card SET cardno = '".$newserial."_1',serialno = '".$newserial."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where serialno = '".$oldserial."'");
        $conn->query("UPDATE dbo.log_pass SET cardno = '".$newserial."_1' where cardno = '".$oldserial."_1'");
      }else{
        $success = false;
      }

      $conn->close();
    }catch(Exception $e){
      $success = false;
    }

    return $success;  
  }

  public static function updateStatus2($serialno, $result,$stage, $updatedby){
    $conn = new Connection();

    try{
      $conn->open();
      $conn->query("UPDATE dbo.Card SET Status = '".$result."',curtstage = '".$stage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

      $conn->close();
    }catch(Exception $e){

    }
  }

  public static function updateLotNo($serialno, $lotNo, $curtstage, $updatedby){
    $conn = new Connection();

    try{
      $conn->open();
      $conn->query("UPDATE dbo.Card SET lottype = '".$lotNo."', curtstage = '".$curtstage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

      $conn->close();
    }catch(Exception $e){

    }
  } 

  public static function DIDCheckExist($account,$serialno){
    $conn = new Connection();
    $result = 'false';

    try{
      $conn->open();
      $dataset = $conn->query("SELECT * FROM dbo.kanban_partsrecords where account ='".$account."' and did = '".$serialno."'");

      if($conn->has_rows($dataset)){

        $result = 'true';

      }else{
        $result = 'false';
      } 
      
      $conn->close();
    }catch(Exception $e){

    }
    return $result;
  }

  public static function BatchCheckExist($account,$serialno){
    $conn = new Connection();
    $result = 'false';

    try{
      $conn->open();
      $dataset = $conn->query("SELECT * FROM dbo.batch where account ='".$account."' and cardno = '".$serialno."_1'");

      if($conn->has_rows($dataset)){

        $result = 'true';

      }else{
        $result = 'false';
      } 
      
      $conn->close();
    }catch(Exception $e){

    }
    return $result;
  }


  public static function setNextStage($serialno, $nextstage, $lastupdatedby){
    $conn = new Connection();

    try{
      $conn->open();
      $conn->query("UPDATE dbo.Card Set curtstage= '".$nextstage."', lastupdatedby = '".$lastupdatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

      $conn->close();
    }catch(Exception $e){

    }
  }


  public static function getAllSerialByLot($lotNo){
    $conn = new Connection();
    $cards = array();

    try{
      $conn->open();
      $dataset = $conn->query("SELECT * FROM dbo.card WHERE lottype = '".$lotNo."'");
      $counter = 0;

      while ($row = $conn->fetch_array($dataset)) {
        $card = $row['serialno'];

        $cards[$counter]=$card;
        $counter++;
      }
      $conn->close();
    }catch(Exception $e){

    }
    return $cards;
  }

  public static function updatelottype($lotno, $sn){
    $conn = new connection();

    try{
      $conn->open();
      $dataset = $conn->query("UPDATE dbo.card set lottype = '".$lotno."' where cardno = '".$sn."_1'");
      $conn->close();

    }catch(Exception $e){

    }
  }

  public static function cardpallet($sn){
    $conn = new connection();
    $pallet ='';
    $exist = false;

    try{

      $conn->open();
      $dataset = $conn->query("SELECT * FROM dbo.PalletWithSerialLog where SerialNo = '".$sn."'");

      if ($conn->has_rows($dataset)){
        $reader = $conn->fetch_array($dataset);
        $pallet = $reader['PalletNo'];  
        $exist = true;
      }else{
        $exist = false;
      }

      $conn->close();
    }catch(Exception $e){

    }

    if($exist == false)
    {
      try{

        $conn->open();
        $dataset = $conn->query("SELECT * FROM dbo.PalletWithSerialLog_archive where SerialNo = '".$sn."'");

        if ($conn->has_rows($dataset)){
          $reader = $conn->fetch_array($dataset);
          $pallet = $reader['PalletNo'];  
        }

        $conn->close();
      }catch(Exception $e){

      }

    }

    return $pallet;

  }


  public function updateVarify(){
    $conn = new Connection();

    try{
      $conn->open();
      $conn->query("UPDATE dbo.card SET rejectflag = 1 where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

      $conn->close();
    }catch(Exception $e){

    }
  }


  public static function checkifverify($account,$cardno){
    $conn = new Connection();
    $result = 0;
    try{

      $conn->open();
      $dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and cardno = '".$cardno."_1'");

      if ($conn->has_rows($dataset)){
        $reader = $conn->fetch_array($dataset);
        $result = $reader['rejectflag'];  
      }else{
        $result = 0;
      }

      $conn->close();
    }catch(Exception $e){

    }

    return $result;

  }


  public static function getCountSerialByLot($account,$lotNo){
    $conn = new Connection();
    $result = 0;

    try{
      $conn->open();
      $dataset = $conn->query("SELECT Count(cardno) as lotquantity FROM dbo.card WHERE account ='".$account."' and lotno = '".$lotNo."'");
      $counter = 0;

      if ($conn->has_rows($dataset)){
        $reader = $conn->fetch_array($dataset);
        $result = $reader['lotquantity']; 
      }else{
        $result = 0;
      }

      $conn->close();
    }catch(Exception $e){

    }
    return $result;
  }

  public function pwbqty($serial1)
  {
    $conn = new connection();

    try{
      $conn->open();
      $myquery = $conn->query("SELECT (qty - Coalesce((select sum(quantity) from mes.dbo.log_link where serialno = '".$serial1."'),0))  as Qty from mes.dbo.kanban_partsrecords where did = '".$serial1."' ");
      
      if ($conn->has_rows($myquery)>0){
        $reader = $conn->fetch_array($myquery);
        $this->setQty($reader['Qty']);
      }
      
      $conn->close();
    }
    catch(Exception $e){

    }
    
  }

  public function batchqty($serial1)
  {
    $conn = new connection();

    try{
      $conn->open();
      $myquery = $conn->query("SELECT (currQuantity - Coalesce((select sum(quantity) from mes.dbo.log_link where serialno = '".$serial1."'),0))  as Qty from mes.dbo.batch where batchno = '".$serial1."' ");
      
      if ($conn->has_rows($myquery)>0){
        $reader = $conn->fetch_array($myquery);
        $this->setQty($reader['Qty']);
      }
      
      $conn->close();
    }
    catch(Exception $e){

    }
    
  }

  public function linkedqty($account,$serialno,$station)
  {
    $conn = new connection();
    $result = 0;

    try{
      $conn->open();
      $myquery = $conn->query("SELECT coalesce(sum(quantity),0) as qty
        from log_link
        where account = '".$account."'
        and serialno = '".$serialno."'
        and station = '".$station."' ");
      
      if ($conn->has_rows($myquery)){
        $reader = $conn->fetch_array($myquery);
        $result = $reader['qty']; 
        }

      $conn->close();

    }catch(Exception $e){

    }
    return $result;
    
  }

  public function linkinfo($model,$station)
  {
    $conn = new connection();

    try{
      $conn->open();
      $myquery = $conn->query("SELECT * from dbo.link_maintenance WHERE groupname = '".$model."' and station = '".$station."'");
      
      if ($conn->has_rows($myquery)>0){
        $reader = $conn->fetch_array($myquery);
        $this->setQty($reader['maxQty']);
        $this->setPartno($reader['partno']);
        $this->setStatus($reader['status']);
      }
      
      $conn->close();
    }
    catch(Exception $e){

    }
    
  }

  public function linkinfowithseq($model,$station,$sequence)
  {
    $conn = new connection();

    try{
      $conn->open();
      $myquery = $conn->query("SELECT * from dbo.link_maintenance WHERE groupname = '".$model."' and station = '".$station."' and sequence = '".$sequence."'");
      
      if ($conn->has_rows($myquery)>0){
        $reader = $conn->fetch_array($myquery);
        $this->setQty($reader['maxQty']);
        $this->setPartno($reader['partno']);
        $this->setStatus($reader['status']);
        $this->setIsReg($reader['isRegistered']);
        $this->setReduceqty($reader['reduceQuantity']);
      }
      
      $conn->close();
    }
    catch(Exception $e){

    }
    
  }

  public function pwblot($did)
  {
    $conn = new connection();

    try{
      $conn->open();
      $myquery = $conn->query("SELECT * from dbo.kanban_partsrecords   WHERE did = '".$did."' ");
      
      if ($conn->has_rows($myquery)>0){
        $reader = $conn->fetch_array($myquery);
        $this->setPartno($reader['IonicsPN']);
        $this->setStatus($reader['Status']);
      }
      
      $conn->close();
    }
    catch(Exception $e){

    }
    
  }

  public function batchinfo($serial1)
  {
    $conn = new connection();

    try{
      $conn->open();
      $myquery = $conn->query("SELECT * from dbo.batch WHERE batchno = '".$serial1."' ");
      
      if ($conn->has_rows($myquery)>0){
        $reader = $conn->fetch_array($myquery);
        $this->setPartno($reader['partno']);
        $this->setStatus($reader['Status']);
      }
      
      $conn->close();
    }
    catch(Exception $e){

    }
    
  }

  public function addLogLink(){
    $conn = new Connection();

    try{
     $conn->open();
     $conn->query("INSERT INTO dbo.log_link VALUES('".$this->getAccount()."','".$this->getSerialno()."','".$this->getPartno()."', '".$this->getSerialnoLink()."','".$this->getPartnoLink()."','".$this->getQty()."','".$this->getStation()."','".$this->getDescription()."',GETDATE(),'".$this->getLastUpdatedBy()."')");
     $conn->close();
   }catch(Exception $e){

   }	
 }

  public function addAcce(){
    $conn = new Connection();

    try{
     $conn->open();
     $conn->query("INSERT INTO dbo.accessory VALUES('".$this->getAccount()."','".$this->getSerialno()."','".$this->getPartno()."', '".$this->getSerialnoLink()."','".$this->getPartnoLink()."','".$this->getQty()."','".$this->getStation()."','".$this->getDescription()."',GETDATE(),'".$this->getLastUpdatedBy()."')");
     $conn->close();
   }catch(Exception $e){

   }  
 }

 public function addLogLink2(){
    $conn = new Connection();

    try{
     $conn->open();
     $conn->query("INSERT INTO dbo.log_link2 VALUES('".$this->getAccount()."','".$this->getSerialno()."','".$this->getPartno()."', '".$this->getSerialnoLink()."','".$this->getPartnoLink()."','".$this->getQty()."','".$this->getStation()."','".$this->getDescription()."',GETDATE(),'".$this->getLastUpdatedBy()."','1')");
     $conn->close();
   }catch(Exception $e){

   }  
 }

 public static function updateDIDqty($did, $lastupdatedby, $account, $returnquantity){
  $conn = new Connection();

  try{
    $conn->open();
    $conn->query("UPDATE dbo.kanban_partsrecords Set quantity = '".$returnquantity."',  lastupdate = getdate(),lastupdatedby = '".$lastupdatedby."',  lastupdate = getdate() where did = '".$did."' and account ='".$account."'");

    $conn->close();
  }catch(Exception $e){

  }
}


public static function pwbqty1($account,$did){

  $conn = new Connection();

  try{
    $conn->open();
    $dataset = $conn->query("SELECT quantity FROM dbo.kanban_partsrecords where account ='".$account."' and did = '".$did."' ");

    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);

      $this->setQty($reader['quantity']);
    }
    $conn->close();
  }catch(Exception $e){

  }

}




public static function getAllLotno($account,$lotnum){
  $conn= new Connection();
  $lotnumber = array();

  try{
    $conn->open();
    $result = $conn->query("SELECT * FROM dbo.card where account = '".$account."' AND lotno ='".$lotnum."'");
    $counter = 0;
    while ($row = $conn->fetch_array($result)) 
    {
      $lotno = new Card();
      $lotno->setCardNo($row['serialno']);
      $lotnumber[$counter] = $lotno;
      $counter++;
    }
    $conn->close();
  }catch(Exception $e){

  }
  return $lotnumber;
}



public function showReject($account,$lotno){
  $conn = new Connection();
  
  $serialnumber = array();

  try{
    $conn->open();
    $dataset = $conn->query("SELECT * FROM dbo.card where status = 'REJECT' and account ='".$account."' and lotno = '".$lotno."'");
    $counter = 0;

    while ($reader = $conn->fetch_array($dataset)) {
      $selectReject = new Card();
      $selectReject->setSerialNo($reader['serialno']);
      $serialnumber[$counter] = $selectReject;
      $counter++;
    }
    $conn->close();

  }catch(Exception $e){

  }
  return $serialnumber;
}

public function rejectCount($account,$lotno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT Count(cardno) as rejectcount FROM dbo.card where status = 'REJECT' and account ='".$account."' and lotno = '".$lotno."'");


    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['rejectcount']; 
    }

    $conn->close();

  }catch(Exception $e){

  }
  return $result;
}

public function checkIfSerialIsGood($account, $serialno)
{
  $conn = new Connection();
  $result = 'false';

  try{
    $conn->open();
    $dataset = $conn->query("SELECT * FROM dbo.card where account= '".$account."' and serialno='".$serialno."'");
    $reader = $conn->fetch_array($dataset);

    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);

      if($reader['status'] == 'GOOD'){
        $result = 'true';
      }else{
        $result = 'false';
      }

    }
    $conn->close();
  }catch(Exception $e){

  }
  return $result;
}

public function checkSerialRoute($station, $account, $serialno)
{
  $conn = new Connection();
  $result = 'false';

  try{
    $conn->open();
    $dataset = $conn->query("SELECT * FROM dbo.card where account= '".$account."' and serialno='".$serialno."'");
    $reader = $conn->fetch_array($dataset);

    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);

      if($reader['curtstation'] == $station){
        $result = 'true';
      }else{
        $result = 'false';
      }

    }
    $conn->close();
  }catch(Exception $e){

  }
  return $result;
}

public static function emptyLotno($serialno, $lastupdatedby, $account){
  $conn = new Connection();

  try{
    $conn->open();
    $conn->query("UPDATE dbo.card Set lotno = '', lastupdatedby = '".$lastupdatedby."', lastupdate = getdate() where serialno = '".$serialno."' and account ='".$account."'");

    $conn->close();
  }catch(Exception $e){

  }
}

public static function setLotnoNew($serialno, $lastupdatedby, $account, $station,$lotno){
  $conn = new Connection();

  try{
    $conn->open();
    $conn->query("UPDATE dbo.card Set lotno = '".$lotno."', curtstation ='".$station."', lastupdatedby = '".$lastupdatedby."', lastupdate = getdate() where serialno = '".$serialno."' and account='".$account."'");

    $conn->close();
  }catch(Exception $e){

  }
}

public static function checkExistSerial($account,$serialno){
  $conn = new Connection();
  $result = 'false';

  try{
    $conn->open();
    $dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and serialno = '".$serialno."'");

    if($conn->has_rows($dataset)){

      $result = 'true';

    }else{
      $result = 'false';
    } 

    $conn->close();
  }catch(Exception $e){

  }
  return $result;
}

public function pwbquantity($account,$did){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT a.account,a.DID,a.Qty - (Select  Coalesce(sum(b.quantity),0) from dbo.log_link b where b.account=a.account and b.serialno=a.did) as qty FROM dbo.kanban_partsrecords a WHERE a.account = '".$account."' AND a.did='".$did."'");


    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);

      $this->setQty($reader['qty']);
    }

    $conn->close();

  }catch(Exception $e){

  }
  return $result;
}

public static function serialformat($account,$modelno,$serialno){
  $conn = new Connection();
  $result = 'false';

  try{
    $conn->open();
    $dataset = $conn->query("SELECT * FROM dbo.serial_format where account ='".$account."' and modelno = '".$modelno."' and len('".$serialno."') = serialLength and substring('".$serialno."',start+1,last) = value");

    if($conn->has_rows($dataset)){

      $result = 'true';

    }else{
      $result = 'false';
    } 

    $conn->close();
  }catch(Exception $e){

  }
  return $result;
}

public static function GetLinkDetails($account,$modelno,$station)
{
  $conn = new connection();
  $result = array();

  try{
    $conn->open();
    $dataset =  $conn->query("SELECT * FROM dbo.link_maintenance where account = '".$account."' and groupname = '".$modelno."' and station = '".$station."'" );
    $counter = 0;
    while($reader = $conn->fetch_array($dataset)){

     $Select = new Link2();
     $Select->setSequence($reader['sequence']);
     $Select->setPartNo($reader['partno']);
     $Select->setMaxQty($reader['maxQty']);


     $result[$counter] = $Select;
     $counter++;
   }

   $conn->close();

 }catch(Exception $e){

 }
 return $result;
}

public static function GetLinkDetails2($account,$modelno,$station,$tblstation)
{
  $conn = new connection();
  $result = array();

  try{
    $conn->open();
    $dataset =  $conn->query("DECLARE @account as varchar(50) = '".$account."'
DECLARE @groupname as varchar(50) = '''".$modelno."'''
DECLARE @station as varchar(50) = '''".$station."'''
DECLARE @tblgroupname as varchar(50) = 'groupname'
DECLARE @tblstation as varchar(50) = '".$tblstation."'
DECLARE @SQLQuery AS NVARCHAR(1200) 

SET @SQLQuery = 'SELECT * FROM dbo.link_maintenance WHERE account= ''".$account."'' and '+@tblgroupname+' = '+@groupname+' and '+@tblstation+' ='+@station
EXECUTE(@SQLQuery)" );
    $counter = 0;
    while($reader = $conn->fetch_array($dataset)){

     $Select = new Link2();
     $Select->setSequence($reader['sequence']);
     $Select->setPartNo($reader['partno']);
     $Select->setMaxQty($reader['maxQty']);


     $result[$counter] = $Select;
     $counter++;
   }
   $conn->close();

 }catch(Exception $e){

 }
 return $result;
}

public static function GetLinkDetailsFromSeq($account,$modelno,$station,$sequence)
{
  $conn = new connection();
  $result = array();

  try{
    $conn->open();
    $dataset =  $conn->query("SELECT * FROM dbo.link_maintenance where account = '".$account."' and groupname = '".$modelno."' and station = '".$station."' and sequence = '".$sequence."' " );
    $counter = 0;
    while($reader = $conn->fetch_array($dataset)){

     $Select = new Link2();
     $Select->setSequence($reader['sequence']);
     $Select->setPartNo($reader['partno']);
     $Select->setMaxQty($reader['maxQty']);


     $result[$counter] = $Select;
     $counter++;
   }

   $conn->close();

 }catch(Exception $e){

 }
 return $result;
}

public function getMaxQtyofModel($account,$modelno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT maxQty FROM dbo.link_maintenance where account ='".$account."' and partno = '".$modelno."'");


    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['maxQty']; 
    }

    $conn->close();

  }catch(Exception $e){

  }
  return $result;
}

public static function viewAllLinkdetails($account,$serialno){
  $conn = new Connection();
  $logs = array();
  $stationdesc ='';
  try{
    $conn->open();
    $dataset = $conn->query("SELECT * FROM dbo.log_link where account = '".$account."' and (serialno = '".$serialno."' or serialnoLink ='".$serialno."') AND quantity > 0 order by lastupdate asc");
    $counter = 0;

    while($reader = $conn->fetch_array($dataset)){
      $log = new Link2();
      $log->setAccount($reader["account"]);
      $log->setSerialNo($reader["serialno"]);
      $log->setPartno($reader["partno"]);
      $log->setSerialNoLink($reader['serialnoLink']);
      $log->setPartNoLink($reader["partnoLink"]);
      $log->setQuantity($reader["quantity"]);
      $log->setStation($reader["station"]);
      $log->setDescription($reader["description"]);
      $log->setLastUpdate($reader["lastupdate"]->format('Y-m-d h:i:s a'));
      $log->setLastUpdatedBy($reader["lastupdatedby"]);


      $logs[$counter] = $log;
      $counter++;
    }
    $conn->close();
  }catch(Exception $e){

  }

  return $logs;
}

public function getLinkedMac($account,$serialno,$modelno,$station){
  $conn = new Connection();
  $result = ''; 

  try{
    $conn->open();
    $dataset = $conn->query("SELECT serialnoLink FROM dbo.log_link where account ='".$account."' and serialno = '".$serialno."' and partno = '".$modelno."' and station = '".$station."'" );


    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['serialnoLink']; 
    }

    $conn->close();

  }catch(Exception $e){

  }
  return $result;
}

public function getB9MacAddressPN($account,$modelno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT partno FROM dbo.B9_mac_address where account ='".$account."' and modelno = '".$modelno."'");


    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['partno']; 
    }

    $conn->close();

  }catch(Exception $e){

  }
  return $result;
}

public function getB9MacAddress($account,$modelno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT partno FROM dbo.acce_matrix where account ='".$account."' and modelno = '".$modelno."'");


    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['partno']; 
    }

    $conn->close();

  }catch(Exception $e){

  }
  return $result;
}

public function getB9MacFormatModel($account,$modelno,$serialno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT partno FROM dbo.acce_format where account ='".$account."' and modelno = '".$modelno."' and value=SUBSTRING('".$serialno."',0,0) and serialLength=LEN('".$serialno."')");


    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['partno']; 
    }

    $conn->close();

  }catch(Exception $e){

  }
  return $result;
}

public function getSumAcce($account,$serialno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT coalesce(sum(quantity),0) as qty FROM dbo.accessory where account ='".$account."' and accessory='".$serialno."' ");


    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['qty']; 
    }

    $conn->close();

  }catch(Exception $e){

  }
  return $result;
}



public static function getcountseriallink($account,$serialno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT (currQuantity - Coalesce((Select count(serialno) 
      FROM [MES].[dbo].[log_link] WHERE serialno = '".$serialno."'),0))  as Qty From [MES].[dbo].[motherserial] WHERE motherserial = '".$serialno."'");
    $counter = 0;

    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['Qty']; 
    }else{
      $result = 0;
    }

    $conn->close();
  }catch(Exception $e){

  }
  return $result;
}

public static function getcountlink($account,$serialno,$modelno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("Select Count(serialno) as Qty FROM [MES].[dbo].[log_link] WHERE account ='".$account. "' AND serialno = '".$serialno."' AND partnolink = '".$modelno."'");
    $counter = 0;

    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['Qty']; 
    }else{
      $result = 0;
    }

    $conn->close();
  }catch(Exception $e){

  }
  return $result;
}

public static function getcountlink2($account,$serialno,$modelno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("Select Count(serialno) as Qty FROM [MES].[dbo].[log_link] WHERE account ='".$account. "' AND serialnoLink = '".$serialno."' AND partno = '".$modelno."'");
    $counter = 0;

    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['Qty']; 
    }else{
      $result = 0;
    }

    $conn->close();
  }catch(Exception $e){

  }
  return $result;
}


public static function getsumcountseriallink($account,$serialno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT (sum(currQuantity) - Coalesce((Select count(serialno) 
      FROM [MES].[dbo].[log_link] WHERE serialno = '".$serialno."'),0))  as Qty From [MES].[dbo].[motherserial] WHERE motherserial = '".$serialno."'");
    $counter = 0;

    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['Qty']; 
    }else{
      $result = 0;
    }

    $conn->close();
  }catch(Exception $e){

  }
  return $result;
}

public static function getsumbatchserialnolink($account,$serialno){
  $conn = new Connection();
  $result = 0;

  try{
    $conn->open();
    $dataset = $conn->query("SELECT Coalesce(sum(quantity),0) as Qty FROM dbo.log_link WHERE serialnoLink = '".$serialno."' and account = '".$account."'");
    $counter = 0;

    if ($conn->has_rows($dataset)){
      $reader = $conn->fetch_array($dataset);
      $result = $reader['Qty']; 
    }else{
      $result = 0;
    }

    $conn->close();
  }catch(Exception $e){

  }
  return $result;
}




}?>