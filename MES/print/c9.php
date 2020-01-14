<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printing - CATS C9</title>

  </head>
  <body>

   
    <?php 
        
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/packing.php");
include_once("../classes/model.php");
session_start();

    // $lot = $_GET['lot'];
    // $name = $_GET['name'];
    // $line = $_GET['line'];
    // $model = $_GET['model'];
    // $rev = $_GET['rev'];
    // $qty = $_GET['qty'];
    // $sublotbarcode = "*".$_GET['lot']."*";
$result ='';
$model = '';
$account ='';
$code ='';
if(isset($_GET['lot']))
{
    $lot = $_GET['lot'];
    $name = $_SESSION['name'];
    $model = $_GET['model'];

    $account = trim($_SESSION['account']);
    $result = Card::getCountSerialByLot($account,$lot);
    $modelcode = new Model($account,$model);

    $code = $modelcode->getModelFamily();
    $qty = $result;

}

    ?>
    <style>
/*table {
    border-collapse: collapse;
}*/

td, th {
     padding: 10px; 
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
    <table border="1px solid" style=" width:23cm; border:1px solid;">
      <tr>
        <td >BROTHER INDUSTRIES, LTD <b><?php echo $lot;?></b></td>
        <td>QUANTITY: <b><?php echo $result;?></b></td>
      </tr>

      <tr>
        <td>MODEL: <b><?php echo $model;?></b></td>
        <td>CODE: <b><?php echo $code;?></b></td>
      </tr>

        <tr >
        <td colspan="2" >
          SERIAL NUMBER:
        </td>
      </tr>
<div>
      <tr style=" height:19cm;" >
        <td valign="top" class ='test' colspan="2" style="text-align: center;">
           <table >  
                <tr> 
          <?php $serial = Card::getAllLotno($account,$lot);

            for($x=0;$x<count($serial);$x++){
                   
              if($x == 0)
              {

              }else{

                 ?>
                  <td style="padding-left: 25px;padding-right: 35px;"><?php
              echo $serial[$x]->getCardNo(); ?>
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
              echo $serial[0]->getCardNo(); ?>
                </td>
                 
           
              <?php 
            }

            }
          ?>
             
            </table>
          
        </td>
     
      </tr>
      </div>

      <tr style=" height:5cm;">
        <td colspan="2" >
          <table border="1px solid">
            <tr >
               <td >
            Packed by:
                </td>
                    <td >
          Supervisor:
                </td>
                    <td >
          QC:
                </td>
            </tr>

            <tr>
               <td  style=" height:5cm;width:15cm; ">
              
                </td>
                    <td style=" height:5cm;width:15cm; ">
              
                </td>
                    <td style=" height:5cm;width:15cm; ">
               
                </td>
            </tr>
          </table>
          
        </td>
    </table>
   </div>

  </body>
   <script type="text/javascript" > 
             window.print();
          </script>
</html>