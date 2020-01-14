
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
include_once("../classes/partcode.php");
$readonly ="readonly";
$model ="";
$revision ="";
$line ="";
$location ="";
$status = "";
$createdby ="";
$cmbmodel ="";
$cmbline ="";
$qty="";
$partcode ="";
$disableinit ="";
$shift="";
$mode="";
$isLink="";


    if(isset($_POST['lotMode'])){
              $mode = $_POST['lotMode'];  
              
              if($mode==2){
                $lotenable = 'autofocus';
              }

           }



?>

  <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
    
   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Lot number <b id="SerialNumber" name="SerialNumber"></b> is successfully completed!</div>

   <div id = "successreject" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is successfully rejected!</div>

   <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Wrong Lot number!</div>

   <div id = "error4" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot number <b id="Serial_Error6" name="Serial_Error6"></b> is already completed!</div>

   <div id = "serialreject" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error5" name="Serial_Error5"></b> is REJECT!</div>

   <div id = "wrongmodel" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Wrong Model!</div>

   <div id = "offroute" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error3" name="Serial_Error3"></b> is offroute!</div>

   <div id = "notexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error4" name="Serial_Error4"></b> is not exist!</div>

      <div id = "lotnotexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot <b id="Serial_Error7" name="Serial_Error7"></b> is not exist!</div>

   <div id = "alreadyonlot" class="alert alert-danger alert-dismissible" role="alert" hidden>
 <!--   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error4" name="Serial_Error4"></b> is already belong to lot !</div>


     <form method="POST" id = "PTLOT">
                <div id="lotMode" name="lotMode" class="row">
                    <div class="col-md-4">
                        <h3><input type="radio" style="width:20px;height:20px;" id="Single" name="lotMode" value="1" checked <?php if($mode=="1"){ echo "checked";} ?>/>SINGLE</h3>
                    </div>
                    <div class="col-md-4">
                        <h3><input type="radio" style="width:20px;height:20px;" id="Multi" name="lotMode" value="2" <?php if($mode=="2"){ echo "checked";} ?> />MULTI</h3>
                    </div>
                    <div class="col-md-4">
                        <h3><input type="checkbox" style="width:20px;height:20px;" id="isLink" name="isLink" <?php echo $isLink; ?>/> LINK</h3>
                    </div>
                </div>


    <div class="form-group">
      <label for="usr">Part Code:</label>

      <Select class="form-control" id="Scmbpartcode" name="Scmbpartcode" value="<?php echo $partscode;?>" >
      	<option></option>
   <?php $parts = Partcode::getAllPartsCode($_SESSION['account']);
         for($i=0;$i<count($parts);$i++){ ?>
          <option value="<?php echo $parts[$i]->getPartcode().'|'.$parts[$i]->getDescription().'|'.$parts[$i]->getModel(); ?>"  
            <?php if($partcode==$parts[$i]->getPartcode().'|'.$parts[$i]->getDescription().'|'.$parts[$i]->getModel()){echo 'selected';} ?>><?php echo $parts[$i]->getPartcode().' - '.$parts[$i]->getDescription(); ?></option>
    <?php } ?>
      </Select>
    </div>


    <div class="form-group">
      <label for="usr">Model:</label>
  <input type="text" class="form-control" id="Stextmodel" name="Stextmodel" readonly>
    </div>
<div class ="row">

  
  <div class="col-md-6">
    <label for="usr">Line:</label>
    <Select class="form-control" id="ScmbLine" name="ScmbLine" disabled>
      <option></option>
        <?php 
        $SelectLine = Line::SelectAllLine($_SESSION['account'],$_SESSION['module']);
        for($i=0;$i<count($SelectLine);$i++){
          ?>
          <option value ='<?php echo $SelectLine[$i]->getLine(); ?>' <?php if($cmbline== $SelectLine[$i]->getLine()) {echo "selected";} ?> >Line: <?php echo $SelectLine[$i]->getLine(); ?></option>
                 <?php  } ?>
    </Select>
