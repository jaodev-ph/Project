<?php

include_once("connection.php");

class Repair{

	private $trackingno;
	private $account;
	private $cardno;
	private $stage;
	private $machine;
	private $category;
	private $defect;
	private $location;
	private $details;
	private $status;
	private $addinfo;
	private $serialaffected;
	private $component;
	private $remarks;
	private $rejectdate;
	private $rejectuser;
	private $repairdate;
	private $repairuser;
	private $lastupdate;
	private $lastupdatedby;

	function __construct($account = '',$serialno = ''){
		$conn = new Connection();
		if(strlen($serialno>0)){
			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.log_repair where account = '".$account."' and cardno = '".$serialno."'");
				
				if($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
					$this->setTrackingNo($reader['trackingno']);
					$this->setCardno($reader['cardno']);
					$this->setStage($reader['stage']);
					$this->setMachine($reader['machine']);
					$this->setCategory($reader['category']);
					$this->setDefect($reader['defect']);
					$this->setLocation($reader['location']);
					$this->setDetails($reader['details']);
					$this->setStatus($reader['status']);
					$this->setAddInfo($reader['addinfo']);
					$this->setSerialAffected($reader['serialaffected']);
					$this->setComponent($reader['component']);
					$this->setRemarks($reader['remarks']);
					$this->setRejectDate($reader['rejectdate']);
					$this->setRejectUser($reader['repairuser']);
					$this->setRepairDate($reader['repairdate']);
					$this->setRepairUser($reader['repairuser']);
					$this->setLastUpdate($reader['lastupdate']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
				}
				$conn->close();
			}catch(Exception $e){

			}
		}
	}

	public function setTrackingNo($trackingno){
			$this->trackingno = $trackingno;
	}

	public function setAccount($account){
			$this->account = $account;
	}

	public function setCardno($cardno){
			$this->cardno = $cardno;
	}

	public function setStage($stage){
			$this->stage = $stage;
	}

	public function setMachine($machine){
			$this->machine = $machine;
	}

	public function setCategory($category){
			$this->category = $category;
	}

	public function setDefect($defect){
			$this->defect = $defect;
	}

	public function setLocation($location){
			$this->location = $location;
	}

	public function setDetails($details){
			$this->details = $details;
	}

	public function setStatus($status){
			$this->status = $status;
	}

	public function setAddInfo($addinfo){
			$this->addinfo = $addinfo;
	}

	public function setSerialAffected($serialaffected){
			$this->serialaffected = $serialaffected;
	}

	public function setComponent($component){
			$this->component = $component;
	}

	public function setRemarks($remarks){
			$this->remarks = $remarks;
	}

	public function setRejectDate($rejectdate){
			$this->rejectdate = $rejectdate;
	}

	public function setRejectUser($rejectuser){
			$this->rejectuser = $rejectuser;
	}

	public function setRepairDate($repairdate){
			$this->repairdate = $repairdate;
	}

	public function setRepairUser($repairuser){
			$this->repairuser = $repairuser;
	}

	public function setLastUpdate($lastupdate){
			$this->lastupdate = $lastupdate;
	}

	public function setLastUpdatedBy($lastupdatedby){
			$this->lastupdatedby = $lastupdatedby;
	}

	//Getter
	public function getTrackingNo(){
		return $this->trackingno;
	}

	public function getAccount(){
		return $this->account;
	}

	public function getCardno(){
		return $this->cardno;
	}

	public function getStage(){
		return $this->stage;
	}

	public function getMachine(){
		return $this->machine;
	}

	public function getCategory(){
		return $this->category;
	}

	public function getDefect(){
		return $this->defect;
	}

	public function getLocation(){
		return $this->location;
	}

