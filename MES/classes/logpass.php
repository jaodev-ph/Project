<?php
include_once("connection.php");

class LogPass{

	private $trackingno;
	private $account;
	private $cardno;
	private $line;
	private $sequence;
	private $station;
	private $machine;
	private $curtstage;
	private $description;
	private $status;
	private $lastupdate;
	private $lastupdatedby;

	function __construct(){

	}

	//setter
	public function setTrackingNo($trackingno){
		$this->trackingno = $trackingno;
	}

	public function setAccount($account){
		$this->account = $account;
	}

	public function setCardNo($cardno){
		$this->cardno = $cardno;
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
		$this->curtstage = $curtstage;
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

	//getter
	public function getTrackingNo(){
		return $this->trackingno;
	}

	public function getAccount(){
		return $this->account;
	}

	public function getCardNo(){
		return $this->cardno;
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
		return $this->curtstage;
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

	public function addLogpass(){
		$conn = new Connection();

		try{
			$conn->open();

			$conn->query("INSERT INTO dbo.log_pass VALUES('".$this->getAccount()."','".$this->getCardNo()."_1','".$this->getLine()."','".$this->getSequence()."','".$this->getStation()."', '".$this->getMachine()."', '".$this->getStatus()."',GETDATE(), '".$this->getLastUpdatedBy()."')");

			$conn->close();
		}catch(Exception $e){

		}	
	}



	public static function viewAllLogPass($account,$cardno){
		$conn = new Connection();
		$logs = array();
		$stationdesc ='';
		try{
			$conn->open();
			$dataset = $conn->query(" SELECT * FROM dbo.log_pass where account = '".$account."' and cardno = '".$cardno."' order by lastupdate asc");
			$counter = 0;

			while($reader = $conn->fetch_array($dataset)){
				$log = new LogPass();
				$log->setTrackingNo($reader["trackingno"]);
				$log->setCardNo($reader["cardno"]);
				$log->setCurtstage($reader['station']);
				// $log->setDescription($reader['description']);
				$log->setMachine($reader['machine']);
				$log->setStatus($reader["status"]);
				$log->setLine($reader["line"]);
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
	

	public static function getHistory($card){
		$conn = new Connection();
		$hasreject = false;
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.log_pass where cardno = '".$card."_1' and status = 'REJECT'");

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