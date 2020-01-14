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

if(isset($_GET['joborder']))
{
    $joborder = $_GET['joborder'];
    $joborder = new dashboard();
    $joborder->getPMScheduleDetails($_GET['joborder']);

    $jobOrderId = $joborder->getjobOrder();
    $line = $joborder->getproductionLineId();
    $jobtype = $joborder->getjobType();
 
    $disabled = ''; 

    $mode = 1;

}

?>

<div class="mdl-cell--top mdl-cell--12-col mdl-cell--5-col-desktop">
 
   
   <div class="form-group">
      <label for="pwd">Job Order ID</label>
      <input type="text" class="form-control" id="stextjoborderid" name="stextjoborderid" value="<?php echo $jobOrderId; ?>"  <?php echo $readonly;?>>
    </div>

  <div class="form-group">
      <label for="pwd">Production Line</label>
      <input type="text" class="form-control" id="stextline" name="stextline" value="<?php echo $line; ?>" <?php echo $readonly;?>>
    </div>

 <div class="form-group">
      <label for="pwd">Job Type</label>
      <input type="text" class="form-control" id="stextjobtype" name="stextjobtype" value="<?php echo $jobtype; ?>" <?php echo $readonly;?> >
    </div>

<input type="hidden" class="form-control" id="mode" name="mode" value="<?php echo $mode; ?>" <?php echo $readonly;?> >


  <div class="form-group">
      <label for="pwd">Machine Name</label>
        <Select class="form-control" id="scmbmachinename" name="scmbmachinename" value="<?php if(isset($_POST['$cmbmachine'])) { echo $_POST['$cmbmachine'];}?>" <?php echo $disabled;?>>
        <option></option>
  <?php  
            $selectmachine = Machine::SelectMachine($line,$jobtype);
            for($i=0;$i<count($selectmachine);$i++){
          ?>
          <option ><?php echo $selectmachine[$i]->getname(); ?></option> 
        
          <?php } ?>
     </Select>
  <input type="hidden" class="form-control" id="machineid" name="machineid" value="<?php echo $machineid; ?>" <?php echo $readonly;?> >
  <input type="hidden" class="form-control" id="machinetypeid" name="machinetypeid" value="<?php echo $machinetypeid; ?>" <?php echo $readonly;?> >
    </div>

    <div class="form-group" align = "center">
        <button id="btnStart" name="btnStart" class="btn btn-primary btn-lg" disabled>Start</button>   
      </div>

</div>

 <div class="mdl-cell--top mdl-cell--12-col mdl-cell--7-col-desktop">

    <div class="panel panel-primary" style="margin-left:10px;">
                  <div class="panel-heading" >Job Order</div>
                  <div class="panel-body">
                  
                      <div class="table-responsive" style="overflow-x: scroll;height:250px;">
                            <table class="table table-bordered"  id="tblOrder" >
                                <thead>
                                    <tr>
                                        <th class="info">Id</th>
                                        <th class="info">Line</th>
                                        <th class="info">Type</th>
                                        <th class="info">Start Date</th>
                                        <th class="info">Start Time</th>
                                        <th class="info">Calibration</th>

                                    </tr>
                                </thead>
                                <tbody>

                  <?php
                     include_once("../classes/pmevent.php");
                     $joborder = dashboard::getAllPMSchedule();

                     for($i=0;$i<count($joborder);$i++){
                    ?>
                    <tr>
                        <td><a href="?joborder=<?php echo $joborder[$i]->getjobOrder(); ?>"><?php echo $joborder[$i]->getjobOrder(); ?></a></td>
                        <td><?php echo $joborder[$i]->getproductionLineId(); ?></td>
                        <td><?php echo $joborder[$i]->getjobType(); ?></td>
                        <td><?php echo $joborder[$i]->getdateStart(); ?></td>
                        <td><?php echo $joborder[$i]->gettimeStart(); ?></td>
                        <td><a href="?joborder=<?php echo $joborder[$i]->getjobOrder(); ?>">Calibration</a></td>
                    </tr>

                    <?php } ?>
                                </tbody>
                            </table>
                      </div>
                  </div>    
                </div>

  </div>

  <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">

 <div class="panel panel-primary" id="tblpanel" style="display:none;">
    <div class="panel-heading">Machine Checksheet</div>
      <div class="panel-body">  
        <table class="table table-bordered" id="tablechecklist" >
       

                <thead>  
              <tr class="info">
                    <th><label for="usr" style="text-align: center;">No.   </label></th>
                    <th><label for="usr" style="text-align: center;">Job </label></th>   
                    <th><label for="usr" style="text-align: center;">Ok   </label></th>   
                    <th><label for="usr" style="text-align: center;">Not Ok   </label></th> 
                    <th><label for="usr" style="text-align: center;">Replacement    </label></th>
                    <th><label for="usr" style="text-align: center;">Remarks    </label></th>
              </tr>
                </thead>  

              <tbody>
              </tbody>
              
        </table>
      </div>

