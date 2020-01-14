
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
<?php
  
  include_once("../classes/ifactory_machinedetails.php");

 $disabled = 'disabled';
 $readonly = 'readonly';
 $name = '';
 $serial = '';
 $control = '';
 $asset = '';
 $ionicsid= '';
 $manufacturer= '';
 $id= '';
 $cmbtype= '';
 $cmbname= '';
 $modelno = '';
 $active = '0';

 $mode = 0;

if(isset($_GET['details']))
{
    //$partscode = $_GET['partscode'];

    $details = new machinedetails($_GET['details']);

    $id = $details->getmachineid();
    $cmbname = $details->getmachine();
    $cmbtype = $details->getconfigurationtype();
    $serial = $details->getserialnumber();
    $modelno = $details->getmodelnumber();
    $control = $details->getcontrolnumber();
    $asset = $details->getassetnumber();
    $ionicsid = $details->getionicsid();
    $manufacturer = $details->getmanufacturer();
    $active = $details->getactive();
    

    $readonly = '';
    //$disabled = ''; 

    $mode = 1;

}
    ?>

  <div class="mdl-cell--top mdl-cell--12-col mdl-cell--3-col-desktop">

<input type="hidden" class="form-control" id="mode" name="mode" value="<?php echo $mode; ?>" <?php echo $readonly;?> >
     <div class="form-group">
      <label for="pwd">ID:</label>
      <input type="text" class="form-control" id="StextID" name="StextID" value="<?php echo $id; ?>"  <?php echo $disabled;?>>
    </div>
    
  <div class="form-group">
      <label for="pwd">Name:</label>
       <Select class="form-control" id="Scmbname" name="Scmbname" value="<?php echo $cmbname;?>" <?php if ($mode == 0){ }else{echo $disabled; } ?>>
               <option></option>
    <?php 
            $select = machinedetails::SelectMachine();
                     for($i=0;$i<count($select);$i++){
                ?>
        <option value ='<?php echo $select[$i]->getname(); ?>' <?php if($cmbname==$select[$i]->getname()) {echo "selected";} ?> ><?php echo $select[$i]->getname(); ?> </option>
         <?php 
       }
       ?> 
     </Select>
    </div>


  <div class="form-group">
    
      <label for="pwd">Configuration Type:</label>
            <Select class="form-control" id="Scmbtype" name="Scmbtype" value="<?php echo $cmbtype;?>" <?php echo $disabled;?>>
               <option></option>
    <?php 
            $select = machinedetails::SelectConfigurationType();
                     for($i=0;$i<count($select);$i++){
                ?>
        <option value ='<?php echo $select[$i]->getconfigurationtype(); ?>' <?php if($cmbtype==$select[$i]->getconfigurationtype()) {echo "selected";} ?> ><?php echo $select[$i]->getconfigurationtype(); ?> </option>
         <?php 
       }
       ?> 

     </Select>
    </div>

     <div class="form-group">
      <label for="pwd">Model No.:</label>
      <input type="text" class="form-control" id="Stextmodelno" name="Stextmodelno" value="<?php echo $modelno; ?>" <?php echo $readonly;?> onkeypress="if (event.keyCode == 13)  return false;" autocomplete="off">
    </div>

 <div class="form-group">
      <label for="pwd">Serial No.:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" value="<?php echo $serial; ?>" <?php echo $readonly;?> onkeypress="if (event.keyCode == 13)  return false;" autocomplete="off">
    </div>

     <div class="form-group">
      <label for="pwd">Control No.:</label>
      <input type="text" class="form-control" id="StextControl" name="StextControl" value="<?php echo $control; ?>" <?php echo $readonly;?> onkeypress="if (event.keyCode == 13)  return false;" autocomplete="off">
    </div>


 <div class="form-group">
      <label for="pwd">Asset No.:</label>
      <input type="text" class="form-control" id="StextAsset" name="StextAsset" value="<?php echo $asset; ?>" <?php echo $readonly;?> onkeypress="if (event.keyCode == 13)  return false;" autocomplete="off">
    </div>

  
     <div class="form-group">
      <label for="pwd">IONICS ID:</label>
      <input type="text" class="form-control" id="StextIonicsid" name="StextIonicsid" value="<?php echo $ionicsid; ?>" <?php echo $readonly;?> onkeypress="if (event.keyCode == 13)  return false;" autocomplete="off">
    </div>

       <div class="form-group">
      <label for="pwd">Manufacturer:</label>
      <input type="text" class="form-control" id="StextManufacturer" name="StextManufacturer" value="<?php echo $manufacturer; ?>" <?php echo $readonly;?> onkeypress="if (event.keyCode == 13)  return false;" autocomplete="off">
    </div>


      <div class="form-group" align = "right">
      <label>
      <input type="checkbox" id="chkActive" name="chkActive" <?php if($active=='1'){echo "checked";} ?>> Active
      </label>
    </div>


    <div class="form-group" align = "right">
       <!--  <button type="button"  id="btnAdd" name="btnAdd" class="btn btn-primary btn-lg" >Add</button> -->
        <button type="button"  id="btnSave" name="btnSave" class="btn btn-success btn-lg" >Save</button>
        <a id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" href="?cancel">Cancel</a>
      </div>

    </div>
    &nbsp; &nbsp; &nbsp;
    <div class="mdl-cell--top mdl-cell--12-col mdl-cell--9-col-desktop">
              <div class="panel panel-primary" >
                  <div class="panel-heading">Machine Details</div>
                  <div class="panel-body">
                      <br />
                      <div class="table-responsive" style="overflow-x: scroll;height:400px;">
                            <table class="table table-bordered"  id="tblmachine" >
                                <thead>
                                    <tr>
                                        <th class="info">ID</th>
                                        <th class="info">Type</th>
                                        <th class="info">Name</th>
                                        <th class="info">Model</th>
                                        <th class="info">Serial#</th>
                                        <th class="info">Control#</th>
                                        <th class="info">Asset#</th>
                                        <th class="info">IonicsID</th>
                                        <th class="info">Manufacturer</th>
                                    </tr>
                                </thead>
                                <tbody>
                              <?php
                   include_once("../classes/ifactory_machinedetails.php");
                     $details = machinedetails::getdetails();

                     for($i=0;$i<count($details);$i++){

                    ?>

                    <tr> 
                        <td><a href="?details=<?php echo $details[$i]->getmachineid(); ?>"><?php echo $details[$i]->getmachineid(); ?></a></td>

                        <td><?php echo $details[$i]->getconfigurationtype(); ?></td>
                        <td><?php echo $details[$i]->getmachine(); ?></td>
                        <td><?php echo $details[$i]->getmodelnumber(); ?></td>
                        <td><?php echo $details[$i]->getserialnumber(); ?></td>
                        <td><?php echo $details[$i]->getcontrolnumber(); ?></td>
                        <td><?php echo $details[$i]->getassetnumber(); ?></td>
                        <td><?php echo $details[$i]->getionicsid(); ?></td>
                        <td><?php echo $details[$i]->getmanufacturer(); ?></td>

                    </tr>

                    <?php } ?>
                                </tbody>
                            </table>
                      </div>
                  </div>    
      
                </div>

    </div>
 


