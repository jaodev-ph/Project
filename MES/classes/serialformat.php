<?php
include_once("connection.php");

class SerialFormat{
	private $account;
	private $modelno;
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

	public function setModelNo($modelno)
	{
		$this->modelno = $modelno;
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
		$this->serialLength = $serialLenght;
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

	public function getModelNo()
	{
		return $this->modelno;
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
		return $this->serialLength;
	}

	public function getAllowFormat()
	{
		return $this->allowFormat;
	}


	public static function SelectSerialFormat($account,$model)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM [MES].[dbo].[serial_format] WHERE account ='".$account."' and modelno ='".$model."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new SerialFormat();

				$Select->setAccount($reader["account"]);
				$Select->setModelNo($reader["modelno"]);
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


	public static function SelectlotFormat($account,$model)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.lot_format WHERE account ='".$account."' and modelno ='".$model."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new SerialFormat();

				$Select->setAccount($reader["account"]);
				$Select->setModelNo($reader["modelno"]);
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

	public static function SelectpackingFormat($account,$model)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.packing_format WHERE account ='".$account."' and modelno ='".$model."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new SerialFormat();

				$Select->setAccount($reader["account"]);
				$Select->setModelNo($reader["modelno"]);
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


	public static function Selectpalletformat($account,$model)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.pallet_format WHERE account ='".$account."' and modelno ='".$model."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new SerialFormat();

				$Select->setAccount($reader["account"]);
				$Select->setModelNo($reader["modelno"]);
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

	public static function SelectSerialFormatValue($account,$value)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM [MES].[dbo].[serial_format] WHERE account ='".$account."' and value ='".$value."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new SerialFormat();

				$Select->setAccount($reader["account"]);
				$Select->setModelNo($reader["modelno"]);
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

	public static function validserialformat($account,$serialno,$partno){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT *
				FROM serial_format
				WHERE modelno = '".$partno."'
				AND value = SUBSTRING('".$serialno."',start+1,last)
				AND serialLength = len('".$serialno."')
				AND allowFormat = 1
				AND account = '".$account."' ");

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

		public static function SelectSerialFormatValuegetModel($account,$serialno)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT *
				FROM serial_format
				WHERE value = SUBSTRING('".$serialno."',start+1,last)
				AND serialLength = len('".$serialno."')
				AND allowFormat = 1
				AND account = '".$account."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new SerialFormat();

				$Select->setAccount($reader["account"]);
				$Select->setModelNo($reader["modelno"]);
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

	public static function SelectSerialFormatFromMother($account,$serialno,$modelno)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT a.modelno as modelno
				FROM serial_format a
				inner join model b
				on a.modelno = b.modelno
				WHERE value = SUBSTRING('".$serialno."',start+1,last)
				AND serialLength = len('".$serialno."')
				AND allowFormat = 1
				AND a.account = '".$account."'
				AND b.modelType = '".$modelno."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new SerialFormat();

				$Select->setModelNo($reader["modelno"]);

				$result[$counter] = $Select;
				$counter++;
			}

			
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}


	public static function SelectSerialFormatFromMother1($account,$serialno,$modelno){
		$conn = new Connection();
		$itemWt = '';
		try{
			$conn->open();
			$dataset = $conn->query("SELECT a.modelno as modelno
				FROM serial_format a
				inner join model b
				on a.modelno = b.modelno
				WHERE value = SUBSTRING('".$serialno."',start+1,last)
				AND serialLength = len('".$serialno."')
				AND allowFormat = 1
				AND a.account = '".$account."'
				AND b.modelType = '".$modelno."'");

			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$itemWt = $reader['modelno'];
			}
			$conn->close();
		}catch(Exception $e){

		}

		return $itemWt;
	}





}

?>