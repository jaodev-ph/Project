<?php
include_once("connection.php");

class Test{
	private $value1;
	private $value2;
	private $value3;
	private $value4;
	private $value5;
	private $value6;
	private $value7;
	private $value8;
	private $value9;
	private $value10;
	private $value11;
	private $value12;
	private $value13;
	private $value14;
	private $value15;
	private $value16;
	private $value17;
	private $value18;

	function __construct(){

	}

	//setter
	public function setValue1($value1)
	{
		$this->value1 = $value1;
	}

	public function setValue2($value2)
	{
		$this->value2 = $value2;
	}

	public function setValue3($value3)
	{
		$this->value3 = $value3;
	}

	public function setValue4($value4)
	{
		$this->value4 = $value4;
	}

	public function setValue5($value5)
	{
		$this->value5 = $value5;
	}

	public function setValue6($value6)
	{
		$this->value6 = $value6;
	}

	public function setValue7($value7)
	{
		$this->value7 = $value7;
	}

	public function setValue8($value8)
	{
		$this->value8 = $value8;
	}

	public function setValue9($value9)
	{
		$this->value9 = $value9;
	}

	public function setValue10($value10)
	{
		$this->value10 = $value10;
	}

	public function setValue11($value11)
	{
		$this->value11 = $value11;
	}

	public function setValue12($value12)
	{
		$this->value12 = $value12;
	}

	public function setValue13($value13)
	{
		$this->value13 = $value13;
	}

	public function setValue14($value14)
	{
		$this->value14 = $value14;
	}

	public function setValue15($value15)
	{
		$this->value15 = $value15;
	}

	public function setValue16($value16)
	{
		$this->value16 = $value16;
	}

	public function setValue17($value17)
	{
		$this->value17= $value17;
	}
	public function setValue18($value18)
	{
		$this->value18= $value18;
	}


	//Getter
	public function getValue1()
	{
		return $this->value1;
	}

	public function getValue2()
	{
		return $this->value2;
	}
	public function getValue3()
	{
		return $this->value3;
	}
	public function getValue4()
	{
		return $this->value4;
	}
	public function getValue5()
	{
		return $this->value5;
	}
	public function getValue6()
	{
		return $this->value6;
	}
	public function getValue7()
	{
		return $this->value7;
	}
	public function getValue8()
	{
		return $this->value8;
	}
	public function getValue9()
	{
		return $this->value9;
	}
	public function getValue10()
	{
		return $this->value10;
	}
	public function getValue11()
	{
		return $this->value11;
	}
	public function getValue12()
	{
		return $this->value12;
	}
	public function getValue13()
	{
		return $this->value13;
	}
	public function getValue14()
	{
		return $this->value14;
	}
	public function getValue15()
	{
		return $this->value15;
	}
	public function getValue16()
	{
		return $this->value16;
	}
	public function getValue17()
	{
		return $this->value17;
	}
	public function getValue18()
	{
		return $this->value18;
	}


	public function insert()
	{
		$conn = new connection();
	

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.test VALUES('".$this->getValue1()."', '".$this->getValue2()."', '".$this->getValue3()."', '".$this->getValue4()."', '".$this->getValue5()."', '".$this->getValue6()."', '".$this->getValue7()."', '".$this->getValue8()."','".$this->getValue9()."','".$this->getValue10()."','".$this->getValue11()."','".$this->getValue12()."', '".$this->getValue13()."', '".$this->getValue14()."', '".$this->getValue15()."', '".$this->getValue16()."', '".$this->getValue17()."', '".$this->getValue16()."')");
			
			
			$conn->close();
			
		}catch(Exception $e){

		}

	
	}

	public function update()
	{
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.test SET value1 ='".$this->getValue1()."', value2 = '".$this->getValue2()."', value3 = '".$this->getValue3()."', value4 = '".$this->getValue4()."', value5 = '".$this->getValue5()."', value6 = '".$this->getValue6()."', value7 = '".$this->getValue7()."', value8 = '".$this->getValue8()."', value9 = '".$this->getValue9()."', value10 = '".$this->getValue10()."', value11 = '".$this->getValue11()."', value12 = '".$this->getValue12()."', value13 = '".$this->getValue13()."', value14 = '".$this->getValue14()."', value15 = '".$this->getValue15()."', value16 = '".$this->getValue16()."', value17 = '".$this->getValue17()."', value18 = '".$this->getValue18());

			$conn->close();
		}catch(Exception $e){

		}
	}

	public static function selectAll($value1){
		$conn = new Connection();
		$log = array();
		$stationdesc ='';
		try{
			$conn->open();
			$dataset = $conn->query(" SELECT * FROM dbo.test where value1 = '".$value1."'");
			$counter = 0;

			while($reader = $conn->fetch_array($dataset)){
				$array = new Test();
				$array->setValue1($reader["value1"]);
				$array->setValue2($reader["value2"]);
				$array->setValue3($reader['value3']);
				// $log->setDescription($reader['description']);
				$array->setValue4($reader['value4']);
				$array->setValue5($reader["value5"]);
				$array->setValue6($reader["value6"]);
				$array->setValue7($reader["value7"]);
				$log[$counter] = $array;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){

		}

		return $log;
	}

}

?>