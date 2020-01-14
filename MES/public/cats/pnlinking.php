
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

<?php

include_once("../classes/model.php");
 
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

   <Select class="form-control" id="ScmbModel" name="ScmbModel"  >
        <option></option>
        <?php 
            $SelectModel = Model::SelectAllModelBBA($_SESSION['account']);
            for($i=0;$i<count($SelectModel);$i++){
                ?>
            <option value ='<?php echo $SelectModel[$i]->getModel(); ?>' <?php if($cmbmodel==$SelectModel[$i]->getModel()) {echo "selected";} ?> ><?php echo $SelectModel[$i]->getModel(); ?></option>
                   <?php 
                 }
                 ?> 
                </Select>
    </div>


    <div class="form-group">
      <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" disabled >
    </div>

    
      <div class="row" align="right">
                    <div class="col-md-12">
                        <button type ="button" class="btn btn-success emp-btn" id ="btnLink" name="btnLink" disabled style="margin-right:10px;">Link</button>
                  
                         <a class="btn btn-warning emp-btn" href="">CLEAR</a>                  
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
                                <label>Station:</label>
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

 </form>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">


  $(document).ready(function () {

          if (document.getElementById("ScmbModel").value != '') {
             document.getElementById("StextSerial").disabled = false;
            $('#StextSerial').focus();
          }


           $('#ScmbModel').change(function (){

          // if (document.getElementById("ScmbModel").value == '') {

      if (document.getElementById("ScmbModel").value == '') { 
            document.getElementById("StextSerial").disabled = true;
                document.getElementById("StextSerial").value = '';
                document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
          return;
          }else {
            document.getElementById("StextSerial").disabled = false;
            $('#StextSerial').focus();
          }
           });
      
         $( "#btnLink" ).click(function() {

          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
                //alert(result);
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
                document.getElementById("btnLink").disabled = true;
          
                $('#StextSerial').focus();
                }else if(res[0] == 'offroute'){
                  document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("StextSerial").value =''; 
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
                document.getElementById("btnLink").disabled = true;
                
                }else if(res[0] == 'forcardlink'){
                   document.getElementById("txtModel").value = '';
                document.getElementById("txtRev").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("StextSerial").value ='';
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
                document.getElementById("btnLink").disabled = true;
          
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
                document.getElementById("btnLink").disabled = true;
              
                }
               
              }
            };

            xmlhttp.open("GET", "../php/updatelink.php?serialno=" + document.getElementById("StextSerial").value+"&model="+ document.getElementById("ScmbModel").value+"&modelno="+ document.getElementById("txtModel").value+"&station="+ document.getElementById("txtLocation").value, true);
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
                //alert(result);
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
                document.getElementById("btnLink").disabled = false;
              
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
                document.getElementById("btnLink").disabled = true;
        
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
                document.getElementById("btnLink").disabled = true;
                
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
                document.getElementById("btnLink").disabled = true;
                
                }                
              }
        };
              xmlhttp.open("GET", "../php/pnlinkgetserial.php?serialno=" + document.getElementById("StextSerial").value, true);
            xmlhttp.send();
          }

          }

        });



//        End----------------------------------------------------------------------------------------------------------------------------------

      });

  </script>     
          </div>
        </div>
  </main>
