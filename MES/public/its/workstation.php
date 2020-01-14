<?php 
include_once("../classes/its_workstation.php");
include_once("../classes/its_applications.php");
include_once("../classes/its_additem.php");
include_once("../classes/connection.php");
include_once("../classes/connection2.php");
include_once("../classes/its_brandmodel.php");
include_once("../classes/its_companydepartment.php");

$mode = 0;

$lastupdatedby = $_SESSION['name'];

if(isset($_POST['addbtn'])){ 
  $its_add = new Its_Workstation();
  $pcname = $_POST['pcname'];
  $its_add->insertWorkstation($pcname,
                  $_POST['ip'],
                  $_POST['mac'],
                  $_POST['cmbos'],
                  $_POST['license'],
                  $_POST['optDispatchedTo'],
                  $_POST['cmbcompall'],
                  $_POST['cmbdeptall'],
                  $_SESSION['name'],
                  $_POST['tag']);
             echo "<script> window.location.replace('main.php?MenuCode=002&SubMenuCode=1') </script>" ;
}
if(isset($_POST['updatebtn'])){
                  $recordUpdate = new Its_Workstation();
                  $recordUpdate->setPCname($_POST['pcname']);
                  $recordUpdate->setIPaddress($_POST['ip']);
                  $recordUpdate->setMACaddress($_POST['mac']);
                  $recordUpdate->setOperatingSystem($_POST['cmbos']);
                  $recordUpdate->setLicense($_POST['license']);
                  $recordUpdate->setDispatchTo($_POST['optDispatchedTo']);
                  $recordUpdate->setCompany($_POST['cmbcompall']);
                  $recordUpdate->setDepartment($_POST['cmbdeptall']);
                  $recordUpdate->setModel($_POST['model']);
                  $recordUpdate->setLastUpdatedBy($_SESSION['name']);
                  $recordUpdate->setTag($_POST['tag']);
                  $recordUpdate->updateWorkstation();
                  echo "<script> window.location.replace('main.php?MenuCode=002&SubMenuCode=1') </script>" ;
}

if(isset($_POST['addbtnsetup'])){
  $return = $_POST['returningitem'];
  $set = $_POST['settingitem'];
  $splitreturn = explode(",",$return);
  $splitset = explode("," ,$set);

  $idserial = $_POST['idserial'];
 if(count($splitreturn) > 0){// array start at 0
  if(isset($_POST['returningitem']) && !empty($_POST['returningitem'])){
  for($i = 0 ; $i < count($splitreturn); $i++){

    $updateitem = Its_Additem::returnitem($splitreturn[$i],$lastupdatedby);
    $itemserialreturn = $splitreturn[$i];
    $statusReturn = 'Returned';
    $descReturn = Its_Additem::getpcdetails($itemserialreturn);
    $logRet = Its_Additem::log_item($idserial,$itemserialreturn,$descReturn,$statusReturn,$lastupdatedby);
  }
}
  
}

if(count($splitset) >0){
  if(isset($_POST['settingitem']) && !empty($_POST['settingitem'])){
  for($j = 0 ; $j < count($splitset); $j++){
 
    $itemtobeset = Its_Additem::setitem($splitset[$j],$lastupdatedby,$idserial);
    $itemserial = $splitset[$j];
    $status = 'Deployed';

    $description = Its_Additem::getpcdetails($itemserial);
     $log = Its_Additem::log_item($idserial,$itemserial,$description,$status,$lastupdatedby);
  }
}
  
}   
if(isset($_POST['appstore'])){
  $apps = $_POST['appstore'];
  $pcserial = $_POST['idserial'];
  $update = Its_Additem::updateapp($apps,$lastupdatedby,$pcserial);
} 
var_dump($splitreturn);
var_dump($splitset);
echo "<script> window.location.replace('main.php?MenuCode=002&SubMenuCode=1') </script>" ;

}
?>

<style type="text/css">

