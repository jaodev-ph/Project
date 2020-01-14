<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      <!-- -------------------------------------------------------------------------------------------------------------------------------- -->
      <?php 
      $readonly = 'disabled';
      
      ?>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
      <div id = "success" class="alert alert-success" role="alert">
      <strong>Success!</strong> Serial <b id="sucess" name="sucess"></b> is successfully linked!</div>

      <div id = "sn1notexist" class="alert alert-danger" role="alert">
      <strong>Error!</strong> First Serial <b id="sn1notexist" name="sn1notexist"></b> not exist!</div>

      <div id = "sn1wrongmodel" class="alert alert-danger" role="alert">
      <strong>Error!</strong> First Serial <b id="sn1wrongmodel" name="sn1wrongmodel"></b> wrong model!</div>

      <div id = "sn1offroute" class="alert alert-danger" role="alert">
      <strong>Error!</strong> First Serial <b id="sn1offroute" name="sn1offroute"></b> offroute!</div>

      <div id = "sn1wrongformat" class="alert alert-danger" role="alert">
      <strong>Error!</strong> First Serial <b id="sn1wrongformat" name="sn1wrongformat"></b> wrong serial format!</div>

      <div id = "sn1reject" class="alert alert-danger" role="alert">
      <strong>Error!</strong> First Serial <b id="sn1reject" name="sn1reject"></b> is REJECT!</div>

      <div id = "sn2notexist" class="alert alert-danger" role="alert">
      <strong>Error!</strong> Second Serial <b id="sn2notexist" name="sn2notexist"></b> not exist!</div>

      <div id = "sn2wrongmodel" class="alert alert-danger" role="alert">
      <strong>Error!</strong> Second Serial <b id="sn2wrongmodel" name="sn2wrongmodel"></b> wrong model!</div>

      <div id = "sn2offroute" class="alert alert-danger" role="alert">
      <strong>Error!</strong> Second Serial <b id="sn2offroute" name="sn2offroute"></b> offroute!</div>

      <div id = "sn2wrongformat" class="alert alert-danger" role="alert">
      <strong>Error!</strong> Second Serial <b id="sn2wrongformat" name="sn2wrongformat"></b> wrong serial format!</div>

      <div id = "sn2reject" class="alert alert-danger" role="alert">
      <strong>Error!</strong> Second Serial <b id="sn2reject" name="sn2reject"></b> is REJECT!</div>

      <div id = "sn2exist" class="alert alert-danger" role="alert">
      <strong>Error!</strong> Second Serial <b id="sn2exist" name="sn2exist"></b> already exist!</div>

      <div id = "notcompatible" class="alert alert-danger" role="alert">
      <strong>Error!</strong> Model <b id="notcompatible" name="notcompatible"></b> not compatible!</div>

      <div id = "alreadylinked" class="alert alert-danger" role="alert">
      <strong>Error!</strong> Serials <b id="alreadylinked" name="alreadylinked"></b> already linked!</div>


      <div class="form-group">
        <h2>Serial 1:</h2>
        <div class="row">
          <div class="col-md-8">
            <input type="text" id="serial1" name="serial1" class="form-control input-sm" onkeypress="if (event.keyCode == 13)  return false;"><br>
          </div>
          <div class="col-md-4">
            <select class="form-control" name="model1" id="model1">
              <option></option>
                <?php include_once("../classes/cardlink_check.php");
                  $account = trim($_SESSION['account']);
                  $model = Check::getAllmodel($account);
                     for ($i=0; $i < count($model); $i++)
                      { 
                        echo "<option value=".$model[$i]->getserial1_model().">".$model[$i]->getserial1_model()."</option>";
                      }
                ?>
            </select>
          </div>
        </div>  
      </div>

      <div class="form-group">
        <h2>Serial 2:</h2>
        <div class="row">
          <div class="col-md-8">
            <input type="text" id="serial2" name="serial2" class="form-control input-sm" onkeypress="if (event.keyCode == 13)  return false;"><br>
          </div>
          <div class="col-md-4">
            <select class="form-control" name="model2" id="model2">
            </select>
          </div>
        </div>  
      </div> 

      <div class="form-group">
        <h2>Station/Line:</h2>
        <div class="row">
          <div class="col-md-8">
            <input type="text" id="station" name="station" class="form-control input-sm"><br>
          </div>
          <div class="col-md-4">
            <select class="form-control" name="line" id="line">
              <option></option>
                <?php include_once("../classes/line.php");
                  $account = trim($_SESSION['account']);
                  $module = $_SESSION['module'];
                  $line = Line::SelectAllLine($account,$module);
                     for ($i=0; $i < count($model); $i++)
                      { 
                        echo "<option value=".$line[$i]->getLine().">".$line[$i]->getLine()."</option>";
                      }
                ?>
            </select>
          </div>
        </div>  
      </div>  
    </div>

    <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
      <div class="panel panel-primary">
        <div class="panel-heading">Serial Details</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <label>Model:</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="model" name="model" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
            <div class="col-md-3">
              <label>Revision:</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="revision" name="revision" class="form-control input-sm" <?php echo $readonly; ?>><br>
            </div>
          </div>                    
          <div class="row">
            <div class="col-md-3">
              <label>Next Station:</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="nextstage" name="nextstage" class="form-control input-sm" <?php echo $readonly; ?>><br>
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
    <div class="row" align="center">
          <div class="col-md-12">
            <button type ="button" class="btn btn-success emp-btn" id ="btnGood" name="btnGood" value="good" disabled style="margin-right:10px;height: 60px;width: 200px;font-size: 30px;">GOOD</button>
            <button type ="button" class="btn btn-warning emp-btn" id ="btnCancel" name="btnCancel" style="margin-right:10px;height: 60px;width: 200px;font-size: 30px;">CANCEL</button>   
          </div>

    </div> 
  </div>  
