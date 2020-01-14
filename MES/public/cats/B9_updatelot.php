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

   <div id = "lotcomplete" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot Number <b id="Serial_Error4" name="Serial_Error4"></b> already Completed!</div>


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

   <div id = "qtyequal" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Required Qty is Equal to the Lot Quantity<!-- <b id="Serial_Error5" name="Serial_Error5"></b> --></div>



     <form method="POST">


    <div class="form-group">
      <label for="usr">Lot Number:</label>
      <input type="text" class="form-control" id="StextLotNo" name="StextLotNo" readonly >
    </div>

      <div class="form-group">
      <label for="usr">Reference Number:</label>
      <input type="text" class="form-control" id="Stextreference" name="Stextreference" onkeypress="if (event.keyCode == 13)  return false;"  autocomplete="off" >
    </div>

      <div class="form-group">
  <div class="row">
      <div class="col-sm-6">
        <label for="usr">Required Quantity:</label>
       <input type="number" max="200" class="form-control" id="StextRequiredQty" name="StextRequiredQty" onkeypress="if (event.keyCode == 13) return false;" disabled>
    </div>
    <div class="col-sm-6">
        <label for="usr">Lot Quantity:</label>
      <input type="number" class="form-control" id="StextQty" name="StextQty" value ="0"  disabled>
    </div>
  </div>