#myTable {
  border-collapse: collapse; /* Collapse borders */
  width: 100%; /* Full-width */
  border: 1px solid #ddd; /* Add a grey border */
  font-size: 14px; /* Increase font-size */

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
<div id="setupModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id = "headermodal">SET-UP WORKSTATION</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <legend>
            <h4 id="idsetup" style="margin-left: 20px "></h4>
          </legend>

          <div class="col-md-6">
            <input type="text" name="idserial" id="idserial" hidden>
            <input type="text" name="returningitem" id="returningitem" hidden>
            <input type="text" name="settingitem" id="settingitem" hidden>
            <input type="text" name ="appstore" id="appstore" hidden>

             <label>ITEM TYPE</label>
             <select class="form-control" name="itemtype" id="itemtype">
              <option></option>
              <?php 
              $itemtype =  its_additem::allItemType();
              for($i= 0; $i<count($itemtype);$i++){

                ?><option value="<?=$itemtype[$i]->getItemType();?>"><?=$itemtype[$i]->getItemType();?></option><?php
              }
              ?>
            </select>

            <label>ITEM</label>
            <input type="text" name ="storeitem" id ="storeitem" hidden>
            <select class="form-control" name="cmbitems" id="cmbitems">
   
             

            </select>


            <div class="row pull-right" style="margin: 5px -15px 5px 5px;">
              <div class="col-md-12">
                <button type="button" id="btnitemadd" name="btnitemadd" class="btn btn-success">Add</button>

           
              </div>
            </div>
            <table id="tblitem" class="table table-striped table-hover" align="center" >
              <thead>
                <tr class="info">
                  <th  style="color: black" onclick="sortTable(1)">Serial</th>
                  <th  style="color: black" onclick="sortTable(1)">Type</th>
                  <th  style="color: black">Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>


          <div class="col-md-6">
            <label>APPLICATIONS :</label>
            <input type="text" name ="storeapp" id ="storeapp" hidden>
            <select class="form-control" name="cmbapps" id="cmbapps">
              <option></option>
              <?php
              $selectplan = Its_Applications::fetchApps();
              for($i=0; $i<count($selectplan); $i++){
                ?>
                <option value ="<?=$selectplan[$i]->getApps();?>"><?=$selectplan[$i]->getApps();?></option>
                <?php
              }  ?>

            </select>


            <div class="row pull-right" style="margin: 5px -15px 5px 5px;">
              <div class="col-md-12">
                <button type="button" id="btnappadd" name="btnappadd" class="btn btn-success">Add</button>

                <button type="button" id="clearapp" class="btn btn-danger">Clear</button>
              </div>
            </div>

            <table id="tblapp" class="table table-striped table-hover" align="center" >
              <thead>
                <tr class="info">
                  <th  style="color: black" onclick="sortTable(1)">Application</th>
                  <th  style="color: black">Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
       </div>    
        <br>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" id="addbtnsetup" name ="addbtnsetup" value="Save"> 
        <button type="button" class="btn btn-danger" id="closebtn" name="closebtn" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</form>

