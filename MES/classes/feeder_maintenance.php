<?php 
include_once("connection.php"); 

class Maintenance {

  private $id;
  private $feederId;
  private $feederType;
  private $feederSize;
  private $plantNoFeeder;
  private $lastupdatedBy;
  private $lastupdate;
  private $description;
  private $process;
  private $feederPn;
  private $feederDescription;
  private $mode;
  private $line; 
  private $status;



function __construct($id='',$mode=''){

    if($mode=='id')
    {
        if(strlen($id)!=0){
          $conn = new connection();
          try{
            $conn->open();
            $dataset = $conn->query("SELECT * FROM dbo.feeder WHERE feederId = '".$id."'");

            if($conn->has_rows($dataset)){
              $reader = $conn->fetch_array($dataset);

              $this->setfeederId($reader["feederId"]);
              $this->setfeederType($reader["feederType"]);
              $this->setfeederSize($reader["feederSize"]);
              $this->setplantNoFeeder($reader["plantNoFeeder"]);
              $this->setline($reader["line"]);

            }
            $conn->close();
          }catch(Exception $e){

          }
      }
    }
    
    else if($mode=="parts")
    {
        if(strlen($id)!=0){
          $conn = new connection();
          try{
            $conn->open();
            $dataset = $conn->query("SELECT * FROM dbo.feederpart WHERE feederPn = '".$id."'");

            if($conn->has_rows($dataset)){
              $reader = $conn->fetch_array($dataset);

              $this->setfeederPn($reader["feederPn"]);
              $this->setfeederType($reader["feederType"]);
              $this->setfeederSize($reader["feederSize"]);
              $this->setfeederDescription($reader["feederDescription"]);

            }
            $conn->close();
          }catch(Exception $e){

          }
      }
    }

    else if($mode=='inquiry')
    {
        if(strlen($id)!=0){
          $conn = new connection();
          try{
            $conn->open();
            $dataset = $conn->query("SELECT * FROM dbo.feeder WHERE feederId = '".$id."'");

            if($conn->has_rows($dataset)){
              $reader = $conn->fetch_array($dataset);
              $this->setfeederId($reader["feederId"]);
              $this->setfeederType($reader["feederType"]);
              $this->setfeederSize($reader["feederSize"]);
              $this->setplantNoFeeder($reader["plantNoFeeder"]);
              $this->setline($reader["line"]);
              $this->setstatus($reader["status"]);
              $dataset1= $conn->query("SELECT * FROM dbo.feederstation WHERE station = '".$reader["process"]."'");
              if($conn->has_rows($dataset1)){
                $reader1 = $conn->fetch_array($dataset1);
                $this->setfeederDescription($reader1["description"]);
              }
            }
            
            $conn->close();
          }catch(Exception $e){

          }
      }
    }
    
  
  }
//setter

  public function setfeederId($feederId)
  {
    $this->feederId = $feederId; 
  }
  public function setid($id)
  {
    $this->id = $id; 
  }
  public function setmode($mode)
  {
    $this->mode = $mode; 
  }

  public function setstatus($status)
  {
    $this->status = $status; 
  }

  public function setfeederType($feederType)
  {
    $this->feederType = $feederType;
  }
  public function setplantNoFeeder($plantNoFeeder)
  {
    $this->plantNoFeeder = $plantNoFeeder;
  }
  public function setlastupdatedBy($lastupdatedBy)
  {
    $this->lastupdatedBy = $lastupdatedBy;
  }
  public function setfeederSize($feederSize)
  {
    $this->feederSize = $feederSize;
  }
  public function setlastupdate($lastupdate)
  {
    $this->lastupdate = $lastupdate;
  }
  public function setdescription($description)
  {
    $this->description = $description;
  }
  public function setprocess($process)
  {
    $this->process = $process;
  }
  public function setfeederPn($feederPn)
  {
    $this->feederPn = $feederPn; 
  }
  public function setfeederDescription($feederDescription)
  {
    $this->feederDescription = $feederDescription; 
  }
  public function setline($line)
  {
    $this->line = $line; 
  }


//getter

  public function getfeederId()
  {
    return $this->feederId;
  }

  public function getid()
  {
    return $this->id;
  }
   public function getmode()
  {
    return $this->mode;
  }

  public function getstatus()
  {
    return $this->status;
  }

  public function getfeederType()
  {
    return $this->feederType;
  }
  public function getplantNoFeeder()
  {
    return $this->plantNoFeeder;
  }
  public function getlastupdatedBy()
  {
    return $this->lastupdatedBy;
  }
  public function getfeederSize()
  {
    return $this->feederSize;
  }
  public function getlastupdate()
  {
    return $this->lastupdate;
  }
  public function getdescription()
  {
    return $this->description;
  }
  public function getprocess()
  {
    return $this->process;
  }
  public function getfeederPn()
  {
    return $this->feederPn;
  }
  public function getfeederDescription()
  {
    return $this->feederDescription;
  }
  public function getline()
  {
    return $this->line;
  }


  public function Select($feederId) 
  {
    $conn = new connection();
    try{
      $conn->open();
      $feed = $conn->query("SELECT * from dbo.feederHist where feederId='".$this->getfeederId()."'");
      if ($conn->has_rows($feed)>0)
      {
        $row = $conn->fetch_array($feed);

        $this->setfeederId($row["feederId"]);
        $this->setfeederType($row["feederType"]);
        $this->setplantNoFeeder($row["plantNoFeeder"]);
      }
    }
    catch(Exception $e){

    }
  }

