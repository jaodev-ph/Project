<?php
include_once("connection.php");
session_start();
class Add {


	private $feederId;
	private $feederType;
	private $feederSize;
	private $plantNoFeeder;
	private $status;
	private $process;
	private $line;
	private $lastupdatedBy;
	private $lastupdate;
	private $calibrationDate;
	private $endorsedByfeeder;
	private $receivedByfeeder;
	private $endorsedByIssuance;
	private $receivedByIssuance;




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
	public function setstatus($status)
	{
		$this->status = $status;
	}
	public function setprocess($process)
	{
		$this->process = $process;
	}
	public function setline($line)
	{
		$this->line = $line;
	}
	public function setlastupdatedBy($lastupdatedBy)
	{
		$this->lastupdatedBy = $lastupdatedBy;
	}
	public function setlastupdate($lastupdate)
	{
		$this->lastupdate = $lastupdate;
	}
	public function setcalibrationDate($calibrationDate)
	{
		$this->calibrationDate = $calibrationDate;
	}
	public function setendorsedByfeeder($endorsedByfeeder)
	{
		$this->endorsedByfeeder = $endorsedByfeeder;
	}
	public function setreceivedByfeeder($receivedByfeeder)
	{
		$this->receivedByfeeder = $receivedByfeeder;
	}
	public function setendorsedByIssuance($endorsedByIssuance)
	{
		$this->endorsedByIssuance = $endorsedByIssuance;
	}
	public function setreceivedByIssuance($receivedByIssuance)
	{
		$this->receivedByIssuance = $receivedByIssuance;
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
	public function getstatus()
	{
		return $this->status;
	}
	public function getprocess()
	{
		return $this->process;
	}
	public function getline()
	{
		return $this->line;
	}
	public function getlastupdatedBy()
	{
		return $this->lastupdatedBy;
	}
	public function getlastupdate()
	{
		return $this->lastupdate;
	}
	public function getcalibrationDate()
	{
		return $this->calibrationDate;
	}
	public function getendorsedByfeeder()
	{
		return $this->endorsedByfeeder;
	}
	public function getreceivedByfeeder()
	{
		return $this->receivedByfeeder;
	}
	public function getendorsedByIssuance()
	{
		return $this->endorsedByIssuance;
	}
	public function getreceivedByIssuance()
	{
		return $this->receivedByIssuance;
	}

	public function AddId($mode)
	{
		$conn = new connection();
		try{
			$conn->open();
			$feed = $conn->query("SELECT * from dbo.feeder where feederId='".$this->getfeederId()."'");
			if($conn->has_rows($feed)>0)
			{
				echo "Already Exist";
			}
			else{
				$conn->query("INSERT INTO dbo.feeder VALUES('".$this->getfeederId()."','".$this->getfeederType()."','".$this->getfeederSize()."','".$this->getplantNoFeeder()."','REJECT',0,'".$this->getline()."','".$this->getlastupdatedBy()."',getdate(),'','','','','')");

					echo "Success";
			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

}
?>