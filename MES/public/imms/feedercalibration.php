<main class="mdl-layout__content mdl-color--grey-100">
  <h2 class="text-center">CALIBRATION</h2>
  <div class="mdl-grid demo-content">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      <div class="col-md-5">
        <div class="row">
              <div class="col-md-4">
                <label>Feeder ID:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="feederId" name="feederId" onkeyup="if(event.keyCode ==13) return false;">
            </div>
          </div>
          <br/>
          <br/>
          <br/>
      </div>
      
      <div class="col-md-12">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-4">
                <label>Feeder Type:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="feederType" name="feederType" disabled="">
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
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Plant No(Feeder):</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="plantNoFeeder" name="plantNoFeeder" disabled="">
            </div>
          </div>
          <br/>
          <!-- <div class="row">
              <div class="col-md-4">
                <label>Updated By:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="txtipn" name="txtipn">
            </div>
          </div> -->
        </div>
        <input type="hidden" name="sequence" id="sequence" hidden="">
        <input type="hidden" name="process" id="process" hidden="">
        <div class="col-md-6">
            <div class="row">
              <div class="col-md-4">
                <label>Plant No(Endorser):</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="plantNoEndorser" name="plantNoEndorser" disabled="">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Current Process:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="description" name="description" disabled="">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Due Date:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="duedate" name="duedate" disabled="">
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12" align="center">
        <div clas="row">
            <br/>
            <button class="form-btn btn btn-lg btn-success" name="btngood" id = "btngood" disabled="disabled">GOOD</button>
            <button class="form-btn btn btn-lg btn-danger" name="btnreject" id = "btnreject" disabled="disabled">REJECT</button>
          
        </div>
      </div>
      
      


    
    </div>
  </div>
</main>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
  $('#feederId').focus();
  $('#btngood').click(function(){


      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");
              alert(result);
              document.getElementById("feederId").value = "";
                document.getElementById("feederType").value = "";
                document.getElementById("feederSize").value = "";
                document.getElementById("plantNoFeeder").value = "";
                document.getElementById("plantNoEndorser").value = "";
                document.getElementById("description").value = "";
                document.getElementById("duedate").value = "";
            }
          }

          xmlhttp.open("GET","../php/feeder_calibrationgood.php?feederId="+document.getElementById("feederId").value,true)
          xmlhttp.send();

          
    });

  $('#btnreject').click(function(){


      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");
              alert(result);
              document.getElementById("feederId").value = "";
                document.getElementById("feederType").value = "";
                document.getElementById("feederSize").value = "";
                document.getElementById("plantNoFeeder").value = "";
                document.getElementById("plantNoEndorser").value = "";
                document.getElementById("description").value = "";
                document.getElementById("duedate").value = "";
            }
          }

          xmlhttp.open("GET","../php/feeder_calibrationreject.php?feederId="+document.getElementById("feederId").value,true)
          xmlhttp.send();

          
    });

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
                document.getElementById("plantNoEndorser").value = res[5];
                document.getElementById("description").value = res[6];
                document.getElementById("duedate").value = res[7];
                document.getElementById("sequence").value = res[8];
                document.getElementById("process").value = res[9];
                if(res[8]!=3)
                {
                  alert("Feeder ID is not for Calibration");
                  document.getElementById("feederId").value = "";
                  document.getElementById("feederType").value = "";
                  document.getElementById("feederSize").value = "";
                  document.getElementById("plantNoFeeder").value = "";
                  document.getElementById("plantNoEndorser").value = "";
                  document.getElementById("description").value = "";
                  document.getElementById("duedate").value = "";
                  document.getElementById("sequence").value = "";
                  document.getElementById("process").value = "";
                }

                if(res[8]==3)
                {
                  
                  $('#btngood,#btnreject').prop("disabled", false);

                }
                else
                {
                  
                   $('#btngood,#btnreject').prop("disabled", true);
                }

                // $('#endorsedByfeeder').focus();
              }
              /*else
              { 
                  alert("Feeder ID is not for Calibration");
                  document.getElementById("feederId").value = "";
                  document.getElementById("feederType").value = "";
                  document.getElementById("feederSize").value = "";
                  document.getElementById("plantNoFeeder").value = "";
                  document.getElementById("plantNoEndorser").value = "";
                  document.getElementById("description").value = "";
                  document.getElementById("duedate").value = "";
                  document.getElementById("sequence").value = "";
                  document.getElementById("process").value = "";
              }*/
            }
          }

          xmlhttp.open("GET","../php/feeder_calibrationkeypress.php?feederId="+document.getElementById("feederId").value+"&feederType="+document.getElementById("feederType").value+"&feederSize="+document.getElementById("feederSize").value+"&plantNoFeeder="+document.getElementById("plantNoFeeder").value+"&plantNoEndorser="+document.getElementById("plantNoEndorser").value+"&description="+document.getElementById("description").value+"&duedate="+document.getElementById("duedate").value+"&sequence="+document.getElementById("sequence").value+"&process="+document.getElementById("process").value,true)
          xmlhttp.send();
        }
      }
    }); 

}); 

</script>
