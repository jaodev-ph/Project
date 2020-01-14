
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">

    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      <!-- ------------------------------------------------------------------------------------ -->

      <?php
      include_once("../classes/link1.php");
      include_once("../classes/model.php");
      include_once("../classes/line.php");
      include_once("../classes/defectcatprod.php");
      include_once("../classes/defectprod.php");
      include_once("../classes/shipment.php");
      $readonly ="readonly";
      $model ="";
      $revision ="";
      $line ="";
      $location ="";
      $status = "";
      $createdby ="";
      $cmbmodel ="";
      $cmbline ="";
      $seq =1;
      $shipmentdate="";
      
     

      ?>

      <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop" style="padding: 10px;">

       <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
        <strong>Success!</strong> Serial <b id="SerialNumber" name="SerialNumber"></b> is successfully updated!</div>
        <div id = "error" class="alert alert-danger alert-dismissible" role="alert" hidden>
          <strong>Error!</strong> <b id="lblError" name="lblError"></b></div>
          <form method="POST">
            <div class="form-group">
              <label for="usr">Shipment Date:</label>
              <Select class="form-control" id="cmbModel" name="cmbModel" autofocus>
               <option></option>
                      <?php
                      $optmodel = Shipment::getShipmentDateFromShipmentFile();
                      for($i=0;$i<count($optmodel);$i++){
                       ?>

                       <option <?php if(($model==$optmodel[$i]->getvarDate())||($optmodel[$i]->getvarDate()==$shipmentdate)){echo "selected";} ?>><?php echo $optmodel[$i]->getvarDate(); ?></option>
                     <?php } ?>
            </Select>
          </div>
          <div class="form-group">
            <label for="usr">Kanban No:</label>
            <Select class="form-control" id="cmbStation" name="cmbStation" disabled>

            </Select>
          </div>
          
          <div class="form-group">
            <div class="row">
             <div class="col-md-12">
              <label for="pwd">Reference No:</label>
              <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" readonly>
            </div>
          </div>
        </div>
        
      </div>
      <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop" style="padding: 10px;">
        

        <div class="panel panel-primary">
          <div class="panel-heading">Lot Number Details</div>
          <div class="panel-body">
           <div class="row">
            <div class="col-md-3">
              <label>Item Desc:</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="txtFamily" name="txtFamily"  class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
            <div class="col-md-3">
              <label>Item Code:</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="txtQuantity" name="txtQuantity" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <label>Model:</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="txtModel" name="txtModel" value="<?php echo $model;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
            <div class="col-md-3">
              <label>Trip:</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="txtRev" name="txtRev" value="<?php echo $revision;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <label>Current Qty:</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="txtLine" name="txtLine" value="<?php echo $line;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <label>Required Qty:</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="txtLocation" name="txtLocation" value="<?php echo $location;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>                            
          </div>
        </div>      
      </div>

    </div>
  </form>

  <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
  <script type="text/javascript">
    var tblcount;
    $(document).ready(function () {
      
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
      }
    }
    );
     $('#StextSerial').keyup(function(event){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      var exist = false;
      if(keycode == '13'){
        var seq = document.getElementById("txtSeq").value;
        tbldetails.rows[seq].cells[1].innerHTML = document.getElementById("StextSerial").value;
        seq = parseInt(seq) + 1;
        alert(seq);
        document.getElementById("txtSeq").value = seq;

        document.getElementById("success").setAttribute("hidden","");
        document.getElementById("offroute").setAttribute("hidden","");

        if (document.getElementById("StextSerial").value == '') {     
          return;
        }else {

          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var result = this.responseText;
             var res = result.split("_");

             if( res[0]  == 'success'){
              document.getElementById("txtSeq").value = res[2];

              $("#StextSerial").attr("readonly",true);
              document.getElementById("success").setAttribute("hidden","");
              document.getElementById("lblError").setAttribute("hidden","");
              document.getElementById("SerialNumber").innerHTML = res[1];
              document.getElementById("txtQty").value = res[2];
            }else {
              document.getElementById("success").setAttribute("hidden","");
              document.getElementById("lblError").innerHTML = res[0];
              document.getElementById('StextSerial').focus();
              document.getElementById('StextSerial').select();
            }
          }
        };
        xmlhttp.open("GET", "../php/motherseriallinkStextSerial.php?serialno=" + document.getElementById("StextSerial").value +"&sequence="+ document.getElementById("txtSeq").value+"&model="+ document.getElementById("cmbModel").value +"&station="+ document.getElementById("cmbStation").value +"&line="+ document.getElementById("cmbLine").value, true);
        xmlhttp.send();
      }
    }
  });

     $( "#btnClear" ).click(function() 
     {
      var tblcount = $('#tbldetails tr').length;
      for(i=1;i<tblcount;i++){
        document.getElementById("tbldetails").deleteRow(1);
      }
      $('#cmbModel').css('pointer-events','auto');
      $("#cmbModel").attr("readonly",false);
      $("#cmbModel").attr("disabled",false);
      document.getElementById("cmbModel").value = '';
      $('#cmbModel').focus();

      document.getElementById("cmbStation").innerHTML = ""
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

    });

//End----------------------------------------------------------------------------------

});

</script>     
</div>
</div>
</main>
