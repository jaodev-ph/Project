<main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >



    <div class="container main-cont">

        <div id = "success1" name = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Component <b id="SerialNumber" name="SerialNumber"></b> successfully added!</div>
    <div id = "error1" name = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Component <b id="SerialNumber" name="SerialNumber"></b> already exist!</div>

   
   
        <div class="row">
            <div class="col-md-4">
                
                    <div class="form-group">
                        <label>Component Code:</label>
                        <input type="text" class="form-control" id = "txtcomponentcode" name = "txtcomponentcode" disabled>
                    </div>

                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" class="form-control" id = "txtdescription" name = "txtdescription" disabled>
                    </div>
         
            
                <div class="form-group">
                   
                        <button class="form-btn btn btn-lg btn-success" type = "button" id = "btnadd" name = "btnadd" >Add</button>
                        <button class="form-btn btn btn-lg btn-info" type = "button" id = "btnsave" name = "btnsave">Save</button>
                        <button class="form-btn btn btn-lg btn-warning" id = "btncancel" >Cancel</button>
                    </div>
                </div>
          
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Component Details</div>
                    <div class="panel-body" style="overflow: scroll; height: 350px;">
                        <table class="table table-bordered">
                            <tr class="info">
                                <th class="text-center">Account</th>
                                <th class="text-center">Component Code</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Last Updated By</th>
                            </tr>

                            <?php
                             include("../classes/kanban_componentlist.php");
                             $component = Componentlist::getAllComponent($_SESSION['account']);

                             for($i=0;$i<count($component);$i++){
                            ?>

                            <tr>
                                <td><?php echo $component[$i]->getAccount(); ?></td>
                                <td><?php echo $component[$i]->getComponentCode(); ?></td>
                                <td><?php echo $component[$i]->getDescription(); ?></td>
                                <td><?php echo $component[$i]->getActive(); ?></td>
                                <td><?php echo $component[$i]->getLastupdatedby(); ?></td>
                            </tr>

                            <?php } ?>
                        </table>       
                    </div>
                </div>
                
            </div>
        </div>
    </div>

            </div>
        </div>

        <span style="float: left; font-size: 11;font-style: italic; color: #AAAAAA; margin-left: 15 ">
        componentmaintenance 20190211</span>

  </main>
   
    <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  
      $(document).ready(function(){

        
  
                 $("#btnsave").click(function() {
 
            if (document.getElementById("txtcomponentcode").value == ''){
                $('#txtcomponentcode').focus();
                return;
            }

            else if (document.getElementById("txtdescription").value == '') {
                $('#txtdescription').focus();
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
                    
                    document.getElementById("txtcomponentcode").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("success1").removeAttribute("hidden");
                }

                else {
                    document.getElementById("txtcomponentcode").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error1").removeAttribute("hidden");
                }

               
               
              }
            };

            xmlhttp.open("GET", "../php/kanban_addcomponent.php?ComponentCode="+ document.getElementById("txtcomponentcode").value+"&Description="+ document.getElementById("txtdescription").value, true);
            xmlhttp.send();

                }
            
        });


                  $("#btnadd").click(function() {
                    document.getElementById("txtcomponentcode").disabled = false;
                    document.getElementById("txtdescription").disabled = false;
                    $("#txtcomponentcode").focus();
                });


                  $("#btncancel").click(function(){
                    document.getElementById("txtcomponentcode").value = '';
                    document.getElementById('txtdescription').value = '';
                    document.getElementById("txtcomponentcode").disabled = true;
                    document.getElementById("txtdescription").disabled = true;

                  });



});
    

</script>

