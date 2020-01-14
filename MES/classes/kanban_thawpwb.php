<?php
include_once("connection.php");

class Thawbake{
	private $account;
	private $module;
	private $type;
	private $hours;
	private $maker;



	function __construct(){

	}

	//setter
	public function setAccount($account)
	{
		$this->account = $account;
	}

	public function setModule($module)
	{
		$this->module = $module;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function setHours($hours)
	{
		$this->hours = $hours;
	}

	public function setMaker($maker)
	{
		$this->maker = $maker;
	}



	//Getter
	public function getAccount()
	{
		return $this->account;
	}

	public function getModule()
	{
		return $this->module;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getHours()
	{
		return $this->hours;
	}

	public function getMaker()
	{
		return $this->maker;
	}


	public function SelectThawHours()
	{
		$conn = new connection();	

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.kanban_thawbake WHERE account ='".$this->getAccount()."' and type ='".$this->getType()."' and maker ='".$this->getMaker()."' and module ='".$this->getModule()."'");

			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$this->setHours($reader["hours"]);
						
			}else{
				$this->setHours("0");
			}

			
			$conn->close();
			
		}catch(Exception $e){
	
	}

	}
}

?>