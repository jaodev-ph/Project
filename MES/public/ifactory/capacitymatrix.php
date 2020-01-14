
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
<?php
  include_once("../classes/capacitymatrix1.php");
  include_once("../classes/model.php");
  include_once("../classes/account.php");

 $disabled = 'disabled';
 $readonly = 'readonly';
 $cmbline = '';
 $side = '';
 $uph = '';
 $remarks = '';
 $model = '';
 $active = '0';
 $multiplier= '';
 $cmbvendor = '';
 $id = '';
 $mode = 0;


 if(isset($_GET['id']))
  {
    $id = $_GET['id'];
    $capid = CapacityMatrix::getCapacityMatrixbyId($_GET['id']);
    $cmbline = $capid[0]->getLineID();
    $model = $capid[0]->getModel();
    $cmbvendor = $capid[0]->getVendor();
    $side = $capid[0]->getSide();
    $uph = $capid[0]->getUph();
    $multiplier = $capid[0]->getMultiplier();
    $remarks = $capid[0]->getRemarks();
    //$
    //echo "<script type='text/javascript'>alert($brand);</script>";
    $readonly = '';
    $disabled = ''; 

    $mode = 1;
  }


?>
<div class="mdl-cell--top mdl-cell--12-col mdl-cell--4-col-desktop">
   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Successfully<b id="SerialNumber" name="SerialNumber"></b>  Updated!</div>

   <div id = "success2" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Successfully<b id="SerialNumber1" name="SerialNumber1"></b>  Added!</div>

    <div id = "forlotmaking" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> All field with asterisk (*) <b id="Serial_Error4" name="Serial_Error4"></b> is Required!</div>
 
    
<form id = "matrix-form" name ="matrix-form">
  <p> </p>
  <div class="form-group">
      <label for="pwd">ID *</label>
      <input type="text" class="form-control" id="StextID" placeholder= "ID" name="StextID" value="<?=$id;?>" <?=$readonly;?> onkeypress="if (event.keyCode == 13)  return false;" required readonly>
  </div>

  <div class="form-group">
    <label for="pwd">Line ID *</label>
          <Select class="form-control"  id="Scmbline" name="Scmbline" value="<?php echo $cmbline;?>" required>
        <option></option>
        <?php 
            $selectline = CapacityMatrix::SelectAllLine();
                     for($i=0;$i<count($selectline);$i++){
                ?>
        <option value ='<?php echo trim($selectline[$i]->getLine()); ?>' <?php if($cmbline==trim($selectline[$i]->getLine())) {echo "selected";} ?> ><?php echo $selectline[$i]->getLine(); ?> </option>
         <?php 
       }
       ?> 
     </Select>
    </div>

     <div class="form-group">
    
      <label for="pwd">Vendor *</label>
            <Select class="form-control" id="Scmbvendor" name="Scmbvendor" value="<?php echo $cmbvendor;?>" <?php echo $disabled;?> required>
        <option></option>
        <?php 
            $selectaccount = Account::SelectAllAccount();
                     for($i=0;$i<count($selectaccount);$i++){
                ?>
        <option value ='<?php echo trim($selectaccount[$i]->getCustomerName()); ?>' <?php if($cmbvendor==trim($selectaccount[$i]->getCustomerName())) {echo "selected";} ?> ><?php echo $selectaccount[$i]->getCustomerName(); ?> </option>
         <?php 
       }
       ?> 
     </Select>
    </div>

  <div class="form-group">
      <label for="pwd">Model *</label>
         <input type="text" class="form-control" id="Stextmodel" name="Stextmodel" value="<?php echo $model; ?>" <?php echo $readonly;?> required>
    </div>

 <div class="form-group">
      <label for="pwd">Side *</label>
      <input type="text" class="form-control" id="Stextside" name="Stextside" value="<?php echo $side; ?>" <?php echo $readonly;?> required>
    </div>

     <div class="form-group">
      <label for="pwd">Uph *</label>
      <input type="number"  onkeypress="numberOnly(event)" min="1" class="form-control" id="Stextuph" name="Stextuph" value="<?php echo $uph; ?>" <?php echo $readonly;?> required>
    </div>

   <div class="form-group">
      <label for="pwd">Multiplier *</label>
      <input type="number" onkeypress="numberOnly(event)" min="1" class="form-control" id="Stextmultiplier" name="Stextmultiplier" value="<?php echo $multiplier; ?>" <?php echo $readonly;?> required>
    </div>


  <div class="form-group">
      <label for="pwd">Remarks</label>
      <input type="text" class="form-control" id="Stextremarks" name="Stextremarks" value="<?php echo $remarks; ?>" <?php echo $readonly;?> >
    </div>


