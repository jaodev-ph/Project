
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!--  -->

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

// if(isset($_POST['submitSerial'])){

//   $cmbmodel = $_POST['ScmbModel'];
//   $cmbline = $_POST['ScmbLine'];
// }




?>

    <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop">

   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Serial <b id="SerialNumber" name="SerialNumber"></b> is successfully insert!</div>

   <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Serial <b id="Serial_Error1" name="Serial_Error1"></b> is already exist!</div>

   <div id = "error2" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> <b id="Serial_Error2" name="Serial_Error2"></b>: Wrong Serial format!</div>

   <div id = "error3" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> <b id="Serial_Error3" name="Serial_Error3"></b>: Wrong Serial number!</div>

     <form method="POST">
    <div class="form-group">
      <label for="usr">Model:</label>

      <Select class="form-control" id="ScmbModel" name="ScmbModel">
        <option></option>
        <?php 
            $SelectModel = Model::SelectAllPTMotherModel($_SESSION['account']);
                     for($i=0;$i<count($SelectModel);$i++){
                ?>
        <option value ='<?php echo $SelectModel[$i]->getModel(); ?>' <?php if($cmbmodel==$SelectModel[$i]->getModel()) {echo "selected";} ?> ><?php echo $SelectModel[$i]->getModel(); ?></option>
         <?php 
       }
       ?> 
      </Select>
    </div>

