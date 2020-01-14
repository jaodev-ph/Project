<?php
include_once("connection.php");

class Check {

	private $account;
	private $serial1_type;
	private $serial1_model;
	private $serial1_prefix;
	private $serial1_prefixlength;
	private $serial1_length;
	private $serial2_type;
	private $serial2_model;
	private $serial2_prefix;
	private $serial2_prefixlength;
	private $serial2_length;
	private $serial2Reg;
	private $station;
	private $lastupdatedBy;


function __construct($account='',$serial1_model='',$serial2_model=''){

	if(strlen($serial1_model)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card_link where account ='".$account."' and serial1_model = '".$serial1_model."'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setaccount($reader['account']);
				$this->setserial1_type($reader['serial1_type']);
				$this->setserial1_model($reader['serial1_model']);
				$this->setserial1_prefix($reader['serial1_prefix']);
				$this->setserial1_prefixlength($reader['serial1_prefixlength']);
				$this->setserial1_length($reader['serial1_length']);
				$this->setserial2_type($reader['serial2_type']);
				$this->setserial2_model($reader['serial2_model']);
				$this->setserial2_prefix($reader['serial2_prefix']);
				$this->setserial2_prefixlength($reader['serial2_prefixlength']);
				$this->setserial2_length($reader['serial2_length']);
				$this->setserial2Reg($reader['serial2Reg']);
				$this->setstation($reader['station']);
				$this->setlastupdatedBy($reader['lastupdatedBy']);
				
			}

			$conn->close();
		}catch(Exception $e){

		}
	}
		else if(strlen($serial2_model)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card_link where account ='".$account."' and serial1_model = '".$serial1_model."' and serial2_model = '".$serial2_model."'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				$this->setaccount($reader['account']);
				$this->setserial1_type($reader['serial1_type']);
				$this->setserial1_model($reader['serial1_model']);
				$this->setserial1_prefix($reader['serial1_prefix']);
				$this->setserial1_prefixlength($reader['serial1_prefixlength']);
				$this->setserial1_length($reader['serial1_length']);
				$this->setserial2_type($reader['serial2_type']);
				$this->setserial2_model($reader['serial2_model']);
				$this->setserial2_prefix($reader['serial2_prefix']);
				$this->setserial2_prefixlength($reader['serial2_prefixlength']);
				$this->setserial2_length($reader['serial2_length']);
				$this->setserial2Reg($reader['serial2Reg']);
				$this->setstation($reader['station']);
				$this->setlastupdatedBy($reader['lastupdatedBy']);
				
			}

			$conn->close();
		}catch(Exception $e){

		}
	}
}
//setter
	public function setaccount($account)
	{
		$this->account = $account;
	}
	public function setserial1_type($serial1_type)
	{
		$this->serial1_type = $serial1_type;
	}
	public function setserial1_model($serial1_model)
	{
		$this->serial1_model = $serial1_model;
	}
	public function setserial1_prefix($serial1_prefix)
	{
		$this->serial1_prefix = $serial1_prefix;
	}
	public function setserial1_prefixlength($serial1_prefixlength)
	{
		$this->serial1_prefixlength = $serial1_prefixlength;
	}
	public function setserial1_length($serial1_length)
	{
		$this->serial1_length = $serial1_length;
	}
	public function setserial2_type($serial2_type)
	{
		$this->serial2_type = $serial2_type;
	}
	public function setserial2_model($serial2_model)
	{
		$this->serial2_model = $serial2_model;
	}
	public function setserial2_prefix($serial2_prefix)
	{
		$this->serial2_prefix = $serial2_prefix;
	}
	public function setserial2_prefixlength($serial2_prefixlength)
	{
		$this->serial2_prefixlength = $serial2_prefixlength;
	}
	public function setserial2_length($serial2_length)
	{
		$this->serial2_length = $serial2_length;
	}
	public function setserial2Reg($serial2Reg)
	{
		$this->serial2Reg = $serial2Reg;
	}
	public function setstation($station)
	{
		$this->station = $station;
	}
	public function setlastupdatedBy($lastupdatedBy)
	{
		$this->lastupdatedBy = $lastupdatedBy;
	}


