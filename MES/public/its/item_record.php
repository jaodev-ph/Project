<?php 
include_once("../classes/its_workstation.php");
include_once("../classes/its_additem.php");
include_once("../classes/connection.php");
include_once("../classes/connection2.php");
include_once("../classes/its_brandmodel.php");

$mode = 0;


$lastupdatedby = $_SESSION['name'];


if(isset($_POST['addbtn'])){ 
  $its_add = new Its_Additem();

  var_dump($_POST['trackno']);
  $its_add->InsertItem($_POST['editpcserial'],
                  $_POST['trackno'],
                  $_POST['edititembrand'],
                  $_POST['edititemmodel'],
                  $_POST['itemdescription'],
                  $_POST['edititemtype'],
                  $_SESSION['name'],
                  $_POST['editserial']);
             echo "<script> window.location.replace('main.php?MenuCode=004&SubMenuCode=1') </script>" ;
  
}
if(isset($_POST['updatebtn'])){

  $descReturn = Its_Additem::getpcdetails($serial);
  $logRet = Its_Additem::log_item($_POST['editpcserial'],$_POST['editserial'],$descReturn,$_POST['optStatus'],$lastupdatedby);

  $recordUpdate = new Its_Additem();
  $recordUpdate->setPCSerial($_POST['editpcserial']);
  $recordUpdate->setSerial($_POST['editserial']);
  $recordUpdate->setTrackingNo($_POST['trackno']);
  $recordUpdate->setItemBrand($_POST['edititembrand']);
  $recordUpdate->setItemModel($_POST['edititemmodel']);
  $recordUpdate->setItemType($_POST['edititemtype']);
  $recordUpdate->setItemDesc($_POST['itemdescription']);
  $recordUpdate->setStatus($_POST['optStatus']);
  $recordUpdate->setLastUpdatedBy($lastupdatedby);
  $recordUpdate->updateItemRecord();



 
  $log = Its_Report::getLogs();





 
  
  echo "<script> window.location.replace('main.php?MenuCode=004&SubMenuCode=1') </script>" ;

}

?>

<style type="text/css">

#myTable {
  border-collapse: collapse; /* Collapse borders */
  width: 100%; /* Full-width */
  border: 1px solid #ddd; /* Add a grey border */
  font-size: 15px; /* Increase font-size */

}


#myTable tr.header, #myTable tr:hover {
  /* Add a grey background color to the table header and on hover */
  background-color: #f1f1f1;
}

table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

</style>

<!-- Modal -->
<form method="post">
	<div id="editModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id = "ht">Add Record</h4>
			</div>
		
			<div class="modal-body">
				<div class="row" >
					<div class="col-sm-3" id ="pc">
						<label>PC Name Serial</label>
						<input type="text" class="form-control" id="editpcserial" name="editpcserial" readonly  >
          </div>
          
          <div class="col-sm-3" id ="pc">
						<label>Serial</label>
						<input type="text" class="form-control" id="editserial" name="editserial"  >
          </div>
          
            <div class="col-sm-6">
            <label>Tracking No.</label>
            <input type="text" class="form-control"  id="trackno" name="trackno" readonly >
          </div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-6">
						<label>Item Type:</label>
						<select class="form-control"  id="edititemtype" name="edititemtype">
                      <option></option>
                      <?php
                        $itemType = its_brandmodel::getAllType();
                        for($i =0 ; $i < count($itemType); $i++){
                          ?>
                          <option value="<?=$itemType[$i]->getBrandType();?>"><?=$itemType[$i]->getBrandType();?></option>
                          <?php
                        }


                      ?>

            </select>
					</div>
					<div class="col-sm-6">
						<label>Item Brand:</label>
						<input type="text" class="form-control" id="edititembrand" name="edititembrand" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-6">
						<label>Item Model:</label>
						<input type="text" class="form-control" id="edititemmodel" name="edititemmodel" >
            <br>
         
            <label>Status</label>
                        <select class="form-control" name="optStatus" id="optStatus">
                          <option></option>
                          <option value="Deployed">Deployed</option>
                          <option value="In-Stock" >In-Stock</option>
                          <option value="For Repair">For Repair</option>
                          <option value="Decommision">Decommision</option>
                        </select>
        
					</div>
					<div class="col-sm-6">
						<label>Item Description:</label>
						<textarea class="form-control" id="itemdescription" name="itemdescription" placeholder="Enter Description" style="height: 115px"></textarea>
					</div>
				</div>
				<br>

				
				<br>

			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-success" id="updatebtn" name ="updatebtn" value="Update"> 
        <input type="submit" class="btn btn-success" id="addbtn" name ="addbtn" value="Save"> 
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
                <div class="panel-heading" >ITEM RECORD</div>
                <div class="panel-body">

       
                   
                <div class="row">
                  <form method ="get">
                  <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Type
                    </span>
                    <select name="filter" id="filter" class="form-control">
                      <option value="">All</option>
                      <?php 
                        $itemtype =  its_additem::allItemType();
                        for($i= 0; $i<count($itemtype);$i++){

                          ?><option value="<?=$itemtype[$i]->getItemType();?>"><?=$itemtype[$i]->getItemType();?></option><?php
                        }
                        ?>
                       
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <input type="text" id ="search" name="search" placeholder="Search" value="<?php if(isset($_GET['myInput'])){echo $_GET['myInput'];} ?>"  class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="btn" class="btn btn-default">Go</button>
                      <a href="?MenuCode=002&SubMenuCode=1" class="btn btn-info" value ="">View All</a>
                    </span>
                  </div>
                </div>

              </form>
              <button type="button" id ="editbtn" name ="editbtn" class="btn btn-success pull-right" onclick="funAddEdit(0)" style="margin: 10px"><span class="glyphicon glyphicon-plus"></span>Add Record</button>   
            </div>



                  <div class="table-responsive" style="overflow-x:scroll">
                    <table id="myTable" class="table table-striped table-hover" align="center">
                      <thead>
                      <tr class="info">
                           <th  style="color: black">Action</th>
                        <th  style="color: black" onclick="sortTable(0)">Tracking No.</th>
                        <th  style="color: black" onclick="sortTable(0)">PC Serial</th>
                        <th  style="color: black" onclick="sortTable(0)">Serial</th>
                        <th  style="color: black" onclick="sortTable(1)">Brand</th>
                        <th  style="color: black" onclick="sortTable(2)">Model</th>
                        <th  style="color: black" onclick="sortTable(4)">Description</th>
                        <th  style="color: black">Status</th>
                        <th  style="color: black" onclick="sortTable(3)">Type</th>
                     
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        
                        $its_additem2 = Its_Additem::Getitemrecords();
                        for($i=0;$i<count($its_additem2);$i++){
                        
                          $itemtype = (isset($_POST['filter']) && !empty($_POST['filter']) ? $_POST['filter'] : '');


                        ?>
                        <tr>
                        <td>
                        <button type="button" class="btn btn-default" id="editbtn" style="background-color:#eba328; color: white;" onclick="funAddEdit('<?php echo $its_additem2[$i]->getTrackingNo(); ?>') " >Edit</button>  
                        </td>
                        <td><?php echo $its_additem2[$i]->getTrackingNo(); ?>
                        <td><?php echo $its_additem2[$i]->getPCSerial(); ?>
                        <td><?php echo $its_additem2[$i]->getSerial(); ?>
                        <td><?php echo $its_additem2[$i]->getItemBrand(); ?></td>
                        <td><?php echo $its_additem2[$i]->getItemModel(); ?></td>  
                        <td><?php echo $its_additem2[$i]->getItemDesc(); ?></td>
                        <td><?php echo $its_additem2[$i]->getStatus(); ?></td>
                        <td><?php echo $its_additem2[$i]->getItemType(); ?></td>

                      </tr>

                    <?php } ?>
                  </tbody>
                </table>
             </div>

            </div>
          </div>
          </div>


