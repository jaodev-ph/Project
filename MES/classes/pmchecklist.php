<?php
include_once("connection.php");
class Checklist
{

	Private $joborder;
	Private $productionlineid;
	Private $jobtype;
	Private $name;
	Private $machineid;
	Private $machinetypeid;
	Private $machinesequence;
	Private $joblists;
	Private $jobsequence;
	Private $status;
	Private $remarks;
	Private $flag;
	Private $starttime;
	Private $endtime;
	Private $performedby;

	// Setter

	public function setjobOrder($joborder){
	$this->jobOrder = $joborder;
	}

	public function setproductionLineId($productionlineid){
	$this->productionLineId = $productionlineid;
	}

	public function setjobType($jobtype){
	$this->jobType = $jobtype;
	}

	public function setname($name){
	$this->name = $name;
	}

	public function setmachineId($machineid){
	$this->machineId = $machineid;
	}

	public function setmachineTypeId($machinetypeid){
	$this->machineTypeId = $machinetypeid;
	}

	public function setmachineSequence($machinesequence){
	$this->machineSequence = $machinesequence;
	}

	public function setjobLists($joblists){
	$this->jobLists = $joblists;
	}

	public function setjobSequence($jobsequence){
	$this->jobSequence = $jobsequence;
	}

	public function setstatus($status){
	$this->status = $status;
	}

	public function setremarks($remarks){
	$this->remarks = $remarks;
	}

	public function setflag($flag){
	$this->flag = $flag;
	}

	public function setstartTime($starttime){
	$this->startTime = $starttime;
	}

	public function setendTime($endtime){
	$this->endTime = $endtime;
	}

	public function setperformedBy($performedby){
	$this->performedBy = $performedby;
	}


/*Getter*/
	Public function getjobOrder(){
	return $this->jobOrder;
	}

	Public function getproductionLineId(){
	return $this->productionLineId;
	}

	public function getjobType(){
	return $this->jobType;
	}

	public function getname(){
	return $this->name;
	}

	public function getmachineId(){
	return $this->machineId;
	}

	public function getmachineTypeId(){
	return $this->machineTypeId;
	}

	public function getmachineSequence(){
	return $this->machineSequence;
	}

	public function getjobLists(){
	return $this->jobLists;
	}

	public function getjobSequence(){
	return $this->jobSequence;
	}

	public function getstatus(){
	return $this->status;
	}

	public function getremarks(){
	return $this->remarks;
	}

	public function getflag(){
	return $this->flag;
	}

	public function getstartTime(){
	return $this->startTime; 
	}

	public function getendTime(){
	return $this->endTime;
	}

	public function getperformedBy(){
	return $this->performedBy;
	}



public static function getChecklist(){
	$conn = new Connection();
	$checklists = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT * FROM dbo.imms_MachineChecklist Order By jobOrderDesc");
		$counter2 = 0;
		while($rows = $conn->fetch_array($datareader)){
		$checklist = new Checklist();
		$checklist->setjobOrder($rows['jobOrder']);
		$checklist->setproductionLineId($rows['productionLineId']);
		$checklist->setjobType($rows['jobType']);
		$checklist->setname($rows['name']);
		$checklist->setmachineId($rows['machineId']);
		$checklist->setmachineTypeId($rows['machineTypeId']);
		$checklist->setmachineSequence($rows['machineSequence']);
		$checklist->setjobLists($rows['jobLists']);
		$checklist->setjobSequence($rows['jobSequence']);
		$checklist->setstatus($rows['status']);
		$checklist->setremarks($rows['remarks']);
		$checklist->setflag($rows['flag']);
		$checklist->setstartTime($rows['startTime']);
		$checklist->setendTime($rows['endTime']);
		$checklist->setperformedBy($rows['performedBy']);
		$checklists[$counter2]=$checklist;
		$counter2 = $counter2 + 1;
		}
	$conn->close();
		}catch(Exception $e){
			}
	return $checklists;
	}


	public static function getChecksheet($joborder,$machineid,$jobtype){
	$conn = new Connection();
	$machines2 = array();
	try{
	$conn->open();
	$datareader = $conn->query("SELECT * FROM dbo.imms_MachineChecklist WHERE jobOrder='".$joborder."' AND machineId='".$machineid."' AND jobType='".$jobtype."' Order By jobSequence");
	$counter2 = 0;
	while($rows = $conn->fetch_array($datareader)){
		$machine2 = new Checklist();
		$machine2->setname($rows['name']);
		$machine2->setmachineTypeId($rows['machineTypeId']);
		$machine2->setjobType($rows['jobType']);
		$machine2->setjobLists($rows['jobLists']);
		$machine2->setjobSequence($rows['jobSequence']);
		$machine2->setStatus($rows['status']);
		$machine2->setflag($rows['flag']);
		$machine2->setremarks($rows['remarks']);

	$machines2[$counter2]=$machine2;
	$counter2++;
		}
	$conn->close();
			}catch(Exception $e){
		}
	return $machines2;
	}


	public function updatechecksheet(){
		$conn = new Connection();		

		try{
			$conn->open();
			$conn->query("UPDATE dbo.imms_MachineChecklist SET status = '".$this->getstatus()."', remarks = '".$this->getremarks()."', flag = '".$this->getflag()."', endTime = getdate(), performedBy = '".$this->getperformedBy()."' WHERE jobOrder = '".$this->getjobOrder()."' AND machineId = '".$this->getmachineId()."' AND jobSequence ='".$this->getjobSequence()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}


}?>