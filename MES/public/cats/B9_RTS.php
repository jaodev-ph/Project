
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
$qty ="";


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
      <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" >
    </div>

    
   <!--    <div class="row" >
         <div class="col-md-12">
          
            <button type="button" id="btnRTS" name="btnRTS" class="btn btn-success btn-lg" disabled>RTS</button>
          </div>
      </div> -->

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
                                <label>Qty:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtqty" name="txtqty" value="<?php echo $qty;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
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
                            <label>Qty:</label>
                         </div>
                         <div class="col-md-5">
                            <input id="txtRejectQty" type="text" name="txtRejectQty" class="form-control input-sm" disabled><br>
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
                                        <th class="info">Qty</th>
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
                      <button type="button" id="btnRejCancel" name="btnRejCancel" class="btn btn-warning btn-lg" disabled>Cancel</button>
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


        $('#StextSerial').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

 
         
      if (document.getElementById("StextSerial").value == '') {     
          return;
        }else {
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
              // alert(result);
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
            
                document.getElementById("SerialNumber").innerHTML = res[1];
                document.getElementById("txtModel").value = res[2];
                document.getElementById("txtLocation").value = res[3];
                document.getElementById("txtStatus").value = res[4];
                document.getElementById("txtCreatedBy").value = res[5];
                document.getElementById("txtqty").value = res[6];

                 document.getElementById("StextSerial").disabled = true;

                  $('#cmbrejectcat').focus();
         
                  document.getElementById("cmbrejectcat").disabled = false;
                  document.getElementById("cmbrejectcode").disabled = false;
                  document.getElementById("txtlocations").disabled = false;
                  document.getElementById("txtdetails").disabled = false;
                  document.getElementById("txtRejectQty").disabled = false;
                  document.getElementById("btnadd").disabled = false;
                  document.getElementById("btnRejCancel").disabled = false;


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
    
                document.getElementById("txtModel").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("StextSerial").value ='';

              }

              }
        };
              xmlhttp.open("GET", "../php/getserialdetails.php?serialno=" + document.getElementById("StextSerial").value, true);
            xmlhttp.send();
          }

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
                                               '<td><input type="hidden" id = "hRejectQty[]" name="hRejectQty[]" value="'+$('#txtRejectQty').val()+'">'+$('#txtRejectQty').val()+'</td>'+
                                            '<td><input type="hidden" id = "hdetails[]" name="hdetails[]" value="'+$('#txtdetails').val()+'">'+$('#txtdetails').val()+'</td>'+
                                            '<td><button type="button" onclick="removeRow('+tblcount+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+
                                            '</tr>');
            
             tblcount++;
             $('#cmbrejectcat').val("");
             $('#cmbrejectcode').val("");
             $('#txtlocations').val("");
             $('#txtRejectQty').val("");
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

              var hRejectQty = $('input[name="hRejectQty[]"]').map(function () {
            return this.value; }).get();

            var hdetails = $('input[name="hdetails[]"]').map(function () {
            return this.value; }).get();

            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
                 //alert(result);
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
                document.getElementById("txtqty").value = '';
                document.getElementById("txtLocation").value = '';
                document.getElementById("txtStatus").value = '';
                document.getElementById("txtCreatedBy").value = '';
                document.getElementById("StextSerial").value ='';
                 document.getElementById("StextSerial").disabled = false;
                $('#StextSerial').focus();
             
                document.getElementById("cmbrejectcat").disabled = true;
                document.getElementById("cmbrejectcode").disabled = true;
                document.getElementById("txtRejectQty").disabled = true;
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

            xmlhttp.open("GET", "../php/B9_addrejectRTS.php?serialno=" + document.getElementById("StextSerial").value +"&hrejectcat="+JSON.stringify(hrejectcat)+"&hrejectcode="+JSON.stringify(hrejectcode)+"&hlocation="+JSON.stringify(hlocation)+"&hRejectQty="+JSON.stringify(hRejectQty)+"&hdetails="+JSON.stringify(hdetails)+"&station="+ document.getElementById("txtLocation").value+"&qty="+ document.getElementById("txtqty").value, true);
            xmlhttp.send();

          });


            $( "#btnRejCancel" ).click(function() {

                document.getElementById("cmbrejectcat").value = '';
                document.getElementById("cmbrejectcode").value = '';;
                document.getElementById("txtlocations").value = '';
                document.getElementById("txtRejectQty").value = '';
                document.getElementById("txtdetails").value = '';
                  document.getElementById("btnRejDone").disabled = true;
                document.getElementById("btnRejCancel").disabled = true;
                 $("#tbldetails > tbody").empty();

        });
//        End----------------------------------------------------------------------------------------------------------------------------------

      });

  </script>     
          </div>
        </div>
  </main>
