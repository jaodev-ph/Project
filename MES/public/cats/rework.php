
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

<?php
include_once("../classes/model.php");
include_once("../classes/line.php");
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
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Serial <b id="SerialNumber" name="SerialNumber"></b> is successfully repaired!</div>

   <div id = "successReturn" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Serial <b id="SerialNumber1" name="SerialNumber1"></b> is successfully returned!</div>

   <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Serial <b id="Serial_Error1" name="Serial_Error1"></b> is not exist!</div>

   <div id = "error2" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Serial <b id="Serial_Error2" name="Serial_Error2"></b> is not reject!</div>

   <div id = "error3" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> <b id="Serial_Error3" name="Serial_Error3"></b> is for FA station!</div>

     <form method="POST">
<br />
       <div class="form-group" >
      <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;"  >
    </div>

    <div class="form-group">
      <label for="usr">Station:</label>

      <Select class="form-control" id="ScmbStation" name="ScmbStation" disabled>
     
      </Select>
    </div>
<div class="form-group">
     <button type="button"  id="btnReturn" name="btnReturn" class="btn btn-success btn-lg" disabled>Return</button>
     <button type="submit"  id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" >Cancel</button>
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
                                        <th class="info">Remarks</th>
                                        <th class="info">Action</th>
                                    </tr>
                                </thead>                          
                            </table>
                      </div>
                  </div>    
                  <div class="panel-footer text-right">
                      <button type ="button" name="btnRejectDone" id="btnRejectDone" class="btn btn-success btn-lg" disabled>Done</button>
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

      if (document.getElementById("StextSerial").value == '') {     
          return;
        }else {

            var xmlhttp2 = new XMLHttpRequest();
            xmlhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            
               var result2 = this.responseText;
                res2 =  result2.split(',');
               /* alert(res2);*/
                var x1 = document.getElementById("ScmbStation");
               var option1 = document.createElement("option");
               option1.text = '';
               x1.add(option1);
               for (i = 0; i < res2.length - 1; i++) { 
                  /*    alert(res[i]);*/
                      var x = document.getElementById("ScmbStation");
                      var option = document.createElement("option");
                      option.text = res2[i];
                      x.add(option);
                    }            
                }
               
            };
            xmlhttp2.open("GET", "../php/beforestation.php?serialno=" + document.getElementById("StextSerial").value, true);
            xmlhttp2.send();




           $("#tbldetails").find("tr:not(:first)").remove();

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
                // alert(result);
               if( res[0]  == 'success'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden",""); 
                document.getElementById("error2").setAttribute("hidden",""); 
                document.getElementById("error3").setAttribute("hidden","");
                document.getElementById("successReturn").setAttribute("hidden","");
                document.getElementById("SerialNumber").innerHTML = res[1];
                document.getElementById("txtModel").value = res[2];
                document.getElementById("txtRev").value = res[3];
                document.getElementById("txtLocation").value = res[4];
                document.getElementById("txtStatus").value = res[5];
                document.getElementById("txtCreatedBy").value = res[6];

                var xmlhttp1 = new XMLHttpRequest();
            xmlhttp1.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var result1 = [];
              var Category = [];
              var Defect = [];
              var Location = [];
              var Details = [];              
              var res1 = [];
              result1 = this.responseText;
              res1 =  result1.split('_');

                if(res1[0] != 'false'){
                trackquantity = res1[0].split(',').length - 1;
                TrackingNo = res1[0].split(',');
                Category = res1[1].split(',');
                Defect = res1[2].split(',');
                Location = res1[3].split(',');
                Details = res1[4].split(',');
                var tblcount = 0;
              
                // alert(result1);
                // if(parseInt(result1[0]) != 0){
                for (i = 0; i < TrackingNo.length - 1; i++) { 
                   $('#tbldetails').append('<tr id="tr'+TrackingNo[i]+'">'+
                                            '<td align ="center"><input type="hidden" id = "htracking'+TrackingNo[i]+'"  name="htracking'+TrackingNo[i]+'" value="'+TrackingNo[i]+'">'+TrackingNo[i]+'</td>'+
                                            '<td align ="center"><input type="hidden" id = "hrejectcode[]" name="hrejectcode[]" value="'+Category[i]+'">'+Category[i]+'</td>'+
                                            '<td align ="center"><input type="hidden" id = "hlocation[]" name="hlocation[]" value="'+Defect[i]+'">'+Defect[i]+'</td>'+
                                            '<td align ="center"><input type="hidden" id = "hdetails[]" name="hdetails[]" value="'+Location[i]+'">'+Location[i]+'</td>'+
                                            '<td align ="center"><input type="hidden" id = "hdetails[]" name="hdetails[]" value="'+Details[i]+'">'+Details[i]+'</td>'+ 
                                            '<td align ="center"><input id = "hremarks'+TrackingNo[i]+'" name="hremarks'+TrackingNo[i]+'" value=""></td>'+                                         
                                             '<td align ="center"><input type="checkbox"  id="chkRepair'+TrackingNo[i]+'" name="chkRepair'+TrackingNo[i]+'" value="1" style="margin-left:auto; margin-right:auto;"> Repair</td>'+
                                            '</tr>');
                 }
               document.getElementById("btnRejectDone").disabled = false;
               document.getElementById("StextSerial").disabled = true;

                }else{

                        document.getElementById("btnReturn").disabled = false;
                        document.getElementById("StextSerial").disabled = true;
                        document.getElementById("ScmbStation").disabled = false;

                }


               }
            };
            xmlhttp1.open("GET", "../php/rejectdetails.php?serialno=" + document.getElementById("StextSerial").value, true);
            xmlhttp1.send();
             
                }else if(res[0]  == 'error1'){
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error1").removeAttribute("hidden");
                document.getElementById("success").setAttribute("hidden",""); 
                document.getElementById("error2").setAttribute("hidden",""); 
                document.getElementById("error3").setAttribute("hidden","");
                document.getElementById("successReturn").setAttribute("hidden","");
                document.getElementById("Serial_Error1").innerHTML = res[1];
                }else if(res[0]  == 'error2'){
                document.getElementById("error2").setAttribute("hidden","");
                document.getElementById("error2").removeAttribute("hidden");
                document.getElementById("success").setAttribute("hidden",""); 
                document.getElementById("error1").setAttribute("hidden",""); 
                document.getElementById("error3").setAttribute("hidden","");
                document.getElementById("successReturn").setAttribute("hidden","");
                document.getElementById("Serial_Error2").innerHTML = res[1];
                }else if(res[0]  == 'error3'){
                document.getElementById("error3").setAttribute("hidden","");
                document.getElementById("error3").removeAttribute("hidden");
                document.getElementById("success").setAttribute("hidden",""); 
                document.getElementById("error2").setAttribute("hidden",""); 
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("successReturn").setAttribute("hidden","");
                document.getElementById("Serial_Error3").innerHTML = res[1];
                }  

              }
        };
            xmlhttp.open("GET", "../php/repairdetails.php?serialno=" + document.getElementById("StextSerial").value, true);
            xmlhttp.send();
          }

          }

        });

      $( "#btnRejectDone" ).click(function() {
        var trackRepair = [];
        var trackremarks = [];
        var notrepair = [];
        var minus = 0;
       
          for (i = 0; i < trackquantity; i++) { 
            try {

                if(document.getElementById("chkRepair"+TrackingNo[i]).checked == true)
                {

                  trackRepair[i] = TrackingNo[i];
                  trackremarks[i] = document.getElementById("hremarks"+TrackingNo[i]).value;
              
                 }

              }catch(err) {
               
            }
          }
         
          // alert(TrackingNo.length.toString() + " " + trackRepair.length.toString());

          var tracklength = TrackingNo.length - 1;
          var trackRepairlength = trackRepair.length;
          var temp = [];
           var xmlhttp1 = new XMLHttpRequest();
            xmlhttp1.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            
               var result = this.responseText;
                res =  result.split('_');
                
                if(res[0] == 'success')
                  { 

                      for (x = 0; x < TrackingNo.length - 1; x++) { 

                          removeRow(trackRepair[x]);
                        

                      }
                      

                      if(tracklength.toString() == trackRepairlength.toString()){
                        document.getElementById("btnReturn").disabled = false;
                        document.getElementById("StextSerial").disabled = true;
                        document.getElementById("ScmbStation").disabled = false;
                       $('#ScmbStation').focus();

                       document.getElementById("success").setAttribute("hidden","");
                     document.getElementById("success").removeAttribute("hidden");
                     document.getElementById("error1").setAttribute("hidden",""); 
                     document.getElementById("error2").setAttribute("hidden",""); 
                     document.getElementById("error3").setAttribute("hidden","");
                     document.getElementById("SerialNumber").innerHTML = res[1];
                    
                      }else{
                         document.getElementById("btnReturn").disabled = true;
                        document.getElementById("StextSerial").disabled = false;
                        document.getElementById("ScmbStation").disabled = true;
                        $('#StextSerial').focus()
                      }
                      
                    // $("#StextSerial").focus().select();
                    //  document.getElementById("success").setAttribute("hidden","");
                    //  document.getElementById("success").removeAttribute("hidden");
                    //  document.getElementById("error1").setAttribute("hidden",""); 
                    //  document.getElementById("error2").setAttribute("hidden",""); 
                    //  document.getElementById("error3").setAttribute("hidden","");
                    //  document.getElementById("SerialNumber").innerHTML = res[1];
                    

                  }

                }
               
            };
            xmlhttp1.open("GET", "../php/reworkreject.php?serialno=" + document.getElementById("StextSerial").value+"&trackRepair="+JSON.stringify(trackRepair)+"&trackremarks="+JSON.stringify(trackremarks)+"&station="+ document.getElementById("txtLocation").value, true);
            xmlhttp1.send();

         });

        $( "#btnReturn" ).click(function() {

          if(document.getElementById("ScmbStation").value == ""){
            $('#ScmbStation').focus();
          }else{
          var xmlhttp1 = new XMLHttpRequest();
            xmlhttp1.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            
               var result = this.responseText;
                res =  result.split('_');
                
                if(res[0] == 'successReturn')
                  { 
                     
                    $("#StextSerial").focus().select();

                     document.getElementById("successReturn").setAttribute("hidden","");
                     document.getElementById("successReturn").removeAttribute("hidden");
                     document.getElementById("error1").setAttribute("hidden",""); 
                     document.getElementById("error2").setAttribute("hidden",""); 
                     document.getElementById("error3").setAttribute("hidden","");
                     document.getElementById("success").setAttribute("hidden","");
                     document.getElementById("SerialNumber1").innerHTML = res[1];

                      document.getElementById("txtModel").value = '';
                      document.getElementById("txtRev").value = '';
                      document.getElementById("txtLocation").value = '';
                      document.getElementById("txtStatus").value = '';
                      document.getElementById("txtCreatedBy").value = '';

                      document.getElementById("btnReturn").disabled = true;
                      document.getElementById("StextSerial").disabled = false;
                      document.getElementById("StextSerial").value = '';
                      $('#StextSerial').focus();
                      document.getElementById("ScmbStation").value = '';
                      document.getElementById("ScmbStation").disabled = true;
                      $("#tbldetails").find("tr:not(:first)").remove();
                       document.getElementById("btnRejectDone").disabled = true;
                      
                  }

                }
               
            };
            xmlhttp1.open("GET", "../php/returnreject.php?serialno=" + document.getElementById("StextSerial").value+"&newstation="+ document.getElementById("ScmbStation").value+"&station="+ document.getElementById("txtLocation").value, true);
            xmlhttp1.send();

          }

          });

      });

  </script>


  <!-- -------------------------------------------------------------------------------------------------------------------------------- -->    		
          </div>
        </div>
  </main>
