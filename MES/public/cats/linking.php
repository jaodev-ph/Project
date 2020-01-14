
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">

    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      <!-- -------------------------------------------------------------------------------------------------------------------------------- -->

      <?php
      include_once("../classes/link1.php");
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

      <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">

       <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
        <strong>Success!</strong> Serial <b id="SerialNumber" name="SerialNumber"></b> is successfully updated!</div>
        <div id = "successreject" class="alert alert-success alert-dismissible" role="alert" hidden>
          <strong>Success!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is successfully rejected!</div>
          <div id = "error" class="alert alert-danger alert-dismissible" role="alert" hidden>
            <strong>Error!</strong> Serial <b id="lblError" name="lblError"></b> already exist!</div>
          <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
            <strong>Error!</strong> Serial <b id="Serial_Error1" name="Serial_Error1"></b> already exist!</div>
            <div id = "offroute" class="alert alert-danger alert-dismissible" role="alert" hidden>
              <strong>Error!</strong> <b id="Serial_Error2" name="Serial_Error2"></b>: Offroute!</div>
              <div id = "forcardlink" class="alert alert-danger alert-dismissible" role="alert" hidden>
                <strong>Error!</strong> Serial <b id="Serial_Error3" name="Serial_Error3"></b> is for card linking!</div>
                <div id = "forlotmaking" class="alert alert-danger alert-dismissible" role="alert" hidden>
                  <strong>Error!</strong> Serial <b id="Serial_Error4" name="Serial_Error4"></b> is for lot making!</div>
                  <div id = "serialreject" class="alert alert-danger alert-dismissible" role="alert" hidden>
                   <strong>Error!</strong> Serial <b id="Serial_Error5" name="Serial_Error5"></b> is REJECT!</div>
                   <div id = "wrongmodel" class="alert alert-danger alert-dismissible" role="alert" hidden>
                     <strong>Error!</strong> Wrong Model!</div>
                     <form method="POST">
                      <div class="form-group">
                        <label for="usr">Model:</label>
                        <Select class="form-control" id="cmbModel" name="cmbModel" autofocus>
                         <option></option>
                         <?php 
                         $SelectGroup = Link::SelectAllGroup($_SESSION['account']);
                         for($i=0;$i<count($SelectGroup);$i++){
                          ?>
                          <option value ='<?php echo $SelectGroup[$i]->getGroupname(); ?>' <?php if($cmbmodel==$SelectGroup[$i]->getGroupname()) {echo "selected";} ?> ><?php echo $SelectGroup[$i]->getGroupname(); ?></option>
                          <?php 
                        }
                        ?> 
                      </Select>
                    </div>
                    <div class="form-group">
                      <label for="usr">Station:</label>
                      <Select class="form-control" id="cmbStation" name="cmbStation" disabled>
                        <!-- <option></option>
                         <?php 
                         $SelectGroup = Link::SelectAllStation($_SESSION['account']);
                         for($i=0;$i<count($SelectGroup);$i++){
                          ?>
                          <option value ='<?php echo $SelectGroup[$i]->getStation(); ?>' <?php if($cmbmodel==$SelectGroup[$i]->getStation()) {echo "selected";} ?> ><?php echo $SelectGroup[$i]->getStation(); ?></option>
                          <?php 
                        }
                        ?>  -->
                      </Select>
                    </div>
                    <div class="form-group">
                      <label for="usr">Line:</label>
                      <Select class="form-control" id="cmbLine" name="cmbLine" disabled>
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
                  <!-- <div class="form-group">
                      <label for="usr">Type:</label>
                      <Select class="form-control" id="Scmbtype" name="Scmbtype">
                        <option value ="N">N: Normal</option>
                        <option value ="D">D: Debug</option>
                        <option value ="R">R: Return</option>\
                        <option value ="S">S: Special</option>
                    </Select>
                  </div> -->
                  <div class="form-group">
                    <div class="row">
                    <div class="col-md-9">
                    <label for="pwd">PWB Lot:</label>
                    <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" readonly >
                  </div>
                  <div class="col-md-3">
                    <label for="pwd">Remaining:</label>
                    <input type="number" min="0" max="200" class="form-control" id="txtQty" name="txtQty" disabled>
                  </div>
                </div>
              </div>
              <div class="form-group">
                    <div class="row">
                    <div class="col-md-12">
                    <label for="pwd">Batch Number:</label>
                    <input type="text" class="form-control" id="StextSerial2" name="StextSerial2" onkeypress="if (event.keyCode == 13)  return false;" readonly >
                  </div>
                </div>
              </div>
                  <div class="row" >
                    <div class="col-md-12">
                      <!-- <button type ="button" class="btn btn-success emp-btn" id ="btnGood" name="btnGood" disabled style="margin-right:10px;">GOOD</button> -->
                      <button style="float:right;" type ="button" class="btn btn-primary emp-btn" id ="btnClear" name="btnClear" >CLEAR</button>                   
                    </div>
                  </div>
                </div>
                <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
                  <div class="panel panel-primary">
                    <div class="panel-heading" >Serial Number Details</div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-3">
                          <label>Model:</label>
                        </div>
                        <div class="col-md-9">
                          <input type="text" id="txtModel" name="txtModel" value="<?php echo $model;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                        </div>
                        <div class="col-md-3">
                          <label>Line:</label>
                        </div>
                        <div class="col-md-9">
                          <input type="text" id="txtLine" name="txtLine" value="<?php echo $line;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
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
                    <div class="panel-heading" >Details</div>
                    <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-bordered"  id="tbldetails" >
                  <thead>
                    <tr>
                      <th class="info">Serialno</th>
                      <th class="info">Partno</th>
                      <th class="info">Status</th>
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

          if (document.getElementById("cmbLine").value != '' && document.getElementById("cmbModel").value != '') {
           document.getElementById("StextSerial").disabled = false;
           $('#StextSerial').focus();
         }


         $('#cmbModel').change(function (){
            if (document.getElementById("cmbModel").value == '') { 
              return;
            }else {
              $('#cmbModel').css('pointer-events','none');
              $("#cmbModel").attr("readonly",true);

              $('#cmbStation').css('pointer-events','auto');
              $("#cmbStation").attr("readonly",false);
              $("#cmbStation").attr("disabled",false);
              $('#cmbStation').focus();
              
              // document.getElementById("cmbStation").innerHTML = "";  
              
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                 var result = this.responseText;
                 var res = result.split("_");
                 var x1 = document.getElementById("cmbStation");
                 var option1 = document.createElement("option");
                 option1.text = '';
                 x1.add(option1);
                 for (i = 0; i < res.length - 1; i++) { 
                      // alert(res[i]);
                      var x = document.getElementById("cmbStation");
                      var option = document.createElement("option");
                      option.text = res[i];
                      x.add(option);
                    }
                  }
                };

                xmlhttp.open("GET", "../php/linking_getstationlink.php?modelno=" + document.getElementById("cmbModel").value+"&formodel=0&station=test", true);
                xmlhttp.send();
              }



            });


         $('#cmbStation').change(function (){
          document.getElementById("cmbLine").value = '';

          if (document.getElementById("cmbStation").value == '') {
          }//if (document.getElementById("cmbStation").value == '') {
          else{


            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               if(result == 1){
                $('#cmbStation').css('pointer-events','none');
                $("#cmbStation").attr("readonly",true);

                $('#cmbLine').css('pointer-events','auto');
                $("#cmbLine").attr("readonly",false);
                $("#cmbLine").attr("disabled",false);
                $('#cmbLine').focus();

              }//if(result == 1){
              else{
              }//else{

            }//if (this.readyState == 4 && this.status == 200) {
          }//xmlhttp.onreadystatechange = function() {;

          xmlhttp.open("GET", "../php/getmodelroute.php?modelno=" + document.getElementById("cmbModel").value +"&formodel=1"+"&station="+ document.getElementById("cmbStation").value, true);
          xmlhttp.send();
          

        }//else{
      }//$('#cmbStation').change(function (){
        );

         $('#cmbLine').change(function (){
          if (document.getElementById("cmbLine").value == '') {

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
            $('#cmbLine').css('pointer-events','none');
            $("#cmbLine").attr("readonly",true);

            $('#StextSerial').css('pointer-events','auto');
            $("#StextSerial").attr("readonly",false);
            $("#StextSerial").attr("disabled",false);
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

        xmlhttp.open("GET", "../php/updatecard.php?serialno=" + document.getElementById("StextSerial").value +"&line="+document.getElementById("cmbLine").value+"&station="+ document.getElementById("cmbStation").value+"&nextStation="+ document.getElementById("txtLocation").value, true);
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
                alert(result);
                if( res[0]  == 'success'){
                  $("#StextSerial").attr("readonly",true);

                  $("#StextSerial2").attr("readonly",false);
                  $("#StextSerial2").attr("disabled",false);
                  $('#StextSerial2').focus();

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
                  document.getElementById("txtQty").value = res[2];
                /*  document.getElementById("txtRev").value = res[3];
                  document.getElementById("txtLocation").value = res[4];
                  document.getElementById("txtStatus").value = res[5];
                  document.getElementById("txtCreatedBy").value = res[6];
*/
                  

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
            xmlhttp.open("GET", "../php/linkingStextSerial.php?did=" + document.getElementById("StextSerial").value +"&model="+ document.getElementById("cmbModel").value +"&station="+ document.getElementById("cmbStation").value +"&line="+ document.getElementById("cmbLine").value, true);
            xmlhttp.send();
          }

        }

      });

