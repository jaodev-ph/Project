
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

<?php

include_once("../classes/model.php");
include_once("../classes/line.php");
include_once("../classes/defectcatprod.php");
include_once("../classes/defectprod.php");
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


  <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop">
    
   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Serial <b id="SerialNumber" name="SerialNumber"></b> is successfully updated!</div>

   <div id = "successreject" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is successfully rejected!</div>

   <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
  <!--  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error1" name="Serial_Error1"></b> is not exist!</div>

   <div id = "offroute" class="alert alert-danger alert-dismissible" role="alert" hidden>
  <!--  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> <b id="Serial_Error2" name="Serial_Error2"></b>: Offroute!</div>

   <div id = "forcardlink" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error3" name="Serial_Error3"></b> is for card linking!</div>

    <div id = "forlotmaking" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error4" name="Serial_Error4"></b> is for lot making!</div>

   <div id = "serialreject" class="alert alert-danger alert-dismissible" role="alert" hidden>
 <!--   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error5" name="Serial_Error5"></b> is REJECT!</div>

   <div id = "wrongmodel" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Wrong Model!</div>

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

      <Select class="form-control" id="ScmbStation" name="ScmbStation" disabled>
        <option></option>
      </Select>
    </div>

    <div class="form-group">
      <label for="usr">Line:</label>
      <Select class="form-control" id="ScmbLine" name="ScmbLine" disabled>
      	<option></option>
           <?php 
            $SelectLine = Line::SelectAllLine($_SESSION['account'],$_SESSION['module']);
                     for($i=0;$i<count($SelectLine);$i++){
                ?>
                <option value ='<?php echo $SelectLine[$i]->getLine(); ?>' <?php if($cmbline== $SelectLine[$i]->getLine()) {echo "selected";} ?> >Line: <?php echo $SelectLine[$i]->getLine(); ?></option>
                 <?php 
       }
       ?>
      </Select>
    </div>

  

    <div class="form-group">
      <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" disabled >
    </div>

    
      <div class="row" >
                    <div class="col-md-12">
                        <button type ="button" class="btn btn-success emp-btn" id ="btnGood" name="btnGood" disabled style="margin-right:10px;">GOOD</button>
                        <button style="float:right;" type ="button" class="btn btn-warning emp-btn" id ="btnReject" name="btnReject" disabled>REJECT</button>                   
                    </div>

      </div>

    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
      

  <div class="panel panel-primary">
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

    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
    
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
            
          </div>
 </form>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  var tblcount;

      function removeRow(row){
        
            $("#tr"+row).remove();
             tblcount = $('#tblSerialDetails > tbody tr').length;
             checkRow(tblcount);
        }

         function checkRow(row){
            if(row>0){
                document.getElementById('btnRejDone').disabled = false;
            }else{
                document.getElementById('btnRejDone').disabled = true;
            }
        }

  $(document).ready(function () {

          if (document.getElementById("ScmbLine").value != '' && document.getElementById("ScmbModel").value != '') {
             document.getElementById("StextSerial").disabled = false;
            $('#StextSerial').focus();
          }


           $('#ScmbModel').change(function (){

          // if (document.getElementById("ScmbModel").value == '') {

      if (document.getElementById("ScmbModel").value == '') { 

            document.getElementById("ScmbStation").disabled = true;
            document.getElementById("ScmbStation").value == '';
            document.getElementById("ScmbStation").innerHTML = "";
            document.getElementById("StextSerial").disabled = true;
                document.getElementById("StextSerial").value = '';
                document.getElementById("ScmbLine").disabled = true;
                document.getElementById("ScmbLine").value = '';
                document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
          return;
          }else {

            document.getElementById("ScmbStation").disabled = false;
            document.getElementById("ScmbStation").innerHTML = "";  
             $('#ScmbStation').focus();
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
               var x1 = document.getElementById("ScmbStation");
               var option1 = document.createElement("option");
               option1.text = '';
               x1.add(option1);
               for (i = 0; i < res.length - 1; i++) { 
                      // alert(res[i]);
                      var x = document.getElementById("ScmbStation");
                      var option = document.createElement("option");
                      option.text = res[i];
                      x.add(option);
                    }
              }
            };

            xmlhttp.open("GET", "../php/getmodelroute.php?modelno=" + document.getElementById("ScmbModel").value+"&formodel=0&station=test", true);
            xmlhttp.send();
          }


       
           });


          $('#ScmbStation').change(function (){
            document.getElementById("ScmbLine").value = '';

          if (document.getElementById("ScmbStation").value == '') {
            $('#ScmbStation').focus();
                document.getElementById("StextSerial").disabled = true;
                document.getElementById("StextSerial").value = '';
                document.getElementById("ScmbLine").disabled = true;
                document.getElementById("ScmbLine").value = '';
                document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
          }else{

  
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               if(result == 1){
                document.getElementById("ScmbLine").disabled = false;
                $('#ScmbLine').focus();
                document.getElementById("StextSerial").disabled = true;
                document.getElementById("StextSerial").value = '';
                document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
               }else{
                document.getElementById("ScmbLine").disabled = true;
                document.getElementById("ScmbLine").value = '';
                document.getElementById("StextSerial").disabled = false;
                document.getElementById("StextSerial").value = '';
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;

                 $('#StextSerial').focus();
               }
               
              }
            };

            xmlhttp.open("GET", "../php/getmodelroute.php?modelno=" + document.getElementById("ScmbModel").value +"&formodel=1"+"&station="+ document.getElementById("ScmbStation").value, true);
            xmlhttp.send();
          

        }
           });
      
           $('#ScmbLine').change(function (){
          if (document.getElementById("ScmbLine").value == '') {
           
                document.getElementById("StextSerial").disabled = true;
                document.getElementById("StextSerial").value = '';
                document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;

          }else{
                document.getElementById("StextSerial").disabled = false;
                $('#StextSerial').focus();
          }
        });          

         $( "#btnGood" ).click(function() {


          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 

                if(res[0] == 'success'){

                document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("StextSerial").value ='';
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("success").removeAttribute("hidden");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                $('#StextSerial').focus();
                }else if(res[0] == 'offroute'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("offroute").removeAttribute("hidden");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("Serial_Error2").innerHTML = res[1];
                document.getElementById("StextSerial").value ='';
                $('#StextSerial').focus();
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                }else if(res[0] == 'forcardlink'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("forcardlink").removeAttribute("hidden");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("Serial_Error2").innerHTML = res[1];
                document.getElementById("StextSerial").value ='';
                $('#StextSerial').focus();
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                }else if(res[0] == 'forlotmaking'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("forlotmaking").removeAttribute("hidden");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("Serial_Error4").innerHTML = res[1];
                document.getElementById("StextSerial").value ='';
                $('#StextSerial').focus();
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                }
               
              }
            };

            xmlhttp.open("GET", "../php/updatecard.php?serialno=" + document.getElementById("StextSerial").value +"&line="+document.getElementById("ScmbLine").value+"&station="+ document.getElementById("ScmbStation").value+"&nextStation="+ document.getElementById("txtLocation").value, true);
            xmlhttp.send();


            
        });


        $('#StextSerial').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

          document.getElementById("success").setAttribute("hidden","");
          document.getElementById("offroute").setAttribute("hidden","");
          document.getElementById("error1").setAttribute("hidden","");
          document.getElementById("forlotmaking").setAttribute("hidden","");
          document.getElementById("forcardlink").setAttribute("hidden","");
          document.getElementById("serialreject").setAttribute("hidden","");
          document.getElementById("successreject").setAttribute("hidden","");
          document.getElementById("serialreject").setAttribute("hidden","");
         

      if (document.getElementById("StextSerial").value == '') {     
          return;
        }else {
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
           /*      alert(result);*/
               if( res[0]  == 'success'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("btnGood").disabled = false;
                document.getElementById("btnReject").disabled = false;
                document.getElementById("SerialNumber").innerHTML = res[1];
                document.getElementById("txtModel").value = res[2];
                document.getElementById("txtRev").value = res[3];
                document.getElementById("txtLocation").value = res[4];
                document.getElementById("txtStatus").value = res[5];
                document.getElementById("txtCreatedBy").value = res[6];


              }else if(res[0] == 'error1'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error1").removeAttribute("hidden");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("Serial_Error1").innerHTML = res[1];
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("StextSerial").value ='';

              }else if(res[0] == 'serialreject'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("serialreject").removeAttribute("hidden");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("Serial_Error5").innerHTML = res[1];
                document.getElementById("StextSerial").value ='';
                $('#StextSerial').focus();
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                }else if(res[0] == 'wrongmodel'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("wrongmodel").removeAttribute("hidden");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("Serial_Error5").innerHTML = res[1];
                document.getElementById("StextSerial").value ='';
                $('#StextSerial').focus();
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                }




              }
        };
              xmlhttp.open("GET", "../php/fpcagetserial.php?serialno=" + document.getElementById("StextSerial").value +"&model=" + document.getElementById("ScmbModel").value, true);
            xmlhttp.send();
          }

          }

        });



  $( "#btnReject" ).click(function() {

if (document.getElementById("StextSerial").value == '') { 
      $( "#btnReject" ).focus();    
          return;
        }else {

     var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
               // alert(result);
                if(res[0] == 'success'){
                  $('#cmbrejectcat').focus();
                   document.getElementById("btnGood").disabled = true;
                  document.getElementById("cmbrejectcat").disabled = false;
                  document.getElementById("cmbrejectcode").disabled = false;
                  document.getElementById("txtlocations").disabled = false;
                  document.getElementById("txtdetails").disabled = false;
                  document.getElementById("btnadd").disabled = false;
                  document.getElementById("btnRejCancel").disabled = false;
                  

                }else if(res[0] == 'offroute'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("offroute").removeAttribute("hidden");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("Serial_Error2").innerHTML = res[1];
                document.getElementById("StextSerial").value ='';
                $('#StextSerial').focus();
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                }else if(res[0] == 'forcardlink'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("forcardlink").removeAttribute("hidden");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("Serial_Error2").innerHTML = res[1];
                document.getElementById("StextSerial").value ='';
                $('#StextSerial').focus();
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                }else if(res[0] == 'forlotmaking'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("forlotmaking").removeAttribute("hidden");
                document.getElementById("serialreject").setAttribute("hidden","");
                 document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("Serial_Error4").innerHTML = res[1];
                document.getElementById("StextSerial").value ='';
                $('#StextSerial').focus();
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;
                }
               
              }
            };

            xmlhttp.open("GET", "../php/rejectstatus.php?serialno=" + document.getElementById("StextSerial").value +"&line="+document.getElementById("ScmbLine").value+"&station="+ document.getElementById("ScmbStation").value+"&nextStation="+ document.getElementById("txtLocation").value, true);
            xmlhttp.send();
          }

     });

        
        tblcount = $('#tbldetails tr').length;

        

          $( "#btnadd" ).click(function() {

            var trd = $('#cmbrejectcat').val().split(":");

              if(($('#cmbrejectcat').val()!="")&&($('#cmbrejectcode').val()!="")&&($('#txtlocations').val()!="") || trd[0].trim() == 'TRD'){
                
            $('#tbldetails > tbody').append('<tr id="tr'+tblcount+'">'+
                                            '<td><input type="hidden" id = "hrejectcat[]"  name="hrejectcat[]" value="'+$('#cmbrejectcat').val()+'">'+$('#cmbrejectcat').val()+'</td>'+
                                            '<td><input type="hidden" id = "hrejectcode[]" name="hrejectcode[]" value="'+$('#cmbrejectcode').val()+'">'+$('#cmbrejectcode').val()+'</td>'+
                                            '<td><input type="hidden" id = "hlocation[]" name="hlocation[]" value="'+$('#txtlocations').val()+'">'+$('#txtlocations').val()+'</td>'+
                                            '<td><input type="hidden" id = "hdetails[]" name="hdetails[]" value="'+$('#txtdetails').val()+'">'+$('#txtdetails').val()+'</td>'+
                                            '<td><button type="button" onclick="removeRow('+tblcount+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+
                                            '</tr>');
            
             tblcount++;
             $('#cmbrejectcat').val("");
             $('#cmbrejectcode').val("");
             $('#txtlocations').val("");
             $('#txtdetails').val("");
             checkRow(tblcount);
        }
     

             });

    
          $( "#btnRejDone" ).click(function() {

            // JSON.stringify(hrejectcat)

            var hrejectcat = $('input[name="hrejectcat[]"]').map(function () {
            return this.value; }).get();

            var hrejectcode = $('input[name="hrejectcode[]"]').map(function () {
            return this.value; }).get();

            var hlocation = $('input[name="hlocation[]"]').map(function () {
            return this.value; }).get();

            var hdetails = $('input[name="hdetails[]"]').map(function () {
            return this.value; }).get();

            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
                // alert(result);
                var res = result.split("_"); 
                if(res[0] == 'successreject'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("forcardlink").setAttribute("hidden","");
                document.getElementById("forlotmaking").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("successreject").removeAttribute("hidden");
                document.getElementById("Serial_Error6").innerHTML = res[1];
                document.getElementById("StextSerial").value = '';
                document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("StextSerial").value ='';
                $('#StextSerial').focus();
                document.getElementById("btnGood").disabled = true;
                document.getElementById("btnReject").disabled = true;

                document.getElementById("cmbrejectcat").disabled = true;
                document.getElementById("cmbrejectcode").disabled = true;
                document.getElementById("txtlocations").disabled = true;
                document.getElementById("txtdetails").disabled = true;
                document.getElementById("btnadd").disabled = true;
                document.getElementById("btnRejDone").disabled = true;
                document.getElementById("btnRejCancel").disabled = true;
                document.getElementById("cmbrejectcat").value = '';
                document.getElementById("cmbrejectcode").value = '';;
                document.getElementById("txtlocations").value = '';
                document.getElementById("txtdetails").value = '';
                $("#tbldetails > tbody").empty();
                }
              }
            };

            xmlhttp.open("GET", "../php/addreject.php?serialno=" + document.getElementById("StextSerial").value +"&hrejectcat="+JSON.stringify(hrejectcat)+"&hrejectcode="+JSON.stringify(hrejectcode)+"&hlocation="+JSON.stringify(hlocation)+"&hdetails="+JSON.stringify(hdetails)+"&line="+document.getElementById("ScmbLine").value+"&station="+ document.getElementById("ScmbStation").value+"&nextStation="+ document.getElementById("txtLocation").value, true);
            xmlhttp.send();

          });
//        End----------------------------------------------------------------------------------------------------------------------------------

      });

  </script>  		
          </div>
        </div>
  </main>
