<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printing - CATS B9</title>

  </head>
  <body>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
<style type="text/css">
#label{
    -webkit-print-color-adjust: exact;
    font-family: verdana;
  }

  .barcodeRef{
    position: absolute;
    top: 80px;
    left: 80px;
  }

  .barcodeParts{
    position: absolute;
    top: 115px;
    left: 80px;
  }

  .barcodeLot{
    position: absolute;
    top: 150px;
    left: 80px;
  }

  .barcodeQty{
    position: absolute;
    top: 185px;
    left: 80px;
  }

  .barcodeRemarks{
    position: absolute;
    top: 225px;
    left: 80px;
  }

  .barcodeRef2{
    position: absolute;
    top: 72px;
    left: 73px;
  }

  .barcodeParts2{
    position: absolute;
    top: 107px;
    left: 73px;
  }

  .barcodeLot2{
    position: absolute;
    top: 143px;
    left: 73px;
  }

  .barcodeQty2{
    position: absolute;
    top: 178px;
    left: 73px;
  }

  .barcodeRemarks2{
    position: absolute;
    top: 215px;
    left: 73px;
  }

  table{
    width:764px;
    border:1px solid #000;
    margin-top: 50px;
  }

  hr{
    margin-top:20px;
    border:1px dashed #555;
  }

  th{
    background-color: #000;
    color:#fff;
  }

  td{
    border:1px solid #000;
  }

  .qrcode{position: absolute;top:35px;left: 335px;}
  .qrcode2{position: absolute;top:35px;left: 715px;z-index: 999;}
</style>
    <?php 
        
include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/model.php");
include_once("../classes/partcode.php");

session_start();
    
    $account = trim($_SESSION['account']);
    $lot = $_GET['lot'];
    $ref = $_GET['ref'];
    $model = $_GET['model'];
    $qty = $_GET['qty'];
    $partcode =  trim($_GET['partcode']);
 

$part = new Partcode($account,$partcode);

    ?>

</head>
<body>
  <div class="qrcode"></div>
  <div class="qrcode2"></div>
  <div id="label" style="left:0px;width:382px;height:257px;background:url(../assets/image/B9_lot.png);">
      <div style="position:absolute;text-align:center;top:14px;left:11px;height:20px;width:375px;font-weight:bold;font-size:
      12px;background-color:white;color:black;">ION-IONICS-<?php if($account == "G2"){echo 'IJP';}else{echo 'VP';}?></div>
      <div style="position:absolute;margin-left:10px;margin-top:80px;font-size:8px;">Ref. No.:</div><div class="barcodeParts"></div>
      <div style="position:absolute;margin-left:10px;margin-top:115px;font-size:8px;">Partscode:</div><div class="barcodeLot"></div>
      <div style="position:absolute;margin-left:10px;margin-top:150px;font-size:8px;">Lot No.:</div><div class="barcodeQty"></div>
      <div style="position:absolute;margin-left:10px;margin-top:190px;font-size:8px;">Qty.:</div><div class="barcodeRef"></div>
      <div style="position:absolute;margin-left:10px;margin-top:230px;font-size:8px;">Remarks:</div><div class="barcodeRemarks"></div>
      <div style="position:absolute;margin-left:260px;margin-top:110px;font-size:8px;">Parts<br>name:</div>
      <div style="position:absolute;margin-left:290px;margin-top:110px;font-size:8px;text-align:left;font-weight:bold;word-break:break-all;"><?php echo str_replace(';',';<br>',$part->getDescription()); ?></div>
