<main class="mdl-layout__content mdl-color--grey-100">
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
                <label>Endorsed To:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="txtipn" name="txtipn">
            </div>
          </div> -->
          <!-- <br/> -->
          <!-- <div class="row">
              <div class="col-md-4">
                <label>Due Date:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="txtipn" name="txtipn">
            </div>
          </div> -->
        </div>
        <div class="col-md-6">
            <div class="row">
              <div class="col-md-4">
                <label>Endorsed By:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="endorsedByIssuance" name="endorsedByIssuance" disabled="">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Endorsed To:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="receivedByIssuance" name="receivedByIssuance">
            </div>
          </div>
          <br/>
          <div class="row" align="right">
              <button class="form-btn btn btn-lg btn-success" name="btnissue" id = "btnissue" disabled="disabled">ISSUE</button>
              <button class="form-btn btn btn-lg btn-warning" name="btncancel" id = "btncancel">CANCEL</button>
              <input type="hidden" class="form-control" id="process" name="process" hidden="">
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
              
              if(res[0].trim() == 'ok'){
                document.getElementById("feederId").value = res[1];
                document.getElementById("feederType").value = res[2];
                document.getElementById("feederSize").value = res[3];
                document.getElementById("plantNoFeeder").value = res[4];
                document.getElementById("endorsedByIssuance").value = res[5];
                document.getElementById("receivedByIssuance").value = res[6];
                document.getElementById("process").value = res[7];
                $('#endorsedByIssuance').focus();

                if(res[7]==4)
                {
                  
                  $('#btnissue').prop("disabled", false);

                }
                else
                {

                  alert("Feeder ID is not for Issuance");
                   $('#btnissue').prop("disabled", true);
                }
              }
              else
              { 

              }
            }
          }

          xmlhttp.open("GET","../php/feeder_issuancekeypress.php?feederId="+document.getElementById("feederId").value+"&feederType="+document.getElementById("feederType").value+"&feederSize="+document.getElementById("feederSize").value+"&plantNoFeeder="+document.getElementById("plantNoFeeder").value+"&endorsedByIssuance="+document.getElementById("endorsedByIssuance").value+"&receivedByIssuance="+document.getElementById("receivedByIssuance").value+"&process="+document.getElementById("process").value,true)
          xmlhttp.send();
        }
      }
    });

    $('#btnissue').click(function()
    {
        
        var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");

              alert(result);
            }
          }

          xmlhttp.open("GET","../php/feeder_issuanceclick.php?feederId="+document.getElementById("feederId").value+"&feederType="+document.getElementById("feederType").value+"&feederSize="+document.getElementById("feederSize").value+"&plantNoFeeder="+document.getElementById("plantNoFeeder").value+"&endorsedByIssuance="+document.getElementById("endorsedByIssuance").value+"&receivedByIssuance="+document.getElementById("receivedByIssuance").value,true)
          xmlhttp.send();

    });

  });

</script>
