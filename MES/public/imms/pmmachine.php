<main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
 <!-- -------------------------------------------------------------------------------------------------------------------------------- -->    

<?php 
include_once("../classes/pmdetails.php");

$readonly = 'readonly';
$cmbprodline = "";
$cmbname = "";

?>

<div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-desktop">

<div class="form-group ">
  <div class="col-md-12">
  <label for="usr">Production Line</label>
    <select class="form-control" id="Scmbprodline" name="Scmbprodline" onchange="prodline(this);" placeholder="Select Line" required="required">
    <option ></option> 
         <?php  
            $selectline = line::getallLine();
            for($i=0;$i<count($selectline);$i++){
          ?>
      <option value='<?php echo $selectline[$i]->getLine(); ?>'<?php if($cmbprodline==$selectline[$i]->getLine()) {echo "selected";} ?> ><?php echo $selectline[$i]->getLine(); ?></option>
          <?php }?>
    </select>

  <label for="usr">Machine Name</label>
    <select class="form-control" id="Scmbname"  name="Scmbname" onchange="name(this);" placeholder="Select Machine" required="required" >
    <option></option> 
 			
    </select>

  <label for="usr">Machine ID</label>
    <input type="text" id="Stxtmachineid" name="Stxtmachineid" value="" class="form-control input-sm" >

  <label for="usr">Machine Type</label>
    <input type="text" id="Stxtmachinetype" name="Stxtmachinetype" value="" class="form-control input-sm" >

  <label for="usr">Machine Sequence</label>
    <input type="Sequence" id="Stxtmachineseq" name="Stxtmachineseq" value="" class="form-control input-sm" >

  </div>
</div>

<div class="form-group ">
  <div class="col-md-12"><br>
 <button type ="button" class="btn btn-success emp-btn" id ="btnSave" name="btnSave">ADD</button>
  <button type ="button" class="btn btn-primary emp-btn" id ="btnSave" name="btnSave">SAVE</button>
  <button type ="button" class="btn btn-warning emp-btn" id ="btnClear" name="btnClear" onclick="window.location.reload()">CANCEL</button> 
  </div>
</div>
</div>

<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop">

 <div class="panel panel-primary">
    <div class="panel-heading">Machine Line</div>
      <div class="panel-body">
        <table class="table table-bordered">
        <tr class="info">
                <thead id="linetableheading" name="linetableheading">  
                  
                    <th><label for="usr">Id   </label></th>
                    <th><label for="usr">Line </label></th>   
                    <th><label for="usr">Name </label></th>   
                    <th><label for="usr">Type </label></th> 
                    <th><label for="usr">Sequence</label></th>
                        
                </thead>  

              
              <tbody id="machineline" name="machineline">
          
         
                  
              </tbody>
              </tr>
        </table>
      </div>

</div>



</div>
 <!-- -------------------------------------------------------------------------------------------------------------------------------- -->    
          </div>
        </div>
</main>
<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

  $(document).ready(function () {

         $('#Scmbprodline').change(function (){

          // if (document.getElementById("ScmbModel").value == '') {

      if (document.getElementById("Scmbprodline").value == '') { 

           
          return;
          }else {

            document.getElementById("ScmbStation").disabled = false;
            document.getElementById("ScmbStation").innerHTML = "";  
             $('#ScmbStation').focus();
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
               var x1 = document.getElementById("ScmbStation");
               var option1 = document.createElement("option");
               option1.text = '';
               x1.add(option1);
               for (i = 0; i < res.length - 1; i++) { 
                      // alert(res[i]);
                      var x = document.getElementById("ScmbStation");
                      var option = document.createElement("option");
                      option.text = res[i];
                      x.add(option);
                    }
              }
            };

            xmlhttp.open("GET", "../php/getmodelroute.php?modelno=" + document.getElementById("ScmbModel").value+"&formodel=0&station=test", true);
            xmlhttp.send();
          }


       
           });
}

</script>
