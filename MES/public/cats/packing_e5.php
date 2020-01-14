
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

<?php

include_once("../classes/model.php");
include_once("../classes/line.php");
include_once("../classes/defectcatprod.php");
include_once("../classes/defectprod.php");
include_once("../classes/modelroute.php");
$readonly ="readonly";
$model ="";
$revision ="";
$line ="";
$location ="";
$status = "";
$createdby ="";
$cmbmodel ="";
$cmbline ="";


?>

  <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
    
   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Packing <b id="SerialNumber" name="SerialNumber"></b> is successfully completed!</div>

   <div id = "successreject" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is successfully rejected!</div>

   <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Wrong Lot number!</div>

   <div id = "error4" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
    <strong>Error!</strong> Serial <b id="Serial_Error3" name="Serial_Error3"></b> is offroute!</div>

   <div id = "serialreject" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error5" name="Serial_Error5"></b> is REJECT!</div>

   <div id = "wrongmodel" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Wrong Model!</div>

   <div id = "offroute" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot Number <b id="Serial_Error3" name="Serial_Error3"></b> is offroute!</div>

   <div id = "notexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is not exist!</div>

   <div id = "wronglot" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error4" name="Serial_Error4"></b> is not belong to lot !</div>

   <div id = "lotnotexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot Number <b id="Serial_Error4" name="Serial_Error4"></b> is not exist!</div>

     <div id = "SerialExists" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot Number <b id="Serial_Error6" name="Serial_Error6"></b> is already inserted!</div>

    <div id = "completed" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Packing Number <b id="Serial_Error6" name="Serial_Error6"></b> is already completed!</div>

   <div id = "rejectlot" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot number <b id="Serial_Error7" name="Serial_Error7"></b> is reject!</div>

     <form method="POST">
    <div class="form-group">
      <label for="usr">Model:</label>

      <Select class="form-control" id="ScmbModel" name="ScmbModel" >
      	<option></option>
        <?php 
            $SelectModel = Model::SelectAllModel($_SESSION['account']);
                     for($i=0;$i<count($SelectModel);$i++){
                ?>
<option value ='<?php echo $SelectModel[$i]->getModel(); ?>' <?php if($cmbmodel==$SelectModel[$i]->getModel()) {echo "selected";} ?> ><?php echo $SelectModel[$i]->getModel(); ?></option>
         <?php 
       }
       ?> 
      </Select>
    </div>

  <div class="form-group">
      <label for="usr">Station:</label>
      <input type="text" class="form-control" id="ScmbStation" name="ScmbStation" readonly>

    </div>



    <div class="form-group">
      <label for="usr">Lot Number:</label>
      <input type="text" class="form-control" id="StextLotNo" name="StextLotNo" onkeypress="if (event.keyCode == 13)  return false;" disabled autocomplete="off">
      </Select>
    </div>

         <div class="form-group">
           <div class="row">
          <div class="col-sm-8">
      <label for="usr">Shipment Date:</label>
      <input type="date" class="form-control" id="shipmentdate" name="shipmentdate" disabled>
    </div>
    </div>
       </div>
<!-- 
    <div class="form-group">
      <label for="usr">Required Quantity:</label>
      <input type="text" class="form-control" id="RQuantity" name="RQuantity" readonly>

    </div> -->
  <div class="form-group">
      <label for="usr">Lot Quantity:</label>
      <input type="text" class="form-control" id="LotQuantity" name="LotQuantity" readonly>

    </div>




 <div class="form-group">
    
  <div class="row">
    <div class="col-sm-5">
      <label for="usr">Total Quantity:</label>
    <input type="text" class="form-control" id="totalquantity" name="totalquantity" value ="0" disabled>
    </div>
    <div class="col-sm-5">
        <label for="usr">Packing Count</label>
      <input type="number" class="form-control" id="PackingCount" name="PackingCount" value ="0" disabled>
    </div>
   
