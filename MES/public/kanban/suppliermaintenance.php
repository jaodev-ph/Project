<main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >



    <div class="container main-cont">

    <div id = "success1" name = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Supplier <b id="SerialNumber" name="SerialNumber"></b> successfully added!</div>
    <div id = "error1" name = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Supplier <b id="SerialNumber" name="SerialNumber"></b> Already Exist!</div>

        <div class="row">
            <div class="col-md-4">
                
                    <div class="form-group">
                        <label>Supplier:</label>
                        <input type="text" class="form-control" id = "txtmaker" name = "txtmaker" disabled>
                    </div>
         
            
                <div class="form-group">
                   
                        <button class="form-btn btn btn-lg btn-success" type = "button" id = "btnadd" name = "btnadd" >Add</button>
                        <button class="form-btn btn btn-lg btn-info" type = "button" id = "btnsave" name = "btnsave">Save</button>
                        <button class="form-btn btn btn-lg btn-warning" id = "btncancel">Cancel</button>
                    </div>
                </div>
          
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Supplier Details</div>
                    <div class="panel-body" style="overflow: scroll; height: 350px;">
                        <table class="table table-bordered">
                        <tr class="info">
                            <th class="text-center">Account</th>
                            <th class="text-center">Supplier</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Lastupdatedby</th>
                        </tr>

                        <?php
                         include("../classes/kanban_makerlist.php");
                         $maker = Makerlist::getAllMaker($_SESSION['account']);

                         for($i=0;$i<count($maker);$i++){
                        ?>

                        <tr>
                            <td><?php echo $maker[$i]->getAccount(); ?></td>
                            <td><?php echo $maker[$i]->getMaker(); ?></td>
                            <td><?php echo $maker[$i]->getActive(); ?></td>
                            <td><?php echo $maker[$i]->getLastupdatedby(); ?></td>
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
  </main>
   
    <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  
      $(document).ready(function(){

        
  
        $("#btnsave").click(function() {
 
            if (document.getElementById("txtmaker").value == '') {
                $('#txtmaker').focus();
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
                    
                    document.getElementById("txtmaker").value = '';
                    document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("success1").removeAttribute("hidden");
                }

                else {
                    $("#txtmaker").focus();
                    document.getElementById("txtmaker").value = '';
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error1").removeAttribute("hidden");
                }

               
               
              }
            };

            xmlhttp.open("GET", "../php/kanban_addmaker.php?Maker="+ document.getElementById("txtmaker").value, true);
            xmlhttp.send();

                }
            
        });


                  $("#btnadd").click(function() {
                    document.getElementById("txtmaker").disabled = false;
                    $("#txtmaker").focus();
                });

                  $("#btncancel").click(function(){
                    document.getElementById('txtmaker').value = '';
                    document.getElementById("txtmaker").disabled = true;
                  });



});
    

             

  </script>