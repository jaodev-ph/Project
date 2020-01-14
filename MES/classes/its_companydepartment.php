<?php

include_once("connection.php");






class Its_CompDept
{

	private $comID;
	private $deptID;
	private $company;
	private $department;
	private $accessories;
	private $plan_inclu;



	public function __construct()
	{

	}
//setters
	public function setCompany($company){
		$this->company = $company;
	}

	public function setDepartment($department)
	{
		$this->department =$department;
	}
	public function setAccesories($accessories){
		$this->accessories = $accessories;
	}

	public function setPlan_inclu($plan_inclu){
		$this->plan_inclu = $plan_inclu;
	}


//getters

	public function getCompany(){

		return $this->company;
	}

	public function getDepartment(){
		return $this->department;
	}
	public function getAccsessories(){
		return $this->accessories;
	}
	public function getPlan_inclu(){
		return $this->plan_inclu;
	}



public static function getAllaccessories(){

	$conn = new connection();
	$result = array();

	try{
		$conn->open();
		$dataset =$conn->query("SELECT * from dbo.its_accessories where status ='Active'");
		$counter =0;
		while($row = $conn->fetch_array($dataset)){
			$getaccess = new Its_CompDept();
			$getaccess->setAccesories($row["accessories"]);
			$result[$counter] =$getaccess;
			$counter++;
		}
		$conn ->close();
	}catch(Exception $e){

	}
	return $result;
}

public static function getAllPlan_Inclusion(){

	$conn = new connection();
	$result = array();

	try{
		$conn->open();
		$dataset = $conn->query("SELECT * from dbo.its_plan_inclusion where status ='Active'");
		$counter =0;

		while($row = $conn->fetch_array($dataset)){

			$getPlan = new Its_CompDept();
			$getPlan->setPlan_inclu($row["plan_inclusion"]);
			$result[$counter] = $getPlan;
			$counter++;
		}
		$conn->close();
	}catch(Exception $e){

	}
	return $result;

}



	public static function getallCompany()
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.its_company where status ='Active'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				$Select = new Its_CompDept();
				$Select->setCompany($reader["company"]);
				$result[$counter] = $Select;
				$counter++;
			}

			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

////

	public static function getalldepartment()
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.its_Dept");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				$Select = new Its_CompDept();
				$Select->setDepartment($reader["department"]);
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