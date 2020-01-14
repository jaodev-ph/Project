<main class="mdl-layout__content mdl-color--grey-100">

        <div class="mdl-grid demo-content">
<span style="color:gray;font-family: verdana;font-size: 25px;font-weight:bold;"></span>
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >

 <!-- -------------------------------------------------------------------------------------------------------------------------------- --> 

<?php 

 include_once("../classes/pmevent.php");
 include_once("../classes/pmdetails.php");

$disabled = 'disabled'; 
$readonly = 'readonly';
$lineid="";
$jobtypeid="";
$joborder="";
$jobOrderId="";
$line="";
$jobtype="";
$name="";
$cmbmachine="";
$machineid="";
$machinetypeid="";
$status="";
$remarks="";
$flag="";

 $counter = 0;  

$mode=0;



?>

<div class="mdl-cell--top mdl-cell--12-col mdl-cell--12-col-desktop">
 

    <div class="panel panel-primary" style="margin-left:10px;">
          <div class="panel-heading" >Calibration</div>
          <div class="panel-body">
                  
            <div class="table-responsive" style="overflow-x: scroll;height:250px;">
              <table class="table table-bordered"  id="tblOrder" >
                <thead>
                  <tr>
                  <th class="info">Head</th>
                  <th class="info">Nozzle</th>
                  <th class="info">Pick Vacuum</th>
                  <th class="info">Mount Vacuum</th>
                </tr>
                </thead>
                <tbody>
               
                </tbody>
            </table>
         </div>

        </div>    
      </div>
</div>



</div>

 <!-- -------------------------------------------------------------------------------------------------------------------------------- --> 


          </div>
        </div>
</main>



<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

   $(document).ready(function () {

     
   });


</script>