//getter

	public function getaccount()
	{
		return $this->account;
	}
	public function getserial1_type()
	{
		return $this->serial1_type;
	}
	public function getserial1_model()
	{
		return $this->serial1_model;
	}
	public function getserial1_prefix()
	{
		return $this->serial1_prefix;
	}
	public function getserial1_prefixlength()
	{
		return $this->serial1_prefixlength;
	}
	public function getserial1_length()
	{
		return $this->serial1_length;
	}
	public function getserial2_type()
	{
		return $this->serial2_type;
	}
	public function getserial2_model()
	{
		return $this->serial2_model;
	}
	public function getserial2_prefix()
	{
		return $this->serial2_prefix;
	}
	public function getserial2_prefixlength()
	{
		return $this->serial2_prefixlength;
	}
	public function getserial2_length()
	{
		return $this->serial2_length;
	}
	public function getserial2Reg()
	{
		return $this->serial2Reg;
	}
	public function getstation()
	{
		return $this->station;
	}
	public function getlastupdatedBy()
	{
		return $this->lastupdatedBy;
	}


	public static function checkExist($account,$serial1_model){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card_link where account ='".$account."' and serial1_model = '".$serial1_model."'");

			if($conn->has_rows($dataset)){
				
				$result = 'true';
							
			}else{
				$result = 'false';
			}	
			
			$conn->close();
		}catch(Exception $e){

		}
		return $result;
	}

	public static function checkExist2($account,$serial1_model,$serial2_model){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card_link where account ='".$account."' and serial1_model = '".$serial1_model."' and serial2_model = '".$serial2_model."'");

			if($conn->has_rows($dataset)){
				
				$result = 'true';
							
			}else{
				$result = 'false';
			}	
			
			$conn->close();
		}catch(Exception $e){

		}
		return $result;
	}

	public static function checksnformat($account,$serial1_model,$serial2_model,$serial1_prefix,$serial1_length,$serial2_prefix,$serial2_length){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.card_link where account ='".$account."' and serial1_model = '".$serial1_model."' and serial2_model = '".$serial2_model."' and serial1_prefix = '".$serial1_prefix."' and serial1_length = '".$serial1_length."' and serial2_prefix = '".$serial2_prefix."' and serial2_length = '".$serial2_length."'");

			if($conn->has_rows($dataset)){
				
				$result = 'true';
							
			}else{
				$result = 'false';
			}	
			
			$conn->close();
		}catch(Exception $e){

		}
		return $result;
	}

	public static function getAllmodellink($account,$serial1_model) {

    $conn = new connection();
    $model = array();
    try{

      $conn->open();
      $models = $conn->query("SELECT * from dbo.card_link where account ='".$account."' and serial1_model = '".$serial1_model."'");

      $count = 0;

      while($row=$conn->fetch_array($models)){

        $mod = new Check;

        
        $mod->setserial2_model($row['serial2_model']);
        $model[$count] = $mod;
        $count++;
      } 

      $conn->close();

    }
    catch(Exception $e){

    }
    return $model;
  }
  public static function getAllmodel($account) {

    $conn = new connection();
    $model = array();
    try{

      $conn->open();
      $models = $conn->query("SELECT distinct(serial1_model) from dbo.card_link where account ='".$account."'");

      $count = 0;

      while($row=$conn->fetch_array($models)){

        $mod = new Check;

        
        $mod->setserial1_model($row['serial1_model']);
        $model[$count] = $mod;
        $count++;
      } 

      $conn->close();

    }
    catch(Exception $e){

    }
    return $model;
  }

  public function CheckModel2($account,$serial1_model,$serial2_prefix,$serial2_length) 
  {
    $conn = new connection();
    try{
      $conn->open();
      $feed = $conn->query("SELECT * from dbo.card_link where account ='".$account."' and serial1_model = '".$serial1_model."' and serial2_prefix = '".$serial2_prefix."' and serial2_length = '".$serial2_length."'");
      if ($conn->has_rows($feed)>0)
      {
        $row = $conn->fetch_array($feed);

        $this->setserial2_model($row["serial2_model"]);
     
      }
    }
    catch(Exception $e){

    }
  }
	

}
?>