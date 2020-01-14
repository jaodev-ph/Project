<?php

include_once("connection.php");

class Line{

	private $account;
	private $line;
	private $linename;
	private $active;
	private $module;
	

	function __construct(){

	}

	public function setAccount($account){
		$this->account = $account;
	}

	public function setLine($line){
		$this->line = $line;
	}

	public function setLineName($linename){
		$this->linename = $linename;
	}

	public function setActive($active){
		$this->active = $active;
	}

	public function setModule($module){
		$this->module = $module;
	}



	//getter

	public function getAccount(){
		return $this->account;
	}

	public function getLine(){
		return $this->line;
	}

	public function getLineName(){
		return $this->linename;
	}

	public function getActive(){
		return $this->active;
	}

	public function getModule(){
		return $this->module;
	}


public static function SelectAllLine($account,$module)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.line WHERE account = '".$account."' and module ='".$module."' and active ='1' order by sequence");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Line();
				 $Select->setAccount($reader["account"]);
				 $Select->setLine($reader["line"]);
				 $Select->setActive($reader["active"]);
	
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

public static function SelectAllLine2($account,$module,$authentication)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.line2 WHERE account = '".$account."' and module ='".$module."' and active ='1' and authentication='".$authentication."' order by sequence");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new Line();
				 $Select->setAccount($reader["account"]);
				 $Select->setLineName($reader["linename"]);
				 $Select->setLine($reader["line"]);
				 $Select->setActive($reader["active"]);
	
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}







}




?>