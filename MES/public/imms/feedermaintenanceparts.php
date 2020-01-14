<?php  

  $feederPn = '';
  $typeParts = '';
  $sizeParts = '';
  $feederDescription = '';
  $disabled = 'disabled';
  $mode = 'parts';

  if(isset($_GET['id'])){
      
      include_once("../classes/feeder_maintenance.php");
      $feeder = new Maintenance($_GET['id'],$mode);
      $feederPn = $feeder->getfeederPn();
      $typeParts = $feeder->getfeederType();
      $sizeParts = $feeder->getfeederSize();
      $feederDescription = $feeder->getfeederDescription();
      $disabled='';

}
?>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      
      <div class="mdl-cell--top mdl-cell--12-col mdl-cell--4-col-desktop">
        <div class="form-group ">
          <div class="col-md-12">
               <label for="usr">Feeder Parts:</label>
              <input type="text" class="form-control" id="feederPn" name="feederPn" value="<?php echo $feederPn; ?>" onkeyup="if(event.keyCode ==13) return false;">
          </div>
        </div>
        <div class="col-md-12">
               <label for="usr">Feeder Type:</label>
              <select class="form-control" name=typeParts id="typeParts">
                <option selected="selected"><?php echo $typeParts; ?></option>
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
                <select class="form-control" name=sizeParts id="sizeParts">
                <option selected="selected"><?php echo $sizeParts; ?></option>
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
               <label for="usr">Description:</label>
              <input type="text" class="form-control" id="feederDescription" name="feederDescription" value="<?php echo $feederDescription; ?>">
          </div>

        <div class="form-group ">
          <div class="col-md-12" align="left"><br>
            <a href="?id="><button type ="button" class="btn btn-success emp-btn" id ="Addpart" name="Addpart" value="Add">ADD</button></a>
            <a href="?id="><button type ="button" class="btn btn-success emp-btn" id ="Updatepart" name="Updatepart" value="Update">UPDATE</button></a>
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
                      <th class="info">Type</th>
                      <th class="info">Size Type</th>
                      <th class="info">Feeder Description</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php include_once("../classes/feeder_getdata.php");
                        $feeder = Getdata::getAllParts();
                          for ($i=0; $i < count($feeder); $i++) 
                            { 
                              /*echo "<td>".$feeder[$i]->getfeederId()."</td>";*/
                            
                      ?>
                      <tr>    

                              <td><a href="?id=<?php echo $feeder[$i]->getfeederPn(); ?>"><?php echo $feeder[$i]->getfeederPn(); ?></a></td>
                              <td><?php echo $feeder[$i]->getfeederType(); ?></td>
                              <td><?php echo $feeder[$i]->getfeederSize(); ?></td>
                              <td><?php echo $feeder[$i]->getfeederDescription(); ?></td>
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
  $('#Addpart').click(function(){
     alert(document.getElementById("Addpart").value)
      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");
              //alert(result);

            }
          }

          xmlhttp.open("GET","../php/feeder_part.php?feederPn="+document.getElementById("feederPn").value+"&typeParts="+document.getElementById("typeParts").value+"&sizeParts="+document.getElementById("sizeParts").value+"&feederDescription="+document.getElementById("feederDescription").value+"&mode="+document.getElementById("Addpart").value,true)
          xmlhttp.send();
  });

  $('#Updatepart').click(function(){
      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
              var result = this.responseText;
              // var res = result.split("_");
              alert(result);


            }
          }

          xmlhttp.open("GET","../php/feeder_part.php?feederPn="+document.getElementById("feederPn").value+"&typeParts="+document.getElementById("typeParts").value+"&sizeParts="+document.getElementById("sizeParts").value+"&feederDescription="+document.getElementById("feederDescription").value+"&mode="+document.getElementById("Updatepart").value+"&id=<?php echo $_GET['id']; ?>",true)
          xmlhttp.send();
  });
}); 
</script>