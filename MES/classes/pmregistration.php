<?php include_once("connection.php");?>

<?php

class Registration{

	Private $transno;
	Private $joborder;
	Private $productionlineid;
	Private $jobtype;
	Private $datestart;
	Private $dateend;
	Private $timestart;
	Private $timeend;
	Private $plannedby;
	Private $datecreated;
	Private $status;
	Private $name;
	Private $machineid;
	Private $machinetypeid;
	Private $machinesequence;
	Private $joblists;
	Private $jobsequence;



	// 	function __construct($id = ''){
		
	// 	if(strlen($id)!=0){


	// 			$conn = new Connection();

	// 			try{
	// 				$conn->open();
	// 				$dataset=$conn->query("SELECT * FROM [PMCalendar].[dbo].[testSchedule] WHERE PM_ID = '".$id."'");

	// 				if($conn->has_rows($dataset)){
	// 					$reader = $conn->fetch_array($dataset);

	// 					$this->setId($reader['PM_ID']);
	// 					$this->setLine($reader['LineId']);
	// 					$this->setTaskType($reader['TaskType']);
	// 					$this->setTypeSeq($reader['TypeSeq']);
	// 					$this->setDateFrom($reader['date_from']);
	// 					$this->setTimeFrom($reader['time_from']);
	// 					$this->setDateTo($reader['date_to']);
	// 					$this->setTimeTo($reader['time_to']);
	// 					$this->setCreatedBy($reader['created_by']);
	// 					$this->setStatus($reader['Status']);
	// 					$this->setDatecreated($reader['datecreated']);

	// 				}
	// 				$conn->close();
	// 			}catch(Exception $e){

	// 			}
	// 	}

	// }

//setter
		public function settransNo($transno){
		$this->transNo = $transno;
	}

		public function setjobOrder($joborder){
		$this->jobOrder = $joborder;
	}

		public function setproductionlineid($productionlineid){
		$this->productionLineId = $productionlineid;
	}

		public function setjobType($jobtype){
		$this->jobType = $jobtype;
	}

		public function setdateStart($datestart){
		$this->dateStart = $datestart;
	}

		public function setdateEnd($dateend){
		$this->dateEnd = $dateend;
	}

		public function settimeStart($timestart){
		$this->timeStart = $timestart;
	}

		public function settimeEnd($timeend){
		$this->timeEnd = $timeend;
	}

		public function setplannedBy($plannedby){
		$this->plannedBy = $plannedby;
	}

		public function setStatus($status){
		$this->status = $status;
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

		public function setmachinesequence($machinesequence){
		$this->machineSequence = $machinesequence;
	}

		public function setjoblists($joblists){
		$this->jobLists = $joblists;
	}

		public function setjobSequence($jobsequence){
		$this->jobSequence = $jobsequence;
	}





//getter

	public function gettransNo(){
		return $this->transNo;
	}


	public function getjobOrder(){
		return $this->jobOrder;
	}

	public function getproductionLineId(){
		return $this->productionLineId;
	}

	public function getjobType(){
		return $this->jobType;
	}

	public function getdateStart(){
		return $this->dateStart;
	}

	public function getdateEnd(){
		return $this->dateEnd;
	}

	public function gettimeStart(){
		return $this->timeStart;
	}

	public function gettimeEnd(){
		return $this->timeEnd;
	}

	public function getplannedBy(){
		return $this->plannedBy;
	}

	public function getdateCreated(){
		return $this->dateCreated;
	}

	public function getstatus(){
		return $this->status;
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

		public function getmachinesequence(){
		return $this->machineSequence; 
	}

		public function getjoblists(){
		return $this->jobLists;
	}

		public function getjobSequence(){
		return $this->jobSequence;
	}

public function addschedule()
	{
		$conn = new Connection();
	
		try{
			$conn->open();
			$dataset=$conn->query("INSERT INTO dbo.imms_MachineJobSchedule (jobOrder,productionLineId,jobType,dateStart,dateEnd,timeStart,timeEnd,plannedBy,dateCreated) VALUES ('".$this->getjobOrder()."', '".$this->getproductionLineId()."', '".$this->getjobType()."', '".$this->getdateStart()."', '".$this->getdateEnd()."', '".$this->gettimeStart()."', '".$this->gettimeEnd()."', '".$this->getplannedBy()."', GETDATE())");

			$conn->close();
		}
		catch(Exception $e){

		}
	}

public function schedulelogs() 
	{
		$conn = new Connection();
	
		try{
			$conn->open();
			$dataset=$conn->query("INSERT INTO dbo.imms_MachineJobScheduleLogs (jobOrder,productionLineId,jobType,dateStart,dateEnd,timeStart,timeEnd,plannedBy,dateCreated,status) VALUES ('".$this->getjobOrder()."', '".$this->getproductionLineId()."', '".$this->getjobType()."', '".$this->getdateStart()."', '".$this->getdateEnd()."', '".$this->gettimeStart()."', '".$this->gettimeEnd()."', '".$this->getplannedBy()."', GETDATE(),'".$this->getstatus()."')");

			$conn->close();
		}
		catch(Exception $e){

		}
	}	


	public function updateSchedule()
	{
		$conn = new Connection();
	
		try{
			$conn->open();
			$dataset1=$conn->query("UPDATE dbo.imms_MachineJobSchedule
				SET dateStart = '".$this->getdateStart()."', 
				dateEnd = '".$this->getdateEnd()."', 
				timeStart = '".$this->gettimeStart()."',
				timeEnd = '".$this->gettimeEnd()."',
				plannedBy = '".$this->getplannedBy()."'
				 dateCreated = GETDATE()
				 WHERE jobOrder = '".$this->getjobOrder()."'");
			
			$conn->close();
		}
		catch(Exception $e){

		}
	}

public function machinechecklist() 
	{
		$conn = new Connection();
	
		try{
			$conn->open();
			$dataset=$conn->query("INSERT dbo.imms_MachineChecklist VALUES ('".$this->getjobOrder()."', '".$this->getproductionLineId()."', '".$this->getjobType()."', '".$this->getname()."', '".$this->getmachineId()."', '".$this->getmachineTypeId()."', '".$this->getmachinesequence()."', '".$this->getjoblists()."','".$this->getjobSequence()."','','',0,'1900-01-01 00:00:00.000','1900-01-01 00:00:00.000','')");

			$conn->close();
		}
		catch(Exception $e){

		}
	}



}

?>