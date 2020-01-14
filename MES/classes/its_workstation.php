<?php  
	include_once("connection.php");

	class Its_Workstation
	{
		private $pcName;
		private $ipAddress;
		private $macAddress;
		private $model;
		private $operatingSystem;
		private $license;
		private $status;
		private $dispatchTo;
		private $company;
		private $department;
		private $applications;
		private $lastupdatedby;
		private $appID;
		private $appType;
		private $brand;
		private $type;
		private $id;
		private $username;
		private $tag;
		private $lastupdated;

		public function __construct()
		{

		}
		public function setID($id) 
		{
			$this->id = $id;

		}
			public function setUsername($username) 
		{
			$this->username = $username;

		}
		public function setPCname($pcName)
		{
			$this->pcName = $pcName;
		}
		public function setIPaddress($ipAddress)
		{
			$this->ipAddress = $ipAddress;
		}
		public function setMACaddress($macAddress)
		{
			$this->macAddress = $macAddress;
		}
		public function setModel($model)
		{
				$this->model = $model;
		}
		public function setOperatingSystem($operatingSystem)
		{
			$this->operatingSystem = $operatingSystem;
		}
		public function setLicense($license)
		{
			$this->license = $license;
		}
		public function setStatus($status)
		{
			$this->status = $status;
		}
		public function setDispatchTo($dispatchTo)
		{
			$this->dispatchTo = $dispatchTo;
		}
		public function setCompany($company)
		{
			$this->company = $company;
		}
		public function setApplications($applications)
		{
			$this->applications = $applications;
		}
		public function setAppType($appType)
		{
			$this->appType = $appType;
		}
		public function setDepartment($department)
		{
			$this->department = $department;
		}
		public function setLastUpdatedBy($lastupdatedby)
		{
			$this->lastupdatedby = $lastupdatedby;
		}
		public function setAppID($appID)
		{
			$this->appID = $appID;
		}
		public function setBrand($brand)
		{
			$this->brand = $brand;
		}
		public function setType($type){
			$this->type = $type;
		}

		public function setTag($tag){
			$this->tag = $tag;
		}

		public function setLastUpdated($l)
		{
			$this->lastupdated = $l;

		}
	

		//getters

		public function getTag(){
			return $this->tag;
		}
		
		public function getUsername()
		{
			return $this->username;
		}

		public function getID()
		{
			return $this->id;
		}
		public function getType(){
			return $this->type;
		}

		public function getPCname()
		{
			return $this->pcName;
		}
		public function getIPaddress()
		{
			return $this->ipAddress;
		}
		public function getMACaddress()
		{
			return $this->macAddress;
		}
		public function getModel()
		{
			return $this->model;
		}
		public function getOperatingSystem()
		{
			return $this->operatingSystem;
		}
		public function getLicense()
		{
			return $this->license;
		}
		public function getStatus()
		{
			return $this->status;
		}
		public function getDispatchTo()
		{
			return $this->dispatchTo;
		}
		public function getCompany()
		{
			return $this->company;
		}
		public function getApplications()
		{
			return $this->applications;
		}
		public function getAppType()
		{
			return $this->appType;
		}
		public function getDepartment()
		{
			return $this->department;
		}
		public function getLastUpdatedBy()
		{
			return $this->lastupdatedby;
		}
		public function getAppID()
		{
			return $this->appID;
		}

		public function getLastUpdated(){
			return $this->lastupdated;
		}


		////new function \

		public function insertNewUser($user,$company,$dept,$name){
			$conn = new Connection();
			try{
				$conn->open();
				$query = $conn->query("INSERT INTO dbo.its_usertable values ('".$user."','".$company."','".$dept."',GETDATE(),'".$name."')");
				$conn->close();
			}catch(Exception $e){

			}
		}

		public function updateUser(){

			$conn = new connection();
			try{
				$conn->open();
				$query = $conn->query("UPDATE dbo.its_usertable SET 
				Name ='".$this->getUsername()."',
				company = '".$this->getCompany()."',
				department = '".$this->getDepartment()."',
				lastupdated = GETDATE(),
				lastupdatedby = '".$this->getLastUpdatedBy()."'
				WHERE id = '".$this->getID()."'");
				$conn->close();
			}catch(Exception $e){

			}

		}


		public  function getuserByID($id){
		
			$conn = new Connection();
			try{
					$conn->open();
					$result = $conn->query("SELECT * from dbo.its_usertable where id= '".$id."'");
					if ($conn->has_rows($result)){
					$reader = $conn->fetch_array($result);
					$this->setID($reader['id']);
					$this->setUsername($reader['Name']);
					$this->setCompany($reader['company']);
					$this->setDepartment($reader['department']);
					}
					$conn->close();
				}catch(Exception $e){

			}

		}



		
		public function getAppByPC($pcserial)
		{
			$conn = new Connection();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_workstation where pcserial ='".$pcserial."'");
				if ($conn->has_rows($result)){
					$reader = $conn->fetch_array($result);
					
					$this->setApplications($reader['application']);
				}
				$conn->close();
			}catch(Exception $e){

			}
			
		}



		public static function getTotalCount($filter){
			$conn = new connection();
			$count = "";
			try{
				$conn->open();
				$query = $conn->query("SELECT count(*) as Count from dbo.its_workstation 
									   WHERE pcserial LIKE '%".$filter."%'");
				if($conn->has_rows($query)){
					$reader = $conn->fetch_array($query);
					$count = $reader['Count'];
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $count;

		}


		public static function getworkstation($offset,$row,$type,$search){
			$conn = new Connection();
			$workstation = array();

			try{
				$conn->open();
				$counter=0;
				$result = $conn->query("SELECT * FROM dbo.its_workstation
										WHERE pcserial LIKE '%".$type."%' 
										AND (ip LIKE '%".$search."%'
										OR mac LIKE '%".$search."%'
										OR model Like '%".$search."%'
										OR os LIKE '%".$search."%' 
										OR license LIKE '%".$search."%' 
										OR dispatchto LIKE '%".$search."%' 
										OR company LIKE '%".$search."%' 
										OR dispatchloc LIKE '%".$search."%' 
										OR lastupdatedby LIKE '%".$search."%' 
										OR service_tag LIKE '%".$search."%') 
										order by pcserial OFFSET ".$offset." ROWS FETCH NEXT ".$row." ROW ONLY");
				while($row = $conn->fetch_array($result))
				{
					$its_workstation = new Its_Workstation();
					$its_workstation->setPCname($row['pcserial']);
					$its_workstation->setIPaddress($row['ip']);
					$its_workstation->setMACaddress($row['mac']);
					$its_workstation->setOperatingSystem($row['os']);
					$its_workstation->setLicense($row['license']);
					$its_workstation->setStatus($row['status']);
					$its_workstation->setDispatchTo($row['dispatchto']);
					$its_workstation->setCompany($row['company']);
					$its_workstation->setDepartment($row['dispatchloc']);
					$its_workstation->setTag($row['service_tag']);
					$its_workstation->setModel($row['model']);
					$workstation[$counter] = $its_workstation;
					$counter++;

				}
				$conn->close();
			}catch(Exception $e){

			}
			return $workstation;
		}


			public function getworkstationvalue($pcserial){

			$conn = new Connection();
			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_workstation where pcserial = '".$pcserial."'");
				while($row = $conn->fetch_array($result))
				{
					$this->setPCname($row['pcserial']);
					$this->setIPaddress($row['ip']);
					$this->setMACaddress($row['mac']);
					$this->setOperatingSystem($row['os']);
					$this->setLicense($row['license']);
					$this->setStatus($row['status']);
					$this->setDispatchTo($row['dispatchto']);
					$this->setCompany($row['company']);
					$this->setDepartment($row['dispatchloc']);
					$this->setTag($row['service_tag']);
					$this->setModel($row['model']);		
				}
				$conn->close();
			}catch(Exception $e){

			}

		}

		public  function insertWorkstation($pcname,$ip,$mac,$os,$license,$dispatchto,$company,$dept,$name,$tag){

			$conn = new Connection();
			$success = true;
			try{
				$conn->open();
				$query = $conn->query("INSERT INTO dbo.its_workstation(pcserial,ip,mac,os,license,dispatchto,company,dispatchloc,lastupdated,lastupdatedby,service_tag) VALUES('".$pcname."','".$ip."','".$mac."','".$os."','".$license."','".$dispatchto."','".$company."','".$dept."',GETDATE(),'".$name."','".$tag."')");
				$conn->close();

			}catch(Exception $e){
				$success = false;
			}

		}

		public function updateWorkstation(){
			$conn = new Connection();
				
				try{
				$conn->open();
				$dataset = $conn->query("UPDATE dbo.its_workstation SET  
					ip ='".$this->getIPaddress()."',
					mac = '".$this->getMACaddress()."', 
					os = '".$this->getOperatingSystem()."',
					model = '".$this->getmodel()."',
					license = '".$this->getLicense()."',
					dispatchto = '".$this->getDispatchTo()."',
					company = '".$this->getCompany()."',
					dispatchloc = '".$this->getDepartment()."',
					service_tag = '".$this->getTag()."',
					lastupdated = GETDATE(),
					lastupdatedby = '".$this->getLastUpdatedBy()."'	
					WHERE pcserial = '".$this->getPCname()."'");
				$conn->close();
			}
			catch(Exception $e){

			}
		
		}







		//FUNCTIONS
		public static function getAllRecords()
		{
			$conn = new Connection();
			$its_workstations = array();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_records ORDER BY id asc");
				$counter = 0;
				while($row = $conn->fetch_array($result))
				{
					$its_workstation = new Its_Workstation();
					$its_workstation->setPCname($row['pcname']);
					$its_workstation->setIPaddress($row['ipAddress']);
					$its_workstation->setMACaddress($row['macAddress']);
					$its_workstation->setModel($row['model']);
					$its_workstation->setOperatingSystem($row['operatingSystem']);
					$its_workstation->setLicense($row['license']);
					$its_workstation->setStatus($row['status']);
					$its_workstation->setDispatchTo($row['dispatchto']);
					$its_workstation->setCompany($row['company']);
					$its_workstation->setDepartment($row['department']);
					$its_workstations[$counter]=$its_workstation;
					$counter++;
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $its_workstations;
		}

		public function getRecord($pcname)
		{
			$conn = new Connection();
			try{
					$conn->open();
					$result = $conn->query("SELECT * FROM dbo.its_workstation where pcserial ='".$pcname."'");
					if ($conn->has_rows($result)){
						$reader = $conn->fetch_array($result);
						$this->setPCname($reader['pcname']);
						$this->setIPaddress($reader['ip']);
						$this->setMACaddress($reader['mac']);
						$this->setModel($reader['model']);
						$this->setOperatingSystem($reader['os']);
						$this->setLicense($reader['license']);
						$this->setStatus($reader['status']);
						$this->setDispatchTo($reader['dispatchto']);
						$this->setCompany($reader['company']);
						$this->setDepartment($reader['dispatchloc']);
					}
					$conn->close();
				}catch(Exception $e){

			}
			
		}

		public function getworkstationcount($comp,$type)
		{
			$conn = new Connection();
			$count = "";

			try{
				$conn->open();
				$result = $conn->query("SELECT count(*)+1 as Count FROM dbo.its_workstation
										 WHERE pcserial LIKE '".$comp."%".$type."%'");
				$counter = 0;
					if ($conn->has_rows($result)){
					$reader = $conn->fetch_array($result);
					$count = $reader['Count'];
					
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $count;
		}

		public function getCount($comp,$type)
		{
			$conn = new Connection();
			$count = "";

			try{
				$conn->open();
				$result = $conn->query("SELECT count(*)+1 as Count FROM dbo.its_records WHERE pcname LIKE '".$comp."%".$type."%'");
				$counter = 0;
					if ($conn->has_rows($result)){
					$reader = $conn->fetch_array($result);
					$count = $reader['Count'];
					
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $count;
		}

		public static function selectAllUser()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_usertable");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_Workstation();
					$Select->setID($reader["id"]);
				 	$Select->setDispatchTo($reader["Name"]);
				 	$Select->setCompany($reader['company']);
					 $Select->setDepartment($reader['department']);
					 $Select->setLastUpdated($reader['lastupdated']->format('Y-m-d h:i:s a'));
					 $Select->setLastUpdatedBy($reader['lastupdatedby']);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
			return $result;
		}

		public static function selectAllOS()
		{
			$conn = new connection();
			$result = array();

			try{
				$conn->open();
				$dataset =  $conn->query("SELECT * FROM dbo.its_operatingSystems");
				$counter = 0;
				while($reader = $conn->fetch_array($dataset)){

					$Select = new Its_Workstation();
				 	$Select->setOperatingSystem($reader["description"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
		}

////


	}
?>