</div>

  <div class="col-md-6">
   <label for="usr">Shift:</label>
     <select class="form-control" id="ScmbShift" name="ScmbShift" <?php echo $disableinit.' '.$disabled; ?> required >
        <option></option>
        <option value="A" <?php if($shift=='A'){echo 'selected';} ?>>A - Day Shift</option>
        <option value="B" <?php if($shift=='B'){echo 'selected';} ?>>B - Night Shift</option>
        <option value="C" <?php if($shift=='C'){echo 'selected';} ?>>C - 10PM ~ 6AM</option>
        <option value="D" <?php if($shift=='D'){echo 'selected';} ?>>D - Whole Day</option>
      </select>
   </div>
  </div>
         
  <div class="form-group">
      <label for="usr">Station:</label>
      <input type="text" class="form-control" id="ScmbStation" name="ScmbStation" readonly>

    </div>

    <div class="form-group">
      <label for="usr">Lot Number:</label>
      <input type="text" class="form-control" id="StextLotNo" name="StextLotNo" onkeypress="if (event.keyCode == 13)  return false;" disabled >
    </div>

    <div class="form-group">
      <label for="usr">Reference Number:</label>
      <input type="text" class="form-control" id="StextReferenceno" name="StextReferenceno" onkeypress="if (event.keyCode == 13)  return false;" disabled >
    </div>

    <div class="form-group">
      <label for="usr">Required Quantity:</label>
      <input type="text" class="form-control" id="RQuantity" name="RQuantity" onkeypress="if (event.keyCode == 13) return false;" disabled>

    </div>

  <div class="row">
  <div class="form-group">
     <div class="col-sm-6">
      <label for="usr">Lot Quantity:</label>
      <input type="text" class="form-control" id="LotQuantity" name="LotQuantity" readonly>
  </div>
    <div class="col-sm-6">
      <label for="usr">Total Quantity:</label>
      <input type="text" class="form-control" id="TotalQuantity" name="TotalQuantity" readonly>
  </div>
    </div>
  </div>

    <div class="form-group">
      <br>
      <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" disabled autocomplete="off" >
    </div>


    
      <div class="row" >
                    <div class="col-md-12">
                        <button type ="button" class="btn btn-success emp-btn" id ="btnGood" name="btnGood" disabled style="margin-right:10px;">GOOD</button>
                        <button type ="button" class="btn btn-warning emp-btn" id ="btnReject" name="btnReject" disabled style="margin-right:10px;">REJECT</button> 
                        <button type ="button" class="btn btn-info emp-btn" id ="btnlot" name="btnlot" disabled style="margin-right:10px;">Lot Done</button>  
                        <!-- <button type ="submit" class="btn btn-warning emp-btn" id ="btnCancel" name="btnCancel"  style="margin-right:10px;">Cancel</button>    -->                 
                    </div>
      </div>




    </div>
    <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop">
      
        <div class="panel panel-primary">
                  <div class="panel-heading">Lot  Number Details</div>
                    <div class="panel-body">
                          <div class="row">
                            <div class="col-md-3">
                                <label>Model:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="lottxtModel" name="lottxtModel" value="<?php echo $model;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          
                          </div>                    
                          <div class="row">
                            <div class="col-md-3">
                                <label>Station:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="lottxtLocation" name="lottxtLocation" value="<?php echo $location;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                             <div class="row">
                            <div class="col-md-3">
                                <label>PartCode:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="lottxtpartcode" name="lottxtpartcode" value="<?php echo $location;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                              <div class="row">
                            <div class="col-md-3">
                                <label>Status:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="lottxtStatus" name="lottxtStatus" value="<?php echo $status;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>

                              <div class="row">
                            <div class="col-md-3">
                                <label>Reference Count:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="lottxtquantity" name="lottxtquantity" value="<?php echo $qty;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>

                              <div class="row">
                            <div class="col-md-3">
                                <label>Lot Quantity:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="Totallotquantity" name="Totallotquantity" value="<?php echo $qty;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Created By:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="lottxtCreatedBy" name="lottxtCreatedBy" value="<?php echo $createdby;?>" class="form-control input-sm" <?php echo $readonly;  ?>><br>
                            </div>
                          </div>
                  </div>      
              </div>
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
                                <label>Quantity:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="txtquantity" name="txtquantity" value="<?php echo $qty;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
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
                            <label>Quantity:</label>
                         </div>
                         <div class="col-md-5">
                            <input id="txtqty" type="number" name="txtqty" class="form-control input-sm" disabled><br>
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
                                        <th class="info">Qty</th>
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