<form method="post">
  <!--add edit -->
  <div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id = "modalheader2" class="modal-title"  ></h4>
      </div>
      <div class="modal-body">  
          <div class="row">
              <div  id = "pcserial" class="col-md-12">
                <label  for="pcserial">PC Name/Serial:</label>
                <div class="row">        
                  <div class="col-sm-2">   
                    <select class="form-control" id="cmbcomp" name="cmbcomp" >
                      <option></option>
                      <option value="P5">P5</option>
                      <option value="P6">P6</option>
                      <option value="HQ">HQ</option>
                      <option value="HUB">HUB</option>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <select class="form-control" id="cmbdept" name="cmbdept" disabled> 
                      <option></option>
                      <option value="IT">IT</option>
                      <option value="FIN">FIN</option>
                      <option value="ACC">ACC</option>
                      <option value="DDG">DDG</option>
                      <option value="NPR">NPR</option>
                      <option value="WH">WH</option>
                      <option value="HR">HR</option>
                      <option value="FAC">FAC</option>
                      <option value="CORP">CORP</option>
                      <option value="CSS">CSS</option>
                      <option value="REC">REC</option>
                      <option value="MDB">MDB</option>
                      <option value="SCM">SCM</option>
                      <option value="ADMIN">ADMIN</option>
                    </select>
                  </div>
                   <div class="col-sm-2">
                    <select class="form-control" id="cmbtype" name="cmbtype" disabled>
                      <option></option>
                      <option value="WKS">WKS</option>
                      <option value="LPTP">LPTP</option>
                      <option value="SRVR">SRVR</option>
                    </select>
                  </div>
                 
                  <div class="col-md-6">
                    <input type="text" class="form-control"  id="pcname" name="pcname" readonly>
                  </div>

                 
                </div>
               </div>
             </div>
            <br>
            <br>
          <div class="row" >
          <div class="col-sm-6">
            <label>IP Address</label>
            <input type="text" class="form-control" id="ip" name="ip" maxlength="15" onkeypress="numberOnly(event)" placeholder="Enter IP Address" required >
          </div>
            <div class="col-sm-6">
            <label>MAC Address</label>
            <input type="text" class="form-control"  id="mac" name="mac" maxlength="17" onkeypress="numberOnly(event)" placeholder="Enter Mac Address" required >
          </div>
        </div>
        <br>
        <div class="row" >
            <div class="col-md-6">
                <label>Operating System</label>
                <select class="form-control" id="cmbos" name="cmbos">
                  <option></option>
                  <?php

                  $selectOS = Its_Workstation::selectAllOS();
                  for($i=0;$i<count($selectOS);$i++)
                  {
                    ?>
                    <option value="<?php echo $selectOS[$i]->getOperatingSystem(); ?>"><?php echo $selectOS[$i]->getOperatingSystem(); ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-sm-3">
            <label>Model</label>
            <input type="text" class="form-control"  id="model" name="model" placeholder="Enter License" required>
           </div>
            <div class="col-sm-3">
            <label>License</label>
            <input type="text" class="form-control"  id="license" name="license" placeholder="Enter License" required>
           </div>
        </div>
        <br>
          <div class="row" >
          <div class="col-sm-6">
            <label>Company:</label>
            <select  class="form-control" name="cmbcompall" id="cmbcompall">
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
          <div class="col-sm-6">
            <label>Department:</label>
            <select  class="form-control" id="cmbdeptall" name="cmbdeptall" >
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
      <div class="row">
                <div class="col-sm-6">
               <label>Dispatch To</label>
                          <select name="optDispatchedTo" id="optDispatchedTo" class="form-control" required>
                          <option></option>
                          <?php

                          $selectUser = Its_Workstation::selectAllUser();
                          for($i=0;$i<count($selectUser);$i++)
                          {
                            ?>
                            <option value="<?php echo $selectUser[$i]->getDispatchTo(); ?>"><?php echo $selectUser[$i]->getDispatchTo(); ?></option>
                          <?php } ?>
                        </select>
               </div>

                <div id="servicehide" class="col-md-6" >
                  <label>Service Tag</label>
                   <input type="text" class="form-control"  id="tag" name="tag" placeholder="Enter Service Tag">  
                </div>
      
              
          
       </div>
    
        
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
             <div class="panel-heading" >WORKSTATION</div>
               <div class="panel-body">

               
                <div class="row">
                  <form method ="get">
                  <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Type
                    </span>
                    <select name="filter" id="filter" class="form-control">
                      <option value="">All</option>

                        <option value="WKS">Workstation</option>
                        <option value="LPTP">Laptop</option>
                        <option value="SRVR">Server</option>
                       
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
              <button type="button" id ="editbtn" name ="editbtn" class="btn btn-success pull-right" onclick="funAddEdit(0)" style="margin: -10px 15px 10px 20px"><span class="glyphicon glyphicon-plus"></span>Add Workstation</button> 
            </div>
          <br>
                  <div class="table table-responsive" style="overflow-x:scroll">
                    <table id="myTable" class="table table-bordered table-hover" align="center" >
                      <thead>
                            <tr class="info">
                              <th  style="color: black" onclick="sortTable(0)">PC Serial</th>
                              <th  style="color: black" onclick="sortTable(0)">IP Address</th>
                              <th  style="color: black" onclick="sortTable(1)">MAC Address</th>
                              <th  style="color: black" onclick="sortTable(2)">Operating System</th>
                              <th  style="color: black" onclick="sortTable(4)">License</th>
                              <th  style="color: black" onclick="sortTable(4)">Model</th>
                              <th  style="color: black" onclick="sortTable(4)">Monitor</th>
                              <th  style="color: black" onclick="sortTable(4)">Processor</th>
                              <th  style="color: black" onclick="sortTable(4)">HDD</th>
                              <th  style="color: black" onclick="sortTable(4)">Company</th>
                              <th  style="color: black" onclick="sortTable(4)">Department</th>
                              <th  style="color: black" onclick="sortTable(4)">Dispatchto</th>
                              <th  style="color: black" onclick="sortTable(4)">Service Tag</th>
                              <th  style="color: black">Action</th>
                              <!-- <th  style="color: black" onclick="sortTable(4)">Status</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              //start of pagination
                          
                              if(isset($_GET['pageno'])){
                                $pageno = $_GET['pageno'];
                              }else{
                                $pageno = 1;
                              }
                              $filter = (isset($_GET['filter']) && !empty($_GET['filter'])? $_GET['filter'] : '');
                              $search = (isset($_GET['search'])  && !empty($_GET['search'])? $_GET['search'] : '');
                              $totalcount =  Its_Workstation::getTotalCount($filter);
                              $rowcount = 10;
                              $pagecount = ceil($totalcount/$rowcount);
                              $offset = (($pageno-1) *  $rowcount);
                          

                          
                                if($totalcount != 0){
                              
                                $workstation = Its_Workstation::getworkstation($offset,$rowcount,$filter,$search);
                                for($i=0;$i<count($workstation);$i++){
                                $getmonitor =its_additem::getMonitorByPc($workstation[$i]->getPCname());
                                $getprocessor =its_additem::getProcessorByPC($workstation[$i]->getPCname());
                                $gethdd =its_additem::getHdd($workstation[$i]->getPCname());
                                
                                
                               ?>
                            <tr>
                                
                                <td><?php echo $workstation[$i]->getPCname(); ?>
                                <td><?php echo $workstation[$i]->getIPaddress(); ?>
                                <td><?php echo $workstation[$i]->getMACaddress(); ?></td>
                                <td><?php echo $workstation[$i]->getOperatingSystem(); ?></td>  
                                <td><?php echo $workstation[$i]->getLicense(); ?></td>
                                <td><?php echo $workstation[$i]->getModel(); ?></td>
                                <td><?php echo $getmonitor[0]->getItemModel();?></td>
                                <td><?php echo $getprocessor[0]->getItemModel();?></td>
                                <td><?php echo $gethdd[0]->getItemModel();?></td>
                                <td><?php echo $workstation[$i]->getCompany(); ?></td>
                                <td><?php echo $workstation[$i]->getDepartment(); ?></td>
                                <td><?php echo $workstation[$i]->getDispatchTo(); ?></td>
                                <td><?php echo $workstation[$i]->getTag(); ?></td>
                               <!--  <td><?php echo $workstation[$i]->getStatus(); ?></td> -->

                         <td>
                            <div class="btn-group">
                             
                            <button type="button" class="btn btn-default" id="editbtn" style="background-color:#eba328; color: white;" onclick="funAddEdit('<?php echo $workstation[$i]->getPCname(); ?>') ">Edit</button>  
                            <button type="button" class="btn btn-default" id="editbtn" style="background-color:#1f90db; color: white;" onclick="funSetup('<?php echo $workstation[$i]->getPCname(); ?>') ">Set-Up</button>
                 
                            <button type="button" id="printbtn<?php echo $i; ?>" name="printbtn<?php echo $i; ?>"  class="btn btn-danger" onclick="print('<?php echo $workstation[$i]->getPCname(); ?>')">Print</button>  
                      
                        
                          </div>
                          </td>

                      </tr>

                    <?php 
                              }
                    } ?>

                  </tbody>
                </table>
             </div>
             <div class="row" style="text-align: center">
                    <div class="col-md-12">
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link"  href="?pageno=<?=$pageno-1?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>

                    <?php      
               
                      for($i= 1 ; $i< $pagecount+1 ; $i++){
                        ?>  
                          <li class="page-item"><a class="page-link" href="?filter=<?=(isset($_GET['filter']) ? $_GET['filter']: '');?>&search=<?=(isset($_GET['search']) ? $_GET['search']: '');?>&pageno=<?=$i?>"><?php echo $i?></a></li>
                        <?php
                      }
            
                    ?>

            
                                      
                    <li class="page-item">
                      <a class="page-link" href="?filter=<?=$_GET['filter']?>&search=<?=$_GET['search']?>&pageno=<?=$i?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>

                  
                  </ul>
          </div>


          </div>
        </div>
     </div>


     

</main>      


<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

    var itemreturn = []; // geetting the items going to return.
    var itemtoset = []; // getting the item to be set.


/*var tblcount = $('#tbldetails > tbody tr').length;*/
function funSetup(value){

    $("#setupModal").modal();
        document.getElementById("idsetup").innerHTML = "PC Serial: " + value;
        document.getElementById("idserial").value = value;
        $("#tblitem > tbody").children().remove(); //clearing the table items
        $("#tblapp > tbody").children().remove(); // clearing the table apps
        existingItem(value); //getting all the existing item
        existingApp(value); // getting all the existing app
  
   }


   function existingApp(value){

     var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;  

               var splitapp = result.split(",");
            
              
              for(a = 0; a < splitapp.length; a++ )
              {
                if(splitapp != ""){
                $('#tblapp').append("<tr id ='trapp"+a+"'><td>"+splitapp[a]+'</td>'+'<td><button type="button" onclick="removeapp('+a+')" type="button" class="btn btn-danger btn-sm">remove  </button></td>'+'</tr>')
              }
              }     
           }
       };
       xmlhttp.open("GET", "../php/its_fetchapplication.php?PCserial=" + value, true);
       xmlhttp.send();

   }

   function removeapp(row){
  
    $("#trapp"+row).remove();
 
   }

   function existingItem(value){
    itemreturn.length =0;
    itemtoset.length =0;
    var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;  
               var res = result.split("_");
               var exitem = [];

               
              for(a = 0; a < res.length-1; a++ )
              {
                var itemsplit = res[a].split(",");
                console.log(itemsplit);
              

                $('#tblitem').append("<tr id ='tritem"+itemsplit[0]+"'><td>"+itemsplit[0]+'</td>'+'<td>'+itemsplit[1]+'<td><button type="button" onclick="returnitem(\''+itemsplit[0]+'\')" type="button" class="btn btn-danger btn-sm">Return  </button></td>'+'</tr>')
                exitem.push(itemsplit[0]);
              }

              //getting the value of existing value in database.
              var contostring = exitem.toString();
              document.getElementById("exitem").value = contostring;
              
                
           }
       };
       xmlhttp.open("GET", "../php/its_fetchsetupvalue.php?PCserial=" + value, true);
       xmlhttp.send();

   }




   function returnitem(row){

    itemreturn.push(row);
    $("#tritem"+row).remove();

   }



    function print(test1){

       window.open('http://192.168.1.22:30/mes/print/its_print.php?pcname='+test1);
    }



  $(document).ready(function(){

      //this is for setup  save button

        $("#addbtnsetup").click(function(){

          document.getElementById("returningitem").value = itemreturn.toString();
          document.getElementById("settingitem").value = itemtoset.toString();

          var table = document.getElementById('tblapp');
            var setapp = [];
          for (var r = 1, n = table.rows.length; r < n; r++) {
          
            for (var c = 0, m = 1; c < m; c++) {

            var rowvalue = table.rows[r].cells[c].innerHTML;
            setapp.push(rowvalue);
          }
        }
        document.getElementById("appstore").value = setapp.toString();
      

    });



      //saving the value in setup

      $("#addbtn").click(function(){


        var table = document.getElementById('tblapp');
          var tempAccess = [];
          var displayarr = [];
         
         for (var r = 1, n = table.rows.length; r < n; r++) {
         
          for (var c = 0, m = 1; c < m; c++) {

           /* alert(table.rows[r].cells[c].innerHTML);*/
           var rowvalue = table.rows[r].cells[c].innerHTML;
           tempAccess[n] = rowvalue;
           displayarr .push(tempAccess[n]);
         }

       }



      });
      ///item type changing
      $("#itemtype").change(function(){

        document.getElementById("cmbitems").options.length =0;
         var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;
                var res = result.split("_");
               
                var x = document.getElementById("cmbitems");
                var option = document.createElement("option");
                option.text ='';
                x.add(option);

                for($i=0; $i < res.length -1; $i++){
                  var arrsplit = res[$i].split(":");
                  var x1 = document.getElementById("cmbitems");
                  var option1 = document.createElement("option");
                  option1.text = "Serial: "+arrsplit[0] + " Model: "+arrsplit[1] + " Brand: "+arrsplit[2];
                  option1.value = arrsplit[0];
                  x1.add(option1);
                }
              }
            };
            xmlhttp.open("GET", "../php/its_getItembyType.php?type="+document.getElementById("itemtype").value, true);
            xmlhttp.send();

      });



      $('#clearapp').click(function() {
        $("#tblapp > tbody").children().remove()
      });

      

      //for APPLICATIONS
    $('#btnappadd').click(function(){
      var value = $('#cmbapps').val();
      var bool = false;
      var b =0;
      if(value == "----Select----" || value ==""){
        alert("Please Select an item");
      }
      else{
        var table = document.getElementById('tblapp');
        for (var r = 1, n = table.rows.length; r < n; r++) {
          for (var c = 0, m = 1; c < m; c++) {

            if(value == $.trim(table.rows[r].cells[c].innerHTML))
            {
              bool = true;
              alert("Already exist in table!");
            }
          }
          b++;
        }

        if(bool == false)
        {
          $('#tblapp').append("<tr id ='trapp"+b+"'><td>"+value+'</td>'+'<td><button type="button" onclick="removeapp('+b+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+'</tr>')
        }

      }
    });

    //for items
    $('#btnitemadd').click(function(){
      var type = $('#itemtype').val();
      var value = $('#cmbitems').val(); 
      var bool = false;
      var b =0;
      if(value =="" || type==""){
        alert("Please Select an item");
      }
      else{
        var table = document.getElementById('tblitem');
        for (var r = 1, n = table.rows.length; r < n; r++) {
          for (var c = 0, m = 1; c < m; c++) {

            if(value == $.trim(table.rows[r].cells[c].innerHTML))
            {
              bool = true;
              alert("Already exist in table!");
            }
          }
          b++;
        }

        if(bool == false)
        {
          $('#tblitem').append("<tr id ='tritem"+b+"'><td>"+value+'</td>'+'<td>'+type+'</td><td><button type="button" onclick="removeitem('+b+',\''+value+'\')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+'</tr>')
          itemtoset.push(value); // getting the item to be setted to the pc

        }
      }
    });
  });

  

