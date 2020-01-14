  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->


<?php

include_once("../classes/model.php");

$readonly ="readonly";
$model ="";
$location ="";
$lotno ="";
$status = "";
$createdby ="";
$cmbmodel ="";


?>

  <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop">
    
   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Lot number <b id="SerialNumber" name="SerialNumber"></b> is successfully completed!</div>

   <div id = "successreject" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is successfully rejected!</div>

   <div id = "successremove" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Serial <b id="Serial_Error9" name="Serial_Error9"></b> successfully removed!</div>

   <div id = "successadd" class="alert alert-success alert-dismissible" role="alert" hidden>

       <strong>Success!</strong> Serial <b id="Serial_Error10" name="Serial_Error10"></b> successfully Added!</div>

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

     <div id = "seriallotnotexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> No Serial <b id="Serial_Error4" name="Serial_Error4"></b> found in this LOT!</div>

     <div id = "SerialExists" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is already belong to sampling!</div>

    <div id = "alreadyinlot" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error" name="Serial_Error6"></b> is already belong to LOT!</div>

      <div id = "lotreject" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot Number<!-- <b id="Serial_Error5" name="Serial_Error5"></b> --> is NOT REJECT!</div>


     <form method="POST">

    <div class="form-group">
      <label for="usr">Model:</label>

      <Select class="form-control" id="ScmbModel" name="ScmbModel" >
        <option></option>
        <?php 
            $SelectModel = Model::SelectAllMotherModel($_SESSION['account']);
                     for($i=0;$i<count($SelectModel);$i++){
                ?>
<option value ='<?php echo $SelectModel[$i]->getModel(); ?>' <?php if($cmbmodel==$SelectModel[$i]->getModel()) {echo "selected";} ?> ><?php echo $SelectModel[$i]->getModel(); ?> </option>
         <?php 
       }
       ?> 
      </Select>
    </div>

    <div class="form-group">
      <label for="usr">Mother Serial Number</label>
      <input type="text" class="form-control" id="Stextmotherserial" name="Stextmotherserial"  onkeypress="if (event.keyCode == 13)  return false;"  autocomplete="off" disabled>
    </div>

    <div class="form-group">
      <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;"  autocomplete="off" disabled>
    </div>


      <div class="row" align="right" >
                    <div class="col-md-12">
                      <button type ="button" class="btn btn-primary emp-btn" id ="btnUnlink" name="btnUnlink" disabled style="margin-right:10px;">UNLINK</button>  
                                                                       
          </div>
      </div>




    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">

  <div class="panel panel-primary">
                    <div class="panel-heading">Mother Serial  Number Details</div>
                    <div class="panel-body">
                          <div class="row">
                            <div class="col-md-3">
                                <label>Model:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtModel" name="txtModel"  class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                       
                          </div>                    
                          <div class="row">
                            <div class="col-md-3">
                                <label>Station:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtLocation" name="txtLocation"  class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                              <div class="row">
                            <div class="col-md-3">
                                <label>Status:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="txtStatus" name="txtStatus" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                      
                           <div class="row">
                            <div class="col-md-3">
                                <label>Created By:</label>
                            </div>

                            <div class="col-md-5">
                            <input type="text" id="txtCreatedBy" name="txtCreatedBy" class="form-control input-sm" <?php echo $readonly;  ?>><br>
                            </div>
                          </div>
                  </div>      
              </div>

    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
              <div class="panel panel-primary" >
                  <div class="panel-heading" >Link Details</div>
                  <div class="panel-body">
                      <br />
                      <div class="table-responsive" style="overflow-x: scroll;height:150px;">
                            <table class="table table-bordered"  id="tblreject" >
                                <thead>
                                    <tr>
                                        <th class="info">Serial Number</th>
                                        <th class="info">Status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                      </div>
                  </div>    
      
                </div>
      
          </div>
 </form>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  var tblcount;

  $(document).ready(function () {
       

           $('#ScmbModel').change(function (){

          // if (document.getElementById("ScmbModel").value == '') {

      if (document.getElementById("ScmbModel").value == '') { 

            document.getElementById("Stextmotherserial").disabled = true;
            document.getElementById("ScmbStation").value == '';
     
            document.getElementById("StextSerial").disabled = true;
                document.getElementById("StextSerial").value = '';
             
                document.getElementById("txtModel").value = ''
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("txtQty").value = '';
          return;
          }else {

            document.getElementById("Stextmotherserial").disabled = false;
              document.getElementById("ScmbModel").disabled = true;
              document.getElementById("Stextmotherserial").focus();
                document.getElementById("Stextmotherserial").Select();
            
          }


       
           });


$('#Stextmotherserial').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

            if(keycode == '13'){

                var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
                alert(result);
                if (res[0] == 'success'){

                    document.getElementById("Stextmotherserial").disabled = true;
                    document.getElementById("StextSerial").disabled = false;
                    document.getElementById("StextSerial").focus();

                    document.getElementById("wrongmodel").setAttribute("hidden","");
                    document.getElementById("notexist").setAttribute("hidden","");

                }else if (res[0] == 'error1'){

                    document.getElementById("StextSerial").disabled = true;
                    document.getElementById("Stextmotherserial").focus();
                    document.getElementById("Stextmotherserial").Select();

                    document.getElementById("wrongmodel").setAttribute("hidden","");

                    document.getElementById("notexist").setAttribute("hidden","");
                    document.getElementById("notexist").removeAttribute("hidden");

                }else if (res[0] == 'wrongmodel'){

                  document.getElementById("Stextmotherserial").value = '';

                  document.getElementById("StextSerial").disabled = true;
                  document.getElementById("Stextmotherserial").disabled = true;
                  document.getElementById("ScmbModel").disabled = false;
                  document.getElementById("ScmbModel").focus();

                  document.getElementById("notexist").setAttribute("hidden","");
                  document.getElementById("wrongmodel").setAttribute("hidden","");
                  document.getElementById("wrongmodel").removeAttribute("hidden");

                }    
                    
               }
              
            };

            xmlhttp.open("GET", "../php/getmotherserial.php?serialno=" + document.getElementById("Stextmotherserial").value+"&model=" + document.getElementById("ScmbModel").value, true);
            xmlhttp.send();
          }
      

           
          });

$('#StextSerial ').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

            if(keycode == '13'){

                var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
                alert(result);
                if (res[0] == 'success'){

                    document.getElementById("StextSerial").disabled = false;
                    document.getElementById("StextSerial").focus();

                }    
     
                             
               }
              
            };

            xmlhttp.open("GET", "../php/getserialdetails.php?serialno=" + document.getElementById("StextSerial").value+"&model=" + document.getElementById("ScmbModel").value, true);
            xmlhttp.send();
          }
      

           
          });


       // End----------------------------------------------------------------------------------------------------------------------------------

      });

  </script>     
          </div>
        </div>
  </main>
