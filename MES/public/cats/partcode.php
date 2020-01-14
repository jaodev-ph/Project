
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
<?php
  
  include_once("../classes/partcode.php");
  include_once("../classes/model.php");

 $disabled = 'disabled';
 $readonly = 'readonly';
 $partscode = '';
 $description = '';
 $modelfamily = '';
 $remarks = '';
 $cmbmodel = '';
 $active = '0';

 $mode = 0;

if(isset($_GET['partscode']))
{
    $partscode = $_GET['partscode'];

    
    $part_code = new Partcode($_SESSION['account'],$_GET['partscode']);

    $description = $part_code->getDescription();
    $cmbmodel = $part_code->getModel();
    $modelfamily = $part_code->getModelFamily();
    $remarks = $part_code->getRemarks();
    $active = $part_code->getActive();

    $readonly = '';
    $disabled = ''; 

    $mode = 1;

}
    ?>

  <div class="mdl-cell--top mdl-cell--12-col mdl-cell--4-col-desktop">
    
  <div class="form-group">
      <label for="pwd">Partcode</label>
      <input type="text" class="form-control" id="Stextpartcode" name="Stextpartcode" value="<?php echo $partscode; ?>" onkeypress="if (event.keyCode == 13)  return false;" required>
    </div>

  <div class="form-group">
      <label for="pwd">Description</label>
      <input type="text" class="form-control" id="Stextdescription" name="Stextdescription" value="<?php echo $description; ?>" onkeypress="if (event.keyCode == 13)  return false;" <?php echo $readonly;?>>
    </div>

  <div class="form-group">
    
      <label for="pwd">Model</label>
            <Select class="form-control" id="ScmbModel" name="ScmbModel" value="<?php echo $cmbmodel;?>" <?php echo $disabled;?>>
        <option></option>
        <?php 
            $SelectModel = Model::SelectAllChildModel($_SESSION['account']);
                     for($i=0;$i<count($SelectModel);$i++){
                ?>
        <option value ='<?php echo $SelectModel[$i]->getModel(); ?>' <?php if($cmbmodel==$SelectModel[$i]->getModel()) {echo "selected";} ?> ><?php echo $SelectModel[$i]->getModel(); ?> </option>
         <?php 
       }
       ?> 
     </Select>
    </div>

 <div class="form-group">
      <label for="pwd">ModelFamily</label>
      <input type="text" class="form-control" id="Stextmodelfamily" name="Stextmodelfamily" value="<?php echo $modelfamily; ?>" <?php echo $readonly;?> >
    </div>

     <div class="form-group">
      <label for="pwd">Remarks</label>
      <input type="text" class="form-control" id="Stextremarks" name="Stextremarks" value="<?php echo $remarks; ?>" <?php echo $readonly;?> >
    </div>

<input type="hidden" class="form-control" id="mode" name="mode" value="<?php echo $mode; ?>" <?php echo $readonly;?> >

      <div class="form-group" align = "right">
      <label>
      <input type="checkbox" id="chkActive" name="chkActive" <?php if($active=='1'){echo "checked";} ?>> Active
      </label>
    </div>

    <div class="form-group" align = "right">
       <!--  <button type="button"  id="btnAdd" name="btnAdd" class="btn btn-primary btn-lg" >Add</button> -->
        <button type="button"  id="btnSave" name="btnSave" class="btn btn-success btn-lg" >Save</button>
        <a id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" href="?cancel">Cancel</a>
      </div>

    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop">
              <div class="panel panel-primary" >
                  <div class="panel-heading" >PARTCODE</div>
                  <div class="panel-body">
                      <br />

                           <div class="form-group" >
                            <label for="pwd" id="label-search">Search</label>
                              <div class="search">
                                <span class="fa fa-search"></span> 
                                <input type="text" class="form-control pull-center" id="partcodetblsearch" name="partcodetblsearch" value="" onkeyup="Search()" placeholder="Search......" >
                          </div>
                        </div>


                      <div class="table-responsive" style="overflow-x: scroll;height:400px;">
                            <table class="table table-bordered"  id="tblsampling" >
                                <thead>
                                    <tr>
                                        <th class="info">Partcode</th>
                                        <th class="info">Description</th>
                                        <th class="info">Model</th>
                                        <th class="info">Model Family</th>
                                        <th class="info">Remarks</th>
                                        <th class="info">Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                  <?php
                     include_once("../classes/partcode.php");
                     $partscode = Partcode::getAllPartsCode($_SESSION['account']);

                     for($i=0;$i<count($partscode);$i++){
                    ?>

                    <tr>
                        <td><a href="?partscode=<?php echo $partscode[$i]->getPartcode(); ?>"><?php echo $partscode[$i]->getPartcode(); ?></a></td>
                        <td><?php echo $partscode[$i]->getDescription(); ?></td>
                        <td><?php echo $partscode[$i]->getModel(); ?></td>
                        <td><?php echo $partscode[$i]->getModelFamily(); ?></td>
                        <td><?php echo $partscode[$i]->getRemarks(); ?></td>
                        <td><?php echo $partscode[$i]->getActive(); ?></td>

                    </tr>

                    <?php } ?>
                                </tbody>
                            </table>
                      </div>
                  </div>    
      
                </div>

    </div>
 
 </form>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {



$('#Stextpartcode').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){


      if (document.getElementById("Stextpartcode").value == '') {     
          return;
        }else {
            
            document.getElementById("Stextdescription").readOnly = false;
            document.getElementById("Stextdescription").focus();

          }
            }

        });

