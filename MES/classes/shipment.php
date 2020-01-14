<?php

include_once("connection.php");

class Shipment{

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
	private $items;
	private $kanbanno;
	private $purorg;
	private $itemcode;
	private $itemdescription;
	private $fruser;
	private $reqdate;
	private $qty;
	private $transitdate;
	private $eta;
	private $strloc;
	private $supplyarea;
	private $remarks;
	private $varDate;

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
/*
	public function setModel($model){
		$this->model = $model;
	}*/

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
	public function setItems($items){
		$this->Items = $items;
	}

	public function setKanbanNo($kanbanno){
		$this->KanbanNo = $kanbanno;
	}

	public function setPurOrg($purorg){
		$this->PurOrg = $purorg;
	}
	
	public function setItemCode($itemcode){
		$this->ItemCode = $itemcode;
	}

	public function setItemDescription($itemdescription){
		$this->ItemDescription = $itemdescription;
	}

	public function setModel($model){
		$this->Model = $model;
	}

	public function setFrUser($fruser){
		$this->FrUser = $fruser;
	}

	public function setQty($qty){
		$this->Qty = $qty;
	}

	public function setTransitDate($transitdate){
		$this->TransitDate = $transitdate;
	}

	public function setETA($eta){
		$this->ETA = $eta;
	}

	public function setStrLoc($strloc){
		$this->StrLoc = $strloc;
	}

	public function setReqDate($reqdate){
		$this->ReqDate = $reqdate;
	}

	public function setSupplyArea($supplyarea){
		$this->SupplyArea = $supplyarea;
	}

	public function setRemarks($remarks){
		$this->Remarks = $remarks;
	}

	public function setvarDate($varDate){
		$this->varDate = $varDate;
	}


	//getter
	public function getvarDate(){
		return $this->varDate;
	}

	public function getAccount(){
		return $this->account;
	}

	public function getModel(){
		return $this->Model;
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

	public function getItems(){
		return $this->Items;
	}

	public function getKanbanNo(){
		return $this->KanbanNo;
	}

	public function getPurOrg(){
		return $this->PurOrg;
	}

	public function getItemCode(){
		return $this->ItemCode;
	}

	public function getItemDescription(){
		return $this->ItemDescription;
	}


	public function getFrUser(){
		return $this->FrUser;
	}

	public function getReqDate(){
		return $this->ReqDate;
	}

	public function getQty(){
		return $this->Qty;
	}

	public function getTransitDate(){
		return $this->TransitDate;
	}

	public function getETA(){
		return $this->ETA;
	}

	public function getStrLoc(){
		return $this->StrLoc;
	}

	public function getSupplyArea(){
		return $this->SupplyArea;
	}

	public function getRemarks(){
		return $this->Remarks;
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
			$dataset =  $conn->query("SELECT * FROM dbo.model WHERE account = '".$account."' and active ='1' and modeltype = 'Mother' and modelno not in ('H740PEN','ITIF') order by modelno");
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




public static function getShipmentDateFromShipmentFile(){
	$conn = new Connection();
	$models = array();

	try{
		$conn->open();
		$result = $conn->query("SELECT distinct(cast(TransitDate as varchar(50))) as TransitDate
					from mes.dbo.EpsonShipmentFile
					where transitdate > cast(getdate() as date)
					");
		$counter=0;
		while ($row = $conn->fetch_array($result)) {
			$model = new Shipment();
			$models[$counter] = $model;
			$model->setvarDate($row['TransitDate']);
			$counter++;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $models;
}

public static function B9ShipmentFile(){
		$conn = new Connection();
		$logs = array();
		$stationdesc ='';
		try{
			$conn->open();
			$dataset = $conn->query(" SELECT Top (500) * FROM [MES].[dbo].[EpsonShipmentFile] order by TransitDate Desc");
			$counter = 0;

			while($reader = $conn->fetch_array($dataset)){
				$log = new Shipment();
				$log->setItems($reader["Items"]);
				$log->setKanbanNo($reader["KanbanNo"]);
				$log->setPurOrg($reader['PurOrg']);
				$log->setItemCode($reader['ItemCode']);
				$log->setItemDescription($reader["ItemDescription"]);
				$log->setModel($reader["Model"]);
				$log->setFrUser($reader["FrUser"]);
				$log->setReqDate($reader["ReqDate"]->format('Y-m-d h:i:s a'));
				$log->setQty($reader["Qty"]);
				$log->setTransitDate($reader["TransitDate"]->format('Y-m-d h:i:s a'));
				$log->setETA($reader["ETA"]->format('Y-m-d h:i:s a'));
				$log->setStrLoc($reader["StrLoc"]);
				$log->setSupplyArea($reader["SupplyArea"]);
				$log->setRemarks($reader["Remarks"]);

				$logs[$counter] = $log;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){

		}

		return $logs;
	}

	

}?>