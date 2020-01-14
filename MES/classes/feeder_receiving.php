<?php
include_once("connection.php");

class Receiving {

	private $transactionId;
	private $transactionNo;
	private $feederId;
	private $feederType;
	private $feederSize;
	private $plantNoEndorser;
	private $plantNoFeeder;
	private $endorsedByfeeder;
	private $receivedByfeeder;
	private $lastupdatedBy;
	private $lastupdate;
	private $description;
	private $duedate;
	private $checker;
	private $process;
	private $status;
	private $endorsedByIssuance;
	private $receivedByIssuance;
	private $partsReplaced;
	private $defect;
	private $defectDetails;
	private $calibrationDate;
	private $feederPn;
	private $feederDescription;




function __construct(){
}
//setter
	public function settransactionId($transactionId)
	{
		$this->transactionId = $transactionId;
	}

	public function settransactionNo($transactionNo)
	{
		$this->transactionNo = $transactionNo;
	}

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

	public function setplantNoEndorser($plantNoEndorser)
	{
		$this->plantNoEndorser = $plantNoEndorser;
	}
	public function setplantNoFeeder($plantNoFeeder)
	{
		$this->plantNoFeeder = $plantNoFeeder;
	}
	public function setendorsedByfeeder($endorsedByfeeder)
	{
		$this->endorsedByfeeder = $endorsedByfeeder;
	}
	public function setreceivedByfeeder($receivedByfeeder)
	{
		$this->receivedByfeeder = $receivedByfeeder;
	}
	public function setlastupdatedBy($lastupdatedBy)
	{
		$this->lastupdatedBy = $lastupdatedBy;
	}

	public function setlastupdate($lastupdate)
	{
		$this->lastupdate = $lastupdate;
	}
	public function setdescription($description)
	{
		$this->description = $description;
	}

	public function setsequence($sequence)
	{
		$this->sequence = $sequence;
	}

	public function setprocess($process)
	{
		$this->process = $process;
	}

	public function setduedate($duedate)
	{
		$this->duedate = $duedate;
	}

	public function setendorsedByIssuance($endorsedByIssuance)
	{
		$this->endorsedByIssuance = $endorsedByIssuance;
	}

	public function setreceivedByIssuance($receivedByIssuance)
	{
		$this->receivedByIssuance = $receivedByIssuance;
	}
	public function setchecker($checker)
	{
		$this->checker = $checker;
	}
	public function setstatus($status)
	{
		$this->status = $status;
	}
	public function setpartsReplaced($partsReplaced)
	{
		$this->partsReplaced = $partsReplaced;
	}
	public function setdefect($defect)
	{
		$this->defect = $defect;
	}
	public function setdefectDetails($defectDetails)
	{
		$this->defectDetails = $defectDetails;
	}
	public function setfeederPn($feederPn)
	{
		$this->feederPn = $feederPn;
	}
	public function setfeederDescription($feederDescription)
	{
		$this->feederDescription = $feederDescription;
	}

//getter

	public function gettransactionId()
	{
		return $this->transactionId;
	}

	public function gettransactionNo()
	{
		return $this->transactionNo;
	}

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
	public function getplantNoEndorser()
	{
		return $this->plantNoEndorser;
	}
	public function getplantNoFeeder()
	{
		return $this->plantNoFeeder;
	}
	public function getendorsedByfeeder()
	{
		return $this->endorsedByfeeder;
	}
	public function getreceivedByfeeder()
	{
		return $this->receivedByfeeder;
	}
	public function getlastupdatedBy()
	{
		return $this->lastupdatedBy;
	}

	public function getlastupdate()
	{
		return $this->lastupdate;
	}

	public function getdescription()
	{
		return $this->description;
	}

	public function getsequence()
	{
		return $this->sequence;
	}

	public function getprocess()
	{
		return $this->process;
	}

	public function getduedate()
	{
		return $this->duedate;
	}

	public function getendorsedByIssuance()
	{
		return $this->endorsedByIssuance;
	}

