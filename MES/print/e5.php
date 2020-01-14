<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printing - CATS E5</title>

  </head>
  <body>

   
    <?php 
        
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/packing.php");
include_once("../classes/model.php");
include_once("../classes/partcode.php");
session_start();

    $lot = $_GET['lot'];
    // $name = $_GET['name'];
    // $line = $_GET['line'];
    $model = $_GET['model'];
    // $rev = $_GET['rev'];
    // $qty = $_GET['qty'];
  $shipmentdate = $_GET['shipdate'];
    // $sublotbarcode = "*".$_GET['lot']."*";
$result ='';
$model = '';
$account = trim($_SESSION['account']);
$code ='';

if(isset($_GET['lot']))
{
    $lot = $_GET['lot'];
    $name = $_SESSION['name'];
    $model = $_GET['model'];

    
    $result = Batch::getCountBatchByLot($account,$lot);
    $modelcode = new Model($account,$model);

    $code = $modelcode->getModelFamily();
    $qty = $result;

}

$partcode = new Partcode();
$partcode->getPartcodefinal($account,$model);

    ?>
    <style>
/*table {
    border-collapse: collapse;
}*/

td, th {
     padding: 2px; 
}

.test {
     padding:10px; 
    
}

</style>
<style>
.barcode {
  font-family: "Code39", sans-serif;

}
</style>

   <div>
  <table style=" width:12cm;">
    <tr>
      <td>
    <table border="1px solid"  style=" width:12cm; border:1px solid;">
      <tr>
      
        <td  colspan="2"><img class="pull-left" src="../assets/image/logo_ionics_small.png" width="100px"></td>
    
  </tr>
      <tr>
        <td >SUPPLIER NAME</td>
        <td ><b>IONICS EMS INC</b></td>
      </tr>


       <tr>
        <td >PART NUMBER:</td>
        <td ><b><?php echo $model;?></td>
      </tr>


       <tr>
        <td >DESCRIPTION:</td>
        <td ><b><?php echo $partcode->getDescription();?></b></td>
      </tr>

       <tr>
        <td >SHIPMENT DATE:</td>
         <td ><b><?php echo $shipmentdate;?></td>
      </tr>

       <tr>
        <td >LOT NUMBER:</td>
        <td ><b><?php echo $lot;?></td>
      </tr>

        <tr>
        <td>QUANTITY:</td>
        <td> <b><?php echo $result;?></b></td>
      </tr>

      <tr>
        <td>BOX NUMBER:</td>
        <td></td>
      </tr>
     <tr>
          <!-- <tr style=" height:5cm;width:5cm;"> -->
        <td colspan="2" >
          <table border="1px solid">
            <tr >   
            <td style="  height:5px;width:15cm; "> Supervisor:</td>
            <td style="  height:5px;width:15cm; "> QC: </td>
            <td style="  height:5px;width:15cm; ">Remarks:</td>
            </tr>
          </table> 


   </tr>

    </table>
</td>
<td>
       <table border="1px solid"  style=" width:12cm; border:1px solid;">
      <tr>
      
        <td  colspan="2"><img class="pull-left" src="../assets/image/logo_ionics_small.png" width="100px" ></td>
    
  </tr>
      <tr>
        <td >SUPPLIER NAME</td>
        <td ><b>IONICS EMS INC</b></td>
      </tr>

       <tr>
        <td >PART NUMBER:</td>
        <td ><b><?php echo $model;?></td>
      </tr>

      <tr>
        <td >DESCRIPTION:</td>
        <td ><b><?php echo $partcode->getDescription();?></b></td>
      </tr>

       <tr>
        <td >SHIPMENT DATE:</td>
         <td ><b><?php echo $shipmentdate;?></td>
      </tr>

       <tr>
        <td >LOT NUMBER:</td>
        <td ><b><?php echo $lot;?></td>
      </tr>

        <tr>
        <td>QUANTITY:</td>
        <td> <b><?php echo $result;?></b></td>
      </tr>

      <tr>
        <td>BOX NUMBER:</td>
        <td></td>
      </tr>
     <tr>
          <!-- <tr style=" height:5cm;width:5cm;"> -->
        <td colspan="2" >
          <table border="1px solid">
            <tr >   
            <td style="  height:5px;width:15cm; "> Supervisor:</td>
            <td style="  height:5px;width:15cm; "> QC: </td>
            <td style="  height:5px;width:15cm; ">Remarks:</td>
            </tr>
          </table> 


   </tr>

    </table>
  </td>
</tr>
</table>


 
   <br><hr><br>
    <table  style=" width:23cm; border:1px solid;" > 
        
        <tr><td>LOT: <b><?php echo $lot;?></b></td></tr>            
        <tr><td>MODEL:  <b><?php echo $model;?></b></td></tr>
        <tr><td>LOT QUANTITY:  <b><?php echo $result;?></b></td></tr>

                <tr> 
          <?php $serial = Batch::getAllLotno($account,$lot);

            for($x=0;$x<count($serial);$x++){
                   
              if($x == 0)
              {

              }else{

                 ?>
                  <td style="padding-left: 25px;padding-right: 35px;"><?php
              echo $serial[$x]->getCardNo(); ?> - <?php echo $serial[$x]->getCurrquantity();?>
                </td>
                 
           
              <?php  
              if($x%5 == 0)
              {
                ?> 
              </tr>
           <tr >
              
              <?php
              }
            }

            if($x == count($serial)-1){
                  ?>
                  <td style="padding-left: 25px;padding-right: 35px;"><?php
              echo $serial[0]->getCardNo(); ?> - <?php echo $serial[$x]->getCurrquantity();?>
                </td>
                 
           
              <?php 
            }

            }
          ?>
             
            </table>

   </div>

  </body>
   <script type="text/javascript" > 
             window.print();
          </script>
</html>