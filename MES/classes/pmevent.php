<?php include_once("connection.php");?>

<?php

class dashboard 
{

	Private $jobOrder;
	Private $productionlineid;
	Private $jobtype;
	Private $datestart;
	Private $dateend;
	Private $timestart;
	Private $timeend;
	Private $plannedby;
	Private $datecreated;
	Private $status;

	
	

//setter

	public function setjobOrder($joborder){
	$this->jobOrder = $joborder;
	}

	public function setproductionLineId($productionlineid){
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

	public function setdateCreated($datecreated){
	$this->dateCreated = $datecreated;
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


	public static function getAllPMSchedule(){

		$conn = new Connection();
		$pm = array();

		try{
			$conn->open();
			$result = $conn->query("SELECT jobOrder,
				productionLineId,
				jobType,		
				CONVERT(VARCHAR,dateStart,107) AS dateStart,
				CONVERT(VARCHAR(7),timeStart,0) AS timeStart,
				CONVERT(VARCHAR,dateEnd,107) AS dateEnd,
				CONVERT(VARCHAR(7),timeEnd,0) AS timeEnd,
				dateCreated,
				plannedBy 
				FROM dbo.imms_MachineJobSchedule ORDER BY dateStart DESC");

			$counter = 0;
			while($row = $conn->fetch_array($result))
			{
				$dashboard = new dashboard();
				$dashboard->setjobOrder($row['jobOrder']);
				$dashboard->setproductionLineId($row['productionLineId']);
				$dashboard->setjobType($row['jobType']);
				$dashboard->setdateStart($row['dateStart']);
				$dashboard->setdateEnd($row['dateEnd']);
				$dashboard->settimeStart($row['timeStart']);
				$dashboard->settimeEnd($row['timeEnd']);
				$dashboard->setplannedBy($row['plannedBy']);
				$dashboard->setdateCreated($row['dateCreated']);

				$pm[$counter]=$dashboard;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){
			
		}

		return $pm;

	}

		public function getPMScheduleDetails($jobOrder){
	$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.imms_MachineJobSchedule WHERE jobOrder = '".$jobOrder."'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setjobOrder($reader['jobOrder']);
				$this->setproductionLineId($reader['productionLineId']);
				$this->setjobType($reader['jobType']);
				$this->setdateStart($reader['dateStart']);
				$this->setdateEnd($reader['dateEnd']);
				$this->settimeStart($reader['timeStart']);
				$this->settimeEnd($reader['timeEnd']);
				$this->setplannedBy($reader['plannedBy']);
				$this->setdateCreated($reader['dateCreated']);
			}

			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function getReport(){

		$conn = new Connection();
		$pm = array();

		try{
			$conn->open();
			$result = $conn->query("SELECT PM_ID,
				LineId,
				TaskType,
				TypeSeq,
				CONVERT(VARCHAR,date_from,107) AS date_from1,
				CONVERT(VARCHAR(7),time_from,0) AS time_from,
				CONVERT(VARCHAR,date_to,107) AS date_to,
				CONVERT(VARCHAR(7),time_to,0) AS time_to,
				created_by,
				Stats 
				FROM dbo.Schedule_Logs ORDER BY date_from DESC");

			$counter = 0;
			while($row = $conn->fetch_array($result))
			{
				$dashboard1 = new dashboard();
				$dashboard1->setId($row['PM_ID']);
				$dashboard1->setLine($row['LineId']);
				$dashboard1->setTaskType($row['TaskType']);
				$dashboard1->setTypeSeq($row['TypeSeq']);
				$dashboard1->setDateFrom($row['date_from1']);
				$dashboard1->setTimeFrom($row['time_from']);
				$dashboard1->setDateTo($row['date_to']);
				$dashboard1->setTimeTo($row['time_to']);
				$dashboard1->setCreatedBy($row['created_by']);
				$dashboard1->setStatus($row['Status']);

				$pm[$counter]=$dashboard1;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){
			
		}

		return $pm;

	}

// 	public static function delete($id){
// 	$conn = new Connection();

// 	try{
// 		$conn->open();
// 		$result = $conn->query("DELETE  FROM dbo.testSchedule WHERE PM_ID='".$id."'");

// 	}
// 			$conn->close();
// 		}catch(Exception $e){
			
		
// }
}

?>