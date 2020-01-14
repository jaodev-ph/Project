


<main class="mdl-layout__content mdl-color--grey-100">
  
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
            

<div class="col-md-12">
<div class="row">
  <div id="success" class="alert alert-success">
  <strong>Successfully Added!</strong>
  </div>
  <div id="danger" class="alert alert-danger">
  <strong>Feeder ID doesn't exist!</strong>
  </div>
  <div id="warning" class="alert alert-warning">
  <strong>Please complete all details</strong>
  </div>

</div>
<div class="row">
      <div class="col-md-3">
        <label>Feeder ID:</label>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" id="feederId" name="feederId" onkeyup="if(event.keyCode ==13) return false;">
      </div>
</div>


</div>
<div class="col-md-12">
<div class="col-md-6">
     
      <br/>
     <div class="row">
 

    </div>
    <br />

        <div class="row">
 
      <div class="col-md-4">
           <label>Feeder Type:</label>
       </div>
     <div class="col-md-8">
        <select class="form-control" name=feederType id="feederType" disabled="">
                <option></option>
                <?php include_once("../classes/feeder_insert.php");
                  $feeder = Insert::getAllFeederType();

                     for ($i=0; $i < count($feeder); $i++) { 
                
                echo "<option value=".$feeder[$i]->getfeederType().">".$feeder[$i]->getfeederType()."</option>";
                
              }

                ?>
                
        </select>

      </div>


    </div>
    <br/>
    <div class="row">
 
      <div class="col-md-4">
           <label>Feeder Size:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="feederSize" name="feederSize" disabled="">  
        </div>


    </div>
    <br />

      <div class="row">
 
      <div class="col-md-4">
           <label>Plant No(feeder):</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="plantNoFeeder" name="plantNoFeeder" disabled="">
        </div>

    </div>
     <br />

      <div class="row">
 
      <div class="col-md-4">
           <label>Remarks:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="remarks" name="remarks">
        </div>

    </div>
     <br />
</div>
<br/>
<br/>
<div class="col-md-6">
    <div class="row">
 
      <div class="col-md-4">
        <label>Endorsed By:</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" id="endorsedByfeeder" name="endorsedByfeeder">
      </div>
    </div>

    <br/>

    <div class="row">
 
      <div class="col-md-4">
        <label>Plant No(Endorser):</label>
      </div>
      <div class="col-md-8">
        <select class="form-control" name=plantNoEndorser id="plantNoEndorser">
                <option></option>
                <?php include_once("../classes/feeder_insert.php");
                  $feeder = Insert::getAllPlant();

                     for ($i=0; $i < count($feeder); $i++) { 
                
                echo "<option value=".$feeder[$i]->getplantNoFeeder().">".$feeder[$i]->getplantNoFeeder()."</option>";
                
              }

                ?>
                
              </select>
      </div>
    </div>

    <br />

    <div class="row">
 
      <div class="col-md-4">
           <label>Endorsed To:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="receivedByfeeder" name="receivedByfeeder" disabled="">
            <br/>
          <button class="form-btn btn btn-lg btn-success" name="btnendorse" id="btnendorse" disabled="disabled">ENDORSE</button>   
          <button class="form-btn btn btn-lg btn-warning" name="btncancel" id="btncancel">CANCEL</button>
          <input type="text" class="form-control" id="checker" name="checker" hidden="">  
      </div>
      </div>
    </div>
</div>
</div>
</div>
</div>

</main>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  $('#feederId').focus();
  $('#warning').hide();
  $('#success').hide();
  $('#danger').hide();


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
              /*alert(res);*/
              if(res[0].trim() == 'ok'){
                document.getElementById("feederId").value = res[1];
                document.getElementById("feederType").value = res[2];
                document.getElementById("feederSize").value = res[3];
                document.getElementById("plantNoFeeder").value = res[4];
                document.getElementById("receivedByfeeder").value = res[5];
                $('#endorsedByfeeder').focus();
                $('#danger').hide();
                $('#warning').hide();
                if(document.getElementById("feederId").value =="")
                {
                  
                  $('#feederId').prop("disabled", false);

                }
              else if(document.getElementById("feederType").value == "" && document.getElementById("feederSize").value == "")
              {
              $("#danger").show();
              }
                else
                {
                  
                   $('#feederId').prop("disabled", true);
                }
                
              }

            }

            else if(document.getElementById("feederId").value =="")
            {
                $('#btnendorse').prop("disabled", true);
            }
            else 
            {
                $('#btnendorse').prop("disabled", false);
            }
          }

          xmlhttp.open("GET","../php/feeder_receivingkeypress.php?feederId="+document.getElementById("feederId").value+"&feederType="+document.getElementById("feederType").value+"&feederSize="+document.getElementById("feederSize").value+"&plantNoFeeder="+document.getElementById("plantNoFeeder").value+"&receivedByfeeder="+document.getElementById("receivedByfeeder").value,true)
          xmlhttp.send();
        }
      }
    });

    $('#btnendorse').click(function()
    {
        
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
            
            if(document.getElementById("endorsedByfeeder").value == "")
            {
              
              $("#warning").show();

            }
            else if(document.getElementById("feederId").value == "")
            {
              
              $("#warning").show();

            }
            else if(document.getElementById("plantNoEndorser").value == "")
            {
              
              $("#warning").show();

            }
            

            else if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");
                alert(result);
                document.getElementById("feederId").value = "";
                document.getElementById("feederType").value = "";
                document.getElementById("feederSize").value = "";
                document.getElementById("plantNoFeeder").value = "";
                document.getElementById("receivedByfeeder").value = "";
                document.getElementById("endorsedByfeeder").value = "";
                document.getElementById("plantNoEndorser").value = "";
                $('#feederId').prop("disabled", false);
                $("#warning").hide();

            }
            
            else{
              $('#feederId').focus();

            }

            
          }
          
          xmlhttp.open("GET","../php/feeder_endorseclick.php?feederId="+document.getElementById("feederId").value+"&feederType="+document.getElementById("feederType").value+"&feederSize="+document.getElementById("feederSize").value+"&plantNoFeeder="+document.getElementById("plantNoFeeder").value+"&endorsedByfeeder="+document.getElementById("endorsedByfeeder").value+"&receivedByfeeder="+document.getElementById("receivedByfeeder").value,true)
          xmlhttp.send();


    });


    $('#btncancel').click(function()
    {
        document.getElementById("feederId").value = "";
        document.getElementById("feederType").value = "";
        document.getElementById("feederSize").value = "";
        document.getElementById("plantNoFeeder").value = "";
        document.getElementById("receivedByfeeder").value = "";
        document.getElementById("endorsedByfeeder").value = "";
        document.getElementById("plantNoEndorser").value = "";
        $('#feederId').prop("disabled", false);
        $('#warning').hide();
        $('#danger').hide();
        $('#success').hide();

    });

});

</script>


