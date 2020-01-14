<?php
include_once("connection.php");

class lotsampling{

Private $id;
Private $account;
Private $lotno;
Private $reference;
Private $partno;
Private $station;
Private $status;
Private $samplingsize;
Private $rejectqty;
Private $quantity;
Private $remarks;
Private $lastupdate;
Private $lastupdatedby;

	function __construct(){

		}


			public function setAccount($account){
		$this->account = $account;
		}
			public function setLotno($lotno){
		$this->lotno = $lotno;
		}
			public function setReference($reference){
		$this->reference = $reference;
		}
			public function setPartno($partno){
		$this->partno = $partno;
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
			public function setRejectqty($rejectqty){
		$this->rejectqty = $rejectqty;
		}
			public function setQuantity($quantity){
		$this->quantity = $quantity;
		}
			public function setRemarks($remarks){
		$this->remarks = $remarks;
		}
			public function setLastupdate($lastupdate){
		$this->lastupdate = $lastupdate;
		}
			public function setLastupdatedby($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;

	}


		public function getAccount(){
		return $this->account;
	}
		public function getLotno(){
		return $this->lotno;
	}
		public function getReference(){
		return $this->reference;
	}	
		public function getPartno(){
		return $this->partno;
	}
		public function getStation(){
		return $this->station;
	}
		public function getStatus(){
		return $this->status;
	}
		public function  getSamplingsize(){
		return $this->samplingsize;
	}	
		public function getRejectqty(){
		return $this->rejectqty;
	}	
		public function getQuantity(){
		return $this->quantity;
	}	
		public function getRemarks(){
		return $this->remarks;
	}	
		public function getLastupdate(){
		return $this->lastupdate;
	}	
		public function getLastupdatedby(){
		return $this->lastupdatedby;

	}


		public function addLogs(){
		$conn = new Connection();

		try{
			$conn->open();

			$conn->query("INSERT INTO dbo.log_lot_sampling VALUES('".$this->getAccount()."','".$this->getLotno()."','".$this->getReference()."','".$this->getPartno()."','".$this->getStation()."','".$this->getStatus()."', '".$this->getSamplingsize()."', '".$this->getRejectqty()."','".$this->getQuantity()."', '".$this->getRemarks()."',Getdate(), '".$this->getLastupdatedby()."')");

			$conn->close();
		}catch(Exception $e){

		}	
	}

}

	?>