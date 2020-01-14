<?php

include_once("../classes/its_workstation.php");
include_once("../classes/its_brandmodel.php");
include_once("../classes/connection.php");
include_once("../classes/connection2.php");


$disabled = 'disabled';
$readonly = 'readonly';
$id='';
$brand='';
$model='';
$type='';

$mode = 0;
$preventer = 0;
$category = 0;
$errorflag = 0;

if(isset($_GET['id'])){
  //getting the value when click the id number.
  $mode = 1;
  $id = $_GET['id'];
  $brandid = Its_BrandModel::selectAllBrandModel1($id);
  $brand = $brandid[0]->getBrand();
  $model = $brandid[0]->getModel();
  $type = $brandid[0]->getBrandType();
}

if(isset($_POST['btnSave']))
{

    $brand = $_POST['cmbBrand'];
    $type = $_POST['stextype'];
    $name = $_SESSION['name'];
    $model = $_POST['stextmodel'];
   
    if(empty($_GET['id'])){
      $mode=0; 
      // this is for adding model only...
      if(Its_BrandModel::validateBrandType($brand,$type) == true)
      {   
         $preventer =1; // successfully added a model
         $brandtypeID = Its_BrandModel::getBrandTypeID($brand,$type);
         if(Its_BrandModel::validateModel($model,$brandtypeID) == false){
          //getting the existing Brand and type
          $add = new its_BrandModel();
          $add->setLastupdatedBy($name);
          $add->addModel($brandtypeID,$model);
         }
         else{
          $errorflag = 1; // the model is already exist in database...
         }
       
       }
      else{
         $category = 0; // successfully added a new model and brand.
         $add = new its_BrandModel();
         $add->addBrand($brand,$type,$name);
         $getTopId = its_BrandModel::selectTopId();
         $add->addModel($getTopId,$model);
      }  
  }else{

      $mode = 1;
      $id = $_GET['id'];
      $update = new Its_BrandModel();
      if(Its_BrandModel::validateBrandType($brand,$type) == true)
      {
        $preventer = 1 ; // successfull updated the model
        // when exist the brand and type it will fetch
        $brandtypeID = Its_BrandModel::getBrandTypeID($brand,$type);
        $update->UpdateModel($id,$brandtypeID,$model,$name);
        $brand='';
        $model='';
        $type='';
      }
      else{
        //when there's no exisiting brand and type
        $preventer = 1;
        $category = 1;
         $update->addBrand($brand,$type,$name);
         //use to get the top id so we can insert it to the updated model
         $getTopId = its_BrandModel::selectTopId();
         $update->UpdateModel($id,$getTopId,$model,$name);
         $brand='';
         $model='';
         $type='';
      }
   

  }
}

?>

