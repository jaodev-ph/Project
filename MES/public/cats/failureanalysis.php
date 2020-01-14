
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

<?php
include_once("../classes/model.php");
include_once("../classes/line.php");
include_once("../classes/defectcatprod.php");
include_once("../classes/defectprod.php");
include_once("../classes/repair.php");
include_once("../classes/card.php");
include_once("../classes/station.php");
include_once("../classes/modelroute.php");
$readonly ="readonly";
$model ="";
$type ="";
$line ="";
$location ="";
$status = "";
$createdby ="";
$cmbmodel ="";
$cmbline ="";
$disabled = "disabled";
$serial ="";
$success = false;
$successReturn = false;
$error1 = false;
$error2 = false;
$error3 = false;
$error4 = false;
$proceed = false;


if(isset($_POST['btnSubmit'])){

  $serialno = explode(" ",$_POST['StextSerial']);
  $serial = $serialno[0];
  $exist = Card::checkExist(trim($_SESSION['account']),$serialno[0]);

      if($exist == 'true'){



      $Card = new Card(trim($_SESSION['account']),$serialno[0]);

      if($Card->getStatus() == 'REJECT'){
        $forFa = ModelRoute::forFA(trim($_SESSION['account']),$Card->getCurtStage(),$Card->getPartNo());
       
        if($forFa == 'false'){
       // echo "error3_".$serialno[0];
          $error3 = true;
      }else{
        if(Card::checkifverify(trim($_SESSION['account']),$serialno[0]) == 0){
        if($Card->getLotType() == 'N'){
          $type ='N: Normal';
        }else if($Card->getLotType() == 'D'){
          $type ='D: Debug';
        }else if($Card->getLotType() == 'R'){
          $type ='R: Return';
        }else if($Card->getLotType() == 'S'){
          $type ='S: Special';
        }

        $Station = new Station();
        $Station->StationDetails(trim($_SESSION['account']),$Card->getCurtStage());
        $discription = $Card->getCurtStage().": ".$Station->getDescription();
  
        $model = $Card->getPartNo();
        $type = $type;
        $location = $discription;
        $status = $Card->getStatus();
        $createdby = $Card->getLastUpdatedBy();
        $proceed = true;
        // echo "success_".$serialno[0]."_".$Card->getPartNo()."_".$type."_".$discription."_".$Card->getStatus()."_".$Card->getLastUpdatedBy();
         $disabled  = '';
       }else{
          $error4 = true;
       }

      }

      }else{
         // echo "error2_".$serialno[0];
        $error2 = true;
      }

      }else{       
        // echo "error1_".$serialno[0];
        $error1 = true;
      }


}


