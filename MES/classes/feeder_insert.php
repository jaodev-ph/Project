<?php 
include_once("connection.php");
class Insert {

	private $feederId;
	private $feederType;
	private $feederSize;
	private $plantNoFeeder;
	private $lastupdatedBy;
	private $lastupdate;
	private $description;
	private $process;
	private $line;


function __construct(){

	}
//setter

	public function setfeederId($feederId)
	{
		$this->feederId = $feederId; 
	}

	public function setfeederType($feederType)
	{
		$this->feederType = $feederType;
	}
	public function setplantNoFeeder($plantNoFeeder)
	{
		$this->plantNoFeeder = $plantNoFeeder;
	}
	public function setlastupdatedBy($lastupdatedBy)
	{
		$this->lastupdatedBy = $lastupdatedBy;
	}
	public function setfeederSize($feederSize)
	{
		$this->feederSize = $feederSize;
	}
	public function setlastupdate($lastupdate)
	{
		$this->lastupdate = $lastupdate;
	}
	public function setdescription($description)
	{
		$this->description = $description;
	}
	public function setprocess($process)
	{
		$this->process = $process;
	}
	public function setline($line)
	{
		$this->line = $line; 
	}

	

//getter

	public function getfeederId()
	{
		return $this->feederId;
	}

	public function getfeederType()
	{
		return $this->feederType;
	}
	public function getplantNoFeeder()
	{
		return $this->plantNoFeeder;
	}
	public function getlastupdatedBy()
	{
		return $this->lastupdatedBy;
	}
	public function getfeederSize()
	{
		return $this->feederSize;
	}
	public function getlastupdate()
	{
		return $this->lastupdate;
	}
	public function getdescription()
	{
		return $this->description;
	}
	public function getprocess()
	{
		return $this->process;
	}
	public function getline()
	{
		return $this->line;
	}

	public function Update()
	{
		$conn = new connection();
		try{


			$conn->open();
			$conn->query("UPDATE dbo.feederId SET feederType='".$this->getfeederType()."',feederSize='".$this->getfeederSize()."',plantNoFeeder='".$this->getplantNoFeeder()."',lastupdate=getdate() WHERE feederId='".$this->getfeederId()."'");
				
			echo "Successfully Updated";
			$conn->close();
			
		}catch(Exception $e){

		}
		
	}
	public static function getAllFeeder() {
		$conn = new connection();
		$feeder = array();

		try{

			$conn->open();
			$feeders = $conn->query("SELECT * from dbo.feeder");

			$count = 0;

			while($row=$conn->fetch_array($feeders)){

				$feed = new Insert;

				$feed->setfeederId($row['feederId']);
				$feed->setfeederType($row['feederType']);
				$feed->setfeederSize($row['feederSize']);
				$feed->setplantNoFeeder($row['plantNoFeeder']);

				$feeder[$count] = $feed;
				$count++;
			} 

			$conn->close();
		}
		catch(Exception $e){

		}
		return $feeder;
	}
	

	public static function getAllFeederType() {

		$conn = new connection();
		$feeder = array();

		try{

			$conn->open();
			$feeders = $conn->query("SELECT * from dbo.feederInfo where active=1");

			$count = 0;

			while($row=$conn->fetch_array($feeders)){

				$feed = new Insert;

				
				$feed->setfeederType($row['feederType']);
				$feeder[$count] = $feed;
				$count++;



			} 

			$conn->close();

		}
		catch(Exception $e){

		}
		return $feeder;
	}

	public static function getAllFeederSize() {

		$conn = new connection();
		$feeder = array();

		try{

			$conn->open();
			$feeders = $conn->query("SELECT * from dbo.feedersize");

			$count = 0;

			while($row=$conn->fetch_array($feeders)){

				$feed = new Insert;

				
				$feed->setfeederSize($row['feedersize']);
				$feeder[$count] = $feed;
				$count++;



			} 

			$conn->close();

		}
		catch(Exception $e){

		}
		return $feeder;
	}

	public static function getAllPlant() {

		$conn = new connection();
		$feeder = array();
		try{

			$conn->open();
			$feeders = $conn->query("SELECT * from dbo.feederplant");

			$count = 0;

			while($row=$conn->fetch_array($feeders)){

				$feed = new Insert;

				
				$feed->setplantNoFeeder($row['plantNoFeeder']);
				$feeder[$count] = $feed;
				$count++;



			} 

			$conn->close();

		}
		catch(Exception $e){

		}
		return $feeder;
	}
	public static function getStation() {

		$conn = new connection();
		$feeder = array();
		try{

			$conn->open();
			$feeders = $conn->query("SELECT * from dbo.feederstation where sequence !=0");

			$count = 0;

			while($row=$conn->fetch_array($feeders)){

				$feed = new Insert;

				
				$feed->setdescription($row['description']);
				$feeder[$count] = $feed;
				$count++;



			} 

			$conn->close();

		}
		catch(Exception $e){

		}
		return $feeder;
	}

}
?> 