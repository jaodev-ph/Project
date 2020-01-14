<?php
include_once("connection.php");

class Authentication{
	private $auth;
	private $menuCode;

	function __construct(){

	}

	//setter
	public function setAuth($auth)
	{
		$this->auth = $auth;
	}

	public function setMenuCode($menuCode)
	{
		$this->menuCode = $menuCode;
	}


	//Getter
	public function getAuth()
	{
	
		return $this->auth;
	}

	public function getModuleCode()
	{
		return $this->menuCode;
	}



	
	public static function SelectAllAuth($auth,$menuCode,$account,$module)
	{
		$conn = new connection();
		$result = '';
		
		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.authentication WHERE auth ='".strtolower($auth)."' and menuCode ='".$menuCode."' and account ='".$account."' and module = '".$module."'");
	
			if ($conn->has_rows($dataset)){
				$dataresult = $conn->fetch_array($dataset);	
				
				$result = $dataresult['menuCode'];
				
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