</div>
</div>

  <!--   <div class="form-group">
      <label for="usr">Sampling Quantity:</label>
      <input type="number" class="form-control" id="SamplingQuantity" name="SamplingQuantity" value ="0" onkeypress="if (event.keyCode == 13)  return false;" disabled>

    </div> -->


    <div class="form-group">
      <label for="pwd">Packing Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" disabled >
    </div>


    
      <div class="row" >
                    <div class="col-md-12">
                        <button type ="button" class="btn btn-success emp-btn" id ="btnGood" name="btnGood" disabled style="margin-right:10px;">Insert</button>
                        <!-- <button type ="button" class="btn btn-warning emp-btn" id ="btnReject" name="btnReject" disabled style="margin-right:10px;">REJECT</button>  -->
                         <button type ="button" class="btn btn-warning emp-btn" id ="btndone" name="btndone" disabled style="margin-right:10px;">Done</button> 
                        <button type ="button" class="btn btn-info emp-btn" id ="btnlot" name="btnlot" disabled style="margin-right:10px;">Closed Packing</button>  
                        <button type ="submit" class="btn btn-warning emp-btn" id ="btnCancel" name="btnCancel"  style="margin-right:10px;">Cancel</button>                    
                    </div>
      </div>




    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
      

<!--   <div class="panel panel-primary">
                    <div class="panel-heading">Serial  Number Details</div>
                    <div class="panel-body">
                          <div class="row">
                            <div class="col-md-3">
                                <label>Model:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtModel" name="txtModel" value="<?php echo $model;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                            <div class="col-md-3">
                                <label>Type:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtRev" name="txtRev" value="<?php echo $revision;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>                    
                          <div class="row">
                            <div class="col-md-3">
                                <label>Next Station:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtLocation" name="txtLocation" value="<?php echo $location;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                              <div class="row">
                            <div class="col-md-3">
                                <label>Status:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="txtStatus" name="txtStatus" value="<?php echo $status;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Created By:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="txtCreatedBy" name="txtCreatedBy" value="<?php echo $createdby;?>" class="form-control input-sm" <?php echo $readonly;  ?>><br>
                            </div>
                          </div>
                  </div>      
              </div>
 -->


              <div class="panel panel-primary" >
                  <div class="panel-heading" >Lot Number Details</div>
                  <div class="panel-body">
                      <br />
                      <div class="table-responsive" style="overflow-x: scroll;height:400px;">
                            <table class="table table-bordered"  id="tblsampling" >
                                <thead>
                                    <tr>
                                        <th class="info">Count</th>
                                        <th class="info">Lot Number</th>
                                        <th class="info">Model</th>
                                        <th class="info">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                      </div>
                  </div>    
      
                </div>

    </div>
   <!--  <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
    
                <div class="panel panel-primary" >
                  <div class="panel-heading" >Reject Details</div>
                  <div class="panel-body">
                      <div class="row">
                         <div class="col-md-3">
                            <label>Reject Category:</label>
                         </div>
                         <div class="col-md-6"> 
                            <select id="cmbrejectcat" class="form-control input-sm" name="cmbrejectcat" disabled>
                              <option></option> 
                                <?php 
                                  $optdefectcat = DefectCatProd::getalldefectcatprod($_SESSION['account']);
                                  for($i=0;$i<count($optdefectcat);$i++){
                                ?>
                                  <option><?php echo $optdefectcat[$i]->getDescription(); ?></option>
                                <?php } ?>
                            </select><br>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-3">
                            <label>Reject Code:</label>
                         </div>
                         <div class="col-md-6">
                            <select id="cmbrejectcode" class="form-control input-sm" name="cmbrejectcode" disabled>
                              <option></option> 
                                <?php 
                                  $optdefect = DefectCodeProd::getalldefectprod($_SESSION['account']);
                                  for($i=0;$i<count($optdefect);$i++){
                                ?>
                                  <option><?php echo $optdefect[$i]->getDescription(); ?></option>
                                <?php } ?>
                            </select><br>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-3">
                            <label>Location:</label>
                         </div>
                         <div class="col-md-5">
                            <input id="txtlocations" type="text" name="txtlocations" class="form-control input-sm" disabled><br>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-3">
                            <label>Details:</label>
                         </div>
                         <div class="col-md-5">
                            <input id="txtdetails" type="text" name="txtdetails" class="form-control input-sm" disabled><br>
                         </div>
                         <div class="col-md-4">
                            <button id="btnadd" type="button" class="btn btn-success btn-sm" disabled >Add</button>
                         </div>
                      </div>
                      <br />
                      <div class="table-responsive">
                            <table class="table table-bordered"  id="tbldetails" >
                                <thead>
                                    <tr>
                                        <th class="info">Reject Category</th>
                                        <th class="info">Reject Code</th>
                                        <th class="info">Location</th>
                                        <th class="info">Details</th>
                                        <th class="info">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                      </div>
                  </div>    
                  <div class="panel-footer text-right">
                      <button type="button"  id="btnRejDone" name="btnRejDone" class="btn btn-success btn-lg" disabled>Done</button>
                      <button type="submit" id="btnRejCancel" name="btnRejCancel" class="btn btn-warning btn-lg" disabled>Cancel</button>
                  </div>
                </div>


            
          </div> -->
 </form>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  var tblcount;
  var tblcount1;
  var tbl2 = 1;
