<?php
include_once("connection.php");

class Batch{

	private $account;
	private $cardno;
	private $batchno;
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
	private $origquantity;
	private $currquantity;
	private $status;
	private $lotno;
	private $lottype;
	private $refno;
	private $station;
	private $curtstage;
	private $starttime;
	private $starttimeRef;
	private $lastupdate;
	private $lastupdatedby;
	private $parentbatchno;
	private $childbatchno;



	function __construct($account='',$serialno=''){
		
		if(strlen($serialno)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.batch where account ='".$account."' and cardno = '".$serialno."_1'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setAccount($reader['account']);
				$this->setCardNo($reader['cardno']);
				$this->setBatchno($reader['batchno']);
				// $this->setSystem21($reader['system21']);
				$this->setWorkorder($reader['workorder']);
				$this->setPartNo($reader['partno']);
				$this->setRevision($reader['revision']);
				$this->setLineCode($reader['linecode']);
				$this->setHoldFlag($reader['holdflag']);
				$this->setPackFlag($reader['packflag']);
				$this->setShipFlag($reader['shipflag']);
				$this->setRTVFlag($reader['rtvflag']);
				$this->setRejectFlag($reader['rejectflag']);
				$this->setStatus($reader['status']);
				$this->setLotno($reader['lotno']);
				$this->setLotType($reader['lottype']);
				$this->setCurtStage($reader['station']);
				$this->setStartTime($reader['starttime']);
				$this->setLastUpdate($reader['lastupdate']);
				$this->setLastUpdatedBy($reader['lastupdatedby']);
				$this->setOrigquantity($reader['origQuantity']);
				$this->setCurrquantity($reader['currQuantity']);
				$this->setRefno($reader['refno']);
				$this->setParentbatchno($reader['parentbatchno']);
				$this->setChildbatchno($reader['childbatchno']);
			}

			$conn->close();
		}catch(Exception $e){

		}
	}

	}



	//setter

	public function setAccount($account){
		$this->account = $account;
	}

	public function setCardNo($cardno){
		$this->cardno = $cardno;
	}


	public function setBatchno($batchno){
		$this->batchno = $batchno;
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
		$this->station = $curtstage;
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

	public function setOrigquantity($origquantity){
		$this->origQuantity = $origquantity;
	}

	public function setCurrquantity($currquantity){
		$this->currQuantity = $currquantity;
	}

	public function setRefno($refno){
		$this->refno = $refno;
	}

	public function setParentbatchno($parentbatchno){
		$this->parentbatchno = $parentbatchno;
	}

	public function setChildbatchno($childbatchno){
		$this->childbatchno = $childbatchno;
	}




//getter

	public function getAccount(){
		return $this->account;
	}

	public function getCardno(){
		return $this->cardno;
	}

	public function getBatchno(){
		return $this->batchno;
	}

	public function getSystem21(){
		return $this->system21;
	}

	public function getWorkorder(){
		return $this->workorder;
	}

	public function getPartNo(){
		return $this->partno;
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
		return $this->station;
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

	public function getOrigquantity(){
		return $this->origQuantity;
	}

	public function getCurrquantity(){
		return $this->currQuantity;
	}

	public function getRefno(){
		return $this->refno;
	}

	public function getParentbatchno(){
		return $this->parentbatchno;
	}

	public function getChildbatchno(){
		return $this->childbatchno;
	}



	public function addBatch(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.batch VALUES('".$this->getAccount()."','".$this->getCardno()."_1',  '".$this->getBatchno()."', '".$this->getPartNo()."','".$this->getStatus()."','".$this->getCurtStage()."','".$this->getOrigquantity()."','".$this->getCurrquantity()."','".$this->getLotno()."','".$this->getLotType()."','".$this->getRefno()."','".$this->getWorkorder()."','".$this->getRevision()."', '".$this->getLineCode()."', '".$this->getHoldFlag()."', '".$this->getPackFlag()."','".$this->getShipFlag()."','".$this->getRTVFlag()."','".$this->getRejectFlag()."', GETDATE(),GETDATE(), '".$this->getLastUpdatedBy()."','".$this->getParentbatchno()."', '".$this->getChildbatchno()."')");
			$conn->close();
		}catch(Exception $e){

		}	
	}

	public function updateStatus(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.batch SET station ='".$this->getCurtStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), rejectflag = '".$this->getRejectFlag()."', currQuantity = '".$this->getCurrquantity()."',linecode = '".$this->getLineCode()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

		public function updateStatusRTS(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.batch SET station ='".$this->getCurtStage()."', status = '".$this->getStatus()."', lotno ='".$this->getLotno()."', refno = '".$this->getRefno()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), rejectflag = '".$this->getRejectFlag()."', currQuantity = '".$this->getCurrquantity()."',linecode = '".$this->getLineCode()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public function updateStatus1(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.batch SET lotno ='".$this->getLotno()."',station ='".$this->getCurtStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), rejectflag = '".$this->getRejectFlag()."', currQuantity = '".$this->getCurrquantity()."',linecode = '".$this->getLineCode()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateStatus4(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.batch SET lotno ='".$this->getLotno()."',station ='".$this->getCurtStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), rejectflag = '".$this->getRejectFlag()."', currQuantity = '".$this->getCurrquantity()."',linecode = '".$this->getLineCode()."', workorder = '".$this->getWorkorder()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public function updatePacking(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.batch SET station ='".$this->getCurtStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updatetheLotno(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.batch SET lotno ='".$this->getLotno()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function updateQAS($lotno,$curtstage,$updatedby){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.batch SET Status = 'GOOD',station = '".$curtstage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where lottype = '".$lotno."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function replaceSerial($oldserial, $newserial, $updatedby){
		$conn = new Connection();
		$success = true;
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.batch where serialno = '".$newserial."'");

			if (!$conn->has_rows($dataset)){
				$conn->query("UPDATE dbo.batch SET cardno = '".$newserial."_1',serialno = '".$newserial."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where serialno = '".$oldserial."'");
				$conn->query("UPDATE dbo.log_batch SET cardno = '".$newserial."_1' where cardno = '".$oldserial."_1'");
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
			$conn->query("UPDATE dbo.batch SET Status = '".$result."',station = '".$stage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function updateLotNo($serialno, $lotNo, $curtstage, $updatedby){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.batch SET lottype = '".$lotNo."', station = '".$curtstage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}	

	public static function checkExist($account,$batchno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.batch where account ='".$account."' and cardno = '".$batchno."_1'");

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

		public static function rejectexist($account,$refno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where status = 'REJECT' and account ='".$account."' and refno = '".$refno."'");

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

		public static function refcheckExist($account,$refno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.batch where account ='".$account."' and refno = '".$refno."'");

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
			$conn->query("UPDATE dbo.batch Set station= '".$nextstage."', lastupdatedby = '".$lastupdatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function getAllSerialByLot($lotNo){
			$conn = new Connection();
			$cards = array();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.batch WHERE lottype = '".$lotNo."'");
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
			$dataset = $conn->query("UPDATE dbo.batch set lottype = '".$lotno."' where cardno = '".$sn."_1'");
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
			$conn->query("UPDATE dbo.batch SET rejectflag = 1 where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function checkifverify($account,$cardno){
		$conn = new Connection();
		$result = 0;
		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.batch where account ='".$account."' and cardno = '".$cardno."_1'");

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
				$dataset = $conn->query("SELECT Count(cardno) as lotquantity FROM dbo.batch WHERE account ='".$account."' and lotno = '".$lotNo."'");
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

			public static function getCountSerialByRef($account,$refno){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT Count(cardno) + 1 as lotquantity FROM dbo.batch WHERE account ='".$account."' and refno = '".$refno."'");
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

					public static function getCountSerialByRef1($account,$refno){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT Count(cardno)as lotquantity FROM dbo.batch WHERE account ='".$account."' and refno = '".$refno."'");
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





	public static function getCountBatchByLot($account,$lotNo){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT Sum(currQuantity) as lotquantity FROM dbo.batch WHERE account ='".$account."' and lotno = '".$lotNo."'");
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

	public static function getCountBatchByRef($account,$refno){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT COALESCE(Sum(currQuantity),0) as lotquantity FROM dbo.batch WHERE account ='".$account."' and refno = '".$refno."'");
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

	public static function getAllLotno($account,$lotnum){
		$conn= new Connection();
		$lotnumber = array();
		
		try{
			$conn->open();
			$result = $conn->query("SELECT * FROM dbo.batch where account = '".$account."' AND lotno ='".$lotnum."' order by batchno");
			$counter = 0;
			while ($row = $conn->fetch_array($result)) 
			{
				$lotno = new Batch();
				$lotno->setCardNo($row['batchno']);
				$lotno->setPartNo($row['partno']);
				$lotno->setStatus($row['status']);
				$lotno->setCurrquantity($row['currQuantity']);
				$lotnumber[$counter] = $lotno;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){

		}
		return $lotnumber;
	}

		public static function getLotSerialReject($account,$lotnum){
		$conn = new Connection();
		$result = false;
		try{

			$conn->open();
			$dataset = $conn->query("SELECT status FROM dbo.batch where account = '".$account."' AND lotno ='".$lotnum."' AND status ='REJECT'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
			$result = true;	
			}else{
			$result = false;
			}

			$conn->close();
		}catch(Exception $e){

		}

		return $result;

	}

			public static function getLotSerialRejectref($account,$refno){
		$conn = new Connection();
		$result = false;
		try{

			$conn->open();
			$dataset = $conn->query("SELECT status FROM dbo.batch where account = '".$account."' AND refno ='".$refno."' AND status ='REJECT'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
			$result = true;	
			}else{
			$result = false;
			}

			$conn->close();
		}catch(Exception $e){

		}

		return $result;

	}




	public function rejectCount($account,$lotno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT Count(cardno) as rejectcount FROM dbo.batch where status = 'REJECT' and account ='".$account."' and lotno = '".$lotno."'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['rejectcount'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

		public function rejectCountserialRef($account,$refno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT Count(cardno) as rejectcount FROM dbo.batch where status = 'REJECT' and account ='".$account."' and refno = '".$refno."'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['rejectcount'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}
	public function showReject($account,$lotno){
		$conn = new Connection();
	
		$serialnumber = array();

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.batch where status = 'REJECT' and account ='".$account."' and lotno = '".$lotno."'");
				$counter = 0;

			while ($reader = $conn->fetch_array($dataset)) {
				$selectReject = new Batch();
				$selectReject->setBatchno($reader['batchno']);
				$selectReject->setStatus($reader['status']);
				$selectReject->setCurrquantity($reader['currQuantity']);
				$serialnumber[$counter] = $selectReject;
				$counter++;
			}
			$conn->close();

		}catch(Exception $e){

		}
		return $serialnumber;
	}

		public function updateLotSort(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.Batch SET lotno = '".$this->getLotno()."', station ='".$this->getCurtStage()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and batchno = '".$this->getCardno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

			public function updateLotSortref(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.Batch SET lotno = '".$this->getLotno()."', refno = '".$this->getRefno()." ',station ='".$this->getCurtStage()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and batchno = '".$this->getCardno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	

		public function updateLotSort1(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.Batch SET  station ='".$this->getCurtStage()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function rejectCount1($account,$lotno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT Sum(currQuantity) as rejectcount FROM dbo.batch WHERE status = 'REJECT' and account ='".$account."' and lotno = '".$lotno."'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['rejectcount'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

		public function rejectCountref($account,$refno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT Sum(currQuantity) as rejectcount FROM dbo.batch WHERE status = 'REJECT' and account ='".$account."' and refno = '".$refno."'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['rejectcount'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

	public function updateQty(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.Batch SET currQuantity ='".$this->getCurrquantity()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() WHERE account ='".$this->getAccount()."' and batchno = '".$this->getBatchno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateBothQty(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.Batch SET origQuantity ='".$this->getCurrquantity()."',currQuantity ='".$this->getCurrquantity()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() WHERE account ='".$this->getAccount()."' and batchno = '".$this->getBatchno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateStatus3(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.Batch SET status='".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() WHERE account ='".$this->getAccount()."' and batchno = '".$this->getBatchno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}



	public static function getAllSerialByLotRef($account,$lotno,$refno){
		$conn = new Connection();
		$result = array();
		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.batch WHERE account = '".$account."' AND lotno = '".$lotno."' and partno = (SELECT TOP 1 partno FROM lotnumber WHERE lotNo = '".$lotno."' and  refno = '".$refno."') ");
			$counter = 0;
			if ($conn->has_rows($dataset)){
				while($reader = $conn->fetch_array($dataset)){
					$result[$counter] = $reader['batchno'];
					$counter++;
				}

			}

			$conn->close();
		}catch(Exception $e){

		}

		return $result;
			
	}

public function getBatchQty($account,$batchno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT coalesce(sum(currQuantity),0) as qty
				FROM [MES].[dbo].[batch]
				where currQuantity > 0
				and account = '".$account."'
				and cardno = '".$batchno."_1'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['qty'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

public function getBatchPN($account,$batchno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT partno
				FROM [MES].[dbo].[batch]
				where account = '".$account."'
				and cardno = '".$batchno."_1'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['partno'];
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

	public function updateStatuslotref(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.batch SET refno = '".$this->getRefno()."' , station ='".$this->getCurtStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), rejectflag = '".$this->getRejectFlag()."', currQuantity = '".$this->getCurrquantity()."',linecode = '".$this->getLineCode()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

			public static function getAllLotSerialRef($account,$lotno,$refno){
			$conn = new Connection();
			$batc = array();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.batch WHERE account = '".$account."' and lotno = '".$lotno."' and refno = '".$refno."'");
				$counter = 0;

				while ($row = $conn->fetch_array($dataset)) {
					$batch = new Batch();
					$batch->setBatchno($row['batchno']);
					$batch->setStatus($row['status']);
					$batch->setPartNo($row['partno']);
					$batch->setLastUpdate($row['lastupdate']->format('F j, Y, g:i a'));
					$batch->setLastUpdatedBy($row['lastupdatedby']);

					$batc[$counter]=$batch;
					$counter++;
				}
				$conn->close();
				}catch(Exception $e){

				}
				return $batc;
		}

				public static function getAllSerialRef($account,$refno){
			$conn = new Connection();
			$batc = array();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.batch WHERE account = '".$account."' AND refno = '".$refno."'");
				$counter = 0;

				while ($row = $conn->fetch_array($dataset)) {
					$batch = new Batch();
					$batch->setBatchno($row['batchno']);
					$batch->setStatus($row['status']);
					$batch->setPartNo($row['partno']);
					$batch->setLastUpdate($row['lastupdate']->format('F j, Y, g:i a'));
					$batch->setLastUpdatedBy($row['lastupdatedby']);

					$batc[$counter]=$batch;
					$counter++;
				}
				$conn->close();
				}catch(Exception $e){

				}
				return $batc;
		}

		public function showRejectref($account,$refno){
		$conn = new Connection();
	
		$serialnumber = array();

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where status = 'REJECT' and account ='".$account."' and refno = '".$refno."'");
				$counter = 0;

			while ($reader = $conn->fetch_array($dataset)) {
				$selectReject = new Card();
				$selectReject->setSerialNo($reader['serialno']);
				$selectReject->setStatus($reader['status']);
				$serialnumber[$counter] = $selectReject;
				$counter++;
			}
			$conn->close();

		}catch(Exception $e){

		}
		return $serialnumber;
	}


public function getRefBatchQty($account,$refno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT coalesce(sum(currQuantity),0) as qty
				FROM [MES].[dbo].[batch]
				where currQuantity > 0
				and account = '".$account."'
				and refno = '".$refno."'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['qty'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}


	public function getBatchdetails($account,$serialno){
	$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.batch where account ='".$account."' and cardno = '".$serialno."_1'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setAccount($reader['account']);
				$this->setCardNo($reader['cardno']);
				$this->setBatchno($reader['batchno']);
				// $this->setSystem21($reader['system21']);
				$this->setWorkorder($reader['workorder']);
				$this->setPartNo($reader['partno']);
				$this->setRevision($reader['revision']);
				$this->setLineCode($reader['linecode']);
				$this->setHoldFlag($reader['holdflag']);
				$this->setPackFlag($reader['packflag']);
				$this->setShipFlag($reader['shipflag']);
				$this->setRTVFlag($reader['rtvflag']);
				$this->setRejectFlag($reader['rejectflag']);
				$this->setStatus($reader['status']);
				$this->setLotno($reader['lotno']);
				$this->setLotType($reader['lottype']);
				$this->setCurtStage($reader['station']);
				$this->setStartTime($reader['starttime']);
				$this->setLastUpdate($reader['lastupdate']);
				$this->setLastUpdatedBy($reader['lastupdatedby']);
				$this->setOrigquantity($reader['origQuantity']);
				$this->setCurrquantity($reader['currQuantity']);
				$this->setRefno($reader['refno']);
				$this->setParentbatchno($reader['parentbatchno']);
				$this->setChildbatchno($reader['childbatchno']);
			}

			$conn->close();
		}catch(Exception $e){

		}
	}

		public function getBatchCurtStation($account,$serialno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT [station]
				FROM mes.dbo.batch
				WHERE account = '".$account."'
				AND cardno = '".$serialno."_1'
				");

		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['station'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

	public function getRemainingBatch($account,$serialno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT currQuantity-(
					SELECT count(serialno) from mes.dbo.log_link
					where serialno = '".$serialno."') as qty
				FROM [MES].[dbo].[batch]
				WHERE batchno = '".$serialno."'
				");

		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['qty'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

}?>