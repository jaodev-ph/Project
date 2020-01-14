<?php 
  $size = '';
  $disabled = 'disabled';
  $mode = 'size';

  if(isset($_GET['id'])){
      
      include_once("../classes/feeder_maintenance.php");
      $feeder = new Maintenance($_GET['id'],$mode); 
      $feederId = $feeder->getfeederId();
      $typeId = $feeder->getfeederType();
      $sizeId = $feeder->getfeederSize();
      $plantNoFeeder = $feeder->getplantnoFeeder(); 
      $disabled='';
    

}

?>

<main class="mdl-layout__content mdl-color--grey-100"> 
  <div class="mdl-grid demo-content">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      
      <div class="mdl-cell--top mdl-cell--12-col mdl-cell--4-col-desktop">
        <div class="form-group ">
          <div class="col-md-12">
               <label for="usr">Feeder Size:</label>
              <input type="text" class="form-control" id="feederId" name="feederId" value="<?php echo $feederId; ?>" onkeyup="if(event.keyCode ==13) return false;">
          </div>
        </div>

        <div class="form-group ">
          <div class="col-md-12" align="left"><br>
            <button type ="button" class="btn btn-success emp-btn" id ="Add" name="Add" data-toggle="modal" <?php echo $disabled ?>>ADD</button>
            <button type ="button" class="btn btn-success emp-btn" id ="Edit" name="Edit" data-toggle="modal" <?php echo $disabled ?>>EDIT</button>
            <button type ="button" class="btn btn-warning emp-btn" id ="btnClear" name="btnClear" onclick="window.location.reload()">CANCEL</button> 
          </div>
        </div>
      </div>

      <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop">
       <div class="panel panel-primary">
          <div class="panel-heading" >Details</div>
            <div class="panel-body"><br />
              <div class="table-responsive" style="overflow-x: scroll;height:400px;">
                <table class="table table-bordered"  id="tbldetails" >
                  <thead>
                    <tr>
                      <th class="info">Feeder ID</th>
                      <th class="info">Type</th>
                      <th class="info">Size Type</th>
                      <th class="info">Plant No(Feeder)</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php include_once("../classes/feeder_insert.php");
                        $feeder = Insert::getAllFeederSize();
                          for ($i=0; $i < count($feeder); $i++) 
                            { 
                              /*echo "<td>".$feeder[$i]->getfeederId()."</td>";*/
                            
                      ?>
                      <tr>
                              <td><a href="?id=<?php echo $feeder[$i]->getfeederSize(); ?>"><?php echo $feeder[$i]->getfeederSize(); ?></a></td>
                      <?php } ?>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>    
        </div>
      </div>
    </div>
  </div>
</main>