<!--       <div style="position:absolute;margin-left:260px;margin-top:180px;font-size:8px;">Model:</div>
      <div style="position:absolute;margin-left:290px;margin-top:180px;font-size:8px;text-align:center;font-weight:bold;word-break:break-all;"><?php echo $part->getModelFamily(); ?></div> -->
  </div>

  <div id="label" style="position:absolute;top:8px;left:387px;width:382px;height:257px;background:url(../assets/image/B9_lot.png);">
      <div style="position:absolute;text-align:center;top:6px;left:3px;height:20px;width:375px;font-weight:bold;font-size:
      12px;background-color:white;color:black;">ION-IONICS-<?php if($account == "G2"){echo 'IJP';}else{echo 'VP';}?></div>
      <div style="position:absolute;margin-left:10px;margin-top:80px;font-size:8px;">Ref. No.:</div><div class="barcodeParts2"></div>
      <div style="position:absolute;margin-left:10px;margin-top:115px;font-size:8px;">Partscode:</div><div class="barcodeLot2"></div>
      <div style="position:absolute;margin-left:10px;margin-top:150px;font-size:8px;">Lot No.:</div><div class="barcodeQty2"></div>
      <div style="position:absolute;margin-left:10px;margin-top:190px;font-size:8px;">Qty.:</div><div class="barcodeRef2"></div>
      <div style="position:absolute;margin-left:10px;margin-top:230px;font-size:8px;">Remarks:</div><div class="barcodeRemarks2"></div>
      <div style="position:absolute;margin-left:260px;margin-top:110px;font-size:8px;">Parts<br>name:</div>
      <div style="position:absolute;margin-left:290px;margin-top:110px;font-size:8px;text-align:left;font-weight:bold;word-break:break-all;"><?php echo str_replace(';',';<br>',$part->getDescription()); ?></div>
 <!--      <div style="position:absolute;margin-left:260px;margin-top:180px;font-size:8px;">Model:</div>
      <div style="position:absolute;margin-left:290px;margin-top:180px;font-size:8px;text-align:center;font-weight:bold;word-break:break-all;"><?php echo $part->getModelFamily(); ?></div> -->
  </div>
  <hr style="position:absolute;width:760px;">

  <table style="">
    <tr>
      <td colspan="4" style="text-align:center;font-size:18px;font-weight:bolder;">Lot Track Details</td>
    </tr>
    <tr>
      <td style="font-weight:bold;">Lot No. : </td>
      <td style="text-align:center;"><?php echo strtoupper($lot); ?></td>
      <td style="font-weight:bold;">Ref. No. : </td>
      <td style="text-align:center;"><?php echo strtoupper($ref); ?></td>
    </tr>
    <tr>
      <td style="font-weight:bold;">Qty. : </td>
      <td style="text-align:right;"><?php echo $qty; ?></td>
      <td style="font-weight:bold;">Partscode : </td>
      <td style="text-align:center;"><?php echo $partcode; ?></td>
    </tr>
    <tr>
      <td colspan="2" style="font-weight:bold;">Parts Name : </td>
      <td colspan="2" style="text-align:center;"><?php echo $part->getDescription(); ?></td>
    </tr>
    <tr rowspan = "3">
      <th>Serial No.</th>
      <th>Model No.</th>
      <th>Date Processed</th>
      <th>Processed By</th>
    </tr>
    <?php 
   
      $serials = Card::getAllLotSerialRef($account,$lot,$ref);
      for($i=0;$i<count($serials);$i++){
     ?>
      <tr style="font-size:12px;">
        <td><?php echo strtoupper($serials[$i]->getSerialNo()); ?></td>
        <td style="text-align:right;"><?php echo $serials[$i]->getPartNo(); ?></td>
        <td><?php echo $serials[$i]->getLastUpdate();?></td>
        <td><?php echo strtoupper($serials[$i]->getLastUpdatedBy()); ?></td>
      </tr>
     <?php } ?>
  </table>
  <script src="../assets/js/jquery.js"></script>
  <script src="../assets/js/jquery-qrcode-0.14.0.js"></script>
  <script src="../assets/js/jquery-barcode.js"></script>
  <script type="text/javascript">

    $('.qrcode').qrcode({render:'div',text:'<?php echo "Z1".$partcode."|Z7ION|Z2".$lot."|Z3".$qty."|Z4".$part->getRemarks()."|Z5".$ref."|Z6".$part->getModelFamily(); ?>',size:41});
    $('.qrcode2').qrcode({render:'div',text:'<?php echo "Z1".$partcode."|Z7ION|Z2".$lot."|Z3".$qty."|Z4".$part->getRemarks()."|Z5".$ref."|Z6".$part->getModelFamily(); ?>',size:41});

   
    $('.barcodeParts').barcode('<?php echo $partcode; ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10});

    $('.barcodeLot').barcode('<?php echo strtoupper($lot); ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10});

    $('.barcodeQty').barcode('<?php echo $qty; ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10});

    $('.barcodeRef').barcode('<?php echo strtoupper($ref); ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10,bgColor:'#ffffffff'});

    $('.barcodeRemarks').barcode('<?php echo $part->getRemarks(); ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10,bgColor:'#ffffffff'});

    //Receiving
    $('.barcodeParts2').barcode('<?php echo $partcode; ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10});

    $('.barcodeLot2').barcode('<?php echo strtoupper($lot); ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10});


    $('.barcodeQty2').barcode('<?php echo $qty; ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10});

    $('.barcodeRef2').barcode('<?php echo strtoupper($ref); ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10,bgColor:'#ffffffff'});

    $('.barcodeRemarks2').barcode('<?php echo $part->getRemarks(); ?>',"code128",{
      barWidth:1,barHeight:25,marginHRI: 1,
      fontSize:8,output:"css",posX:0,posY:10,bgColor:'#ffffffff'});
    </script>
  </body>
   <script type="text/javascript" > 
             window.print();
          </script>
</html>