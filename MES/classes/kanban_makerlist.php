<?php
include_once("connection.php");

class Makerlist{
	private $account;
	private $maker;
	private $active;
	private $lastupdatedby;
	private $lastupdate; 


	function __construct(){

	}

	//setter

	public function setAccount($account)
	{
		$this->account = $account;
	}
	public function setMaker($maker)
	{
		$this->maker = $maker;
	}
	public function setActive($active)
	{
		$this->active = $active;
	}
	public function setLastupdatedby($lastupdatedby)
	{
		$this->lastupdatedby = $lastupdatedby;
	}
	

	//Getter
	public function getAccount()
	{
		return $this->account;
	}
	public function getMaker()
	{
		return $this->maker;
	}
	public function getActive()
	{
		return $this->active;
	}
	public function getLastupdatedby()
	{
		return $this->lastupdatedby;
	}


	public function addMaker()
	{
		$success = true;
		$conn = new Connection();

		try{	
			$conn->open();
			$conn->query("INSERT INTO dbo.kanban_makerlist VALUES( 
								'".$this->getAccount()."',
								'".$this->getMaker()."',
								'1',
								'".$this->getLastupdatedby()."',
								GETDATE())");

			$conn->close();
		}
		catch(Exception $e){
			$success = false;
		}
		return $success;
	}


	public static function getAllMaker($account){
		$conn = new Connection();
		$maker = array();

		try{
			$conn->open();
			$result = $conn->query("SELECT * from dbo.kanban_makerlist WHERE account = '". $account ."'");
			$counter = 0;
			while($row = $conn->fetch_array($result))
			{
				$makerlist = new Makerlist();
				$makerlist->setAccount($row['account']);
				$makerlist->setMaker($row['maker']);
				$makerlist->setActive($row['active']);
				$makerlist->setLastupdatedby($row['lastupdatedby']);
				$maker[$counter]=$makerlist;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){
			
		}

		return $maker;

	}

	public static function checkifexist($account, $maker) {
		$conn = new Connection();

		$result = 'false';

		try{
			$conn->open();
			$myquery = $conn->query("SELECT * from dbo.kanban_makerlist WHERE account = '". $account ."' AND maker = '". $maker ."'");
			if ($conn->has_rows($myquery)>0){
			    $reader = $conn->fetch_array($myquery);
			   
			    $result = 'true';

			} else {
				$result = 'false';
			}
			
			$conn->close();

		}catch(Exception $e){
			
		}

		return $result;
	}
	
}

?>

