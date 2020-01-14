<?php
include_once("connection.php");


class Partslist{
	private $account;
	private $partno;
	private $maker;
	private $description;
	private $compotype;



	function __construct(){

	}

	//setter

	public function setAccount($account)
	{
		$this->account = $account;
	}
	public function setPartNo($partno)
	{
		$this->partno = $partno;
	}

	public function setMaker($maker)
	{
		$this->maker = $maker;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function setCompoType($compotype)
	{
		$this->compotype = $compotype;
	}




	//Getter
	public function getAccount()
	{
		return $this->account;
	}
	public function getPartNo()
	{
		return $this->partno;
	}
	public function getMaker()
	{
		return $this->maker;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getCompoType()
	{
		return $this->compotype;
	}



	
	public function addPart()
	{
		$success = true;
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.kanban_partsmasterlist VALUES( 
								'".$this->getAccount()."',
								'".$this->getPartNo()."',
								'".$this->getMaker()."',
								'".$this->getDescription()."',
								'".$this->getCompoType()."')");

			$conn->close();
		}
		catch(Exception $e){
			$success = false;
		}
		return $success;
	}


	public static function getAllParts($account){
		$conn = new Connection();
		$parts = array();

		try{
			$conn->open();
			$result = $conn->query("SELECT * from dbo.kanban_partsmasterlist WHERE Account = '". $account ."'");
			$counter = 0;
			while($row = $conn->fetch_array($result))
			{
				$partslist = new Partslist();
				$partslist->setAccount($row['Account']);
				$partslist->setPartNo($row['Partno']);
				$partslist->setMaker($row['Maker']);
				$partslist->setDescription($row['Description']);
				$partslist->setCompoType($row['Compotype']);

				$parts[$counter]=$partslist;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){
			
		}

		return $parts;

	}

	public function pnInfo()
	{
		$conn = new connection();

		try{
			$conn->open();
			$myquery = $conn->query("SELECT * from dbo.kanban_partsmasterlist WHERE Partno = '".$this->getPartNo()."'");
			
			if ($conn->has_rows($myquery)>0){
			    $reader = $conn->fetch_array($myquery);
			   
			    $this->setPartNo($reader['Partno']);
			    $this->setMaker($reader['Maker']);
			    $this->setDescription($reader['Description']);
			    $this->setCompotype($reader['Compotype']);

			}
			
			$conn->close();
			}
		catch(Exception $e){

		}
		
	}

	public static function checkifexist($account, $partno)
	{
		$conn = new connection();

		$result = 'false';

		try{
			$conn->open();
			$myquery = $conn->query("SELECT * from dbo.kanban_partsmasterlist WHERE Account = '". $account ."' AND Partno = '".$partno."'");
			
			if ($conn->has_rows($myquery)>0){
			    $reader = $conn->fetch_array($myquery);
			   
			    $result = 'true';

			} else {
				$result = 'false';
			}
			
			$conn->close();
			}
		catch(Exception $e){

		}

		return $result;

		
	}
	
}

?>


