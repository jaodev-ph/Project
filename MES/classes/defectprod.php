<?php
include_once("connection.php");


class DefectCodeProd{

	private $account;
	private $defectcode;
	private $description;
	private $active;
	private $lastupdate;
	private $lastupdatedby;


	function __construct($account ='',$defectcode = ''){
		$conn = new Connection();

		if(strlen($defectcode)>0){
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.defectProd where account = '".$account."' and defectcode = '".$defectcode."'");
			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$this->setDefectCode($reader['defectCode']);
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

	public function setDefectCode($defectcode){
		$this->defectcode = $defectcode;
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

	public function getDefectCode(){
		return $this->defectcode;
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
			$conn->query("INSERT INTO dbo.defectProd VALUES(
						'".$this->getAccount()."',
						'".$this->getDefectCode()."',
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
			$conn->query("UPDATE dbo.defectProd SET 
							defectCode = '".$this->getDefectCode()."',
							description = '".$this->getDescription()."',
							active = ".$this->getActive().",
							lastupdate = GETDATE(),
							lastupdatedby = '".$this->getLastupdatedBy()."'
							WHERE account = '".$account."' defectCode = '".$defect."'
							");
			$conn->close();
		}catch(Exception $e){

		}
	}

	
	public static function getalldefectprod($account){
		$conn = new Connection();
		$defectcode = array();

		try{
			$conn->open();
			$datareader = $conn->query("SELECT defectCode, description from dbo.defectProd where account ='".$account."' and active = 1 order by defectCode");
			$counter = 0;
			while($rows = $conn->fetch_array($datareader))
			{
				$defect = new DefectCodeProd();
				$desc = $rows['defectCode'] . " : " . $rows['description'];
				$defect->setDefectCode($rows['defectCode']);
				$defect->setDescription($desc);
				$defectcode[$counter]=$defect;
				$counter = $counter + 1;
			}

			$conn->close();
		}catch(Exception $e){

		}
		return $defectcode;
	}

	public static function getAllDefect($account){
		$conn= new Connection();
		$defects = array();
		
		try{
			$conn->open();
			$result = $conn->query("SELECT * FROM dbo.defectProd where account = '".$account."'");
			$counter = 0;
			while ($row = $conn->fetch_array($result)) 
			{
				$defect = new DefectCodeProd();
				$defect->setDefectCode($row['defectCode']);
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