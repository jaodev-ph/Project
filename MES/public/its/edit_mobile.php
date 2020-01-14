<?php 

include_once("../classes/its_workstation.php");
include_once("../classes/its_companydepartment.php");
include_once("../classes/its_additem.php");
include_once("../classes/its_mobile.php");
include_once("../classes/its_brandmodel.php");
include_once("../classes/connection.php");
include_once("../classes/connection2.php");



if(isset($_POST['updatebtn'])){

  $recordUpdate = new Its_Mobile();
  $recordUpdate->setIMEI($_POST['editserial']);
  $recordUpdate->setMobileNo($_POST['editno']);
  $recordUpdate->setMobileBrand($_POST['editbrand']);
  $recordUpdate->setMobileModel($_POST['editmodel']);
  $recordUpdate->setCompany($_POST['editcompany']);
  $recordUpdate->setDepartment($_POST['editdept']);
  $recordUpdate->setStatus($_POST['editstatus']);
  $recordUpdate->setPurpose($_POST['editpurpose']);
  $recordUpdate->setType($_POST['edittype']);
  $recordUpdate->setDispatchTo($_POST['editdispatch']);
  $recordUpdate->setSimSerial($_POST['editsim']);
  $recordUpdate->setMACadd($_POST['editMAC']);
  $recordUpdate->setAccessories($_POST['storeaccess']);
  $recordUpdate->setPlanInclu($_POST['storeplan']);
  $recordUpdate->setAccno($_POST['editAcc']);
  $recordUpdate->setPlan($_POST['editPlan']);
  $recordUpdate->setColor($_POST['editColor']);
  $recordUpdate->setLastUpdatedBy($_SESSION['name']);
  $recordUpdate->updateRecordMobile();
   echo "<script> window.location.replace('main.php?MenuCode=003&SubMenuCode=1') </script>" ;

}
 if(isset($_POST['addbtn'])){
  $its_add = new Its_Mobile();
  $its_add->addMobile($_POST['editserial'],
                  $_POST['editsim'],
                  $_POST['editMAC'],
                  $_POST['editbrand'],
                  $_POST['editmodel'],
                  $_POST['editAcc'],
                  $_POST['editcompany'],
                  $_POST['editdept'],
                  $_POST['editno'],
                  $_POST['storeaccess'],
                  $_POST['editColor'],
                  $_POST['editPlan'],
                  $_POST['storeplan'],
                  $_POST['editdispatch'],
                  $_POST['editpurpose'],
                  $_POST['edittype'],
                  $_POST['editstatus'],
                  $_SESSION['name']);

 echo "<script> window.location.replace('main.php?MenuCode=003&SubMenuCode=1') </script>" ;

}

$mode =1;
$limit =10;

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

<div id="editModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">

  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
     <div class="modal-header">
      <button type="button"  id="close-modal" class="close" data-dismiss="modal">&times;</button>

      <div class="primary"  >
      <h4 id ="modalhead" class="modal-title"></h4>
    </div>
    </div>


    <form method="post">
    
     <div class="modal-body">
      <div class="row">
       <div class="col-sm-3">
        <label>IMEI</label>
        <input type="hidden" class="form-control" name="serialhidden" id="serialhidden">
        <input type="text" class="form-control" name="editserial" id="editserial" readonly>
      </div>
      <div class="col-sm-3">
        <label>Sim Serial:</label>
        <input type="text" class="form-control" name="editsim" id="editsim">
      </div>

      <div class="col-sm-3">
        <label>MAC Address:</label>
        <input type="text" class="form-control" name="editMAC" id="editMAC">
      </div>
      <div class="col-sm-3">
        <label>Acc No:</label>
        <input type="text" class="form-control" name="editAcc" id="editAcc">
      </div>

    </div>


    <br>
    <div class="row">

     <div class="col-sm-3">
      <label>Type</label>
      <select class="form-control" name="edittype" id="edittype">
       <option></option>
       <option value="Mobile">Mobile</option>
       <option value="Tablet">Tablet</option>

     </select>
   </div>
   <div class="col-sm-4">
    <label id="brandlabel">brand:</label>
    <select class="form-control" name="editbrand" id="editbrand">
      
    </select>
  </div>

  <div class="col-sm-5">
    <label>Model:</label>
    <select class="form-control" name="editmodel" id="editmodel">
   
    </select>
  </div>
</div>
<br>

