<?php
include_once("connection.php");

class Partsrecords1{
	private $account;
	private $did;
	private $ipn;
	private $partno;
	private $description;
	private $maker;
	private $makercode;
	private $lotno;
	private $compotype;
	private $qty;
	private $status;
	private $printeddate;
	private $printedby;
	private $returned;
	private $remarks;
	private $model;
	private $line;
	private $issueddate;
	private $invoiceno;
	private $mounteddate;
	private $mountedby;
	private $issuedby;
	private $reason;
	private $thawdate;
	private $expdate;




	function __construct($account='',$did=''){
		
		if(strlen($did)>0){
		$conn = new Connection();

		try{

			$conn->open();
			$dataset = $conn->query("SELECT * FROM dbo.kanban_partsrecords where account ='".$account."' and DID = '".$did."'");

			if ($conn->has_rows($dataset)){
				$reader = $conn->fetch_array($dataset);

				 $this->setDID($reader['DID']);
			    $this->setIPN($reader['IonicsPN']);
			    $this->setPartNo($reader['Partno']);
			    $this->setDescription($reader['Description']);
			    $this->setMaker($reader['Maker']);
			    $this->setMakercode($reader['Makercode']);
			    $this->setLotno($reader['Lotno']);
			    $this->setCompotype($reader['Compotype']);
			    $this->setQty($reader['Qty']);
			    $this->setStatus($reader['Status']);
			    $this->setPrinteddate($reader['Printeddate']);
			    $this->setPrintedby($reader['Printedby']);
			    $this->setInvoiceno($reader['Invoiceno']);
			    $this->setModel($reader['Model']);
				$this->setLine($reader['Line']);
			}

			$conn->close();
		}catch(Exception $e){

		}
	}

	}

	//setter

	public function setAccount($account)
	{
		$this->account = $account;
	}
	public function setDID($did)
	{
		$this->did = $did;
	}

	public function setIPN($ipn)
	{
		$this->ipn = $ipn;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function setMaker($maker)
	{
		$this->maker = $maker;
	}

	public function setMakercode($makercode)
	{
		$this->makercode = $makercode;
	}

	public function setLotno($lotno)
	{
		$this->lotno = $lotno;
	}
	public function setCompotype($compotype)
	{
		$this->compotype = $compotype;
	}

	public function setQty($qty)
	{
		$this->qty = $qty;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function setPrinteddate($printeddate)
	{
		$this->printeddate = $printeddate;
	}

	public function setPrintedby($printedby)
	{
		$this->printedby = $printedby;
	}
	public function setReturned($returned)
	{
		$this->returned = $returned;
	}

	public function setRemarks($remarks)
	{
		$this->remarks = $remarks;
	}

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function setInvoiceno($invoiceno)
	{
		$this->invoiceno = $invoiceno;
	}

	public function setPartno($partno)
	{
		$this->partno = $partno;
	}

	public function setIssueddate($issueddate)
	{
		$this->issueddate = $issueddate;
	}

	public function setMounteddate($mounteddate)
	{
		$this->mounteddate = $mounteddate;
	}

	public function setLine($line)
	{
		$this->line = $line;
	}

	public function setMountedby($mountedby)
	{
		$this->mountedby = $mountedby;
	}

	public function setIssuedby($issuedby)
	{
		$this->issuedby = $issuedby;
	}

	public function setReason($reason)
	{
		$this->reason = $reason;
	}

	public function setThawdate($thawdate)
	{
		$this->thawdate = $thawdate;
	}

	public function setExpdate($expdate)
	{
		$this->expdate = $expdate;
	}


	//Getter
	public function getAccount()
	{
		return $this->account;
	}
	public function getDID()
	{
		return $this->did;
	}
	public function getIPN()
	{
		return $this->ipn;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getMaker()
	{
		return $this->maker;
	}
	public function getMakercode()
	{
		return $this->makercode;
	}
	public function getLotno()
	{
		return $this->lotno;
	}
	public function getCompotype()
	{
		return $this->compotype;
	}

	public function getQty()
	{
		return $this->qty;
	}

	public function getStatus()
	{
		return $this->status;
	}
	public function getPrinteddate()
	{
		return $this->printeddate;
	}
	public function getPrintedby()
	{
		return $this->printedby;
	}
	public function getReturned()
	{
		return $this->returned;
	}

	public function getRemarks()
	{
		return $this->remarks;
	}

	public function getModel()
	{
		return $this->model;
	}
	public function getInvoiceno()
	{
		return $this->invoiceno;
	}

	public function getPartno()
	{
		return $this->partno;
	}

	public function getIssueddate()
	{
		return $this->issueddate;
	}

	public function getMounteddate()
	{
		return $this->mounteddate;
	}

	public function getLine()
	{
		return $this->line;
	}

	public function getIssuedby()
	{
		return $this->issuedby;
	}

	public function getMountedby()
	{
		return $this->mountedby;
	}

	public function getReason()
	{
		return $this->reason;
	}
	
	public function getThawdate()
	{
		return $this->thawdate;
	}

	public function getExpdate()
	{
		return $this->expdate;
	}


	// functions

	public function issuePart()
	{
		$success = true;
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.kanban_partsrecords SET Status  = '".$this->getStatus()."', Line  = '".$this->getLine()."', Model = '".$this->getModel()."', Issueddate = GETDATE(), Issuedby = '".$this->getIssuedby()."' WHERE DID  = '".$this->getDID()."'");

			$conn->close();
		}
		catch(Exception $e){
			$success = false;
		}
		return $success;
	}

	public function returnPart()
	{
		$success = true;
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.kanban_partsrecords SET Status  = '".$this->getStatus()."', Returned = '".$this->getReturned()."', Reason = '".$this->getReason()."', Qty ='".$this->getQty()."' WHERE DID  = '".$this->getDID()."'");

			$conn->close();
		}
		catch(Exception $e){
			$success = false;
		}
		return $success;
	}

	public function registerPart()
	{
		$success = true;
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.kanban_partsrecords VALUES( 
								'".$this->getAccount()."',
								'".$this->getDID()."',
								'".$this->getIPN()."',
								'".$this->getPartno()."',
								'".$this->getDescription()."',
								'".$this->getMaker()."',
								'".$this->getMakercode()."',
								'".$this->getLotno()."',
								'".$this->getCompotype()."',
								'".$this->getQty()."',
								'".$this->getStatus()."',
									GETDATE(),
								'".$this->getPrintedby()."',
								'".$this->getReturned()."',
								'".$this->getLine()."',
								'".$this->getModel()."',
								'".$this->getInvoiceno()."',
								0,
								0,
								'".$this->getIssuedby()."',
								'".$this->getMountedby()."',
								'',
								0,
								0)");

			$conn->close();
		}
		catch(Exception $e){
			$success = false;
		}
		return $success;
	}

