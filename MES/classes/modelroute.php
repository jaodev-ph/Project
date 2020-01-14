<?php
include_once("connection.php");

class ModelRoute{

	private $account;
	private $modelno;
	private $flowsequence;
	private $station;
	private $active;
	private $skip;
	private $forcardlink;
	private $laststation;
	private $linestop;
	private $lastupdatedby;
	private $forlotmaking;
	private $fa;
	private $forqasoba;
	private $forpacking;

	function __construct($station = ''){

		
	}


	//Setter
	public function setAccount($account){
		$this->account = $account;
	}

	public function setModelNo($modelno){
		$this->modelno = $modelno;
	}

	public function setFlowsequence($flowsequence){
		$this->flowsequence = $flowsequence;
	}


	public function setStation($station){
		$this->station = $station;
	}

	
	public function setActive($active){
		$this->active = $active;
	}

	public function setSkip($skip){
		$this->skip = $skip;
	}

	public function setForCardLink($forcardlink){
		$this->forcardlink = $forcardlink;
	}

	public function setLastStation($laststation){
		$this->laststation = $laststation;
	}

	public function setLineStop($linestop){
		$this->linestop = $linestop;
	}

	public function setLastUpdatedBy($lastupdatedby){
		$this->lastupdatedby = $lastupdatedby;
	}

	public function setForLotMaking($forlotmaking){
		$this->forlotmaking = $forlotmaking;
	}

	public function setFA($fa){
		$this->fa = $fa;
	}

	public function setForqasoba($forqasoba){
		$this->forqasoba = $forqasoba;
	}

	public function setForpacking($forpacking){
		$this->forpacking = $forpacking;
	}



	//Getter
	public function getAccount(){
		return $this->account;
	}

	public function getModelNo(){
		return $this->modelno;
	}

	public function getFlowsequence(){
		return $this->flowsequence;
	}

	public function getStation(){
		return $this->station;
	}

	public function getActive(){
		return $this->active;
	}

	public function getSkip(){
		return $this->skip;
	}


	public function getForCardLink(){
		return $this->forcardlink;
	}


	public function getLastStation(){
		return $this->laststation;
	}

	public function getLineStop(){
		return $this->linestop;
	}

	public function getLastUpdatedBy(){
		return $this->lastupdatedby;
	}

	public function getForLotMaking(){
		return $this->forlotmaking;
	}

	public function getFA(){
		return $this->fa;
	}

	public function getForqasoba(){
		return $this->forqasoba;
	}

	public function getForpacking(){
		return $this->forpacking;
	}


	public static function getFlowsequences($account,$station,$modelno){
		
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * from dbo.modelroute where account ='".$account."' and active = 1 and modelno ='".$modelno."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				$Select = new ModelRoute();
				$Select->setFlowsequence($reader['flowsequence']);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;

	}

	public static function PassModelRoute($account,$modelno){
		
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * from dbo.modelroute where account ='".$account."' and active = 1 and modelno ='".$modelno."'  order by flowsequence");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				$Select = new ModelRoute();
				$Select->setStation($reader['station']);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;

	}

	public static function PassModelRoute2($account,$modelno){
		
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT station from dbo.link_maintenance where account ='".$account."' and active = 1 and groupname ='".$modelno."' group by station");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				$Select = new ModelRoute();
				$Select->setStation($reader['station']);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;

	}

