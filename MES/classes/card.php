<?php
include_once("connection.php");

class Card{

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



	function __construct($account='',$serialno=''){
		
		if(strlen($serialno)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and cardno = '".$serialno."_1'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setAccount($reader['account']);
				$this->setCardNo($reader['cardno']);
				$this->setSerialNo($reader['serialno']);
				$this->setSystem21($reader['system21']);
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
				$this->setCurtStage($reader['curtstation']);
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


	public function setSerialNo($serialno){
		$this->serialno = $serialno;
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


//getter

	public function getAccount(){
		return $this->account;
	}

	public function getCardno(){
		return $this->cardno;
	}

	public function getSerialNo(){
		return $this->serialno;
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


		public function updateStatusRTS(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.card SET curtstation ='".$this->getCurtStage()."', lotno = '".$this->getLotno()."', lottype = '".$this->getLotType()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), rejectflag = 0 where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

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


	public function updatetheLotnoRef(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.card SET lotno ='".$this->getLotno()."',lottype ='".$this->getLotType()."' where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

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

		public function updateCompletion(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.Card SET curtstation ='".$this->getCurtStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateLotSort(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.Card SET lotno = '".$this->getLotno()."', curtstation ='".$this->getCurtStage()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and serialno = '".$this->getCardno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

		public function updateLotSortref(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.Card SET lotno = '".$this->getLotno()."', lottype = '".$this->getLotType()."',curtstation ='".$this->getCurtStage()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and serialno = '".$this->getCardno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updatePartno(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.card SET partno ='".$this->getPartNo()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() WHERE account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

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

	public static function checkExist($account,$serialno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and cardno = '".$serialno."_1'");

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

		public static function refcheckExist($account,$lottype){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and lottype = '".$lottype."'");

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

			public static function getCountSerialByRef($account,$lottype){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT Count(cardno) as lotquantity FROM dbo.card WHERE account ='".$account."' and lottype = '".$lottype."'");
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

					public static function getCountSerialByLotRef($account,$lotNo,$refno){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT Count(cardno) as lotquantity FROM dbo.card WHERE account ='".$account."' and lotno = '".$lotNo."'and lottype = '".$refno."'");
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


	public static function getAllLotno($account,$lotno){
		$conn= new Connection();
		$lotnumber = array();
		
		try{
			$conn->open();
			$result = $conn->query("SELECT * FROM dbo.card where account = '".$account."' AND lotno ='".$lotno."'");
			$counter = 0;
			while ($row = $conn->fetch_array($result)) 
			{
				$lotno = new Card();
				$lotno->setCardNo($row['serialno']);
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
			$dataset = $conn->query("SELECT * FROM dbo.card where status = 'REJECT' and account ='".$account."' and lotno = '".$lotno."'");
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


public function showRejectref($account,$lottype){
		$conn = new Connection();
	
		$serialnumber = array();

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where status = 'REJECT' and account ='".$account."' and lottype = '".$lottype."'");
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


		public static function rejectexist($account,$lottype){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where status = 'REJECT' and account ='".$account."' and lottype = '".$lottype."'");

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


	public function rejectCountRef($account,$lottype){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT Count(cardno) as rejectcount FROM dbo.card where status = 'REJECT' and account ='".$account."' and lottype = '".$lottype."'");


		if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['rejectcount'];	
				}

			$conn->close();

		}catch(Exception $e){

		}
		return $result;
	}

		public function obarejectCountRef($account,$lottype){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT Count(cardno) as rejectcount FROM dbo.card where status = 'REJECT' and account ='".$account."' and lottype = '".$lottype."'");


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
			$dataset = $conn->query("SELECT Count(cardno) as goodcount FROM dbo.card where status = 'GOOD' and account ='".$account."' and lotno = '".$lotno."'");


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

				public static function getAllLotSerialRef($account,$lotno,$refno){
			$conn = new Connection();
			$cards = array();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.card WHERE account = '".$account."' and lotno = '".$lotno."' and lottype = '".$refno."'");
				$counter = 0;

				while ($row = $conn->fetch_array($dataset)) {
					$card = new Card();
					$card->setSerialNo($row['serialno']);
					$card->setStatus($row['status']);
					$card->setPartNo($row['partno']);
					$card->setLastUpdate($row['lastupdate']->format('F j, Y, g:i a'));
					$card->setLastUpdatedBy($row['lastupdatedby']);

					$cards[$counter]=$card;
					$counter++;
				}
				$conn->close();
				}catch(Exception $e){

				}
				return $cards;
		}

			public static function getAllSerialRef($account,$lottype){
			$conn = new Connection();
			$cards = array();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.card WHERE account = '".$account."' and lottype = '".$lottype."'");
				$counter = 0;

				while ($row = $conn->fetch_array($dataset)) {
					$card = new Card();
					$card->setSerialNo($row['serialno']);
					$card->setStatus($row['status']);
					$card->setPartNo($row['partno']);
					$card->setLastUpdate($row['lastupdate']->format('F j, Y, g:i a'));
					$card->setLastUpdatedBy($row['lastupdatedby']);

					$cards[$counter]=$card;
					$counter++;
				}
				$conn->close();
				}catch(Exception $e){

				}
				return $cards;
		}

					public static function getLotSerialRejectref($account,$lottype){
		$conn = new Connection();
		$result = false;
		try{

			$conn->open();
			$dataset = $conn->query("SELECT status FROM dbo.card where account = '".$account."' AND lottype ='".$lottype."' AND status ='REJECT'");

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

	public function getCarddetails($account,$serialno){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and cardno = '".$serialno."_1'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setAccount($reader['account']);
				$this->setCardNo($reader['cardno']);
				$this->setSerialNo($reader['serialno']);
				$this->setSystem21($reader['system21']);
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
				$this->setCurtStage($reader['curtstation']);
				$this->setStartTime($reader['starttime']);
				$this->setLastUpdate($reader['lastupdate']);
				$this->setLastUpdatedBy($reader['lastupdatedby']);
			}

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function getCardCurtStation($account,$serialno){
		$conn = new Connection();
		$result = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT curtstation
				FROM mes.dbo.card
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

}


?>