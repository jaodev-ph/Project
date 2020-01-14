
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
      $qty =0;

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
               <strong>Error!</strong> Serial <b id="Serial_Error2" name="Serial_Error2"></b> is reject!</div>

               <div id = "error3" class="alert alert-danger alert-dismissible" role="alert" hidden>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> Serial <b id="Serial_Error3" name="Serial_Error3"></b> Serial Already in Lot!</div>


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
                   <button type="button" style="float:right;" id="btnReturn" name="btnReturn" class="btn btn-success btn-lg" disabled>RETURN</button>
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
                          <!--   <div class="col-md-3">
                                <label>Type:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtRev" name="txtRev" value="<?php echo $revision;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                          </div> -->
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

                </form>

                <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
                <script type="text/javascript">


                  var tblcount;

                  function removeRow(row){

                    $("#tr"+row).remove();
                    tblcount = $('#tbldetails > tbody tr').length;
                    checkRow(tblcount);
                  }

                  function checkRow(row){
                    if(row>0){
                      document.getElementById('btnRejDone').disabled = false;
                    }else{
                      document.getElementById('btnRejDone').disabled = true;
                    }
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

                          var xmlhttp = new XMLHttpRequest();
                          xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                             var result = this.responseText;
                             var res = result.split("_");
                             //alert(result);


                             if (res[0]=='success'){

                              document.getElementById("txtModel").value = res[2];
                              document.getElementById("txtLocation").value = res[3];
                              document.getElementById("txtStatus").value = res[4];
                              document.getElementById("txtCreatedBy").value = res[5];
                              document.getElementById("txtqty").value = res[6];


                              /*Station Comobox*/
                              var xmlhttp2 = new XMLHttpRequest();
                              xmlhttp2.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                 var result2 = this.responseText;
                                 res2 =  result2.split(',');
                                 //(res2);
                                 var x1 = document.getElementById("ScmbStation");
                                 var option1 = document.createElement("option");
                                 option1.text = '';
                                 x1.add(option1);
                                 for (i = 0; i < res2.length - 1; i++) { 
                      //alert(res[i]);
                      var x = document.getElementById("ScmbStation");
                      var option = document.createElement("option");
                      option.text = res2[i];
                      x.add(option);
                    }       
                    document.getElementById("ScmbStation").disabled=false;     
                    document.getElementById("ScmbStation").focus();
                  }

                };
                xmlhttp2.open("GET", "../php/B9_beforestation.php?serialno=" + document.getElementById("StextSerial").value, true);
                xmlhttp2.send();


              }else if (res[0]=='error1'){

                document.getElementById("successReturn").setAttribute("hidden","");
                document.getElementById("error2").setAttribute("hidden","");
                document.getElementById("error3").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error1").removeAttribute("hidden");


                $('#StextSerial').focus();
                $('#StextSerial').select();
              }
            }

          };
          xmlhttp.open("GET", "../php/getserialdetails.php?serialno=" + document.getElementById("StextSerial").value, true);
          xmlhttp.send();


        }

      }

    });

                    $('#ScmbStation').change(function (){
                      if (document.getElementById("StextSerial").value == '') {
                        $('#StextSerial').focus();
                        /*document.getElementById("StextLotNo").disabled = true;*/
                      }else{
                       document.getElementById("btnReturn").disabled = false;

                     }
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
                           //alert(result);
                           if(res[0] == 'successReturn')
                           { 

                            document.getElementById("StextSerial").value = '';
                            document.getElementById("ScmbStation").value = '';
                            document.getElementById("txtModel").value = '';
                            document.getElementById("txtLocation").value = '';
                            document.getElementById("txtStatus").value = '';
                            document.getElementById("txtCreatedBy").value = '';
                            document.getElementById("txtqty").value = '';

                            document.getElementById("btnReturn").disabled = true;
                            document.getElementById("ScmbStation").disabled = true;

                            $('#StextSerial').focus();

                            document.getElementById("successReturn").setAttribute("hidden","");
                            document.getElementById("successReturn").removeAttribute("hidden");
                            document.getElementById("success").setAttribute("hidden","");
                            document.getElementById("error1").setAttribute("hidden","");
                            document.getElementById("error2").setAttribute("hidden","");
                            document.getElementById("error3").setAttribute("hidden","");

                          }else if (res[0] == 'error2'){

                            document.getElementById("successReturn").setAttribute("hidden","");
                            document.getElementById("success").setAttribute("hidden","");
                            document.getElementById("error1").setAttribute("hidden","");
                            document.getElementById("error3").setAttribute("hidden","");
                            document.getElementById("error2").setAttribute("hidden","");
                            document.getElementById("error2").removeAttribute("hidden");
                            
/*                  document.getElementById("StextSerial").value = '';
                  document.getElementById("ScmbStation").value = '';
                  document.getElementById("txtModel").value = '';
                  document.getElementById("txtLocation").value = '';
                  document.getElementById("txtStatus").value = '';
                  document.getElementById("txtCreatedBy").value = '';
                  document.getElementById("txtqty").value = '';*/

                  document.getElementById("btnReturn").disabled = true;
                  document.getElementById("ScmbStation").disabled = true;

                  //document.getElementByID("StextSerial").focus();
                  //document.getElementByID("StextSerial").select();

                  $('#StextSerial').focus();
                  $('#StextSerial').select();

                }else if (res[0] == 'error1'){

                  document.getElementById("successReturn").setAttribute("hidden","");      
                  document.getElementById("success").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("error3").setAttribute("hidden","");
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("error1").removeAttribute("hidden");
                  //document.getElementById("StextSerial").value = '';
                  document.getElementById("ScmbStation").value = '';
                  document.getElementById("txtModel").value = '';
                  document.getElementById("txtLocation").value = '';
                  document.getElementById("txtStatus").value = '';
                  document.getElementById("txtCreatedBy").value = '';
                  document.getElementById("txtqty").value = '';

                  document.getElementById("btnReturn").disabled = true;
                  document.getElementById("ScmbStation").disabled = true;

                  $('#StextSerial').focus();
                  $('#StextSerial').select();

                }else if (res[0] == 'error3'){

                  document.getElementById("successReturn").setAttribute("hidden","");
                  document.getElementById("success").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("error3").setAttribute("hidden","");
                  document.getElementById("error3").removeAttribute("hidden");

                  //document.getElementById("StextSerial").value = '';
                  document.getElementById("ScmbStation").value = '';
                  document.getElementById("txtModel").value = '';
                  document.getElementById("txtLocation").value = '';
                  document.getElementById("txtStatus").value = '';
                  document.getElementById("txtCreatedBy").value = '';
                  document.getElementById("txtqty").value = '';

                  document.getElementById("btnReturn").disabled = true;
                  document.getElementById("ScmbStation").disabled = true;

                  $('#StextSerial').focus();
                  $('#StextSerial').select();

                }

              }

            };
            xmlhttp1.open("GET", "../php/B9_reroute.php?serialno=" + document.getElementById("StextSerial").value+"&newstation="+ document.getElementById("ScmbStation").value+"&model="+ document.getElementById("txtModel").value+"&qty="+ document.getElementById("txtqty").value+"&station="+ document.getElementById("txtLocation").value+"&status="+ document.getElementById("txtStatus").value, true);
            xmlhttp1.send();

          }

        });




});

</script>


<!-- -------------------------------------------------------------------------------------------------------------------------------- -->       
</div>
</div>
</main>
