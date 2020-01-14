<?php  
	include_once("connection.php");

	class Its_Mobile
	{
		private $imei;
		private $serial;
		private $mobileno;
		private $mobilebrand;
		private $mobilemodel;
		private $accno ;
		private $accessories;
		private $color;
		private $plan;
		private $planinclu;
		private $macadd;
		private $dispatchto;
		private $company;
		private $department;
		private $purpose;
		private $status;
		private $lastupdatedby;
		private $lastupdated;
		private $id;
		private $type;
		private $types;
		private $simserial;

		


		public function __construct()
		{

		}

		public function setIMEI($imei)
		{
			$this->imei = $imei;
		}
		public function setID($id)
		{
			$this->id = $id;
		}
		
		public function setMobileNo($mobileno)
		{
			$this->mobileno = $mobileno;
		}
		public function setMobileBrand($mobilebrand)
		{
			$this->mobilebrand = $mobilebrand;
		}
		public function setMobileModel($mobilemodel)
		{
			$this->mobilemodel = $mobilemodel;
		}
	
		public function setMACadd($macadd)
		{
			$this->macadd = $macadd;
		}
		public function setDispatchTo($dispatchto)
		{
			$this->dispatchto = $dispatchto;
		}
		public function setCompany($company)
		{
			$this->company = $company;
		}
		public function setDepartment($department)
		{
			$this->department = $department;
		}
		public function setStatus($status)
		{
			$this->status = $status;
		}
		public function setPurpose($purpose)
		{
			$this->purpose = $purpose;
		}
		public function setLastUpdatedBy($lastupdatedby)
		{
			$this->lastupdatedby = $lastupdatedby;
		}
		public function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		public function setType($type)
		{
			$this->type = $type;
		}
		public function setTypes($types)
		{
			$this->types = $types;
		}
		public function setSimSerial($simserial)
		{
			$this->simserial = $simserial;
		}

		public function setAccno($accno){
			$this->accno = $accno;
		}

		public function setAccessories($accessories){
			$this->accessories = $accessories;
		}

		public function setColor($color){
			$this->color = $color;
		}
		public function setPlan($plan){
			$this->plan = $plan;
		}
		public function setPlaninclu($planinclu){
			$this->planinclu = $planinclu;
		}


		/*	getters*/

		public function getAccno()
		{
			return $this->accno;

		}
		public function getAccessories()
		{
			return $this->accessories;
		}

		public function getColor()
		{
			return $this->color;
		}

		public function getPlan()
		{
			return $this->plan;
		}

		public function getPlanInclu()
		{
			return $this->planinclu;
		}


		public function getIMEI()
		{
			return $this->imei;
		}
		public function getID()
		{
			return $this->id;
		}
		public function getSerial()
		{
			return $this->serial;
		}
		public function getMobileNo()
		{
			return $this->mobileno;
		}
		public function getMobileBrand()
		{
			return $this->mobilebrand;
		}
		public function getMobileModel()
		{
			return $this->mobilemodel;
		}
		
		public function getMACadd()
		{
			return $this->macadd;
		}
		public function getDispatchTo()
		{
			return $this->dispatchto;
		}
		public function getCompany()
		{
			return $this->company;
		}
		public function getDepartment()
		{
			return $this->department;
		}
		public function getStatus()
		{
			return $this->status;
		}
		public function getPurpose()
		{
			return $this->purpose;
		}
		public function getLastUpdated()
		{
			return $this->lastupdated;
		}
		public function getLastUpdatedBy()
		{
			return $this->lastupdatedby;
		}
		public function getType()
		{
			return $this->type;
		}
		public function getTypes()
		{
			return $this->types;
		}
		public function getSimSerial()
		{
			return $this->simserial;
		}







		public static function getAllMobileBrand($type)
		{
			$conn = new Connection();
			$its_mobile2 = array();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_brands where type='$type' order by description asc");
				$counter = 0;
				while($row = $conn->fetch_array($result))
				{
					$its_mobile = new Its_Mobile();
					$its_mobile->setID($row['id']);
					$its_mobile->setMobileBrand($row['description']);
					$its_mobile->setType($row['type']);
					$its_mobile2[$counter]=$its_mobile;
					$counter++;
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $its_mobile2;
		}



		public static function getAllMobileRecords($sql="SELECT * FROM dbo.its_mobilerecords order by lastupdated")
		{
			$conn = new Connection();
			$its_editmobile2 = array();

			try{
				$conn->open();
				$result = $conn->query($sql);
				$counter = 0;
				while($row = $conn->fetch_array($result))
				{
					$its_editmobile = new Its_Mobile();
					$its_editmobile->setIMEI($row['imei']);
					$its_editmobile->setMobileNo($row['mobileNo']);
					$its_editmobile->setSimSerial($row['simSerial']);
					$its_editmobile->setTypes($row['type']);
					$its_editmobile->setMobileBrand($row['brand']);
					$its_editmobile->setMobileModel($row['model']);
					$its_editmobile->setAccno($row['accno']);
					$its_editmobile->setAccessories($row['accessories']);
					$its_editmobile->setPlan($row['plann']);
					$its_editmobile->setColor($row['color']);
					$its_editmobile->setMACadd($row['macAddress']);
					$its_editmobile->setDispatchTo($row['dispatchto']);
					$its_editmobile->setCompany($row['company']);
					$its_editmobile->setDepartment($row['department']);
					$its_editmobile->setPurpose($row['purpose']);
					$its_editmobile->setStatus($row['status']);
					$its_editmobile->setLastUpdated($row["lastupdated"]->format('Y-m-d h:i:s a'));
					$its_editmobile->setLastUpdatedBy($row['lastupdatedby']);
					$its_editmobile2[$counter]=$its_editmobile;
					$counter++;
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $its_editmobile2;
		}

		public function getRecordMobile($imei)
		{
			$conn = new Connection();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_mobilerecords where imei ='".$imei."'");
				if ($conn->has_rows($result)){
					$reader = $conn->fetch_array($result);
					$this->setIMEI($reader['imei']);
					$this->setMobileNo($reader['mobileNo']);
					$this->setTypes($reader['type']);
					$this->setSimSerial($reader['simSerial']);
					$this->setMobileBrand($reader['brand']);
					$this->setMobileModel($reader['model']);
					$this->setMACadd($reader['macAddress']);
					$this->setDispatchTo($reader['dispatchto']);
					$this->setCompany($reader['company']);
					$this->setDepartment($reader['department']);
					$this->setPurpose($reader['purpose']);
					$this->setStatus($reader['status']);
					$this->setAccno($reader['accno']);
					$this->setColor($reader['color']);
					$this->setPlan($reader['plann']);
					$this->setAccessories($reader['accessories']);
					$this->setPlaninclu($reader['plan_inclusion']);
				}
				$conn->close();
			}catch(Exception $e){

			}
			
		}

		public static function selectMobileModel($brand)
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where type = '".$brand."'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_BrandModel();
				 	$Select->setBrand($reader["description"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function selectMobileBrandModel($brand,$MobileType)
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_brands where description = '".$brand."' and type='".$MobileType."'");
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

		public static function selectMobileBrandModelID($id)
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_model where brandID = '".$id."'");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_Mobile();
				 	$Select->setMobileModel($reader["modelDesc"]);
				 	//$Select->setBrandID($reader["id"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

		public static function addMobile($imei,$simserial,$mac,$brand,$model,$accno,$company,$department,$mobileno,$accessories,$color,$plan,$planinclu,$dispatchto,$purpose,$type,$status,$lastupdatedby)
		{
			$conn = new Connection();
			$success = true;

			try{
				$conn->open();
				$conn->query("INSERT INTO dbo.its_mobilerecords VALUES('".$imei."','".$simserial."','".$mac."','".$brand."','".$model."','".$accno."','".$company."','".$department."','".$mobileno."','".$accessories."','".$color."','".$plan."','".$planinclu."','".$$dispatchto."','".$purpose."','".$type."','".$status."',GETDATE(),'".$lastupdatedby."')");

				$conn->close();

			}catch(Exception $e){
				$success = false;
			}
		}

		public function updateRecordMobile(){
			$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("UPDATE dbo.its_mobilerecords SET 
					mobileNo = '".$this->getMobileNo()."', 
					type = '".$this->getType()."', 
					simSerial ='".$this->getSimSerial()."',
					brand = '".$this->getMobileBrand()."', 
					model = '".$this->getMobileModel()."',
					macAddress = '".$this->getMACadd()."',
					dispatchto = '".$this->getDispatchTo()."',
					company = '".$this->getCompany()."',
					department = '".$this->getDepartment()."',
					purpose = '".$this->getPurpose()."',
					status = '".$this->getStatus()."',
					accno = '".$this->getAccno()."',
					accessories = '".$this->getAccessories()."',
					color = '".$this->getColor()."',
					plann = '".$this->getPlan()."',
					plan_inclusion = '".$this->getPlanInclu()."',
					lastupdated = GETDATE(),
					lastupdatedby = '".$this->getLastUpdatedBy()."'
					WHERE imei = '".$this->getIMEI()."'");
				$conn->close();
			}catch(Exception $e){

			}
		}


	}
?>