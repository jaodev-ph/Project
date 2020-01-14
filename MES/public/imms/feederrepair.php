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
$line ="";
$location ="";
$status = "";
$createdby ="";
$cmbmodel ="";
$cmbline ="";


?>

    <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop">

   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Feeder <b id="FeederNumber" name="FeederNumber"></b> is successfully repaired!</div>

   <div id = "successReturn" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Feeder <b id="FeederNumber1" name="FeederNumber1"></b> is successfully returned!</div>

   <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Feeder <b id="Feeder_Error1" name="Feeder_Error1"></b> is not exist!</div>

   <div id = "error2" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Feeder <b id="Feeder_Error2" name="Feeder_Error2"></b> is not reject!</div>

   <div id = "error3" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> <b id="Feeder_Error3" name="Feeder_Error3"></b> is for FA station!</div>

     <form method="POST">
<br />
       <div class="form-group" >
      <label for="pwd">Feeder Type:</label>
      <input type="text" class="form-control" id="feederId" name="feederId" onkeypress="if (event.keyCode == 13)  return false;"  >
    </div>

    <div class="form-group">
      <label for="usr">Station:</label>

      <Select class="form-control" id="feederstation" name="feederstation" disabled>
     
      </Select>
    </div>
<div class="form-group">
     <button type="button"  id="btnReturn" name="btnReturn" class="btn btn-success btn-lg" disabled>Return</button>
     <button type="submit"  id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" >Cancel</button>
</div>
   
    
    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
      

  <div class="panel panel-primary">
                    <div class="panel-heading">Feeder Id Details</div>
                    <div class="panel-body">
                          <div class="row">
                            <div class="col-md-3">
                                <label>Feeder Type:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="feederType" name="feederType" value="<?php echo $model;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                            <div class="col-md-3">
                                <label>Feeder Size:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="feederSize" name="feederSize" value="<?php echo $revision;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>                      
                          <div class="row">
                            <div class="col-md-3">
                                <label>Plant No(Feeder):</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="plantNoFeeder" name="plantNoFeeder" value="<?php echo $location;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                              <div class="row">
                            <div class="col-md-3">
                                <label>Status:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="status" name="status" value="<?php echo $status;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Rejected By:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="txtCreatedBy" name="txtCreatedBy" value="<?php echo $createdby;?>" class="form-control input-sm" <?php echo $readonly;  ?>><br>
                            </div>
                          </div>
                  </div>      
              </div>

    </div>

      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
       
                <div class="panel panel-primary"  style="margin-top:20px"> 
                  <div class="panel-heading">Reject Details</div>
                  <div class="panel-body">
                      
                      <div class="table-responsive">
                            <table class="table table-bordered" id="tbldetails" >
                                <thead>
                                    <tr>
                                        <th class="info">Tracking No</th>
                                        <th class="info">Reject Category</th>
                                        <th class="info">Reject Code</th>
                                        <th class="info">Location</th>
                                        <th class="info">Details</th>
                                        <th class="info">Remarks</th>
                                        <th class="info">Action</th>
                                    </tr>
                                </thead>                          
                            </table>
                      </div>
                  </div>    
                  <div class="panel-footer text-right">
                      <button type ="button" name="btnRejectDone" id="btnRejectDone" class="btn btn-success btn-lg" disabled>Done</button>
                  </div>
                
      </div>
    </div>
 </form>

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
