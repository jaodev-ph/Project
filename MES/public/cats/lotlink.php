
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
      $qty ="";
      $location ="";
      $status = "";
      $createdby ="";
      $cmbmodel ="";
      $cmbline ="";


      ?>

   

<div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop">
     <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
      <strong>Success!</strong> Lot Link <b id="SerialNumber" name="SerialNumber"></b> is successfully updated!</div>

      <div id = "masterlotexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
      <strong>Error!</strong> Master Lot <b id="SerialNumber1" name="SerialNumber1"></b> already exist!</div>
        
      <div id = "wrongmodel" class="alert alert-danger alert-dismissible" role="alert" hidden>
      <strong>Error!</strong> Wrong Model!</div>

      <div id = "offroute" class="alert alert-danger alert-dismissible" role="alert" hidden>
      <strong>Error!</strong> Offroute!</div>

      <div id = "notexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
      <strong>Error!</strong> Lot <b id="SerialNumber1" name="SerialNumber1"></b> doesn't Exist!</div>

  <form method="POST">    
    <div class="form-group">
      <label for="usr">Model:</label>
      <Select class="form-control" id="ScmbModel" name="ScmbModel" >
        <option></option>
        <?php 
          $SelectModel = Model::SelectAllModel($_SESSION['account']);
                     for($i=0;$i<count($SelectModel);$i++){
                ?>
      <option value ='<?php echo $SelectModel[$i]->getModel(); ?>' <?php if($cmbmodel==$SelectModel[$i]->getModel()) {echo "selected";} ?> ><?php echo $SelectModel[$i]->getModel(); ?> </option>
         <?php 
       }
       ?> 
      </Select>
    </div>
      <div class="form-group">
        <label for="usr">Lot:</label>
        <input type="text" class="form-control" id="Stextmasterlot" name="Stextmasterlot" onkeypress="if (event.keyCode == 13)  return false;" disabled>
      </div>
 <div class="form-group">
  <div class="row">
       <div class="col-md-6">
        <label for="pwd">SubLot Count:</label>
        <input type="number" class="form-control" id="Stextcount" name="Stextcount"  onkeypress="if (event.keyCode == 13)  return false;" disabled>
      </div>
       <div class="col-md-6">
        <label for="pwd">Quantity:</label>
        <input type="number" min="0" max="200" class="form-control" id="StextQty" name="StextQty" value="0" disabled>
      </div>
      </div>
  </div>       

  <div class="form-group">
      <div class="row">
      <div class="col-md-12">
        <label for="pwd">Sublot Number:</label>
        <input type="text" class="form-control" id="Stextsublot" name="Stextsublot" onkeypress="if (event.keyCode == 13)  return false;" disabled >
      </div>
     
      </div>
  </div>
            
</div>

