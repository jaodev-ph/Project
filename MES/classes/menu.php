<?php
include_once("connection.php");

class Menu{
	private $account;
	private $menuName;
	private $flowsequence;
	private $active;
	private $icon;
	private $module;
	private $menuCode;


	function __construct(){

	}

	//setter
	public function setAccount($account)
	{
		$this->account = $account;
	}

	public function setMenuName($menuName)
	{
		$this->menuName = $menuName;
	}

	public function setFlowsequence($flowsequence)
	{
		$this->flowsequence = $flowsequence;
	}

	public function setActive($active)
	{
		$this->active = $active;
	}
	
	public function setIcon($icon)
	{
		$this->icon = $icon;
	}

	public function setModule($module)
	{
		$this->module = $module;
	}

	public function setMenuCode($menuCode)
	{
		$this->menuCode = $menuCode;
	}



	//Getter
	public function getAccount()
	{
		return $this->account;
	}

	public function getMenuName()
	{
		return $this->menuName;
	}

	public function getFlowsequence()
	{
		return $this->flowsequence;
	}

	public function getActive()
	{
		return $this->active;
	}

	public function getIcon()
	{
		return $this->icon;
	}

		public function getModule($module)
	{
		return $this->module;
	}

		public function getMenuCode($menuCode = 0)
	{
		return $this->menuCode;
	}



	public static function SelectMenu($account,$module)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.menu WHERE account = '".$account."' and module ='".strtolower($module)."' and active ='1' order by flowsequence");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new Menu();
				$Select->setAccount($reader["account"]);
				$Select->setMenuName($reader["menuName"]);
				$Select->setFlowsequence($reader["flowsequence"]);
				$Select->setActive($reader["active"]);
				$Select->setIcon($reader["icon"]);
				$Select->setModule($reader["module"]);
				$Select->setMenuCode($reader["menuCode"]);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){
			echo $e;
		}
		return $result;
	}




}

?>