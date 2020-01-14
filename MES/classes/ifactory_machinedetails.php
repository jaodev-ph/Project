<?php
include_once("connection.php");

class machinedetails{

	private $no;
	private $id;
	private $configurationtype;
	private $machine;
	private $modelnumber;
	private $serialnumber;
	private $controlnumber;
	private $assetnumber;
	private $ionicsid;
	private $manufacturer;
	private $machineid;
	private $active;
	private $lastupdatedby;
	private $typeid;
	private $remarks;
	private $description;
	private $name;
	private $image;
	private $machinetypeid;
	private $productionlineid;
	private $seq;
	private $line;

	function __construct($machineid=''){
		
		// if(strlen($model)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM [103.219.69.30].[eFactory].[dbo].[MachineDetails_Rev] WHERE machineid ='".$machineid."'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setno($reader['no']);
				$this->setconfigurationtype($reader['configuration_type']);
				$this->setmachine($reader['Machine']);
				$this->setmodelnumber($reader['modelnumber']);
				$this->setserialnumber($reader['serialnumber']);
				$this->setcontrolnumber($reader['controlnumber']);
				$this->setassetnumber($reader['assetnumber']);
				$this->setionicsid($reader['ionicsid']);
				$this->setmanufacturer($reader['manufacturer']);
				$this->setmachineid($reader['machineid']);
				$this->setactive($reader['active']);

			}

			$conn->close();
		}catch(Exception $e){

		}
	// }

	}

	public function setno($no){
		$this->no = $no;
	}

	public function setconfigurationtype($configurationtype){
		$this->configuration_type = $configurationtype;
	}

	public function setmachine($machine){
		$this->Machine = $machine;
	}

	public function setmodelnumber($modelnumber){
		$this->modelnumber = $modelnumber;
	}

	public function setserialnumber($serialnumber){
		$this->serialnumber = $serialnumber;
	}

	public function setcontrolnumber($controlnumber){
		$this->controlnumber = $controlnumber;
	}

	public function setassetnumber($assetnumber){
		$this->assetnumber = $assetnumber;
	}

	public function setionicsid($ionicsid){
		$this->ionicsid = $ionicsid;
	}

	public function setmanufacturer($manufacturer){
		$this->manufacturer = $manufacturer;
	}

	public function setmachineid($machineid){
		$this->machineid = $machineid;
	}

	public function setactive($active){
		$this->active = $active;
	}

	public function setlastupdatedby($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}

	public function settypeid($typeid){
		$this->typeid = $typeid;
	}

	public function setremarks($remarks){
		$this->remarks = $remarks;
	}

	public function setdescription($description){
		$this->description = $description;
	}

	public function setid($id){
		$this->id = $id;
	}

	public function setname($name){
		$this->name = $name;
	}

	public function setimage($image){
		$this->image = $image;
	}

	public function setmachinetypeid($machinetypeid){
		$this->machineTypeId = $machinetypeid;
	}

	public function setproductionlineid($productionlineid){
		$this->productionLineId = $productionlineid;
	}
	
	public function setseq($seq){
		$this->seq = $seq;
	}

		public function setline($line){
		$this->line = $line;
	}
	

	///////////////////////////////////////////////////////////////

	public function getid(){
		return $this->id;
	}

	public function getno(){
		return $this->no;
	}

	public function getconfigurationtype(){
		return $this->configuration_type;
	}

	public function getmachine(){
		return $this->Machine;
	}

	public function getmodelnumber(){
		return $this->modelnumber;
	}

	public function getserialnumber(){
		return $this->serialnumber;
	}

	public function getcontrolnumber(){
		return $this->controlnumber;
	}

	public function getassetnumber(){
		return $this->assetnumber;
	}

	public function getionicsid(){
		return $this->ionicsid;
	}

	public function getmanufacturer(){
		return $this->manufacturer;
	}

	public function getmachineid(){
		return $this->machineid;
	}

	public function getactive(){
		return $this->active;
	}

	public function getlastupdatedby(){
		return $this->lastupdatedby;
	}

	public function gettypeid(){
		return $this->typeid;
	}

	public function getremarks(){
		return $this->setRemarks;
	}

	public function getdescription(){
		return $this->description;
	}

	public function getname(){
		return $this->name;
	}

	public function getimage(){
		return $this->image;
	}

	public function getmachinetypeid(){
		return $this->machineTypeId;
	}

	public function getproductionlineid(){
		return $this->productionLineId;
	}

	public function getseq(){
		return $this->seq;
	}

	public function getline(){
		return $this->line;
	}


