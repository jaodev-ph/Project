<?php


include_once("../classes/its_brandmodel.php");
include_once("../classes/connection.php");


$brandvalue ='';
$typevalue ='';
$message = "This is already Exist!";
$mode =0;
$preventer = 0;
$errorflag = 0;
if(isset($_GET['id'])){
  $mode = 1;
  $id = $_GET['id'];
  $getvalue =  its_BrandModel::getbrandById($id);
  $brandvalue = $getvalue[0]->getBrand();
  $typevalue = $getvalue[0]->getBrandType();

}

if(isset($_POST['brand_submit']))
{
    if(empty($_GET['id'])){
      if(Its_BrandModel::validateBrand($_POST['stxtbrand'],$_POST['txttype']) == false)
      {
        $mode=0;
        $insert =  new Its_BrandModel();
        $insert->setBrand($_POST['stxtbrand']);
        $insert->setBrandType($_POST['txttype']);
        $insert->setLastUpdatedBy($_SESSION['name']);
        $insert->addBrand();
    
        }
    else
    {
        $errorflag =1;
      
     }
  }
}
if(isset($_GET['id']) && isset($_POST['brand_submit'])){
    $mode = 1;
    $preventer = 1;
    $update = new Its_BrandModel();
    $update->UpdateBrand($id,$_POST['stxtbrand'],$_SESSION['name'],$_POST['txttype']);
    $brandvalue = '';
    $typevalue = '';
    $id='';
   
}

?>

<style>
  .input-error{
    box-shadow: 0 0 5px red;
  }
</style>
  <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-grid demo-content">
      <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >+


			<div class="mdl-cell--top mdl-cell--4-col mdl-cell--4-col-desktop">

        <?php if ($mode ==0 || $mode ==1){
            if($preventer ==1 && $errorflag ==0){
          ?>

           <div class="alert alert-success alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Success!</strong>  <?=($mode ==1 ? 'Updated' : 'Added');?>
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

				<div class="container-fluid" style="margin-top: 40px">
          <form  id= "brandform" method="POST">
            <div class="form-group">
              <label for="pwd">Brand Name</label>
              <input type="text" class="form-control" id="stxtbrand" name="stxtbrand" value="<?php echo $brandvalue; ?>" >
            </div>

              <div class="form-group">
              <label for="pwd">Type</label>
               <input type="text" class="form-control"  id ="txttype" name="txttype" list="txttypelist" value="<?php echo $typevalue;?>" required="required"/>

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

            <br>
            <br>
            <div class="form-group " align = "right" >
              <button type="submit"  id="brand_submit" name="brand_submit" class="btn btn-success btn-lg"> <?=($mode == 0? 'Save' : 'Update');?></button>
              <a id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" href="?cancel">Cancel</a> 
              
            </div>
          </form>
        </div>

      </div>
      <div class="mdl-cell--top mdl-cell--8-col mdl-cell--8-col-desktop">
       <div class="panel panel-primary" >
        <div class="panel-heading" >BRANDS</div>
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
                 <th class="info">Type</th>
                 <th class="info">Lastupdate</th>
                 <th class="info">LastupdatedBy</th>
             </tr>
           </thead>
           <tbody>
             <?php
   
              $its_brandmodel = its_BrandModel::selectBrand();
             for($i=0;$i<count($its_brandmodel);$i++){
                ?>
                <tr>
                 <td><a href="?id=<?php echo $its_brandmodel[$i]->getBrandID(); ?>"><?php echo $its_brandmodel[$i]->getBrandID(); ?></a></td>
                 <td><?php echo $its_brandmodel[$i]->getBrand(); ?></td>
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

<script>

  $(document).ready(function () {


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

       if (td[0].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1  || td[2].innerHTML.toUpperCase().indexOf(filter) > -1 
        || td[3].innerHTML.toUpperCase().indexOf(filter) > -1 || td[4].innerHTML.toUpperCase().indexOf(filter) > -1 ) 
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