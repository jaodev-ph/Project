
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
<?php
  
  include_once("../classes/ifactory_machinedetails.php");

 $disabled = 'disabled';
 $readonly = 'readonly';

 $id= '';
 $cmbname= '';
 $img= '';
 $line= '';
 $seq= '';
 $cmbmachineid= '';
 $cmbline= '';


 $mode = 0;

if(isset($_GET['details']))
{
    //$partscode = $_GET['partscode'];

    $machinetype = new machinedetails();
    $machinetype->getmachinetypedetails($_GET['details']);

    $id = $machinetype->getid();
    $name = $machinetype->getname();
    $img = $machinetype->getimage();
  

    $readonly = '';
    //$disabled = ''; 

    $mode = 1;

}
    ?>

    <div class="mdl-cell--top mdl-cell--12-col mdl-cell--4-col-desktop">


      <input type="hidden" class="form-control" id="mode" name="mode" value="<?php echo $mode; ?>" <?php echo $readonly;?> >
     <div class="form-group">
      <label for="pwd">ID:</label>
      <Select class="form-control" id="Scmbname" name="Scmbname" value="<?php echo $cmbmachineid;?>" <?php if ($mode == 0){ }else{echo $disabled; } ?>>
               <option></option>
            <?php 
            $select = machinedetails::SelectMachineID();
                     for($i=0;$i<count($select);$i++){ ?>
        <option value ='<?php echo $select[$i]->getmachineid(); ?>' <?php if($cmbmachineid==$select[$i]->getmachineid()) {echo "selected";} ?> ><?php echo $select[$i]->getmachineid(); ?> </option>
         <?php } ?> 
     </Select>
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
              <div class="panel panel-primary" >
                  <div class="panel-heading">Machine ID</div>
                  <div class="panel-body">
                      <br />
                      <div class="table-responsive" style="overflow-x: scroll;height:300px;">


                            <table class="table table-bordered"  id="tblmachineid" >
                                <thead>
                                    <tr>
                                        <th class="info">ID</th>
                                        <th class="info">Name</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                              <?php
                   include_once("../classes/ifactory_machinedetails.php");
                     $details = machinedetails::getdetails();
                     for($i=0;$i<count($details);$i++){

                    ?>
                    <tr> 
                        <td><?php echo $details[$i]->getmachineid(); ?></td>
                        <td><?php echo $details[$i]->getmachine(); ?></td>
                    </tr>
                    <?php } ?>
                                </tbody>
                            </table>
                      </div>
                  </div>    
      
                </div>

    </div>
 &nbsp; &nbsp; &nbsp;
    <div class="mdl-cell--top mdl-cell--12-col mdl-cell--8-col-desktop">
              <div class="panel panel-primary" >
                  <div class="panel-heading">Production Line Details</div>
                  <div class="panel-body">
                      <br />
                      <div class="table-responsive" style="overflow-x: scroll;height:300px;">


                            <table class="table table-bordered"  id="tblproductionline" >
                                <thead>
                                    <tr>
                                        <th class="info">Production Line</th>
                                        <th class="info">Name</th>
                                        <th class="info">ID</th>
                                        <th class="info">Seq</th>
                                    </tr>
                                </thead>
                                <tbody>
                              <?php
                   include_once("../classes/ifactory_machinedetails.php");
                     $details = machinedetails::getallproductionline();
                     for($i=0;$i<count($details);$i++){

                    ?>
                    <tr> 
                       <td><?php echo $details[$i]->getproductionlineid(); ?></td>
                        <td><?php echo $details[$i]->getname(); ?></td>
                        <td><?php echo $details[$i]->getid(); ?></td>   
                        <td><?php echo $details[$i]->getseq(); ?></td>
                    </tr>

                    <?php } ?>
                                </tbody>
                            </table>
                      </div>
                  </div>    
      
                </div>
            </div>

  <div class="mdl-cell--top mdl-cell--12-col mdl-cell--12-col-desktop">
    <div class="panel panel-primary" >
      <div class="panel-heading">Line Setup</div>
        <div class="panel-body">
          <br />

            <div class="form-group">
    
      <label for="pwd">Production Line:</label>
       <Select class="form-control" id="Scmbname" name="Scmbname" value="<?php echo $cmbline;?>" <?php if ($mode == 0){ }else{echo $disabled; } ?>>
      <option></option>
          <?php 
            $select = machinedetails::Selectline();
                     for($i=0;$i<count($select);$i++){ ?>
        <option value ='<?php echo $select[$i]->getline(); ?>' <?php if($cmbline==$select[$i]->getline()) {echo "selected";} ?> ><?php echo $select[$i]->getline(); ?> </option>
         <?php } ?> 
     </Select>

    </div>
           <div class="table-responsive" style="overflow-x: scroll;height:400px;">

    <table class="table table-bordered"  id="tbladdmachine" >
      <thead>
        <tr>
        <th class="info">ID</th>
        <th class="info">Name</th>
        <th class="info">Production Line</th>
        <th class="info">Seq</th>
        <th class="info"></th>
        </tr>
      </thead>

    <tbody>
     <!--  <tr>

    <td width="15%">
      <Select class="form-control" id="Scmbname" name="Scmbname" value="<?php echo $cmbmachineid;?>" <?php if ($mode == 0){ }else{echo $disabled; } ?>>
               <option></option>
            <?php 
            $select = machinedetails::SelectMachineID();
                     for($i=0;$i<count($select);$i++){ ?>
        <option value ='<?php echo $select[$i]->getmachineid(); ?>' <?php if($cmbmachineid==$select[$i]->getmachineid()) {echo "selected";} ?> ><?php echo $select[$i]->getmachineid(); ?> </option>
         <?php } ?> 
     </Select>
   </td>
        
    <td><?php echo "machinename"; ?></td>
     
    <td width="15%">
      <Select class="form-control" id="Scmbname" name="Scmbname" value="<?php echo $cmbline;?>" <?php if ($mode == 0){ }else{echo $disabled; } ?>>
      <option></option>
          <?php 
            $select = machinedetails::Selectline();
                     for($i=0;$i<count($select);$i++){ ?>
        <option value ='<?php echo $select[$i]->getline(); ?>' <?php if($cmbline==$select[$i]->getline()) {echo "selected";} ?> ><?php echo $select[$i]->getline(); ?> </option>
         <?php } ?> 
     </Select>
    </td>

     <td width="15%">
      <input class="form-control" type="text" id="Stextseq" name="Stextseq">
     </td>
    </tr> -->
    </tbody>
  </table>
  </div>
  </div>    
      
