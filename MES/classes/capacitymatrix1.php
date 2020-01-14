<?php

include_once("connection2.php");

class CapacityMatrix{
	private $id;
	private $lineid;
	private $model;
	private $side;
	private $uph;
	private $vendor;
	private $multiplier;
	private $remarks;
	private $lastupdated;
	private $updatedby;
	private $line;


	function __construct($id = ''){
		
		if(strlen($id)!=0){


				$conn = new Connection1();

				try{
					$conn->open();
					$dataset = $conn->query("SELECT * FROM [dbo].[CapacityMatrix] WHERE id = '".$id."'");

					if($conn->has_rows($dataset)){
						$reader = $conn->fetch_array($dataset);

						$this->setID($reader['id']);
						$this->setLineID($reader['line_id']);
						$this->setModel($reader['model']);
						$this->setSide($reader['side']);
						$this->setUph($reader['uph']);
						$this->setVendor($reader['vendor']);
						$this->setMultiplier($reader['multiplier']);
						$this->setRemarks($reader['remarks']);
						$this->setLastupdated($reader['lastupdated']);
						$this->setUpdatedBy($reader['updatedby']);
					}
					$conn->close();
				}catch(Exception $e){

				}
		}

	}

	//Setter
	public function setID($id){
		$this->id = $id;
	}

	public function setLineID($lineid){
		$this->line_id = $lineid;
	}

	public function setModel($model){
		$this->model = $model;
	}

	public function setSide($side){
		$this->side = $side;
	}

	public function setUph($uph){
		$this->uph = $uph;
	}

	public function setVendor($vendor){
		$this->vendor = $vendor;
	}

	public function setMultiplier($multiplier){
		$this->multiplier = $multiplier;
	}

		public function setRemarks($remarks){
		$this->remarks = $remarks;
	}

		public function setLastupdated($lastupdated){
		$this->lastupdated = $lastupdated;
	}

		public function setUpdatedBy($updatedby){
		$this->updatedby = $updatedby;
	}

		public function setLine($line){
		$this->line = $line;
	}


	//Getter
	public function getID(){
		return $this->id;
	}

	public function getLineID(){
		return $this->line_id;
	}

	public function getModel(){
		return $this->model;
	}

	public function getSide(){
		return $this->side;
	}
	
	public function getUph(){
		return $this->uph;
	}
	
	public function getVendor(){
		return $this->vendor;
	}

	public function getMultiplier(){
		return $this->multiplier;
	}

	public function getRemarks(){
		return $this->remarks;
	}

	public function getLastupdated(){
		return $this->lastupdated;
	}

	public function getUpdatedBy(){
		return $this->updatedby;
	}

	public function getLine(){
		return $this->line;
	}
	
	
	public static function getCapacityMatrix(){
		$conn = new Connection1();
		$matrixes = array();

		try{
			$conn->open();
			$result = $conn->query("SELECT * FROM [dbo].[CapacityMatrix] ORDER BY id desc");
			$counter = 0;
			while($row = $conn->fetch_array($result))
			{
				$matrix = new CapacityMatrix();
				$matrix->setID($row['id']);
				$matrix->setLineID($row['line_id']);
				$matrix->setModel($row['model']);
				$matrix->setSide($row['side']);
				$matrix->setUph($row['uph']);
				$matrix->setVendor($row['vendor']);
				$matrix->setMultiplier($row['multiplier']);
				$matrix->setRemarks($row['remarks']);
				$matrix->setLastupdated($row['lastupdated']->format('Y-m-d h:i:s a'));
				$matrix->setUpdatedBy($row['updatedby']);

				$matrixes[$counter] = $matrix;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){
			
		}

		return $matrixes;

	}





	
	public static function getCapacityMatrixbyId($id){
		$conn = new Connection1();
		$matrixes = array();

		try{
			$conn->open();
			$result = $conn->query("SELECT * FROM [dbo].[CapacityMatrix] WHERE id = '".$id."'");
			$counter = 0;
			while($row = $conn->fetch_array($result))
			{
				$matrix = new CapacityMatrix();
				$matrix->setID($row['id']);
				$matrix->setLineID($row['line_id']);
				$matrix->setModel($row['model']);
				$matrix->setSide($row['side']);
				$matrix->setUph($row['uph']);
				$matrix->setVendor($row['vendor']);
				$matrix->setMultiplier($row['multiplier']);
				$matrix->setRemarks($row['remarks']);
				$matrix->setLastupdated($row['lastupdated']->format('Y-m-d h:i:s a'));
				$matrix->setUpdatedBy($row['updatedby']);

				$matrixes[$counter] = $matrix;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){
			
		}

		return $matrixes;

	}

		public function update($id,$line_id,$model,$side,$uph,$vendor,$multiplier,$remarks,$updatedby){
		$conn = new Connection1();

		try{
			$conn->open();
			$dataset = $conn->query("UPDATE [dbo].[CapacityMatrix] SET 
									line_id = '".$line_id."', 
									model = '".$model."', 
									side = '".$side."',
									uph = '".$uph."',
									vendor = '".$vendor."',
									multiplier = '".$multiplier."',
									remarks = '".$remarks."',
									lastupdated = GETDATE(),
									updatedby = '".$updatedby."'
									WHERE id = '".$id."'");
			$conn->close();
		}catch(Exception $e){

		}
	}




	public function addCapacityMatrix(){
		$conn = new Connection1();

		try{
			$conn->open();
			$conn->query("INSERT INTO [dbo].[CapacityMatrix] VALUES('".$this->getLineID()."','".$this->getModel()."','".$this->getSide()."','".$this->getUph()."','".$this->getVendor()."','".$this->getMultiplier()."','".$this->getUpdatedBy()."',GETDATE(),'".$this->getRemarks()."')");
			$conn->close();
		}catch(Exception $e){

		}	
	}

	public function delete()
	{
		$conn = new Connection1();

		try{
			$conn->open();
			$conn->query("DELETE FROM [dbo].[CapacityMatrix] WHERE id = '".$this->getID()."' ");

			$conn->close();
		}
		catch (Exception $e){
			
		}
	}

		public function RunDailyPlan_Toshiba()
	{
		$conn = new Connection1();

		try{
			$conn->open();
			$conn->query("Exec dbo.DailyPlan_Toshiba");

			$conn->close();
		}
		catch (Exception $e){
			
		}
	}

	public function RunDailyPlan_Epson()
	{
		$conn = new Connection1();

		try{
			$conn->open();
			$conn->query("Exec dbo.DailyPlan_EPSON");

			$conn->close();
		}
		catch (Exception $e){
			
		}
	}

	public function RunDailyPlan_AllPlan()
	{
		$conn = new Connection1();

		try{
			$conn->open();
			$conn->query("Exec dbo.DailyPlan_ALLPlan");

			$conn->close();
		}
		catch (Exception $e){
			
		}
	}

	public static function SelectAllLine()
	{
		$conn = new Connection1();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM [dbo].[Line]  order by seq");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new CapacityMatrix();
		
				 $Select->setLine($reader["line"]);
	
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}
	public static function SelectMaxid()
	{
		$conn = new Connection1();
		$result = '';
		
		try{
			$conn->open();
			$dataset =  $conn->query("SELECT max(id)+1 as id FROM [dbo].[CapacityMatrix]");
	
			if ($conn->has_rows($dataset)){
				$dataresult = $conn->fetch_array($dataset);	
				
				$result = $dataresult['id'];
				
			}else{
				$result ='';
				
			}
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

}






?>