?>

    <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop">

   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Serial <b id="SerialNumber" name="SerialNumber"></b> is successfully repaired!</div>

   <div id = "successReturn" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Serial <b id="SerialNumber1" name="SerialNumber1"></b> is successfully returned!</div>

  <?php if($error1){ ?>
   <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" <?php ?>>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Serial <b id="Serial_Error1" name="Serial_Error1"></b> is not exist!</div>
  <?php } ?> 
  <?php if($error2){ ?>
   <div id = "error2" class="alert alert-danger alert-dismissible" role="alert" >
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Serial <b id="Serial_Error2" name="Serial_Error2"></b> is not reject!</div>
   <?php } ?> 
   <?php if($error3){ ?>
   <div id = "error3" class="alert alert-danger alert-dismissible" role="alert" >
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> <b id="Serial_Error3" name="Serial_Error3"></b> is not for FA station!</div>
   <?php } ?> 
   <?php if($error4){ ?>
   <div id = "error4" class="alert alert-danger alert-dismissible" role="alert" >
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> <b id="Serial_Error3" name="Serial_Error3"></b> is already verify!</div>
   <?php } ?> 
     <form method="POST">

       <div class="form-group" >
        <br />
      <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" value ='<?php echo $serial;  ?>' >
        <button type ="submit" name="btnSubmit" id="btnSubmit" class="btn btn-success btn-lg" hidden>Submit</button>
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
                            <input type="text" id="txtRev" name="txtRev" value="<?php echo $type;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>                      
                          <div class="row">
                            <div class="col-md-3">
                                <label>Location:</label>
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
                                <label>Rejected By:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="txtCreatedBy" name="txtCreatedBy" value="<?php echo $createdby;?>" class="form-control input-sm" <?php echo $readonly;  ?>><br>
                            </div>
                          </div>
                  </div>      
              </div>

    </div>

      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
       
                <div class="panel panel-primary"  style="margin-top:20px">
                  <div class="panel-heading">Reject Details</div>
                  <div class="panel-body">
                      
                      <div class="table-responsive">
                            <table class="table table-bordered" id="tbldetails" >
                                <thead>
                                    <tr>
                                        <th class="info">Tracking No</th>
                                        <th class="info">Reject Category</th>
                                        <th class="info">Reject Code</th>
                                        <th class="info">Location</th>
                                        <th class="info">Details</th>
                                        <!-- <th class="info">Action</th> -->
                                    </tr>
                                </thead> 

                                 <tbody id="tbldetails" >
                                    <?php 
                                    if ($proceed == true){
                                    $repair2 = Repair::GetAllReject(trim($_SESSION['account']),$serial);
                                    for($i=0;$i<count($repair2);$i++){
                                    ?>

                                    <tr id="tr<?php echo $repair2[$i]->getTrackingNo(); ?>">
                                        <td><?php echo $repair2[$i]->getTrackingNo(); ?>
                                            <input type="hidden" name="trackingnos[]" value="<?php echo $repair2[$i]->getTrackingNo(); ?>">
                                        </td>
                                        <td>
                                          <select class="form-control input-sm" name="cmbrejectcat2[]" <?php if($repair2[$i]->getStatus()=="1"){ echo $readonly;} ?>>
                                            <option></option>
                                            <?php 
                                                $optdefectcat = DefectCatProd::getalldefectcatprod(trim($_SESSION['account']));
                                                for($z=0;$z<count($optdefectcat);$z++){
                                              ?>
                                              
                                                <option value="<?php echo $optdefectcat[$z]->getDefectCatCode(); ?>" <?php if(trim($optdefectcat[$z]->getDefectCatCode())==trim($repair2[$i]->getCategory())){ echo "selected";} ?>><?php echo $optdefectcat[$z]->getDescription(); ?></option>
                                              <?php } ?>
                                          </select></td>
                                        <td>
                                          <select class="form-control input-sm" name="cmbrejectcode2[]" <?php if($repair2[$i]->getStatus()=="1"){ echo $readonly;} ?>>
                                              <option></option>
                                              <?php 
                                                $optdefect = DefectCodeProd::getalldefectprod(trim($_SESSION['account']));
                                                for($z=0;$z<count($optdefect);$z++){
                                              ?>
                                            
                                                <option value="<?php echo $optdefect[$z]->getDefectCode(); ?>" <?php if(trim($optdefect[$z]->getDefectCode())==trim($repair2[$i]->getDefect())){ echo "selected";} ?>><?php echo $optdefect[$z]->getDescription(); ?></option>
                                              <?php } ?>
                                          </select></td>
                                        <td><input type="text" class="form-control" name="txtlocation2[]" value="<?php echo $repair2[$i]->getLocation(); ?>" <?php if($repair2[$i]->getStatus()=="1"){ echo $dischk;} ?>></td>
  
                                        <td><input type="text" class="form-control" name="txtdetails2[]" value="<?php echo $repair2[$i]->getDetails(); ?>" <?php if($repair2[$i]->getStatus()=="1"){ echo $dischk;} ?>></td>
                                   
                                        <!-- <td><button type="button" onclick="removeRow('<?php echo $repair2[$i]->getTrackingNo(); ?>')" type="button" class="btn btn-danger btn-sm">Remove</button></td> -->
                                    </tr>

                                    <?php } 
                                  } ?>
                                </tbody>                         
                            </table>
                      </div>
                  </div>    
                  <div class="panel-footer text-right">
                      <button type ="button" name="btnFaDone" id="btnFaDone" class="btn btn-success btn-lg" <?php echo $disabled; ?>>Verify</button>
                    <button type="submit"  id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" >Cancel</button>
                  </div>
                
      </div>
 </form>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  var TrackingNo;
  var trackquantity;
 function removeRow(row){
        
            $("#tr"+row).remove();
             tblcount = $('#tbldetails > tbody tr').length;
             // checkRow(tblcount);
        }
   $('#StextSerial').focus();

  $(document).ready(function () {

        $('#StextSerial').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

            $("#btnSubmit").trigger('click'); 
            document.getElementById("btnSubmit").click();
          }

        });

      $( "#btnFaDone" ).click(function() {
      
        var trackingnos = $('input[name="trackingnos[]"]').map(function () {
            return this.value; }).get();
        var cmbrejectcat2 = $('select[name="cmbrejectcat2[]"]').map(function () {
            return this.value; }).get();
        var cmbrejectcode2 = $('select[name="cmbrejectcode2[]"]').map(function () {
            return this.value; }).get();
        var txtlocation2 = $('input[name="txtlocation2[]"]').map(function () {
            return this.value; }).get();
        var txtdetails2 = $('input[name="txtdetails2[]"]').map(function () {
            return this.value; }).get();


         // for (i = 0; i < trackingnos.length; i++) {
         // alert(trackingnos[i]);
         // }

         var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
               
               if(res[0]=='success'){
                 $("#tbldetails").find("tr:not(:first)").remove();
                document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("StextSerial").value = '';
                document.getElementById("btnFaDone").disabled = true;
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("success").removeAttribute("hidden");
                document.getElementById("SerialNumber").innerHTML = res[1];
                $('#StextSerial').focus();
               }

              }
            };

            xmlhttp.open("GET", "../php/farejectdetails.php?serialno=" + document.getElementById("StextSerial").value +"&trackingnos="+JSON.stringify(trackingnos)+"&cmbrejectcat2="+JSON.stringify(cmbrejectcat2)+"&cmbrejectcode2="+JSON.stringify(cmbrejectcode2)+"&txtlocation2="+JSON.stringify(txtlocation2)+"&txtdetails2="+JSON.stringify(txtdetails2), true);
            xmlhttp.send();

         });

      

      });

  </script>


  <!-- -------------------------------------------------------------------------------------------------------------------------------- -->       
          </div>
        </div>
  </main>