	public function getreceivedByIssuance()
	{
		return $this->receivedByIssuance;
	}
	public function getchecker()
	{
		return $this->checker;
	}
	public function getstatus()
	{
		return $this->status;
	}
	public function getpartsReplaced()
	{
		return $this->partsReplaced;
	}
	public function getdefect()
	{
		return $this->defect;
	}
	public function getdefectDetails()
	{
		return $this->defectDetails;
	}
	public function getfeederPn()
	{
		return $this->feederPn;
	}
	public function getfeederDescription()
	{
		return $this->feederDescription;
	}

	public function FeederInfo()
	{
		$conn = new connection();
		

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feederId where feederId='".$this->getfeederId()."'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);

				$this->setfeederId($reader["feederId"]);
				$this->setfeederType($reader["feederType"]);
				$this->setfeederSize($reader["feederSize"]);
				$this->setplantNoFeeder($reader["plantNoFeeder"]);
				$this->setlastupdatedBy($reader["lastupdatedBy"]);
				// $this->setlastupdate($reader["lastupdate"]);
				


			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function ReceivingInfo()
	{
		$conn = new connection();
		$result='';

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feeder where feederId='".$this->getfeederId()."'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);
				$result ='ok';
				$this->setfeederId($reader["feederId"]);
				$this->setfeederType($reader["feederType"]);
				$this->setfeederSize($reader["feederSize"]);
				$this->setprocess($reader["process"]);
				$this->setstatus($reader["status"]);
				$this->setlastupdatedBy($reader["lastupdatedBy"]);
				// $this->setreceivedByfeeder($reader["receivedByfeeder"]);
				// $this->setlastupdate($reader["lastupdate"]);

			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function IssuanceInfo() 
	{
		$conn = new connection();
		

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feeder where feederId='".$this->getfeederId()."'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);

				$this->setfeederId($reader["feederId"]);
				$this->setfeederType($reader["feederType"]);
				$this->setfeederSize($reader["feederSize"]);
				$this->setplantNoFeeder($reader["plantNoFeeder"]);
				$this->setprocess($reader["process"]);

