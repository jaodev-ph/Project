
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
<?php
  
  include_once("../classes/ifactory_machinedetails.php");

 $disabled = 'disabled';
 $readonly = 'readonly';

 $id= '';
 $cmbname= '';
 $img= '';
 $line= '';
 $seq= '';
 $cmbmachineid= '';
 $cmbline= '';


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
 <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel
                    File</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import"
                    class="btn-submit">Import</button>
        
            </div>
        
        </form>



    </div>

 

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {




});
</script>     
          </div>
        </div>
  </main>
