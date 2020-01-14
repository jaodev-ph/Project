<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      
      <div class="col-md-12">
          <div class="col-md-6">
            
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Feeder Type:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="feederType" name="feederType">
              <input type="hidden" class="form-control" id="lastupdatedBy" name="lastupdatedBy" hidden="">
            </div>
          </div>
          <br/>
          <!-- <div class="row">
              <div class="col-md-4">
                <label>Feeder Size:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="feederSize" name="feederSize">
              
            </div>
          </div> -->


          <br/>
          <!-- <div class="row">
              <div class="col-md-4">
                <label>Description:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="txtipn" name="txtipn">
            </div>
          </div> -->
        </div>
        <div class="col-md-6">
          <div class="row">
          <div class="row" align="right">
              <button class="form-btn btn btn-lg btn-success" name="btninsert" id = "btninsert">INSERT</button>
              <button class="form-btn btn btn-lg btn-info" name="btnupdate" id = "btnupdate">UPDATE</button>
              <!-- <button class="form-btn btn btn-lg btn-info" name="btndelete" id = "btndelete">DELETE</button> -->
              <button class="form-btn btn btn-lg btn-warning" name="btncancel" id = "btncancel">CANCEL</button>
          </div>
        </div>
      </div>

      
    
    </div>
  </div>
</main>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $('#btninsert').click(function()
    {
        
      
       var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");
              alert(result);
            }
          }

          xmlhttp.open("GET","../php/feeder_insertfeederinfo.php?feederType="+document.getElementById("feederType").value+"&lastupdatedBy="+document.getElementById("lastupdatedBy").value,true)
          xmlhttp.send();
          
          
    });
});
</script>
