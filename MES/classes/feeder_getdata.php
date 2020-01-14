<?php

include_once("connection.php");
include_once("../classes/feeder_receiving.php");
class Getdata {

	private $feederId;
	private $feederType;
	private $feederSize;
	private $plantNoFeeder;
	private $feederline;
	private $feederPn;
	private $feederDescription;
	private $description;
	private $endorsedByFeeder;
	private $receivedByFeeder;
	private $endorsedByIssuance;
	private $receivedByIssuance;
	private $status;
	private $process;
	private $lastupdatedBy;
	private $lastupdate;
	private $defect;
	private $defectDetails;
	private $partsReplaced;




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

	public function setfeederSize($feederSize)
	{
		$this->feederSize = $feederSize;
	}
	public function setplantNoFeeder($plantNoFeeder)
	{
		$this->plantNoFeeder = $plantNoFeeder;
	}
	public function setfeederline($feederline)
	{
		$this->feederline = $feederline;
	}
	public function setfeederPn($feederPn)
	{
		$this->feederPn = $feederPn;
	}
	public function setfeederDescription($feederDescription)
	{
		$this->feederDescription = $feederDescription;
	}
	public function setdescription($description)
	{
		$this->description = $description;
	}
	public function setendorsedByFeeder($endorsedByFeeder)
	{
		$this->endorsedByFeeder = $endorsedByFeeder;
	}
	public function setreceivedByFeeder($receivedByFeeder)
	{
		$this->receivedByFeeder = $receivedByFeeder;
	}
	public function setendorsedByIssuance($endorsedByIssuance)
	{
		$this->endorsedByIssuance = $endorsedByIssuance;
	}
	public function setreceivedByIssuance($receivedByIssuance)
	{
		$this->receivedByIssuance = $receivedByIssuance;
	}
	public function setstatus($status)
	{
		$this->status = $status;
	}
	public function setprocess($process)
	{
		$this->process = $process;
	}
	public function setlastupdatedBy($lastupdatedBy)
	{
		$this->lastupdatedBy = $lastupdatedBy;
	}
	public function setlastupdate($lastupdate)
	{
		$this->lastupdate = $lastupdate;
	}

	public function setdefect($defect)
	{
		$this->defect = $defect;
	}

	public function setdefectDetails($defectDetails)
	{
		$this->defectDetails = $defectDetails;
	}