<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
			<div class="mdl-cell--top mdl-cell--4-col mdl-cell--4-col-desktop">


         <?php if ($mode ==0 || $mode ==1){
            if($preventer ==1 && $errorflag ==0){
          ?>

           <div class="alert alert-success alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Success!</strong>  <?=($mode ==0 ? 'Added' : 'Updated ');?> <!-- <?=($category == 0 && $mode == 0) ? 'a new model and brand' : 'a new brand';?> -->
            </div>
         <?php 
       }
        if ($errorflag == 1)
       {
        ?>
         <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Error!</strong> It already exist !
                </div>
        <?php
       }
       }
       ?>


        <form id="itemform"  method="post">
          <div class="container-fluid">
           <div id ="errorAlert" class="alert alert-danger alert-dismissible" role="alert" hidden>
            <button id="errorclose" type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Error!</strong> All field are required!
          </div>
          <div id="successAlert" class="alert alert-success alert-success" role="alert" style="margin-top:15px;" hidden>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Success!</strong> <?=($mode ==0 ? 'Success Added' : 'Success Update')?>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="stextid" name="stextid" value="<?php echo $id; ?>" <?php echo $readonly; ?> hidden>
          </div>


         <div class="form-group">
            <label for="pwd">Brand</label>
            <select class="form-control" name="cmbBrand" id="cmbBrand">
            <option></option>
      
              <?php
              $selectModel = Its_BrandModel::selectBrand();
              for($i=0;$i<count($selectModel);$i++)
              {
                ?>
                <option value="<?=$selectModel[$i]->getBrand();?>" <?php if($selectModel[$i]->getBrand() == $brand):  
                $selectModel[$i]->getBrand() ?> selected="selected" <?php endif;?>><?=$selectModel[$i]->getBrand();?>
                  
                </option>
              <?php } ?>
            </select> 

          </div>

          <div class="form-group">
            <label for="pwd">Model</label>
            <input type="text" class="form-control" id="stextmodel" name="stextmodel" value="<?php echo $model; ?>" required="required"/>
          </div>


          <div class="form-group">
            <label for="pwd">Type</label>
            <input type="text" class="form-control"  id ="stextype" name="stextype" list="stextypelist" value="<?php echo $type;?>" required="required"/>

            <datalist id="stextypelist">
              <?php
              $selectModel = Its_BrandModel::selectType();
              for($i=0;$i<count($selectModel);$i++)
              {
                ?>
                <option value="<?=$selectModel[$i]->getBrandType(); ?>"><?=$selectModel[$i]->getBrandType();?></option>
              <?php } ?>
            </datalist>

          </div>




          <input type="hidden" class="form-control" id="mode" name="mode" value="<?php echo $mode; ?>" <?php echo $readonly;?> >

          <br>
          <br>
          <div class="form-group" align = "right">
            <button type="submit"  id="btnSave" name="btnSave" class="btn btn-success btn-lg"><?=($mode ==0 ? 'Save' : 'Update')?></button>
            <a id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" href="?MenuCode=007&SubMenuCode=1">Cancel</a> 

          </div>
        </div>
      </form>
   </div>
      <div class="mdl-cell--top mdl-cell--8-col mdl-cell--8-col-desktop">


      
      <div class="panel panel-primary" >

        <div class="panel-heading" >ITEM DETAILS</div>
        <div class="panel-body">
           <div class="form-group" >

        <label for="pwd" id="label-search">Search</label>
        <div class="search">
          <span class="fa fa-search"></span> 
          <input type="text" class="form-control pull-center" id="SearchBy" name="SearchBy" value="" onkeyup="SearchByFunc()" placeholder="Search..." >
        </div>
      </div>
          <div class="table-responsive" style="overflow-x: scroll;height:400px;">
            <table class="table table-bordered"  id="tblsampling" >
              <thead>
                <tr>
                 <th class="info">ID</th>
                 <th class="info">Brand</th>
                 <th class="info">Model</th>
                 <th class="info">Type</th>
                 <th class="info">Lastupdate</th>
                 <th class="info">LastupdatedBy</th>

               </tr>
             </thead>
             <tbody>
               <?php
               include_once("../classes/its_workstation.php");

               $its_brandmodel = its_BrandModel::selectAllBrandModel();

               for($i=0;$i<count($its_brandmodel);$i++){
                ?>
                <tr>
                 <td><a href="?id=<?php echo $its_brandmodel[$i]->getBrandID(); ?>"><?php echo $its_brandmodel[$i]->getBrandID(); ?></a></td>
                 <td><?php echo $its_brandmodel[$i]->getBrand(); ?></td>
                 <td><?php echo $its_brandmodel[$i]->getModel(); ?></td>
                 <td><?php echo $its_brandmodel[$i]->getBrandType(); ?></td>
                 <td><?php echo $its_brandmodel[$i]->getLastUpdate(); ?></td>
                 <td><?php echo $its_brandmodel[$i]->getLastUpdatedBy(); ?></td>
               </tr>
             <?php } ?>
           </tbody>
         </table>
       </div>
     </div>    

   </div>
 </div>

         </div>
        </div>
  </main>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script>
$(document).ready(function () {



      $('#stextype').click(function(){

          document.getElementById('stextype').value = '';
      });





       	$('#stextid').keyup(function(event){
                  var keycode = (event.keyCode ? event.keyCode : event.which);
                  var exist = false;

                if(keycode == '13'){


            if (document.getElementById("stextid").value == '') {     
                return;
              }else {
                  
                  document.getElementById("stextbrand").readOnly = false;
                  document.getElementById("stextbrand").focus();
                  document.getElementById("stextid").readOnly=true;

                }
                  }

              });


       	$('#stextmodel').keyup(function(event){
                  var keycode = (event.keyCode ? event.keyCode : event.which);
                  var exist = false;

                if(keycode == '13'){


            if (document.getElementById("stextmodel").value == '') {     
                return;
              }else {
                  
                  document.getElementById("stextype").readOnly = false;
                  document.getElementById("stextype").focus();

                }
                  }

              });



   });


 function SearchByFunc() {

  var input, filter, table, tr, td,td1, i;
  input = document.getElementById("SearchBy");
  filter = input.value.toUpperCase();
  table = document.getElementById("tblsampling");
  tr = table.getElementsByTagName("tr");


  for (i = 0; i < tr.length; i++) {

    td = tr[i].getElementsByTagName("td");

  if(td.length > 0){ // to avoid th

       if (td[0].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1 || td[2].innerHTML.toUpperCase().indexOf(filter) > -1 || td[3].innerHTML.toUpperCase().indexOf(filter) > -1 || td[4].innerHTML.toUpperCase().indexOf(filter) > -1 || td[5].innerHTML.toUpperCase().indexOf(filter) > -1 ) 
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

 