<div class="row">
 <div class="col-sm-6">
  <label>Company:</label>
  <select  class="form-control" name="editcompany" id="editcompany">
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
  <select  class="form-control" name="editdept" id="editdept">
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
  <label>Contact No.:</label>
  <input type="text" class="form-control" name="editno" id="editno" >
</div>

 <div class="col-sm-3">
  <label>Plan:</label>
  <input type="text" class="form-control" name="editPlan" id="editPlan" >
</div>

 <div class="col-sm-3">
  <label>Color:</label>
  <input type="text" class="form-control" name="editColor" id="editColor" >
</div>



</div>
<br>




<div class="row">

  <div class="col-md-4">
  <label>Dispatch To</label>
  <select class="form-control" name="editdispatch" id="editdispatch">
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

  <div class="col-sm-5">
    <label>Purpose:</label>
    <input type="text" class="form-control" name="editpurpose" id="editpurpose">
  </div>
  <div class="col-sm-3">
    <label>Status</label>
    <select class="form-control" name="editstatus" id="editstatus">
     <option></option>
     <option value="Deployed">Deployed</option>
     <option value="In-Stock">In-Stock</option>
     <option value="For Repair">For Repair</option>
    <option value="Decommision">Decommision</option>
   </select>
 </div>
</div>
<br>


<div class="row">

 
  <div class="col-md-5">
    <label>Accessories :</label>
    <input type="text" name ="storeaccess" id ="storeaccess" hidden>
    <select class="form-control" name="editAccess" id="editAccess">
      <option>----Select----</option>
      <?php
        $selectaccess = Its_CompDept::getAllaccessories();
        for($i=0; $i<count($selectaccess); $i++){
          ?>
          <option value ="<?=$selectaccess[$i]->getAccsessories();?>"><?=$selectaccess[$i]->getAccsessories();?></option>
          <?php
        }  ?>
    </select>


   
    <div class="row pull-right" style="margin: 5px -15px 5px 5px;">
      <div class="col-md-12">
        <button type="button" id="btnAddAcc" name="btnAddAcc" class="btn btn-success">Add</button>

        <button type="button" id="clearacc" class="btn btn-danger">Clear</button>
      </div>
    </div>

    <table id="tblAccessories" class="table table-striped table-hover" >
      <thead>
        <tr class="info">
          <th  style="color: black" onclick="sortTable(1)">Accesories</th>
          <th  style="color: black">Action</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>

  <div class="col-md-7">
    <label>Pan Inclussion :</label>
     <input type="text" name ="storeplan" id ="storeplan" hidden>
    <select class="form-control" name="editPlanInclu" id="editPlanInclu">
      <option>----Select----</option>
       <?php
        $selectplan = Its_CompDept::getAllPlan_Inclusion();
        for($i=0; $i<count($selectplan); $i++){
          ?>
          <option value ="<?=$selectplan[$i]->getPlan_inclu();?>"><?=$selectplan[$i]->getPlan_inclu();?></option>
          <?php
        }  ?>

    </select>
  

    <div class="row pull-right" style="margin: 5px -15px 5px 5px;">
      <div class="col-md-12">
        <button type="button" id="btnAddPlan" name="btnAddPlan" class="btn btn-success">Add</button>

        <button type="button" id="clearplan" class="btn btn-danger">Clear</button>
      </div>
    </div>

    <table id="tblplanInclu" class="table table-striped table-hover" align="center" >
      <thead>
        <tr class="info">
          <th  style="color: black" onclick="sortTable(1)">Plan Inclusion</th>
          <th  style="color: black">Action</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

</div>
<div class="modal-footer">
 

  <input type="submit" class="btn btn-success" id="updatebtn" name ="updatebtn" value="Update"> 
  <input type="submit" class="btn btn-success" id="addbtn" name ="addbtn" value="Save"> 
  <button type="button" class="btn btn-danger" id="closebtn" name="closebtn" data-dismiss="modal">Close</button>
</div>
</div>
</form>
</div>
</div>