<input type="hidden" class="form-control" id="mode" name="mode" value="<?php echo $mode; ?>" <?php echo $readonly;?> >
<!-- 
      <div class="form-group" align = "right">
      <label>
      <input type="checkbox" id="chkActive" name="chkActive" <?php if($active=='1'){echo "checked";} ?>> Active
      </label>
    </div> -->

    <div class="form-group" align = "right">
       <!--  <button type="button"  id="btnAdd" name="btnAdd" class="btn btn-primary btn-lg" >Add</button> -->

        <button type="button"  id="btnSave" name="btnSave" class="btn btn-success btn-lg"><?=($mode ==0 ? 'Save' : 'Update')?></button>

        <a id="btnCancel" name="btnCancel" class="btn btn-warning btn-lg" href="?MenuCode=004&SubMenuCode=1">Cancel</a>
      </div>

    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop">
              <div class="panel panel-primary" >
                  <div class="panel-heading" >CAPACITY MATRIX</div>
                  <div class="panel-body">
                      <br />

                         <div class="form-group" >
                        
                            <label for="pwd" id="label-search">Search</label>
                              <div class="search">
                                <span class="fa fa-search"></span> 
                                <input type="text" class="form-control pull-center" id="SearchBy" name="SearchBy" value="" onkeyup="SearchByFunc()" placeholder="You can search by ID, Line ID, Model or Vendor" >
                          </div>
                        </div>
                          
                      <div class="table-responsive" style="overflow-x: scroll;height:600px;">
                            <table class="table table-bordered"  id="tblsampling" name ="tblsampling">
                                <thead>
                                    <tr>
                                        <th class="info">ID</th>
                                        <th class="info">Lineid</th>
                                        <th class="info">Model</th>
                                        <th class="info">Side</th>
                                        <th class="info">Uph</th>
                                        <th class="info">Vendor</th>
                                        <th class="info">Multiplier</th>
                                        <th class="info">Remarks</th>
                                        <th class="info">Lastupdate</th>
                                        <th class="info">UpdatedBy</th>

                                    </tr>
                                </thead>
                                <tbody>
                  <?php
                     include_once("../classes/capacitymatrix1.php");
                     $id = CapacityMatrix::getCapacityMatrix($_SESSION['account']);

                    for($i=0;$i<count($id);$i++){
                      ?>

                    <tr>
                        <td><a href="?id=<?=$id[$i]->getID(); ?>"><?= $id[$i]->getID(); ?></a></td>
                        <td><?php echo $id[$i]->getLineId(); ?></td>
                        <td><?php echo $id[$i]->getModel(); ?></td>
                        <td><?php echo $id[$i]->getSide(); ?></td>
                        <td><?php echo $id[$i]->getUph(); ?></td>
                        <td><?php echo $id[$i]->getVendor(); ?></td>
                        <td><?php echo $id[$i]->getMultiplier(); ?></td>
                        <td><?php echo $id[$i]->getRemarks(); ?></td>
                        <td><?php echo $id[$i]->getLastupdated(); ?></td>
                        <td><?php echo $id[$i]->getUpdatedBy(); ?></td>

                    </tr>

                    <?php 
                    } ?>
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




