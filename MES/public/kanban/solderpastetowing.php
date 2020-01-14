  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<?php

 $disable = '';

if (trim($_SESSION['account']) == 'A3') {
  $disable = '';
} else {
  $disable = 'disabled';
}

?>

<div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
<div id = "success1" name = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> successfully added!</div>
   <div id = "error1" name = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> doesn't Exist.</div>


  <div class="row">
 
      <div class="col-md-4">
           <label>Part number:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtpartno" name="txtpartno" onkeyup="if (event.keyCode == 13)  return false;">
        </div>

    </div>
     <br />

     <div class="row">
 
      <div class="col-md-4">
           <label>Ionics PN:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtipn" name="txtipn">
        </div>


    </div>
    <br />

        <div class="row">
 
      <div class="col-md-4">
           <label>DID:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtdid" name="txtdid">
        </div>


    </div>
    <br />

      <div class="row">
 
      <div class="col-md-4">
           <label>Lot number:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtlotno" name="txtlotno">
        </div>

    </div>
     <br />

      <div class="row">
 
      <div class="col-md-4">
           <label>Quantity:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtqty" name="txtqty">
        </div>

    </div>
     <br />

      <div class="row">
 
      <div class="col-md-4">
           <label>Invoice number:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtinvoiceno" name="txtinvoiceno">
        </div>

    </div>
     <br />

 <div class="row">

      <div class="col-md-4">
      </div>
         <div class="col-md-8">

          <button class="form-btn btn btn-lg btn-success" name="btnregister" id = "btnregister">REGISTER</button>
           <button class="form-btn btn btn-lg btn-danger" name="btnreset" id = "btnreset">RESET</button>

     </div>
</div>



</div>
<div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop" >
      
      
                      <div class="panel panel-primary">
                        <div class="panel-heading">Parts Details</div>
                        <div class="panel-body">
                             <div class="row">
                             
                                  <div class="col-md-4">
                                                        <label>Supplier:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                        <select   id = "cmbmaker" name = "cmbmaker" class="form-control  input-sm" disabled="">
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

                                </div>
                                <br />


                                <div class="row">
                             
                                  <div class="col-md-4">
                                       <label>Maker code:</label>
                                   </div>
                                 <div class="col-md-8">
                                  <input type="text" class="form-control" id="txtmakercode" name="txtmakercode" <?php echo $disable;?>>
                                    </div>

                                </div>
                                 <br />

                                 <div class="row">
                             
                                  <div class="col-md-4">
                                       <label>Description:</label>
                                   </div>
                                 <div class="col-md-8">
                                  <input type="text" class="form-control" id="txtdescription" name="txtdescription" disabled>
                                    </div>

                                </div>
                                 <br />

                                 <div class="row">
                             
                                  <div class="col-md-4">
                                                        <label>Component type:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                        <select   id = "cmbcompotype" name = "cmbcompotype" class="form-control  input-sm"  disabled>
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

                                </div>
                                <br />
                          
                        </div>      
                      </div>
              
                  
</div>

            </div>
        </div>
  </main>


   <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  
      $(document).ready(function(){

        
  
            $("#btnregister").click(function() {
 
            if (document.getElementById("txtpartno").value == ''){
                $('#txtpartno').focus();
                return;
            }

            else if (document.getElementById("txtipn").value == ''){
                $('#txtipn').focus();
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

            else if (document.getElementById("txtdid").value == '') {
                $('#txtdid').focus();
                return;
            }

            else if (document.getElementById("txtlotno").value == '') {
                $('#txtlotno').focus();
                return;
            }

            else if (document.getElementById("txtqty").value == '') {
                $('#txtqty').focus();
                return;
            }

              else if (document.getElementById("txtinvoiceno").value == '') {
                $('#txtinvoiceno').focus();
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
                
                    document.getElementById("txtipn").value = '';
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("cmbmaker").value = '';
                    document.getElementById("txtmakercode").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("cmbcompotype").value = '';
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtlotno").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtinvoiceno").value = '';
                    document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("success1").removeAttribute("hidden");

                }

                else {
                    alert("asdasdasdasd");
                }

               
               
              }
            };

            xmlhttp.open("GET", "../php/kanban_registerparts.php?Partno="+document.getElementById("txtpartno").value+"&IPN="+document.getElementById("txtipn").value+"&Maker="+ document.getElementById("cmbmaker").value+"&Makercode="+ document.getElementById("txtmakercode").value+"&Description="+ document.getElementById("txtdescription").value+"&Compotype="+ document.getElementById("cmbcompotype").value+"&DID="+ document.getElementById("txtdid").value+"&Lotno="+ document.getElementById("txtlotno").value+"&Qty="+ document.getElementById("txtqty").value+"&Invoiceno="+ document.getElementById("txtinvoiceno").value, true);
            xmlhttp.send();

                }
            
        });


                  $("#btnreset").click(function() {
                    document.getElementById("txtipn").value = '';
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("cmbmaker").value = '';
                    document.getElementById("txtmakercode").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("cmbcompotype").value = '';
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtlotno").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtinvoiceno").value = '';
                    $("#txtpartno").focus();
                });



                  $('#txtpartno').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){
 

      if (document.getElementById("txtpartno").value == '') {     
          return;
        }else {
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;
               var res = result.split("_");
              
                if (res[0].trim() == 'ok'){
                   document.getElementById("txtpartno").value = res[1];
                   document.getElementById("cmbmaker").value = res[3];
                   document.getElementById("txtdescription").value = res[2];
                   document.getElementById("cmbcompotype").value = res[4]; 
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("success1").setAttribute("hidden","");
                   $('#txtmakercode').focus();
                } else if (res[0].trim() == 'notexist'){
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("error1").removeAttribute("hidden");
                  document.getElementById('txtpartno').value = '';
                  $('#txtpartno').focus();
                }

              } 
        };
             xmlhttp.open("GET", "../php/kanban_pnkeypress.php?Partno="+document.getElementById("txtpartno").value+"&Maker="+ document.getElementById("cmbmaker").value+"&Description="+ document.getElementById("txtdescription").value+"&Compotype="+ document.getElementById("cmbcompotype").value, true);
            xmlhttp.send();
          } 

          }

        });



});
    

             

  </script>