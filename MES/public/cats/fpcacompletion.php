
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

<?php

include_once("../classes/model.php");
include_once("../classes/line.php");
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

  <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-desktop">
    
   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Lot number <b id="SerialNumber" name="SerialNumber"></b> is successfully completed!</div>

   <div id = "successreject" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is successfully rejected!</div>

   <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot number is REJECT!</div>

   <div id = "error4" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot number <b id="Serial_Error6" name="Serial_Error6"></b> is already completed!</div>

      <div id = "error5" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot number <b id="Serial_Error7" name="Serial_Error7"></b> is rejected!</div>

   <div id = "serialreject" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error5" name="Serial_Error5"></b> is REJECT!</div>

   <div id = "wrongmodel" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Wrong Model!</div>

   <div id = "offroute" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error3" name="Serial_Error3"></b> is offroute!</div>

  <div id = "Lotoffroute" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot <b id="Lot_Error1" name="Lot_Error1"></b> is offroute!</div>

   <div id = "notexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error4" name="Serial_Error4"></b> is not exist!</div>

   <div id = "Lotnotexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot <b id="Lot_Error2" name="Lot_Error2"></b> is not exist!</div>

   <div id = "alreadyonlot" class="alert alert-danger alert-dismissible" role="alert" hidden>
 <!--   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Serial <b id="Serial_Error4" name="Serial_Error4"></b> is already belong to lot !</div>


     <form method="POST">
    <div class="form-group">
      <label for="usr">Lot Number:</label>
      <input type="text" class="form-control" id="StextLotNo" name="StextLotNo" onkeypress="if (event.keyCode == 13)  return false;" autocomplete="off">
      </Select>
    </div>

    <div class="form-group">
      <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" disabled autocomplete="off">
    </div>

      <div class="form-group">
   
      <label for="pwd">Count:</label>
      <input type="number" class="form-control" id="Stextcount" name="Stextcount"  placeholder="0" readonly>
    </div>
      <div class="row" >
          <div class="col-md-12">
          <button type ="button" class="btn btn-success emp-btn" id ="btnDone" name="btnDone" disabled style="margin-right:10px;">DONE</button>
          <button type ="button" class="btn btn-warning emp-btn" id ="btnReset" name="btnReset"  style="margin-right:10px;" onclick="window.location.reload()">RESET</button>        
        </div>
      </div>
    </div>


    <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop">

             <div class="panel panel-primary" >
                  <div class="panel-heading" >Lot Details:</div>
                  <div class="panel-body"
                      <br />
                  
                         <div class="row">
                         <div class="col-md-3">
                            <label>Model:</label>
                         </div>
                         <div class="col-md-5">
                            <input id="txtModel" type="text" name="txtModel" class="form-control input-sm" disabled><br>
                         </div>
                      </div>
                    
                      <div class="row">
                        <div class="col-md-3">
                            <label>Quantity:</label>
                         </div>
                         <div class="col-md-5">
                            <input id="txtQty" type="text" name="txtQty" class="form-control input-sm" disabled><br>
                         </div>
                       </div>

                       <div class="row">
                        <div class="col-md-3">
                            <label>Next Station:</label>
                         </div>
                         <div class="col-md-5">
                            <input id="txtStation" type="text" name="txtStation" class="form-control input-sm" disabled><br>
                         </div>
                       </div>

                           <div class="row">
                        <div class="col-md-3">
                            <label>Status:</label>
                         </div>
                         <div class="col-md-5">
                            <input id="txtStatus" type="text" name="txtStatus" class="form-control input-sm" disabled><br>
                         </div>                       
                       </div>
                
                  </div>    
                </div>
    
            
          
          </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
              <div class="panel panel-primary" >
                  <div class="panel-heading" >Scanned Serials:</div>
                  <div class="panel-body"
                      <br />
                      <div class="table-responsive">
                            <table class="table table-bordered"  id="tbldetails" >
                                <thead>
                                    <tr>
                                        <th class="info">Serial</th>
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
  var proceed = false;

   tblcount = $('#tbldetails tr').length; 

         function checkRow(row){
            if(row>0){
                document.getElementById('btnDone').disabled = false;
            }else{
                document.getElementById('btnDone').disabled = true;
            }
        }

  $(document).ready(function () {


          $('#StextLotNo').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

              var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
        /*        alert(result);*/

                if(res[0] == 'true'){

             /*   document.getElementById("lotno").value = res[1];*/
                document.getElementById("txtModel").value = res[2];
                document.getElementById("txtQty").value = res[3];
                document.getElementById("txtStatus").value = res[4];
                document.getElementById("txtStation").value = res[5];
                document.getElementById("StextSerial").disabled = false; 
                document.getElementById("StextLotNo").disabled = true;
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("alreadyonlot").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");     

                $('#StextSerial').focus();
                }

                if(res[0]== 'false'){
                document.getElementById("StextLotNo").value="";
                document.getElementById("btnDone").disabled = true;
                document.getElementById("StextSerial").disabled = true;
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("alreadyonlot").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                $('#StextLotNo').focus();

                }
                if(res[0] == 'notexist'){
                document.getElementById("Lotnotexist").setAttribute("hidden","");
                document.getElementById("Lotnotexist").removeAttribute("hidden");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("alreadyonlot").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("StextLotNo").value="";
                $('#StextLotNo').focus();

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
                }
                else if(res[0] == 'offroute'){
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("Lotoffroute").setAttribute("hidden","");
                   document.getElementById("Lotoffroute").removeAttribute("hidden");
                   document.getElementById("successreject").setAttribute("hidden","");
                   document.getElementById("StextLotNo").value = '';
                   document.getElementById("btnDone").disabled = true;
            
                 }
                

               }
              
            };

            xmlhttp.open("GET", "../php/completionlotcheck.php?&lotno=" + document.getElementById("StextLotNo").value + "&model=" + document.getElementById("txtModel").value, true);
            xmlhttp.send();
           
          }

          });


          $('#StextSerial').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

                 var textSerial1 = $('input[name="textSerial[]"]').map(function () {
            return this.value; }).get(); 

                   for(x=0;x<textSerial1.length;x++){
        
                        if(textSerial1[x] == document.getElementById("StextSerial").value){
                           proceed = false;   
                           document.getElementById("StextSerial").value='';
                           $("#StextSerial").focus().select();
                           alert("Serial Already Exist in Table!");
                              
                        }else{
   
                          proceed = true;
                        }
                     }

      if(proceed == true || textSerial1.length == 0){
              var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
              // alert(result);
                 if(res[0] == 'true'){

      tblcount = $('#tbldetails tr').length;
                
      $('#tbldetails > tbody').append('<tr id="tr'+tblcount+'">'+
      '<td><input type="hidden" id = "textSerial[]"  name="textSerial[]" value="'+res[1]+'">'+res[1]+'</td>'+
      '<td><input type="hidden" id = "textStatus[]"  name="textStatus[]" value="'+res[2]+'">'+res[2]+'</td>'+
  
      '</tr>');
            
             tblcount++;
  
                   document.getElementById("Stextcount").value = res[3];
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("notexist").setAttribute("hidden","");
                   document.getElementById("serialreject").setAttribute("hidden","");
                   document.getElementById("wrongmodel").setAttribute("hidden","");
                   document.getElementById("offroute").setAttribute("hidden","");
                   document.getElementById("successreject").setAttribute("hidden","");

                   if (document.getElementById("txtQty").value==res[3]){
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("StextSerial").disabled = true;
                   document.getElementById("btnDone").disabled = false;
                   }else{
                      document.getElementById("StextSerial").value = '';
                     document.getElementById("btnDone").disabled = true;
                   }
                   
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
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("btnDone").disabled = true;
            
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
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("btnDone").disabled = true;

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
                   document.getElementById("StextSerial").value = '';
                   document.getElementById("btnDone").disabled = true;

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
                    document.getElementById("StextSerial").value = '';
                   document.getElementById("btnDone").disabled = true;
               

                 }

                }
               
            };

            xmlhttp.open("GET", "../php/completionserialcheck.php?serialno=" + document.getElementById("StextSerial").value + "&model=" + document.getElementById("txtModel").value+"&count=" + document.getElementById("Stextcount").value+"&qty=" + document.getElementById("txtQty").value+"&station=" + document.getElementById("txtStation").value, true);
            xmlhttp.send();
           
        }
          }

          });




          $( "#btnDone" ).click(function() {

  var textSerial = $('input[name="textSerial[]"]').map(function () {
            return this.value; }).get();

  var textStatus = $('input[name="textStatus[]"]').map(function () {
            return this.value; }).get();
           

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               
                var res = result.split("_"); 
 /*alert(result);
*/
                if(res[0] == 'success'){
                 
                  document.getElementById("StextLotNo").value = '';
                  document.getElementById("StextSerial").value = '';
                  document.getElementById("txtModel").value = '';
                  document.getElementById("txtQty").value = '';
                  document.getElementById("txtStatus").value = '';
                  document.getElementById("txtStation").value = '';
                  document.getElementById("Stextcount").value = 0;
                  document.getElementById("StextLotNo").disabled = false;
                  document.getElementById("StextSerial").disabled = true;
                  $("#tbldetails > tbody").empty();
                  document.getElementById("btnDone").disabled = true;
                  $('#StextLotNo').focus();

                  }
        
              }
            };

            xmlhttp.open("GET", "../php/completion.php?&lotno="+ document.getElementById("StextLotNo").value + "&textSerial="+JSON.stringify(textSerial)+ "&textStatus="+JSON.stringify(textStatus)+"&model=" + document.getElementById("txtModel").value+"&serialno=" + document.getElementById("StextSerial").value+"&station=" + document.getElementById("txtStation").value, true);
            xmlhttp.send();

          });




           

//        End----------------------------------------------------------------------------------------------------------------------------------

      });

  </script>     
          </div>
        </div>
  </main>
