<?php
include_once("connection.php");

class LogLink{

Private $account;
Private $serialno;
Private $partno;
Private $serialnoLink;
Private $partnoLink;
Private $quantity;
Private $station;
Private $description;
Private $lastupdatedBy;

	function __construct(){


		}


			public function setaccount($account){
		$this->account = $account;
		}
			public function setserialno($serialno){
		$this->serialno = $serialno;
		}
			public function setpartno($partno){
		$this->partno = $partno;
		}
			public function setserialnoLink($serialnoLink){
		$this->serialnoLink = $serialnoLink;
		}
			public function setpartnoLink($partnoLink){
		$this->partnoLink = $partnoLink;
		}
		public function setquantity($quantity){
		$this->quantity = $quantity;
		}
			public function setstation($station){
		$this->station = $station;
		}
			public function setdescription($description){
		$this->description = $description;
		}
			public function setlastupdatedBy($lastupdatedBy){
		$this->lastupdatedBy = $lastupdatedBy;

	}


		public function getaccount(){
		return $this->account;
	}
		public function getserialno(){
		return $this->serialno;
	}	
		public function getpartno(){
		return $this->partno;
	}
		public function getserialnoLink(){
		return $this->serialnoLink;
	}
		public function getpartnoLink(){
		return $this->partnoLink;
	}
		public function  getquantity(){
		return $this->quantity;
	}	
		public function getstation(){
		return $this->station;
	}	
		public function getdescription(){
		return $this->description;
	}	
		public function getlastupdatedBy(){
		return $this->lastupdatedBy;

	}

	public function addLogLink(){
		$conn = new Connection();

		try{
			$conn->open();

			$conn->query("INSERT INTO dbo.log_link VALUES('".$this->getAccount()."','".$this->getserialno()."','".$this->getpartno()."','".$this->getserialnoLink()."','".$this->getpartnoLink()."','".$this->getquantity()."', '".$this->getstation()."', '".$this->getdescription()."',Getdate(), '".$this->getlastupdatedby()."')");

			$conn->close();
		}catch(Exception $e){

		}	
	}

	public static function LinkExist($account,$serialno,$serialnoLink){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.log_link where account ='".$account."' and serialno = '".$serialno."' and serialnoLink ='".$serialnoLink."'");

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