	public function setpartsReplaced($partsReplaced)
	{
		$this->partsReplaced = $partsReplaced;
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

	public function getfeederSize()
	{
		return $this->feederSize;
	}
	public function getplantNoFeeder()
	{
		return $this->plantNoFeeder;
	}
	public function getfeederline()
	{
		return $this->feederline;
	}
	public function getfeederPn()
	{
		return $this->feederPn;
	}
	public function getfeederDescription()
	{
		return $this->feederDescription;
	}
	public function getdescription()
	{
		return $this->description;
	}
	public function getendorsedByFeeder()
	{
		return $this->endorsedByFeeder;
	}
	public function getreceivedByFeeder()
	{
		return $this->receivedByFeeder;
	}
	public function getendorsedByIssuance()
	{
		return $this->endorsedByIssuance;
	}
	public function getreceivedByIssuance()
	{
		return $this->receivedByIssuance;
	}
	public function getstatus()
	{
		return $this->status;
	}
	public function getprocess()
	{
		return $this->process;
	}
	public function getlastupdatedBy()
	{
		return $this->lastupdatedBy;
	}
	public function getlastupdate()
	{
		return $this->lastupdate;
	}
	public function getdefect()
	{
		return $this->defect;
	}
	public function getdefectDetails()
	{
		return $this->defectDetails;
	}
	public function getpartsReplaced()
	{
		return $this->partsReplaced;
	}

	public static function getAllFeederType() {
	    $conn = new connection();
	    $feeder = array();

	    try{

	      $conn->open();
	      $feeders = $conn->query("SELECT * from dbo.feederinfo where active=1");

	      $count = 0;

	      while($row=$conn->fetch_array($feeders)){

	        $feed = new Getdata;

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

	        $feed = new Getdata;

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

	 public static function getAllFeederPlant() {
	    $conn = new connection();
	    $feeder = array();

	    try{

	      $conn->open();
	      $feeders = $conn->query("SELECT * from dbo.feederplant");

	      $count = 0;

	      while($row=$conn->fetch_array($feeders)){

	        $feed = new Getdata;

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

	 public static function getAllFeederLine() {
	    $conn = new connection();
	    $feeder = array();

	    try{

	      $conn->open();
	      $feeders = $conn->query("SELECT * from dbo.feederline");

	      $count = 0;

	      while($row=$conn->fetch_array($feeders)){

	        $feed = new Getdata;

	        $feed->setfeederline($row['feederline']);
	        $feeder[$count] = $feed;
	        $count++;
	      } 

	      $conn->close();
	    }
	    catch(Exception $e){

	    }
	    return $feeder;
	 }

	 public static function getAllFeeder() {
	    $conn = new connection();
	    $feeder = array();

	    try{

	      $conn->open();
	      $feeders = $conn->query("SELECT * from dbo.feeder order by lastupdate desc");

	      $count = 0;

	      while($row=$conn->fetch_array($feeders)){

	        $feed = new Getdata;

	        $feed->setfeederId($row['feederId']);
	        $feed->setfeederType($row['feederType']);
	        $feed->setfeederSize($row['feederSize']);
	        $feed->setplantNoFeeder($row['plantNoFeeder']);
	        $feed->setfeederline($row['line']);
	        $feeder[$count] = $feed;
	        $count++;
	      } 

	      $conn->close();
	    }
	    catch(Exception $e){

	    }
	    return $feeder;
	 }

	 public static function getAllParts() {
	    $conn = new connection();
	    $feeder = array();

	    try{

	      $conn->open();
	      $feeders = $conn->query("SELECT * from dbo.feederpart order by feederDescription asc");

	      $count = 0;

	      while($row=$conn->fetch_array($feeders)){

	        $feed = new Getdata;

	        $feed->setfeederPn($row['feederPn']);
	        $feed->setfeederType($row['feederType']);
	        $feed->setfeederSize($row['feederSize']);
	        $feed->setfeederDescription($row['feederDescription']);
	        $feeder[$count] = $feed;
	        $count++;
	      } 

	      $conn->close();
	    }
	    catch(Exception $e){

	    }
	    return $feeder;
	 }

	 public static function getAllStation() {
	    $conn = new connection();
	    $feeder = array();

	    try{

	      $conn->open();
	      $feeders = $conn->query("SELECT * from dbo.feederstation where sequence !=0");

	      $count = 0;

	      while($row=$conn->fetch_array($feeders)){

	        $feed = new Getdata;

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

	 public static function getHistory($feederId) {
	    $conn = new connection();
	    $feeder = array();

	    try{

	      $conn->open();
	      $feeders = $conn->query("SELECT top(10)* ,a.lastupdate as lastupdate from dbo.feederlog_pass a inner join dbo.feederstation b on a.process = b.sequence where a.feederId = '".$feederId."' order by a.lastupdate desc");

	      $count = 0;

	      while($row=$conn->fetch_array($feeders)){

	        $feed = new Getdata;
	        $feed->setfeederDescription($row['description']);
	        $feed->setstatus($row['status']);
	    	$feed->setendorsedByFeeder($row['endorsedByFeeder']);
	    	$feed->setreceivedByFeeder($row['receivedByFeeder']);
	    	$feed->setendorsedByIssuance($row['endorsedByIssuance']);
	    	$feed->setreceivedByIssuance($row['receivedByIssuance']);
	    	$feed->setlastupdatedBy($row['lastupdatedBy']);
	    	$feed->setlastupdate($row["lastupdate"]->format('Y-m-d h:i:s a'));
	        
	        $feeder[$count] = $feed;
	        $count++;
	      } 

	      $conn->close();
	    }
	    catch(Exception $e){

	    }
	    return $feeder;
	 }

	 public static function getRejHistory($feederId) {
	    $conn = new connection();
	    $feeder = array();

	    try{

	      $conn->open();
	      $feeders = $conn->query("SELECT top(10)* ,a.lastupdate as lastupdate from dbo.feederlog_repair a inner join dbo.feederstation b on a.process = b.sequence where a.feederId = '".$feederId."' order by a.lastupdate desc");

	      $count = 0;

	      while($row=$conn->fetch_array($feeders)){

	        $feed = new Getdata;
	        $feed->setfeederDescription($row['description']);
	    	$feed->setdefect($row['defect']);
	    	$feed->setdefectDetails($row['defectDetails']);
	    	$feed->setpartsReplaced($row['partsReplaced']);
	    	$feed->setlastupdatedBy($row['lastupdatedBy']);
	    	$feed->setlastupdate($row["lastupdate"]->format('Y-m-d h:i:s a'));
	        
	        $feeder[$count] = $feed;
	        $count++;
	      } 

	      $conn->close();
	    }
	    catch(Exception $e){

	    }
	    return $feeder;
	 }

	 public static function getAllFeederParts() {
	    $conn = new connection();
	    $feeder = array();

	    try{

	      $conn->open();
	      $feeders = $conn->query("SELECT * from dbo.feederpart  order by feederDescription asc");

	      $count = 0;

	      while($row=$conn->fetch_array($feeders)){

	        $feed = new Getdata;

	        $feed->setfeederPn($row['feederPn']);
	        $feed->setfeederType($row['feederType']);
	        $feed->setfeederSize($row['feederSize']);
	        $feed->setfeederDescription($row['feederDescription']);
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