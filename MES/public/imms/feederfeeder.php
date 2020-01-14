<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      
      <div class="col-md-5">
        <div class="row">
              <div id="warning" class="alert alert-warning">
              <strong>Please complete all details</strong>
              </div>
              <div id="success" class="alert alert-success">
              <strong>Success!</strong>
              </div>
              <div class="col-md-4">
                <label>Feeder ID:</label>
              </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="feederId" name="feederId" onkeyup="if(event.keyCode ==13) return false;">
            </div>
          </div>
          <br/>
          
      </div>
      
      <div class="col-md-12">
          <div class="col-md-6">
            
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Feeder Type:</label>
              </div>
            <div class="col-md-8">
              <select class="form-control" name=feederType id="feederType">
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
              <input type="text" class="form-control" id="feederSize" name="feederSize">
            </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-4">
                <label>Plant No(Feeder):</label>
              </div>
            <div class="col-md-8">
              <select class="form-control" name=plantNoFeeder id="plantNoFeeder">
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
        </div>
        <div class="col-md-6">
          <div class="row">
          <div class="row" align="right">
              <button class="form-btn btn btn-lg btn-success" name="btninsert" id = "btninsert">INSERT</button>
              <button class="form-btn btn btn-lg btn-info" name="btnupdate" id = "btnupdate">UPDATE</button>
              <!-- <button class="form-btn btn btn-lg btn-danger" name="btnregister" id = "btnregister">DELETE</button> -->
              <button class="form-btn btn btn-lg btn-warning" name="btncancel" id = "btncancel">CANCEL</button>
          </div>
        </div>
      </div>
      <table>
        <th>
          
        </th>
      </table>
      
    
    </div>
    <input type="hidden" name="lastupdatedBy" id="lastupdatedBy" hidden="">
    <input type="hidden" name="lastupdate" id="lastupdate" hidden="">
    <!-- <input type="hidden" name="feederType" id="feederType" hidden=""> -->
  </div>
</main>

<!-- <main class="mdl-layout__content mdl-color--grey-100"> 
  <div class="mdl-grid demo-content" id="refresh">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      
      <table class=table id="">
        <thead>
          <tr>
            <th>Feeder ID</th>
            <th>Feeder Type</th>
            <th>Feeder Size</th>
            <th>Plant No(Feeder)</th>
          </tr>
          
        </thead>
        <tbody>
          
          
            <?php include_once("../classes/feeder_insert.php");

              $feeder = Insert::getAllFeeder();

              for ($i=0; $i < count($feeder); $i++) { 
                echo "<tr>";
                echo "<td>".$feeder[$i]->getfeederId()."</td>";
                echo "<td>".$feeder[$i]->getfeederType()."</td>";
                echo "<td>".$feeder[$i]->getfeederSize()."</td>";
                echo "<td>".$feeder[$i]->getplantNoFeeder()."</td>";
                //echo '<td>'.'<button class="form-btn btn btn-lg btn-info" name="btnedit" id="btnedit">EDIT</button><input type ="text" id="text'.'" name="'.$feeder[$i]->getfeederId().'" value ='.$feeder[$i]->getfeederId().' hidden><td>';
                echo "</tr>";
                
              }

             ?>
          
          
          
        </tbody>
      </table>
      
    </div>
  </div>
</main> -->

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>

