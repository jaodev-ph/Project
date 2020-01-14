<main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >





    <div class="container main-cont">
        <form method = "POST">
        <div id = "success1" name = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> successfully added!</div>

   <div id = "error1" name = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> <b id="SerialNumber" name="SerialNumber"></b> Part Number Already Exist!</div>

        <div class="row">
            <div class="col-md-4">
             

                    <div class="form-group">
                        <label>Part number:</label>
                        <input type="text" class="form-control" id = "txtpartno" name = "txtpartno" disabled>
                    </div>
              
                 
                    <div class="form-group">
                        <label>Supplier:</label>
                        <select class="form-control" id = "cmbmaker" name = "cmbmaker" disabled>
                            <option> </option>
                            <?php
                              include("../classes/kanban_makerlist.php");

                              $maker = Makerlist::getAllMaker($_SESSION['account']);

                              for ($i=0; $i < count($maker); $i++) { 
                                echo "<option>". $maker[$i]->getMaker() ."</option>";
                              }
                            ?>
                        </select>
                    </div>
                
               
                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" class="form-control" id = "txtdescription" name = "txtdescription" disabled>
                    </div>
                
                
                    <div class="form-group">
                        <label>Component type:</label>
                        <select class="form-control" id = "cmbcompotype" name = "cmbcompotype" disabled>
                            <option> </option>
                            <?php
                              include("../classes/kanban_componentlist.php");

                              $component = Componentlist::getAllComponent($_SESSION['account']);

                              for ($i=0; $i < count($component); $i++) { 
                                echo "<option>". $component[$i]->getComponentCode() ."-". $component[$i]->getDescription() ."</option>";
                              }
                            ?>
                        </select>
                    </div>
                
            
                
                   <div class="form-group">
                        <button class="form-btn btn btn-lg btn-success" type = "button" id = "btnadd" name = "btnadd">Add</button>
                 
                        <button class="form-btn btn btn-lg btn-info"  type = "button" id = "btnsave" name = "btnsave">Save</button>

                        <button class="form-btn btn btn-lg btn-warning" id="btncancel">Cancel</button>
                    </div>
                
            </div>
            
            

            <div class="col-md-8">
            <div class="panel panel-primary">
              <div class="panel-heading">Parts Details</div>
                <div class="panel-body" style="overflow: scroll; height: 350px;">
                  <table class="table table-bordered">
                      <tr class="info">
                          <th class="text-center">Part number</th>
                          <th class="text-center">Supplier</th>
                          <th class="text-center">Description</th>
                          <th class="text-center">Component type</th>
                      </tr>

                     <?php
                       include("../classes/kanban_partslist.php");
                       $parts = Partslist::getAllParts($_SESSION['account']);

                       for($i=0;$i<count($parts);$i++){
                      ?>

                      <tr>
                          <td><?php echo $parts[$i]->getPartNo(); ?></td>
                          <td><?php echo $parts[$i]->getMaker(); ?></td>
                          <td><?php echo $parts[$i]->getDescription(); ?></td>
                          <td><?php echo $parts[$i]->getCompoType(); ?></td>
                      </tr>

                      <?php } ?>
                  </table> 
                </div>
            </div>
                
            </div>
        </div>
    </div>
</form>
  
    <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  
      $(document).ready(function(){

  
            $("#btnsave").click(function() {
 
            if (document.getElementById("txtpartno").value == ''){
                $('#txtpartno').focus();
                return;
            }

            else if (document.getElementById("cmbmaker").value == '') {
                $('#cmbmaker').focus();
                return;
            }

             else if (document.getElementById("txtdescription").value == '') {
                $('#txtdescription').focus();
                return;
            }

            else if (document.getElementById("cmbcompotype").value == '') {
                $('#cmbcompotype').focus();
                return;
            }

            else 

            {
          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split(" ");

                if (result.trim() == 'ok'){
                    
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("cmbmaker").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("cmbcompotype").value = '';
                    document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("success1").removeAttribute("hidden");
                }

                else {
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("cmbmaker").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("cmbcompotype").value = '';
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error1").removeAttribute("hidden");
                }

               
               
              }
            };

            xmlhttp.open("GET", "../php/kanban_addpart.php?Partno=" + document.getElementById("txtpartno").value +"&Maker="+document.getElementById("cmbmaker").value+"&Description="+ document.getElementById("txtdescription").value+"&Compotype="+ document.getElementById("cmbcompotype").value, true);
            xmlhttp.send();

                }
            
        });


                  $("#btnadd").click(function() {
                     
                    document.getElementById("txtpartno").disabled = false;
                    document.getElementById("cmbmaker").disabled = false;
                    document.getElementById("txtdescription").disabled = false;
                    document.getElementById("cmbcompotype").disabled = false;
                    $("#txtpartno").focus();
                });

                  $("#btncancel").click(function(){

                    document.getElementById('txtpartno').value = '';
                    document.getElementById("cmbmaker").disabled = '';
                    document.getElementById("txtdescription").disabled = '';
                    document.getElementById("cmbcompotype").disabled = '';
                    document.getElementById("txtpartno").disabled = true;
                    document.getElementById("cmbmaker").disabled = true;
                    document.getElementById("txtdescription").disabled = true;
                    document.getElementById("cmbcompotype").disabled = true;
                  });

});
    

             

  </script>
</html>