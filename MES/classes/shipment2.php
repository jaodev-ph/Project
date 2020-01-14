<?php

include_once("connection.php");

class Shipment{

	private $model;
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


	function __construct($modelno = ''){
		$conn = new Connection();
		
		if(strlen($modelno)>0){
		try{
			$conn->open();
			$dataset = $conn->query("SELECT * from dbo.model WHERE modelno = '".$modelno."'");
			//reader.read
			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$this->setModelDesc1($reader['modelDesc1']);
				$this->setModelDesc2($reader['modelDesc2']);
				$this->setModelFamily($reader['modelFamily']);
				$this->setModelType($reader['modelType']);
				$this->setMinRev($reader['minRev']);
				$this->setLatestRev($reader['latestRev']);
				$this->setItemWt($reader['itemWt']);
				$this->setBatch($reader['batch']);
				$this->setActive($reader['active']);
			}
			$conn->close();
		}catch(Exception $e){
			
		}
	}
	}


	public function setModel($model){
		$this->model = $model;
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

	public function setPrefix($prefix){
		$this->prefix = $prefix;
	}

	public function setPosition($position){
		$this->position = $position;
	}

	public function setCount($count){
		$this->count = $count;
	}

	public function setLength($length){
		$this->length = $length;
	}
	
	public function setLastUpdate($lastupdate){
		$this->lastupdate = $lastupdate;
	}

	public function setLastupdatedby($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}

	public function setvarDate($varDate){
		$this->varDate = $varDate;
	}

	public function setvarValue($varValue){
		$this->varValue = $varValue;
	}

	public function setReqQty($ReqQty){
		$this->ReqQty = $ReqQty;
	}

	public function setItemDesc($ItemDesc){
		$this->ItemDesc = $ItemDesc;
	}

	public function setItemCode($ItemCode){
		$this->ItemCode = $ItemCode;
	}

	//getter

	public function getItemCode(){
		return $this->ItemCode;
	}

	public function getItemDesc(){
		return $this->ItemDesc;
	}

	public function getReqQty(){
		return $this->ReqQty;
	}

	public function getvarValue(){
		return $this->varValue;
	}

	public function getvarDate(){
		return $this->varDate;
	}

	public function getModel(){
		return $this->model;
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

	public function getPrefix(){
		return $this->prefix;
	}

	public function getPosition(){
		return $this->position;
	}

	public function getCount(){
		return $this->count;
	}

	public function getLength(){
		return $this->length;
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


	
public function add(){
	$conn = new Connection();
	try{
		
		if ($this->checkExist($this->getModel())==false) {
			$conn->open();
			$conn->query("INSERT INTO dbo.model VALUES(
						'".$this->getModel()."',
						'".$this->getModelDesc1()."',
						'".$this->getModelDesc2()."',
						'".$this->getModelFamily()."',
						'".$this->getModelType()."',
						'',
						'',
						0,
						0,
						".$this->getActive().",
						GETDATE(),
						'".$this->getLastUpdatedBy()."')");
			$conn->close();
			if ($this->getActive()==1 && $this->checkRouteExist($this->getModel())==false) {
				$this->addToRoute($this->getModel());
				//$this->updateRoute($this->getModel());
			}
		}
		
	}catch(Exception $e){
		
	}
}

public function update($model){
	$conn = new Connection();
	try{
		$conn->open();
		$conn->query("UPDATE dbo.model SET 
					modelno = '".$this->getModel()."',
					modelDesc1 = '".$this->getModelDesc1()."',
					modelDesc2 = '".$this->getModelDesc2()."',
					modelFamily = '".$this->getModelFamily()."',
					modelType = '".$this->getModelType()."',
					active = ".$this->getActive().",
					lastupdate = GETDATE(),
					lastupdatedby = '".$this->getLastUpdatedBy()."'
					");

		if ($this->active()==1) {
			if ($this->checkRouteExist($this->getModel())==false) {
				$this->addToRoute($this->getModel());
			}
			//$this->updateRoute($this->getModel());
		}
		$conn->close();
		}catch(Exception $e){

		}
}

public function addToRoute($model){
		$conn = new Connection();
		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.modelRoute 
						  SELECT B.modelno,
						  A.sequence,
		                  A.station,
		                  0 as skip,
		                  0 as active,
		                  0 as lastStation,
		                  getdate() as lastupdate,
		                 '".$this->getLastUpdatedBy()."'  as lastupdatedby 
		                  FROM STATION A,MODEL B
		                  WHERE B.modelno = '".$model."'
		                  ORDER BY B.modelno,A.sequence
						");
			$conn->close();
		}catch(Exception $e){

		}
}

public function updateRoute($model){
	$conn = new Connection();
	try{
		$conn->open();
		$conn->query("UPDATE dbo.modelRoute 
					SET flowsequence = 
					(SELECT sequence FROM dbo.station
					WHERE station.station = modelRoute.station)
					");
		$conn->close();
	}catch(Exception $e){

	}

}

public function checkExist($model){
	$conn = new Connection();
	$result = false;
	try{
		$conn->open();
		$dataset = $conn->query("SELECT * FROM dbo.model WHERE modelno = '".$model."'");

		if ($conn->has_rows($dataset)) {
			$result=true;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $result;
}

public function checkRouteExist($model){
	$conn = new Connection();
	$result = false;
	try{
		$conn->open();
		$dataset = $conn->query("SELECT * FROM dbo.modelRoute WHERE modelno = '".$model."'");

		if ($conn->has_rows($dataset)) {
			$result=true;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $result;
}

public static function getAllModel(){
	$conn = new Connection();
	$models = array();

	try{
		$conn->open();
		$result = $conn->query("SELECT * FROM dbo.model WHERE active = 1");
		$counter=0;
		while ($row = $conn->fetch_array($result)) {
			$model = new Model();
			$model->setModel($row['modelno']);
			$model->setModelDesc1($row['modelDesc1']);
			$model->setModelDesc2($row['modelDesc2']);
			$model->setModelFamily($row['modelFamily']);
			$model->setModelType($row['modelType']);
			$model->setActive($row['active']);

			$models[$counter] = $model;
			$counter++;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $models;
}
public static function getAllModelFromShipmentFile(){
	$conn = new Connection();
	$models = array();

	try{
		$conn->open();
		$result = $conn->query("SELECT distinct(model)
			FROM [Epson].[dbo].[EpsonShipmentFile]
			ORDER BY model");
		$counter=0;
		while ($row = $conn->fetch_array($result)) {
			$model = new Model();
			$models[$counter] = $model;
			$model->setModel($row['model']);
			$counter++;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $models;
}

public static function getShipmentDateFromShipmentFile($model){
	$conn = new Connection();
	$models = array();

	try{
		$conn->open();
		$result = $conn->query("SELECT distinct(ETA)
			FROM [mes].[dbo].[EpsonShipmentFile]
			");
		$counter=0;
		while ($row = $conn->fetch_array($result)) {
			$model = new Model();
			$models[$counter] = $model;
			$model->setvarDate($row['ETA']);
			$counter++;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $models;
}

public static function getKanbanFromShipmentFile($model,$varDate){
	$conn = new Connection();
	$models = array();

	try{
		$conn->open();
		$result = $conn->query("SELECT distinct(KanbanNo)
			FROM [Epson].[dbo].[EpsonShipmentFile]
			WHERE ETA = '".$varDate."'");
		$counter=0;
		while ($row = $conn->fetch_array($result)) {
			$model = new Model();
			$models[$counter] = $model;
			$model->setvarValue($row['KanbanNo']);
			$counter++;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $models;
}

	public static function getDetailsFromShipmentFile($kanban){
		$conn = new Connection();
		$models = new Model();

			try{
				$conn->open();
				$dataset = $conn->query("
					SELECT itemCode,itemDescription,Model,Qty
					FROM dbo.EpsonShipmentFile
					WHERE KanbanNo = '".$kanban."'
					");
				if ($conn->has_rows($dataset)) {
					$reader = $conn->fetch_array($dataset);
					$models->setItemCode($reader['itemCode']);
					$models->setItemDesc($reader['itemDescription']);
					$models->setModel($reader['Model']);
					$models->setReqQty($reader['Qty']);
				}
				$conn->close();
			}catch(Exception $e){

			}
		return $models;
	}

	public static function getTripFromKanbantrip_matrix($kanban){
		$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("
					SELECT trip
					FROM dbo.kanbantrip_matrix
					WHERE time = (
						SELECT CAST(ETA as time)
						FROM dbo.EpsonShipmentFile
						where kanbanno = '".$kanban."'
					)
					");
				if ($conn->has_rows($dataset)) {
					$reader = $conn->fetch_array($dataset);
					$zxc = $reader['trip'];
				}
				$conn->close();
			}catch(Exception $e){

			}
		return $zxc;
	}

public static function getAllModel2(){
	$conn = new Connection();
	$models = array();

	try{
		$conn->open();
		$result = $conn->query("SELECT modelno FROM dbo.model WHERE active = 1");
		$counter=0;
		while ($row = $conn->fetch_array($result)) {
			$model = new Model();
			$model->setModel($row['modelno']);

			$models[$counter] = $model;
			$counter++;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $models;
}

	public static function getAllModel3($model){
		$conn = new Connection();
		$routes = new Model();

			try{
				$conn->open();
				$dataset = $conn->query("
					SELECT modelno,prefix,position,count,length 
					FROM dbo.serial_format
					WHERE modelno = '".$model."'
					");
				if ($conn->has_rows($dataset)) {
					$reader = $conn->fetch_array($dataset);
					$routes->setModel($reader['modelno']);
					$routes->setPrefix($reader['prefix']);
					$routes->setPosition($reader['position']);
					$routes->setCount($reader['count']);
					$routes->setLength($reader['length']);
				}
				$conn->close();
			}catch(Exception $e){

			}
		return $routes;
	}


public static function getAllModelFamily(){
	$conn = new Connection();
	$models = array();

	try{
		$conn->open();
		$result = $conn->query("SELECT Distinct modelFamily FROM dbo.modelFamily WHERE active = 1");
		$counter=0;
		while ($row = $conn->fetch_array($result)) {
			$model = new Model();
			$model->setModelFamily($row['modelFamily']);

			$models[$counter] = $model;
			$counter++;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $models;
}


}
?>