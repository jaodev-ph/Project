<?php include_once("connection.php");?>
<?php include_once("connection2.php");?>

<?php
class Line
{
	Private $line;
	Private $name;

	public function setLine($line){
	$this->productionLineId = $line;
	}

	public function setname($name){
	$this->name = $name;
	}

	public function getname(){
	return $this->name;
	}

	public function getLine(){
	return $this->productionLineId;
	}
			
public static function getallLine(){
	$conn = new Connection1();
	$lines = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT productionLineId FROM dbo.Machine GROUP BY productionLineId
  	 ORDER BY SUBSTRING(productionLineId,1,1),CAST(SUBSTRING(productionLineId,2,2) AS INTEGER)");
	$counter = 0;
	while($rows = $conn->fetch_array($datareader)){
	$line = new Line();
	$lineid = $rows['productionLineId'];
	$line->setLine($lineid);
	$lines[$counter]=$line;
	$counter = $counter + 1;
	}
	$conn->close();}
	catch(Exception $e){	
	}
	return $lines;
	}

public static function getmachineperline($lineid){
	$conn = new Connection1();
	$names = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT productionLineId,name,seq FROM dbo.Machine WHERE productionlineid='".$lineid."'");
	$counter1 = 0;
	while($rows = $conn->fetch_array($datareader)){
	$name = new getmachine();
	$machinename = $rows['name'];
	$name->setname($machinename);
	$names[$counter]=$name;
	$counter1 = $counter1 + 1;
	}
	$conn->close();}
	catch(Exception $e){	
	}
	return $names;
	}






}


class Tasktype
{
	Private $tasktype;

	public function setTasktype($tasktype){
		$this->descriptionType = $tasktype;
	}

	public function getTasktype(){
		return $this->descriptionType;
	}
			
public static function getallTasktype(){
	$conn = new Connection();
	$tasktypes = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT * FROM dbo.imms_MachineJobTypes where active = 1 order by seq Asc");
	$counter1 = 0;
	while($rows = $conn->fetch_array($datareader)){
	$tasktype = new Tasktype();
	$type = $rows['description'];
	$tasktype->setTaskType($type);
	$tasktypes[$counter1]=$tasktype;
	$counter1 = $counter1 + 1;
	}
	$conn->close();
	}catch(Exception $e){
	}
	return $tasktypes;
	}
}


class Machine
{
	Private $productionlineid;
	Private $name;
	Private $machinetypeid;
	Private $seq;
	Private $jobtype;
	Private $joblist;
	Private $jobsequence;
	Private $active;
	Private $machineid;

	public function setproductionlineid($productionlineid){
		$this->productionLineId = $productionlineid;
	}

	public function setname($name){
		$this->name = $name;
	}

	public function setmachinetypeid($machinetypeid){
		$this->machineTypeId = $machinetypeid;
	}

	public function setseq($seq){
		$this->seq = $seq;
	}

	public function setmachineid($machineid){
		$this->id = $machineid;
	}	

	public function setjobtype($jobtype){
		$this->jobType = $jobtype;
	}

	public function setjoblist($joblist){
		$this->jobLists = $joblist;
	}

	public function setjobsequence($jobsequence){
		$this->jobSequence = $jobsequence;
	}

	public function setactive($active){
		$this->active = $active;
	}	

	public function getproductionlineid(){
		return $this->productionLineId;
	}

	public function getname(){
		return $this->name;
	}

	public function getmachinetypeid(){
		return $this->machineTypeId;
	}

	public function getseq(){
		return $this->seq;
	}
	
	public function getmachineid(){
		return $this->id;
	}

	public function getjobtype(){
		return $this->jobType;
	}

	public function getjoblist(){
		return $this->jobLists;
	}

	public function getjobsequence(){
		return $this->jobSequence;
	}

	public function getactive(){
		return $this->active;
	}	
			
public static function getmachinechecklist($lineid,$jobtype){
	$conn = new Connection();
	$jobs = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT * FROM [103.219.69.30].[eFactory].dbo.Machine a INNER JOIN [MES].dbo.imms_MachineJobs b ON a.name = b.name WHERE a.productionLineId = '".$lineid."' AND b.jobType = '".$jobtype."' and b.active = 1 	order by a.seq");
	$counter2 = 0;
	while($rows = $conn->fetch_array($datareader)){
	$job = new Machine();
	$job->setproductionlineid($rows['productionLineId']);
	$job->setname($rows['name']);
	$job->setmachinetypeid($rows['machineTypeId']);
	$job->setseq($rows['seq']);
	$job->setmachineid($rows['id']);
	$job->setjoblist($rows['jobLists']);
	$job->setjobsequence($rows['jobSequence']);
	$job->setjobtype($rows['jobType']);

	$jobs[$counter2]=$job;
	$counter2 = $counter2 + 1;
	}
	$conn->close();
	}catch(Exception $e){
	}
	return $jobs;
	}

	public static function SelectMachine($productionlineid,$jobtype){
		$conn = new Connection();
		$machinenames = array();

		try{
			$conn->open();
			$datareader = $conn->query("SELECT  a.name, a.id,a.machineTypeId FROM [103.219.69.30].[eFactory].dbo.Machine a INNER JOIN [MES].[dbo].[imms_MachineJobs] b on a.name = b.name WHERE a.productionLineId = '".$productionlineid."' AND b.jobType = '".$jobtype."' GROUP BY a.id, a.name,a.machineTypeId order by a.id");
			$counter2 = 0;
			while($rows = $conn->fetch_array($datareader))
			{
				$machinename = new machine();
				// $type = $rows['Tasktype'];
				$machinename->setname($rows['name']);
				$machinename->setmachineid($rows['id']);
				$machinename->setmachinetypeid($rows['machineTypeId']);
				$machinenames[$counter2]=$machinename;
				$counter2 = $counter2 + 1;
			}
			$conn->close();
		}catch(Exception $e){			
			}
		return $machinenames;
	}

		public function SelectMachinedetails($productionlineid,$name){
		$conn = new Connection1();
		$machinenames = array();

		try{
			$conn->open();
			$datareader = $conn->query("SELECT  * FROM dbo.Machine WHERE productionLineId = '".$productionlineid."' AND name ='".$name."'");
			$counter2 = 0;
			while($rows = $conn->fetch_array($datareader))
			{
				$machinename = new machine();
				// $type = $rows['Tasktype'];
				$machinename->setname($rows['name']);
				$machinename->setmachineid($rows['id']);
				$machinename->setmachinetypeid($rows['machineTypeId']);
				$machinenames[$counter2]=$machinename;
				$counter2 = $counter2 + 1;
			}
			$conn->close();
		}catch(Exception $e){			
			}
		return $machinenames;
	}



}?>

