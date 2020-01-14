<?php
include_once("connection.php");

class Loglot{

	private $trackingno;
	private $account;
	private $lotno;
	private $modelno;
	private $station;
	private $status;
	private $samplingsize;
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

	public function setLotno($lotno){
		$this->lotno = $lotno;
	}

	public function setModelno($modelno){
		$this->modelno = $modelno;
	}

	public function setStation($station){
		$this->station = $station;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function setSamplingsize($samplingsize){
		$this->samplingsize = $samplingsize;
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

	public function getLotno(){
		return $this->lotno;
	}

	public function getModelno(){
		return $this->modelno;
	}

	public function getStation(){
		return $this->station;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getSamplingsize(){
		return $this->samplingsize;
	}

	public function getLastUpdate(){
		return $this->lastupdate;
	}

	public function getLastUpdatedBy(){
		return $this->lastupdatedby;
	}


	public function addLotLogpass(){
		$conn = new Connection();

		try{
			$conn->open();

			$conn->query("INSERT INTO dbo.log_lot VALUES('".$this->getAccount()."','".$this->getLotno()."','".$this->getModelno()."','".$this->getStation()."', '".$this->getStatus()."', '".$this->getSamplingsize()."',GETDATE(), '".$this->getLastUpdatedBy()."')");

			$conn->close();
		}catch(Exception $e){

		}	
	}

	public static function viewAllLogPass($account,$lotno){
		$conn = new Connection();
		$logs = array();
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.log_lot WHERE account ='".$account."' and lotno = '".$lotno."' order by lastupdate asc");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$log = new Loglot();
				$log->setTrackingNo($reader["trackingno"]);
				$log->setLotno($reader["lotno"]);
				$log->setStation($reader["station"]);
				// $log->setMachine($reader["machine"]);
				$log->setStatus($reader["status"]);
				$log->setSamplingsize($reader["samplingSize"]);
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




	

	// public static function getHistory($card){
	// 	$conn = new Connection();
	// 	$hasreject = false;
	// 	try{
	// 		$conn->open();
	// 		$dataset = $conn->query("SELECT * FROM dbo.log_pass where cardno = '".$card."_1' and status = 'REJECT'");

	// 		if($conn->has_rows($dataset)){
	// 			$hasreject = true;
	// 		}
	// 		$conn->close();
	// 	}catch(Exception $e){

	// 	}

	// 	return $hasreject;
	// }

}
?>