public static function getdetails(){
		$conn = new Connection();
		$result = array();
		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM [103.219.69.30].[eFactory].[dbo].[MachineDetails_Rev]");
			$counter = 0;
			if ($conn->has_rows($dataset)){
				while($reader = $conn->fetch_array($dataset)){
					$machine = new machinedetails();
					$machine->setno($reader['no']);
					$machine->setconfigurationtype($reader['configuration_type']);
					$machine->setmachine($reader['Machine']);	
					$machine->setmodelnumber($reader['modelnumber']);
					$machine->setserialnumber($reader['serialnumber']);
					$machine->setcontrolnumber($reader['controlnumber']);
					$machine->setassetnumber($reader['assetnumber']);
					$machine->setionicsid($reader['ionicsid']);
					$machine->setmanufacturer($reader['manufacturer']);
					$machine->setmachineid($reader['machineid']);
					$result[$counter] = $machine;
					$counter++;
				}

			}

			$conn->close();
		}catch(Exception $e){

		}

		return $result;
			
	}

	public function getmachinetypedetails($id){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM [103.219.69.30].[eFactory].[dbo].[MachineType] WHERE id = '".$id."'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

				$this->setid($reader['id']);
				$this->setname($reader['name']);
				$this->setimage($reader['image']);
				}
				$conn->close();
			}catch(Exception $e){

			}

	}

	public static function getallmachinetype(){
		$conn = new Connection();
		$result = array();
		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM [103.219.69.30].[eFactory].[dbo].[MachineType] order by id");
			$counter = 0;
			if ($conn->has_rows($dataset)){
				while($reader = $conn->fetch_array($dataset)){
					$machine = new machinedetails();
					$machine->setid($reader['id']);
					$machine->setname($reader['name']);
						$result[$counter] = $machine;
					$counter++;
				}

			}

			$conn->close();
		}catch(Exception $e){

		}

		return $result;
			
	}

		public static function getallproductionline(){
		$conn = new Connection();
		$result = array();
		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM [103.219.69.30].[eFactory].[dbo].[Machine] order by id");
			$counter = 0;
			if ($conn->has_rows($dataset)){
				while($reader = $conn->fetch_array($dataset)){
					$machine = new machinedetails();
					$machine->setid($reader['id']);
					$machine->setmachinetypeid($reader['machineTypeId']);
					$machine->setname($reader['name']);
					$machine->setproductionlineid($reader['productionLineId']);
					$machine->setseq($reader['seq']);
						$result[$counter] = $machine;
					$counter++;
				}

			}

			$conn->close();
		}catch(Exception $e){

		}

		return $result;
			
	}


		public static function SelectConfigurationType()
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM [103.219.69.30].[eFactory].[dbo].[MachineConfigtype] order by configuration_type");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new machinedetails();
				 
				 $Select->setconfigurationtype($reader["configuration_type"]);
				 $Select->setdescription($reader["description"]);
				 $Select->settypeid($reader["typeid"]);
				 $Select->setactive($reader["active"]);
				 $Select->setremarks($reader["remarks"]);
	
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}
	

			public static function SelectMachine()
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM [103.219.69.30].[eFactory].[dbo].[MachineType] order by name");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new machinedetails();
				 
				 $Select->setid($reader["id"]);
				 $Select->setname($reader["name"]);
		
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}


			public static function Selectline()
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM [103.219.69.30].[eFactory].[dbo].[Line] order by seq");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new machinedetails();
				 
				 $Select->setline($reader["line"]);
				 
		
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}

	
	public static function SelectMachineID()
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM [103.219.69.30].[eFactory].[dbo].[MachineDetails_Rev] order by machineid");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				 $Select = new machinedetails();
				 
				 $Select->setmachineid($reader["machineid"]);
				 
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}


		public static function SelectMaxMachineid()
	{
		$conn = new connection();
		$result = '';
		
		try{
			$conn->open();
			$dataset =  $conn->query("SELECT 'MC' + format(1+ CAST(SUBSTRING(max(machineid),3,4)as int),'0000') machineid FROM [103.219.69.30].[eFactory].[dbo].[MachineDetails_Rev]");
	
			if ($conn->has_rows($dataset)){
				$dataresult = $conn->fetch_array($dataset);	
				
				$result = $dataresult['machineid'];
				
			}else{
				$result ='';
				
			}
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}



		public function addMachineDetails(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("INSERT INTO [dbo].[MachineDetails_Rev] VALUES('".$this->getconfigurationtype()."','".$this->getmachine()."','".$this->getmodelnumber()."','".$this->getserialnumber()."','".$this->getcontrolnumber()."','".$this->getassetnumber()."','".$this->getionicsid()."','".$this->getmanufacturer()."','".$this->getmachineid()."','".$this->getactive()."',GETDATE(),'".$this->getlastupdatedby()."')");
			$conn->close();
		}catch(Exception $e){

		}	
	}


	public function UpdateMachineDetails(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE [dbo].[MachineDetails_Rev] SET configuration_type = '".$this->getconfigurationtype()."', modelnumber = '".$this->getmodelnumber()."', serialnumber = '".$this->getserialnumber()."', controlnumber = '".$this->getcontrolnumber()."', assetnumber = '".$this->getassetnumber()."', ionicsid = '".$this->getionicsid()."',manufacturer = '".$this->getmanufacturer()."',active = '".$this->getactive()."', lastupdate = getdate(), lastupdatedby = '".$this->getlastupdatedby()."' WHERE machineid = '".$this->getmachineid()."'");

			$conn->close();
		}catch(Exception $e){

		}
	}




	}

?>