function removeitem(row,val){
    for($i = 0 ; $i < itemtoset.length; $i++){ // deleting the value of gloval array itemtoset
      if(val == itemtoset[$i]){
        itemtoset.splice($i, 1);
      }
    }
     $("#tritem"+row).remove();
  }

  function removeapp(row){
    $("#trapp"+row).remove();
  }



//edit add

    function funAddEdit(value){
      if(value == 0){
              
        $("#editModal").modal();
        clearAllFields();
        document.getElementById('modalheader2').innerHTML = "Add Record";
        document.getElementById("cmbcomp").removeAttribute("disabled","");
        document.getElementById("addbtn").value = "Save";
        document.getElementById("updatebtn").value = "Update";
        document.getElementById("updatebtn").setAttribute("hidden","");
        document.getElementById("addbtn").removeAttribute("hidden","");
        document.getElementById("pcserial").removeAttribute("hidden","");

      }
      else 
      {
      $("#editModal").modal();
      var lptp = value.match(/LPTP/g);
     
        

        if(lptp == "LPTP"){
          alert(srvr);
          document.getElementById('servicehide').removeAttribute("hidden","");
        }else {
         
          document.getElementById('servicehide').setAttribute("hidden","");
         }

    
    
          document.getElementById("pcname").value = value;
          document.getElementById('modalheader2').innerHTML = "Edit Record" +":<i> "+value +"</i>";
          document.getElementById("addbtn").setAttribute("hidden","");
          document.getElementById("updatebtn").removeAttribute("hidden","");
          document.getElementById('cmbcomp').setAttribute("disabled","");
          document.getElementById('cmbdept').setAttribute("disabled","");
          document.getElementById('cmbtype').setAttribute("disabled","");
          document.getElementById('cmbcomp').value ='';
          document.getElementById('cmbdept').value ='';
          document.getElementById('cmbtype').value ='';
          document.getElementById('pcserial').setAttribute('hidden',"");
          if(val == "WKS" || val == "SRVR"){
            document.getElementById('servicehide').setAttribute("hidden","");
          }else{
            document.getElementById('servicehide').removeAttribute("hidden","");
          }
      var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;  
               var res = result.split("_");
               document.getElementById('pcname').value = res[0];
               document.getElementById("ip").value = res[1];
               document.getElementById("mac").value = res[2];
               document.getElementById("cmbos").value = res[3];
               document.getElementById("license").value = res[4]; 
               document.getElementById("optDispatchedTo").value = res[6];
               document.getElementById("cmbcompall").value= res[7];
               document.getElementById("cmbdeptall").value =res[8];   
               document.getElementById("tag").value = res[11]; 
               document.getElementById("model").value = res[12]; 

                
           }
       };

       xmlhttp.open("GET", "../php/its_getworkstationUpdate.php?PCserial=" + value, true);
       xmlhttp.send();
    }
  }



 function numberOnly(evt){

        var ch = String.fromCharCode(evt.which);

        if(!(/[0-9 || .]/.test(ch)))
        {
          evt.preventDefault();
        }
      }



