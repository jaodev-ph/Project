
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
<?php 
$readonly = 'disabled';
$feederSize ='';
$feederType='';
$feederId='';

?>

  <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
    
   <div id = "success" class="alert alert-success" role="alert">
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Feeder <b id="FeederNumber" name="FeederNumber"></b> is successfully updated!</div>

   <div id = "successreject" class="alert alert-success" role="alert">
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Feeder <b id="Feeder_Error6" name="Feeder_Error6"></b> is successfully rejected!</div>

   <div id = "error1" class="alert alert-danger" role="alert">
  <!--  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Please complete <b id="Feeder_Error1" name="Feeder_Error1"> details!</b> </div>

   <div id = "offroute" class="alert alert-danger" role="alert">
  <!--  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> <b id="Feeder_Error2" name="Feeder_Error2"></b>: Offroute!</div>


   <div id = "feederreject" class="alert alert-danger">
 <!--   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Feeder <b id="Feeder_Error5" name="Feeder_Error5"></b> is REJECT!</div>


     <form method="POST">
      <div>
     <div class="form-group">
      <label for="pwd">Feeder ID:</label>
      <input type="text" class="form-control" id="feederId" name="feederId" onkeypress="if (event.keyCode == 13)  return false;"  >
      <button type="submit" name="feederpart" id="feederpart" style="visibility:hidden;"></button>
      <input type="text" class="form-control" id="seq" name="seq" hidden="">
    </div>
    <div class="form-group">
      <label for="pwd">Station:</label>
        <select class="form-control" name="station" id="station" disabled="">
                <option></option>
                <?php include_once("../classes/feeder_getdata.php");
                  $feeder = Getdata::getAllStation();
                     for ($i=0; $i < count($feeder); $i++)
                      { 
                        echo "<option value=".$feeder[$i]->getdescription().">".$feeder[$i]->getdescription()."</option>";
                      }
                ?>
        </select>

      </div>
      <div class="form-group">
      <label for="pwd">Endorsed By:</label>
      <input type="text" class="form-control" id="endorsedByfeeder" name="endorsedByfeeder" disabled="">
    </div>
    <div class="form-group">
      <label for="pwd">Endorsed To:</label>
      <input type="text" class="form-control" id="receivedByIssuance" name="receivedByIssuance" disabled="">
    </div>

      <div class="row" >
                    <div class="col-md-12">
                        <button type ="button" class="btn btn-success emp-btn" id ="btnPM" name="btnPM" value="PM" disabled style="margin-right:10px;">PM</button>
                        <button type ="button" class="btn btn-success emp-btn" id ="btnEndorse" name="btnEndorse" disabled style="margin-right:10px;" hidden>ENDORSE</button>
                        <button style="float:right;" type ="button" class="btn btn-warning emp-btn" id ="btnRepair" name="btnRepair" value="REPAIR" disabled>REPAIR</button>                   
                    </div>

      </div>
    </div>

    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
      <div class="panel panel-primary">
                    <div class="panel-heading">Feeder Details</div>
                    <div class="panel-body">
                          <div class="row">
                            <div class="col-md-3">
                                <label>Feeder Type:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="feederType" name="feederType" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                            <div class="col-md-3">
                                <label>Feeder Size:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="feederSize" name="feederSize" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>                    
                          <div class="row">
                            <div class="col-md-3">
                                <label>Next Station:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="process" name="process" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                              <div class="row">
                            <div class="col-md-3">
                                <label>Status:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="status" name="status" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Lastupdated By:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="lastupdatedBy" name="lastupdatedBy" class="form-control input-sm" <?php echo $readonly;  ?>><br>
                            </div>
                          </div>
                  </div>      
              </div>

    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
    
                <div class="panel panel-primary" >
                  <div class="panel-heading" >Reject Details</div>
                  <div class="panel-body">
                      <!-- <div class="row"><br>
                         <div class="col-md-3">
                            <label>Parts Replaced:</label><br><br>
                         </div>
                        <div class="col-md-6">
                          <select class="form-control" name="fpartsReplaced1" id="fpartsReplaced1"><br><br>
                                  <option></option>
                                   <?php 
                                      
                                        include_once("../classes/feeder_getdata.php");
                                         
                                        $feeder = Getdata::getAllFeederParts();
                                         for ($i=0; $i < count($feeder); $i++)
                                          { 
                                            echo "<option value=".$feeder[$i]->getfeederPn().">".$feeder[$i]->getfeederDescription().":".$feeder[$i]->getfeederPn()."</option>";
                                          }
                                    ?>
                            </select>
                        </div>
                      </div> -->
                      <div class="row"><br>
                         <div class="col-md-3">
                            <label>Parts Size:</label><br><br>
                         </div>
                        <div class="col-md-6">
                          <select class="form-control" name="fSizePart" id="fSizePart"><br><br>
                                 <option></option>
                                  <?php include_once("../classes/feeder_getdata.php");
                                    $feeder = Getdata::getAllFeederSize();
                                       for ($i=0; $i < count($feeder); $i++)
                                        { 
                                          echo "<option value=".$feeder[$i]->getfeederSize().">".$feeder[$i]->getfeederSize()."</option>";
                                        }
                                  ?>
                          </select>
                        </div>
                      </div>
                       <div class="row"><br>
                         <div class="col-md-3">
                            <label>Parts Replaced:</label><br><br>
                         </div>
                        <div class="col-md-6">
                          <select class="form-control" name="fpartsReplaced" id="fpartsReplaced"><br><br>
                                 
                          </select>
                        </div>
                      </div>
                      <div class="row">
                         <div class="col-md-3">
                            <label>Defect:</label>
                         </div>
                         <div class="col-md-6">
                            <input id="fdefect" type="text" name="fdefect" class="form-control input-sm" disabled><br>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-3">
                            <label>Action Taken:</label>
                         </div>
                         <div class="col-md-5">
                            <input id="fdefectDetails" type="text" name="fdefectDetails" class="form-control input-sm" disabled><br>
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
                                        <th class="info">Parts Replaced</th>
                                        <th class="info">Defect</th>
                                        <th class="info">Defect Details</th>
                                        <th class="info">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                      </div>
                  </div>

                  <div class="panel-footer text-right">
                      <button style="float:left" type="button"  id="btnScrap" name="btnScrap" class="btn btn-danger btn-lg" disabled>SCRAP</button>
                      <button style="float:left" type="button"  id="btnScrapDone" name="btnScrapDone" class="btn btn-danger btn-lg">DONE</button>
                      <button type="button"  id="btnRejDone" name="btnRejDone" class="btn btn-success btn-lg" disabled>Done</button>
                      <button type="submit" id="btnRejCancel" name="btnRejCancel" class="btn btn-warning btn-lg" disabled>Cancel</button>
                  </div>
                </div>
            
          </div>
 </form>	
          </div>
        </div>
  </main>
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
$(document).ready(function(){
  $('#success').hide();
  $('#successreject').hide();
  $('#error1').hide();
  $('#offroute').hide();
  $('#feederreject').hide();
  $('#btnScrapDone').hide();
  $('#feederId').focus();
  
  $('#feederId').keyup(function(event){


      var keycode = (event.keycode ? event.keycode : event.which);
      var exist = false;

      if (keycode =='13'){

        if(document.getElementById("feederId").value == ''){
          return;
        }
        else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              var res = result.split("_");
              
              $('#success').hide();
              $('#successreject').hide();
              $('#error1').hide();
              $('#offroute').hide();
              $('#feederreject').hide();

              if(res[0].trim() == 'ok'){
                document.getElementById("btnPM").disabled = false;
                document.getElementById("btnRepair").disabled = false;
                document.getElementById("feederId").value = res[1];
                document.getElementById("feederType").value = res[2];
                document.getElementById("feederSize").value = res[3];
                document.getElementById("process").value = res[4];
                document.getElementById("status").value = res[5];
                document.getElementById("lastupdatedBy").value = res[6];
                document.getElementById("seq").value = res[7];
                document.getElementById("station").disabled = false;
                

                
                  
                  if(res[7]==4)
                    {
                      document.getElementById("process").value = "Visual Checking"
                      document.getElementById("seq").value=0;

                
                    }
                  if(document.getElementById("process").value != "Visual Checking"){
                      document.getElementById("fpartsReplaced").disabled = false;
                      document.getElementById("fdefect").disabled = false;
                      document.getElementById("fdefectDetails").disabled = false;
                      document.getElementById("btnadd").disabled = false;
                      document.getElementById("fSizePart").disabled = false;
                  }
                  if(document.getElementById("process").value == "Visual Checking"){
                      document.getElementById("fpartsReplaced").disabled = true;
                      document.getElementById("fdefect").disabled = true;
                      document.getElementById("fdefectDetails").disabled = true;
                      document.getElementById("btnadd").disabled = true;
                  }
                  if(res[7]<4)
                  {
                    document.getElementById("btnRejCancel").disabled = false;
                    document.getElementById("btnRejDone").disabled = false;
                    document.getElementById("btnPM").disabled = true;
                    document.getElementById("btnRepair").disabled = true;
                  }
                  if(res[7]==0 || res[7]==4 )
                  {
                    document.getElementById("btnRejCancel").disabled = true;
                    document.getElementById("btnRejDone").disabled = true;
                    document.getElementById("btnPM").disabled = false;
                    document.getElementById("btnRepair").disabled = false;
                  }
                  if(res[5]=="SCRAP")
                  {
                    document.getElementById("station").disabled = true;
                    document.getElementById("btnRejCancel").disabled = false;
                    document.getElementById("btnRejDone").disabled = true;
                    document.getElementById("btnPM").disabled = true;
                    document.getElementById("btnRepair").disabled = true;
                  }
              }
            }
          }

          xmlhttp.open("GET","../php/feeder_receivingkeypress.php?feederId="+document.getElementById("feederId").value,true)
          xmlhttp.send();
          
        }
      }
    });

  $('#fSizePart').change(function (){


          if (document.getElementById("fSizePart").value == '') { 
            return;
          }else {
            /*$('#fSizePart').css('pointer-events','none');*/
            /*$("#fSizePart").attr("readonly",true);*/
            document.getElementById("fpartsReplaced").options.length=0;
            $('#fpartsReplaced').css('pointer-events','auto');
            $("#fpartsReplaced").attr("readonly",false);
            $("#fpartsReplaced").attr("disabled",false);
            $('#fpartsReplaced').focus();

              // document.getElementById("cmbStation").innerHTML = "";  
              
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                 var result = this.responseText;
                 var res = result.split("_");
                 var x1 = document.getElementById("fpartsReplaced");
                 var option1 = document.createElement("option");
                 
                 option1.text = '';
                 x1.add(option1);
                 for (i = 0; i < res.length - 1; i++) { 
                      // alert(res[i]);
                      var x = document.getElementById("fpartsReplaced");
                      var option = document.createElement("option");
                      option.text = res[i];
                      x.add(option);
                    }
                  }
                };

                xmlhttp.open("GET", "../php/feeder_getparts.php?fSizePart="+document.getElementById("fSizePart").value+"&feederType="+document.getElementById("feederType").value, true);
                xmlhttp.send();
              }

            });


  $('#btnPM').click(function(){
    var res = document.getElementById("process").value.split(" ");

    if(document.getElementById("station").selectedIndex > parseInt(document.getElementById("seq").value)+1)
    {
      $("#offroute").show();
      $('#success').hide();
      $('#successreject').hide();
      $('#error1').hide();
      $('#feederreject').hide();
    }
    else if(parseInt(document.getElementById("station").selectedIndex) <= parseInt(document.getElementById("seq").value)+1)
    {
      if(parseInt(document.getElementById("seq").value)==0)
      {
          if(document.getElementById("endorsedByfeeder").value =='')
          {
            $('#success').hide();
            $('#successreject').hide();
            $('#error1').show();
            $('#offroute').hide();
            $('#feederreject').hide();
          }
          else
          {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
              if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;
                // var res = result.split("_");
                
                document.getElementById("feederId").value = "";
              
              }
            }

            xmlhttp.open("GET","../php/feeder_receive.php?feederId="+document.getElementById("feederId").value+"&process="+document.getElementById("station").selectedIndex+"&endorsedByfeeder="+document.getElementById("endorsedByfeeder").value+"&receivedByIssuance="+document.getElementById("receivedByIssuance").value+"&status=PM"+"&feederType="+document.getElementById("feederType").value,true)
            xmlhttp.send();
              $('#success').show();
              $('#successreject').hide();
              $('#error1').hide();
              $('#offroute').hide();
              $('#feederreject').hide();
              document.getElementById("feederId").value = '';
              document.getElementById("feederType").value = '';
              document.getElementById("feederSize").value = '';
              document.getElementById("process").value = '';
              document.getElementById("status").value = '';
              document.getElementById("lastupdatedBy").value = '';
              document.getElementById("seq").value = '';
              document.getElementById("station").value = '';
              document.getElementById("receivedByIssuance").value = '';
              document.getElementById("endorsedByfeeder").value = '';
              document.getElementById("btnRepair").disabled = true;
              document.getElementById("btnPM").disabled = true;
              document.getElementById("station").disabled = true;
              document.getElementById("endorsedByfeeder").disabled = true;
              document.getElementById("receivedByIssuance").disabled = true;
              document.getElementById("btnScrap").disabled = true;
              $('#btnScrapDone').hide();
              $('#btnScrap').show();
        }
      }

    }
  });

    $('#btnRepair').click(function()
    {
      var res = document.getElementById("process").value.split(" ");

    if(document.getElementById("station").selectedIndex > parseInt(document.getElementById("seq").value)+1)
    {
      $("#offroute").show();
      $('#success').hide();
      $('#successreject').hide();
      $('#error1').hide();
      $('#feederreject').hide();
    }
    else if(parseInt(document.getElementById("station").selectedIndex) <= parseInt(document.getElementById("seq").value)+1)
    { 
      if(parseInt(document.getElementById("seq").value)==0)
      {
        if(document.getElementById("endorsedByfeeder").value =='')
        {
          $('#success').hide();
          $('#successreject').hide();
          $('#error1').show();
          $('#offroute').hide();
          $('#feederreject').hide();
        }

        else
        {

            var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                  var result = this.responseText;
                  // var res = result.split("_");
                  
                  document.getElementById("feederId").value = "";
                
                }
              }

              xmlhttp.open("GET","../php/feeder_receive.php?feederId="+document.getElementById("feederId").value+"&process="+document.getElementById("station").selectedIndex+"&endorsedByfeeder="+document.getElementById("endorsedByfeeder").value+"&receivedByIssuance="+document.getElementById("receivedByIssuance").value+"&status=REPAIR"+"&feederType="+document.getElementById("feederType").value,true)
              xmlhttp.send();
                $('#success').show();
                $('#successreject').hide();
                $('#error1').hide();
                $('#offroute').hide();
                $('#feederreject').hide();
                document.getElementById("feederId").value = '';
                document.getElementById("feederType").value = '';
                document.getElementById("feederSize").value = '';
                document.getElementById("process").value = '';
                document.getElementById("status").value = '';
                document.getElementById("lastupdatedBy").value = '';
                document.getElementById("seq").value = '';
                document.getElementById("station").value = '';
                document.getElementById("receivedByIssuance").value = '';
                document.getElementById("endorsedByfeeder").value = '';
                document.getElementById("btnRepair").disabled = true;
                document.getElementById("btnPM").disabled = true;
                document.getElementById("station").disabled = true;
                document.getElementById("endorsedByfeeder").disabled = true;
                document.getElementById("receivedByIssuance").disabled = true;
                document.getElementById("btnScrap").disabled = true;
                $('#btnScrapDone').hide();
                $('#btnScrap').show();
        }
      }
      
    }

    });

    $('#station').change(function()
    {
        document.getElementById("btnScrap").disabled = false;
        
        if(document.getElementById("station").selectedIndex==1)
        {
          document.getElementById("receivedByIssuance").disabled = true;
          document.getElementById("endorsedByfeeder").disabled = false;
        }
        else if(document.getElementById("station").selectedIndex==4)
        {
          document.getElementById("receivedByIssuance").disabled = false;
          document.getElementById("endorsedByfeeder").disabled = true;
        }
        else
        {
          document.getElementById("endorsedByfeeder").disabled = true;
          document.getElementById("receivedByIssuance").disabled = true;
        }
        

    });

          tblcount = $('#tbldetails tr').length;

          $( "#btnadd" ).click(function() {

              if($('#fdefectDetails').val()!=""){
                
            $('#tbldetails > tbody').append('<tr id="tr'+tblcount+'">'+
                                            '<td><input type="hidden" id = "partsReplaced[]"  name="partsReplaced[]" value="'+$('#fpartsReplaced').val()+'">'+$('#fpartsReplaced').val()+'</td>'+
                                            '<td><input type="hidden" id = "defect[]" name="defect[]" value="'+$('#fdefect').val()+'">'+$('#fdefect').val()+'</td>'+
                                            '<td><input type="hidden" id = "defectDetails[]" name="defectDetails[]" value="'+$('#fdefectDetails').val()+'">'+$('#fdefectDetails').val()+'</td>'+
                                            '<td><button type="button" onclick="removeRow('+tblcount+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+
                                            '</tr>');
            
             tblcount++;
             $('#fpartsReplaced1').val("");
             $('#fdefect').val("");
             $('#fdefectDetails').val("");
             checkRow(tblcount);
        }
     

        });

          

       $("#btnRejDone").click(function(){

            // JSON.stringify(hrejectcat)

            
            alert(document.getElementById("station").selectedIndex);
            var partsReplaced = $('input[name="partsReplaced[]"]').map(function () {
            return this.value; }).get();

            var defect = $('input[name="defect[]"]').map(function () {
            return this.value; }).get();

            var defectDetails = $('input[name="defectDetails[]"]').map(function () {
            return this.value; }).get();

            if(document.getElementById("station").selectedIndex > parseInt(document.getElementById("seq").value)+1)
              {
                $("#offroute").show();
                $('#success').hide();
                $('#successreject').hide();
                $('#error1').hide();
                $('#feederreject').hide();
              }
            else if(parseInt(document.getElementById("station").selectedIndex) <= parseInt(document.getElementById("seq").value)+1)
            {

                if(parseInt(document.getElementById("seq").value)==3 && document.getElementById("receivedByIssuance").value =='' ){
                    
                      $('#success').hide();
                      $('#successreject').hide();
                      $('#error1').show();
                      $('#offroute').hide();
                      $('#feederreject').hide();
                      
                }
                else if(document.getElementById("station").selectedIndex ==0 ){
                    
                      $('#success').hide();
                      $('#successreject').hide();
                      $('#error1').show();
                      $('#offroute').hide();
                      $('#feederreject').hide();
                      
                }
                else if(document.getElementById("station").selectedIndex ==1 && document.getElementById("endorsedByfeeder").value ==''){
                    
                      $('#success').hide();
                      $('#successreject').hide();
                      $('#error1').show();
                      $('#offroute').hide();
                      $('#feederreject').hide();
                      
                }
                
                else
                {

                /*var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   var result = this.responseText;
                     
                    var res = result.split("_"); 
                    
                    $("#tbldetails > tbody").empty();
                    
                  }
                };

                xmlhttp.open("GET", "../php/feeder_reject.php?feederId="+document.getElementById("feederId").value+"&partsReplaced="+JSON.stringify(partsReplaced)+"&defect="+JSON.stringify(defect)+"&defectDetails="+JSON.stringify(defectDetails)+"&process="+document.getElementById("station").selectedIndex+"&receivedByIssuance="+document.getElementById("receivedByIssuance").value+"&endorsedByfeeder="+document.getElementById("endorsedByfeeder").value+"&feederType="+document.getElementById("feederType").value, true);
                xmlhttp.send();*/
                  $('#success').show();
                  $('#successreject').hide();
                  $('#error1').hide();
                  $('#offroute').hide();
                  $('#feederreject').hide();
                  document.getElementById("fpartsReplaced").value = '';
                  document.getElementById("fSizePart").value = '';
                  document.getElementById("fpartsReplaced").disabled = true;
                  document.getElementById("fdefect").disabled = true;
                  document.getElementById("fdefectDetails").disabled = true;
                  document.getElementById("feederId").value = '';
                  document.getElementById("feederType").value = '';
                  document.getElementById("feederSize").value = '';
                  document.getElementById("process").value = '';
                  document.getElementById("status").value = '';
                  document.getElementById("lastupdatedBy").value = '';
                  document.getElementById("seq").value = '';
                  document.getElementById("station").value = '';
                  document.getElementById("receivedByIssuance").value = '';
                  document.getElementById("endorsedByfeeder").value = '';
                  document.getElementById("btnRepair").disabled = true;
                  document.getElementById("btnPM").disabled = true;
                  document.getElementById("btnRejCancel").disabled = true;
                  document.getElementById("btnRejDone").disabled = true;
                  document.getElementById("btnScrap").disabled = true;
                  document.getElementById("station").disabled = true;
                  document.getElementById("endorsedByfeeder").disabled = true;
                  document.getElementById("receivedByIssuance").disabled = true;
              
            }
          }

      });
       $("#btnRejCancel").click(function() {
        $("#tbldetails > tbody").empty();
        document.getElementById("feederId").value = '';
        document.getElementById("fSizePart").value = '';
        document.getElementById("feederType").value = '';
        document.getElementById("feederSize").value = '';
        document.getElementById("process").value = '';
        document.getElementById("status").value = '';
        document.getElementById("lastupdatedBy").value = '';
        document.getElementById("seq").value = '';
        document.getElementById("station").value = '';
        document.getElementById("receivedByIssuance").value = '';
        document.getElementById("endorsedByfeeder").value = '';
        document.getElementById("btnRejCancel").disabled = true;
        document.getElementById("fdefectDetails").disabled = true;
        document.getElementById("fpartsReplaced").disabled = true;
        document.getElementById("fdefect").disabled = true;
        document.getElementById("btnRejDone").disabled = true;
        document.getElementById("btnScrap").disabled = true;
        document.getElementById("station").disabled = true;
        $('#success').hide();
        $('#successreject').hide();
        $('#error1').hide();
        $('#offroute').hide();
        $('#feederreject').hide();
        $('#btnScrapDone').hide();
        $('#feederId').focus();
        $('#btnScrap').show();
      });

      $("#btnScrap").click(function() {
        $('#btnScrapDone').show();
        $('#btnScrap').hide();
      });

      $("#btnScrapDone").click(function() {

        var partsReplaced1 = $('input[name="partsReplaced[]"]').map(function () {
            return this.value; }).get();

            var defect1 = $('input[name="defect[]"]').map(function () {
            return this.value; }).get();

            var defectDetails1 = $('input[name="defectDetails[]"]').map(function () {
            return this.value; }).get();
        alert(tblcount);
        if(tblcount<=1)
        {
          $('#success').hide();
          $('#successreject').hide();
          $('#error1').show();
          $('#offroute').hide();
          $('#feederreject').hide();
        }
        else if(document.getElementById("station").selectedIndex != parseInt(document.getElementById("seq").value)+1)
        {
          $("#offroute").show();
          $('#success').hide();
          $('#successreject').hide();
          $('#error1').hide();
          $('#feederreject').hide();
        }
        else
        {
          var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   var result = this.responseText;
                     
                    var res = result.split("_"); 
                    
                    $("#tbldetails > tbody").empty();
                    
                  }
                };

                xmlhttp.open("GET", "../php/feeder_scrap.php?feederId="+document.getElementById("feederId").value+"&partsReplaced="+JSON.stringify(partsReplaced1)+"&defect="+JSON.stringify(defect1)+"&defectDetails="+JSON.stringify(defectDetails1)+"&process="+document.getElementById("station").selectedIndex+"&receivedByIssuance="+document.getElementById("receivedByIssuance").value+"&endorsedByfeeder="+document.getElementById("endorsedByfeeder").value+"&feederType="+document.getElementById("feederType").value, true);
                xmlhttp.send();
                  $('#success').show();
                  $('#successreject').hide();
                  $('#error1').hide();
                  $('#offroute').hide();
                  $('#feederreject').hide();
                  document.getElementById("feederId").value = '';
                  document.getElementById("fSizePart").value = '';
                  document.getElementById("feederType").value = '';
                  document.getElementById("feederSize").value = '';
                  document.getElementById("process").value = '';
                  document.getElementById("status").value = '';
                  document.getElementById("lastupdatedBy").value = '';
                  document.getElementById("seq").value = '';
                  document.getElementById("station").value = '';
                  document.getElementById("receivedByIssuance").value = '';
                  document.getElementById("endorsedByfeeder").value = '';
                  document.getElementById("btnRepair").disabled = true;
                  document.getElementById("btnPM").disabled = true;
                  document.getElementById("btnRejCancel").disabled = true;
                  document.getElementById("btnRejDone").disabled = true;
                  document.getElementById("btnScrap").disabled = true;
                  document.getElementById("station").disabled = true;
                  document.getElementById("endorsedByfeeder").disabled = true;
                  document.getElementById("receivedByIssuance").disabled = true;
                  $('#btnScrapDone').hide();
                  $('#btnScrap').show();
        }
      });

      

  });

</script>