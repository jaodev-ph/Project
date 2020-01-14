<?php
include_once("connection.php");

class LogMother{

	private $trackingno;
	private $account;
	private $motherserial;
	private $stage;
	private $line;
	private $currquantity;
	private $disquantity;
	private $remarks;
	private $status;
	private $lastupdate;
	private $lastupdatedby;
	private $childpartno;


	function __construct(){

	}

	//setter
	public function setTrackingNo($trackingno){
		$this->trackingno = $trackingno;
	}

	public function setAccount($account){
		$this->account = $account;
	}

	public function setMotherSerial($motherserial){
		$this->motherserial = $motherserial;
	}

	public function setStage($stage){
		$this->stage = $stage;
	}

	public function setLine($line){
		$this->line = $line;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function setLastUpdate($lastupdate){
		$this->lastupdate = $lastupdate;
	}

	public function setLastUpdatedBy($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}


	public function setCurrquantity($currquantity){
		$this->currquantity = $currquantity;
	}

	public function setDisquantity($disquantity){
		$this->rejquantity = $disquantity;
	}

	public function setRemarks($remarks){
		$this->remarks = $remarks;
	}

	public function setChildPartno($childpartno){
		$this->childpartno = $childpartno;
	}



	//getter
	public function getTrackingNo(){
		return $this->trackingno;
	}

	public function getAccount(){
		return $this->account;
	}

	public function getMotherSerial(){
		return $this->motherserial;
	}

	public function getLine(){
		return $this->line;
	}

	public function getStage(){
		return $this->stage;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getLastUpdate(){
		return $this->lastupdate;
	}

	public function getLastUpdatedBy(){
		return $this->lastupdatedby;
	}

	public function getCurrquantity(){
		return $this->currquantity;
	}

	public function getDisquantity(){
		return $this->rejquantity;
	}
	public function getRemarks(){
		return $this->remarks;
	}

	public function getChildPartno(){
		return $this->childpartno;
	}


	public function addLogMother(){
		$conn = new Connection();

		try{
			$conn->open();

			$conn->query("INSERT INTO dbo.log_mother VALUES('".$this->getAccount()."','".$this->getMotherSerial()."','".$this->getChildPartno()."','".$this->getStage()."','".$this->getLine()."','".$this->getCurrquantity()."','".$this->getDisquantity()."', '".$this->getRemarks()."', '".$this->getStatus()."',GETDATE(), '".$this->getLastUpdatedBy()."')");

			$conn->close();
		}catch(Exception $e){

		}	
	}



	public static function viewAllLogMother($account,$motherserial){
		$conn = new Connection();
		$logs = array();
		$stationdesc ='';
		try{
			$conn->open();
			$dataset = $conn->query(" SELECT * FROM dbo.log_mother where account = '".$account."' and motherserial = '".$motherserial."' order by lastupdate asc");
			$counter = 0;

			while($reader = $conn->fetch_array($dataset)){
				$log = new LogMother();
				$log->setTrackingNo($reader["trackingno"]);
				$log->setMotherSerial($reader["motherserial"]);
				$log->setChildPartno($reader["childpartno"]);
				$log->setStage($reader['stage']);
				// $log->setDescription($reader['description']);
				// $log->setMachine($reader['machine']);
				$log->setStatus($reader["status"]);
				$log->setLine($reader["line"]);
				$log->setLastUpdate($reader["lastupdate"]->format('Y-m-d h:i:s a'));
				$log->setLastUpdatedBy($reader["lastupdatedby"]);
				$log->setCurrquantity($reader["currquantity"]);
				$log->setDisquantity($reader["rejquantity"]);
				$log->setRemarks($reader["remarks"]);

				$logs[$counter] = $log;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){

		}

		return $logs;
	}

	

	public static function getHistory($motherserial){
		$conn = new Connection();
		$hasreject = false;
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.log_mother where motherserial = '".$motherserial."' and status = 'REJECT'");

			if($conn->has_rows($dataset)){
				$hasreject = true;
			}
			$conn->close();
		}catch(Exception $e){

		}

		return $hasreject;
	}

}
?>