	public function registerPartlogs(){
		$success = true;
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.kanban_partslogs VALUES( 
								'".$this->getDID()."',
								'".$this->getIPN()."',
								'".$this->getDescription()."',
								'".$this->getQty()."',
								'".$this->getStatus()."','',
								'".$this->getLine()."','',GETDATE(),
								'".$this->getPrintedby()."',
								'".$this->getLotno()."')");

			$conn->close();
		}
		catch(Exception $e){
			$success = false;
		}
		return $success;
	}


public function didInfo($did)
	{
		$conn = new connection();

		try{
			$conn->open();
			$myquery = $conn->query("SELECT * from dbo.kanban_partsrecords WHERE DID = '".$did."' order by ControlID desc");
			
			if ($conn->has_rows($myquery)>0){
			    $reader = $conn->fetch_array($myquery);
			    $this->setDID($reader['DID']);
			    $this->setIPN($reader['IonicsPN']);
			    $this->setPartNo($reader['Partno']);
			    $this->setDescription($reader['Description']);
			    $this->setMaker($reader['Maker']);
			    $this->setMakercode($reader['Makercode']);
			    $this->setLotno($reader['Lotno']);
			    $this->setCompotype($reader['Compotype']);
			    $this->setQty($reader['Qty']);
			    $this->setStatus($reader['Status']);
			    $this->setPrinteddate($reader['Printeddate']);
			    $this->setPrintedby($reader['Printedby']);
			    $this->setInvoiceno($reader['Invoiceno']);
			    $this->setModel($reader['Model']);
				$this->setLine($reader['Line']);
			}
			
			$conn->close();
			}
		catch(Exception $e){

		}
		
	}

	//for checking if exist
	public static function didCheck($account, $did)
	{
		$conn = new Connection;
		$result = 'false';

		try {
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.kanban_partsrecords WHERE Account = '".$account."' AND DID = '".$did."'");

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

	public static function partCheck($account, $did, $partno)
	{
		$conn = new Connection;
		$result = 'false';

		try {
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.kanban_partsrecords WHERE Account = '". $account ."' AND DID = '". $did ."'");

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

	//for checking if status is in PDN
	public static function checkPart($account, $did)
	{
		$conn = new Connection;
		$result = 'false';

		try {
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.kanban_partsrecords WHERE Account = '". $account ."' AND DID = '". $did ."' AND Status = 'PDN'");

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


	//for checking if status is in WHS
	public static function checkPartReturned($account, $did)
	{
		$conn = new Connection;
		$result = 'false';

		try {
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.kanban_partsrecords WHERE Account = '". $account ."' AND DID = '".$did."' AND Status ='WHS'");

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

	public static function getAllReason()
	{
		$conn = new Connection;
		$reasons = array();

		try {
			$conn->open();

			$sql = "SELECT * FROM dbo.kanban_reason";
			$query = $conn->query($sql);
			$counter = 0;

			while ($row = $conn->fetch_array($query)) {
				$reason = new Partsrecords;
				$reason->setReason($row['reason']);
				$reasons[$counter] = $reason;

				$counter++;
			}

			$conn->close();
			
		} catch (Exception $e) {
			
		}

		return $reasons;

	}


	public static function modelSequence($account) {
		$conn = new Connection;
		$model = array();

		try {
			$conn->open();

			$query = $conn->query("SELECT DISTINCT * FROM dbo.KSEQUENCE_HEADER WHERE KSACCOUNT = '". $account ."'");
			$count = 0;

			while ($row = $conn->fetch_array($query)) {
				$models = new Partsrecords;
				$models->setModel($row['KSQMODEL']);
				$model[$count] = $models;

				$count++;
			}

			$conn->close();
		} catch (Exception $e) {
			
		}

		return $model;

	}



	
}

?>

