<?php  
	include_once("connection.php");

	class Its_Additem
	{
		private $itemtype;
		private $itembrand;
		private $itemmodel;
		private $itemdesc;
		private $serial;
		private $quantity;
		private $status;
		private $company;
		private $lastupdatedby;
		private $lastupdated;
		private $pcserial;
		private $no;

		public function __construct()
		{

		}

		public function setItemType($itemtype)
		{
			$this->itemtype = $itemtype;
		}
		
		public function setItemBrand($itembrand)
		{
			$this->itembrand = $itembrand;
		}
		public function setItemModel($itemmodel)
		{
			$this->itemmodel = $itemmodel;
		}
		public function setItemDesc($itemdesc)
		{
				$this->itemdesc = $itemdesc;
		}
		public function setSerial($serial)
		{
			$this->serial = $serial;
		}
		public function setQuantity($quantity)
		{
			$this->quantity = $quantity;
		}
		public function setStatus($status)
		{
			$this->status = $status;
		}
		public function setCompany($company)
		{
			$this->company = $company;
		}
		public function setLastUpdatedBy($lastupdatedby)
		{
			$this->lastupdatedby = $lastupdatedby;
		}
		public function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		public function setPCSerial($pcserial){
			$this->pcserial = $pcserial;
		}

		public function setTrackingNo($no){
			
			$this->no = $no;

		}

		//getters

		public function getTrackingNo(){
			return $this->no;

		}
		public function getItemType()
		{
			return $this->itemtype;
		}
		public function getItemBrand()
		{
			return $this->itembrand;
		}
		public function getItemModel()
		{
			return $this->itemmodel;
		}
		public function getItemDesc()
		{
			return $this->itemdesc;
		}
		public function getSerial()
		{
			return $this->serial;
		}
		public function getQuantity()
		{
			return $this->quantity;
		}
		public function getStatus()
		{
			return $this->status;
		}
		public function getCompany()
		{
			return $this->company;
		}
		public function getLastUpdated()
		{
			return $this->lastupdated;
		}
		public function getLastUpdatedBy()
		{
			return $this->lastupdatedby;
		}
		public function getPCSerial(){
			return $this->pcserial;
		}

		//FUNCTIONS


		// public static function getitems(){
		// 	$conn = new Connection();
		// 	$conn->open();
		// 	$dataset = 
		// }


		public function countitems (){
			$conn = new connection();
			$count ="";
			try{
				$conn->open();
				$query = $conn->query("SELECT TOP(1) itemserial as count from dbo.its_itemrecords order by itemserial DESC");
				if($conn->has_rows($query)){
					$reader = $conn->fetch_array($query);
					$count = $reader['count'] +1;
				}	
			}catch(Exception $e){

			}
			return $count;
		}









		public static function updateapp($apps,$name,$pcserial){
			$conn = new Connection();
			$conn->open();
				$dataset = $conn->query("UPDATE dbo.its_workstation SET 
				
					application = '".$apps."',
					lastupdated = GETDATE(),
					lastupdatedby = '".$name."'
					WHERE pcserial = '".$pcserial."'");
				$conn->close();

			
		}

		public  static function returnitem($itemserial,$name){

		    $conn = new Connection();

				$conn->open();
				$dataset = $conn->query("UPDATE dbo.its_itemrecords SET 
					pcserial = null,
					status = 'In-Stock',
					lastupdated = GETDATE(),
					lastupdatedby = '".$name."'
					WHERE itemserial = '".$itemserial."'");
				$conn->close();
		

		}

		public static function log_item($pcserial,$itemserial,$desc,$status,$name){
			$conn = new connection();
			try{
			$conn->open();
			$query = $conn->query("INSERT INTO dbo.its_log_pcitem values('".$pcserial."','".$itemserial."','".$desc."','".$status."',GETDATE(),'".$name."')");
			$conn->close();
			}
			catch(Exception $e){

			}
		}

	



		public static function getpcdetails($itemserial){
			$conn = new connection();
			$result ="";
		
			
			$conn->open();
			$dataset  = $conn->query("SELECT * from dbo.its_itemrecords where itemserial = '".$itemserial."'");
			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$desc =$reader['description'];
				$model = $reader['model'];
				$brand = $reader['brand'];
				$result = $brand ." ".$model." ".$result;
				$conn->close();
				}
		return $result;
			
		}

		public static function setitem($itemserial,$name,$pcserial){
			$conn = new connection();
			$conn->open();
				$dataset = $conn->query("UPDATE dbo.its_itemrecords SET 
					pcserial = '".$pcserial."',
					status = 'Deployed',
					lastupdated = GETDATE(),
					lastupdatedby = '".$name."'
					WHERE itemserial = '".$itemserial."'");
				$conn->close();
		

		}



		public static function getpcitemsByPC($pcserial){
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$query = $conn->query("SELECT * from dbo.its_itemrecords where pcserial ='".$pcserial."'");
				$counter =0;
				while($row = $conn->fetch_array($query)){
					$getitems = new its_Additem();
					$getitems->setPCSerial($row['itemserial']);
					$getitems->setItemType($row['type']);
					$result[$counter] = $getitems;
					$counter++;
				}
				$conn->close();

			}catch(Exception $e){

			}
			return $result;
		}



		public static function getMonitorByPc($pcserial){

			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$query = $conn->query("SELECT * from dbo.its_itemrecords where pcserial ='".$pcserial."' and type ='Monitor'");
				$counter=0;
				if($conn->has_rows($query)){
				while($row = $conn->fetch_array($query)){
				
					$itemclass = new Its_Additem();
					$itemclass->setItemModel($row['brand']." ".$row['model']);
					$result[$counter] = $itemclass;
				}
				$conn->close();
			}
			else{
					$itemclass = new Its_Additem();
					$itemclass->setItemModel("N\A");		
					$result[$counter] = $itemclass;
			}
				

			}catch(Exception $e){

			}
			return $result;	
			
		}

		public static function getProcessorByPC($processor){

			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$query = $conn->query("SELECT * from dbo.its_itemrecords where pcserial ='".$processor."' and type ='Processor'");
				$counter=0;
				if($conn->has_rows($query)){
				while($row = $conn->fetch_array($query)){
				
					$itemclass = new Its_Additem();
					$itemclass->setItemModel($row['brand']." ".$row['model']);
					$result[$counter] = $itemclass;
				}
			}
			else{
					$itemclass = new Its_Additem();
					$itemclass->setItemModel("N\A");
					$result[$counter] = $itemclass;
			}
			
			$conn->close();

			}catch(Exception $e){

			}
			return $result;	

		}

		public static function getHdd($hdd){

			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$query = $conn->query("SELECT * from dbo.its_itemrecords where pcserial ='".$hdd."' and type ='Hard Disk'");
				$counter=0;
				if($conn->has_rows($query)){
				while($row = $conn->fetch_array($query)){
				
					$itemclass = new Its_Additem();
					$itemclass->setItemModel($row['description']);
					$result[$counter] = $itemclass;
				}
			}
			else{
					$itemclass = new Its_Additem();
					$itemclass->setItemModel("N\A");
					$result[$counter] = $itemclass;
			}
			
			$conn->close();

			}catch(Exception $e){

			}
			return $result;	

		}


		public static function allItemType(){

			$conn = new connection();
			$itemtype = array();

			try{
				$conn->open();
				$query = $conn->query("SELECT DISTINCT type from dbo.its_itemrecords where status ='In-Stock' and type !='Mobile' and  type !='Tablet'");
				$counter = 0;
				while($row = $conn->fetch_array($query)){
					$itemInstock = new Its_Additem();
					$itemInstock->setItemType($row['type']);
					$itemtype[$counter] = $itemInstock;
					$counter++;
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $itemtype;
		}

		public static function getItembyType($type){
			$conn = new connection();
			$itembytype = array();

			try{
				$conn->open();
				$query = $conn->query("SELECT * from dbo.its_itemrecords where type= '".$type."' and status ='In-Stock'");
				$counter =0;

				while($row = $conn->fetch_array($query)){
					$itemclass = new Its_Additem();
					$itemclass->setSerial($row['itemserial']);
					$itemclass->setItemModel($row['model']);
					$itemclass->setItemBrand($row['brand']);
					$itemclass->setItemDesc($row['description']);
					$itembytype[$counter] = $itemclass;
					$counter++;


				}
				$conn->close();
			}catch(Exception $e){

			}
			return $itembytype;

		}


		public static function fetchInstockItems(){

			$conn = new connection();
			$Instockitem = array();

			try{
				$conn->open();
				$query = $conn->query("SELECT * FROM dbo.its_itemrecords where status = 'In-Stock'");
				$counter =0;
				while($row = $conn->fetch_array($query)){
					$getItems = new Its_Additem();
					$getItems->setSerial($row['itemserial']);
					$getItems->setItemBrand($row['brand']);
					$getItems->setItemModel($row['model']);
					$getItems->setItemDesc($row['description']);
					$Instockitem[$counter] = $getItems;
					$counter++;

				}

				$conn->close();
			}catch(Exception $e){

			}
			return $Instockitem;

		}


		

		public function InsertItem($pcsr,$itsr,$brand,$model,$des,$type,$name,$ser){
			$conn = new Connection();
			$success = true;

			try{
				$conn->open();
				$conn->query("INSERT INTO dbo.its_itemrecords VALUES('".$pcsr."','".$itsr."','".$brand."','".$model."','".$des."','In-Stock','".$type."',GETDATE(),'".$name."','".$ser."')");

				$conn->close();

			}catch(Exception $e){
				$success = false;
			}
		

		}

		public function updateItemRecord(){
			$conn = new Connection();
 
			try{
				$conn->open();
				$dataset = $conn->query("UPDATE dbo.its_itemrecords SET 
					pcserial = '".$this->getPCSerial()."', 
					sserial = '".$this->getSerial()."',
					brand ='".$this->getItemBrand()."',
					model = '".$this->getItemModel()."', 
					description = '".$this->getItemDesc()."',
					status = '".$this->getStatus()."',
					type = '".$this->getItemType()."',
					lastupdated = GETDATE(),
					lastupdatedby = '".$this->getLastUpdatedBy()."'	
					WHERE itemserial = '".$this->getTrackingNo()."'");
				$conn->close();
			}catch(Exception $e){

			}
		}

		public static function Getitemrecords(){

			$conn = new connection();
			$item = array();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_itemrecords");
				$counter = 0;
				while($row = $conn->fetch_array($result))
				{
					$item_records = new Its_Additem();
					$item_records->setPCSerial($row['pcserial']);
					$item_records->setTrackingNo($row['itemserial']);
					$item_records->setSerial($row['sserial']);
					$item_records->setItemBrand($row['brand']);
					$item_records->setItemModel($row['model']);
					$item_records->setItemDesc($row['description']);
					$item_records->setStatus($row['status']);
					$item_records->setItemType($row['type']);
					$item_records->setLastUpdated($row["lastupdated"]->format('Y-m-d h:i:s a'));
					$item_records->setLastUpdatedBy($row['lastupdatedby']);
					$item[$counter]=$item_records;
					$counter++;
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $item;
		}


		public function GetitemrecordsByserial($serial)
		{
			$conn = new Connection();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_itemrecords where itemserial ='".$serial."'");
				if ($conn->has_rows($result)){
					$reader = $conn->fetch_array($result);
					$this->setTrackingNo($reader['itemserial']);
					$this->setItemBrand($reader['brand']);
					$this->setItemModel($reader['model']);
					$this->setItemType($reader['type']);
					$this->setItemDesc($reader['description']);
					$this->setPCSerial($reader['pcserial']);
					$this->setStatus($reader['status']);	
					$this->setSerial($reader['sserial']);			
				}
				$conn->close();
			}catch(Exception $e){

			}
			
		}


	}
?>