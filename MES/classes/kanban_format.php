<?php
include_once("connection.php");

class Kanban_Format{
	private $account;
	private $type;
	private $value;
	private $start;
	private $last;
	private $serialLenght;
	private $allowFormat;

	function __construct(){

	}

	//setter
	public function setAccount($account)
	{
		$this->account = $account;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	public function setStart($start)
	{
		$this->start = $start;
	}

	public function setLast($last)
	{
		$this->last = $last;
	}

	public function setSerialLength($serialLenght)
	{
		$this->serialLenght = $serialLenght;
	}

	public function setAllowFormat($allowFormat)
	{
		$this->allowFormat = $allowFormat;
	}


	//Getter
	public function getAccount()
	{
		return $this->account;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function getStart()
	{
		return $this->start;
	}

	public function getLast()
	{
		return $this->last;
	}

	public function getSerialLength()
	{
		return $this->serialLenght;
	}

	public function getAllowFormat()
	{
		return $this->allowFormat;
	}


	public static function SelectKanbanFormat($account,$type)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.kanban_format WHERE account ='".$account."' and type ='".$type."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new Kanban_Format();
	
				$Select->setAccount($reader["account"]);
				$Select->setType($reader["type"]);
				$Select->setValue($reader["value"]);
				$Select->setStart($reader["start"]);
				$Select->setLast($reader["last"]);
				$Select->setSerialLength($reader["serialLength"]);
				$Select->setAllowFormat($reader["allowFormat"]);

				$result[$counter] = $Select;
				$counter++;
			}

			
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}


	// public static function SelectlotFormat($account,$model)
	// {
	// 	$conn = new connection();
	// 	$result = array();

	// 	try{
	// 		$conn->open();
	// 		$dataset =  $conn->query("SELECT * FROM dbo.lot_format WHERE account ='".$account."' and modelno ='".$model."'");
	// 		$counter = 0;
	// 		while($reader = $conn->fetch_array($dataset)){
	// 			$Select = new SerialFormat();
	
	// 			$Select->setAccount($reader["account"]);
	// 			$Select->setModelNo($reader["modelno"]);
	// 			$Select->setValue($reader["value"]);
	// 			$Select->setStart($reader["start"]);
	// 			$Select->setLast($reader["last"]);
	// 			$Select->setSerialLength($reader["serialLength"]);
	// 			$Select->setAllowFormat($reader["allowFormat"]);

	// 			$result[$counter] = $Select;
	// 			$counter++;
	// 		}

			
	// 		$conn->close();
			
	// 	}catch(Exception $e){

	// 	}
	// 	return $result;
	// }

	// public static function SelectpackingFormat($account,$model)
	// {
	// 	$conn = new connection();
	// 	$result = array();

	// 	try{
	// 		$conn->open();
	// 		$dataset =  $conn->query("SELECT * FROM dbo.packing_format WHERE account ='".$account."' and modelno ='".$model."'");
	// 		$counter = 0;
	// 		while($reader = $conn->fetch_array($dataset)){
	// 			$Select = new SerialFormat();
	
	// 			$Select->setAccount($reader["account"]);
	// 			$Select->setModelNo($reader["modelno"]);
	// 			$Select->setValue($reader["value"]);
	// 			$Select->setStart($reader["start"]);
	// 			$Select->setLast($reader["last"]);
	// 			$Select->setSerialLength($reader["serialLength"]);
	// 			$Select->setAllowFormat($reader["allowFormat"]);

	// 			$result[$counter] = $Select;
	// 			$counter++;
	// 		}

			
	// 		$conn->close();
			
	// 	}catch(Exception $e){

	// 	}
	// 	return $result;
	// }




}

?>