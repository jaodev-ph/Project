<?php

include_once("connection.php");


class Componentlist {
	private $account;
	private $component_code;
	private $description;
	private $active;
	private $lastupdatedby;

	function __construct() {

	}

	//setter

	public function setAccount($account) {
		$this->account = $account;
	}

	public function setComponentCode($component_code){
		$this->component_code = $component_code;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setActive($active){
		$this->active = $active;
	}

	public function setLastUpdatedBy($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}

	//getter

	public function getAccount(){
		return $this->account;
	}

	public function getComponentCode(){
		return $this->component_code;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getActive(){
		return $this->active;
	}

	public function getLastUpdatedBy(){
		return $this->lastupdatedby;
	}

	public function addComponent(){
		$success = true;
		$conn = new Connection;

		try {
			$conn->open();
			$sql = "INSERT INTO dbo.kanban_componenttype VALUES ('". $this->getAccount() ."','". $this->getComponentCode() ."', '". $this->getDescription() ."', '1', '". $this->getLastUpdatedBy() ."', GETDATE())";

			$query = $conn->query($sql);

			$conn->close();

		} catch (Exception $e) {
			$success = false;
		}

		return $success;
	}

	public static function getAllComponent($account){
		$conn = new Connection;

		$conn->open();

		$sql = "SELECT * FROM dbo.kanban_componenttype WHERE account = '". $account ."'";

		$result = $conn->query($sql);

		$component = array();

		$counter = 0;

		while ($row = $conn->fetch_array($result)) {
			$componentlist = New Componentlist;
			$componentlist->setAccount($row['account']);
			$componentlist->setComponentCode($row['component_code']);
			$componentlist->setDescription($row['description']);
			$componentlist->setActive($row['active']);
			$componentlist->setLastUpdatedBy($row['lastupdatedby']);
			$component[$counter] = $componentlist;
			$counter++;
		}

		$conn->close();
		return $component;

	}

	public static function checkifexist($account, $componentcode, $description){
		$conn = new Connection;
		$result = 'false';

		try {
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.kanban_componenttype WHERE account = '". $account ."' AND component_code = '". $componentcode ."' AND description = '". $description ."'");

			if ($conn->has_rows($myquery)>0) {
				$reader = $conn->fetch_array($myquery);

				$result = 'true';

			} else {
				$result = 'false';
			}

			$conn->close();

		} catch (Exception $e) {
			
		}

		return $result;
	}
}


?>