<main class="mdl-layout__content mdl-color--grey-100">
  <?php
  include_once("../classes/its_workstation.php");
  include_once("../classes/connection.php");
  ?>
  <div class="panel panel-primary" >
    <div class="panel-heading" >MOBILE</div>
    <div class="panel-body">
      <br />

      <div class="form-group" >
       <div class="row">  
         <form method="get">
           <div class="col-md-3">
             <div class="input-group">
              <span class="input-group-addon">Company
              </span>
              <select name="filter" id="filter" class="form-control">
                <option value="">All</option>
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

          <div class="col-md-3">
            <div class="input-group">
              <input type="text" id ="myInput" name="myInput" placeholder="Search" value="<?php if(isset($_GET['myInput'])){echo $_GET['myInput'];} ?>"  class="form-control">
              <span class="input-group-btn">
                <button type="submit" name="btn" class="btn btn-default">Go</button>
                <a href="?" class="btn btn-info" value ="">View All</a>
              </span>
            </div>
          </div>
          <button type="button" id ="BtnAddMobile" name ="BtnAddMobile" class="btn btn-success pull-right" onclick="test(0)" style="margin-right: 15px"><span class="glyphicon glyphicon-plus"></span>Add Record</button>
        </form>
      </div>
    </div>



      <div class="table-responsive" style="overflow-x:scroll">
        <table class="table table-bordered"  id="myTable" name ="myTable">
         <thead>
          <tr class="info">
            <th class="text-center" style="color: black">Action</th>
            <th class="text-center" style="color: black" onclick="sortTable(0)">IMEI</th>
            <th class="text-center" style="color: black" onclick="sortTable(1)">Sim Serial</th>
            <th class="text-center" style="color: black" onclick="sortTable(2)">Mac Address</th>
            <th class="text-center" style="color: black" onclick="sortTable(3)">Brand</th>  
            <th class="text-center" style="color: black" onclick="sortTable(4)">Model</th>
            <th class="text-center" style="color: black" onclick="sortTable(5)">Accno</th>
            <th class="text-center" style="color: black" onclick="sortTable(6)">Company</th>
            <th class="text-center" style="color: black" onclick="sortTable(7)">Department</th>
            <th class="text-center" style="color: black" onclick="sortTable(8)">Plan</th>
            <th class="text-center" style="color: black" onclick="sortTable(9)">Color</th>
            <th class="text-center" style="color: black" onclick="sortTable(10)">Dispatch to</th>
            <th class="text-center" style="color: black" onclick="sortTable(11)">Status</th>
            <th class="text-center" style="color: black" onclick="sortTable(12)">Type</th>
            <th class="text-center" style="color: black" onclick="sortTable(13)">Last Update</th>
          </tr>
        </thead>
      </thead>
      <tbody>
        <?php
        include_once("../classes/its_mobile.php");


                   $its_pcitem2 = Its_Mobile::getAllMobileRecords();
                   if(count($its_pcitem2)>10){
                                $pageno = 1;
                                $totalpage = ceil(count($its_pcitem2)/10);
                                 $search = (isset($_GET['myInput']) || !empty($_GET['myInput']) ? $_GET['myInput'] : '' );
                                 $filter = (isset($_GET['filter']) || !empty($_GET['filter']) ? $_GET['filter'] : '');

                                if(isset($_GET['pageno'])){
                                  $pageno = $_GET['pageno'];
                                }
  

                                if($pageno>1){
                                  $pageprev = $pageno-1;
                                }else{
                                  $pageprev = 0;
                                }

                                if($pageno<$totalpage){
                                  $pagenext = $pageno + 1;
                                }else{
                                  $pagenext = 0;
                                }

                              if(!empty($filter)){
                                 $its_pcitem2 = Its_Mobile::getAllMobileRecords("dbo.its_mobile_paginationByCompany $pageno, 10, '$search','$filter'");
                              }
                              else
                              {
                                $its_pcitem2 = Its_Mobile::getAllMobileRecords("dbo.its_mobile_pagination $pageno, 10, '$search'");
                              }


                              }else{
                                $pageprev = 0;
                                $pagenext = 0;
                                $totalpage = 0;
                              }

         

        for($i=0;$i<count($its_pcitem2);$i++){
          ?>
          <tr>
             <td>
             <button type="button" class="btn btn-default" id="editbtn" onclick="test('<?php echo $its_pcitem2[$i]->getIMEI(); ?>')" style="background-color:#eba328; color: white;" >Edit</button>
             <!--     <button type="button" id="deletebtn<?php echo $i; ?>" name="deletebtn<?php echo $i; ?>" class="optApps btn btn-danger">Delete</button> -->
           </td>
            <td><?php echo $its_pcitem2[$i]->getIMEI(); ?>
            <input type="text" id= "serialhidden<?php echo $i; ?>" name="serialhidden<?php echo $i; ?>" value="<?php echo $its_pcitem2[$i]->getIMEI(); ?>" hidden></td>
            <td><?php echo $its_pcitem2[$i]->getSimSerial(); ?></td>   
            <td><?php echo $its_pcitem2[$i]->getMACadd(); ?></td>    
            <td><?php echo $its_pcitem2[$i]->getMobileBrand(); ?></td>
            <td><?php echo $its_pcitem2[$i]->getMobileModel(); ?></td>
            <td><?php echo $its_pcitem2[$i]->getAccno(); ?></td>
            <td><?php echo $its_pcitem2[$i]->getCompany(); ?></td>
            <td><?php echo $its_pcitem2[$i]->getDepartment(); ?></td>
            <td><?php echo $its_pcitem2[$i]->getPlan(); ?></td>
            <td><?php echo $its_pcitem2[$i]->getColor(); ?></td>
            <td><?php echo $its_pcitem2[$i]->getDispatchTo(); ?></td>
            <td><?php echo $its_pcitem2[$i]->getStatus(); ?></td>
            <td><?php echo $its_pcitem2[$i]->getTypes(); ?></td>
            <td><?=$its_pcitem2[$i]->getLastUpdated();?></td>
         </tr>
       <?php } ?>
     </tbody>
   </table>
 </div>