</div>
</main>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  document.getElementById("alreadylinked").hidden = true;
  document.getElementById("notcompatible").hidden = true;
  document.getElementById("success").hidden = true;
  document.getElementById("sn1notexist").hidden = true;
  document.getElementById("sn1wrongmodel").hidden = true;
  document.getElementById("sn1wrongformat").hidden = true;
  document.getElementById("sn1offroute").hidden = true;
  document.getElementById("sn1reject").hidden = true;
  document.getElementById("sn2notexist").hidden = true;
  document.getElementById("sn2wrongmodel").hidden = true;
  document.getElementById("sn2wrongformat").hidden = true;
  document.getElementById("sn2offroute").hidden = true;
  document.getElementById("sn2reject").hidden = true;
  document.getElementById("sn2exist").hidden = true;
  document.getElementById("serial1").disabled = true;
  document.getElementById("serial2").disabled = true;
  document.getElementById("model2").disabled = true;
  document.getElementById("station").disabled = true;
  document.getElementById("line").disabled = true;
  $('#serial1').focus();
  $('#serial1').keyup(function(event){
      var keycode = (event.keycode ? event.keycode : event.which);
      var exist = false;

      if (keycode =='13'){

        if(document.getElementById("serial1").value == ''){
          return;
        }
        else {
          
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              var res = result.split("_");

              if(res[0].trim() == 'ok'){
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
                document.getElementById("model2").disabled = false;
                $('#model2').focus();
                document.getElementById("model").value = res[1];
                document.getElementById("revision").value = res[2];
                document.getElementById("nextstage").value = res[3];
                document.getElementById("status").value = res[4];
                document.getElementById("lastupdatedBy").value = res[5];
              }
              else if (res[0].trim()=='notexist')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = false;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
              }
              else if (res[0].trim()=='wrongmodel')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = false;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
              }
              else if (res[0].trim()=='offroute')
              {
                alert(result);
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = false;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
              }
              else if (res[0].trim()=='wrongsnformat')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = false;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
              }
              else if (res[0].trim()=='snnotgood')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = false;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
              }
            }
          }

          xmlhttp.open("GET","../php/cardlink_keypress.php?serial1="+document.getElementById("serial1").value+"&sn=serial1"+"&model1="+document.getElementById("model1").value+"&model2="+document.getElementById("model2").value+"&serial2="+document.getElementById("serial2").value,true)
          xmlhttp.send();
          
        }
      }
    });

  $('#serial2').keyup(function(event){
      var keycode = (event.keycode ? event.keycode : event.which);
      var exist = false;

      if (keycode =='13'){

        if(document.getElementById("serial2").value == ''){
          return;
        }
        else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              var res = result.split("_");
              alert(result);

              if(res[0].trim() == 'ok'){
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
                document.getElementById("model2").disabled = true;
                document.getElementById("line").disabled = false;
                document.getElementById("station").value = res[1] + document.getElementById("nextstage").value;
              }
              else if(res[0].trim()=='notcompatible')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = false;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
                document.getElementById("model2").disabled = true;
              }
              else if(res[0].trim()=='wrongsn2format')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = false;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
                document.getElementById("model2").disabled = true;
              }
              else if(res[0].trim()=='sn2alreadyexist')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = false;
                document.getElementById("model2").disabled = true;
              }
              else if(res[0].trim()=='sn2notexist')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = false;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
                document.getElementById("model2").disabled = true;
              }
              else if(res[0].trim()=='sn2wrongmodel')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = false;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
                document.getElementById("model2").disabled = true;
              }
              else if(res[0].trim()=='sn2offroute')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = false;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
                document.getElementById("model2").disabled = true;
              }
              else if(res[0].trim()=='sn2notgood')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = false;
                document.getElementById("sn2exist").hidden = true;
                document.getElementById("model2").disabled = true;
              }
            }
          }

          xmlhttp.open("GET","../php/cardlink_keypress.php?serial2="+document.getElementById("serial2").value+"&sn=serial2"+"&serial1="+document.getElementById("serial1").value+"&model2="+document.getElementById("model2").value+"&model1="+document.getElementById("model1").value,true)
          xmlhttp.send();
          
        }
      }
    });

    $('#model1').change(function (){

          if (document.getElementById("model1").value == '') { 
            return;
          }else {
            /*$('#fSizePart').css('pointer-events','none');*/
            /*$("#fSizePart").attr("readonly",true);*/
            document.getElementById("model2").options.length=0;
            $('#model2').css('pointer-events','auto');
            $("#model2").attr("readonly",false);
            /*$("#model2").attr("disabled",false);*/
            $('#model2').focus();
            document.getElementById("serial1").disabled = false;
            $('#serial1').focus();
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() { 
                if (this.readyState == 4 && this.status == 200) {
                 var result = this.responseText;
                 var res = result.split("_");
                 var x1 = document.getElementById("model2");
                 var option1 = document.createElement("option");
                 
                 option1.text = '';
                 x1.add(option1);
                 for (i = 0; i < res.length - 1; i++) { 
                      // alert(res[i]);
                      var x = document.getElementById("model2");
                      var option = document.createElement("option");
                      option.text = res[i];
                      x.add(option);
                    }
                  }
                };

                xmlhttp.open("GET", "../php/cardlink_getmodel2.php?model1="+document.getElementById("model1").value, true);
                xmlhttp.send();
              }

  });

  $('#model2').change(function (){
      
    document.getElementById("serial2").disabled = false;
    $('#serial2').focus();


  });

  $('#line').change(function (){
  
    document.getElementById("btnGood").disabled = false;

  });

  $('#btnCancel').click(function (){
    document.getElementById("alreadylinked").hidden = true;
    document.getElementById("notcompatible").hidden = true;
    document.getElementById("success").hidden = true;
    document.getElementById("sn1notexist").hidden = true;
    document.getElementById("sn1wrongmodel").hidden = true;
    document.getElementById("sn1wrongformat").hidden = true;
    document.getElementById("sn1offroute").hidden = true;
    document.getElementById("sn1reject").hidden = true;
    document.getElementById("sn2notexist").hidden = true;
    document.getElementById("sn2wrongmodel").hidden = true;
    document.getElementById("sn2wrongformat").hidden = true;
    document.getElementById("sn2offroute").hidden = true;
    document.getElementById("sn2reject").hidden = true;
    document.getElementById("sn2exist").hidden = true;
    document.getElementById("serial1").disabled = true;
    document.getElementById("serial2").disabled = true;
    document.getElementById("model2").disabled = true;
    document.getElementById("station").disabled = true;
    document.getElementById("line").disabled = true;
    document.getElementById("serial1").value = '';
    document.getElementById("serial2").value = '';
    document.getElementById("model1").value = '';
    document.getElementById("model2").value = '';
    document.getElementById("line").value = '';
    document.getElementById("station").value = '';
  });

  $('#btnGood').click(function(){


      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              var res = result.split("_");
              /*alert(res[0]);*/
              if(res[0]=='ok')
              {
                document.getElementById("alreadylinked").hidden = true;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
                document.getElementById("serial1").disabled = true;
                document.getElementById("serial2").disabled = true;
                document.getElementById("model2").disabled = true;
                document.getElementById("station").disabled = true;
                document.getElementById("line").disabled = true;
                document.getElementById("serial1").value = '';
                document.getElementById("serial2").value = '';
                document.getElementById("model1").value = '';
                document.getElementById("model2").value = '';
                document.getElementById("line").value = '';
                document.getElementById("station").value = '';
              }
              else if(res[0]=='alreadylinked')
              {
                document.getElementById("alreadylinked").hidden = false;
                document.getElementById("notcompatible").hidden = true;
                document.getElementById("success").hidden = true;
                document.getElementById("sn1notexist").hidden = true;
                document.getElementById("sn1wrongmodel").hidden = true;
                document.getElementById("sn1wrongformat").hidden = true;
                document.getElementById("sn1offroute").hidden = true;
                document.getElementById("sn1reject").hidden = true;
                document.getElementById("sn2notexist").hidden = true;
                document.getElementById("sn2wrongmodel").hidden = true;
                document.getElementById("sn2wrongformat").hidden = true;
                document.getElementById("sn2offroute").hidden = true;
                document.getElementById("sn2reject").hidden = true;
                document.getElementById("sn2exist").hidden = true;
              }
              
                
            }
          }

          xmlhttp.open("GET","../php/cardlink_good.php?serial1="+document.getElementById("serial1").value+"&model2="+document.getElementById("model2").value+"&model1="+document.getElementById("model1").value+"&serial2="+document.getElementById("serial2").value+"&line="+document.getElementById("line").value,true)
          xmlhttp.send();

          
    });


});

</script>