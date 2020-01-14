<?php

include_once("../classes/lotnumber.php");
include_once("../classes/batch.php");
session_start();


  $account = trim($_SESSION['account']);
  $name = $_SESSION['name'];
  $partcode = explode("|",$_GET['partcode']);
  $shift = $_GET['shift'];
  $modelno = $_GET['modelno'];
  $line = $_GET['line'];
  $mode = $_GET['Single'];
  $mode1 = $_GET['Multi'];
  $station = explode(":",$_GET['station']);
  $lotno ="";
  $reference ="";
/*$mode= 1;
*/

           if($mode=='true'){

                if(isset($line)){
                 
                   $mdate = date('n');
              /*     $splitted = explode('|',$partcode);*/
                   $seq = LotNumber::getseq($account);
               /*    $station = trim($splitted[3]);*/

                   if($mdate>9){
                     if($mdate==10){
                       $mdate = 'X';
                     }else if($mdate==11){
                       $mdate = 'Y';
                     }else if($mdate==12){
                       $mdate = 'Z';
                     }
                   }

                    $t = microtime(true);
                    $micro = sprintf("%06d",($t - floor($t)) * 1000000);
                    $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
                    $reference = 'V'.'IONPCA'.date('y').$mdate.date('dhis').substr($d->format("u"),0,3);
                    $lotNo = 'ION'.date('y').$mdate.date('d').$shift.$line.$seq;
                  /*  $disabledReference = '';
                    $disabledModel = '';
                    $disabledSerial = '';
                    $qtyDisabled = '';
                    $getpart = $splitted[0];
                    $disableinit = 'readonly onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;"';*/
            }

      $exist = LotNumber::lotcheckExist($account,$lotNo);
    
      if($exist == 'true'){
        $lotnumber = new LotNumber($account,$lotno);
    /*    if($lotnumber->getStatus() == 'completed'){
          echo $lotnumber->getQuantity().'_error4_'.$_GET['lotno'];
        }else{*/
          $lotcount = Batch::getCountSerialByLot($account,$lotno);
          $batchcount = Batch::getCountBatchByLot($account,$lotno);
    /*      if($lotcount == $RQuantity){
          echo $lotcount.'_'.'false'."_".$batchcount;
          }else{
          echo $lotcount.'_'.'true'."_".$batchcount;  
          }*/
          
       /* }*/
      }else{        
        
        $LotNo = new LotNumber();
        $LotNo->setAccount($account);
        $LotNo->setLotno($lotNo);
        $LotNo->setCounter(0);
        $LotNo->setReference($reference);
        $LotNo->setPartno($modelno);
        $LotNo->setStage($station[0]);
        $LotNo->setStatus('NC');
        $LotNo->setSamplingSize(0);
        $LotNo->setLastupdatedby($name);
        $LotNo->setQuantity(0);
        $LotNo->setPackingref($partcode[0]);
        $LotNo->addLot();
  
      }
            echo "success_".$lotNo."_".$reference;
          }
if($mode1=='true'){
  
         echo "open_";
           }

       
           ?>