				// $this->setreceivedByfeeder($reader["receivedByfeeder"]);
				// $this->setlastupdate($reader["lastupdate"]);
				
				
				


			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function Issue()
	{
		$conn = new connection();
		try{


			$conn->open();
			$conn->query("UPDATE dbo.feeder SET endorsedByIssuance='".$this->getendorsedByIssuance()."',receivedByIssuance='".$this->getreceivedByIssuance()."' WHERE feederId='".$this->getfeederId()."'");
			$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."',4,'GOOD','".$this->getendorsedByIssuance()."',getdate(),'','','','".$this->getendorsedByIssuance()."','".$this->getreceivedByIssuance()."')");
				
			
			$conn->close();
			
		}catch(Exception $e){

		}
		
	}

	public function PmInfo()
	{
		$conn = new connection();
		

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feeder where feederId ='".$this->getfeederId()."'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);

				$this->setfeederId($reader["feederId"]);
				$this->setfeederType($reader["feederType"]);
				$this->setfeederSize($reader["feederSize"]);
				$this->setplantNoFeeder($reader["plantNoFeeder"]);
				$this->setprocess($reader["process"]);
				


			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function PmInfo2($process) 
	{
		$conn = new connection();
		

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feederstation where sequence ='".$process."'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);

				$this->setdescription($reader["description"]);
				
			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function CalibrationInfo()
	{
		$conn = new connection();
		

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feeder where feederId ='".$this->getfeederId()."'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);

				$this->setfeederId($reader["feederId"]);
				$this->setfeederType($reader["feederType"]);
				$this->setfeederSize($reader["feederSize"]);
				$this->setplantNoFeeder($reader["plantNoFeeder"]);
				$this->setduedate($reader["duedate"]->format('Y-m-d'));
				$this->setprocess($reader["process"]);

			}
			
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function CalibrationInfo2($process)
	{
		$conn = new connection();
		

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feederstation where sequence ='".$process."'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);

				$this->setdescription($reader["description"]);
				
			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}
	

	public function EndorseInfo()
	{
		$conn = new connection();
		$checker ='';

		try{
			$conn->open();
			$feed = $conn->query("SELECT * from dbo.feeder where feederId='".$this->getfeederId()."'");


			
			if($conn->has_rows($feed)>0)
			{
				
				
				echo "Feeder already exist";
				
			}
			else{
				$conn->query("INSERT INTO dbo.feeder VALUES('')");


					echo "Success";

				


			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}
	public function RepairInfo()
	{
		$conn = new connection();
		

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feeder where feederId='".$this->getfeederId()."' and status='REJECT'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);

				$this->setfeederId($reader["feederId"]);
				$this->setfeederType($reader["feederType"]);
				$this->setfeederSize($reader["feederSize"]);
			}
			else
			{
				echo "Feeder ID is not for REPAIR";
			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}
	public function nextstage($process) 
	{
		$conn = new connection();
		

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feederstation where sequence  > '".$process."'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);

				$this->setdescription($reader["description"]);
				
			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}
	public function Good($feederType)
	{
		$conn = new connection();
		try{


			$conn->open();
			// if ($this->description()="Preventive Maintenance")
			// echo $this->description();
	/*		$conn->query("UPDATE dbo.feeder SET status = 'GOOD',process='".$this->getprocess()."' ,lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."' WHERE feederId='".$this->getfeederId()."'" );
			$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."'-1,'GOOD','".$this->getlastupdatedBy()."',getdate(),'','','','','')");*/

			
			if ($this->getprocess() == 1)
			{
				$conn->query("UPDATE dbo.feeder SET status = 'PM',process='".$this->getprocess()."' ,lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."',endorsedByFeeder = '".$this->getendorsedByfeeder()."', receivedByfeeder = '".$this->getlastupdatedBy()."' WHERE feederId='".$this->getfeederId()."'" );
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','PM','".$this->getlastupdatedBy()."',getdate(),'".$this->getendorsedByfeeder()."','".$this->getlastupdatedBy()."','','','')");
				
			}
			else if ($this->getprocess() == 4)
			{
				$conn->query("UPDATE dbo.feeder SET status = 'GOOD',process='".$this->getprocess()."' ,lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."',endorsedByIssuance = '".$this->getlastupdatedBy()."' ,receivedByIssuance = '".$this->getreceivedByIssuance()."' WHERE feederId='".$this->getfeederId()."'" );
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','GOOD','".$this->getlastupdatedBy()."',getdate(),'','','','".$this->getlastupdatedBy()."','".$this->getreceivedByIssuance()."')");
				
			}
			else if ($this->getprocess() == 3)
			{
				$calibrationDate = 0;
				if($feederType=="Panasonic")
				{
					$calibrationDate = 30;

				}
				else
				{
					$calibrationDate = 120;
				}
				
				
				$conn->query("UPDATE dbo.feeder SET calibrationDate=getdate()+$calibrationDate,status = 'PM',process='".$this->getprocess()."',lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."' WHERE feederId='".$this->getfeederId()."'");
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','PM','".$this->getlastupdatedBy()."',getdate(),'','','','','')");
			}
			else 
			{
				$conn->query("UPDATE dbo.feeder SET status = 'PM',process='".$this->getprocess()."' ,lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."' WHERE feederId='".$this->getfeederId()."'" );
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','PM','".$this->getlastupdatedBy()."',getdate(),'','','','','')");
			}
			


			
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function Reject()
	{
		$conn = new connection();
		try{


			$conn->open();

			if ($this->getprocess() == 1)
			{
				$conn->query("UPDATE dbo.feeder SET process='".$this->getprocess()."',status = 'REJECT' ,lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."',endorsedByFeeder = '".$this->getendorsedByfeeder()."', receivedByfeeder = '".$this->getlastupdatedBy()."' WHERE feederId='".$this->getfeederId()."'" );
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','REJECT','".$this->getlastupdatedBy()."',getdate(),'".$this->getendorsedByfeeder()."','".$this->getlastupdatedBy()."','','','')");
				
			}
			else if ($this->getprocess() == 4)
			{
				$conn->query("UPDATE dbo.feeder SET process='".$this->getprocess()."',status = 'REJECT',lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."',endorsedByIssuance = '".$this->getlastupdatedBy()."' ,receivedByIssuance = '".$this->getreceivedByIssuance()."' WHERE feederId='".$this->getfeederId()."'" );
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','REJECT','".$this->getlastupdatedBy()."',getdate(),'','','','".$this->getlastupdatedBy()."','".$this->getreceivedByIssuance()."')");
				
			}
			else
			{
				$conn->query("UPDATE dbo.feeder SET process='".$this->getprocess()."',status = 'REJECT',lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."' WHERE feederId='".$this->getfeederId()."'" );
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','REJECT','".$this->getlastupdatedBy()."',getdate(),'','','','','')");
			}
			


			
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function logrepair()
	{
		$conn = new connection();
		try{


			$conn->open();

				$conn->query("INSERT INTO dbo.feederlog_repair VALUES('','".$this->getfeederId()."','".$this->getprocess()."','','".$this->getdefect()."','".$this->getdefectDetails()."','".$this->getpartsReplaced()."','".$this->getlastupdatedBy()."',getdate())");
			


			
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function currentstage($process) 
	{
		$conn = new connection();
		

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.feederstation where process  = '".$process."'");
			if($conn->has_rows($dataset)>0){
				$reader = $conn->fetch_array($dataset);

				$this->setprocess($reader["process"]);
				
			}
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}

	public function Scrap()
	{
		$conn = new connection();
		try{


			$conn->open();

			if ($this->getprocess() == 1)
			{
				$conn->query("UPDATE dbo.feeder SET process='".$this->getprocess()."',status = 'SCRAP' ,lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."',endorsedByFeeder = '".$this->getendorsedByfeeder()."', receivedByfeeder = '".$this->getlastupdatedBy()."' WHERE feederId='".$this->getfeederId()."'" );
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','REJECT','".$this->getlastupdatedBy()."',getdate(),'".$this->getendorsedByfeeder()."','".$this->getlastupdatedBy()."','','','')");
				
			}
			else if ($this->getprocess() == 4)
			{
				$conn->query("UPDATE dbo.feeder SET process='".$this->getprocess()."',status = 'SCRAP',lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."',endorsedByIssuance = '".$this->getlastupdatedBy()."' ,receivedByIssuance = '".$this->getreceivedByIssuance()."' WHERE feederId='".$this->getfeederId()."'" );
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','REJECT','".$this->getlastupdatedBy()."',getdate(),'','','','".$this->getlastupdatedBy()."','".$this->getreceivedByIssuance()."')");
				
			}
			else
			{
				$conn->query("UPDATE dbo.feeder SET process='".$this->getprocess()."',status = 'SCRAP',lastupdate = getdate(),lastupdatedBy ='".$this->getlastupdatedBy()."' WHERE feederId='".$this->getfeederId()."'" );
				$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."','".$this->getprocess()."','SCRAP','".$this->getlastupdatedBy()."',getdate(),'','','','','')");
			}
			


			
			
			$conn->close();
			
		}catch(Exception $e){

		}
	}


	// public function LogReceiving()
	// {
	// 	$conn = new connection();
	

	// 	try{
	// 		$conn->open();
	// 		// $feed = $conn->query("SELECT * from dbo.feeder where feederId='".$this->getfeederId()."'");
	// 		$conn->query("INSERT INTO dbo.feederlog_pass VALUES('','".$this->getfeederId()."',1,'GOOD','".$this->getreceivedByfeeder()."',getdate(),'".$this->getendorsedByfeeder()."','".$this->getreceivedByfeeder()."','','','')");

			
			
	// 		$conn->close();
			
	// 	}catch(Exception $e){

	// 	}
	// }
	

}
?>