//           if (document.getElementById("ScmbLine").value != '' && document.getElementById("ScmbModel").value != '') {
//              document.getElementById("StextSerial").disabled = false;
//             $('#StextSerial').focus();
//           }
        $( "#Single" ).click(function() {

           document.getElementById("StextLotNo").value= '';
            document.getElementById("Stextmodel").value= '';
            document.getElementById("ScmbStation").value= '';
            document.getElementById("Scmbpartcode").value= '';
            document.getElementById("ScmbStation").value= '';
            document.getElementById("ScmbShift").value= '';
            document.getElementById("ScmbLine").value= '';
            document.getElementById("StextReferenceno").value= '';
            document.getElementById("StextLotNo").value= '';
            document.getElementById("lottxtModel").value= '';
            document.getElementById("lottxtLocation").value= '';
            document.getElementById("lottxtStatus").value= '';
            document.getElementById("lottxtCreatedBy").value= '';
            document.getElementById("lottxtquantity").value= '';
            document.getElementById("lottxtpartcode").value= '';
            document.getElementById("Totallotquantity").value= '';
            document.getElementById("RQuantity").value= 0;
            document.getElementById("LotQuantity").value= 0;
            document.getElementById("TotalQuantity").value= 0;
            document.getElementById("Scmbpartcode").disabled=false; 
            document.getElementById("StextLotNo").disabled=true;  
            document.getElementById("btnReject").disabled=true;
            document.getElementById("btnGood").disabled=true;
            document.getElementById("btnlot").disabled=true;  
            document.getElementById("RQuantity").disabled=true;

          });

          $( "#Multi" ).click(function() {

            document.getElementById("StextLotNo").value= '';
            document.getElementById("Stextmodel").value= '';
            document.getElementById("ScmbStation").value= '';
            document.getElementById("Scmbpartcode").value= '';
            document.getElementById("ScmbStation").value= '';
            document.getElementById("ScmbShift").value= '';
            document.getElementById("ScmbLine").value= '';
            document.getElementById("StextReferenceno").value= '';
            document.getElementById("StextLotNo").value= '';
            document.getElementById("lottxtModel").value= '';
            document.getElementById("lottxtLocation").value= '';
            document.getElementById("lottxtStatus").value= '';
            document.getElementById("lottxtCreatedBy").value= '';
            document.getElementById("lottxtquantity").value= '';
            document.getElementById("lottxtpartcode").value= '';
            document.getElementById("Totallotquantity").value= '';
            document.getElementById("RQuantity").value= 0;
            document.getElementById("LotQuantity").value= 0;
            document.getElementById("TotalQuantity").value= 0;
            document.getElementById("ScmbShift").disabled=true;
            document.getElementById("ScmbLine").disabled=true;
            document.getElementById("Scmbpartcode").disabled=true;
            document.getElementById("btnReject").disabled=true;
            document.getElementById("btnGood").disabled=true;
            document.getElementById("btnlot").disabled=true;  
            document.getElementById("StextLotNo").disabled=false;
            //document.getElementById("RQuantity").disabled=false;

            document.getElementById("StextLotNo").focus();  

          });


           $('#Scmbpartcode').change(function (){

          // if (document.getElementById("ScmbModel").value == '') {

      if (document.getElementById("Scmbpartcode").value == '') { 
          document.getElementById("StextLotNo").disabled = true; 

          document.getElementById("ScmbStation").value = '';
          document.getElementById("StextLotNo").value = '';
          document.getElementById("RQuantity").value = '';
          document.getElementById("StextSerial").value = '';
          document.getElementById("LotQuantity").value = '';
          document.getElementById("StextSerial").disabled = true; 
          document.getElementById("btnGood").disabled = true;
          document.getElementById("btnReject").disabled = true;
          document.getElementById("btnlot").disabled = true;

            $('#Scmbpartcode').focus();
          return;
          }else {
            document.getElementById("StextSerial").disabled = true; 
            document.getElementById("StextSerial").value = '';
            document.getElementById("StextLotNo").select();
            document.getElementById("LotQuantity").value = '';
  
            document.getElementById("btnlot").disabled = true;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
            /*   alert(result)*/
       

               document.getElementById("ScmbStation").value = res[0];
               document.getElementById("RQuantity").value = res[1];
               document.getElementById("Stextmodel").value = res[2];
               document.getElementById("lottxtLocation").value = res[0];
               document.getElementById("lottxtModel").value = res[2];
               document.getElementById("lottxtpartcode").value = res[3];

               }
              
            };

            xmlhttp.open("GET", "../php/lotpartcodemodelstation.php?modelno=" + document.getElementById("Stextmodel").value+ "&partcode=" + document.getElementById("Scmbpartcode").value, true);
            xmlhttp.send();
          
            document.getElementById("ScmbShift").disabled = false;
         /*   document.getElementById("StextLotNo").disabled = false; */
            $('#ScmbShift').focus();
          }

          });

        $('#ScmbShift').change(function (){
          if (document.getElementById("Scmbpartcode").value == '') {
            $('#Scmbpartcode').focus();
            /*document.getElementById("StextLotNo").disabled = true;*/
          }else{
            document.getElementById("Scmbpartcode").disabled = true;
            document.getElementById("ScmbShift").disabled = true;
         document.getElementById("ScmbLine").disabled = false;
             $('#ScmbLine').focus();
          }
        });



        $('#RQuantity').keyup(function(event){
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if (keycode == '13'){
          if (document.getElementById("RQuantity").value == 0) {
            $('#RQuantity').focus();
            document.getElementById("StextSerial").disabled = true;
          }if (document.getElementById("Single").checked == true){
            document.getElementById("StextSerial").disabled = false;
            $('#StextSerial').focus();
          }if (document.getElementById("Multi").checked == true){
             document.getElementById("RQuantity").disabled = true;
             $('#StextSerial').focus();
          } 
        }
        });


      $('#ScmbLine').change(function (){
          if (document.getElementById("Scmbpartcode").value == '') {
            $('#Scmbpartcode').focus();
            /*document.getElementById("StextLotNo").disabled = true;*/
          }else{

            document.getElementById("Scmbpartcode").disabled = true;
            document.getElementById("ScmbShift").disabled = true;
         document.getElementById("ScmbLine").disabled = true;
         
          document.getElementById("RQuantity").disabled = false;
             $('#ScmbLine').focus();


            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
               /*alert(result)*/
         if(res[0] == 'success'){

            document.getElementById("StextLotNo").value = res[1];
            document.getElementById("StextReferenceno").value = res[2];
              
          }else if(res[0] == 'open'){
            document.getElementById("StextLotNo").disabled = false;
            document.getElementById("StextLotNo").focus();
            document.getElementById("StextLotNo").select();
          }
               }
              
            };

            xmlhttp.open("GET", "../php/B9_generatelotno.php?modelno=" + document.getElementById("Stextmodel").value+ "&partcode=" + document.getElementById("Scmbpartcode").value+ "&station=" + document.getElementById("ScmbStation").value+ "&shift=" + document.getElementById("ScmbShift").value+ "&line=" + document.getElementById("ScmbLine").value+ "&Multi=" + document.getElementById("Multi").checked+ "&Single=" + document.getElementById("Single").checked, true);
            xmlhttp.send();
         
        document.getElementById("RQuantity").focus();
        document.getElementById("RQuantity").select();

          }
        });

          $('#StextLotNo').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

              var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
              //alert(result);
                if(res[1]== 'true'){

                document.getElementById("LotQuantity").value = res[0]; 
                document.getElementById("TotalQuantity").value = res[2];
                document.getElementById("StextReferenceno").value = res[3];
                document.getElementById("lottxtModel").value = res[4];
                document.getElementById("lottxtLocation").value = res[5];
                document.getElementById("lottxtStatus").value = res[6];
                document.getElementById("lottxtquantity").value = res[7];
                document.getElementById("lottxtCreatedBy").value = res[8];
                document.getElementById("lottxtpartcode").value = res[9];
                document.getElementById("Totallotquantity").value = res[10]; 
                document.getElementById("StextLotNo").value = res[11];      
                document.getElementById("StextSerial").disabled = false; 
                document.getElementById("StextLotNo").disabled = true;
                document.getElementById("StextReferenceno").disabled = true;
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("alreadyonlot").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                 document.getElementById("RQuantity").disabled = false;
                document.getElementById("RQuantity").focus();
                document.getElementById("RQuantity").select();
                }


                if(res[1]== 'false'){
                   document.getElementById("btnGood").disabled = true;
                   document.getElementById("btnReject").disabled = true;
                   document.getElementById("btnlot").disabled = false;
                   document.getElementById("StextSerial").disabled = true;
                   document.getElementById("LotQuantity").value = res[0];
                   document.getElementById("TotalQuantity").value = res[2];                  
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("txtModel").value = '';
                   document.getElementById("txtRev").value = '';
                   document.getElementById("txtLocation").value = '';
                   document.getElementById("txtStatus").value = '';
                   document.getElementById("txtCreatedBy").value = '';

                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("alreadyonlot").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");

                }
                if(res[0] == 'error4'){
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error4").removeAttribute("hidden");
                document.getElementById("LotQuantity").value = res[0];
                document.getElementById("TotalQuantity").value = res[2]; 
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("alreadyonlot").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");

                }

                if(res[0] == 'lotnotexist'){
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("lotnotexist").setAttribute("hidden","");
                   document.getElementById("lotnotexist").removeAttribute("hidden");
                   document.getElementById("successreject").setAttribute("hidden","");

                   document.getElementById("StextLotNo").select();
                 }
                if(res[0] == 'error1' || res[0] == 'error2'){
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error1").removeAttribute("hidden");
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("alreadyonlot").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                 document.getElementById("StextLotNo").select();
                }
                
               }
              
            };

            xmlhttp.open("GET", "../php/B9_batchlotexist.php?model=" + document.getElementById("Stextmodel").value + "&lotno=" + document.getElementById("StextLotNo").value + "&station=" + document.getElementById("ScmbStation").value+"&RQuantity=" + document.getElementById("RQuantity").value, true);
            xmlhttp.send();
           

          }

          });


          $('#StextSerial').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

              var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
               /*alert(result);*/
                 if(res[0] == 'true'){

                   document.getElementById("txtModel").value = res[2];
                   document.getElementById("txtRev").value = res[3];
                   document.getElementById("txtLocation").value = res[1];
                   document.getElementById("txtStatus").value = res[4];
                   document.getElementById("txtCreatedBy").value = res[5];
                   document.getElementById("txtquantity").value = res[6];
                   document.getElementById("btnGood").disabled = false;
                   document.getElementById("btnReject").disabled = false;
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("successreject").setAttribute("hidden","");
                  
                   
                 }else if(res[0] == 'offroute'){
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("offroute").removeAttribute("hidden");
                   document.getElementById("successreject").setAttribute("hidden","");

                   document.getElementById("txtModel").value = '';
                   document.getElementById("txtRev").value = '';
                   document.getElementById("txtLocation").value = '';
                   document.getElementById("txtStatus").value = '';
                   document.getElementById("txtCreatedBy").value = '';
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("StextSerial").disabled = false;
                   document.getElementById("btnGood").disabled = true;
                   document.getElementById("btnReject").disabled = true;

                 }else if(res[0] == 'wrongmodel'){
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("wrongmodel").removeAttribute("hidden");
                   document.getElementById("successreject").setAttribute("hidden","");

                    document.getElementById("txtModel").value = '';
                   document.getElementById("txtRev").value = '';
                   document.getElementById("txtLocation").value = '';
                   document.getElementById("txtStatus").value = '';
                   document.getElementById("txtCreatedBy").value = '';
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("StextSerial").disabled = false;
                   document.getElementById("btnGood").disabled = true;
                   document.getElementById("btnReject").disabled = true;

                 }else if(res[0] == 'serialreject'){
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("successreject").setAttribute("hidden","");
                   document.getElementById("serialreject").removeAttribute("hidden");

                    document.getElementById("txtModel").value = '';
                   document.getElementById("txtRev").value = '';
                   document.getElementById("txtLocation").value = '';
                   document.getElementById("txtStatus").value = '';
                   document.getElementById("txtCreatedBy").value = '';
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("StextSerial").disabled = false;
                   document.getElementById("btnGood").disabled = true;
                   document.getElementById("btnReject").disabled = true;

                 }else if(res[0] == 'notexist'){
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("notexist").removeAttribute("hidden");
                   document.getElementById("successreject").setAttribute("hidden","");

                    document.getElementById("txtModel").value = '';
                   document.getElementById("txtRev").value = '';
                   document.getElementById("txtLocation").value = '';
                   document.getElementById("txtStatus").value = '';
                   document.getElementById("txtCreatedBy").value = '';
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("StextSerial").disabled = false;
                   document.getElementById("btnGood").disabled = true;
                   document.getElementById("btnReject").disabled = true;

                 }

               }
              
            };

            xmlhttp.open("GET", "../php/batchlotserial.php?serialno=" + document.getElementById("StextSerial").value + "&model=" + document.getElementById("lottxtModel").value + "&station=" + document.getElementById("lottxtLocation").value, true);
            xmlhttp.send();
           

          }

          });




          $( "#btnGood" ).click(function() {

            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
                //alert(result);
                var res = result.split("_"); 

                if(res[0] == 'success'){
                  //alert(res[0]);
                  if(res[4] == 'completed'){
                    
                   document.getElementById("LotQuantity").value = res[2]; 
                   document.getElementById("TotalQuantity").value = res[3];
                   document.getElementById("btnGood").disabled = true;
                   document.getElementById("btnReject").disabled = true;
                   document.getElementById("btnlot").disabled = false;
                   document.getElementById("StextSerial").disabled = true;   
                   document.getElementById("RQuantity").disabled = true;              
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("txtModel").value = '';
                   document.getElementById("txtRev").value = '';
                   document.getElementById("txtLocation").value = '';
                   document.getElementById("txtStatus").value = '';
                   document.getElementById("txtCreatedBy").value = '';
                   document.getElementById("txtquantity").value = '';
              /*     document.getElementById("ScmbModel").disabled = true;*/
                  
                  }else{

                  document.getElementById("LotQuantity").value = res[2]; 
                  document.getElementById("TotalQuantity").value = res[3];
                  document.getElementById("StextSerial").value = '';
                  document.getElementById("txtModel").value = '';
                  document.getElementById("txtRev").value = '';
                  document.getElementById("txtLocation").value = '';
                  document.getElementById("txtStatus").value = '';
                  document.getElementById("txtCreatedBy").value = '';
                  document.getElementById("StextSerial").value = '';
                  document.getElementById("txtquantity").value = '';
                  document.getElementById("lottxtpartcode").value= '';
                  document.getElementById("btnGood").disabled = true;
                  document.getElementById("btnReject").disabled = true;
                  document.getElementById("btnlot").disabled = true;
                 
                   $('#StextSerial').focus();

                  }

                }else if(res[0] == 'alreadyonlot'){

                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("alreadyonlot").setAttribute("hidden","");
                   document.getElementById("alreadyonlot").removeAttribute("hidden");
                   document.getElementById("successreject").setAttribute("hidden","");

                }
        
              }
            };

            xmlhttp.open("GET", "../php/B9_addbatchtolot.php?serialno=" + document.getElementById("StextSerial").value+"&lotno="+ document.getElementById("StextLotNo").value +"&station=" + document.getElementById("lottxtLocation").value+"&RQuantity=" + document.getElementById("RQuantity").value +"&Quantity=" + document.getElementById("txtquantity").value+"&line=" + document.getElementById("ScmbLine").value+"&total=" + document.getElementById("TotalQuantity").value+"&reference=" + document.getElementById("StextReferenceno").value, true);
            xmlhttp.send();

          });


           $( "#btnlot" ).click(function() {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
                /*alert(result);*/
                var res = result.split("_"); 

                if(res[0] == 'success'){

                      if (document.getElementById("Single").checked == true){
                             
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("success").removeAttribute("hidden");
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("successreject").setAttribute("hidden","");

           /*       document.getElementById("StextLotNo").disabled = false;
                  document.getElementById("StextSerial").disabled = true;
                  document.getElementById("btnGood").disabled = true;
                  document.getElementById("btnReject").disabled = true;
                  document.getElementById("btnlot").disabled = true;
                
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("success").removeAttribute("hidden");
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("successreject").setAttribute("hidden","");
                  
                  document.getElementById("ScmbLine").focus();*/

                    window.open('http://192.168.1.22:30/mes/print/B9_lotPT.php?lot='+document.getElementById("StextLotNo").value+'&ref='+document.getElementById("StextReferenceno").value+'&model='+document.getElementById("Stextmodel").value+'&partcode='+document.getElementById("lottxtpartcode").value+'&qty='+document.getElementById("LotQuantity").value)

                        document.getElementById("StextSerial").value = '';
                 /* document.getElementById("StextLotNo").value = '';*/
                  document.getElementById("txtModel").value = '';
                  document.getElementById("txtRev").value = '';
                  document.getElementById("LotQuantity").value = '';
                  document.getElementById("txtLocation").value = '';
                  document.getElementById("txtStatus").value = '';
                  document.getElementById("txtCreatedBy").value = '';  
                  document.getElementById("txtquantity").value = '';
                  document.getElementById("TotalQuantity").value = '';
                  document.getElementById("StextLotNo").value = '';
                  document.getElementById("StextReferenceno").value = '';
                  document.getElementById("ScmbLine").value = '';
                  /*document.getElementById("lottxtModel").value= '';*/
                  /*document.getElementById("lottxtLocation").value= '';*/
                  document.getElementById("lottxtStatus").value= '';
                  document.getElementById("lottxtCreatedBy").value= '';
                  document.getElementById("lottxtquantity").value= '';
                  document.getElementById("Totallotquantity").value= '';
                  document.getElementById("txtquantity").value = 0; 
                  document.getElementById("RQuantity").value = '';   
                

              }else if (document.getElementById("Multi").checked == true){
                      
                  document.getElementById("StextLotNo").disabled = true;
                  document.getElementById("StextSerial").disabled = true;
                  document.getElementById("btnGood").disabled = true;
                  document.getElementById("btnReject").disabled = true;
                  document.getElementById("btnlot").disabled = true;
                
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("success").removeAttribute("hidden");
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("successreject").setAttribute("hidden","");
                  
                  document.getElementById("StextLotNo").focus();


            window.open('http://192.168.1.22:30/mes/print/B9_lotPT.php?lot='+document.getElementById("StextLotNo").value+'&ref='+document.getElementById("StextReferenceno").value+'&model='+document.getElementById("Stextmodel").value+'&partcode='+document.getElementById("lottxtpartcode").value+'&qty='+document.getElementById("LotQuantity").value)


                 document.getElementById("StextSerial").value = '';
                 /* document.getElementById("StextLotNo").value = '';*/
                  document.getElementById("txtModel").value = '';
                  document.getElementById("txtRev").value = '';
                  document.getElementById("LotQuantity").value = '';
                  document.getElementById("txtLocation").value = '';
                  document.getElementById("txtStatus").value = '';
                  document.getElementById("txtCreatedBy").value = '';  
                  document.getElementById("txtquantity").value = '';
                  document.getElementById("TotalQuantity").value = '';
                  document.getElementById("StextLotNo").value = '';
                  document.getElementById("StextReferenceno").value = '';
                  document.getElementById("ScmbLine").value = '';
                 /* document.getElementById("lottxtModel").value= '';*/
                 /* document.getElementById("lottxtLocation").value= '';*/
                  document.getElementById("lottxtStatus").value= '';
                  document.getElementById("lottxtCreatedBy").value= '';
                  document.getElementById("lottxtquantity").value= '';
                  document.getElementById("lottxtpartcode").value= '';
                  document.getElementById("Totallotquantity").value= '';
                  document.getElementById("txtquantity").value = 0; 
                  document.getElementById("RQuantity").value = '';  

              }
                document.getElementById("ScmbLine").disabled = false;
                document.getElementById("RQuantity").disabled = true;
                }
               
        
              }
            };
            
            xmlhttp.open("GET", "../php/B9_batchlotclose.php?lotno="+ document.getElementById("StextLotNo").value +"&station=" + document.getElementById("lottxtLocation").value+"&partcode=" + document.getElementById("lottxtpartcode").value+"&LotQuantity=" + document.getElementById("LotQuantity").value+"&modelno="+ document.getElementById("lottxtModel").value+"&total=" + document.getElementById("TotalQuantity").value +"&reference=" + document.getElementById("StextReferenceno").value, true);
            xmlhttp.send();


             });



  $( "#btnReject" ).click(function() {

if (document.getElementById("StextSerial").value == '') { 
      $( "#btnReject" ).focus();    
          return;
        }else {

          document.getElementById("btnGood").disabled = true;
          document.getElementById("btnReject").disabled = true;
          document.getElementById("btnlot").disabled = true;
          document.getElementById("cmbrejectcat").disabled = false;
          document.getElementById("cmbrejectcode").disabled = false;
          document.getElementById("txtlocations").disabled = false;
          document.getElementById("txtdetails").disabled = false;
          document.getElementById("btnadd").disabled = false;
          document.getElementById("btnRejCancel").disabled = false;
          document.getElementById("StextSerial").disabled = true;
         /* document.getElementById("ScmbModel").disabled = true;*/
          document.getElementById("txtqty").disabled = false;


        }
        
        
 });
        
