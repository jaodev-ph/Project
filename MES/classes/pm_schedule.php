<?php
include_once("connection3.php");
include_once("connection2.php");
class PMSchedule
{
	Private $pmid;
	Private $lineid;
	Private $tasktype;
	Private $typeseq;
	Private $datefrom;
	Private $timefrom;
	Private $dateto;
	Private $timeto;
	Private $createdby;
	Private $stats;
	Private $datecreated;

// Setter

	public function setpmid($pmid){
	$this->PM_ID = $pmid;
	}
	public function setlineid($lineid){
	$this->LineId = $lineid;
	}
	public function settasktype($tasktype){
	$this->TaskType = $tasktype;
	}
	public function settypeseq($typeseq){
	$this->TypeSeq = $typeseq;
	}
	public function setdatefrom($datefrom){
	$this->date_from = $datefrom;
	}
	public function settimefrom($timefrom){
	$this->time_from = $timefrom;
	}
	public function setdateto($dateto){
	$this->date_to = $dateto;
	}
	public function settimeto($timeto){
	$this->time_to = $timeto;
	}
	public function setcreatedby($createdby){
	$this->created_by = $createdby;
	}
	public function setstats($stats){
	$this->Stats = $stats;
	}
	public function setdatecreated($datecreated){
	$this->datecreated = $datecreated;
	}



/*Getter*/
	Public function getpmid(){
	return $this->PM_ID;
	}
	Public function getlineid(){
	return $this->LineId;
	}
	Public function gettasktype(){
	return $this->TaskType;
	}
	Public function gettypeseq(){
	return $this->TypeSeq;
	}
	Public function getdatefrom(){
	return $this->date_from;
	}
	Public function gettimefrom(){
	return $this->time_from;
	}
	Public function getdateto(){
	return $this->date_to;
	}
	Public function gettimeto(){
	return $this->time_to;
	}
	Public function getcreatedby(){
	return $this->created_by;
	}
	Public function getstats(){
	return $this->Stats;
	}
	Public function getdatecreated(){
	return $this->datecreated;
	}




/*public static function getmachineline(){
	$conn = new Connection();
	$machines3 = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT 
id,productionLineId,name,machinetypeid,seq
 FROM [103.219.69.30].[eFactory].[dbo].[Machine] 
 GROUP BY id,productionLineId,name,machinetypeid,seq
 ORDER BY SUBSTRING(productionLineId,1,1),CAST(SUBSTRING(productionLineId,2,2) AS INTEGER)");

	$counter2 = 0;
	while($rows = $conn->fetch_array($datareader)){
	$machine3 = new Maintenance();
	$machine3->setid($rows['id']);
	$machine3->setLine($rows['productionLineId']);
	$machine3->setname($rows['name']);
	$machine3->setmachinetypeid($rows['machinetypeid']);
	$machine3->setseq($rows['seq']);
	$machines3[$counter2]=$machine3;
	$counter2 = $counter2 + 1;
	}
	$conn->close();
	}catch(Exception $e){
	}
	return $machines3;
	}*/


public static function getmachinelist(){
	$conn = new Connection();
	$machines1 = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT distinct name,machineTypeId FROM dbo.imms_MachineJobs Order By name");
		$counter2 = 0;
		while($rows = $conn->fetch_array($datareader)){
		$machine1 = new Maintenance();
		$machine1->setmachinename($rows['name']);
		$machine1->setmachinetypeid($rows['machineTypeId']);
		$machines1[$counter2]=$machine1;
		$counter2 = $counter2 + 1;
	}
	$conn->close();
		}catch(Exception $e){
			}
	return $machines1;
	}


public static function getjoblists(){
	$conn = new Connection();
	$machines2 = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT * FROM dbo.imms_MachineJobs Order By name,jobSequence");
		$counter2 = 0;
		while($rows = $conn->fetch_array($datareader)){
		$machine2 = new Maintenance();
		$machine2->setmachinename($rows['name']);
		$machine2->setmachinetypeid($rows['machineTypeId']);
		$machine2->setjobtype($rows['jobType']);
		$machine2->setjoblist($rows['jobLists']);
		$machine2->setseq($rows['jobLists']);
		$machine2->setjobseq($rows['jobSequence']);
		$machines2[$counter2]=$machine2;
		$counter2 = $counter2 + 1;
		}
	$conn->close();
		}catch(Exception $e){
			}
	return $machines2;
	}

public static function getmachinejob($name,$jobtype){
	$conn = new Connection();
	$machines2 = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT * FROM dbo.imms_MachineJobs WHERE name='".$name."' AND jobType='".$jobtype."' Order By name,jobSequence");
	$counter2 = 0;
	while($rows = $conn->fetch_array($datareader)){
		$machine2 = new Maintenance();
		$machine2->setmachinename($rows['name']);
		$machine2->setmachinetypeid($rows['machineTypeId']);
		$machine2->setjobtype($rows['jobType']);
		$machine2->setjoblist($rows['jobLists']);
		$machine2->setjobseq($rows['jobSequence']);

	$machines2[$counter2]=$machine2;
	$counter2 = $counter2 + 1;
		}
	$conn->close();
			}catch(Exception $e){
		}
	return $machines2;
	}


		public function add(){
		$conn = new Connection();

		try{
			$conn->open();

			$conn->query("INSERT INTO dbo.imms_MachineJobs VALUES('".$this->getmachinename()."','".$this->getmachinetypeid()."','".$this->getjobtype()."','".$this->getjoblist()."', '".$this->getjobseq()."', '".$this->getactive()."')");

			$conn->close();
		}catch(Exception $e){

		}	
	}

	public function getmachinetype(){
	
	$conn = new Connection1();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT machineTypeId FROM dbo.Machine WHERE name='".$this->getmachinename()."'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setmachinetypeid($reader['machineTypeId']);
			
				}
				$conn->close();
			}catch(Exception $e){

			}

	}


	public static function getsequence($name,$jobtype){
	$conn = new Connection();
	$machines1 = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT jobSequence FROM dbo.imms_MachineJobs WHERE name = '".$name."' AND jobtype = '".$jobtype."' ORDER By jobSequence");
		$counter2 = 0;
		while($rows = $conn->fetch_array($datareader)){
		$machine1 = new Maintenance();
		$machine1->setjobseq($rows['jobSequence']);
	
		$machines1[$counter2]=$machine1;
		$counter2 = $counter2 + 1;
	}
	$conn->close();
		}catch(Exception $e){
			}
	return $machines1;
	}


		public function updateJobs(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.imms_MachineJobs SET jobLists = '".$this->getjoblist()."' WHERE jobSequence ='".$this->getjobseq()."' and machineTypeId = '".$this->getmachinetypeid()."' and jobType = '".$this->getjobtype()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}

public static function checkExist($name,$jobtype,$sequence){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.imms_MachineJobs WHERE name = '".$name."' AND jobtype = '".$jobtype."' AND jobSequence = '".$sequence."'");

			if($conn->has_rows($dataset)){
				
				$result = 'true';
							
			}else{
				$result = 'false';
			}	
			
			$conn->close();
		}catch(Exception $e){

		}
		return $result;
	}

	
}

	?>

