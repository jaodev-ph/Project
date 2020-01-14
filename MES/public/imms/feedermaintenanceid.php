<?php

  $feederId = '';
  $typeId = '';
  $sizeId = '';
  $lineId = '';
  $plantnoFeeder = '';
  $disabled = 'disabled';
  $mode = 'id';

  if(isset($_GET['id'])){
      
      include_once("../classes/feeder_maintenance.php");
      $feeder = new Maintenance($_GET['id'],$mode); 
      $feederId = $feeder->getfeederId();
      $typeId = $feeder->getfeederType();
      $sizeId = $feeder->getfeederSize();
      $plantnoFeeder = $feeder->getplantnoFeeder();
      $lineId = $feeder->getline();
      $disabled='';
    

}

?>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      
      <div class="mdl-cell--top mdl-cell--12-col mdl-cell--4-col-desktop">
        <div class="form-group ">
          <div class="col-md-12">
               <label for="usr">Feeder ID:</label>
              <input type="text" class="form-control" id="feederId" name="feederId" value="<?php echo $feederId; ?>">
          </div>
          <div class="col-md-12">
               <label for="usr">Feeder Type:</label>
              <select class="form-control" name=typeId id="typeId">
                  <option selected="selected"><?php echo $typeId; ?></option>
                    <?php include_once("../classes/feeder_getdata.php");
                      $feeder = Getdata::getAllFeederType();
                     for ($i=0; $i < count($feeder); $i++)
                      { 
                        echo "<option value=".$feeder[$i]->getfeederType().">".$feeder[$i]->getfeederType()."</option>";
                      }
                ?>
              </select>
          </div>
          <div class="col-md-12">
               <label for="usr">Feeder Size:</label>
             <select class="form-control" name=sizeId id="sizeId">
                <option selected="selected"><?php echo $sizeId; ?></option>
                  <?php include_once("../classes/feeder_getdata.php");
                      $feeder = Getdata::getAllFeederSize();
                     for ($i=0; $i < count($feeder); $i++)
                      { 
                        echo "<option value=".$feeder[$i]->getfeederSize().">".$feeder[$i]->getfeederSize()."</option>";
                      }
                  ?>
              </select>
          </div>
          <div class="col-md-12">
               <label for="usr">Plant No(Feeder):</label>
              <select class="form-control" name=plantnoFeeder id="plantnoFeeder">
                <option selected="selected"><?php echo $plantnoFeeder; ?></option>
                  <?php include_once("../classes/feeder_getdata.php");
                      $feeder = Getdata::getAllFeederPlant();
                     for ($i=0; $i < count($feeder); $i++)
                      { 
                        echo "<option value=".$feeder[$i]->getplantnoFeeder().">".$feeder[$i]->getplantnoFeeder()."</option>";
                      }
                  ?>
              </select>
          </div>
          <div class="col-md-12">
               <label for="usr">Feeder Line:</label>
              <select class="form-control" name=lineId id="lineId">
                <option selected="selected"><?php echo $lineId; ?></option>
                  <?php include_once("../classes/feeder_getdata.php");
                      $feeder = Getdata::getAllFeederLine();
                     for ($i=0; $i < count($feeder); $i++)
                      { 
                        echo "<option value=".$feeder[$i]->getfeederline().">".$feeder[$i]->getfeederline()."</option>";
                      }
                  ?>
              </select>
          </div>
        </div>

        <div class="form-group ">
          <div class="col-md-12" align="left"><br>
            <a href="?id="><button type ="button" class="btn btn-success emp-btn" id ="Addid" name="Addid">ADD</button></a>
            <a href="?id="><button type ="button" class="btn btn-success emp-btn" id ="Updateid" name="Updateid">UPDATE</button></a>
            <a href="?id="><button type ="button" class="btn btn-warning emp-btn" id ="btnClear" name="btnClear">CANCEL</button></a>
          </div>
        </div>
      </div>

      <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop">

       <div class="panel panel-primary" >
          <div class="panel-heading" >Details</div>
            <div class="panel-body"><br />
              <div class="table-responsive" style="overflow-x: scroll;height:400px;">
                <table class="table table-bordered"  id="tbldetails" >
                  <thead>
                    <tr>
                      <th class="info">Feeder ID</th>
                      <th class="info">Feeder Type</th>
                      <th class="info">Feeder Size</th>
                      <th class="info">Plant No(Feeder)</th>
                      <th class="info">Feeder Line</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php include_once("../classes/feeder_getdata.php");
                        $feeder = Getdata::getAllFeeder();
                          for ($i=0; $i < count($feeder); $i++) 
                            { 
                              /*echo "<td>".$feeder[$i]->getfeederId()."</td>";*/
                            
                      ?>
                      <tr>    

                              <td><a href="?id=<?php echo $feeder[$i]->getfeederId(); ?>"><?php echo $feeder[$i]->getfeederId(); ?></a></td>
                              <td><?php echo $feeder[$i]->getfeederType(); ?></td>
                              <td><?php echo $feeder[$i]->getfeederSize(); ?></td>
                              <td><?php echo $feeder[$i]->getplantNoFeeder(); ?></td>
                              <td><?php echo $feeder[$i]->getfeederline(); ?></td>
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

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#Addid').click(function(){
    alert(document.getElementById("feederId").value);
      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");
              document.getElementById("plantnoFeeder").value='';
              document.getElementById("feederId").value='';
              document.getElementById("sizeId").value='';
              document.getElementById("typeId").value='';
              document.getElementById("lineId").value='';

            }
          }

          xmlhttp.open("GET","../php/feeder_id.php?feederId="+document.getElementById("feederId").value+"&typeId="+document.getElementById("typeId").value+"&sizeId="+document.getElementById("sizeId").value+"&plantnoFeeder="+document.getElementById("plantnoFeeder").value+"&lineId="+document.getElementById("lineId").value+"&mode=Add",true)
          xmlhttp.send();
  });

  $('#Updateid').click(function(){
      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");
              document.getElementById("plantnoFeeder").value='';
              document.getElementById("feederId").value='';
              document.getElementById("sizeId").value='';
              document.getElementById("typeId").value='';
              document.getElementById("lineId").value='';


            }
          }

          xmlhttp.open("GET","../php/feeder_id.php?feederId="+document.getElementById("feederId").value+"&typeId="+document.getElementById("typeId").value+"&sizeId="+document.getElementById("sizeId").value+"&plantnoFeeder="+document.getElementById("plantnoFeeder").value+"&lineId="+document.getElementById("lineId").value+"&mode=Update",true)
          xmlhttp.send();
  });
}); 
</script>