	public function getDetails(){
		return $this->details;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getAddInfo(){
		return $this->addinfo;
	}

	public function getSerialAffected(){
		return $this->serialaffected;
	}

	public function getComponet(){
		return $this->component;
	}

	public function getRemarks(){
		return $this->remarks;
	}

	public function getRejectDate(){
		return $this->rejectdate;
	}

	public function getRejectUser(){
		return $this->rejectuser;
	}

	public function getRepairDate(){
		return $this->repairdate;
	}

	public function getRepairUser(){
		return $this->repairuser;
	}

	public function getLastUpdate(){
		return $this->lastupdate;
	}

	public function getLastUpdatedBy(){
		return $this->lastupdatedby;
	}


	public function addRepair(){
		$conn = new Connection;
		try{
			$conn->open();
	
			$conn->query("INSERT INTO dbo.log_repair VALUES('".$this->getAccount()."', '".$this->getCardno()."', '".$this->getStage()."', '".$this->getMachine()."', '".$this->getCategory()."', '".$this->getDefect()."', '".$this->getLocation()."', '".$this->getDetails()."', '".$this->getStatus()."', '".$this->getAddInfo()."', '".$this->getSerialAffected()."', '".$this->getComponet()."','".$this->getRemarks()."', GETDATE(), '".$this->getRejectUser()."', '".$this->getRepairDate()."', '".$this->getRepairUser()."', GETDATE(), '".$this->getLastUpdatedBy()."')");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function GetAllReject($account,$serialno)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.log_repair where account = '".$account."' and cardno = '".$serialno."_1' and status = 0 order by trackingno" );
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Repair();
				 	$Select->setTrackingNo($reader['trackingno']);
					$Select->setCardno($reader['cardno']);
					$Select->setStage($reader['stage']);
					$Select->setMachine($reader['machine']);
					$Select->setCategory($reader['category']);
					$Select->setDefect($reader['defect']);
					$Select->setLocation($reader['location']);
					$Select->setDetails($reader['details']);
					$Select->setStatus($reader['status']);
					$Select->setAddInfo($reader['addinfo']);
					$Select->setSerialAffected($reader['serialAffected']);
					$Select->setComponent($reader['component']);
					$Select->setRemarks($reader['remarks']);
					$Select->setRejectDate($reader['rejectDate']);
					$Select->setRejectUser($reader['repairUser']);
					$Select->setRepairDate($reader['repairDate']);
					$Select->setRepairUser($reader['repairUser']);
					$Select->setLastUpdate($reader['lastupdate']);
					$Select->setLastUpdatedBy($reader['lastupdatedby']);
				 $result[$counter] = $Select;
				 $counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

public function updateRepair($account,$trackingno,$cardno,$name,$remarks){
		$conn = new Connection;
		try{
			$conn->open();
	
			$conn->query("UPDATE dbo.log_repair SET status = 1, repairDate = GETDATE(), repairUser ='".$name."', lastupdate = GETDATE(), lastupdatedby ='".$name."', remarks='".$remarks."' WHERE account ='".$account."' and trackingno ='".$trackingno."' and cardno ='".$cardno."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}

public static function countReject($account,$serialno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.log_repair where account ='".$account."' and cardno = '".$serialno."_1' and status = 0");

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


public function updateRejectDetail($account,$cardno,$trackingnos,$cmbrejectcat2,$cmbrejectcode2,$txtlocation2,$txtdetails2){
		$conn = new Connection;
		try{
			$conn->open();
	
			$conn->query("UPDATE dbo.log_repair SET category = '".$cmbrejectcat2."', defect = '".$cmbrejectcode2."', location ='".$txtlocation2."', details = '".$txtdetails2."' WHERE account ='".$account."' and trackingno ='".$trackingnos."' and cardno ='".$cardno."_1'");

			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function GetAllReject2($account,$serialno)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.log_repair where account = '".$account."' and cardno = '".$serialno."' order by trackingno" );
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Repair();
				 	$Select->setTrackingNo($reader['trackingno']);
					$Select->setCardno($reader['cardno']);
					$Select->setStage($reader['stage']);
					$Select->setMachine($reader['machine']);
					$Select->setCategory($reader['category']);
					$Select->setDefect($reader['defect']);
					$Select->setLocation($reader['location']);
					$Select->setDetails($reader['details']);
					$Select->setStatus($reader['status']);
					$Select->setAddInfo($reader['addinfo']);
					$Select->setSerialAffected($reader['serialAffected']);
					$Select->setComponent($reader['component']);
					$Select->setRemarks($reader['remarks']);
					$Select->setRejectDate($reader['rejectDate']);
					$Select->setRejectUser($reader['repairUser']);
					$Select->setRepairDate($reader['repairDate']);
					$Select->setRepairUser($reader['repairUser']);
					$Select->setLastUpdate($reader['lastupdate']);
					$Select->setLastUpdatedBy($reader['lastupdatedby']);
				 $result[$counter] = $Select;
				 $counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

			public static function getRejectStatus($account,$serialno){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT count (status) as status FROM dbo.log_repair where account = '".$account."' and cardno = '".$serialno."_1' and status = 1");
				$counter = 0;

				if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['status'];	
				}else{
				$result = 0;
				}

				$conn->close();
				}catch(Exception $e){

				}
				return $result;
		}

			public static function getRejectStatus1($account,$serialno){
			$conn = new Connection();
			$result = 0;

			try{
				$conn->open();
				$dataset = $conn->query("SELECT count (status) as status FROM dbo.log_repair where account = '".$account."' and cardno = '".$serialno."_1' and status = 0");
				$counter = 0;

				if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader['status'];	
				}else{
				$result = 0;
				}

				$conn->close();
				}catch(Exception $e){

				}
				return $result;
		}
	


}


?>