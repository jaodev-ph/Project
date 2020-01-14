<?php

include_once("../classes/its_workstation.php");
include_once("../classes/its_brandmodel.php");
include_once("../classes/its_brandmodel.php");
include_once("../classes/its_companydepartment.php");
include_once("../classes/connection.php");
include_once("../classes/connection2.php");



 $disabled = 'disabled';
 $readonly = 'readonly';
 $id='';
 $brand='';
 $model='';
 $type='';

 $mode = 0;

 if(isset($_POST['btnadd']))
{ 
  $its_workstation = new Its_Workstation();
  $its_workstation->insertNewUser($_POST['user'],$_POST['company'],$_POST['dept'],$_SESSION['name']);
  echo "<script type='text/javascript'>alert('Success');</script>";

}
if(isset($_POST['btnupdate'])){

  var_dump($_POST['userid']);

  $update = new Its_Workstation();
  $update->setID($_POST['userid']);
  $update->setUsername($_POST['user']);
  $update->setCompany($_POST['company']);
  $update->setDepartment($_POST['dept']);
  $update->setLastUpdatedBy($_SESSION['name']);
  $update->updateUser();

}

?>


<!-- Modal -->
<form method="post">
	<div id="usermodal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id = "ht">Add Record</h4>
			</div>
		
			<div class="modal-body">
       
        <br>
        <div class="row">
          <div class="col-md-10">
          <label>Name</label>
          <input type="text" name="userid" id="userid" hidden>
          <input type="text" class="form-control"  id="user" name="user" placeholder="Enter Name" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-10">
            <label>Company</label>
            <select  class="form-control" name="company" id="company">
              <option></option>
              <?php
              $selectUser = Its_CompDept::getallCompany();
              for($i=0;$i<count($selectUser);$i++)
              {
                ?>
                <option value="<?php echo $selectUser[$i]->getCompany(); ?>"><?php echo $selectUser[$i]->getCompany(); ?></option>
              <?php } ?>
            </select>  
          </div>
        </div>
        <br>
        
        <div class="row">
          <div class="col-md-10">
            <label>Department</label>
            <select  class="form-control" id="dept" name="dept" >
              <option></option>
              <?php
              $selectUser = Its_CompDept::getalldepartment();
              for($i=0;$i<count($selectUser);$i++)
              {
                ?>
                <option value="<?php echo $selectUser[$i]->getDepartment(); ?>"><?php echo $selectUser[$i]->getDepartment(); ?></option>
              <?php } ?>

            </select> 
          </div>
        </div>

				
				<br>

			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-success" id="btnupdate" name ="btnupdate" value="Update"> 
        <input type="submit" class="btn btn-success" id="btnadd" name ="btnadd" value="Save"> 
				<button type="button" class="btn btn-danger" id="closebtn" name="closebtn" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
</form>







<main class="mdl-layout__content mdl-color--grey-100">
          	<?php
          	include_once("../classes/its_workstation.php");
          	include_once("../classes/connection.php");

          	?>
               <div class="panel panel-primary" >
                <div class="panel-heading" >uSER RECORD</div>
                <div class="panel-body">

                  <div class="row">
                    <button type="button" id ="editbtn" name ="editbtn" class="btn btn-success pull-right" onclick="FuncUser(0)" style="margin: 10px"><span class="glyphicon glyphicon-plus"></span>Add Record</button>   
                  </div>



                  <div class="table-responsive" style="overflow-x:scroll">
                  <table class="table table-bordered"  id="tblsampling" >
                  <thead>
                    <tr>
                      <th class="info">ID</th>
                    <th class="info">Name</th>
                      <th class="info">Company</th>
                      <th class="info">Department</th>
                      <th class="info">LastUpdated</th>
                      <th class="info">LastUpdatedBy</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $its_users = Its_Workstation::selectAllUser();

                  for($i=0;$i<count($its_users);$i++){
                    ?>
                    <tr>
                    <td >
                      <button type="button" class="btn btn-default" id="editbtn" style="background-color:#eba328; color: white;" onclick="FuncUser('<?php echo $its_users[$i]->getID(); ?>')" >Edit</button>  
                    
                    </td>
                    <td><?php echo $its_users[$i]->getDispatchTo(); ?></td>
                    <td><?php echo $its_users[$i]->getCompany(); ?></td>
                    <td><?php echo $its_users[$i]->getDepartment(); ?></td>
                    <td><?=$its_users[$i]->getLastUpdated();?></td>
                    <td><?php echo $its_users[$i]->getLastUpdatedBy(); ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
             </div>

            </div>
          </div>
          </div>


</main>

<script>


  function FuncUser(id){

    $("#usermodal").modal();
   
    if(id == 0 ){
      document.getElementById("btnupdate").setAttribute("hidden","");
      document.getElementById("btnadd").removeAttribute("hidden","")

    }
    else{
      document.getElementById("btnupdate").removeAttribute("hidden","")
      document.getElementById("btnadd").setAttribute("hidden","");
    
       var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
                document.getElementById("user").value = res[0];
                document.getElementById("company").value = res[1];
                document.getElementById("dept").value = res[2];
                document.getElementById("userid").value = res[3];
            
                
              }
            };
            xmlhttp.open("GET","../php/its_userrecordfetch.php?id="+id, true);
            xmlhttp.send();


          }
  
  }
  
  function SearchByFunc() {

  var input, filter, table, tr, td,td1, i;
  input = document.getElementById("SearchBy");
  filter = input.value.toUpperCase();
  table = document.getElementById("tblsampling");
  tr = table.getElementsByTagName("tr");


  for (i = 0; i < tr.length; i++) {

    td = tr[i].getElementsByTagName("td");

  if(td.length > 0){ // to avoid th

       if (td[0].innerHTML.toUpperCase().indexOf(filter) > -1 ) 
       {
         tr[i].style.display = "";
       } 

       else {
         tr[i].style.display = "none";
       }

    }
 }
}
</script>