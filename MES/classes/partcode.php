<?php include_once("connection.php");?>

<?php

class Partcode{

	Private $account;
	Private $artcode;
	Private $description;
	Private $model;
	Private $modelfamily;
	Private $remarks;
	Private $lastupdate;
	Private $lastupdatedby;
	Private $active;




	function __construct($account='',$partcode=''){
		
		// if(strlen($model)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.partcode where account ='".$account."' AND partcode = '".$partcode."' AND active = 1");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setAccount($reader['account']);
				$this->setPartcode($reader['partcode']);
				$this->setDescription($reader['description']);
				$this->setModel($reader['model']);
				$this->setModelFamily($reader['modelfamily']);
				$this->setRemarks($reader['remarks']);
				$this->setLastUpdate($reader['lastupdate']);
				$this->setLastUpdatedBy($reader['lastupdatedby']);
				$this->setActive($reader['active']);

			}

			$conn->close();
		}catch(Exception $e){

		}
	// }

	}

//setter
		public function setAccount($account){
		$this->account = $account;
	}

		public function setPartcode($partcode){
		$this->partcode = $partcode;
	}

		public function setDescription($description){
		$this->description = $description;
	}

		public function setModel($model){
		$this->model = $model;
	}

		public function setModelFamily($modelfamily){
		$this->modelfamily = $modelfamily;
	}

		public function setRemarks($remarks){
		$this->remarks = $remarks;
	}

		public function setLastUpdate($lastupdate){
		$this->lastupdate = $lastupdate;
	}

		public function setLastUpdatedBy($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}

		public function setActive($active){
		$this->active = $active;
	}






//getter

	public function getAccount(){
		return $this->account;
	}


	public function getPartcode(){
		return $this->partcode;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getModel(){
		return $this->model;
	}

	public function getModelFamily(){
		return $this->modelfamily;
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

	public function getActive(){
		return $this->active;
	}

public static function getAllPartsCode($account){
		$conn = new Connection();
		$result = array();
		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.Partcode where account ='".$account."' AND active = 1");
			$counter = 0;
			if ($conn->has_rows($dataset)){
				while($reader = $conn->fetch_array($dataset)){
					$part = new Partcode();
					$part->setPartcode($reader['partcode']);
					$part->setDescription($reader['description']);
					$part->setModel($reader['model']);
					$part->setModelFamily($reader['modelfamily']);
					$part->setRemarks($reader['remarks']);
					$part->setLastUpdate($reader['lastupdate']);
					$part->setLastUpdatedBy($reader['lastupdatedby']);
					$part->setActive($reader['active']);
					$result[$counter] = $part;
					$counter++;
				}

			}

			$conn->close();
		}catch(Exception $e){

		}

		return $result;
			
	}

		public static function getPartcodeModel($account,$partcode){
		$conn = new Connection();
		$model = 0;
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.partcode where account = '".$account."' and partcode = '".$partcode."'");

			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$model = $reader['model'];
			}
			$conn->close();
		}catch(Exception $e){

		}

		return $model;
	}


public  function getPartcodefinal($account,$model){

	$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.partcode where account ='".$account."' and model = '".$model."'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);


				$this->setPartcode($reader['partcode']);
				$this->setDescription($reader['description']);
	
			}

			$conn->close();
		}catch(Exception $e){

		}
		
	}


public static function getPartCodeDetails($account,$partcode){
		$conn = new Connection();
		$result = array();
		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.Partcode WHERE account ='".$account."' AND partcode = '".$partcode."' AND active = 1");
			$counter = 0;
			if ($conn->has_rows($dataset)){
				while($reader = $conn->fetch_array($dataset)){
					$part = new Partcode();
					$part->setPartcode($reader['partcode']);
					$part->setDescription($reader['description']);
					$part->setModel($reader['model']);
					$part->setModelFamily($reader['modelfamily']);
					$part->setRemarks($reader['remarks']);
					$part->setLastUpdate($reader['lastupdate']);
					$part->setLastUpdatedBy($reader['lastupdatedby']);
					$part->setActive($reader['active']);
					$result[$counter] = $part;
					$counter++;
				}

			}

			$conn->close();
		}catch(Exception $e){

		}

		return $result;
			
	}

	public function addPartcode(){
		$conn = new Connection();

		try{
			$conn->open();

			$conn->query("INSERT INTO dbo.partcode VALUES('".$this->getAccount()."','".$this->getPartcode()."','".$this->getDescription()."','".$this->getModel()."','".$this->getModelFamily()."', '".$this->getRemarks()."',GETDATE(), '".$this->getLastUpdatedBy()."', '".$this->getActive()."')");

			$conn->close();
		}catch(Exception $e){

		}	
	}


	public function Updatepartcode(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.partcode SET description = '".$this->getDescription()."', model = '".$this->getModel()."', modelfamily = '".$this->getModelFamily()."', remarks = '".$this->getRemarks()."', active = '".$this->getActive()."', lastupdate = getdate(), lastupdatedby = '".$this->getLastupdatedby()."' WHERE account = '".$this->getAccount()."' AND partcode = '".$this->getPartcode()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}


}

?>