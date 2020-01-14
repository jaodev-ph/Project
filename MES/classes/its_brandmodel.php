<?php  
	include_once("connection.php");

	class Its_BrandModel
	{
		private $model;
		private $lastupdatedby;
		private $brandid;
		private $brandType;
		private $brand;
		private $updated;

		public function __construct()
		{

		}

		public function setModel($model)
		{
				$this->model = $model;
		}
		public function setBrandType($brandType)
		{
			$this->brandType = $brandType;
		}
		public function setLastUpdatedBy($lastupdatedby)
		{
			$this->lastupdatedby = $lastupdatedby;
		}
		public function setBrandID($brandid)
		{
			$this->brandid = $brandid;
		}
		public function setBrand($brand)
		{
			$this->brand = $brand;
		}
		public function setLastUpdate($updated)
		{
			$this->updated = $updated;
		}

		public function getModel()
		{
			return $this->model;
		}
		public function getBrand()
		{
			return $this->brand;
		}
		public function getBrandType()
		{
			return $this->brandType;
		}
		public function getLastUpdatedBy()
		{
			return $this->lastupdatedby;
		}
		public function getBrandID()
		{
			return $this->brandid;
		}
		public function getLastUpdate()
		{
			return $this->updated;
		}


		//FUNCTIONS




		public static function getAllType(){
			$conn  = new Connection();
			$result = array();
			$counter= 0;
			try{
				$conn->open();
				$query = $conn->query("SELECT distinct type FROM dbo.its_brands");
				while ($row = $conn->fetch_array($query)) {
					$get = new Its_BrandModel();
					$get->setBrandType($row['type']);
					$result[$counter] =$get;
					$counter++; 
				}
				$conn->close();

			}
			catch(Exception $e){

			}
			return $result;
		}

		public static function selectLaptopServerModel()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where type in('Laptop','Server')");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
				 	$Select->setModel($reader["description"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function selectAllBrandModel()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT b.id, a.description, b.modelDesc, a.type, a.lastupdated, b.lastupdatedby FROM dbo.its_brands a inner join dbo.its_model b on a.id = b.brandID order by b.id desc");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
					$Select->setBrandID($reader["id"]);
				 	$Select->setBrand($reader["description"]);
				 	$Select->setModel($reader["modelDesc"]);
				 	$Select->setBrandType($reader["type"]);
				 	$Select->setLastUpdate($reader["lastupdated"]->format('Y-m-d h:i:s a'));
				 	$Select->setLastUpdatedBy($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}


		public static function selectAllBrandModel1($id)
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT b.id, a.description, b.modelDesc, a.type, a.lastupdated, b.lastupdatedby FROM dbo.its_brands a inner join dbo.its_model b on a.id = b.brandID WHERE b.id = '".$id."'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){
					$Select = new Its_BrandModel();
					$Select->setBrandID($reader["id"]);
				 	$Select->setBrand($reader["description"]);
				 	$Select->setModel($reader["modelDesc"]);
				 	$Select->setBrandType($reader["type"]);
				 	$Select->setLastUpdate($reader["lastupdated"]->format('Y-m-d h:i:s a'));
				 	$Select->setLastUpdatedBy($reader["lastupdatedby"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function selectBrand()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT DISTINCT * FROM dbo.its_brands order by description ASC");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
					 $Select->setBrand($reader["description"]);
					 $Select->setLastUpdate($reader["lastupdated"]->format('Y-m-d h:i:s a'));
					 $Select->setLastUpdatedBy($reader["lastupdatedby"]);
					 $Select->setBrandType($reader["type"]);
				
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}



		public static function selectMonitorModel()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where type = 'Monitor'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){


					$Select = new Its_BrandModel();
				 	$Select->setModel($reader["description"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function selectMemoryCardModel()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where type = 'Memory Card'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
				 	$Select->setModel($reader["description"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function selectHardDiskModel()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where type = 'Hard Disk'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
				 	$Select->setModel($reader["description"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function selectKeyboardModel()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where type = 'Keyboard'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
				 	$Select->setModel($reader["description"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function selectMouseModel()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where type = 'Mouse'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
				 	$Select->setModel($reader["description"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public function addBrand($brand,$type,$name){
			$conn = new Connection();
			$success = true;
			try{
				$conn->open();

				$conn->query("INSERT INTO dbo.its_brands VALUES('".$brand."',GETDATE(),'".$name."','".$type."')");
				$conn->close();

			}catch(Exception $e){

			}	
		}
		
		//for validation
		public static function validateBrand($brand,$type){
		
		$conn = new Connection();
		$result = false;

		try{
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.its_brands WHERE description = '".$brand."' and type = '".$type."'");

			if ($conn->has_rows($myquery)>0){
				$result = true;
			}
			
			$conn->close();
			}
		catch(Exception $e){

		}
		return $result;

		}
/*
		public static function validateAddNewItem($brand,$model,$type){

			$conn = new Connection();
			$result = false;

			try{

				$conn->open();
				$query = $conn->query("SELECT * from dbo.");
			}
		}
*/



		public function addbrandbyparam($brand,$type,$name){
			$conn = new Connection ();
			$success = true;
			try{
				$conn->open();
				$conn->query("INSERT INTO dbo.its_brands VALUES('".$brand."',GETDATE(),'".$type."','".$name."'')");
				$conn->close();
			}catch(Exeption $e){
			$success = false;
			}


		}











		public static function getbrandById($id){
			$conn = new connection();
			$brands = array();
		

			try{

				$conn->open();
				$result = $conn->query("SELECT * from  dbo.its_brands WHERE id ='".$id."'");
				$counter = 0;
				while($row = $conn->fetch_array($result)){
					$fetchdata = new Its_BrandModel();
					$fetchdata->setBrand($row['description']);
					$fetchdata->setBrandType($row['type']);
					$brands[$counter] = $fetchdata;
					$counter++;
				}
				$conn->close();

			}
			catch(Exception $e){

			}
			return $brands;
		}

		public static function getBrandTypeID($brand,$type){

			$conn = new Connection();
			$result = "";

			try{
				$conn->open();
				$query = $conn->query("SELECT * from dbo.its_brands where description  ='".$brand."' and type ='".$type."'");
				$counter = 0;
				if($conn->has_rows($query)){
					$reader = $conn->fetch_array($query);
					$result = $reader['id'];
				}
				
				$conn->close();
			}
			catch(Exception $e){

			}
			
		return $result;

		}



		public function addModel($id,$model){
			$conn = new Connection();

			try{
				$conn->open();

				$conn->query("INSERT INTO dbo.its_model VALUES('".$model."','".$id."',GETDATE(),'".$this->getLastUpdatedBy()."')");

				$conn->close();
			}catch(Exception $e){

			}	
		}

		public function selectTopId()
		{
			$conn = new connection();
			$result = "";

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT TOP 1 * FROM dbo.its_brands order by id desc");
				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
		
					$result = $reader['id'];
				}
				$conn->close();
			}catch(Exception $e){

			}
		return $result;
		}

		public static function UpdateBrand($id,$brand,$name,$type){
			$conn = new connection();

			try{
				$conn->open();
				$conn->query("UPDATE [dbo].[its_brands] SET description = '".$brand."', lastupdated = GETDATE(), lastupdatedby ='".$name."', type ='".$type."' WHERE id = '".$id."'");

				$conn->close();
			}catch(Exception $e){

			}
		}










		public function UpdateModel($id,$brandid,$model,$name){
			$conn = new Connection();

			try{
				$conn->open();
				$conn->query("UPDATE dbo.its_model SET modelDesc = '".$model."', brandID ='".$brandid."', lastupdated = GETDATE(), lastupdatedby ='".$name."' WHERE id = '".$id."'");

				$conn->close();
			}catch(Exception $e){

			}
		}

		public function selectBrandid($id)
		{
			$conn = new connection();
			$result = "";

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_model WHERE id='".$id."'");
				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
		
					$result = $reader['brandID'];
				}
				$conn->close();
			}catch(Exception $e){

			}
		return $result;
		}

		public static function selectTypeModel($type)
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where type = '".$type."'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
				 	$Select->setBrand($reader["description"]);
				 	$Select->setBrandType($reader["type"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}



			public static function selectType(){
			$conn = new Connection();
			$result = array();
			try{
				$conn->Open();
				$dataset = $conn->query("SELECT DISTINCT type from dbo.its_brands ");
				$counter = 0;
				while($row = $conn->fetch_array($dataset)){
					$fetchType = new Its_BrandModel();
					$fetchType ->setBrandType($row["type"]);
					$result[$counter] = $fetchType;
					$counter++;
				}
				$conn->close();

			}

			catch(Exception $e){

			}
			return $result;
		}



		public static function validateModel($model,$brandid){

			$conn = new Connection();
			$result= false;
			try{
				$conn->open();
				$query = $conn->query("SELECT * from dbo.its_model where modelDesc='".$model."' and brandID = '".$brandid."'");
				if($conn->has_rows($query)){
					$result = true;
				}
				else{
					$result = false;
				}
				$conn->close();
			}
			catch(Exeption $e){

			}
			return $result;


		}






		public static function validateBrandType($brand,$type)
		{
			$conn = new connection();
			$result = false;

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where description = '".$brand."' and type='".$type."'");
				if ($conn->has_rows($dataset)){

					$result = true;
				}else{
					$result = false;

				}

					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function selectBrandModelID($id)
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_model where brandID = '".$id."'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
				 	$Select->setModel($reader["modelDesc"]);
				 	//$Select->setBrandID($reader["id"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function selectBrandModelType($brand,$type)
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where description = '".$brand."' and type='".$type."'");
				$counter = 0;
				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
		
					$result = $reader['id'];
				}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

	}
?>