$('#StextSerial2').keyup(function(event){
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

    if (document.getElementById("StextSerial2").value == '') {     
      return;
    }else {

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         var result = this.responseText;
         var res = result.split("_");
                alert(result);
                if( res[0]  == 'success'){
                  document.getElementById("success").setAttribute("hidden","");
                  document.getElementById("success").removeAttribute("hidden");
                  document.getElementById("offroute").setAttribute("hidden","");
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("forlotmaking").setAttribute("hidden","");
                  document.getElementById("forcardlink").setAttribute("hidden","");
                  document.getElementById("serialreject").setAttribute("hidden","");
                  document.getElementById("successreject").setAttribute("hidden","");
                  document.getElementById("serialreject").setAttribute("hidden","");
                  document.getElementById("wrongmodel").setAttribute("hidden","");
                  document.getElementById("StextSerial2").value ='';
                  document.getElementById("SerialNumber").innerHTML = res[1];
                  document.getElementById("txtModel").value = res[1];
                  document.getElementById("txtLine").value = res[2];
                  document.getElementById("txtStatus").value = res[3];
                  document.getElementById("txtCreatedBy").value = res[4];
                  document.getElementById("txtQty").value = res[5];
                   var myVar = setInterval(myTimer, 1500);

                function myTimer(){
                document.getElementById("txtModel").value ='';
                document.getElementById("txtLine").value ='';
                document.getElementById("txtStatus").value ='';
                document.getElementById("txtCreatedBy").value ='';
                }

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

                if(res[5]==0){
                  document.getElementById("StextSerial").value ='';
                  $("#StextSerial").attr("readonly",false);
                  $('#StextSerial').focus();

                  document.getElementById("StextSerial2").value ='';
                  $("#StextSerial2").attr("readonly",true);
                }




              }
            };
            xmlhttp.open("GET", "../php/linkingStextSerial2.php?did=" + document.getElementById("StextSerial").value +"&serialno="+ document.getElementById("StextSerial2").value +"&model="+ document.getElementById("cmbModel").value +"&station="+ document.getElementById("cmbStation").value +"&line="+ document.getElementById("cmbLine").value+"&pwbqty="+ document.getElementById("txtQty").value, true);
            xmlhttp.send();
          }

        }

      });



