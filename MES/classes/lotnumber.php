<?php
include_once("connection.php");

class LotNumber{

	private $lotid;
	private $account;
	private $lotno;
	private $counter;
	private $referenceNo;
	private $partno;
	private $stage;
	private $status;
	private $samplingSiza;
	private $starttime;
	private $lastupdate;
	private $lastupdatedby;
	private $quantity;
	private $packingref;

	function __construct($account='',$lotno=''){
		
		if(strlen($lotno)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.lotnumber where account ='".$account."' and lotno = '".$lotno."'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setLotid($reader['lotid']);
				$this->setAccount($reader['account']);
				$this->setLotno($reader['lotno']);
				$this->setCounter($reader['counter']);
				$this->setReference($reader['referenceNo']);
				$this->setPartno($reader['partno']);
				$this->setStage($reader['stage']);
				$this->setStatus($reader['status']);
				$this->setSamplingSize($reader['samplingSize']);
				$this->setStarttime($reader['starttime']);
				$this->setLastupdate($reader['lastupdate']);
				$this->setLastupdatedby($reader['lastupdatedby']);
				$this->setQuantity($reader['quantity']);
				$this->setPackingref($reader['packingref']);
			
			}

			$conn->close();
		}catch(Exception $e){

		}
	}

	}


	//setter

	public function setLotid($lotid){
		$this->lotid = $lotid;
	}

	public function setAccount($account){
		$this->account = $account;
	}

	public function setLotno($lotno){
		$this->lotno = $lotno;
	}


	public function setCounter($counter){
		$this->counter = $counter;
	}

	public function setReference($referenceNo){
		$this->referenceNo = $referenceNo;
	}

	public function setPartno($partno){
		$this->partno = $partno;
	}

	public function setStage($stage){
		$this->stage = $stage;
	}


	public function setStatus($status){
		$this->status = $status;
	}


	public function setSamplingSize($samplingSize){
		$this->samplingSize = $samplingSize;
	}


	public function setStarttime($starttime){
		$this->starttime = $starttime;
	}

	public function setLastupdate($lastupdate){
		$this->lastupdate = $lastupdate;
	}

	public function setLastupdatedby($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}

	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}

	public function setPackingref($packingref){
		$this->packingref = $packingref;
	}


