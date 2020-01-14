<?php  
	include_once("connection.php");

	class Its_Applications
	{
		private $pcname;
		private $apps;
		private $lastupdatedby;
		private $lastupdated;
		private $id;

		public function __construct()
		{

		}

		public function setID($id)
		{
			$this->id = $id;
		}
		public function setPCname($pcname)
		{
			$this->pcname = $pcname;
		}
		public function setApps($apps)
		{
			$this->apps = $apps;
		}
		public function setLastUpdatedBy($lastupdatedby)
		{
			$this->lastupdatedby = $lastupdatedby;
		}
		public function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}


		public function getID()
		{
			return $this->id;
		}
		public function getPCname()
		{
			return $this->pcname;
		}
		public function getApps()
		{
			return $this->apps;
		}
		public function getLastUpdated()
		{
			return $this->lastupdated;
		}
		public function getLastUpdatedBy()
		{
			return $this->lastupdatedby;
		}




		//new function


		

		public static function fetchApps(){
			$conn= new connection();
			$apps = array();

			try{
				$conn->open();
				$query = $conn->query("SELECT * from dbo.its_applications");
				$counter = 0;

				while($row = $conn->fetch_array($query)){
					$appclass = new Its_Applications();
					$appclass->setApps($row['description']);
					$apps[$counter] = $appclass;
					$counter++;
				}
			}catch(Exception $e){

			}
			return $apps;

		}

		//FUNCTIONS
		public static function getAllPCAppsRecords()
		{
			$conn = new Connection();
			$its_pcapps2 = array();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_pcapplications");
				$counter = 0;
				while($row = $conn->fetch_array($result))
				{
					$its_pcapps = new Its_Applications();
					$its_pcapps->setPCname($row['pcname']);
					$its_pcapps->setApps($row['application']);
					$its_pcapps->setLastUpdated($row['lastupdate']->format('Y-m-d h:i:s a'));
					$its_pcapps->setLastUpdatedBy($row['lastupdatedby']);
					$its_pcapps2[$counter]=$its_pcapps;
					$counter++;
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $its_pcapps2;
		}

		public function getRecordPCApp($pcname)
		{
			$conn = new Connection();
			$its_pcapps2 = array();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_pcapplications where pcname ='".$pcname."'");
				$counter = 0;
				while($row = $conn->fetch_array($result))
				{
					$its_pcapps = new Its_Applications();
					$its_pcapps->setID($row['id']);
					$its_pcapps->setPCname($row['pcname']);
					$its_pcapps->setApps($row['application']);
					$its_pcapps2[$counter]=$its_pcapps;
					$counter++;
				}
				$conn->close();
			}catch(Exception $e){

			}
			return $its_pcapps2;	
		}

		public function getRecordPCApp1($pcname){
		$conn = new Connection();
	
		$pcapps = array();

		try{
			$conn->open();
			$result = $conn->query("SELECT * FROM dbo.its_pcapplications where pcname ='".$pcname."'");
				$counter = 0;

			while ($reader = $conn->fetch_array($result)) {
				$its_pcapps = new Its_Applications();
				$its_pcapps->setID($reader['id']);
				$its_pcapps->setPCname($reader['pcname']);
				$its_pcapps->setApps($reader['application']);
				
				$pcapps[$counter] = $its_pcapps;
				$counter++;
		}
			$conn->close();

		}catch(Exception $e){

		}
		return $pcapps;
	}

		public function updateRecordPCItem(){
			$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("UPDATE dbo.its_pcitemlogs SET 
					item = '".$this->getItem()."', 
					status = '".$this->getStatus()."',
					company = '".$this->getCompany()."',
					lastupdated = GETDATE(),
					lastupdatedby = '".$this->getLastUpdatedBy()."'
					WHERE itemserial = '".$this->getSerial()."'");
				$conn->close();
			}catch(Exception $e){

			}
		}

	}
?>