$('#StextID').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){


      if (document.getElementById("StextID").value == '') {     
          return;
        }else {
            
            document.getElementById("StextID").readOnly = true;
            document.getElementById("StextID").focus();
           

          }
            }

        });




 $('#Scmbline').change(function (){
    if (document.getElementById("Scmbline").value == '') {
            
            document.getElementById("Scmbtype").disabled = true;
             $('#Scmbline').focus();
          }else{

           
         
          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_"); 
               //alert(result);
                if(document.getElementById("StextID").value == ''){
                document.getElementById("StextID").value = res[0];
                 document.getElementById("Scmbvendor").disabled = false;
                document.getElementById("Scmbvendor").focus();
               }
           
              }
            };
          

            xmlhttp.open("GET", "../php/getmaxcapacitymatrixid.php?line="+ document.getElementById("Scmbline").value, true);
            xmlhttp.send();
            
            
            
          }
     

 });



  $('#Scmbvendor').change(function (){

      if (document.getElementById("Scmbvendor").value == '') {     
          return;
        }else {
            
            document.getElementById("Stextmodel").readOnly = false;
            document.getElementById("Stextmodel").focus();


            
          }    

        });



    $('#Stextmodel').change(function (){

      if (document.getElementById("Stextmodel").value == '') {     
          return;
        }else {
            
            document.getElementById("Stextside").readOnly = false;
            document.getElementById("Stextside").focus();
            
          }    

        });

        $('#Stextside').change(function (){

      if (document.getElementById("Stextside").value == '') {     
          return;
        }else {
            
            document.getElementById("Stextuph").readOnly = false;
            document.getElementById("Stextuph").focus();
            
          }    

        });

      $('#Stextuph').change(function (){

      if (document.getElementById("Stextuph").value == '') {     
          return;
        }else {
            
             document.getElementById("Stextmultiplier").readOnly = false;
             document.getElementById("Stextmultiplier").focus();
             document.getElementById("Stextremarks").readOnly = false;
            
          }    

        });


 $( "#btnSave" ).click(function() {
   
              var x = document.forms["matrix-form"]["Stextuph"].value;
              var xx = document.forms["matrix-form"]["Stextmultiplier"].value;
              var xxx = document.forms["matrix-form"]["Stextside"].value;
              var xxxx = document.forms["matrix-form"]["Scmbvendor"].value;
              var xxxxx = document.forms["matrix-form"]["Scmbline"].value;
              var xxxxxx = document.forms["matrix-form"]["Stextmodel"].value;
              var val = <?php echo $mode?>;
            if (x == "" || xx == "" || xxx == "" || xxxx == ""|| xxxxx == "" || xxxxxx =='') {
               document.getElementById("forlotmaking").removeAttribute("hidden");
               function explode(){     
                document.getElementById("forlotmaking").fadeIn(1000);
               document.getElementById("forlotmaking").setAttribute("hidden","");
              }
               setTimeout(explode, 2000);
              return false;
            }
          
            else{
                
                var xmlhttp = new XMLHttpRequest();
                  xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                     var result = this.responseText;
                     var res = result.split("_"); 
                      
                      if(val == 1){
                      document.getElementById("success").removeAttribute("hidden","");
                      }else{
                        document.getElementById("success2").removeAttribute("hidden","");
                      }
                     
                    
                      function explode(){
                          if(val == 1){
                      document.getElementById("success").setAttribute("hidden","");
                      }
                      document.getElementById("success2").setAttribute("hidden","");
                      window.location.replace("./main.php?MenuCode=004&SubMenuCode=1");
                     
                      }
                      setTimeout(explode, 1300);
                     

                    
                    }

                      
                  };

                  xmlhttp.open("GET", "../php/capacitymatrixaddupdate.php?id=" + document.getElementById("StextID").value +"&lineid="+document.getElementById("Scmbline").value+"&vendor="+ document.getElementById("Scmbvendor").value+"&model="+ document.getElementById("Stextmodel").value+"&side="+ document.getElementById("Stextside").value+"&uph="+ document.getElementById("Stextuph").value+"&multiplier="+ document.getElementById("Stextmultiplier").value+"&remarks="+ document.getElementById("Stextremarks").value+"&mode="+ document.getElementById("mode").value, true);
                    xmlhttp.send();
            }
        });

 $('#Stextmultiplier').keypress(function(e){ 
       if (this.value.length == 0 && e.which == 48 ){
          return false;
       }
    });

 $('#Stextuph').keypress(function(e){ 
       if (this.value.length == 0 && e.which == 48 ){
          return false;
       }
    });
   });





function numberOnly(evt){

        var ch = String.fromCharCode(evt.which);

        if(!(/[0-9]/.test(ch)))
        {
          evt.preventDefault();
        }

      }


function SearchByFunc() {

  var input, filter, table, tr, td,td1, i;
  input = document.getElementById("SearchBy");
  filter = input.value.toUpperCase();
  table = document.getElementById("tblsampling");
  tr = table.getElementsByTagName("tr");


  for (i = 0; i < tr.length; i++) {

    td = tr[i].getElementsByTagName("td");

  if(td.length > 0){ // to avoid th

       if (td[0].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1 || td[2].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1 || td[5].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1) 
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