<!--         <div class="form-group">
      <label for="pwd">Model:</label>
      <input type="text" class="form-control" id="Stextmodel" name="Stextmodel" value="H740PEN" disabled >
    </div> -->

    <div class="form-group">
      <label for="usr">Line:</label>
      <Select class="form-control" id="ScmbLine" name="ScmbLine" disabled>
        <option></option>
           <?php 
            $SelectLine = Line::SelectAllLine($_SESSION['account'],$_SESSION['module']);
                     for($i=0;$i<count($SelectLine);$i++){
                ?>
                <option value ='<?php echo $SelectLine[$i]->getLine(); ?>' <?php if($cmbline== $SelectLine[$i]->getLine()) {echo "selected";} ?> >Line: <?php echo $SelectLine[$i]->getLine(); ?></option>
                 <?php 
       }
       ?>
      </Select>
    </div>

    <div class="form-group">
      <label for="usr">Type:</label>
      <Select class="form-control" id="Scmbtype" name="Scmbtype">
        <option value ="N">N: Normal</option>
        <option value ="D">D: Debug</option>
        <option value ="R">R: Return</option>
        <option value ="S">S: Special</option>
      </Select>
    </div>

    <div class="form-group">
      <label for="pwd">Mother Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" disabled >
    </div>

    
    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
      

  <div class="panel panel-primary">
                    <div class="panel-heading">Mother Serial Details</div>
                    <div class="panel-body">
                           <div class="row">
                            <div class="col-md-3">
                                <label>Family:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtFamily" name="txtFamily" class="form-control input-sm" value="" <?php echo $readonly; ?>><br>
                            </div>
                            <div class="col-md-3">
                                <label>Quantity:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtQuantity" name="txtQuantity" class="form-control input-sm" value="" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                                <label>Model:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtModel" name="txtModel" value="" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                            <div class="col-md-3">
                                <label>Type:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtRev" name="txtRev" value="<?php echo $revision;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Line:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtLine" name="txtLine" value="<?php echo $line;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                                <label>Location:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtLocation" name="txtLocation" value="<?php echo $location;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                              <div class="row">
                            <div class="col-md-3">
                                <label>Status:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtStatus" name="txtStatus" value="<?php echo $status;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Created By:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtCreatedBy" name="txtCreatedBy" value="<?php echo $createdby;?>" class="form-control input-sm" <?php echo $readonly;  ?>><br>
                            </div>
                          </div>
                  </div>      
              </div>

    </div>
 </form>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {

          $('#ScmbModel').change(function (){

             var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   var result = this.responseText;
                   var res = result.split("_");
                    // alert(result);
                    document.getElementById("txtFamily").value = res[1];
                   document.getElementById("txtQuantity").value = res[0];
                
                  document.getElementById("txtModel").value = document.getElementById("ScmbModel").value;
                  document.getElementById("ScmbLine").disabled = false;
                  }
                 };
                  xmlhttp.open("GET", "../php/batchquantity.php?modelno=" + document.getElementById("ScmbModel").value, true);
                xmlhttp.send();


          if (document.getElementById("ScmbLine").value == '') {
            $('#ScmbLine').focus();
            document.getElementById("StextSerial").disabled = true;
            document.getElementById("txtFamily").value == '';
            document.getElementById("txtQuantity").value == '';
          }else{

            document.getElementById("StextSerial").disabled = false;
            $('#StextSerial').focus();        
          }
           });
      
           $('#ScmbLine').change(function (){
          if (document.getElementById("ScmbLine").value == '') {
            $('#ScmbLine').focus();
            document.getElementById("StextSerial").disabled = true;
          }else{
             document.getElementById("ScmbModel").disabled = true;
            document.getElementById("StextSerial").disabled = false;
            $('#StextSerial').focus();
          }
        });


           if (document.getElementById("ScmbLine").value != '' && document.getElementById("ScmbModel").value != '') {
             document.getElementById("StextSerial").disabled = false;
            $('#StextSerial').focus();
          }


        $('#StextSerial').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

      if (document.getElementById("StextSerial").value == '') {     
          return;
        }
         else if (document.getElementById("ScmbModel").value == '') {  
              $('#ScmbModel').focus();
          return;
        }else if (document.getElementById("ScmbLine").value == '') { 
           $('#ScmbLine').focus();    
          return;
        }else{
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
                //alert(result);
               if( res[0]  == 'success'){
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("success").removeAttribute("hidden");
                document.getElementById("error1").setAttribute("hidden",""); 
                document.getElementById("error2").setAttribute("hidden",""); 
                document.getElementById("error3").setAttribute("hidden","");
                document.getElementById("StextSerial").value = "";
                document.getElementById("SerialNumber").innerHTML = res[1];
                document.getElementById("txtModel").value = res[2];
                document.getElementById("txtRev").value = res[3];
                document.getElementById("txtLine").value = res[4];
                document.getElementById("txtLocation").value = res[5];
                document.getElementById("txtStatus").value = res[6];
                document.getElementById("txtCreatedBy").value = res[7];
                
                var myVar = setInterval(myTimer, 1500);

                function myTimer(){
              /*  document.getElementById("txtModel").value ='';*/
                document.getElementById("txtRev").value ='';
                document.getElementById("txtLine").value ='';
                document.getElementById("txtLocation").value ='';
                document.getElementById("txtStatus").value ='';
                document.getElementById("txtCreatedBy").value ='';
               /*  document.getElementById("txtQuantity").value ='';
                  document.getElementById("txtFamily").value ='';*/
                }

                }else if(res[0]  == 'error1'){
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("error1").removeAttribute("hidden");
                document.getElementById("success").setAttribute("hidden",""); 
                document.getElementById("error2").setAttribute("hidden",""); 
                document.getElementById("error3").setAttribute("hidden","");
                document.getElementById("Serial_Error1").innerHTML = res[1];
                }else if(res[0]  == 'error2'){
                document.getElementById("error2").setAttribute("hidden","");
                document.getElementById("error2").removeAttribute("hidden");
                document.getElementById("success").setAttribute("hidden",""); 
                document.getElementById("error1").setAttribute("hidden",""); 
                document.getElementById("error3").setAttribute("hidden","");
                document.getElementById("Serial_Error2").innerHTML = res[1];
                }else if(res[0]  == 'error3'){
                document.getElementById("error3").setAttribute("hidden","");
                document.getElementById("error3").removeAttribute("hidden");
                document.getElementById("success").setAttribute("hidden",""); 
                document.getElementById("error2").setAttribute("hidden",""); 
                document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("Serial_Error3").innerHTML = res[1];
                }  

              }
        };
              xmlhttp.open("GET", "../php/addmother.php?serialno=" + document.getElementById("StextSerial").value +"&model="+ document.getElementById("ScmbModel").value + "&line=" + document.getElementById("ScmbLine").value + "&type=" + document.getElementById("Scmbtype").value+ "&quantity=" + document.getElementById("txtQuantity").value, true);
            xmlhttp.send();
          }

          }

        });



      });

  </script>


  <!-- -------------------------------------------------------------------------------------------------------------------------------- -->       
          </div>
        </div>
  </main>