</div>   
<div class="row">
  <div class="col-md-12">
    <ul class="pager">
      <?php               
      if($pageprev!=0){
        if(isset($_GET['filter'])){
          echo '<li><a href="?pageno='.$pageprev.'&filter='.$_GET['filter'].'&search='.$_GET['search'].'" class="pull-left text-info"><span class="glyphicon glyphicon-chevron-left"></span> Previous</a>';
        }else
        echo '<li><a href="?pageno='.$pageprev.'" class="pull-left text-info"><span class="glyphicon glyphicon-chevron-left"></span> Previous</a>';
      }else{
        echo '<li class="disabled"><a href="#prev" class="pull-left text-info"><span class="glyphicon glyphicon-chevron-left"></span> Previous</a>';
        
      }

      if($totalpage>1)
        echo '<li>Page '.$pageno.' out of '.$totalpage.' </li>';

      if($pagenext!=0){
        if(isset($_GET['filter'])){
          echo '<li><a href="?pageno='.$pagenext.'&filter='.$_GET['filter'].'&search='.isset($_GET['search']).'" class="pull-right text-info" >Next <span class="glyphicon glyphicon-chevron-right"></span></a>';
        }else
        echo '<li><a href="?pageno='.$pagenext.'" class="pull-right text-info" >Next <span class="glyphicon glyphicon-chevron-right"></span></a>';
      }else{
        echo '<li class="disabled"><a href="#prev" class="pull-right text-info">Next <span class="glyphicon glyphicon-chevron-right"></span></a>';

      }
      ?>
    </ul>
  </div>
</div> 

</div>

</main>



