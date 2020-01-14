
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">


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
    $seq = '';
    $qty = '';


    ?>
   <div id="alertdiv" class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell--top mdl-cell--12-col mdl-grid" style="margin-top:15px;" hidden="">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
      <div id = "success" class="alert alert-success alert-dismissible" role="alert" >
        <strong>Success!</strong> Serial <b id="SerialNumber" name="SerialNumber"></b> is successfully updated!
      </div>
      <div id = "error" class="alert alert-danger alert-dismissible" role="alert">
            <strong>Error!</strong> <b id="lblError" name="lblError"></b></div>
      </div>
    </div>

      <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell--top mdl-cell--6-col mdl-grid" style="margin-top:15px;" >
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">

        
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

              </Select>
            </div>

            <div class="form-group">
              <div class="row">
               <div class="col-md-8">
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
            <div class="col-md-4">
              <label for="pwd">Sequence:</label>
              <input type="number" min="0" max="200" class="form-control" id="txtSeq" name="txtSeq" value="<?php echo $seq;?>" readonly>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
           <div class="col-md-12">
            <label for="pwd" id = "lblSerial1">Serial1:</label>
            <input type="text" class="form-control" id="StextSerial" name="StextSerial" onfocus="this.select();" onkeypress="if (event.keyCode == 13)  return false;" readonly>
          </div>
        </div>
      </div>
      <div class="form-group">
          <div class="row">
           <div class="col-md-12">
            <label for="pwd" id = "lblSerial2">Serial2:</label>
            <input type="text" class="form-control" id="StextSerial2" name="StextSerial2" onfocus="this.select();" onkeypress="if (event.keyCode == 13)  return false;" readonly>
          </div>
        </div>
      </div>
      <div class="form-group" hidden>
      <div class="form-group">
              <div class="row">
               <div class="col-md-9">
                <label for="pwd">Upper Case (DLA / THP / ION)</label>
            <input type="text" class="form-control" id="StextAcce1" name="StextAcce1" onkeypress="if (event.keyCode == 13)  return false;" readonly>
            </div>
            
          </div>
        </div>
        <div class="form-group">
              <div class="row">
               <div class="col-md-9">
                <label for="pwd">Lower Case (THP / ION)</label>
            <input type="text" class="form-control" id="StextAcce2" name="StextAcce2" onkeypress="if (event.keyCode == 13)  return false;" readonly>
            </div>
            
          </div>
        </div>
        <div class="form-group">
              <div class="row">
               <div class="col-md-9">
                <label for="pwd">Insulation Sheet(IPC)</label>
            <input type="text" class="form-control" id="StextAcce3" name="StextAcce3" onkeypress="if (event.keyCode == 13)  return false;" readonly>
            </div>
            
          </div>
        </div>
      </div>
      <div class="row" >
        <div class="col-md-12">
          <button style="float:right;" type ="button" class="btn btn-primary emp-btn" id ="btnClear" name="btnClear" >CLEAR</button>                   
        </div>
      </div>
    </div>
  </div>
  <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell--top mdl-cell--6-col mdl-grid" style="margin-top:15px;" >
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">

      <div class="panel panel-primary">
        <div class="panel-heading">Serial Number Details</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
              <label>Model:</label>
            </div>
            <div class="col-md-7">
              <input type="text" id="txtModel" name="txtModel" value="<?php echo $model;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
            <div class="col-md-4">
              <label>Type:</label>
            </div>
            <div class="col-md-7">
              <input type="text" id="txtRev" name="txtRev" value="<?php echo $revision;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
          </div>                    
          <div class="row">
            <div class="col-md-4">
              <label>Next Station:</label>
            </div>
            <div class="col-md-7">
              <input type="text" id="txtLocation" name="txtLocation" value="<?php echo $location;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label>Qty:</label>
            </div>
            <div class="col-md-4">
              <input type="text" id="txtQty" name="txtQty" value="<?php echo $qty;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label>Status:</label>
            </div>
            <div class="col-md-4">
              <input type="text" id="txtStatus" name="txtStatus" value="<?php echo $status;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <label>Lastupdated By:</label>
            </div>
            <div class="col-md-4">
              <input type="text" id="txtCreatedBy" name="txtCreatedBy" value="<?php echo $createdby;?>" class="form-control input-sm" <?php echo $readonly;  ?>><br>
            </div>
          </div>

        </div>      
      </div>

    </div>
  </div>
  <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell--top mdl-cell--12-col mdl-grid" style="margin-top:15px;">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
      <div class="panel panel-primary">
        <div class="panel-heading">Serial Details</div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-bordered"  id="tbldetails" >
              <thead>
                <tr>
                  <th width="10%" class="info">Seq</th>
                  <th width="35%" class="info">Serial</th>
                  <th width="35%" class="info">Modelno</th>
                  <th width="10%" class="info">currQty</th>
                  <th width="10%" class="info">maxQty</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
 <!--  <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell--top mdl-cell--12-col mdl-grid" style="margin-top:10px;" hidden >
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
      <div class="panel panel-primary">
        <div class="panel-heading">Serial Details</div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-bordered"  id="tbldetails" >
              <thead>
                <tr>
                  <th width="10%" class="info">Seq</th>
                  <th width="35%" class="info">Serial</th>
                  <th width="35%" class="info">Modelno</th>
                  <th width="10%" class="info">currQty</th>
                  <th width="10%" class="info">maxQty</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!-- ------------------------------------------------------------------------------------ -->





  