<div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
    <div class="panel panel-primary">
     <div class="panel-heading">SubLot Number Details</div>
      <div class="panel-body">
        
  <div class="row">
        
    <div class="col-md-3">
      <label>Model:</label>
    </div>

    <div class="col-md-9">
      <input type="text" id="txtModel" name="txtModel" value="<?php echo $model;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
    </div>
      
    <div class="col-md-3">
      <label>Qty:</label>
    </div>
    <div class="col-md-9">
      <input type="text" id="txtQty" name="txtQty" value="<?php echo $qty;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
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
              <th class="info">SubLot</th>
              <th class="info">Partno</th>
              <th class="info">Qty</th>
             </tr>
            </thead>
        <tbody>
                    
        </tbody>
          </table>
        </div>
      </div>    
        <div class="panel-footer text-right">
          <button type="button"  id="btnDone" name="btnDone" class="btn btn-success btn-lg" disabled>Done</button>
          <button type="submit" id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" >Cancel</button>
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
            document.getElementById('btnDone').disabled = false;
          }else{
            document.getElementById('btnDone').disabled = true;
          }
        }

        $(document).ready(function () {

            tblcount = $('#tbldetails tr').length;

           $('#ScmbModel').change(function (){

          // if (document.getElementById("ScmbModel").value == '') {

      if (document.getElementById("ScmbModel").value == '') { 

            document.getElementById("txtModel").value = '';
            document.getElementById("txtQty").value = '';
            document.getElementById("txtStatus").value = '';
            document.getElementById("txtCreatedBy").value = '';
            document.getElementById("StextQty").value = '';
            document.getElementById("Stextmasterlot").value = '';
            document.getElementById("Stextsublot").value = '';
            document.getElementById("Stextmasterlot").disabled = true;
            document.getElementById("Stextsublot").disabled = true;
            document.getElementById("StextQty").disabled = true;
            document.getElementById("txtModel").disabled = true;
            document.getElementById("txtQty").disabled = true;
            document.getElementById("txtStatus").disabled = true;
            document.getElementById("txtCreatedBy").disabled = true;
        
          return;
          }else { 

            document.getElementById("Stextsublot").disabled = true;
            document.getElementById("Stextmasterlot").disabled = false;
            document.getElementById("Stextmasterlot").focus()
            document.getElementById("Stextmasterlot").select()
     
          }

           });

          
$('#Stextmasterlot').keyup(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  var exist = false;

  if(keycode == '13'){

    document.getElementById("success").setAttribute("hidden","");
 
    if (document.getElementById("Stextmasterlot").value == '') {     
      return;
    }else {

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         var result = this.responseText;
         var res = result.split("_");
                /*alert(result);*/
                if( res[0].trim()  == 'success'){

         

          document.getElementById("Stextmasterlot").disabled = true;
          document.getElementById("Stextcount").disabled = false;
          document.getElementById("Stextcount").focus();      

                }else if (res[0].trim()  == 'lotexist'){

              document.getElementById("Stextmasterlot").value = '';
              document.getElementById("Stextmasterlot").focus();

              document.getElementById("notexist").setAttribute("hidden","");
              document.getElementById("offroute").setAttribute("hidden","");
              document.getElementById("success").setAttribute("hidden","");
              document.getElementById("wrongmodel").setAttribute("hidden",""); 
              document.getElementById("masterlotexist").setAttribute("hidden","");
              document.getElementById("masterlotexist").removeAttribute("hidden");
                  }
              }
            };
            xmlhttp.open("GET", "../php/getmasterlot.php?lot=" + document.getElementById("Stextmasterlot").value +"&model="+ document.getElementById("ScmbModel").value, true);
            xmlhttp.send();
          }
           
          }

     

      });

          
$('#Stextcount').keyup(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  var exist = false;

  if(keycode == '13'){

    document.getElementById("success").setAttribute("hidden","");
 

    if (document.getElementById("Stextcount").value == '') {     
      return;
    }else {

          document.getElementById("Stextcount").disabled = true;
          document.getElementById("Stextsublot").disabled = false;
          document.getElementById("Stextsublot").focus();  
   
          }
           
          }

     

      });

