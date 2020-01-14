<main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
 <!-- -------------------------------------------------------------------------------------------------------------------------------- -->    

<?php 
include_once("../classes/pmmaintenance.php");
include_once("../classes/pmdetails.php");
$readonly = 'readonly';
$name="";
$jobtype="";
$txtmachine="";
$txttype="";
$txtjob="";
$txtsequence="";
$cmbpmid="";
$cmbjobtype="";
?>

<div class="mdl-cell--top mdl-cell--12-col mdl-cell--4-col-desktop">

<div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>

<strong>Success!</strong> Lot number <b id="SerialNumber" name="SerialNumber"></b> is successfully completed!</div>

<div id = "successreject" class="alert alert-success alert-dismissible" role="alert" hidden>

<strong>Success!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is successfully rejected!</div>


<div class="form-group ">
  <div class="col-md-12">

  <label for="usr">Job PM ID</label>
    <select class="form-control" id="Scmbid"  name="Scmbid"  placeholder="Select Machine" required="required" >
    <option></option> 
      <?php  
            $selectid = Maintenance::getpmid();
            for($i=0;$i<count($selectid);$i++){
          ?>
      <option value='<?php echo $selectid[$i]->getid(); ?>'<?php if($cmbpmid==$selectid[$i]->getid()) {echo "selected";} ?> ><?php echo $selectid[$i]->getid(); ?></option>
          <?php }?>
    </select>
<br>
    <div class="panel panel-primary">
    <div class="panel-heading">PM ID</div>
      <div class="panel-body">
    
    <div class="row">
    <div class="col-md-3">
      <label for="usr">Line:</label>
    </div>
      <div class="col-md-9">
      <input type="text" id="Stxtline" name="Stxtline" class="form-control input-sm" <?php echo $readonly; ?>><br>
      </div>
    </div>

    <div class="row">
    <div class="col-md-3">
      <label for="usr">Job Type:</label>
    </div>
      <div class="col-md-9">
      <input type="text" id="Stxttype" name="Stxttype"  class="form-control input-sm" <?php echo $readonly; ?>><br>
      </div>
    </div>

    <div class="row">
    <div class="col-md-3">
      <label for="usr">Date Created:</label>
    </div>
    <div class="col-md-9">
      <input type="text" id="txtdatecreated" name="txtdatecreated" value=" " class="form-control input-sm" <?php echo $readonly; ?>><br>
      </div>
    </div>

    <div class="row">
    <div class="col-md-3">
      <label for="usr">Planned By:</label>
    </div>
    <div class="col-md-9">
      <input type="text" id="txtplannedBy" name="txtplannedBy" value=" " class="form-control input-sm" <?php echo $readonly;  ?>><br>
      </div>
    </div>

      </div>
    </div> 
  </div>
</div>

<div class="form-group ">
  <div class="col-md-12" align="right"><br>
  <button type ="button" class="btn btn-success emp-btn" id ="update" name="update" data-toggle="modal" data-backdrop="static" data-target="#Modal_Update" disabled>Update</button>
  <button type ="button" class="btn btn-warning emp-btn" id ="btnClear" name="btnClear" onclick="window.location.reload()">CANCEL</button> 
  </div>
</div>
</div>

<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop">

       <div class="panel panel-primary" >
                  <div class="panel-heading" >Details</div>
                  <div class="panel-body">
                      <br />
                      <div class="table-responsive" style="overflow-x: scroll;height:400px;">
                            <table class="table table-bordered"  id="tbldetails" >
                                <thead>
                                    <tr>
                                        <th class="info">Machine Name</th>
                                        <th class="info">Type</th>
                                        <th class="info">Job Type</th>
                                        <th class="info">Job</th>
                                        <th class="info">Sequence</th>
                                    </tr>
                                </thead>
                              <tbody>




                                </tbody>
                            </table>
                      </div>
                  </div>    
                </div>
    </div>
</div>
 <!-- -------------------------------------------------------------------------------------------------------------------------------- -->    
          </div>
        </div>
<!-- Add -->
<div class="modal fade " id="Modal_Update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style=""  >
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1F618D;">
        <button id='modalmenuexit'type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;">Update</h4>
      </div>
      <div class="modal-body">
   <form method="post" id = "FormUpdate">

  <div id = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
                <strong>Success!</strong> Successfully Updated!</div> 

<div class="form-group ">
  <div class="col-md-6">
    <label for="usr">Production Line</label>
    <input class="form-control" id="Sline" name="Sline" type="text" disabled required="required">
  </div>
<div class="col-md-6">
    <label for="usr">Job Type</label>
    <input class="form-control" id="Stype" name="Stype" type="text" disabled required="required">
  </div>
</div>