<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script>

  $(document).ready(function(){
    $("#close-modal").click(function(){
     $('#editModal').on('hidden.bs.modal', function (e) {
      $(this)
      .find("input,textarea,select,table")
      .val('')
      .end()
      
      .find("input[type=checkbox], input[type=radio]")
      .prop("checked", "")
      
    })
   });


    $("#updatebtn").click(function(){

     var table = document.getElementById('tblAccessories');
     var tempAccess = [n];
     var displayarr = [];
     
     for (var r = 1, n = table.rows.length; r < n; r++) {
       
      for (var c = 0, m = 1; c < m; c++) {

       /* alert(table.rows[r].cells[c].innerHTML);*/
       var rowvalue = table.rows[r].cells[c].innerHTML;
       tempAccess[n] = rowvalue;
       displayarr .push(tempAccess[n]);
     }

   }
   var strarr = displayarr.toString();
   document.getElementById("storeaccess").value = strarr;
   console.log(strarr);


   var tableplan = document.getElementById('tblplanInclu');
   var tempPlan = [n];
   var displayarrPlan = [];
   
   for (var r = 1, n = tableplan.rows.length; r < n; r++) {
     
    for (var c = 0, m = 1; c < m; c++) {

     /* alert(table.rows[r].cells[c].innerHTML);*/
     var rowvalue = tableplan.rows[r].cells[c].innerHTML;
     tempPlan[n] = rowvalue;
     displayarrPlan.push(tempPlan[n]);
   }

 }
 var strarrPlan = displayarrPlan.toString();
 document.getElementById("storeplan").value = strarrPlan;
 console.log(strarrPlan);

});

        /// for sumitting form

        var tblcount1 = $('#tblAccessories > tbody tr').length;
        $('#clearacc').click(function() {
          $("#tblAccessories > tbody").children().remove()
        });

        $('#clearplan').click(function() {
          $("#tblplanInclu > tbody").children().remove()
        });






        $('#btnAddAcc').click(function() {

          var value = $('#editAccess').val();
          var bool = false;
          var a =0;

          if(value =="----Select----" || value =="")
          {
           alert("Please Select an Item");

         }
         else
         {
          var table = document.getElementById('tblAccessories');
          for (var r = 1, n = table.rows.length; r < n; r++) {
            
            for (var c = 0, m = 1; c < m; c++) {

             /* alert(table.rows[r].cells[c].innerHTML);*/
             var rowvalue = table.rows[r].cells[c].innerHTML;
             if(rowvalue== value)
             {
              bool = true;
              alert("Already exist in table!");

            }
          }
          a++;
        }

        if(bool == false){
          $('#tblAccessories').append("<tr id ='tritem"+a+"'><td>"+value+'</td>'+'<td><button type="button" onclick="removeAccessories('+a+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+'</tr>')
        }

      }
    });

        $('#btnAddPlan').click(function(){
          var value = $('#editPlanInclu').val();
          var bool = false;
          var b =0;
          if(value == "----Select----" || value ==""){
            alert("Please Select an item");
          }
          else{
            var table = document.getElementById('tblplanInclu');
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
              $('#tblplanInclu').append("<tr id ='trplan"+b+"'><td>"+value+'</td>'+'<td><button type="button" onclick="removePlanInclusion('+b+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+'</tr>')
            }

          }
        });

      });

  function removeAccessories(row){
    $("#tritem"+row).remove();
    tblAccessories = $('#tblAccessories > tbody tr').length;
  }
  function removePlanInclusion(row){
    $("#trplan" +row).remove();
    tblplanInclu = $('#tblplanInclu > tbody tr').length;

  }


  function test(test1){
   
   if(test1 == 0)
   {
    //this is for adding modal
    $("#editModal").modal();
    document.getElementById('editserial').readOnly = false;
    document.getElementById("editserial").value = "";
    document.getElementById('modalhead').innerHTML = "Add Record";
    document.getElementById("editmodel").options.length =0;
    document.getElementById("addbtn").value = "Save";
    document.getElementById("updatebtn").value = "Update";
    document.getElementById("updatebtn").setAttribute("hidden","");
    document.getElementById("addbtn").removeAttribute("hidden","");

  }
  else
  {
   document.getElementById('editserial').readOnly = true;
   document.getElementById('modalhead').innerHTML = "Edit Record";
   document.getElementById("addbtn").value = "Save";
   document.getElementById("updatebtn").value = "Update";
   document.getElementById("addbtn").setAttribute("hidden","");
   document.getElementById("updatebtn").removeAttribute("hidden","");


 }
 
 if(test1 !=0)
 {
   document.getElementById("editserial").value = test1;
 }
 $("#editModal").modal();


 $("#tblAccessories > tbody").children().remove();
 $("#tblplanInclu > tbody").children().remove();
 var xmlhttp = new XMLHttpRequest();
 xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
   var result = this.responseText;
   var res = result.split("_");
   document.getElementById("serialhidden").value = res[0];
   document.getElementById("edittype").value = res[1];
   document.getElementById("editsim").value = res[2];
   document.getElementById("editno").value = res[5];
   document.getElementById("editMAC").value = res[6];
   document.getElementById("editdispatch").value = res[7];
   document.getElementById("editcompany").value = res[8];
   document.getElementById("editdept").value = res[9];
   document.getElementById("editpurpose").value = res[10];
   document.getElementById("editstatus").value = res[11];
   document.getElementById("editAcc").value = res[12];
   document.getElementById("editColor").value = res[13];
   document.getElementById("editPlan").value =res[14];

        getSelectedValueBrand(res[3]); //getting the last value
        getSelectedModel(res[3],res[4],res[1]);
        if(test1 != 0 || test1 != ""){
          var access = res[15].split(",")
          var plan_inclu = res[16].split(",")
        }
        console.log(access);
        console.log(plan_inclu);



        
        for(a =0; a< access.length; a++ )
        {
          $('#tblAccessories').append("<tr id ='tritem"+a+"'><td>"+access[a]+'</td>'+'<td><button type="button" onclick="removeAccessories('+a+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+'</tr>')
        }

        for(b =0; b< plan_inclu.length; b++ )
        {
         $('#tblplanInclu').append("<tr id ='trplan"+b+"'><td>"+plan_inclu[b]+'</td>'+'<td><button type="button" onclick="removePlanInclusion('+b+')" type="button" class="btn btn-danger btn-sm">Remove</button></td>'+'</tr>')
       }
       
     }
   };

   xmlhttp.open("GET", "../php/its_fetchmobilemodal.php?IMEI=" + test1, true);
   xmlhttp.send();


 }




 $("#edittype").change(function(){
   ajax2();
   document.getElementById("editbrand").value = '';
   document.getElementById("editmodel").value ='';
   
 });


 $("#editbrand").change(function(){
  var xmlhttp = new XMLHttpRequest();

  document.getElementById("editmodel").options.length =0;
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     var result = this.responseText;
                    //alert(result);
                    var res = result.split("_");
                    var x1 = document.getElementById("editmodel");
                    var option1 = document.createElement("option");
                    option1.text = '';
                    x1.add(option1);
                    for (i = 0; i < res.length - 1; i++) { 

                      var x = document.getElementById("editmodel");
                      var option = document.createElement("option");
                      option.text = res[i];
                      x.add(option); 
                    }
                  }
                };

                xmlhttp.open("GET", "../php/its_getmobilemodel.php?brand="+ document.getElementById("editbrand").value+"&MobileType="+document.getElementById("edittype").value, true);
                xmlhttp.send();

              });


 function ajax2(){
   
  var xmlhttp = new XMLHttpRequest();
  document.getElementById("editbrand").options.length =0;
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     var result = this.responseText;
                    //alert(result);
                    var res = result.split("_");
                    var x1 = document.getElementById("editbrand");
                    var option1 = document.createElement("option");
                    option1.text = '';
                    x1.add(option1);
                    for (i = 0; i < res.length - 1; i++) { 

                      var x = document.getElementById("editbrand");
                      var option = document.createElement("option");
                      option.text = res[i];
                      option.value = res[i];
                      x.add(option); 
                    }
                  }
                };

                xmlhttp.open("GET", "../php/its_getmobiletype.php?type="+ document.getElementById("edittype").value, true);
                xmlhttp.send();
                
              }


              function getSelectedModel(brandval,modelval,typeval){

               var xmlhttp = new XMLHttpRequest();
               document.getElementById("editmodel").options.length =0;
               xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                 var result = this.responseText;
                                    //alert(result);
                                    var res = result.split("_");
                                    var x1 = document.getElementById("editmodel");
                                    var option1 = document.createElement("option");
                                    option1.text = '';
                                    x1.add(option1);
                                    
                                    for (i = 0; i < res.length - 1; i++) { 

                                      var SELECT = document.createElement("select"); //creating an element select
                                      var option2 = document.createElement("option");
                                      
                                      option2.text = res[i];
                                      option2.value = res[i];
                                      if(modelval == res[i]){
                                        option2.setAttribute('selected', 'selected');
                                        SELECT.appendChild(option2); 
                                        x1.appendChild(SELECT);
                                      }
                                      x1.add(option2);
                                      
                                      
                                    }
                                  }
                                };

                                xmlhttp.open("GET", "../php/its_getmobilemodel.php?brand="+brandval+"&MobileType="+typeval, true);
                                xmlhttp.send();
                              }



                              function getSelectedValueBrand(selectedval){
                               
                                var xmlhttp = new XMLHttpRequest();
                                document.getElementById("editbrand").options.length =0;
                                xmlhttp.onreadystatechange = function() {
                                  if (this.readyState == 4 && this.status == 200) {
                                   var result = this.responseText;
                    //alert(result);
                    var res = result.split("_");

                    
                    var x1 = document.getElementById("editbrand");//calling the dropdown
                    var option1 = document.createElement("option");//creating an element 
                    option1.text = '';
                    x1.add(option1); // adding a option blank
                    for (i = 0; i < res.length - 1; i++) { 
                      
                    var SELECT = document.createElement("select"); //creating an element select
                    var option2 = document.createElement("option");
                    
                    option2.text = res[i];
                    option2.value = res[i];

                    if(selectedval == res[i]){
                      option2.setAttribute('selected', 'selected');
                      SELECT.appendChild(option2); 
                      x1.appendChild(SELECT);
                    }
                    x1.add(option2);
                    

                  }

                }
              };

              xmlhttp.open("GET", "../php/its_getmobiletype.php?type="+ document.getElementById("edittype").value, true);
              xmlhttp.send();
              
            }






            function sortTable(n) {
              var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
              table = document.getElementById("myTable");
              switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

</script>