<div class="row" style="margin-top:10px; margin-right: 10px; margin-bottom: 10px;" align="right">
    <div class="col-md-12">
   
    <button class="btn btn-primary emp-btn" id="btnDone" name="btnDone">DONE</button>
    <button type ="button" class="btn btn-warning emp-btn" id ="btnClose" name="btnClose" onclick="window.location.reload()">CANCEL</button> 
    </div>
  </div>



    </div>
  </div>
</div>

 <!-- -------------------------------------------------------------------------------------------------------------------------------- --> 


          </div>
        </div>
</main>

<!-- Calibration -->
<div class="modal fade " id="Modal_Calibrate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style=""  >
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1F618D;">
        <button id='modalmenuclose'type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;">Calibration</h4>
      </div>
      <div class="modal-body">
   <form method="post" id = "FormCalibrate">

<div class="form-group">
     <label for="pwd">Machine:</label>
  <input class="form-control" type="text" name="modmachine" id="modmachine" readonly>
</div>


      <div class="modal-footer">
         <button type="button" class="btn btn-light" id="btnEdit" name="btnEdit" data-dismiss="static" data-backdrop="static"> Save </button>
        <!-- <button type="submit" id="changepass" class="btn btn-success" >Change</button> -->
        <button type="button" class="btn btn-light"  id="edit_cancel" data-dismiss="modal">Close</button>
        </form>

      </div>
    </div>
  </div>
</div>


<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
 var tblcount;
   $(document).ready(function () {

      $('#scmbmachinename').change(function (){

             var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   var result = this.responseText;
                   var res = result.split("_");
                    /*alert(result);*/
                  document.getElementById("machineid").value = res[0];
                  document.getElementById("machinetypeid").value = res[1];
                  document.getElementById("btnStart").disabled = false;
                  }
                 };
                  xmlhttp.open("GET", "../php/pmselectmachine.php?name=" + document.getElementById("scmbmachinename").value+"&line="+ document.getElementById("stextline").value+"&jobtype="+ document.getElementById("stextjobtype").value, true);
                xmlhttp.send();

    $("#tablechecklist > tbody").empty();
    $("#btnCalibration").hide();
    $("#btnClose").hide();
    $("#btnDone").hide();


           });

$( "#btnStart" ).click(function() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
               var res1 = result.split("&");
                /*alert(result);*/


 for (i = 0; i < res1.length - 1; i++) { 

  var res2 = res1[i].split("_");

  $('#tablechecklist > tbody').append('<tr id="tr'+res2[0]+'">'+
    
  '<td><label  id = "txtsequence[]"  name="txtsequence[]" value="'+res2[0]+'">'+res2[0]+'</label></td>'+
    
  '<td><label  id = "txtjoblist[]"  name="txtjoblist[]" value="'+res2[1]+'">'+res2[1]+'</label></td>'+
    
  '<td><input  type="checkbox" class="chb" id = "check[]"  name="check[]" > Ok</td>'+
    
  '<td><input  type="checkbox" class="chb" id = "notcheck[]"  name="notcheck[]" > Not Ok</td>'+
    
  '<td><input  type="checkbox" class="chb" id = "flag[]"  name="flag[]"  > Replace</td>'+
    
  '<td><input type="text" class="form-control" id ="Remarks[]" name="Remarks[]" placeholder="Remarks"  autocomplete="off"></td>'+'</tr>');
    
   }         
       document.getElementById("btnStart").disabled=true;           
               }
              
            };

            xmlhttp.open("GET", "../php/pmchecksheetshow.php?line=" + document.getElementById("stextline").value + "&joborder=" + document.getElementById("stextjoborderid").value+ "&jobtype=" + document.getElementById("stextjobtype").value+"&machineid=" + document.getElementById("machineid").value, true);
            xmlhttp.send();

$("#tblpanel").show();
$("#btnCalibration").show();
$("#btnClose").show();
$("#btnDone").show();

});

$( "#btnDone" ).click(function() {



            var txtsequence = $('input[name="txtsequence[]"]').map(function () {
            return this.value; }).get();

            var txtjoblist = $('input[name="txtjoblist[]"]').map(function () {
            return this.value; }).get();

            var check = $('input[name="check[]"]').map(function () {
            return this.value; }).get();

            var notcheck = $('input[name="notcheck[]"]').map(function () {
            return this.value; }).get();

            var flag = $('input[name="flag[]"]').map(function () {
            return this.value; }).get();

            var Remarks = $('input[name="Remarks[]"]').map(function () {
            return this.value; }).get();


    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
                alert(result);
                       

               }
              
            };

            xmlhttp.open("GET", "../php/pmchecksheetupdate.php?line=" + document.getElementById("stextline").value + "&joborder=" + document.getElementById("stextjoborderid").value+ "&jobtype=" + document.getElementById("stextjobtype").value+"&machineid=" + document.getElementById("machineid").value+"&txtsequence="+JSON.stringify(txtsequence)+"&txtjoblist="+JSON.stringify(txtjoblist)+"&check="+JSON.stringify(check)+"&notcheck="+JSON.stringify(notcheck)+"&flag="+JSON.stringify(flag)+"&Remarks="+JSON.stringify(Remarks), true);
            xmlhttp.send();


});

   });


</script>
