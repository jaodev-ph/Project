<?php
include_once("connection.php");

class Account{
	private $customercode;
	private $customername;
	private $active;



	function __construct(){

	}

	//setter
	public function setCustomerCode($customercode)
	{
		$this->customercode = $customercode;
	}

	public function setCustomerName($customername)
	{
		$this->customername = $customername;
	}

	public function setActive($active)
	{
		$this->active = $active;
	}



	//Getter
	public function getCustomerCode()
	{
		return $this->customercode;
	}

	public function getCustomerName()
	{
		return $this->customername;
	}

	public function getActive()
	{
		return $this->active;
	}


	public static function SelectAllAccount()
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.customer_stockroom_codes WHERE active ='1' Order By customer_name ");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new Account();
				$Select->setCustomerCode($reader["customer_code"]);
				$Select->setCustomerName($reader["customer_name"]);
				$Select->setActive($reader["active"]);
				$result[$counter] = $Select;
				$counter++;
			}

			
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

	public function SelectAccount()
	{
		$conn = new connection();	

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.customer_stockroom_codes WHERE active ='1' and customer_code ='".$this->getCustomerCode()."'");

			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$this->setCustomerCode($reader["customer_code"]);
				$this->setCustomerName($reader["customer_name"]);
				$this->setActive($reader["active"]);				
			}

			
			$conn->close();
			
		}catch(Exception $e){
	
	}

	}
}

?>