		public static function PassModelRoute3($account,$modelno){
		
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * from dbo.modelroute where account ='".$account."' and active = 1 and modelno ='".$modelno."' and station = '007' order by flowsequence");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){

				$Select = new ModelRoute();
				$Select->setStation($reader['station']);
				$result[$counter] = $Select;
				$counter++;
			}
					
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;

	}

	public function getStationDetails(){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.modelroute where account ='".$this->getAccount()."' and station = '".$this->getStation()."' and active ='1'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setAccount($reader['account']);
					$this->setModelNo($reader['modelno']);
					$this->setFlowsequence($reader['flowsequence']);
					$this->setStation($reader['station']);
					$this->setActive($reader['active']);
					$this->setSkip($reader['skip']);
					$this->setForCardLink($reader['forcardlink']);
					$this->setLastStation($reader['laststation']);
					$this->setLineStop($reader['linestop']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
					$this->setForLotMaking($reader['forlotmaking']);
					$this->setFA($reader['fa']);
					$this->setForqasoba($reader['forqasoba']);
					$this->setForpacking($reader['forpacking']);

				}
				$conn->close();
			}catch(Exception $e){

			}

	}

	public function getStationDetails2(){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.modelroute where account ='".$this->getAccount()."' and station = '".$this->getStation()."' and modelno = '".$this->getModelNo()."' and active ='1'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setAccount($reader['account']);
					$this->setModelNo($reader['modelno']);
					$this->setFlowsequence($reader['flowsequence']);
					$this->setStation($reader['station']);
					$this->setActive($reader['active']);
					$this->setSkip($reader['skip']);
					$this->setForCardLink($reader['forcardlink']);
					$this->setLastStation($reader['laststation']);
					$this->setLineStop($reader['linestop']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
					$this->setForLotMaking($reader['forlotmaking']);
					$this->setFA($reader['fa']);
					$this->setForqasoba($reader['forqasoba']);
					$this->setForpacking($reader['forpacking']);

				}
				$conn->close();
			}catch(Exception $e){

			}

	}


	public function modelDetails(){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.modelroute where account ='".$this->getAccount()."' and station = '".$this->getStation()."' and modelno = '".$this->getModelNo()."' and active ='1'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setAccount($reader['account']);
					$this->setModelNo($reader['modelno']);
					$this->setFlowsequence($reader['flowsequence']);
					$this->setStation($reader['station']);
					$this->setActive($reader['active']);
					$this->setSkip($reader['skip']);
					$this->setForCardLink($reader['forcardlink']);
					$this->setLastStation($reader['laststation']);
					$this->setLineStop($reader['linestop']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
					$this->setForLotMaking($reader['forlotmaking']);
					$this->setFA($reader['fa']);
					$this->setForpacking($reader['forpacking']);
				}
				$conn->close();
			}catch(Exception $e){

			}

	}


	public function getnextstage($account,$model,$flowsequence){
		$conn = new Connection();
		$nextstage = '';
		try{
			$conn->open();

			$dataset = $conn->query("SELECT * FROM dbo.station WHERE sequence = (
									 SELECT MIN(flowsequence) 
									 FROM dbo.modelRoute 
									 WHERE account ='".$account."' and modelno = '".$model."' 
									 AND active = 1 
									 AND flowsequence > ".$flowsequence.") AND account = '".$account."'");

				if($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
					$nextstage = $reader['station']. ": " .$reader['description'];
				}

			$conn->close();
		}catch(Exception $e){

		}
		return $nextstage;
	}


	public function getnextstage1($account,$model,$flowsequence){
		$conn = new Connection();
		$nextstage = '';
		try{
			$conn->open();

			$dataset = $conn->query("SELECT * FROM dbo.modelroute a inner join dbo.station b on a.station = b.station
									AND a.account = b.account WHERE a.flowsequence = (
									 SELECT MIN(flowsequence) 
									 FROM dbo.modelroute 
									 WHERE account ='".$account."' and modelno = '".$model."'  
									 AND active = 1 
									 AND flowsequence > ".$flowsequence.") AND a.account = '".$account."' and a.modelno = '".$model."'");

				if($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
					$nextstage = $reader['station']. ": " .$reader['description'];
				}

			$conn->close();
		}catch(Exception $e){

		}
		return $nextstage;
	}

		public function getpreviousstage($account,$model,$flowsequence){
		$conn = new Connection();
		$nextstage = '';
		try{
			$conn->open();

			$dataset = $conn->query("SELECT * FROM dbo.station WHERE sequence = (
									 SELECT MIN(flowsequence) 
									 FROM dbo.modelRoute 
									 WHERE account ='".$account."' and modelno = '".$model."' 
									 AND active = 1 
									 AND flowsequence > ".$flowsequence." - 1) AND account = '".$account."'");

				if($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
					$nextstage = $reader['station'];
				}

			$conn->close();
		}catch(Exception $e){

		}
		return $nextstage;
	}

		public function getpreviousstage1($account,$model,$flowsequence){
		$conn = new Connection();
		$nextstage = '';
		try{
			$conn->open();

			$dataset = $conn->query("SELECT * FROM dbo.station WHERE sequence = (
									 SELECT MIN(flowsequence) 
									 FROM dbo.modelRoute 
									 WHERE account ='".$account."' and modelno = '".$model."' 
									 AND active = 1 
									 AND flowsequence = ".$flowsequence." - 1) AND account = '".$account."'");

				if($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
					$nextstage = $reader['station'];
				}

			$conn->close();
		}catch(Exception $e){

		}
		return $nextstage;
	}


			public function getpreviousstage2($account,$model,$flowsequence){
		$conn = new Connection();
		$previousstage = '';
		try{
			$conn->open();

			$dataset = $conn->query("SELECT * FROM dbo.modelRoute a inner join dbo.station b on a.station = b.station
									AND a.account = b.account WHERE a.flowsequence = (
									 SELECT MIN(flowsequence) 
									 FROM dbo.modelRoute 
									 WHERE account ='".$account."' and modelno = '".$model."'  
									 AND active = 1 
									 AND flowsequence = ".$flowsequence." -1) AND a.account = '".$account."' and a.modelno = '".$model."'");

				if($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
					$previousstage = $reader['station'];
				}

			$conn->close();
		}catch(Exception $e){

		}
		return $previousstage;
	}


	public static function isvalidnextstage($account,$model, $curtstage, $nextstage){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();

				$dataset = $conn->query("SELECT * FROM dbo.modelroute WHERE account ='".$account."' AND modelno = '".$model."' AND active = 1 AND flowsequence BETWEEN ".($curtstage+1)." AND ".($nextstage-1)." ORDER BY flowsequence");
				
				if($conn->has_rows($dataset)){
				while($reader = $conn->fetch_array($dataset))
				{
					if($reader['skip']==0){
						$conn->close();
						return 'false';
					}
					$result = 'true';
				}
				}else{
					$result = 'false';
				}
				
			
		}catch(Exception $e){

		}
		return $result;
	}

	public static function isvalidnextstage2($account,$model, $curtstage, $nextstage){
		$conn = new Connection();
		$result = 'false';

		try{
			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.modelroute WHERE account ='".$account."' AND modelno = '".$model."' AND active = 1 AND flowsequence BETWEEN ".($curtstage+1)." AND ".($nextstage)." ORDER BY flowsequence");
			if($conn->has_rows($dataset)){
				while($reader = $conn->fetch_array($dataset)){
					if($reader['flowsequence']==$nextstage){
						$conn->close();
						return 'true';
					}elseif($reader['skip']==0){
						$conn->close();
						return 'false';
					}
				}
			}else{
				$result = 'false';
			}
		}catch(Exception $e){

		}
		return $result;
	}

	public static function getBeforeStations($account, $model, $stage){
		$conn = new Connection();
		try{
			$conn->open();
			$dataset = $conn->query("SELECT a.station, b.description FROM modelRoute a
								   inner join station b on a.station = b.station WHERE b.account = '".$account."' AND a.modelno = '".$model."' AND a.active = 1 AND a.flowsequence <= '".$stage."' AND a.flowsequence > 1 ORDER BY a.flowsequence");
			$counter = 0;
			while($rows = $conn->fetch_array($dataset))
			{
				$station = new ModelRoute();
				$stationdesc = $rows['station'] . ":" . $rows['description'];
				$station->setStation($stationdesc);
				$stations[$counter]=$station;
				$counter = $counter + 1;
			}
			$conn->close();
		}catch(Exception $e){

		}
		return $stations;
	}

public function getCurrentStation($account,$model,$stage){
		$conn = new Connection();
		$stage1 = '';
		try{
			$conn->open();

			$dataset = $conn->query("SELECT a.station, b.description FROM modelRoute a
							inner join station b on a.station = b.station 
							WHERE b.account = '".$account."' 
							AND 
							a.modelno = '".$model."' 
							AND a.active = 1 
							AND a.station = '".$stage."'");

				if($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);
					$stage1 = $reader['station']. ": " .$reader['description'];
				}

			$conn->close();
		}catch(Exception $e){

		}
		return $stage1;
	}


	public static function forFA($account,$station,$modelno){
	$result = 'false';
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.modelroute where account ='".$account."' and station = '".$station."' and modelno = '".$modelno."' and active ='1'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);	
					if($reader['fa'] == 1){
						$result = 'true';
					}else{
						$result = 'false';
					}				
				}

				$conn->close();
			}catch(Exception $e){

			}
			return $result;
	}



	public function getLotStation(){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.modelroute where account ='".$this->getAccount()."' and modelno = '".$this->getModelNo()."' and active ='1' and forlotmaking = '1'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setAccount($reader['account']);
					$this->setModelNo($reader['modelno']);
					$this->setFlowsequence($reader['flowsequence']);
					$this->setStation($reader['station']);
					$this->setActive($reader['active']);
					$this->setSkip($reader['skip']);
					$this->setForCardLink($reader['forcardlink']);
					$this->setLastStation($reader['laststation']);
					$this->setLineStop($reader['linestop']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
					$this->setForLotMaking($reader['forlotmaking']);
					$this->setFA($reader['fa']);
					$this->setForpacking($reader['forpacking']);

				}
				$conn->close();
			}catch(Exception $e){

			}

	}


	public function getQASOBAstation(){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.modelroute where account ='".$this->getAccount()."' and modelno = '".$this->getModelNo()."' and active ='1' and forqasoba = '1'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setAccount($reader['account']);
					$this->setModelNo($reader['modelno']);
					$this->setFlowsequence($reader['flowsequence']);
					$this->setStation($reader['station']);
					$this->setActive($reader['active']);
					$this->setSkip($reader['skip']);
					$this->setForCardLink($reader['forcardlink']);
					$this->setLastStation($reader['laststation']);
					$this->setLineStop($reader['linestop']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
					$this->setForLotMaking($reader['forlotmaking']);
					$this->setFA($reader['fa']);
					$this->setForpacking($reader['forpacking']);

				}
				$conn->close();
			}catch(Exception $e){

			}

	}

		public function getLinkStation(){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.modelroute where account ='".$this->getAccount()."' and modelno = '".$this->getModelNo()."' and active ='1' and forcardlink = '1'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setAccount($reader['account']);
					$this->setModelNo($reader['modelno']);
					$this->setFlowsequence($reader['flowsequence']);
					$this->setStation($reader['station']);
					$this->setActive($reader['active']);
					$this->setSkip($reader['skip']);
					$this->setForCardLink($reader['forcardlink']);
					$this->setLastStation($reader['laststation']);
					$this->setLineStop($reader['linestop']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
					$this->setForLotMaking($reader['forlotmaking']);
					$this->setFA($reader['fa']);
					$this->setForpacking($reader['forpacking']);

				}
				$conn->close();
			}catch(Exception $e){

			}

	}


		public function getPackingstation(){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM dbo.modelroute where account ='".$this->getAccount()."' and modelno = '".$this->getModelNo()."' and active ='1' and forpacking = '1'");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setAccount($reader['account']);
					$this->setModelNo($reader['modelno']);
					$this->setFlowsequence($reader['flowsequence']);
					$this->setStation($reader['station']);
					$this->setActive($reader['active']);
					$this->setSkip($reader['skip']);
					$this->setForCardLink($reader['forcardlink']);
					$this->setLastStation($reader['laststation']);
					$this->setLineStop($reader['linestop']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
					$this->setForLotMaking($reader['forlotmaking']);
					$this->setFA($reader['fa']);
					$this->setForpacking($reader['forpacking']);

				}
				$conn->close();
			}catch(Exception $e){

			}

	}


		public function getFirstStation(){
	
	$conn = new Connection();

			try{
				$conn->open();
				$dataset = $conn->query("SELECT * FROM [MES].[dbo].[modelroute] WHERE account = '".$this->getAccount()."'
  						AND modelno = '".$this->getModelNo()."' AND active = 1 AND flowsequence = (SELECT min(flowsequence)
       					FROM [MES].[dbo].[modelroute] WHERE account = '".$this->getAccount()."' AND modelno = '".$this->getModelNo()."' AND active = 1)");

				if ($conn->has_rows($dataset)){
					$reader = $conn->fetch_array($dataset);

					$this->setAccount($reader['account']);
					$this->setModelNo($reader['modelno']);
					$this->setFlowsequence($reader['flowsequence']);
					$this->setStation($reader['station']);
					$this->setActive($reader['active']);
					$this->setSkip($reader['skip']);
					$this->setForCardLink($reader['forcardlink']);
					$this->setLastStation($reader['laststation']);
					$this->setLineStop($reader['linestop']);
					$this->setLastUpdatedBy($reader['lastupdatedby']);
					$this->setForLotMaking($reader['forlotmaking']);
					$this->setFA($reader['fa']);
					$this->setForpacking($reader['forpacking']);

				}
				$conn->close();
			}catch(Exception $e){

			}

	}



		public static function getlotmaking($account,$model){
		$conn = new Connection();
		$result = false;
		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.modelroute WHERE account = '".$account."' AND modelno = '".$model."' AND forlotmaking = 1");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);
			$result = true;	
			}else{
			$result = false;
			}

			$conn->close();
		}catch(Exception $e){

		}

		return $result;

	}




}

	?>