$(document).ready(function() {

  $('#cmbcomp').change(function(){

    document.getElementById('cmbdept').removeAttribute("disabled","");
     if(document.getElementById("cmbcomp").value != '' && document.getElementById("cmbdept").value != '' && document.getElementById("cmbtype").value != '')
    {
  
     var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;

               document.getElementById("pcname").value = document.getElementById("cmbcomp").value + document.getElementById("cmbdept").value+ document.getElementById("cmbtype").value + result;
              }
            };
            xmlhttp.open("GET", "../php/its_getworkstationcount.php?type="+document.getElementById("cmbtype").value+"&comp="+document.getElementById("cmbcomp").value, true);
            xmlhttp.send();
      }
  });

   $('#cmbdept').change(function(){
 
    document.getElementById('cmbtype').removeAttribute("disabled","");
     if(document.getElementById("cmbcomp").value != '' && document.getElementById("cmbdept").value != '' &&  document.getElementById("cmbtype").value != '')
    {
     var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;
               document.getElementById("pcname").value = document.getElementById("cmbcomp").value + document.getElementById("cmbdept").value+ document.getElementById("cmbtype").value + result;

              }
            };
            xmlhttp.open("GET", "../php/its_getworkstationcount.php?type="+document.getElementById("cmbtype").value+"&comp="+document.getElementById("cmbcomp").value, true);
            xmlhttp.send();
      }
  });

     $('#cmbtype').change(function(){
       var val = document.getElementById('cmbtype').value;
       if(val == "WKS" || val =="SRVR"){
        document.getElementById('servicehide').setAttribute("hidden","");
       }
       else{
        document.getElementById('servicehide').removeAttribute("hidden","");
       }
       document.getElementById('cmbtype').removeAttribute("disabled","");
   
    if(document.getElementById("cmbcomp").value != '' && document.getElementById("cmbdept").value != '')
    {
     var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;
               

               document.getElementById("pcname").value = document.getElementById("cmbcomp").value + document.getElementById("cmbdept").value+ document.getElementById("cmbtype").value + result;

              }
            };

            xmlhttp.open("GET", "../php/its_getworkstationcount.php?type="+document.getElementById("cmbtype").value+"&comp="+document.getElementById("cmbcomp").value, true);
            xmlhttp.send();
      }
  });
});

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
              document.getElementById("pcname").value = '';
               document.getElementById("ip").value = '';
               document.getElementById("mac").value = '';
               document.getElementById("cmbos").value = '';
               document.getElementById("license").value = '';   
               document.getElementById('cmbcompall').value = '';
               document.getElementById('optDispatchedTo').value = '';
               document.getElementById('cmbcompall').value = '';
               document.getElementById('cmbdeptall').value = '';
      
          
}

function buttonhide(){

}

</script>