</div>

        <div class="form-group" align = "right">
    
        <button type="button"  id="btnSave" name="btnSave" class="btn btn-success btn-lg" >Save</button>
        <a id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" href="?cancel">Cancel</a>
      </div>

    </div>


<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {

         $("#add").click(function(){
            var id = $("#name").val();
            var email = $("#email").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td><td>" + email + "</td></tr>";
            $('#tbladdmachine > tbody').append(markup);
        });




 $( "#btnSave" ).click(function() {



/*          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
               alert(result);
          


              }
            };

            xmlhttp.open("GET", "../php/machinedetails.php?machineid=" + document.getElementById("StextID").value +"&machinename="+document.getElementById("Scmbname").value+"&type="+ document.getElementById("Scmbtype").value+"&serialno="+ document.getElementById("StextSerial").value+"&controlno="+ document.getElementById("StextControl").value+"&assetno="+ document.getElementById("StextAsset").value+"&ionicsid="+ document.getElementById("StextIonicsid").value+"&modelno="+ document.getElementById("Stextmodelno").value+"&manufacturer="+ document.getElementById("StextManufacturer").value+"&mode="+ document.getElementById("mode").value+"&active="+ document.getElementById("chkActive").checked, true);
            xmlhttp.send();*/
            
        });



});
</script>     
          </div>
        </div>
  </main>