</form>
</div>
<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  var tblcount;
  $(document).ready(function () {
    if (document.getElementById("cmbLine").value != '' && document.getElementById("cmbModel").value != '') {
     document.getElementById("StextSerial").disabled = false;
     $('#StextSerial').focus();
   }
   $('#cmbModel').change(function (){
    if (document.getElementById("cmbModel").value == '') { 
      return;
    }else {
      if (document.getElementById("cmbModel").value == '838PBM'){
        document.getElementById("lblSerial1").innerHTML = '838PBM:';
        document.getElementById("lblSerial2").innerHTML = 'H838PSB:';
      }else if (document.getElementById("cmbModel").value == 'H838PSB'){
        document.getElementById("lblSerial1").innerHTML = 'H838PSB:';
        document.getElementById("lblSerial2").innerHTML = 'H838:';
      }
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
  }
  );
   $('#cmbStation').change(function (){
    if (document.getElementById("cmbModel").value == '') {
      $('#cmbModel').focus();
    }else{
      $('#cmbStation').css('pointer-events','none');
      $("#cmbStation").attr("readonly",true);

      $('#cmbLine').css('pointer-events','auto');
      $("#cmbLine").attr("readonly",false);
      $("#cmbLine").attr("disabled",false);
      $('#cmbLine').focus();

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         var result = this.responseText;
         var res1 = result.split("&");
         for (a = 0; a < res1.length-1; a++) { 
          var table = document.getElementById("tbldetails");
          var row = table.insertRow(-1);
          var res2 = res1[a].split("_");
          for (i = 0; i < res2.length; i++) {
            var cell = row.insertCell(i);
            tbldetails.rows[a+1].cells[i].innerHTML = res2[i];
          }
        }
      }
    };
    xmlhttp.open("GET", "../php/getlinkmaintenance.php?modelno=" + document.getElementById("cmbModel").value + "&station=" + document.getElementById("cmbStation").value, true);
    xmlhttp.send();
  }
}
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
      document.getElementById("txtSeq").value = 1;
    }
  }
  );

