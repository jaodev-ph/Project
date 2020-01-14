<?php
include_once("connection.php");

class LogBatch{

	private $trackingno;
	private $account;
	private $batchno;
	private $line;
	private $sequence;
	private $station;
	private $machine;
	private $curtstage;
	private $description;
	private $status;
	private $lastupdate;
	private $lastupdatedby;
	private $currquantity;
	private $disquantity;
	private $remarks;

	function __construct(){

	}

	//setter
	public function setTrackingNo($trackingno){
		$this->trackingno = $trackingno;
	}

	public function setAccount($account){
		$this->account = $account;
	}

	public function setBatchno($batchno){
		$this->batchno = $batchno;
	}

	public function setLine($line){
		$this->line = $line;
	}

	public function setSequence($sequence){
		$this->sequence = $sequence;
	}

	public function setStation($station){
		$this->station = $station;
	}

	public function setMachine($machine){
		$this->machine = $machine;
	}

	public function setCurtstage($curtstage){
		$this->stage = $curtstage;
	}

	public function setDescription($description){
		$this->description = $description;
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
		$this->disquantity = $disquantity;
	}

	public function setRemarks($remarks){
		$this->remarks = $remarks;
	}



	//getter
	public function getTrackingNo(){
		return $this->trackingno;
	}

	public function getAccount(){
		return $this->account;
	}

	public function getBatchno(){
		return $this->batchno;
	}

	public function getLine(){
		return $this->line;
	}

	public function getSequence(){
		return $this->sequence;		
	}

	public function getStation(){
		return $this->station;
	}

	public function getMachine(){
		return $this->machine;
	}

	public function getCurtstage(){
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
		return $this->disquantity;
	}
	public function getRemarks(){
		return $this->remarks;
	}


	public function addLogbatch(){
		$conn = new Connection();

		try{
			$conn->open();

			$conn->query("INSERT INTO dbo.log_batch VALUES('".$this->getAccount()."','".$this->getBatchno()."_1','".$this->getCurtstage()."','".$this->getCurrquantity()."','".$this->getDisquantity()."', '".$this->getRemarks()."', '".$this->getStatus()."',GETDATE(), '".$this->getLastUpdatedBy()."', '".$this->getLine()."')");

			$conn->close();
		}catch(Exception $e){

		}	
	}



	public static function viewAllLogBatch($account,$cardno){
		$conn = new Connection();
		$logs = array();
		$stationdesc ='';
		try{
			$conn->open();
			$dataset = $conn->query(" SELECT * FROM dbo.log_batch where account = '".$account."' and batchno = '".$cardno."' order by lastupdate asc");
			$counter = 0;

			while($reader = $conn->fetch_array($dataset)){
				$log = new LogBatch();
				$log->setTrackingNo($reader["trackingno"]);
				$log->setBatchno($reader["batchno"]);
				$log->setCurtstage($reader['stage']);
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

	

	public static function getHistory($card){
		$conn = new Connection();
		$hasreject = false;
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.log_batch where batchno = '".$card."_1' and status = 'REJECT'");

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