<script type="text/javascript">
var tablecount = 0;
 $(document).ready(function(){
$('#feederId').focus();
$('#warning').hide();
$('#success').hide();
$('#btninsert').click(function()
    {
        
      
      if(document.getElementById("feederId").value == "")
      {
                  $('#warning').show();
      }
      else if(document.getElementById("feederType").value == "")
      {
                  $('#warning').show();
      }
      else if(document.getElementById("feederSize").value == "")
      {
                  $('#warning').show();
      }
      else if(document.getElementById("plantNoFeeder").value == "")
      {
                  $('#warning').show();
      }
      else{
       var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){ 

             if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
               var res = result.split("_");
                alert(res);
                document.getElementById("feederId").value = "";
                document.getElementById("feederType").value = "";
                document.getElementById("feederSize").value = "";
                document.getElementById("plantNoFeeder").value = "";
                $('#warning').hide();
                

                
                 
            }
          }
          xmlhttp.open("GET","../php/feeder_insertclick.php?feederId="+document.getElementById("feederId").value+"&feederType="+document.getElementById("feederType").value+"&feederSize="+document.getElementById("feederSize").value+"&plantNoFeeder="+document.getElementById("plantNoFeeder").value+"&lastupdatedBy="+document.getElementById("lastupdatedBy").value,true)
          xmlhttp.send();
      }
      $('#feederId').prop("disabled", false);
        
          
          
    });
    $('#btnupdate').click(function(){
       if(document.getElementById("feederId").value == "")
      {
                  $('#warning').show();
      }
      else if(document.getElementById("feederType").value == "")
      {
                  $('#warning').show();
      }
      else if(document.getElementById("feederSize").value == "")
      {
                  $('#warning').show();
      }
      else if(document.getElementById("plantNoFeeder").value == "")
      {
                  $('#warning').show();
      }
      else{

      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
               var res = result.split("_");
              alert(res);
              document.getElementById("feederId").value = "";
                document.getElementById("feederType").value = "";
                document.getElementById("feederSize").value = "";
                document.getElementById("plantNoFeeder").value = "";
                $('#warning').hide();
                

            }
          }

          xmlhttp.open("GET","../php/feeder_updateclick.php?feederId="+document.getElementById("feederId").value+"&feederType="+document.getElementById("feederType").value+"&feederSize="+document.getElementById("feederSize").value+"&plantNoFeeder="+document.getElementById("plantNoFeeder").value+"&lastupdatedBy="+document.getElementById("lastupdatedBy").value+"&lastupdate="+document.getElementById("lastupdate").value,true)
          xmlhttp.send();
        }
         $('#feederId').prop("disabled", false);


          
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
              
              if(res[0].trim() == 'ok'){
                document.getElementById("feederId").value = res[1];
                document.getElementById("feederType").value = res[2];
                document.getElementById("feederSize").value = res[3];
                document.getElementById("plantNoFeeder").value = res[4];
                document.getElementById("lastupdatedBy").value = res[5];
                document.getElementById("lastupdate").value = res[6];
                $('#success').hide();
                $('#warning').hide();
                // $('#endorsedByfeeder').focus();
                if(document.getElementById("feederId").value =="")
                {
                  
                  $('#feederId').prop("disabled", false);

                }
                else
                {
                  
                   $('#feederId').prop("disabled", true);
                }
              }
              else
              { 

              }
            }
          }

          xmlhttp.open("GET","../php/feeder_feederkeypress.php?feederId="+document.getElementById("feederId").value+"&feederType="+document.getElementById("feederType").value+"&feederSize="+document.getElementById("feederSize").value+"&plantNoFeeder="+document.getElementById("plantNoFeeder").value+"&lastupdatedBy="+document.getElementById("lastupdatedBy").value+"&lastupdate="+document.getElementById("lastupdate").value,true)
          xmlhttp.send();
        }
      }
    });
        
    $('#btncancel').click(function()
    {

        // var xmlhttp = new XMLHttpRequest();
        //   xmlhttp.onreadystatechange = function(){
        //     if (this.readyState == 4 && this.status == 200) {
        //       var result = this.responseText;
        //       // var res = result.split("_");
        //         alert(result);
                document.getElementById("feederId").value = "";
                document.getElementById("feederType").value = "";
                document.getElementById("feederSize").value = "";
                document.getElementById("plantNoFeeder").value = "";
                $('#feederId').prop("disabled", false);
                $('#feederId').focus();
                $('#warning').hide();
                $('#success').hide();
                
              
          //   }
          // }
          


    });

    });
  
  </script> 
