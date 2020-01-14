 <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">



<div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
 <div class="row">

   <div id = "success1" name = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> successfully issued!</div>
  
   <div id = "error1" name = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> already issued in Production!</div>

   <div id = "error2" name = "error2" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> DID <b id="SerialNumber" name="SerialNumber"></b> doesn't exist!</div>

   <div id = "error3" name = "error3" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Solder Paste/PWB<b id="SerialNumber" name="SerialNumber"></b> is not ready to issued!</div>

      <div class="col-md-4">
           <label>DID:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtdid" name="txtdid" onkeyup="if (event.keyCode == 13)  return false;">
        </div>
    </div>
    <br />

    <div class="row">
      <div class="col-md-4">
           <label>Ionics PN:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtipn" name="txtipn" disabled="">
        </div>
    </div>  
    <br />  

     <div class="row">
      <div class="col-md-4">
           <label>Supplier:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtmaker" name="txtmaker" disabled="">
        </div>
    </div>  
    <br />  

    <div class="row">
      <div class="col-md-4">
           <label>Maker code:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtmc" name="txtmc" disabled="">
        </div>
    </div>  
    <br />  

     <div class="row">
      <div class="col-md-4">
           <label>Lot number:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtlotno" name="txtlotno" disabled>
        </div>
    </div>  
    <br />  


    <div class="row">
      <div class="col-md-4">
                                <label>Line:</label>
                            </div>
                            <div class="col-md-8">
                            <select   id = "cmbline" name = "cmbline" class="form-control  input-sm" disabled>
                            <option> </option>
                            <?php
                              include("../classes/line.php");

                              $line = Line::SelectAllLine($_SESSION['account'], $_SESSION['module']);

                              for ($i=0; $i < count($line); $i++) { 
                                echo "<option>". $line[$i]->getLine() ."</option>";
                              }

                            ?>
                        </select>
                      </div>
    </div>
    <br />

<div class="row">
      <div class="col-md-4">
                            <label>Model:</label>
                            </div>
                            <div class="col-md-8">
                            <select   id = "cmbmodel" name = "cmbmodel" class="form-control  input-sm" disabled>
                            <option> </option>
                            <?php
                              include("../classes/kanban_partsrecords.php");

                              $model = Partsrecords::modelSequence(trim($_SESSION['account']));

                              for ($i=0; $i < count($model); $i++) {
                                echo "<option>". $model[$i]->getModel() ."</option>";
                              }


                            ?>
                        </select>
                      </div>
    </div>
    <br />


   

    <div class="row">

      <div class="col-md-4">
      </div>
         <div class="col-md-8">

          <button class="form-btn btn btn-lg btn-success" name="btnissue" id = "btnissue" disabled>ISSUE</button>
           <button class="form-btn btn btn-lg btn-danger" name="btnreset" id = "btnreset">RESET</button>

     </div>
</div>
</div>

 <!-- DID Details -->
    
