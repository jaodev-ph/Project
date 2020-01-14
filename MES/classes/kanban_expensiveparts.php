<?php

include_once("connection.php");


class Expensiveparts {

	private $model;
	private $revision;
	private $type;
	private $location;
	private $partno;

	public function __construct() {

	}

	//setter
	public function setModel($model) {
		$this->model = $model;
	}

	public function setRevision($revision) {
		$this->revision = $revision;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public function setLocation($location) {
		$this->location = $location;
	}

	public function setPartno($partno) {
		$this->partno = $partno;
	}

	//getter
	public function getModel() {
		return $this->model;
	}

	public function getRevision() {
		return $this->revision;
	}

	public function getType() {
		return $this->type;
	}

	public function getLocation() {
		return $this->location;
	}

	public function getPartno() {
		return $this->partno;
	}


	public function addExpensiveParts() {	
		$success = true;
		$conn = new Connection();

		try {
			$conn->open();
			$conn->query("INSERT INTO dbo.kanban_expensiveparts VALUES (
							'".$this->getModel()."',
							'".$this->getRevision()."',
							'".$this->getType()."',
							'".$this->getLocation()."',
							'".$this->getPartno()."',
							0,
							0)");

			$conn->close();

		} catch (Exception $e) {
			$success = false;
		}

		return $success;

	}

	public static function checkExpensiveparts($model, $revision) {
		$conn = new Connection();
		$result = 'false';

		try {
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.kanban_expensiveparts WHERE Model = '".$model."' AND Revision = '".$revision."'");

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

	public static function getAllExpensiveparts() {
		$conn = new Connection;
		$exparts = array();

		try {
			$conn->open();

			$sql = "SELECT * FROM dbo.kanban_expensiveparts";
			$query = $conn->query($sql);
			$counter = 0;

			while ($row = $conn->fetch_array($query)) {
				$expart = new Expensiveparts();
				$expart->setModel($row['Model']);
				$expart->setRevision($row['Revision']);
				$expart->setType($row['Type']);
				$expart->setLocation($row['Location']);
				$expart->setPartno($row['PartNum']);
				$exparts[$counter] = $expart;
				$counter++;
			}

			$conn->close();

			
		} catch (Exception $e) {
			
		}

		return $exparts;
	}
}



?>