//getter
	public function getLotid(){
		return $this->lotid;
	}

	public function getAccount(){
		return $this->account;
	}

	public function getLotno(){
		return $this->lotno;
	}

	public function getCounter(){
		return $this->counter;
	}

	public function getReference(){
		return $this->referenceNo;
	}

	public function getPartno(){
		return $this->partno;
	}

	public function getStage(){
		return $this->stage;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getSamplingSize(){
		return $this->samplingSize;
	}

	public function getStarttime(){
		return $this->starttime;
	}

	public function getLastUpdate(){
		return $this->lastupdate;
	}

	public function getLastUpdatedBy(){
		return $this->lastupdatedby;
	}

	public function getQuantity(){
		return $this->quantity;
	}

	public function getPackingref(){
		return $this->packingref;
	}


	public static function lotcheckExist($account,$lotno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.lotnumber where account ='".$account."' and lotno = '".$lotno."'");

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


	public static function referencelotcheckExist($account,$lotno,$referenceNo){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.lotnumber where account ='".$account."' and lotno = '".$lotno."' and referenceNo = '".$referenceNo."'");

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

		public static function referencelotcheckExist1($account,$referenceNo){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.lotnumber where account ='".$account."' and referenceNo = '".$referenceNo."'");

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


		public static function referencebatchcheckExist($account,$referenceNo){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.batch where account ='".$account."' and refno = '".$referenceNo."'");

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


		public static function referencecardcheckExist($account,$referenceNo){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and lottype = '".$referenceNo."'");

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

	public function addLot(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.lotnumber VALUES('".$this->getAccount()."','".$this->getLotno()."','".$this->getCounter()."','".$this->getReference()."','".$this->getPartno()."', '".$this->getStage()."', '".$this->getStatus()."', '".$this->getSamplingSize()."',GETDATE(), GETDATE(),'".$this->getLastUpdatedBy()."','".$this->getQuantity()."','".$this->getPackingref()."')");
			$conn->close();
		}catch(Exception $e){

		}	
	}

	public function updateLotStatus(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET partno ='".$this->getPartno()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), quantity ='".$this->getQuantity()."' where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateLotRefStatus(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET partno ='".$this->getPartno()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), quantity ='".$this->getQuantity()."' where account ='".$this->getAccount()."' and referenceNo = '".$this->getReference()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}



	public function updateQASStatus(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET  status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(),stage ='".$this->getStage()."' where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}



	public function updateLotQas(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET stage ='".$this->getStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), samplingSize ='".$this->getSamplingSize()."' where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateRefQas(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET stage ='".$this->getStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), samplingSize ='".$this->getSamplingSize()."' where account ='".$this->getAccount()."' and referenceNo = '".$this->getReference()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateLotPacking(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET stage ='".$this->getStage()."', status = '".$this->getStatus()."', packingref = '".$this->getPackingref()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public function updateLotCompletion(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET stage ='".$this->getStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function updateLotSorting(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET stage ='".$this->getStage()."', status = '".$this->getStatus()."',quantity = '".$this->getQuantity()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

		public function updateLotSortingref(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET stage ='".$this->getStage()."', status = '".$this->getStatus()."',quantity = '".$this->getQuantity()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and referenceNo = '".$this->getReference()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

		public function updatelotlink(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.lotnumber SET referenceNo ='".$this->getReference()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE() where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function getseq($account){
		$conn = new Connection();
		$trackingcount = 0;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT top 1 format(cast(SUBSTRING(lotno,12,4) as int),'000') lotno
FROM dbo.lotnumber
WHERE account = '".$account."'

AND starttime > cast(getdate() as date)
ORDER BY lotno desc");

			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$trackingcount = $reader['lotno'];
				$trackingcount = intval($trackingcount) + 1;
				if(strlen($trackingcount)==1){
					$trackingcount = '000'.$trackingcount;
				}else if(strlen($trackingcount)==2){
					$trackingcount = '00'.$trackingcount;
				}else if(strlen($trackingcount)==3){
					$trackingcount = '0'.$trackingcount;
				}

			}else{
				$trackingcount = '0001';
			}

			$conn->close();
		}catch(Exception $e){

		}
		return $trackingcount;
	}


public static function getAllLotandReference($account,$lotno,$referenceNo)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.lotnumber WHERE account = '".$account."' AND lotno = '".$lotno."' AND referenceNo = '".$referenceNo."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				$Select = new LotNumber();
				$Select->setLotid($reader['lotid']);
				$Select->setAccount($reader['account']);
				$Select->setLotno($reader['lotno']);
				$Select->setCounter($reader['counter']);
				$Select->setReference($reader['referenceNo']);
				$Select->setPartno($reader['partno']);
				$Select->setStage($reader['stage']);
				$Select->setStatus($reader['status']);
				$Select->setSamplingSize($reader['samplingSize']);
				$Select->setStarttime($reader['starttime']);
				$Select->setLastupdate($reader['lastupdate']);
				$Select->setLastupdatedby($reader['lastupdatedby']);
				$Select->setQuantity($reader['quantity']);
				$Select->setPackingref($reader['packingref']);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

	public static function getReferenceDetails($account,$referenceNo)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.lotnumber WHERE account = '".$account."' AND referenceNo = '".$referenceNo."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				$Select = new LotNumber();
				$Select->setLotid($reader['lotid']);
				$Select->setAccount($reader['account']);
				$Select->setLotno($reader['lotno']);
				$Select->setCounter($reader['counter']);
				$Select->setReference($reader['referenceNo']);
				$Select->setPartno($reader['partno']);
				$Select->setStage($reader['stage']);
				$Select->setStatus($reader['status']);
				$Select->setSamplingSize($reader['samplingSize']);
				$Select->setStarttime($reader['starttime']);
				$Select->setLastupdate($reader['lastupdate']);
				$Select->setLastupdatedby($reader['lastupdatedby']);
				$Select->setQuantity($reader['quantity']);
				$Select->setPackingref($reader['packingref']);
				$Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

		public static function getCountRefByLot($account,$lotNo){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT Count(referenceNo) as quantity FROM dbo.lotnumber WHERE account ='".$account."' and lotno = '".$lotNo."'");
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

				public static function getTotalLotqty($account,$lotNo){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT Sum(quantity) as quantity FROM dbo.lotnumber WHERE account ='".$account."' and lotno = '".$lotNo."'");
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

					public static function getQty($account,$referenceNo){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT count (a.serialno) as Qty FROM dbo.card a INNER JOIN dbo.lotnumber b on a.lotno = b.lotno WHERE b.referenceNo = '".$referenceNo."' AND b.account = '".$account."'");
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


		public static function refbatchcheckExist($account,$refno){
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


		public static function refcardcheckExist($account,$refno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and lottype = '".$refno."'");

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


	

}




?>