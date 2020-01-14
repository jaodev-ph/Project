<?php
include_once("connection.php");

class Module{
	private $modulename;
	private $active;
	private $flowsequence;
	private $icon;

	function __construct(){

	}

	//setter
	public function setModuleName($modulename)
	{
		$this->modulename = $modulename;
	}

	public function setActive($active)
	{
		$this->active = $active;
	}

	public function setFlowsequence($flowsequence)
	{
		$this->flowsequence = $flowsequence;
	}

	public function setIcon($icon)
	{
		$this->icon = $icon;
	}

	//Getter
	public function getModuleName()
	{
		return $this->modulename;
	}

	public function getActive()
	{
		return $this->active;
	}

	public function getFlowsequence()
	{
		return $this->flowsequence;
	}

	public function getIcon()
	{
		return $this->icon;
	}


	public static function SelectAllModule()
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.module WHERE active ='1' order by flowsequence");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new Module();
				$Select->setModuleName($reader["moduleName"]);
				$Select->setActive($reader["active"]);
				$Select->setFlowsequence($reader["flowsequence"]);
				$Select->setIcon($reader["icon"]);				
				$result[$counter] = $Select;
				$counter++;
			}

			
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}


	public static function SelectIcon($module)
	{
		$conn = new connection();
		$result = "";

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.module WHERE active ='1' and moduleName ='".$module."' ");

			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				$result = $reader["icon"];				
			}

			
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}





}

?>