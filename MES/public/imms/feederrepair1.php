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
              <input type="text" class="form-control" id="feederType" name="feederType">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Feeder Size:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="feederSize" name="feederSize">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Plant No(Feeder):</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="plantNoFeeder" name="plantNoFeeder">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Defect:</label>
              </div>
            <div class="col-md-8">
                <input type="text" class="form-control" id="defect" name="defect">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Defect Details:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="defectDetails" name="defectDetails">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Parts Replaced:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="partsReplaced" name="partsReplaced">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Repaired By:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="lastupdatedBy" name="lastupdatedBy">
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <!-- <div class="row">
              <div class="col-md-4">
                <label>Returned By:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="txtipn" name="txtipn">
            </div>
          </div> -->
          <!-- <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Returned To:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="txtipn" name="txtipn">
            </div>
          </div>
          <br/> -->
          <div class="row" align="right">
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" name="btnadd" id="btnadd">Add</button>

<!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

           <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Repair</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-4">
                      <label>Feeder ID:</label>
                    </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="feederId1" name="feederId1" disabled="disabled">
                  </div>
                  </div>
                  <br/>
                  <div class="row">
                    <div class="col-md-4">
                      <label>Feeder Type:</label>
                    </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="feederType1" name="feederType1" disabled="disabled">
                  </div>
                  </div>
                  <br/>
                  <div class="row">
                    <div class="col-md-4">
                      <label>Feeder Size:</label>
                    </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="feederSize1" name="feederSize1" disabled="disabled">
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
              </div>

          </div>
        </div>
              <!-- <button class="form-btn btn btn-lg btn-success" name="btnadd" id = "btnadd" >ADD</button> -->
              <button class="form-btn btn btn-lg btn-info" name="btnrepair" id = "btnrepair" >REPAIR</button>
          </div>
          
          
        </div>
      </div>

      
    
    </div>
  </div>
</main>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  $('#myModal').appendTo("body")
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
                document.getElementById("feederId1").value = res[1];
                document.getElementById("feederType").value = res[2];
                document.getElementById("feederType1").value = res[2];
                document.getElementById("feederSize").value = res[3];
                document.getElementById("feederSize1").value = res[3];

                
              }
              else
              {
                alert('Feeder is not for Repair');
              }

            }
          }

          xmlhttp.open("GET","../php/feeder_repairkeypress.php?feederId="+document.getElementById("feederId").value+"&feederType="+document.getElementById("feederType").value+"&feederSize="+document.getElementById("feederSize").value,true)
          xmlhttp.send();
        }
      }
    });

  $('#btnadd').click(function()
    {
        
        var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");

              alert(result);
            }
          }

    });

});

</script>
