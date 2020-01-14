<?php
include_once("connection.php");

class SubMenu{
	private $account;
	private $subMenuName;
	private $submenucode;
	private $active;
	private $module;
	private $flowsequence;
	private $filename;


	function __construct(){

	
	}

	//setter
	public function setAccount($account)
	{
		$this->account = $account;
	}

	public function setSubMenuName($subMenuName)
	{
		$this->subMenuName = $subMenuName;
	}

	public function setSubMenuCode($submenucode)
	{
		$this->submenucode = $submenucode;
	}

	public function setActive($active)
	{
		$this->active = $active;
	}

	public function setModule($module)
	{
		$this->module = $module;
	}

	public function setFlowsequence($flowsequence)
	{
		$this->flowsequence = $flowsequence;
	}
	
	public function setFileName($filename)
	{
		$this->filename = $filename;
	}

	

	//Getter
	public function getAccount()
	{
		return $this->account;
	}

	public function getSubMenuName()
	{
		return $this->subMenuName;
	}

	public function getFlowsequence()
	{
		return $this->flowsequence;
	}

	public function getActive()
	{
		return $this->active;
	}

	public function getModule($module= 1)
	{
		return $this->module;
	}

	public function getSubMenuCode($submenucode = 0)
	{
		return $this->submenucode;
	}

	public function getFileName($filename = 1)
	{
		return $this->filename;
	}



	public static function SelectAllSubMenu($account,$menucode,$module)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.submenu WHERE account = '".$account."' and module ='".strtolower($module)."' and submenucode ='".$menucode."' and active ='1' order by flowsequence");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new SubMenu();
				$Select->setAccount($reader["account"]);
				$Select->setSubMenuName($reader["submenuname"]);
				$Select->setFlowsequence($reader["flowsequence"]);
				$Select->setActive($reader["active"]);
				$Select->setModule($reader["module"]);
				$Select->setSubMenuCode($reader["submenucode"]);
				$Select->setFileName($reader["filename"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}


	public function SelectTopOne()
	{
		$conn = new connection();


		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.submenu WHERE account = '".$this->getAccount()."' and module ='".strtolower($this->getModule())."' and flowsequence = '".$this->getFlowsequence()."' and submenucode ='".$this->getSubMenuCode()."' and active ='1'");

			if($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
				
				$this->setFileName($reader["filename"]);				
			}		
			$conn->close();
			
		}catch(Exception $e){

		}
		
	}




}

?>