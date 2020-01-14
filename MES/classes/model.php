<?php

include_once("connection.php");

class Model{

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

	//getter

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


public static function SelectAllModel($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and active ='1' order by modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

public static function SelectAllModel2($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and active ='1' order by modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

public static function SelectAllModelSMT($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and modelType = 'SMT' and active ='1' order by modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

	public static function SelectAllModelBBA($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and modelType = 'BBA' and active ='1' order by modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}


	public static function SelectAllMotherModel($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and active ='1' and modeltype = 'Mother' order by modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

		public static function SelectAllPTMotherModel($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and active ='1' and modeltype = 'Mother' and batch <> 0 order by modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}


	public static function SelectMotherModelB9($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and active ='1' and modeltype = 'Mother' and modelno not in ('H740PEN','ITIF','H919','980TH') order by modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}


	public static function SelectModelB9($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and active ='1' and modeltype = 'Mother' and modelno in ('H919','ITIF') order by modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
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



	public static function SelectChildModel($account,$modeltype){
			$conn = new Connection();
			$result = array();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and active ='1' and modeltype = '".$modeltype."'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
				$conn->close();
				}catch(Exception $e){

				}
				return $result;
		}


	public static function SelectAllPTChildModel($account,$modeltype){
			$conn = new Connection();
			$result = array();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' AND active ='1' AND modeltype = '".$modeltype."' AND batch <> 0 ");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
				$conn->close();
				}catch(Exception $e){

				}
				return $result;
		}



	public static function SelectAllChildModel($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' AND active ='1' AND modeltype <> 'Mother' ORDER BY modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

		public static function SelectAllChildModel2($account)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT modelno FROM dbo.acce_matrix WHERE account = '".$account."' ORDER BY modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setModel($reader["modelno"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

	public static function getCountChild($account,$mother){
      $conn = new Connection();
      $result = 0;

      try{
        $conn->open();
        $dataset = $conn->query("SELECT count(modelno)+2 as countchild FROM dbo.model WHERE account = '".$account."' AND active ='1' AND modeltype = '".$mother."' and batch = 0");
        $counter = 0;

        if ($conn->has_rows($dataset)){
        $reader = $conn->fetch_array($dataset);
        $result = $reader['countchild']; 
        }else{
        $result = 0;
        }

        $conn->close();
        }catch(Exception $e){

        }
        return $result;
    }

    	public static function checkchildmodel($account,$modelType){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT modelno FROM dbo.model WHERE account = '".$account."' AND active ='1' AND modelType = '".$modelType."'");

			if($conn->has_rows($dataset)){

				if ($result)
				$result = 'true';
							
			}else{
				$result = 'false';
			}	
			
			$conn->close();
		}catch(Exception $e){

		}
		return $result;
	}

	public static function getchildmodel($account,$modelType,$modelno){
	$conn = new Connection();
	$result = 'false';
	$array = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT modelno FROM [MES].[dbo].[model] WHERE account = '".$account."' AND active ='1' AND modelType = '".$modelType."'");
		$counter = 0;

		while($rows = $conn->fetch_array($datareader)){
		

		$array[$counter] = $rows['modelno'];

		if ($array[$counter] == $modelno){
					$result = 'true';
					break;
			}else{
				$result = 'false';
		}
	$counter++;
	}
	$conn->close();
		}catch(Exception $e){
			}
	return $result;
	}


		public static function getchildmodel1($account,$modelType)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM [MES].[dbo].[model] WHERE account = '".$account."' AND active ='1' AND modelType = '".$modelType."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Model();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["modelno"]);
				 $Select->setCompanyPN($reader["companyPN"]);
				 $Select->setModelDesc1($reader["description"]);
				 $Select->setModelFamily($reader["modelFamily"]);
				 $Select->setModelType($reader["modelType"]);
				 $Select->setMinRev($reader["minRev"]);
				 $Select->setLatestRev($reader["latestRev"]);
				 $Select->setItemWt($reader["itemWt"]);
				 $Select->setBatch($reader["batch"]);
				 $Select->setActive($reader["active"]);
				 $Select->setLastUpdate($reader["lastupdate"]);
				 $Select->setLastupdatedby($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

	

}?>