<?php

include_once("connection.php");

class Its_Report{

    private $trackingno;
    private $pcserial;
    private $itemserial;
    private $desc;
    private $status;
    private $lastupdate;
    private $lastupdatedby;



	public function __construct()
		{

		}


    //getters   
    public function setTrackingNo($trackingno){

        $this->trackingno = $trackingno;

    }

    public function setPcserial($pcserial){

        $this->pcserial =$pcserial;

    }
    
    public function setItemserial($itemserial){

        $this->itemserial = $itemserial;
    }
    
    public function setDesc($desc){

        $this->desc = $desc;
    }
    
    public function setStatus($status){

        $this->status = $status;
    }
    
    public function setLastupdate($lastupdate){

        $this->lastupdate = $lastupdate;

    }
    
    public function setLastupdatedby($lastupdatedby){
        
        $this->lastupdatedby = $lastupdatedby;

    }
    
    //getters

    public function getTrackingNo()
    {

        return $this->trackingno;

    }

    public function getPcserial()
    {
        return $this->pcserial;
    }

    public function getItemserial()
    {
        return $this->itemserial;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getLastupdate()
    {
        return $this->lastupdate;
    }

    public function getLastupdatedby()
    {
        return $this->lastupdatedby;
    }






    public static function getLogs(){
        $conn = new connection();
        $result = array();
        try{
            $conn->open();
            $query = $conn->query("SELECT * from dbo.its_log_pcitem order by lastupdate DESC");
            $counter =0;
            while($row = $conn->fetch_array($query)){
                $log = new Its_Report();
                $log->setTrackingNo($row['trackingno']);
                $log->setPcserial($row['pcserial']);
                $log->setItemserial($row['itemserial']);
                $log->setDesc($row['description']);
                $log->setStatus($row['status']);
                $log->setLastupdate($row['lastupdate']->format('Y-m-d h:i:s a'));
                $log->setLastupdatedby($row['lastupdatedby']);
                $result[$counter] = $log;
                $counter++;
            }
            $conn->close();

        }
        catch(Exception $e){

        }
        return $result;

    }

    public static function getTotalCount($filter){
        $conn = new connection();
        $count = "";
        try{
            $conn->open();
            $query = $conn->query("SELECT count(*) as Count from dbo.its_log_pcitem
                                   WHERE pcserial LIKE '%".$filter."%'");
            if($conn->has_rows($query)){
                $reader = $conn->fetch_array($query);
                $count = $reader['Count'];
            }
            $conn->close();
        }catch(Exception $e){

        }
        return $count;

    }






}





?>