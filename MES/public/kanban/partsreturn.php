 <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">



<div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
 <div class="row">

   <div id = "success1" name = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> successfully Returned!</div>
  
    <div id = "error1" name = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> already in Warehouse!</div>

   <div id = "error2" name = "error2" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> DID <b id="SerialNumber" name="SerialNumber"></b> doesn't Exist!</div>

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
           <label>Part Number:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtpartno" name="txtpartno" disabled="">
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
           <label>Supplier Name:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtsupplier" name="txtsupplier" disabled="">
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
           <label>Return Quantity:</label>
       </div>
     <div class="col-md-8">
      <input type="number" class="form-control" id="txtRquantity" name="txtRquantity" disabled>
        </div>
    </div> 

    <br />


<div class="row">
      <div class="col-md-4">
        <label>Reason:</label>
          </div>
            <div class="col-md-8">
              <select   id = "cmbreason" name = "cmbreason" class="form-control  input-sm" disabled>
                <option> </option>
                  <?php
                    include("../classes/kanban_partsrecords.php");
                      $reason = Partsrecords::getAllReason();

                              for ($i=0; $i < count($reason); $i++) { 
                                echo "<option>". $reason[$i]->getReason() ."</option>";
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

          <button class="form-btn btn btn-lg btn-warning" name="btnreturn" id = "btnreturn" disabled>RETURN</button>
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
                              <label>Model:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtmodel" id = "txtmodel" class="form-control input-sm" readonly><br>
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
                              <label>Printed Date:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtpdate" id = "txtpdate" class="form-control input-sm" readonly><br>
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
            $("#btnreturn").click(function() {

 
            if (document.getElementById("txtdid").value == ''){
                $('#txtdid').focus();
                return;
            }

            else if (document.getElementById("txtRquantity").value == '') {
                $('#txtRquantity').focus();
                return;
            }

            else if (document.getElementById("cmbreason").value == '') {
                $('#cmbreason').focus();
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
                    
                    
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("txtipn").value = '';
                    document.getElementById("txtsupplier").value = '';
                    document.getElementById("txtlotno").value = '';
                    document.getElementById("cmbreason").value = '';
                    document.getElementById("txtmodel").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("txtcompotype").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtregby").value = '';
                    document.getElementById("txtstatus").value = '';
                    document.getElementById("txtpdate").value = '';
                    document.getElementById("txtRquantity").value = '';
                    document.getElementById("txtRquantity").disabled = true;
                    document.getElementById("txtdid").disabled = false;
                   
                    document.getElementById("cmbreason").disabled = true;
                    document.getElementById("btnreturn").disabled = true;
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error2").setAttribute("hidden","");
                    document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("success1").removeAttribute("hidden");

                }

                else {
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("txtipn").value = '';
                    document.getElementById("txtsupplier").value = '';
                    document.getElementById("txtlotno").value = '';
                    document.getElementById("cmbreason").value = '';
                    document.getElementById("txtmodel").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("txtcompotype").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtregby").value = '';
                    document.getElementById("txtstatus").value = '';
                    document.getElementById("txtpdate").value = '';
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error2").setAttribute("hidden","");
                    document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("error1").removeAttribute("hidden"); 
                    $("#txtdid").focus();
                }

               
               
              }
            };

            xmlhttp.open("GET", "../php/kanban_returnparts.php?DID="+document.getElementById("txtdid").value+"&Reason="+document.getElementById("cmbreason").value+"&IPN="+document.getElementById("txtipn").value+"&Description="+document.getElementById("txtdescription").value+"&Lotno="+document.getElementById("txtlotno").value+"&Qty="+document.getElementById("txtqty").value+"&Rquantity="+document.getElementById("txtRquantity").value, true);
            xmlhttp.send();

                }
            
        });


                  $("#btnreset").click(function() {
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("txtipn").value = '';
                    document.getElementById("txtsupplier").value = '';
                    document.getElementById("txtlotno").value = '';
                    document.getElementById("cmbreason").value = '';
                    document.getElementById("txtregby").value = '';
                    document.getElementById("txtstatus").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("txtcompotype").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtmodel").value = '';
                    document.getElementById("txtpdate").value = '';
                    document.getElementById("txtdid").disabled = false;
                    $("#txtdid").focus();
                    document.getElementById("txtRquantity").value = '';
                    document.getElementById("txtRquantity").disabled = true;
                    document.getElementById("txtdid").disabled = false;
                    document.getElementById("btnreturn").disabled = true;
                    document.getElementById("cmbreason").disabled = true;
                });



                  $('#txtdid').keyup(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){
 

      if (document.getElementById("txtdid").value == '') { 
          $("#txtdid").focus();    
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
                    document.getElementById("txtsupplier").value = res[3];
                    document.getElementById("txtlotno").value = res[4];
                    document.getElementById("txtregby").value = res[5];
                    document.getElementById("txtstatus").value = res[6];
                    document.getElementById("txtdescription").value = res[7];
                    document.getElementById("txtcompotype").value = res[8];
                    document.getElementById("txtqty").value = res[9];
                    document.getElementById("txtRquantity").value = res[9];
                    document.getElementById("txtmodel").value = res[10];
                    document.getElementById("txtpdate").value = res[11];
                    document.getElementById("txtdid").disabled = true;
                    document.getElementById("btnreturn").disabled = false;
                    document.getElementById("cmbreason").disabled = false;
                    document.getElementById("txtRquantity").disabled = false;
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error2").setAttribute("hidden","");
                    document.getElementById("success1").setAttribute("hidden","");
                    
                  $('#txtRquantity').focus().select();
                } else {
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("success1").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("error2").removeAttribute("hidden"); 
                }


              }
        };
             xmlhttp.open("GET", "../php/kanban_didkeypressreturned.php?DID="+document.getElementById("txtdid").value+"&Partno="+document.getElementById("txtpartno").value+"&IPN="+document.getElementById("txtipn").value+"&Maker="+document.getElementById("txtsupplier").value+"&Lotno="+document.getElementById("txtlotno").value+"&Regby="+document.getElementById("txtregby").value+"&Status="+document.getElementById("txtstatus").value+"&Description="+document.getElementById("txtdescription").value+"&Compotype="+document.getElementById("txtcompotype").value+"&Qty="+document.getElementById("txtqty").value+"&Model="+document.getElementById("txtmodel").value+"&Pdate="+document.getElementById("txtpdate").value, true);
            xmlhttp.send();
          }

          }

        });



});
    

             

  </script>