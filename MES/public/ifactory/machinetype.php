
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
<?php
  
  include_once("../classes/ifactory_machinedetails.php");

 $disabled = 'disabled';
 $readonly = 'readonly';

 $id= '';
 $name= '';
 $img= '';

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
      <input type="text" class="form-control" id="StextID" name="StextID" value="<?php echo $id; ?>"  >
    </div>
    
  <div class="form-group">
      <label for="pwd">Name:</label>
      <input type="text" class="form-control" id="Stextname" name="Stextname" value="<?php echo $name; ?>"  >  
    </div>

<!--       <div class="form-group" align = "left">
      <label>
        <input type="file" name="pic" accept="image/*">
      </label>
    </div> -->


    <div class="form-group" align = "right">
       <!--  <button type="button"  id="btnAdd" name="btnAdd" class="btn btn-primary btn-lg" >Add</button> -->
        <button type="button"  id="btnSave" name="btnSave" class="btn btn-success btn-lg" >Save</button>
        <a id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" href="?cancel">Cancel</a>
      </div>

 <div id="imgmachine" >  

<?php if ($id==''){

}else{
  ?>                  
  <img src="<?php echo $img;?>"  width="300" height="250" style="width:auto;">    
  <?php } ?>           
</div>


    </div>
    &nbsp; &nbsp; &nbsp;

    <div class="mdl-cell--top mdl-cell--12-col mdl-cell--8-col-desktop">
              <div class="panel panel-primary" >
                  <div class="panel-heading">Machine Details</div>
                  <div class="panel-body">
                      <br />
                      <div class="table-responsive" style="overflow-x: scroll;height:400px;">
                            <table class="table table-bordered"  id="tblmachine" >
                                <thead>
                                    <tr>
                                        <th class="info">ID</th>
                                        <th class="info">Name</th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                              <?php
                   include_once("../classes/ifactory_machinedetails.php");
                     $details = machinedetails::getallmachinetype();
                     for($i=0;$i<count($details);$i++){

                    ?>

                    <tr> 
                        <td><a href="?details=<?php echo $details[$i]->getid(); ?>" ><?php echo $details[$i]->getid(); ?></a></td>
                        <td><?php echo $details[$i]->getname(); ?></td>
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



 $('#Stextname').change(function (){


           
/*
          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
               //alert(result);
               document.getElementById("StextID").value = res[0];
              }
            };

            xmlhttp.open("GET", "../php/getmaxmachineid.php?name="+ document.getElementById("Stextname").value, true);
            xmlhttp.send();*/

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