var proceed = false;
      function removeRow(row){
        
            $("#tr"+row).remove();
             tblcount = $('#tblSerialDetails > tbody tr').length;
             $Count = document.getElementById("SamplingCount").value;
             document.getElementById("SamplingCount").value = $Count - 1;
             // checkRow(tblcount);
        }

         function checkRow(row){
            if(row>0){
                document.getElementById('btnRejDone').disabled = false;
            }else{
                document.getElementById('btnRejDone').disabled = true;
            }
        }

  $(document).ready(function () {

//           if (document.getElementById("ScmbLine").value != '' && document.getElementById("ScmbModel").value != '') {
//              document.getElementById("StextSerial").disabled = false;
//             $('#StextSerial').focus();
//           }


           $('#ScmbModel').change(function (){

          // if (document.getElementById("ScmbModel").value == '') {

      if (document.getElementById("ScmbModel").value == '') { 
          document.getElementById("StextLotNo").disabled = true; 
          document.getElementById("ScmbStation").value = '';
          document.getElementById("StextLotNo").value = '';
          document.getElementById("StextSerial").value = '';
          document.getElementById("LotQuantity").value = '';
          // document.getElementById("SamplingQuantity").value = 0;
          document.getElementById("StextSerial").disabled = true;
          // document.getElementById("SamplingQuantity").disabled = true;  
          document.getElementById("btnGood").disabled = true;
          // document.getElementById("btnReject").disabled = true;
          document.getElementById("btnlot").disabled = true;


            $('#ScmbModel').focus();
          return;
          }else {
            document.getElementById("StextSerial").disabled = true; 
            document.getElementById("StextSerial").value = '';
            document.getElementById("StextLotNo").select();
            document.getElementById("LotQuantity").value = '';
            
            // document.getElementById("SamplingQuantity").value = 0;
            // document.getElementById("SamplingQuantity").disabled = true;  
  
              document.getElementById("btnlot").disabled = true;
             var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;

               var res = result.split("_");

               document.getElementById("ScmbStation").value = res[0];
               

               }
              
            };

            xmlhttp.open("GET", "../php/packingstation.php?modelno=" + document.getElementById("ScmbModel").value, true);
            xmlhttp.send();
          

            document.getElementById("StextLotNo").disabled = false; 
            document.getElementById("shipmentdate").disabled = false;
            $('#StextLotNo').focus();
          }

          });

          $('#StextLotNo').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

                     var hserialno = $('input[name="hserialno[]"]').map(function () {
            return this.value; }).get();

                 
            
           
                   for(x=0;x<hserialno.length;x++){
        
                        if(hserialno[x] == document.getElementById("StextLotNo").value){
                           proceed = false; 
                           // alert(hserialno[x]);
                          // document.getElementById("StextSerial").disabled = false;
                           $("#StextSerial").focus().select();

                          document.getElementById("error1").setAttribute("hidden","");
                          document.getElementById("notexist").setAttribute("hidden","");
                          document.getElementById("serialreject").setAttribute("hidden","");
                          document.getElementById("wrongmodel").setAttribute("hidden","");
                          document.getElementById("offroute").setAttribute("hidden","");
                          document.getElementById("success").setAttribute("hidden","");
                          document.getElementById("successreject").setAttribute("hidden","");
                          document.getElementById("lotnotexist").setAttribute("hidden","");
                          document.getElementById("notexist").setAttribute("hidden","");
                          document.getElementById("serialreject").setAttribute("hidden","");
                          document.getElementById("wronglot").setAttribute("hidden","");
                          document.getElementById("error4").setAttribute("hidden","");
                          document.getElementById("SerialExists").setAttribute("hidden","");
                          document.getElementById("SerialExists").removeAttribute("hidden");
                          document.getElementById("completed").setAttribute("hidden","");
                           document.getElementById("rejectlot").setAttribute("hidden","");
                          document.getElementById("txtModel").value ='';
                          document.getElementById("txtRev").value ='';
                          document.getElementById("txtLocation").value ='';
                          document.getElementById("txtStatus").value ='';
                          document.getElementById("txtCreatedBy").value ='';
                          document.getElementById("btnGood").disabled = true;
                          // document.getElementById("btnReject").disabled = true;
                                 break;
                        }else{

                          proceed = true;
                        }
                     }

           if(proceed == true || hserialno.length == 0){
              var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
           /*     alert(result);*/


                if(res[1]== 'true'){

                document.getElementById("LotQuantity").value = res[0]; 
                document.getElementById("ScmbModel").disabled = true;
                // document.getElementById("SamplingQuantity").disabled = false; 
               
                 // $("#SamplingQuantity").focus().select();
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("completed").setAttribute("hidden","");
                 document.getElementById("rejectlot").setAttribute("hidden","");
                document.getElementById("StextLotNo").disabled = true; 
                   document.getElementById("btnGood").disabled = false;
                  $('#shipmentdate').focus();
             
                // document.getElementById("btnReject").disabled = false;
                // document.getElementById("btnlot").disabled = tr;
                }

                if(res[0] == 'wrongmodel'){
                document.getElementById("error4").setAttribute("hidden","");               
                document.getElementById("LotQuantity").value = ''; 
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");               
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("completed").setAttribute("hidden","");
                 document.getElementById("rejectlot").setAttribute("hidden","");

                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("wrongmodel").removeAttribute("hidden");

                }
                if(res[0] == 'offroute'){
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("completed").setAttribute("hidden","");
                 document.getElementById("rejectlot").setAttribute("hidden","");

                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("offroute").removeAttribute("hidden");

                }

                 if(res[0] == 'lotnotexist'){

                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("completed").setAttribute("hidden","");
                 document.getElementById("rejectlot").setAttribute("hidden","");

                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("lotnotexist").removeAttribute("hidden");

                }

                if(res[0] == 'rejectlot'){

                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("completed").setAttribute("hidden","");

                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("rejectlot").setAttribute("hidden","");
                document.getElementById("rejectlot").removeAttribute("hidden");

                }
                
                

               }
              
            };

            xmlhttp.open("GET", "../php/batchpackingformat.php?model=" + document.getElementById("ScmbModel").value + "&lotno=" + document.getElementById("StextLotNo").value + "&station=" + document.getElementById("ScmbStation").value+"&RQuantity=test", true);
            xmlhttp.send();
           

          }
        }
          });

  $('#SamplingQuantity').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){
            
            var quantity = parseInt(document.getElementById("SamplingQuantity").value);
            var required = parseInt(document.getElementById("LotQuantity").value);
              if(quantity > 0){
                if(quantity > required){

                }else{
                  document.getElementById("StextSerial").disabled = false; 
                  document.getElementById("StextSerial").value ='';
                  $('#StextSerial').focus();
                  document.getElementById("SamplingQuantity").disabled = true;
                }

                }else{
                  
                  $("#SamplingQuantity").focus().select();
                }
             }

          });


          $('#StextSerial').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

            if(keycode == '13'){

                   var hserialno = $('input[name="hserialno[]"]').map(function () {
            return this.value; }).get();

                 
                var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
         /*        alert(result);*/
              if(res[0] == 'insert'){
                document.getElementById("StextSerial").disabled = true;
                document.getElementById("btnlot").disabled = false;
                $("#btnlot").focus();

                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("completed").setAttribute("hidden","");
                 document.getElementById("rejectlot").setAttribute("hidden","");
              }else if(res[0] == 'completed')
              {
                 $("#StextSerial").focus().select();
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("notexist").setAttribute("hidden","");
                  document.getElementById("serialreject").setAttribute("hidden","");
                  document.getElementById("wrongmodel").setAttribute("hidden","");
                  document.getElementById("offroute").setAttribute("hidden","");
                  document.getElementById("success").setAttribute("hidden","");
                  document.getElementById("successreject").setAttribute("hidden","");
                  document.getElementById("lotnotexist").setAttribute("hidden","");
                  document.getElementById("notexist").setAttribute("hidden","");
                  document.getElementById("serialreject").setAttribute("hidden","");
                  document.getElementById("wronglot").setAttribute("hidden","");
                  document.getElementById("error4").setAttribute("hidden","");
                  document.getElementById("SerialExists").setAttribute("hidden","");
                  document.getElementById("completed").setAttribute("hidden","");
                  document.getElementById("completed").removeAttribute("hidden");
                   document.getElementById("rejectlot").setAttribute("hidden","");

              }else if(res[0] == 'wrongmodel')
              {
                 $("#StextSerial").focus().select();
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("notexist").setAttribute("hidden","");
                  document.getElementById("serialreject").setAttribute("hidden","");
                  document.getElementById("wrongmodel").setAttribute("hidden","");
                  document.getElementById("offroute").setAttribute("hidden","");
                  document.getElementById("success").setAttribute("hidden","");
                  document.getElementById("successreject").setAttribute("hidden","");
                  document.getElementById("lotnotexist").setAttribute("hidden","");
                  document.getElementById("notexist").setAttribute("hidden","");
                  document.getElementById("serialreject").setAttribute("hidden","");
                  document.getElementById("wronglot").setAttribute("hidden","");
                  document.getElementById("error4").setAttribute("hidden","");
                  document.getElementById("SerialExists").setAttribute("hidden","");
                  document.getElementById("completed").setAttribute("hidden","");
                  document.getElementById("wrongmodel").removeAttribute("hidden");
                   document.getElementById("rejectlot").setAttribute("hidden","");

              }
               
                             
               }
              
            };

            xmlhttp.open("GET", "../php/packingregister.php?packingno=" + document.getElementById("StextSerial").value + "&model=" + document.getElementById("ScmbModel").value + "&station=" + document.getElementById("ScmbStation").value+ "&lotnumber=" + JSON.stringify(hserialno)+ "&total=" + document.getElementById("totalquantity").value, true);
            xmlhttp.send();
          }
                                      
          });


       $( "#btndone" ).click(function() {

        document.getElementById("error1").setAttribute("hidden","");
        document.getElementById("notexist").setAttribute("hidden","");
        document.getElementById("serialreject").setAttribute("hidden","");
        document.getElementById("wrongmodel").setAttribute("hidden","");
        document.getElementById("offroute").setAttribute("hidden","");
        document.getElementById("success").setAttribute("hidden","");
        document.getElementById("successreject").setAttribute("hidden","");
        document.getElementById("lotnotexist").setAttribute("hidden","");
        document.getElementById("notexist").setAttribute("hidden","");
        document.getElementById("serialreject").setAttribute("hidden","");
        document.getElementById("wronglot").setAttribute("hidden","");
        document.getElementById("error4").setAttribute("hidden","");
        document.getElementById("SerialExists").setAttribute("hidden","");
        document.getElementById("completed").setAttribute("hidden","");
         document.getElementById("rejectlot").setAttribute("hidden","");

        document.getElementById("StextLotNo").value = '';
        document.getElementById("btnGood").disabled = true;
        document.getElementById("btndone").disabled = true;
        document.getElementById("btnlot").disabled = true;
        document.getElementById("StextLotNo").disabled = true;
        document.getElementById("StextSerial").disabled = false;
        document.getElementById("ScmbModel").disabled = true;
        $("#StextSerial").focus();
        
        
       });

   tblcount = $('#tbldetails tr').length;

          $( "#btnGood" ).click(function() {
  

             document.getElementById("error4").setAttribute("hidden","");
             document.getElementById("error1").setAttribute("hidden","");
             document.getElementById("notexist").setAttribute("hidden","");
             document.getElementById("serialreject").setAttribute("hidden","");
             document.getElementById("wrongmodel").setAttribute("hidden","");
             document.getElementById("offroute").setAttribute("hidden","");
             document.getElementById("success").setAttribute("hidden","");
             document.getElementById("successreject").setAttribute("hidden","");
             document.getElementById("lotnotexist").setAttribute("hidden","");
             document.getElementById("wronglot").setAttribute("hidden","");
             document.getElementById("SerialExists").setAttribute("hidden","");
             document.getElementById("completed").setAttribute("hidden","");
              document.getElementById("rejectlot").setAttribute("hidden","");


            $('#tblsampling > tbody').append('<tr id="tr'+tbl2+'">'+
                                                '<td><input type="hidden" id = "count'+tbl2+'" name="count'+tbl2+' value="'+tbl2+'">'+tbl2+'</td>'+
                                                '<td><input type="hidden" id = "hserialno[]" name="hserialno[]" value="'+document.getElementById("StextLotNo").value+'">'+document.getElementById("StextLotNo").value+'</td>'+
                                                '<td><input type="hidden" id = "hmodel[]" name="hmodel[]" value="'+document.getElementById("ScmbModel").value+'">'+document.getElementById("ScmbModel").value+'</td>'+
                                                '<td><input type="hidden" id = "hmodel[]" name="hmodel[]" value="'+document.getElementById("LotQuantity").value+'">'+document.getElementById("LotQuantity").value+'</td>'+
                                                '</tr>');
              document.getElementById("PackingCount").value = tbl2;
                     tblcount++;
                     tbl2++;
        
            if(document.getElementById("totalquantity").value == '0'){
              document.getElementById("totalquantity").value = document.getElementById("LotQuantity").value;
            }else{
              document.getElementById("totalquantity").value = parseInt(document.getElementById("totalquantity").value ) + parseInt(document.getElementById("LotQuantity").value );
            }

           
            document.getElementById("StextLotNo").disabled = true;
            document.getElementById("shipmentdate").disabled = true;
            document.getElementById("ScmbModel").disabled = true;
            document.getElementById("btnGood").disabled = true;
            document.getElementById("btndone").disabled = true;
            document.getElementById("btnlot").disabled = false;
            $("#StextLotNo").focus();
      

          });


           $( "#btnlot" ).click(function() {

            var hserialno1 = $('input[name="hserialno[]"]').map(function () {
            return this.value; }).get();

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               // alert(result);
                var res = result.split("_"); 

                if(res[0] == 'success'){

                  document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("successreject").setAttribute("hidden","");
                   document.getElementById("lotnotexist").setAttribute("hidden","");
                   document.getElementById("wronglot").setAttribute("hidden","");
                   document.getElementById("SerialExists").setAttribute("hidden","");
                   document.getElementById("completed").setAttribute("hidden","");
                    document.getElementById("rejectlot").setAttribute("hidden","");

                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("success").removeAttribute("hidden");

                   document.getElementById("PackingCount").value = '0';
                   document.getElementById("totalquantity").value = '0';
                   document.getElementById("LotQuantity").value = '';

                    document.getElementById("btnGood").disabled = true;
                    document.getElementById("btndone").disabled = true;
                    document.getElementById("btnlot").disabled = true;


                $("#StextLotNo").focus();
                $("#tblsampling > tbody").empty();

                window.open('http://192.168.1.22:30/mes/print/e5.php?lot='+document.getElementById("StextLotNo").value+'&model='+document.getElementById("ScmbModel").value+'&qty='+document.getElementById("totalquantity").value+'&shipdate='+document.getElementById("shipmentdate").value)


                }
               
        
              }
            };
            
            xmlhttp.open("GET", "../php/packingdone.php?packingno=" + document.getElementById("StextSerial").value + "&model=" + document.getElementById("ScmbModel").value + "&station=" + document.getElementById("ScmbStation").value+ "&lotnumber=" + JSON.stringify(hserialno1)+ "&total=" + document.getElementById("totalquantity").value, true);
            xmlhttp.send();

             });


      });

  </script>  		
          </div>
        </div>
  </main>