</main>


  <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
	
		var tblcount = $('#tbldetails > tbody tr').length;

		function funAddEdit(value){
      if(value == 0){
              
        getTopID();

        $("#editModal").modal();
        clearAllFields();
        document.getElementById("addbtn").value = "Save";
        document.getElementById("updatebtn").value = "Update";
        document.getElementById("updatebtn").setAttribute("hidden","");
        document.getElementById("addbtn").removeAttribute("hidden","");

        document.getElementById("optStatus").setAttribute("disabled","");
        document.getElementById("optStatus").value = 'In-Stock';
        document.getElementById("ht").innerHTML = "Add Record";



      }
      else
      {
     
      $("#editModal").modal();
     
      document.getElementById("ht").innerHTML = "Edit Record";
       document.getElementById("addbtn").value = "Save";
       document.getElementById("updatebtn").value = "Update";
       document.getElementById("addbtn").setAttribute("hidden","");
       document.getElementById("updatebtn").removeAttribute("hidden","");
       document.getElementById("optStatus").removeAttribute("hidden","");

			  var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");

               document.getElementById('editpcserial').value = res[0];
               document.getElementById('trackno').value = res[7];
               document.getElementById('edititemtype').value = res[2];
               document.getElementById('edititembrand').value = res[3];
               document.getElementById('edititemmodel').value = res[4];
               document.getElementById('itemdescription').value =res[5];
               document.getElementById('optStatus').value =res[6];
               document.getElementById('editserial').value =res[1];
              
               if(res[6] == "Deployed"){
                $('#optStatus').append('<option value="Deployed" selected="selected">Deployed</option>');
                document.getElementById("optStatus").setAttribute("disabled","");
             
               
               }else{
                $("#optStatus option[value='Deployed']").remove();
                document.getElementById("optStatus").removeAttribute("disabled","");
               }
             
             
              }
            };
            xmlhttp.open("GET", "../php/its_itemrecordfetch.php?serial=" + value, true);
            xmlhttp.send();

		}
  }

  function getTopID(){
    var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
               document.getElementById('trackno').value = res[0];

              }
            };
            xmlhttp.open("GET", "../php/its_getitemcount.php", true);
            xmlhttp.send();

  }


 function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
function clearAllFields(){
               document.getElementById('editpcserial').value =  '';
               document.getElementById('trackno').value =  '';
               document.getElementById('edititemtype').value =  '';
               document.getElementById('edititembrand').value =  '';
               document.getElementById('edititemmodel').value =  '';
               document.getElementById('itemdescription').value = '';
               document.getElementById('optStatus').value = '';
}

</script>