  public function InsertInfo()
  {
    $conn = new connection();
  

    try{
      $conn->open();
      $feed = $conn->query("SELECT * from dbo.feederId where feederId='".$this->getfeederId()."'");

      if ($conn->has_rows($feed)>0){

        
        echo "Already exist";
      }
      else
      {
        $conn->query("INSERT INTO dbo.feederId VALUES('".$this->getfeederId()."','".$this->getfeederType()."','".$this->getfeederSize()."','".$this->getplantNoFeeder()."',1,'".$this->getlastupdatedBy()."',getdate())");
        echo "Success";
      }

      
      
      
      $conn->close();
      
    }catch(Exception $e){

    }
  }
  public function FeederInfo()
  {
    $conn = new connection();
  

    try{
      $conn->open();
      $feed = $conn->query("SELECT * from dbo.feederInfo where feederType='".$this->getfeederType()."'");

      if ($conn->has_rows($feed)>0){

        
        echo "Already exist";
      }
      else
      {
        $conn->query("INSERT INTO dbo.feederInfo VALUES('".$this->getfeederType()."','',1,'".$this->getlastupdatedBy()."',getdate())");
      }

      
      
      
      $conn->close();
      
    }catch(Exception $e){

    }
  }
  public static function getAllFeeder() {
    $conn = new connection();
    $feeder = array();

    try{

      $conn->open();
      $feeders = $conn->query("SELECT * from dbo.feeder");

      $count = 0;

      while($row=$conn->fetch_array($feeders)){

        $feed = new Insert;

        $feed->setfeederId($row['feederId']);
        $feed->setfeederType($row['feederType']);
        $feed->setfeederSize($row['feederSize']);
        $feed->setplantNoFeeder($row['plantNoFeeder']);

        $feeder[$count] = $feed;
        $count++;
      } 

      $conn->close();
    }
    catch(Exception $e){

    }
    return $feeder;
  }


  public static function getAllPlant() {

    $conn = new connection();
    $feeder = array();
    try{

      $conn->open();
      $feeders = $conn->query("SELECT * from dbo.feederplant");

      $count = 0;

      while($row=$conn->fetch_array($feeders)){

        $feed = new Insert;

        
        $feed->setplantNoFeeder($row['plantNoFeeder']);
        $feeder[$count] = $feed;
        $count++;



      } 

      $conn->close();

    }
    catch(Exception $e){

    }
    return $feeder;
  }
  public static function getStation() {

    $conn = new connection();
    $feeder = array();
    try{

      $conn->open();
      $feeders = $conn->query("SELECT * from dbo.feederstation where sequence !=0");

      $count = 0;

      while($row=$conn->fetch_array($feeders)){

        $feed = new Insert;

        
        $feed->setdescription($row['description']);
        $feeder[$count] = $feed;
        $count++;



      } 

      $conn->close();

    }
    catch(Exception $e){

    }
    return $feeder;
  }
  public static function getAllParts($fSize='',$fType='') {
    $conn = new connection();
    $feeder = array();

    try{

      $conn->open();
      $feeders = $conn->query("SELECT * from dbo.feederpart where feederSize='".$fSize."' and feederType ='".$fType."' order by feederDescription asc");

      $count = 0;

      while($row=$conn->fetch_array($feeders)){

        $feed = new Maintenance;

        $feed->setfeederPn($row['feederPn']);
        $feed->setfeederType($row['feederType']);
        $feed->setfeederSize($row['feederSize']);
        $feed->setfeederDescription($row['feederDescription']);

        $feeder[$count] = $feed;
        $count++;
      } 

      $conn->close();
    }
    catch(Exception $e){

    }
    return $feeder;
  }

  
  public function InsertParts($feederPn)
  {
    $conn = new connection();
  

    try{
      $conn->open();
      $feed = $conn->query("SELECT * from dbo.feederpart where feederPn='".$this->getfeederPn()."'");

      if ($conn->has_rows($feed)>0){

        echo "Already exist";
      }
      else
      {
        $conn->query("INSERT INTO dbo.feederpart VALUES('".$this->getfeederPn()."','".$this->getfeederType()."','".$this->getfeederSize()."','".$this->getfeederDescription()."','".$this->getlastupdatedBy()."',getdate())");
        echo $this->getfeederSize();
        
      }
      
      $conn->close();
      
    }catch(Exception $e){

    }
  }

  public function UpdateParts($feederPn)
  {
    $conn = new connection();
    try{

      echo $feederPn;
      echo $this->getfeederPn();
      $conn->open();
      $conn->query("UPDATE dbo.feederpart SET feederPn='".$feederPn."',feederType='".$this->getfeederType()."',feederSize='".$this->getfeederSize()."',feederDescription='".$this->getfeederDescription()."',lastupdatedBy='".$this->getlastupdatedBy()."',lastupdate=getdate() WHERE feederPn='".$this->getfeederPn()."'");
        
      
      $conn->close();
      
    }catch(Exception $e){

    }
    
  }

  public function FeederPartDetails($feederType,$feederSize){
  
  $conn = new Connection();

      try{
        $conn->open();
        $dataset = $conn->query("SELECT * FROM dbo.feederpart where feederType ='".$feederType."' and feederSize = '".$feederSize."'");

        if ($conn->has_rows($dataset)){
          $reader = $conn->fetch_array($dataset);

          $this->setfeederPn($reader['feederPn']);
        }
        $conn->close();
      }catch(Exception $e){

      }

  }

}
?> 