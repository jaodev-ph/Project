<?php
include_once("connection.php");



class Its_PCitems{

    private $monitor;
    private $memory;
    private $hdd;
    private $keyboard;
    private $mouse;
    private $processor;


    //seetters
    public function setMonitor($monitor){

        $this->monitor = $monitor;

    }

    public function setMemory($memory){

        $this->memory = $memory;

    }

    public function setHdd($hdd){

        $this->hdd = $hdd;

    }

    public function setKeyboard($keyboard){

        $this->keyboard = $keyboard;

    }

    public function setMouse($mouse){

        $this->mouse = $mouse;

    }

    public function setProcessor($processor){
        
        $this->processor = $processor;

    }


    //getters

    public function getProcessor(){

        return $this->processor;

    }


    public function getMonitor(){

        return $this->monitor;

    }
    public function getMemory(){
        
        return $this->memory;

    }
    public function getHdd(){

        return $this->hdd;

    }

    public function getKeyboard()
    {
        return $this->keyboard;

    }

    public function getMouse(){
        
        return $this->mouse;

    }


       
    public  function getPCMouse($pcserial){
        $conn = new Connection();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_itemrecords where pcserial ='".$pcserial."' and type='Mouse'");
				if ($conn->has_rows($result)){
					$reader = $conn->fetch_array($result);
					
                    $this->setMouse($reader['model'] ." ". $reader['brand']);
                    
				}
				$conn->close();
			}catch(Exception $e){

			}
    }


    
    public  function getPCKeyboard($pcserial){
        $conn = new Connection();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_itemrecords where pcserial ='".$pcserial."' and type='Keyboard'");
				if ($conn->has_rows($result)){
					$reader = $conn->fetch_array($result);
					
                    $this->setKeyboard($reader['model'] ." ". $reader['brand']);
                    
				}
				$conn->close();
			}catch(Exception $e){

			}
    }



    public  function getPCMonitor($pcserial){
        $conn = new Connection();

        try{
            $conn->open();
            $result = $conn->query("SELECT * FROM dbo.its_itemrecords where pcserial ='".$pcserial."' and type='Monitor'");
            if ($conn->has_rows($result)){
                $reader = $conn->fetch_array($result);
                
                $this->setMonitor($reader['model'] ." ". $reader['brand']);
                
            }
            $conn->close();
        }catch(Exception $e){

        }

    }

    
    public  function getPCProcessor($pcserial){
        $conn = new Connection();

        try{
            $conn->open();
            $result = $conn->query("SELECT * FROM dbo.its_itemrecords where pcserial ='".$pcserial."' and type='Processor'");
            if ($conn->has_rows($result)){
                $reader = $conn->fetch_array($result);
                
                $this->setProcessor($reader['model'] ." ". $reader['brand']);
                
            }
            $conn->close();
        }catch(Exception $e){

        }

    }



    
    public  function getPCHdd($pcserial){
        $conn = new Connection();

        try{
            $conn->open();
            $result = $conn->query("SELECT * FROM dbo.its_itemrecords where pcserial ='".$pcserial."' and type='Hard Disk'");
            if ($conn->has_rows($result)){
                $reader = $conn->fetch_array($result);
                
                $this->setHdd($reader['model'] ." ". $reader['brand']);
                
            }
            $conn->close();
        }catch(Exception $e){

        }

    }



    public  function getPCMemory($pcserial){
        $conn = new Connection();

			try{
				$conn->open();
				$result = $conn->query("SELECT * FROM dbo.its_itemrecords where pcserial ='".$pcserial."' and type='Memory Card'");
				if ($conn->has_rows($result)){
					$reader = $conn->fetch_array($result);
					
                    $this->setMemory($reader['model'] ." ". $reader['brand']);
                    
				}
				$conn->close();
			}catch(Exception $e){

			}
    }









}
?>