$('#Stextdescription').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){


      if (document.getElementById("Stextdescription").value == '') {     
          return;
        }else {
            
            document.getElementById("ScmbModel").disabled = false;
            document.getElementById("ScmbModel").focus();
            
          }
            }

        });


 $('#ScmbModel').change(function (){

      if (document.getElementById("ScmbModel").value == '') {     
          return;
        }else {
            
            document.getElementById("Stextmodelfamily").readOnly = false;
            document.getElementById("Stextmodelfamily").focus();
            
          }
          

        });

$('#Stextmodelfamily').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){


      if (document.getElementById("Stextmodelfamily").value == '') {     
          return;
        }else {
            
            document.getElementById("Stextremarks").readOnly = false;
            document.getElementById("Stextremarks").focus();
            
          }
            }

        });

$('#Stextremarks').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){


      if (document.getElementById("Stextremarks").value == '') {     
          return;
        }else {
            
            document.getElementById("chkActive").disabled = false;
            document.getElementById("chkActive").focus();
            
          }
            }

        });

$( "#btnSave" ).click(function() {

          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
               /*alert(result);*/
                if(res[0].trim() == 'success'){

                  document.getElementById("Stextpartcode").value='';
                  document.getElementById("Stextdescription").value='';
                  document.getElementById("ScmbModel").value='';
                  document.getElementById("Stextmodelfamily").value='';
                  document.getElementById("Stextremarks").value='';
                  document.getElementById("chkActive").checked=false;

                  document.getElementById("Stextdescription").readOnly=true;
                  document.getElementById("ScmbModel").disabled=true;
                  document.getElementById("Stextmodelfamily").readOnly=true;
                  document.getElementById("Stextremarks").readOnly=true;
              
                }
              }
            };

            xmlhttp.open("GET", "../php/partcode.php?partcode=" + document.getElementById("Stextpartcode").value +"&description="+document.getElementById("Stextdescription").value+"&model="+ document.getElementById("ScmbModel").value+"&modelfamily="+ document.getElementById("Stextmodelfamily").value+"&remarks="+ document.getElementById("Stextremarks").value+"&active="+ document.getElementById("chkActive").checked+"&mode="+ document.getElementById("mode").value, true);
            xmlhttp.send();
            
        });





   });



function Search() {

  var input, filter, table, tr, td,td1, i;
  input = document.getElementById("partcodetblsearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("tblsampling");
  tr = table.getElementsByTagName("tr");


  for (i = 0; i < tr.length; i++) {

    td = tr[i].getElementsByTagName("td");

  if(td.length > 0){ // to avoid th

       if (td[0].innerHTML.toUpperCase().indexOf(filter) > -1 || 

td[2].innerHTML.toUpperCase().indexOf(filter) > -1) 
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
          </div>
        </div>
  </main>