</div>


    <div class="form-group">

      <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" disabled autocomplete="off" >
    </div>


      <div class="row" align="right" >
                    <div class="col-md-12">
                     
                        <button type ="button" class="btn btn-success btn-lg" id ="btnDone" name="btnDone" style="margin-right:10px;" disabled>Update Lot</button> 
                     <!--    <button type="submit" id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" >Cancel</button>  -->
                               
                    </div>
      </div>
    </div>
  <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop"> 
    <div class="panel panel-primary">
                    <div class="panel-heading">Lot  Number Details</div>
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
                  <div class="panel-heading" >Lot Info</div>
                  <div class="panel-body">
                      <br />
                      <div class="table-responsive" style="overflow-x: scroll;height:400px;">
                            <table class="table table-bordered"  id="tblLot" >
                                <thead>
                                    <tr>
                                        <th class="info">Serial Number</th>
                                        <th class="info">Model</th>
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
      function removeRow(row){
        
              $("#tr"+row).remove();
             tblcount = $('#tblLot > tbody tr').length;
             checkRow(tblcount);
        }

         function checkRow(row){
            if(row>0){
                document.getElementById('btnRemove').disabled = false;
            }else{
                document.getElementById('btnRemove').disabled = true;
            }
        }

  $(document).ready(function () {
       

          $('#Stextreference').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

              var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
               var res2 = result.split("&");
             //alert(result);
                if(res[0]== 'true'){

                    for (a = 0; a < res2.length - 1; a++) { 
                       var res3 = res2[a].split("_");
                      $('#tblLot').append("<tr id ='tr"+res3[7]+"'><td>"+res3[7]+"</td><td>"+res3[8]+"</td><td>"+res3[9]+"</td></tr>")
                    }

                document.getElementById("StextLotNo").value = res[1]; 
                document.getElementById("txtModel").value = res[2]; 
                document.getElementById("txtLocation").value = res[3]; 
                document.getElementById("txtStatus").value = res[4]; 
                document.getElementById("txtCreatedBy").value = res[5];
                document.getElementById("StextQty").value = res[6]; 
                
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
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");
          
               // document.getElementById("StextSerial").disabled = false; 
                document.getElementById("Stextreference").disabled = true; 
                document.getElementById("StextRequiredQty").disabled = false; 


                 $("#StextRequiredQty").focus();
                 $("#StextRequiredQty").select();
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
                document.getElementById("lotreject").setAttribute("hidden","");

                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("lotnotexist").removeAttribute("hidden");
                document.getElementById("Stextreference").select();

                }
                     if(res[0] == 'seriallotnotexist'){

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
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");

                document.getElementById("seriallotnotexist").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").removeAttribute("hidden");
                document.getElementById("Stextreference").select();

                }
                 if(res[0] == 'lotcompleted'){

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
                document.getElementById("lotnotexist").setAttribute("hidden","");

                document.getElementById("lotcomplete").setAttribute("hidden","");
                document.getElementById("lotcomplete").removeAttribute("hidden");
                document.getElementById("Stextreference").select();
                }

               }
              
            };

            xmlhttp.open("GET", "../php/referencedetails.php?reference=" + document.getElementById("Stextreference").value, true);
            xmlhttp.send();

          }

          });


       $('#StextRequiredQty').keyup(function(event){
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if (keycode == '13'){

          if (document.getElementById("StextRequiredQty").value == 0) {
            $('#StextRequiredQty').focus();
              $('#StextRequiredQty').select();
            document.getElementById("StextSerial").disabled = true;
          }else{

           if (parseInt(document.getElementById("StextRequiredQty").value) < parseInt(document.getElementById("StextQty").value)){

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
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");

                document.getElementById("qtyequal").setAttribute("hidden","");
                document.getElementById("qtyequal").removeAttribute("hidden");

              $('#StextRequiredQty').focus();
              $('#StextRequiredQty').select();


           }else{

           if (document.getElementById("StextRequiredQty").value == document.getElementById("StextQty").value){
            document.getElementById('btnDone').disabled = false;
            document.getElementById('btnDone').focus();
           }else{

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
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");
                document.getElementById("qtyequal").setAttribute("hidden","");
           
            document.getElementById("StextSerial").disabled = false;
            document.getElementById("StextRequiredQty").disabled = true;

             $('#StextSerial').focus();
              $('#StextSerial').select();
               }
                }
          }
        }
        });



          $('#StextSerial').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

            var textSerial1 = $('input[name="tbltxtSerial[]"]').map(function () {
            return this.value; }).get(); 

                   for(x=0;x<textSerial1.length;x++){
        
                        if(textSerial1[x] == document.getElementById("StextSerial").value){
                           proceed = false;   
                            alert("Serial Already Exist in Table!");
                           /*document.getElementById("StextSerial").value='';*/
                           $("#StextSerial").focus();
                            $("#StextSerial").select();
                          
                              
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
               //alert(result);

                 if(res[0] == 'true'){

          $('#tblLot > tbody').append('<tr id="tr'+res[2]+'">'+
            '<td><input type="hidden" id = "tbltxtSerial[]"  name="tbltxtSerial[]" value="'+res[2]+'">'+res[2]+'</td>'+
            '<td><input type="hidden" id = "tbltxtpartno[]"  name="tbltxtpartno[]" value="'+res[3]+'">'+res[3]+'</td>'+
            '<td><input type="hidden" id = "tbltxtstatus[]"  name="tbltxtstatus[]" value="'+res[5]+'">'+res[5]+'</td>'+
          /*  '<td><button type="button" onclick="removeRow('+tblcount+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+*/
            
          '</tr>');
            
             tblcount++;


             $('#StextSerial').val("");

              var rowCount = document.getElementById('tblLot').rows.length - 1;


              if (document.getElementById("StextRequiredQty").value == rowCount){
                  document.getElementById("StextSerial").disabled = true;
                  document.getElementById("btnDone").disabled = false;
              }else{
                document.getElementById("StextSerial").disabled = false;
                document.getElementById("btnDone").disabled = true;
              }

                document.getElementById("StextQty").value = rowCount;
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
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");
                document.getElementById("qtyequal").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");
                document.getElementById("alreadyinlot").setAttribute("hidden","");
                  
                   
                 }else if(res[0] == 'offroute'){
                                 
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
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");
                document.getElementById("alreadyinlot").setAttribute("hidden","");

                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error4").removeAttribute("hidden");

                  document.getElementById("StextSerial").disabled = false;
                  document.getElementById("StextSerial").focus();
                  document.getElementById("StextSerial").select();
               

                 }else if(res[0] == 'wrongmodel'){

                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");
                document.getElementById("qtyequal").setAttribute("hidden","");
                document.getElementById("alreadyinlot").setAttribute("hidden");

                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("wrongmodel").removeAttribute("hidden");
                
                  document.getElementById("StextSerial").disabled = false;
                  document.getElementById("StextSerial").focus();
                  document.getElementById("StextSerial").select();

                 }else if(res[0] == 'alreadyinlot'){

                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");

                document.getElementById("alreadyinlot").setAttribute("hidden","");
                document.getElementById("alreadyinlot").removeAttribute("hidden");
                
                  document.getElementById("StextSerial").disabled = false;
                  document.getElementById("StextSerial").focus();
                  document.getElementById("StextSerial").select();

                 }else if(res[0] == 'serialreject'){

                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");
                document.getElementById("qtyequal").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("alreadyinlot").setAttribute("hidden");  

                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("serialreject").removeAttribute("hidden");

                  document.getElementById("StextSerial").disabled = false;
                  document.getElementById("StextSerial").focus();
                  document.getElementById("StextSerial").select();
            

                 }else if(res[0] == 'notexist'){
                  
                  document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error4").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("serialreject").setAttribute("hidden","");
                document.getElementById("wrongmodel").setAttribute("hidden","");
                document.getElementById("offroute").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("successreject").setAttribute("hidden","");
                document.getElementById("wronglot").setAttribute("hidden","");
                document.getElementById("SerialExists").setAttribute("hidden","");
                document.getElementById("lotreject").setAttribute("hidden","");

                document.getElementById("notexist").setAttribute("hidden","");
                document.getElementById("notexist").removeAttribute("hidden");

                  
                  document.getElementById("StextSerial").focus();
                  document.getElementById("StextSerial").select();
           

                 }

               }
              
            };

          }

            xmlhttp.open("GET", "../php/B9_lotupdateserial.php?serialno=" + document.getElementById("StextSerial").value + "&model=" + document.getElementById("txtModel").value + "&station=" + document.getElementById("txtLocation").value + "&refno=" + document.getElementById("Stextreference").value, true);
            xmlhttp.send();
          
          }

          });

   $( "#btnDone" ).click(function() {

    var htxtSerial = $('input[name="tbltxtSerial[]"]').map(function () {
            return this.value; }).get();

     var htxtpartno = $('input[name="tbltxtpartno[]"]').map(function () {
            return this.value; }).get();

      var htxtstatus = $('input[name="tbltxtstatus[]"]').map(function () {
            return this.value; }).get();


    var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
                var res = result.split("_"); 
                //alert(result);

              document.getElementById("txtModel").value = "";
              document.getElementById("txtLocation").value = "";
              document.getElementById("txtStatus").value = "";
              document.getElementById("txtCreatedBy").value = "";
              document.getElementById("StextSerial").value = "";
              document.getElementById("Stextreference").value = "";
              document.getElementById("StextLotNo").value = "";
              document.getElementById("StextQty").value = 0;
              document.getElementById("StextRequiredQty").value = 0;

             document.getElementById("Stextreference").disabled = false;
             document.getElementById("btnDone").disabled = true;
             $("#tblLot > tbody").empty();

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
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("seriallotnotexist").setAttribute("hidden","");
                document.getElementById("qtyequal").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("success").removeAttribute("hidden");





              }
            };

    xmlhttp.open("GET", "../php/B9_updatelot.php?serialno=" + document.getElementById("StextSerial").value +"&reference="+ document.getElementById("Stextreference").value +"&model="+ document.getElementById("txtModel").value +"&lotno="+ document.getElementById("StextLotNo").value +"&station="+ document.getElementById("txtLocation").value +"&qty="+ document.getElementById("StextQty").value +"&htxtSerial="+JSON.stringify(htxtSerial)+"&htxtpartno="+JSON.stringify(htxtpartno)+"&htxtstatus="+JSON.stringify(htxtstatus), true);
            xmlhttp.send();

   });



        
       // End----------------------------------------------------------------------------------------------------------------------------------

      });

  </script>     
          </div>
        </div>
  </main>