$( "#btnClear" ).click(function() 
{
  $('#cmbModel').css('pointer-events','auto');
  $("#cmbModel").attr("readonly",false);
  $("#cmbModel").attr("disabled",false);
  document.getElementById("cmbModel").value = '';
  $('#cmbModel').focus();

  $('#cmbStation').css('pointer-events','auto');
  $("#cmbStation").attr("readonly",true);
  $("#cmbStation").attr("disabled",true);
  document.getElementById("cmbStation").value = '';

  $('#cmbLine').css('pointer-events','auto');
  $("#cmbLine").attr("readonly",true);
  $("#cmbLine").attr("disabled",true);
  document.getElementById("cmbLine").value = '';

  $("#StextSerial").attr("readonly",true);
  $("#StextSerial").attr("disabled",true);
  document.getElementById("StextSerial").value = '';

  $("#StextSerial2").attr("readonly",true);
  $("#StextSerial2").attr("disabled",true);
  document.getElementById("StextSerial2").value = '';


  

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

            xmlhttp.open("GET", "../php/addreject.php?serialno=" + document.getElementById("StextSerial").value +"&hrejectcat="+JSON.stringify(hrejectcat)+"&hrejectcode="+JSON.stringify(hrejectcode)+"&hlocation="+JSON.stringify(hlocation)+"&hdetails="+JSON.stringify(hdetails)+"&line="+document.getElementById("cmbLine").value+"&station="+ document.getElementById("cmbStation").value+"&nextStation="+ document.getElementById("txtLocation").value, true);
            xmlhttp.send();

          });
//        End----------------------------------------------------------------------------------------------------------------------------------

});

</script>     
</div>
</div>
</main>