<div class="form-group ">
  <div class="col-md-6">
      <label for="usr">Date Start</label>
      <input class="form-control" id="SdateStart" name="SdateStart" type="Date"  required="required">
  </div>
  <div class="col-md-6">
      <label for="usr">Date End</label>
      <input class="form-control" id="SdateEnd" name="SdateEnd" type="Date"  required="required">
  </div>
</div>

<div class="form-group ">
  <div class="col-md-6">
      <label for="usr">Time Start</label>
      <input class="form-control" id="StimeStart" name="StimeStart" type="time"  required="required">
  </div>

  <div class="col-md-6">
      <label for="usr">Time End</label>
      <input class="form-control" id="StimeEnd" name="StimeEnd" type="time"  required="required">
  </div>
</div>

      <div class="modal-footer">
         <button type="button" class="btn btn-light" id="btnSave" name="btnSave" data-dismiss="static" data-backdrop="static"> Save </button>
        <!-- <button type="submit" id="changepass" class="btn btn-success" >Change</button> -->
        <button type="button" class="btn btn-light"  id="update_cancel" data-dismiss="modal">Close</button>
        </form>

      </div>
    </div>
  </div>
</div>
</div>


</main>
<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

 $(document).ready(function () {



    $('#Scmbid').change(function (){

    if (document.getElementById("Scmbid").value == '') { 

           /* document.getElementById("ScmbStation").disabled = true;*/
            document.getElementById("update").disabled = true;
          /*  document.getElementById("Edit").disabled = true;*/
          return;
          }else {
           document.getElementById("update").disabled = false;
             $("#tbldetails > tbody ").empty(); 
                   var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("&");
               //alert(result);
                          for (i = 0; i < res.length - 1; i++) { 

                      var lineid = res[i]; 
                      var res2 = res[i].split("_");
                      $('#tbldetails').append("<tr><td>"+res2[0]+"</td><td>"+res2[4]+"</td><td>"+res2[1]+"</td><td>"+res2[2]+"</td><td>"+res2[3]+"</td></tr>")
                    }
       
              }
            };

            xmlhttp.open("GET", "../php/pmidmaintenance1.php?pmid=" + document.getElementById("Scmbid").value, true);
            xmlhttp.send();
         
            }
       
           }); 

/*$('#Scmbjobtype').change(function (){

      if (document.getElementById("Scmbjobtype").value == '') { 

      document.getElementById("Add").disabled = true;
      document.getElementById("Edit").disabled = true;
  

          return;
          }else {

            
      document.getElementById("Add").disabled = false;
      document.getElementById("Edit").disabled = false;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("&");
               alert(result);
                          for (i = 0; i < res.length - 1; i++) { 

                      var lineid = res[i]; 
                      var res2 = res[i].split("_");
                      $('#tbldetails').append("<tr><td>"+res2[0]+"</td><td>"+res2[4]+"</td><td>"+res2[1]+"</td><td>"+res2[2]+"</td><td>"+res2[3]+"</td></tr>")
                    }
       
              }
            };

            xmlhttp.open("GET", "../php/pmmaintenance1.php?name=" + document.getElementById("Scmbname").value+"&jobtype="+document.getElementById("Scmbjobtype").value, true);
            xmlhttp.send();
          }
       
           });*/

     $( "#Update" ).click(function() {

          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");

               /*alert(result)*/
                if(res[0].trim() == 'success'){
                  
                  document.getElementById("txtmachine").value=res[1];
                  document.getElementById("txttype").value=res[2];
                  document.getElementById("txttypeid").value=res[3];

           
          
                }
               
              }
            };

            xmlhttp.open("GET", "../php/pmmaintenance2.php?name=" + document.getElementById("Scmbname").value +"&jobtype="+document.getElementById("Scmbjobtype").value, true);
            xmlhttp.send();
         
        });



     
     $( "#btnAdd" ).click(function() {

          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
               alert(result)
                if(res[0].trim() == 'success'){

                  document.getElementById("addsuccess1").setAttribute("hidden","");
                  document.getElementById("addsuccess1").removeAttribute("hidden");

                  document.getElementById("txtjob").value='';
                  document.getElementById("txtsequence").value='';
                  document.getElementById("txtactive").checked = false;
               
                }
               
              }
            };

            xmlhttp.open("GET", "../php/pmmaintenanceadd.php?name=" + document.getElementById("txtmachine").value +"&jobtype="+document.getElementById("txttype").value+"&typeid="+document.getElementById("txttypeid").value+"&job="+document.getElementById("txtjob").value+"&seq="+document.getElementById("txtsequence").value+"&active="+document.getElementById("txtactive").value, true);
            xmlhttp.send();


            
        });

  
  });



</script>
