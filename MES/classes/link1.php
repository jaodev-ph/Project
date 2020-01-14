<?php

include_once("connection.php");

class Link{

	private $account;
	private $model;
	private $companyPN;
	private $modelDesc1;
	private $modelDesc2;
	private $modelFamily;
	private $modelType;
	private $minRev;
	private $latestRev;
	private $itemWt;
	private $batch;
	private $active;
	private $lastupdate;
	private $lastupdatedby;

	function __construct($account ='',$modelno =''){

			if(strlen($modelno)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.model where account ='".$account."' and modelno = '".$modelno."'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				 $this->setAccount($reader["account"]);
				 $this->setModel($reader["modelno"]);
				 $this->setCompanyPN($reader["companyPN"]);
				 $this->setModelDesc1($reader["description"]);
				 $this->setModelFamily($reader["modelFamily"]);
				 $this->setModelType($reader["modelType"]);
				 $this->setMinRev($reader["minRev"]);
				 $this->setLatestRev($reader["latestRev"]);
				 $this->setItemWt($reader["itemWt"]);
				 $this->setBatch($reader["batch"]);
				 $this->setActive($reader["active"]);
				 $this->setLastUpdate($reader["lastupdate"]);
				 $this->setLastupdatedby($reader["lastupdatedby"]);
			}

			$conn->close();
		}catch(Exception $e){

		}
	}
	}

	public function setAccount($account){
		$this->account = $account;
	}

	public function setModel($model){
		$this->model = $model;
	}

	public function setCompanyPN($companyPN){
		$this->companyPN = $companyPN;
	}


	public function setModelDesc1($modelDesc1){
		$this->modelDesc1 = $modelDesc1;
	}


	public function setModelDesc2($modelDesc2){
		$this->modelDesc2 = $modelDesc2;
	}


	public function setModelFamily($modelFamily){
		$this->modelFamily = $modelFamily;
	}

	public function setModelType($modelType){
		$this->modelType = $modelType;
	}


	public function setMinRev($minRev){
		$this->minRev = $minRev;
	}


	public function setLatestRev($latestRev){
		$this->latestRev = $latestRev;
	}

	public function setItemWt($itemWt){
		$this->itemWt = $itemWt;
	}

	public function setBatch($batch){
		$this->batch = $batch;
	}

	public function setActive($active){
		$this->active = $active;
	}

	public function setLastUpdate($lastupdate){
		$this->lastupdate = $lastupdate;
	}

	public function setLastupdatedby($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}

	public function setGroupname($groupname){
		$this->groupname = $groupname;
	}

	public function setStation($station){
		$this->station = $station;
	}

	//getter

	public function getStation(){
		return $this->station;
	}

	public function getGroupname(){
		return $this->groupname;
	}

	public function getAccount(){
		return $this->account;
	}

	public function getModel(){
		return $this->model;
	}

	public function getCompanyPN(){
		return $this->companyPN;
	}

	public function getModelDesc1(){
		return $this->modelDesc1;
	}

	public function getModelDesc2(){
		return $this->modelDesc2;
	}

	public function getModelFamily(){
		return $this->modelFamily;
	}

	public function getModelType(){
		return $this->modelType;
	}

	public function getMinRev(){
		return $this->minRev;
	}

	public function getLatestRev(){
		return $this->latestRev;
	}

	public function getItemWt(){
		return $this->itemWt;
	}

	public function getBatch(){
		return $this->batch;
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


public static function SelectAllGroup($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT distinct(groupname) FROM dbo.link_maintenance WHERE account = '".$account."' and active ='1' order by groupname");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Link();
				 $Select->setGroupname($reader["groupname"]);
				 
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

	public static function SelectAllGroup2($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT distinct(groupname) FROM dbo.link_maintenance2 WHERE account = '".$account."' and active ='1' order by groupname");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Link();
				 $Select->setGroupname($reader["groupname"]);
				 
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

	public static function SelectAllStation($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT distinct(station) FROM dbo.link_maintenance WHERE account = '".$account."' and active ='1'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Link();
				 $Select->setStation($reader["station"]);
				 
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

		public static function DIDcheckExist($account,$serialno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT top 1 * FROM dbo.kanban_partsrecords where account ='".$account."' and cardno = '".$serialno."'");

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


	public static function getLotQuantity($account,$model){
		$conn = new Connection();
		$itemWt = 0;
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.model where account = '".$account."' and modelno = '".$model."'");

			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$itemWt = $reader['itemWt'];
			}
			$conn->close();
		}catch(Exception $e){

		}

		return $itemWt;
	}







}




?>