$('#StextSerial').keyup(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  var exist = false;

  if(keycode == '13'){

    
 
    document.getElementById("success").setAttribute("hidden","");
    document.getElementById("error").setAttribute("hidden","");
    document.getElementById("alertdiv").setAttribute("hidden","");


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

          var seq = document.getElementById("txtSeq").value;
    tbldetails.rows[seq].cells[1].innerHTML = document.getElementById("StextSerial").value;
    seq = parseInt(seq) + 1;
    
    document.getElementById("txtSeq").value = seq;

          // document.getElementById("txtSeq").value = res[2];

          //document.getElementById("StextSerial").setAttribute("readonly","");

          // $("#StextSerial2").attr("readonly",false);
          // $("#StextSerial2").attr("disabled",false);
  
          if(document.getElementById("StextSerial2").value.length==0){
            document.getElementById("StextSerial2").removeAttribute("readonly");
            document.getElementById('StextSerial2').focus();
                  document.getElementById('StextSerial2').select();
          }


           

          document.getElementById("success").setAttribute("hidden","");
          document.getElementById("error").setAttribute("hidden","");
          document.getElementById("alertdiv").setAttribute("hidden","");
          document.getElementById("SerialNumber").innerHTML = res[1];
          // document.getElementById("txtQty").value = res[2];
                
                  

                }else {
                  //alert(result);
                  document.getElementById("success").setAttribute("hidden","");
                  document.getElementById("error").setAttribute("hidden","");
                  document.getElementById("error").removeAttribute("hidden");
                  document.getElementById("alertdiv").setAttribute("hidden","");
                  document.getElementById("alertdiv").removeAttribute("hidden");
                  document.getElementById("lblError").innerHTML = res[0];

                  document.getElementById('StextSerial').focus();
                  document.getElementById('StextSerial').select();
                }

              }
            };
            xmlhttp.open("GET", "../php/B9_linking_H838_Stextserial.php?serialno=" + document.getElementById("StextSerial").value +"&model="+ document.getElementById("cmbModel").value +"&station="+ document.getElementById("cmbStation").value +"&line="+ document.getElementById("cmbLine").value+"&sequence="+ document.getElementById("txtSeq").value, true);
            xmlhttp.send();
          }

        }

      });

$('#StextSerial2').keyup(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  var exist = false;

  if(keycode == '13'){

    
 document.getElementById("StextSerial2").setAttribute("readonly","");
    document.getElementById("success").setAttribute("hidden","");
    document.getElementById("error").setAttribute("hidden","");
    document.getElementById("alertdiv").setAttribute("hidden","");
    document.getElementById("alertdiv").removeAttribute("hidden");


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

          
          document.getElementById("success").removeAttribute("hidden");
                  
                  
                  

          var seq = 1;
    document.getElementById("txtSeq").value = seq;

          

          document.getElementById("StextSerial").setAttribute("readonly","");
document.getElementById("StextSerial").value = '';
document.getElementById("StextSerial2").value = '';
          // $("#StextSerial2").attr("readonly",false);
          // $("#StextSerial2").attr("disabled",false);
  
          if(document.getElementById("StextSerial").value.length==0){
            document.getElementById("StextSerial").removeAttribute("readonly");
            document.getElementById('StextSerial').focus();
                  document.getElementById('StextSerial').select();

          }

          document.getElementById("SerialNumber").innerHTML = res[1];
          // document.getElementById("txtQty").value = res[2];
                
                  

                }else {
                  //alert(result);
                  document.getElementById("error").removeAttribute("hidden");
                  document.getElementById("lblError").innerHTML = res[0];
                  document.getElementById("StextSerial2").removeAttribute("readonly");

                  this.focus();
                  this.select();
                }

              }
            };
            xmlhttp.open("GET", "../php/B9_linking_H838_Stextserial2.php?serialno=" + document.getElementById("StextSerial").value +"&serialno2="+ document.getElementById("StextSerial2").value+"&model="+ document.getElementById("cmbModel").value +"&station="+ document.getElementById("cmbStation").value +"&line="+ document.getElementById("cmbLine").value+"&sequence="+ document.getElementById("txtSeq").value, true);
            xmlhttp.send();
          }

        }

      });

//End----------------------------------------------------------------------------------

});

</script>     

</main>
