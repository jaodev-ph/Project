<?php
include_once("connection.php");

class Mother{

	private $account;
	private $cardno;
	private $motherserialno;
	private $partno;
	private $childpartno;
	private $workorder;
	private $revision;
	private $linecode;
	private $origQuantity;
	private $currQuantity;
	private $linkedQuantity;
	private $holdflag;
	private $packflag;
	private $shipflag;
	private $rtvflag;
	private $rejectflag;
	private $status;
	private $lotno;
	private $lottype;
	private $curtstation;
	private $starttime;
	private $starttimeRef;
	private $lastupdate;
	private $lastupdatedby;



	function __construct($account='',$serialno=''){
		
		if(strlen($serialno)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.motherserial where account ='".$account."' and cardno = '".$serialno."_1'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setAccount($reader['account']);
				$this->setCardNo($reader['cardno']);
				$this->setMotherSerialNo($reader['motherserial']);
				$this->setPartNo($reader['partno']);
				$this->setChildPartNo($reader['childpartno']);
				$this->setWorkorder($reader['workorder']);
				$this->setRevision($reader['revision']);
				$this->setLineCode($reader['linecode']);
				$this->setOrigQuantity($reader['origQuantity']);
				$this->setCurrQuantity($reader['currQuantity']);
				$this->setLinkedQuantity($reader['linkedQuantity']);
				$this->setHoldFlag($reader['holdflag']);
				$this->setPackFlag($reader['packflag']);
				$this->setShipFlag($reader['shipflag']);
				$this->setRTVFlag($reader['rtvflag']);
				$this->setRejectFlag($reader['rejectflag']);
				$this->setStatus($reader['status']);
				$this->setLotno($reader['lotno']);
				$this->setLotType($reader['lottype']);
				$this->setCurtStation($reader['curtstation']);
				$this->setStartTime($reader['starttime']);
				$this->setLastUpdate($reader['lastupdate']);
				$this->setLastUpdatedBy($reader['lastupdatedby']);
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

	public function setMotherSerialNo($motherserialno){
		$this->motherserialno = $motherserialno;
	}

	public function setPartNo($partno){
		$this->partno = $partno;
	}

	public function setChildPartNo($childpartno){
		$this->childpartno = $childpartno;
	}

	public function setWorkorder($workorder){
		$this->workorder = $workorder;
	}

	public function setRevision($revision){
		$this->revision = $revision;
	}

	public function setLineCode($linecode){
		$this->linecode = $linecode;
	}

	public function setOrigQuantity($origQuantity){
		$this->origQuantity = $origQuantity;
	}

	public function setCurrQuantity($currQuantity){
		$this->currQuantity = $currQuantity;
	}

	public function setLinkedQuantity($linkedQuantity){
		$this->linkedQuantity = $linkedQuantity;
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

	public function setCurtStation($curtstation){
		$this->curtstation = $curtstation;
	}

	public function setStartTime($starttime){
		$this->starttime = $starttime;
	}

	public function setLastUpdate($lastupdate){
		$this->lastupdate = $lastupdate;
	}

	public function setLastUpdatedBy($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}



//getter

	public function getAccount(){
		return $this->account;
	}

	public function getCardno(){
		return $this->cardno;
	}

	public function getMotherSerialNo(){
		return $this->motherserialno;
	}

	public function getPartNo(){
		return $this->partno;
	}

	public function getChildPartNo(){
		return $this->childpartno;
	}

	public function getWorkorder(){
		return $this->workorder;
	}

	public function getRevision(){
		return $this->revision;
	}

	public function getOrigQuantity(){
		return $this->origQuantity;
	}

	public function getCurrQuantity(){
		return $this->currQuantity;
	}

	public function getLinkedQuantity(){
		return $this->linkedQuantity;
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

	public function getCurtStation(){
		return $this->curtstation;
	}

	public function getStartTime(){
		return $this->starttime;
	}

	public function getLastUpdate(){
		return $this->lastupdate;
	}

	public function getLastUpdatedBy(){
		return $this->lastupdatedby;
	}



	public function addMother(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.motherserial VALUES('".$this->getAccount()."', '".$this->getCardno()."_1',  '".$this->getMotherSerialNo()."', '".$this->getPartNo()."', '".$this->getChildPartNo()."', '".$this->getWorkorder()."', '".$this->getRevision()."', '".$this->getLineCode()."', '".$this->getOrigQuantity()."', '".$this->getCurrQuantity()."','".$this->getLinkedQuantity()."', '".$this->getHoldFlag()."', '".$this->getPackFlag()."','".$this->getShipFlag()."','".$this->getRTVFlag()."','".$this->getRejectFlag()."', '".$this->getStatus()."','".$this->getLotno()."', '".$this->getLotType()."', '".$this->getCurtStation()."', GETDATE(),GETDATE(), '".$this->getLastUpdatedBy()."')");
			$conn->close();
		}catch(Exception $e){

		}	
	}

	public function updateStatus(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET curtstation ='".$this->getCurtStation()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), rejectflag = 0 where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateStatus1(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET lotno ='".$this->getLotno()."',curtstation ='".$this->getCurtStation()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), rejectflag = '".$this->getRejectFlag()."', currQuantity = '".$this->getCurrQuantity()."',linecode = '".$this->getLineCode()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updatePacking(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET curtstation ='".$this->getCurtStation()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updatetheLotno(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET lotno ='".$this->getLotno()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function updateQAS($lotno,$curtstation,$updatedby){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET Status = 'GOOD',curtstation = '".$curtstage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where lottype = '".$lotno."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function updateLinkedQty($account,$serialno,$partno,$qty,$lastupdatedby){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET linkedQuantity = '".$qty."', lastupdatedby = '".$lastupdatedby."', lastupdate = getdate() where account = '".$account."' and cardno = '".$serialno."_1' and childpartno = '".$partno."' ");

			$conn->close();
		}catch(Exception $e){

		}
	}

		public function updateCompletion(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET curtstation ='".$this->getCurtStation()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateLotSort(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET lotno = '".$this->getLotno()."', curtstation ='".$this->getCurtStation()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and motherserial = '".$this->getMotherSerialNo()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updatePartno(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET partno ='".$this->getPartNo()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() WHERE account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function replaceSerial($oldserial, $newserial, $updatedby){
		$conn = new Connection();
		$success = true;
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.motherserial where motherserial = '".$newserial."'");

			if (!$conn->has_rows($dataset)){
				$conn->query("UPDATE dbo.motherserial SET cardno = '".$newserial."_1',motherserial = '".$newserial."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where motherserial = '".$oldserial."'");
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
			$conn->query("UPDATE dbo.motherserial SET Status = '".$result."',curtstation = '".$stage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function updateLotNo($serialno, $lotNo, $curtstage, $updatedby){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET lottype = '".$lotNo."', curtstation = '".$curtstage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}	

	public static function checkExist($account,$serialno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.motherserial where account ='".$account."' and cardno = '".$serialno."_1'");

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
			$conn->query("UPDATE dbo.motherserial Set curtstation= '".$nextstage."', lastupdatedby = '".$lastupdatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function getAllSerialByLot($lotNo){
			$conn = new Connection();
			$mothers = array();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.motherserial WHERE lottype = '".$lotNo."'");
				$counter = 0;

				while ($row = $conn->fetch_array($dataset)) {
					$mothers = $row['motherserial'];

					$mothers[$counter]=$mother;
					$counter++;
				}
				$conn->close();
				}catch(Exception $e){

				}
				return $mothers;
		}

	public static function updatelottype($lotno, $sn){
		$conn = new connection();

		try{
			$conn->open();
			$dataset = $conn->query("UPDATE dbo.motherserial set lottype = '".$lotno."' where cardno = '".$sn."_1'");
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
			$conn->query("UPDATE dbo.motherserial SET rejectflag = 1 where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function checkifverify($account,$cardno){
		$conn = new Connection();
		$result = 0;
		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.motherserial where account ='".$account."' and cardno = '".$cardno."_1'");

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
				$dataset = $conn->query("SELECT Count(cardno) as lotquantity FROM dbo.motherserial WHERE account ='".$account."' and lotno = '".$lotNo."'");
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
				$dataset = $conn->query("SELECT Sum(currQuantity) as lotquantity FROM dbo.motherserial WHERE account ='".$account."' and lotno = '".$lotNo."'");
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

			public static function getCountMotherqty($account,$mother){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT Sum(currQuantity) as quantity FROM dbo.motherserial WHERE account ='".$account."' and motherserial = '".$mother."'");
				$counter = 0;

				if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['quantity'];	
				}else{
				$result = 0;
				}

				$conn->close();
				}catch(Exception $e){

				}
				return $result;
		}


	public static function getAllLotno($account,$lotno){
		$conn= new Connection();
		$lotnumber = array();
		
		try{
			$conn->open();
			$result = $conn->query("SELECT * FROM dbo.motherserial where account = '".$account."' AND lotno ='".$lotno."'");
			$counter = 0;
			while ($row = $conn->fetch_array($result)) 
			{
				$lotno = new Mother();
				$lotno->setCardNo($row['motherserial']);
				$lotno->setPartNo($row['partno']);
				$lotno->setStatus($row['status']);
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
			$dataset = $conn->query("SELECT * FROM dbo.motherserial where status = 'REJECT' and account ='".$account."' and lotno = '".$lotno."'");
				$counter = 0;

			while ($reader = $conn->fetch_array($dataset)) {
				$selectReject = new Mother();
				$selectReject->setMotherSerialNo($reader['motherserial']);
				$selectReject->setStatus($reader['status']);
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
			$dataset = $conn->query("SELECT Count(cardno) as rejectcount FROM dbo.motherserial where status = 'REJECT' and account ='".$account."' and lotno = '".$lotno."'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['rejectcount'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}


	public function statusGoodCount($account,$lotno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT Count(cardno) as goodcount FROM dbo.motherserial where status = 'GOOD' and account ='".$account."' and lotno = '".$lotno."'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['goodcount'];	
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
			$dataset = $conn->query("SELECT * FROM dbo.motherserial where account= '".$account."' and motherserial='".$serialno."'");
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
			$dataset = $conn->query("SELECT * FROM dbo.motherserial where account= '".$account."' and motherserial='".$serialno."'");
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
			$conn->query("UPDATE dbo.motherserial Set lotno = '', lastupdatedby = '".$lastupdatedby."', lastupdate = getdate() where motherserial = '".$serialno."' and account ='".$account."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function setLotnoNew($serialno, $lastupdatedby, $account, $station,$lotno){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial Set lotno = '".$lotno."', curtstation ='".$station."', lastupdatedby = '".$lastupdatedby."', lastupdate = getdate() where motherserial = '".$serialno."' and account='".$account."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function checkExistSerial($account,$serialno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.motherserial where account ='".$account."' and motherserial = '".$serialno."'");

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

		public function updateLotSort1(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.motherserial SET  curtstation ='".$this->getCurtStation()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function rejectCount1($account,$lotno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT Sum(currQuantity) as rejectcount FROM dbo.motherserial WHERE status = 'REJECT' and account ='".$account."' and lotno = '".$lotno."'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['rejectcount'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

	public function getRemainingMother($account,$serialno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT COALESCE(sum(currQuantity - linkedquantity),0) as qty
				FROM mes.dbo.motherserial
				WHERE account = '".$account."'
				AND cardno = '".$serialno."_1'
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

	public function getMotherCurtStation($account,$serialno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT curtstation
				FROM mes.dbo.motherserial
				WHERE account = '".$account."'
				AND cardno = '".$serialno."_1'
				");

		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['curtstation'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

	public function getCountChildPartno($account,$serialno,$partno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT currQuantity - linkedQuantity as qty
				FROM [MES].[dbo].[motherserial]
				where account = '".$account."'
				and cardno = '".$serialno."_1'
				and childpartno = '".$partno."' ");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['qty'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

	public function getCurrQtyChildPartno($account,$serialno,$partno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT currQuantity as qty
				FROM [MES].[dbo].[motherserial]
				where account = '".$account."'
				and cardno = '".$serialno."_1'
				and childpartno = '".$partno."' ");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['qty'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

	public function getLinkedQtyChildPartno($account,$serialno,$partno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT linkedQuantity as qty
				FROM [MES].[dbo].[motherserial]
				where account = '".$account."'
				and cardno = '".$serialno."_1'
				and childpartno = '".$partno."' ");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['qty'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}




}


?>