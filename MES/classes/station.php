<?php
include_once("connection.php");

class Station{
	private $account;
	private $station;
	private $description;
	private $sequence;
	private $stype;
	private $active;
	private $lastupdate;
	private $lastupdatedby;

	function __construct($station = ''){

		
	}

	//Setter
	public function setAccount($account){
		$this->account = $account;
	}

	public function setStation($station){
		$this->station = $station;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setSequence($sequence){
		$this->sequence = $sequence;
	}

	public function setStype($stype){
		$this->stype = $stype;
	}

	public function setActive($active){
		$this->active = $active;
	}

	public function setLastUpdate($lastupdate){
		$this->lastupdate = $lastupdate;
	}

	public function setLastUpdatedBy($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}


	//Getter
	public function getAccount(){
		return $this->account;
	}

	public function getStation(){
		return $this->station;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getSequence(){
		return $this->sequence;
	}

	public function getStype(){
		return $this->stype;
	}

	public function getActive(){
		return $this->active;
	}

	public function getLastUpdate(){
		return $this->lastupdate;
	}

	public function getLastUpdatedBy(){
		return $this->lastupdatedby;
	}


	public function StationDetails($account,$station){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.station where account ='".$account."' and station = '".$station."' and active ='1' order by sequence");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setStation($reader['station']);
					$this->setDescription($reader['description']);
					$this->setSequence($reader['sequence']);
					$this->setStype($reader['stype']);
					$this->setActive($reader['active']);
					$this->setLastUpdate($reader['lastupdate']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
				}
				$conn->close();
			}catch(Exception $e){

			}

	}

}

	?>