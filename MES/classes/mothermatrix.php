<?php

include_once("connection.php");

class MotherMatrix{

	private $account;
	private $model;
	private $modelfamily;
	private $modeltype;
	private $pt;
	private $sn;
	private $active;
	private $lastupdate;
	private $lastupdatedby;

	function __construct($account ='',$model =''){

			if(strlen($model)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.mothermatrix where account ='".$account."' and model = '".$model."' and active = 1");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
		 			
		 		 $this->setAccount($reader["account"]);
				 $this->setModel($reader["model"]);
				 $this->setModelFamily($reader["modelfamily"]);
				 $this->setModelType($reader["modeltype"]);
				 $this->setPT($reader["PT"]);
				 $this->setSN($reader["SN"]);
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

	public function setModelFamily($modelfamily){
		$this->modelfamily = $modelfamily;
	}

	public function setModelType($modeltype){
		$this->modelfamily = $modeltype;
	}

	public function setPT($pt){
		$this->PT = $pt;
	}

	public function setSN($sn){
		$this->SN = $sn;
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

	public function getmodelFamily(){
		return $this->modelfamily;
	}

	public function getmodelType(){
		return $this->modeltype;
	}

	public function getPT(){
		return $this->PT;
	}

	public function getSN(){
		return $this->SN;
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

/*
public static function SelectMatrix($account,$model)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.mothermatrix WHERE account = '".$account."' and model = '".$model."' and active ='1' order by modelno");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new MotherMatrix();
				 $Select->setAccount($reader["account"]);
				 $Select->setModel($reader["model"]);
				 $Select->setModelFamily($reader["modelfamily"]);
				 $Select->setModelType($reader["modeltype"]);
				 $Select->setPT($reader["PT"]);
				 $Select->setSN($reader["SN"]);
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
	}*/


	public static function getCountChild($account,$model){
      $conn = new Connection();
      $result = 0;

      try{
        $conn->open();
        $dataset = $conn->query("SELECT (SN+1) as countchild FROM dbo.mothermatrix WHERE account = '".$account."' AND active ='1' AND model = '".$model."' ");
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






}




?>