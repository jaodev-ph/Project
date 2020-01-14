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
$cmbprodline="";
$cmbjobtype="";
?>

<div class="mdl-cell--top mdl-cell--12-col mdl-cell--4-col-desktop">

 <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>

   <strong>Success!</strong> Lot number <b id="SerialNumber" name="SerialNumber"></b> is successfully completed!</div>

   <div id = "successreject" class="alert alert-success alert-dismissible" role="alert" hidden>

   <strong>Success!</strong> Serial <b id="Serial_Error6" name="Serial_Error6"></b> is successfully rejected!</div>


<div class="form-group ">
  <div class="col-md-12">

  <label for="usr">Machine Name</label>
    <select class="form-control" id="Scmbname"  name="Scmbname"  placeholder="Select Machine" required="required" >
    <option></option> 
      <?php  
            $selectline = Maintenance::getmachinelist();
            for($i=0;$i<count($selectline);$i++){
          ?>
      <option value='<?php echo $selectline[$i]->getmachinename(); ?>'<?php if($cmbprodline==$selectline[$i]->getmachinename()) {echo "selected";} ?> ><?php echo $selectline[$i]->getmachinename(); ?></option>
          <?php }?>
    </select>

    <label for="usr">Job Type</label>
    <select class="form-control" id="Scmbjobtype"  name="Scmbjobtype"  placeholder="Select Job" disabled required="required" >
    <option></option> 
            <?php  
            $selecttype = Tasktype::getallTasktype();
            for($i=0;$i<count($selecttype);$i++){
          ?>
      <option value='<?php echo $selecttype[$i]->getTasktype(); ?>' <?php if($cmbjobtype==$selecttype[$i]->getTasktype()) {echo "selected";} ?>><?php echo $selecttype[$i]->getTasktype(); ?></option>
          <?php } ?>
    </select>

  </div>
</div>

<div class="form-group ">
  <div class="col-md-12" align="right"><br>
  <button type ="button" class="btn btn-success emp-btn" id ="Add" name="Add" data-toggle="modal" data-backdrop="static" data-target="#Modal_Add" disabled>ADD</button>

    <button type ="button" class="btn btn-success emp-btn" id ="Edit" name="Edit" data-toggle="modal" data-backdrop="static" data-target="#Modal_Edit" disabled>EDIT</button>
 
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
<div class="modal fade " id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style=""  >
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1F618D;">
        <button id='modalmenuexit'type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;">Add</h4>
      </div>
      <div class="modal-body">
   <form method="post" id = "FormAdd">

    <div id = "addsuccess1" class="alert alert-success alert-dismissible" role="alert" hidden>
                <strong>Success!</strong> Successfully added!</div> 

<div class="form-group">
    Machine:
  <input type="text" name="txtmachine" class="form-control" id="txtmachine" readonly>

</div>

<div class="form-group">
     TypeID:
 <input type="text" name="txttypeid" class="form-control" id="txttypeid" readonly>
</div>

<div class="form-group">
    Job Type:
 <input type="text" name="txttype" class="form-control" id="txttype" readonly>
</div>

<div class="form-group">
     Sequence:
       <input type="number" min="1" name="txtsequence"  class="form-control" id="txtsequence" required>
</div>

<div class="form-group">
    Job:
       <input type="text" name="txtjob" class="form-control" id="txtjob" required>
</div>



<div class="form-group">
     Active:
       <input type="checkbox" name="txtactive" id="txtactive" value = "1" required>
</div>

      <div class="modal-footer">
         <button type="button" class="btn btn-light" id="btnAdd" name="btnAdd" data-dismiss="static" data-backdrop="static"> Add </button>
        <!-- <button type="submit" id="changepass" class="btn btn-success" >Change</button> -->
        <button type="button" class="btn btn-light"  id="add_cancel" data-dismiss="modal">Close</button>
        </form>

      </div>
    </div>
  </div>
</div>
</div>


<!-- EDIT -->
<div class="modal fade " id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style=""  >
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1F618D;">
        <button id='modalmenuclose'type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;">Edit</h4>
      </div>
      <div class="modal-body">
   <form method="post" id = "FormEdit">

<div class="form-group">
    Machine:
  <input type="text" name="edittxtmachine" class="form-control" id="edittxtmachine" readonly>

</div>

<div class="form-group">
     TypeID:
 <input type="text" name="edittxttypeid" class="form-control" id="edittxttypeid" readonly>
</div>

<div class="form-group">
    Job Type:
 <input type="text" name="edittxttype" class="form-control" id="edittxttype" readonly>
</div>

<div class="form-group">
     Sequence:
       <!-- <input type="number" min="1" name="edittxtsequence"  class="form-control" id="edittxtsequence" required> -->
           <select class="form-control" id="edittxtsequence"  name="edittxtsequence"  placeholder="Select Job" required="required" >
    <option></option> 
      
    </select>
</div>

<div class="form-group">
    Job:
       <input type="text" name="edittxtjob" class="form-control" id="edittxtjob" required>
</div>

      <div class="modal-footer">
         <button type="button" class="btn btn-light" id="btnEdit" name="btnEdit" data-dismiss="static" data-backdrop="static"> Save </button>
        <!-- <button type="submit" id="changepass" class="btn btn-success" >Change</button> -->
        <button type="button" class="btn btn-light"  id="edit_cancel" data-dismiss="modal">Close</button>
        </form>

      </div>
    </div>
  </div>
</div>


</main>
<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

 $(document).ready(function () {



    $('#Scmbname').change(function (){

    if (document.getElementById("Scmbname").value == '') { 

            document.getElementById("ScmbStation").disabled = true;
            document.getElementById("Add").disabled = true;
            document.getElementById("Edit").disabled = true;
          return;
          }else {
            document.getElementById("Scmbjobtype").disabled = false; 
             $("#tbldetails > tbody ").empty(); 
            }
       
           }); 

$('#Scmbjobtype').change(function (){

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
/*               alert(result);*/
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
       
           });

     $( "#Add" ).click(function() {

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

     $( "#Edit" ).click(function() {

          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
         /*      alert(result)*/
                if(res[0].trim() == 'success'){
                  
                  document.getElementById("edittxtmachine").value=res[1];
                  document.getElementById("edittxttype").value=res[2];
                  document.getElementById("edittxttypeid").value=res[3];
                 
                 var seq = result.split("&"); 
                 var seq1 = seq[1].split("_"); 

               var x1 = document.getElementById("edittxtsequence");
               var option1 = document.createElement("option");
            
               for (i = 0; i < seq1.length - 1; i++) { 
                      // alert(res[i]);
                      var x = document.getElementById("edittxtsequence");
                      var option = document.createElement("option");
                      option.text = seq1[i];
                      x.add(option);
                    }
               
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

         $( "#btnEdit" ).click(function() {

          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
               alert(result)
                if(res[0].trim() == 'success'){

                     document.getElementById("edittxtmachine").value="";
                      document.getElementById("edittxttype").value="";
                       document.getElementById("edittxttypeid").value="";
                        document.getElementById("edittxtjob").value="";
                        document.getElementById("edittxtsequence").value="";
                   $('#Modal_Edit ').modal('hide');

                
                }
               
              }
            };

            xmlhttp.open("GET", "../php/pmmaintenanceedit.php?name=" + document.getElementById("edittxtmachine").value +"&jobtype="+document.getElementById("edittxttype").value+"&typeid="+document.getElementById("edittxttypeid").value+"&job="+document.getElementById("edittxtjob").value+"&seq="+document.getElementById("edittxtsequence").value, true);
            xmlhttp.send();



            
        });
  
  });



</script>