$('#Stextsublot').keyup(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  var exist = false;

  if(keycode == '13'){

    if (document.getElementById("Stextsublot").value == '') {     
      return;
    }else {

            var txtsub = $('input[name="txtsublot[]"]').map(function () {
            return this.value; }).get(); 

                   for(x=0;x<txtsub.length;x++){
        
                        if(txtsub[x] == document.getElementById("Stextsublot").value){
                           proceed = false;   
                            alert("Serial Already Exist in Table!");
                           document.getElementById("Stextsublot").value='';
                           $("#Stextsublot").focus();
                           return;
                              
                        }else{
   
                          proceed = true;
                        }
                     }

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         var result = this.responseText;
         var res = result.split("_");
                /*alert(result);*/
                if( res[0].trim()  == 'success'){

                    if( res[11].trim()  == 'notcompleted'){

                document.getElementById("txtModel").value =res[1];
                document.getElementById("txtQty").value =res[3];
                document.getElementById("txtStatus").value =res[2];
                document.getElementById("txtCreatedBy").value =res[4];
                document.getElementById("StextQty").value =res[8];

            $('#tbldetails > tbody').append('<tr id="tr'+tblcount+'">'+
            '<td><input type="hidden" id = "txtsublot[]"  name="txtsublot[]" value="'+res[5]+'">'+res[5]+'</td>'+
            '<td><input type="hidden" id = "txtpartno[]"  name="txtpartno[]" value="'+res[6]+'">'+res[6]+'</td>'+
            '<td><input type="hidden" id = "txtqty[]"  name="txtqty[]" value="'+res[7]+'">'+res[7]+'</td>'+
           
          '</tr>');
            
             tblcount++;
             checkRow(tblcount);

                var myVar = setInterval(myTimer, 1500);

                function myTimer(){
                document.getElementById("txtModel").value ='';
                document.getElementById("txtQty").value ='';
                document.getElementById("txtStatus").value ='';
                document.getElementById("txtCreatedBy").value ='';
                }
                document.getElementById("Stextsublot").value ='';
                document.getElementById("Stextsublot").focus();

            }else{

                document.getElementById("txtModel").value =res[1];
                document.getElementById("txtQty").value =res[3];
                document.getElementById("txtStatus").value =res[2];
                document.getElementById("txtCreatedBy").value =res[4];
                document.getElementById("StextQty").value =res[8];

            $('#tbldetails > tbody').append('<tr id="tr'+tblcount+'">'+
            '<td><input type="hidden" id = "txtsublot[]"  name="txtsublot[]" value="'+res[5]+'">'+res[5]+'</td>'+
            '<td><input type="hidden" id = "txtpartno[]"  name="txtpartno[]" value="'+res[6]+'">'+res[6]+'</td>'+
            '<td><input type="hidden" id = "txtqty[]"  name="txtqty[]" value="'+res[7]+'">'+res[7]+'</td>'+
           
          '</tr>');
            
             tblcount++;
             checkRow(tblcount);

            document.getElementById("Stextsublot").value ='';
            document.getElementById("Stextsublot").disabled = true;
            document.getElementById("btnDone").disabled = false;
              } 
                }else if (res[0].trim()  == 'wrongmodel'){

              document.getElementById("Stextsublot").value ='';
              document.getElementById("Stextsublot").focus();

              document.getElementById("offroute").setAttribute("hidden","");
              document.getElementById("success").setAttribute("hidden","");
              document.getElementById("notexist").setAttribute("hidden","");
              document.getElementById("masterlotexist").setAttribute("hidden","");   
              document.getElementById("wrongmodel").setAttribute("hidden","");
              document.getElementById("wrongmodel").removeAttribute("hidden");

                }else if (res[0].trim()  == 'offroute'){

              document.getElementById("Stextsublot").value ='';
              document.getElementById("Stextsublot").focus();
              document.getElementById("wrongmodel").setAttribute("hidden","");
              document.getElementById("success").setAttribute("hidden","");
              document.getElementById("notexist").setAttribute("hidden","");
              document.getElementById("masterlotexist").setAttribute("hidden","");   
              document.getElementById("offroute").setAttribute("hidden","");
              document.getElementById("offroute").removeAttribute("hidden");

                }else if (res[0].trim()  == 'lotnotexist'){

              document.getElementById("Stextsublot").value ='';
              document.getElementById("Stextsublot").focus();
              document.getElementById("wrongmodel").setAttribute("hidden","");
              document.getElementById("success").setAttribute("hidden","");
              document.getElementById("masterlotexist").setAttribute("hidden","");   
              document.getElementById("offroute").setAttribute("hidden","");
              document.getElementById("notexist").setAttribute("hidden","");
              document.getElementById("notexist").removeAttribute("hidden");
              
                }

              }
            };
            xmlhttp.open("GET", "../php/28_lotlinkdetails.php?sublot=" + document.getElementById("Stextsublot").value +"&model="+ document.getElementById("ScmbModel").value +"&qty="+ document.getElementById("StextQty").value+"&count="+ document.getElementById("Stextcount").value +"&tblcount="+tblcount, true);
            xmlhttp.send();
          }

        }

      });

$( "#btnDone" ).click(function() {

            var txtsublot = $('input[name="txtsublot[]"]').map(function () {
            return this.value; }).get();

            var txtpartno = $('input[name="txtpartno[]"]').map(function () {
            return this.value; }).get();

            var txtqty = $('input[name="txtqty[]"]').map(function () {
            return this.value; }).get();

 var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         var result = this.responseText;
         var res = result.split("_");
                /*alert(result);*/
                if( res[0].trim()  == 'success'){

                  document.getElementById("txtModel").value = '';
                  document.getElementById("txtQty").value = '';
                  document.getElementById("Stextcount").value = '';
                  document.getElementById("Stextsublot").value = '';
                  document.getElementById("txtStatus").value = '';
                  document.getElementById("txtCreatedBy").value = '';
                  document.getElementById("Stextmasterlot").value = '';
                  document.getElementById("StextQty").value = 0;
                  document.getElementById("Stextmasterlot").disabled = false;          
                  document.getElementById("btnDone").disabled = true;  
                  $("#tbldetails > tbody").empty();

                }

              }
            };
            xmlhttp.open("GET", "../php/lotlink.php?sublot=" + document.getElementById("Stextsublot").value +"&model="+ document.getElementById("ScmbModel").value +"&qty="+ document.getElementById("StextQty").value+"&masterlot="+ document.getElementById("Stextmasterlot").value+"&txtsublot="+JSON.stringify(txtsublot)+"&txtpartno="+JSON.stringify(txtpartno)+"&txtqty="+JSON.stringify(txtqty), true);
            xmlhttp.send();





});






//        End----------------------------------------------------------------------------------------------------------------------------------

});

</script>     
</div>
</div>
</main>
