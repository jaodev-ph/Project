<?php
include_once("connection.php");
include_once("connection2.php");
class Maintenance
{
	Private $id;
	Private $line;
	Private $machinename;
	Private $idtype;
	Private $seq;
	Private $jobtype;
	Private $list;
	Private $jobSequence;
	Private $active;

	public function setid($id){
	$this->id = $id;
	}

	public function setLine($line){
	$this->productionLineId = $line;
	}

	public function setmachinename($machinename){
	$this->name = $machinename;
	}

	public function setmachinetypeid($idtype){
	$this->machineTypeId = $idtype;
	}

	public function setseq($seq){
	$this->seq = $seq;
	}

	public function setjobtype($jobtype){
	$this->jobType = $jobtype;
	}

	public function setjoblist($list){
	$this->jobLists = $list;
	}

	public function setjobseq($jobSequence){
	$this->jobSequence = $jobSequence;
	}

	public function setactive($active){
	$this->active = $active;
	}



/*Getter*/
	Public function getid(){
	return $this->id;
	}

	public function getmachinename(){
	return $this->name;
	}

	public function getLine(){
	return $this->productionLineId;
	}


	public function getmachinetypeid(){
	return $this->machineTypeId;
	}

	public function getseq(){
	return $this->seq;
	}

	public function getjobtype(){
	return $this->jobType;
	}

	public function getjoblist(){
	return $this->jobLists;
	}

	public function getjobseq(){
	return $this->jobSequence;
	}

	public function getactive(){
	return $this->active;
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


	public static function getpmid(){
	$conn = new Connection();
	$machines1 = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT Distinct jobOrder FROM dbo.imms_MachineChecklist Order By jobOrder");
		$counter2 = 0;
		while($rows = $conn->fetch_array($datareader)){
		$machine1 = new Maintenance();
		$machine1->setid($rows['jobOrder']);
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


public static function getmachinejobid($id){
	$conn = new Connection();
	$machines2 = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT * FROM dbo.imms_MachineChecklist WHERE jobOrder='".$id."' Order By machineId,jobSequence");
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