<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {


 $('#Scmbname').change(function (){

    if (document.getElementById("Scmbname").value == '') {
           

            document.getElementById("StextID").value == '';
            document.getElementById("Scmbtype").disabled = true;
             $('#Scmbname').focus();
          }else{

           

          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
               //alert(result);
               document.getElementById("StextID").value = res[0];
              }
            };

            xmlhttp.open("GET", "../php/getmaxmachineid.php?name="+ document.getElementById("Scmbname").value, true);
            xmlhttp.send();

            document.getElementById("Scmbtype").disabled = false;
          

          }

 });



 $('#Scmbtype').change(function (){

    if (document.getElementById("Scmbtype").value == '') {
            $('#Scmbtype').focus();
          
          }else{
                document.getElementById('StextSerial').readOnly = false;
                document.getElementById('StextControl').readOnly = false;
                document.getElementById('StextAsset').readOnly = false;
                document.getElementById('StextIonicsid').readOnly = false;
                document.getElementById('StextManufacturer').readOnly = false;
                document.getElementById('Stextmodelno').readOnly = false;
      }

   });


 $( "#btnSave" ).click(function() {

          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
               alert(result);
          


              }
            };

            xmlhttp.open("GET", "../php/machinedetails.php?machineid=" + document.getElementById("StextID").value +"&machinename="+document.getElementById("Scmbname").value+"&type="+ document.getElementById("Scmbtype").value+"&serialno="+ document.getElementById("StextSerial").value+"&controlno="+ document.getElementById("StextControl").value+"&assetno="+ document.getElementById("StextAsset").value+"&ionicsid="+ document.getElementById("StextIonicsid").value+"&modelno="+ document.getElementById("Stextmodelno").value+"&manufacturer="+ document.getElementById("StextManufacturer").value+"&mode="+ document.getElementById("mode").value+"&active="+ document.getElementById("chkActive").checked, true);
            xmlhttp.send();
            
        });



});
</script>     
          </div>
        </div>
  </main>
