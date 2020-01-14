<?php
include_once("connection.php");


class DefectCatProd{

	private $account;
	private $defectcatcode;
	private $description;
	private $active;
	private $lastupdate;
	private $lastupdatedby;


	function __construct($account = '',$defectcatcode = ''){
		$conn = new Connection();

		if(strlen($defectcatcode)>0){
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.defectCatProd where account ='".$account."' and defectcatcode = '".$defectcatcode."'");
			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$this->setDefectCatCode($reader['defectCatCode']);
				$this->setDescription($reader['description']);
				$this->setActive($reader['active']);
				$this->setLastUpdate($reader['lastupdate']);
				$this->setLastUpdatedBy($reader['lastupdatedby']);
			}
			
			$conn->close();
			}catch(Exception $e){

			}
		}
	}


	//Setter
	public function setAccount($account){
		$this->account = $account;
	}

	public function setDefectCatCode($defectcatcode){
		$this->defectcatcode = $defectcatcode;
	}

	public function setDescription($description){
		$this->description = $description;
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

	public function getDefectCatCode(){
		return $this->defectcatcode;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getActive(){
		return $this->active;
	}

	public function getLastupdate(){
		return $this->lastupdate;
	}

	public function getLastupdatedby(){
		return $this->lastupdatedby;
	}

	public function add(){
		$conn = new Connection();
		
		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.defectCatProd VALUES(
						'".$this->getAccount()."',
						'".$this->getDefectCatCode()."',
						'".$this->getDescription()."',
						".$this->getActive().",
						GETDATE(),
						'".$this->getLastupdatedby()."')
						");

			$conn->close();
		}catch(Exception $e){

		}
	}

	public function update($account,$defect){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.defectCatProd SET 
							defectCatCode = '".$this->getDefectCatCode()."',
							description = '".$this->getDescription()."',
							active = ".$this->getActive().",
							lastupdate = GETDATE(),
							lastupdatedby = '".$this->getLastupdatedBy()."'
							WHERE account ='".$account."' and defectCatCode = '".$defect."'
							");
			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function getalldefectcatprod($account){
		$conn = new Connection();
		$defectCatcode = array();

		try{
			$conn->open();
			$datareader = $conn->query("SELECT * from dbo.defectCatProd where account = '".$account."' and active = 1");
			$counter = 0;
			while($rows = $conn->fetch_array($datareader))
			{
				$defectcat = new DefectCatProd();
				$desc = $rows['defectCatCode'] . " : " . $rows['description'];
				$defectcat->setDefectCatCode($rows['defectCatCode']);
				$defectcat->setDescription($desc);
				//$defectcat->setDescription($rows['description']);
				$defectCatcode[$counter]=$defectcat;
				$counter = $counter + 1;
			}

			$conn->close();
		}catch(Exception $e){

		}
		return $defectCatcode;
	}

	public static function getAllDefect($account){
		$conn= new Connection();
		$defects = array();
		
		try{
			$conn->open();
			$result = $conn->query("SELECT * FROM dbo.defectCatProd where account = '".$account."'");
			$counter = 0;
			while ($row = $conn->fetch_array($result)) 
			{
				$defect = new DefectCatProd();
				$defect->setDefectCatCode($row['defectCatCode']);
				$defect->setDescription($row['description']);
				$defect->setActive($row['active']);
				$defect->setLastUpdate($row['lastupdate']);
				$defect->setLastupdatedBy($row['lastupdatedby']);

				$defects[$counter] = $defect;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){

		}
		return $defects;
	}
}
?>