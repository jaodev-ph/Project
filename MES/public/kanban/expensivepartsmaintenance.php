<main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >



    <div class="container main-cont">

    <div id = "success1" name = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> successfully added!</div>
    <div id = "error1" name = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> Already Exist!</div>

        <div class="row">
            <div class="col-md-4">
                
                    <div class="form-group">
                        <label>Model:</label>
                        <input type="text" class="form-control" id = "txtmodel" name = "txtmodel" disabled>
                    </div>

                    <div class="form-group">
                        <label>Revision:</label>
                        <input type="text" class="form-control" id = "txtrev" name = "txtrev" disabled>
                    </div>

                    <div class="form-group">
                        <label>Type:</label>
                        <select   id = "cmbtype" name = "cmbtype" class="form-control  input-sm" disabled>
                            
                            <option></option>

                            <?php
                                include("../classes/kanban_componentlist.php");

                                $component = Componentlist::getAllComponent($_SESSION['account']);

                                for ($i=0; $i < count($component); $i++) { 
                                    echo "<option>".$component[$i]->getComponentCode()."-".$component[$i]->getDescription()."</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Location:</label>
                        <input type="text" class="form-control" id = "txtlocation" name = "txtlocation" disabled>
                    </div>

                    <div class="form-group">
                        <label>Part Number:</label>
                        <input type="text" class="form-control" id = "txtpartno" name = "txtpartno" disabled>
                    </div>
         
            
                <div class="form-group">
                        <button class="form-btn btn btn-lg btn-success" type = "button" id = "btnadd" name = "btnadd" >Add</button>
                        <button class="form-btn btn btn-lg btn-info" type = "button" id = "btnsave" name = "btnsave">Save</button>
                        <button class="form-btn btn btn-lg btn-warning" id = "btncancel">Cancel</button>
                    </div>
                </div>
          
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Expensive Parts Details</div>
                    <div class="panel-body" style="overflow: scroll; height: 350px;">
                        <table class="table table-bordered">
                        <tr class="info">
                            <th class="text-center">Model</th>
                            <th class="text-center">Revision</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Part Number</th>
                        </tr>

                        <tr>
                            <?php

                                include("../classes/kanban_expensiveparts.php");

                                $exparts = Expensiveparts::getAllExpensiveparts();

                                for ($i=0; $i < count($exparts); $i++) { 
                                    echo "<td>".$exparts[$i]->getModel()."</td>";
                                    echo "<td>".$exparts[$i]->getRevision()."</td>";
                                    echo "<td>".$exparts[$i]->getType()."</td>";
                                    echo "<td>".$exparts[$i]->getLocation()."</td>";
                                    echo "<td>".$exparts[$i]->getPartno()."</td>";
                                }

                            ?>
                        </tr>

                        </table>  
                    </div>
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

        
  
        $("#btnsave").click(function() {
 
            if (document.getElementById("txtmodel").value == '') {
                $('#txtmodel').focus();
                return;
            } else if (document.getElementById("txtrev").value == '') {
                $('#txtrev').focus();
                return;
            } else if (document.getElementById("cmbtype").value == '') {
                $('#txttype').focus();
                return;
            } else if (document.getElementById("txtlocation").value == '') {
                $('#txtlocation').focus();
                return;
            } else if (document.getElementById("txtpartno").value == '') {
                $('#txtpartno').focus();
                return;
            }

            else 

            {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split(" ");
               alert(result);

                if (result.trim() == 'ok'){
                    
                    document.getElementById("txtmodel").value = '';
                    document.getElementById("txtrev").value = '';
                    document.getElementById("cmbtype").value = '';
                    document.getElementById("txtlocation").value = '';
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("success1").removeAttribute("hidden");
                }

                else {
                    $("#txtmaker").focus();
                    document.getElementById("txtmodel").value = '';
                    document.getElementById("txtrev").value = '';
                    document.getElementById("cmbtype").value = '';
                    document.getElementById("txtlocation").value = '';
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error1").removeAttribute("hidden");
                }
               
              }
            };

            xmlhttp.open("GET", "../php/kanban_addexpensiveparts.php?Model="+ document.getElementById("txtmodel").value+"&Rev="+document.getElementById("txtrev").value+"&Type="+document.getElementById("cmbtype").value+"&Location="+document.getElementById("txtlocation").value+"&Partno="+document.getElementById("txtpartno").value, true);
            xmlhttp.send();

                }
            
        });


                  $("#btnadd").click(function() {
                    document.getElementById("txtmodel").disabled = false;
                    document.getElementById("txtrev").disabled = false;
                    document.getElementById("cmbtype").disabled = false;
                    document.getElementById("txtlocation").disabled = false;
                    document.getElementById("txtpartno").disabled = false;
                    $("#txtmodel").focus();
                });

                  $("#btncancel").click(function(){
                    document.getElementById('txtmodel').value = '';
                    document.getElementById("txtmodel").disabled = true;
                    document.getElementById('txtrev').value = '';
                    document.getElementById("txtrev").disabled = true;
                    document.getElementById('cmbtype').value = '';
                    document.getElementById("cmbtype").disabled = true;
                    document.getElementById('txtlocation').value = '';
                    document.getElementById("txtlocation").disabled = true;
                    document.getElementById('txtpartno').value = '';
                    document.getElementById("txtpartno").disabled = true;
                  });



});
    
             
</script>