<?php
include_once("connection.php");

class Packing{

	private $account;
	private $packingno;
	private $refno;
	private $partno;
	private $stage;
	private $status;
	private $quantity;
	private $starttime;
	private $lastupdate;
	private $lastupdatedby;
	private $remarks;


	function __construct($account='',$packingno=''){
		
		if(strlen($packingno)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.packing where account ='".$account."' and packingno = '".$packingno."'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setAccount($reader['account']);
				$this->setPackingno($reader['packingno']);
				$this->setRefno($reader['refno']);
				$this->setPartno($reader['partno']);
				$this->setStage($reader['stage']);
				$this->setStatus($reader['status']);
				$this->setQuantity($reader['quantity']);
				$this->setStarttime($reader['starttime']);
				$this->setLastupdate($reader['lastupdate']);
				$this->setLastupdatedby($reader['lastupdateby']);
				$this->setRemarks($reader['remarks']);
			
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

	public function setPackingno($packingno){
		$this->packingno = $packingno;
	}


	public function setRefno($refno){
		$this->refno = $refno;
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


	public function setQuantity($quantity){
		$this->quantity = $quantity;
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

	public function setRemarks($remarks){
		$this->remarks = $remarks;
	}


//getter


	public function getAccount(){
		return $this->account;
	}

	public function getPackingno(){
		return $this->packingno;
	}

	public function getRefno(){
		return $this->refno;
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

	public function getQuantity(){
		return $this->quantity;
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

	public function getRemarks(){
		return $this->remarks;
	}


	public static function packingcheckExist($account,$packingno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.packing where account ='".$account."' and packingno = '".$packingno."'");

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


	public function addPacking(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.packing VALUES('".$this->getAccount()."','".$this->getPackingno()."', '".$this->getRefno()."','".$this->getPartno()."', '".$this->getStage()."', '".$this->getStatus()."', '".$this->getQuantity()."',GETDATE(), GETDATE(),'".$this->getLastUpdatedBy()."','".$this->getRemarks()."')");
			$conn->close();
		}catch(Exception $e){

		}	
	}


	public function updatePackingStatus(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.packing SET  status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(),stage ='".$this->getStage()."',quantity ='".$this->getQuantity()."' where account ='".$this->getAccount()."' and packingno = '".$this->getPackingno()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	// public function updateLotStatus(){
	// 	$conn = new Connection();

	// 	try{
	// 		$conn->open();
	// 		$conn->query("UPDATE dbo.lotnumber SET partno ='".$this->getPartno()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), quantity ='".$this->getQuantity()."' where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}
	// }

	// public function updateQASStatus(){
	// 	$conn = new Connection();

	// 	try{
	// 		$conn->open();
	// 		$conn->query("UPDATE dbo.lotnumber SET  status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(),stage ='".$this->getStage()."' where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}
	// }



	// public function updateLotQas(){
	// 	$conn = new Connection();

	// 	try{
	// 		$conn->open();
	// 		$conn->query("UPDATE dbo.lotnumber SET stage ='".$this->getStage()."', status = '".$this->getStatus()."', lastupdatedby = '".$this->getLastUpdatedBy()."', lastupdate = GETDATE(), samplingSize ='".$this->getSamplingSize()."' where account ='".$this->getAccount()."' and lotno = '".$this->getLotno()."'");

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}
	// }

	// public static function updateQAS($lotno,$curtstage,$updatedby){
	// 	$conn = new Connection();

	// 	try{
	// 		$conn->open();
	// 		$conn->query("UPDATE dbo.Card SET Status = 'GOOD',curtstage = '".$curtstage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where lottype = '".$lotno."'");

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}
	// }

	// public static function replaceSerial($oldserial, $newserial, $updatedby){
	// 	$conn = new Connection();
	// 	$success = true;
	// 	try{
	// 		$conn->open();
	// 		$dataset = $conn->query("SELECT * FROM dbo.card where serialno = '".$newserial."'");

	// 		if (!$conn->has_rows($dataset)){
	// 			$conn->query("UPDATE dbo.Card SET cardno = '".$newserial."_1',serialno = '".$newserial."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where serialno = '".$oldserial."'");
	// 			$conn->query("UPDATE dbo.log_pass SET cardno = '".$newserial."_1' where cardno = '".$oldserial."_1'");
	// 		}else{
	// 			$success = false;
	// 		}

	// 		$conn->close();
	// 	}catch(Exception $e){
	// 			$success = false;
	// 	}

	// 	return $success;	
	// }

	// public static function updateStatus2($serialno, $result,$stage, $updatedby){
	// 	$conn = new Connection();

	// 	try{
	// 		$conn->open();
	// 		$conn->query("UPDATE dbo.Card SET Status = '".$result."',curtstage = '".$stage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}
	// }

	// public static function updateLotNo($serialno, $lotNo, $curtstage, $updatedby){
	// 	$conn = new Connection();

	// 	try{
	// 		$conn->open();
	// 		$conn->query("UPDATE dbo.Card SET lottype = '".$lotNo."', curtstage = '".$curtstage."', lastupdatedby = '".$updatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}
	// }	

	// public static function checkExist($account,$serialno){
	// 	$conn = new Connection();
	// 	$result = 'false';

	// 	try{
	// 		$conn->open();
	// 		$dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and cardno = '".$serialno."_1'");

	// 		if($conn->has_rows($dataset)){
				
	// 			$result = 'true';
							
	// 		}else{
	// 			$result = 'false';
	// 		}	
			
	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}
	// 	return $result;
	// }


	// public static function setNextStage($serialno, $nextstage, $lastupdatedby){
	// 	$conn = new Connection();

	// 	try{
	// 		$conn->open();
	// 		$conn->query("UPDATE dbo.Card Set curtstage= '".$nextstage."', lastupdatedby = '".$lastupdatedby."', lastupdate = getdate() where cardno = '".$serialno."_1'");

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}
	// }


	// public static function getAllSerialByLot($lotNo){
	// 		$conn = new Connection();
	// 		$cards = array();

	// 		try{
	// 			$conn->open();
	// 			$dataset = $conn->query("SELECT * FROM dbo.card WHERE lottype = '".$lotNo."'");
	// 			$counter = 0;

	// 			while ($row = $conn->fetch_array($dataset)) {
	// 				$card = $row['serialno'];

	// 				$cards[$counter]=$card;
	// 				$counter++;
	// 			}
	// 			$conn->close();
	// 			}catch(Exception $e){

	// 			}
	// 			return $cards;
	// 	}

	// public static function updatelottype($lotno, $sn){
	// 	$conn = new connection();

	// 	try{
	// 		$conn->open();
	// 		$dataset = $conn->query("UPDATE dbo.card set lottype = '".$lotno."' where cardno = '".$sn."_1'");
	// 		$conn->close();

	// 	}catch(Exception $e){

	// 	}
	// }

	// public static function cardpallet($sn){
	// 	$conn = new connection();
	// 	$pallet ='';
	// 	$exist = false;

	// 	try{

	// 		$conn->open();
	// 		$dataset = $conn->query("SELECT * FROM dbo.PalletWithSerialLog where SerialNo = '".$sn."'");

	// 		if ($conn->has_rows($dataset)){
	// 			$reader = $conn->fetch_array($dataset);
	// 			$pallet = $reader['PalletNo'];	
	// 			$exist = true;
	// 		}else{
	// 			$exist = false;
	// 		}

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}

	// 	if($exist == false)
	// 	{
	// 		try{

	// 		$conn->open();
	// 		$dataset = $conn->query("SELECT * FROM dbo.PalletWithSerialLog_archive where SerialNo = '".$sn."'");

	// 		if ($conn->has_rows($dataset)){
	// 			$reader = $conn->fetch_array($dataset);
	// 			$pallet = $reader['PalletNo'];	
	// 		}

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}

	// 	}

	// return $pallet;

	// }


	// public function updateVarify(){
	// 	$conn = new Connection();

	// 	try{
	// 		$conn->open();
	// 		$conn->query("UPDATE dbo.card SET rejectflag = 1 where account ='".$this->getAccount()."' and cardno = '".$this->getCardno()."_1'");

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}
	// }


	// public static function checkifverify($account,$cardno){
	// 	$conn = new Connection();
	// 	$result = 0;
	// 	try{

	// 		$conn->open();
	// 		$dataset = $conn->query("SELECT * FROM dbo.card where account ='".$account."' and cardno = '".$cardno."_1'");

	// 		if ($conn->has_rows($dataset)){
	// 			$reader = $conn->fetch_array($dataset);
	// 			$result = $reader['rejectflag'];	
	// 		}else{
	// 			$result = 0;
	// 		}

	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}

	// 	return $result;

	// }

}




?>