tblcount = $('#tbldetails tr').length;

          $( "#btnadd" ).click(function() {

            var trd = $('#cmbrejectcat').val().split(":");

              if(($('#cmbrejectcat').val()!="")&&($('#cmbrejectcode').val()!="")&&($('#txtlocations').val()!="") || trd[0].trim() == 'TRD'){
                
            $('#tbldetails > tbody').append('<tr id="tr'+tblcount+'">'+
                                            '<td><input type="hidden" id = "hrejectcat[]"  name="hrejectcat[]" value="'+$('#cmbrejectcat').val()+'">'+$('#cmbrejectcat').val()+'</td>'+
                                            '<td><input type="hidden" id = "hrejectcode[]" name="hrejectcode[]" value="'+$('#cmbrejectcode').val()+'">'+$('#cmbrejectcode').val()+'</td>'+
                                            '<td><input type="hidden" id = "hqty[]" name="hqty[]" value="'+$('#txtqty').val()+'">'+$('#txtqty').val()+'</td>'+
                                            '<td><input type="hidden" id = "hlocation[]" name="hlocation[]" value="'+$('#txtlocations').val()+'">'+$('#txtlocations').val()+'</td>'+
                                            '<td><input type="hidden" id = "hdetails[]" name="hdetails[]" value="'+$('#txtdetails').val()+'">'+$('#txtdetails').val()+'</td>'+
                                            '<td><button type="button" onclick="removeRow('+tblcount+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+
                                            '</tr>');
            
             tblcount++;
             $('#cmbrejectcat').val("");
             $('#cmbrejectcode').val("");
             $('#txtlocations').val("");
             $('#txtdetails').val("");
             $('#txtqty').val("");
             checkRow(tblcount);
        }
     

             });



    
          $( "#btnRejDone" ).click(function() {

            // JSON.stringify(hrejectcat)

            var hrejectcat = $('input[name="hrejectcat[]"]').map(function () {
            return this.value; }).get();

            var hrejectcode = $('input[name="hrejectcode[]"]').map(function () {
            return this.value; }).get();

             var hqty = $('input[name="hqty[]"]').map(function () {
            return this.value; }).get();

            var hlocation = $('input[name="hlocation[]"]').map(function () {
            return this.value; }).get();

            var hdetails = $('input[name="hdetails[]"]').map(function () {
            return this.value; }).get();

            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               /* alert(result);*/
                var res = result.split("_"); 
                if(res[0] == 'successreject'){

                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("alreadyonlot").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");

                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("successreject").removeAttribute("hidden");
      
                document.getElementById("Serial_Error6").innerHTML = res[1];
                document.getElementById("StextSerial").value = '';
                document.getElementById("StextSerial").disabled = false;
              /*  document.getElementById("ScmbModel").disabled = false;*/
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
                document.getElementById("txtqty").disabled = true;
                document.getElementById("btnadd").disabled = true;
                document.getElementById("btnRejDone").disabled = true;
                document.getElementById("btnRejCancel").disabled = true;
                document.getElementById("cmbrejectcat").value = '';
                document.getElementById("cmbrejectcode").value = '';;
                document.getElementById("txtlocations").value = '';
                document.getElementById("txtdetails").value = '';
                document.getElementById("txtquantity").value = '';
                $("#tbldetails > tbody").empty();
                }
              }
            };

            xmlhttp.open("GET", "../php/addrejectbatch.php?serialno=" + document.getElementById("StextSerial").value+"&lotno=" + document.getElementById("StextLotNo").value+"&model=" + document.getElementById("Stextmodel").value+"&hrejectcat="+JSON.stringify(hrejectcat)+"&hrejectcode="+JSON.stringify(hrejectcode)+"&hlocation="+JSON.stringify(hlocation)+"&hdetails="+JSON.stringify(hdetails)+"&line=noline"+"&station="+ document.getElementById("ScmbStation").value+"&nextStation=noresult"+"&hRejectQty="+JSON.stringify(hqty)+"&Qty="+document.getElementById("txtquantity").value+"&line="+document.getElementById("ScmbLine").value, true);
            xmlhttp.send();

          });
//        End----------------------------------------------------------------------------------------------------------------------------------

      });

  </script>  		
          </div>
        </div>
  </main>