<div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop" >
      
      
                      <div class="panel panel-primary">
                        <div class="panel-heading">DID Details</div>
                        <div class="panel-body">

                          <div class="row">
                            <div class="col-md-4">
                              <label>Part number:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtpartno" id = "txtpartno" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              <label>Description:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtdescription" id = "txtdescription" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                           <div class="row">
                            <div class="col-md-4">
                              <label>Component type:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtcompotype" id = "txtcompotype" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                           <div class="row">
                            <div class="col-md-4">
                              <label>Quantity:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtqty" id = "txtqty" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              <label>Registered By:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtregby" id = "txtregby" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                          <!-- <div class="row">
                            <div class="col-md-4">
                              <label>Registered Date:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtregdate" id = "txtregdate" class="form-control input-sm" readonly><br>
                            </div>
                          </div> -->
                          <div class="row">
                            <div class="col-md-4">
                              <label>Status:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtstatus" id = "txtstatus" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <label>Invoice number:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtinvoiceno" id = "txtinvoiceno" class="form-control input-sm" readonly><br>
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

        
  $("#txtdid").focus();
            $("#btnissue").click(function() {

 
            if (document.getElementById("txtdid").value == ''){
                $('#txtdid').focus();
                return;
            }


            else if (document.getElementById("cmbline").value == '') {
                $('#cmbline').focus();
                return;
            }

            else if (document.getElementById("cmbmodel").value == '') {
                $('#cmbmodel').focus();
                return;
            }

           

            else 

            {
          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split(" ");
               // alert(result);
                if (result.trim() == 'ok'){
                    

                    document.getElementById("txtpartno").value = '';
                    document.getElementById("txtipn").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("txtcompotype").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtregby").value = '';
                    document.getElementById("txtstatus").value = '';
                    document.getElementById("txtinvoiceno").value = '';
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtmaker").value = '';
                    document.getElementById("txtmc").value = '';
                    document.getElementById("txtlotno").value = '';
                    document.getElementById("cmbline").value = '';
                    document.getElementById("cmbmodel").value = '';
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error2").setAttribute("hidden","");
                    document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("success1").removeAttribute("hidden");
                    document.getElementById("error3").setAttribute("hidden","");
                    document.getElementById("btnissue").disabled = true;
                    document.getElementById("cmbmodel").disabled = true;
                    document.getElementById("cmbline").disabled = true;
                    document.getElementById("txtdid").disabled = false;
                    $("#txtdid").focus();
                }

                else {
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("txtipn").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("txtcompotype").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtregby").value = '';
                    document.getElementById("txtstatus").value = '';
                    document.getElementById("txtinvoiceno").value = '';
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtmaker").value = '';
                    document.getElementById("txtmc").value = '';
                    document.getElementById("txtlotno").value = '';
                    document.getElementById("cmbline").value = '';
                    document.getElementById("cmbmodel").value = '';
                    $("#txtdid").focus();
                    document.getElementById("error2").setAttribute("hidden","");
                    document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error1").removeAttribute("hidden"); 
                    document.getElementById("error3").setAttribute("hidden","");
                    
                     document.getElementById("btnissue").disabled = true;
                  document.getElementById("cmbmodel").disabled = true;
                  document.getElementById("cmbline").disabled = true;
                }

               
               
              }
            };

            xmlhttp.open("GET", "../php/kanban_issueparts.php?DID="+ document.getElementById("txtdid").value+"&Line="+ document.getElementById("cmbline").value+"&Model="+ document.getElementById("cmbmodel").value+"&IPN="+document.getElementById("txtipn").value+"&Qty="+document.getElementById("txtqty").value+"&Description="+document.getElementById("txtdescription").value+"&Lotno="+ document.getElementById("txtlotno").value, true);
            xmlhttp.send();

                }
            
        });


                  $("#btnreset").click(function() {
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("txtcompotype").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtregby").value = '';
                    document.getElementById("txtstatus").value = '';
                    document.getElementById("txtinvoiceno").value = '';
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtmaker").value = '';
                    document.getElementById("txtmc").value = '';
                     document.getElementById("txtlotno").value = '';
                    document.getElementById("cmbline").value = '';
                    document.getElementById("cmbmodel").value = '';
                    document.getElementById("txtipn").value = '';
                    $("#txtdid").focus();
                    document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("success1").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("error3").setAttribute("hidden","");
                   document.getElementById("btnissue").disabled = true;
                  document.getElementById("cmbmodel").disabled = true;
                  document.getElementById("cmbline").disabled = true;
                  document.getElementById("txtdid").disabled = false;
                });



                  $('#txtdid').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){
 

      if (document.getElementById("txtdid").value == '') {     
          return;
        }else {
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;
               var res = result.split("_");
               // alert(result);
                if (res[0].trim() == 'ok'){
                  document.getElementById("txtpartno").value = res[1];
                  document.getElementById("txtipn").value = res[2];
                  document.getElementById("txtdescription").value = res[3];
                  document.getElementById("txtmaker").value = res[4];
                  document.getElementById("txtmc").value = res[5];
                  document.getElementById("txtlotno").value = res[6];
                  document.getElementById("txtcompotype").value = res[7];
                  document.getElementById("txtqty").value = res[8];
                  document.getElementById("txtstatus").value = res[9];
                  // document.getElementById("txtregdate").value = res[9];
                  document.getElementById("txtregby").value = res[10];
                  document.getElementById("txtinvoiceno").value = res[11];
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("success1").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("error3").setAttribute("hidden","");
                  document.getElementById("btnissue").disabled = false;
                  document.getElementById("cmbmodel").disabled = false;
                  document.getElementById("cmbline").disabled = false;
                  document.getElementById("txtdid").disabled = true;

                  $('#cmbline').focus();

                }else if (res[0].trim() == 'notready'){
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("success1").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("error3").setAttribute("hidden","");
                  document.getElementById("error3").removeAttribute("hidden");
                } else {
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("success1").setAttribute("hidden","");
                  document.getElementById("error3").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("error2").removeAttribute("hidden");
                }


              }
        };
             xmlhttp.open("GET", "../php/kanban_didkeypress.php?DID="+document.getElementById("txtdid").value+"&Partno="+document.getElementById("txtpartno").value+"&Maker="+ document.getElementById("txtmaker").value+"&Makercode="+ document.getElementById("txtmc").value+"&Description="+ document.getElementById("txtdescription").value+"&Compotype="+ document.getElementById("txtcompotype").value+"&Lotno="+ document.getElementById("txtlotno").value+"&Qty="+ document.getElementById("txtqty").value+"&Invoiceno="+ document.getElementById("txtinvoiceno").value+"&Status="+ document.getElementById("txtstatus").value+"&Printedby="+ document.getElementById("txtregby").value+"&IPN="+document.getElementById("txtipn").value, true);
            xmlhttp.send();
          }

          }

        });



});
    

             

  </script>