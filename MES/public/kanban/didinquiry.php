 <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">



<div class=" mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop " >
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
   <br />
      <div class="col-md-2">
           <label>DID:</label>
       </div>
     <div class="col-md-8">
      <input type="text" class="form-control" id="txtdid" name="txtdid" onkeyup="if (event.keyCode == 13)  return false;">
        </div>
    </div>
    <br />

  

   

    <div class="row">

      <div class="col-md-2">
      </div>
         <div class="col-md-8">

         
           <button class="form-btn btn btn-lg btn-danger" name="btnreset" id = "btnreset">RESET</button>



     </div>
</div>
<br />
</div>

 <!-- DID Details -->

    
<div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop" >
      
      
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
                              <label>Line:</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="txtline" id = "txtline" class="form-control input-sm" readonly><br>
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

        <span style="float: left; font-size: 11;font-style: italic; color: #AAAAAA; margin-left: 15 ">
        didinquiry 20190211</span>
        
  </main>


  <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">
  
      $(document).ready(function(){

        
  $("#txtdid").focus();
        //     $("#btnissue").click(function() {

 
        //     if (document.getElementById("txtdid").value == ''){
        //         $('#txtdid').focus();
        //         return;
        //     }
         
        //     else 

        //     {
        //   var xmlhttp = new XMLHttpRequest();
        //     xmlhttp.onreadystatechange = function() {

        //     if (this.readyState == 4 && this.status == 200) {
        //        var result = this.responseText;
        //        var res = result.split(" ");
        //        // alert(result);
        //         if (result.trim() == 'ok'){
                    

        //             document.getElementById("txtpartno").value = '';
        //             document.getElementById("txtipn").value = '';
        //             document.getElementById("txtdescription").value = '';
        //             document.getElementById("txtcompotype").value = '';
        //             document.getElementById("txtqty").value = '';
        //             document.getElementById("txtregby").value = '';
        //             document.getElementById("txtstatus").value = '';
        //             document.getElementById("txtinvoiceno").value = '';
        //             document.getElementById("txtdid").value = '';
        //             document.getElementById("txtmaker").value = '';
        //             document.getElementById("txtmc").value = '';
        //             document.getElementById("txtlotno").value = '';
        //             document.getElementById("cmbline").value = '';
        //             document.getElementById("cmbmodel").value = '';
        //             document.getElementById("error1").setAttribute("hidden","");
        //             document.getElementById("error2").setAttribute("hidden","");
        //             document.getElementById("success1").setAttribute("hidden","");
        //             document.getElementById("success1").removeAttribute("hidden");
        //             document.getElementById("btnissue").disabled = true;
        //             document.getElementById("cmbmodel").disabled = true;
        //             document.getElementById("cmbline").disabled = true;
        //             document.getElementById("txtdid").disabled = false;
        //             $("#txtdid").focus();
        //         }

        //         else {
        //             document.getElementById("txtpartno").value = '';
        //             document.getElementById("txtipn").value = '';
        //             document.getElementById("txtdescription").value = '';
        //             document.getElementById("txtcompotype").value = '';
        //             document.getElementById("txtqty").value = '';
        //             document.getElementById("txtregby").value = '';
        //             document.getElementById("txtstatus").value = '';
        //             document.getElementById("txtinvoiceno").value = '';
        //             document.getElementById("txtdid").value = '';
        //             document.getElementById("txtmaker").value = '';
        //             document.getElementById("txtmc").value = '';
        //             document.getElementById("txtlotno").value = '';
        //             document.getElementById("cmbline").value = '';
        //             document.getElementById("cmbmodel").value = '';
        //             $("#txtdid").focus();
        //             document.getElementById("error2").setAttribute("hidden","");
        //             document.getElementById("success1").setAttribute("hidden","");
        //             document.getElementById("error1").setAttribute("hidden","");
        //             document.getElementById("error1").removeAttribute("hidden"); 
                    
        //              document.getElementById("btnissue").disabled = true;
        //           document.getElementById("cmbmodel").disabled = true;
        //           document.getElementById("cmbline").disabled = true;
        //         }

               
               
        //       }
        //     };

        //     xmlhttp.open("GET", "../php/kanban_issueparts.php?DID="+ document.getElementById("txtdid").value+"&Line="+ document.getElementById("cmbline").value+"&Model="+ document.getElementById("cmbmodel").value+"&IPN="+document.getElementById("txtipn").value+"&Qty="+document.getElementById("txtqty").value+"&Description="+document.getElementById("txtdescription").value+"&Lotno="+ document.getElementById("txtlotno").value, true);
        //     xmlhttp.send();

        //         }
            
        // });


       $("#btnreset").click(function() {
          $("#txtdid").focus()
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("txtcompotype").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtregby").value = '';
                    document.getElementById("txtstatus").value = '';
                    document.getElementById("txtinvoiceno").value = '';
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtline").value = '';
                    document.getElementById("txtipn").value = '';
              
                  
                  document.getElementById("error2").setAttribute("hidden","");
                  
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
                // alert(result);
               var res = result.split("_");
                if (res[0].trim() == 'ok'){
                  document.getElementById("txtpartno").value = res[1];
                  // document.getElementById("txtipn").value = res[2];
                  document.getElementById("txtdescription").value = res[3];
                  // document.getElementById("txtmaker").value = res[4];
                  // document.getElementById("txtmc").value = res[5];
                  // document.getElementById("txtlotno").value = res[6];
                  document.getElementById("txtcompotype").value = res[7];
                  document.getElementById("txtqty").value = res[8];
                  document.getElementById("txtstatus").value = res[9];
                  // document.getElementById("txtregdate").value = res[9];
                  document.getElementById("txtregby").value = res[10];
                  document.getElementById("txtinvoiceno").value = res[11];
                  document.getElementById("txtline").value = res[12];
                  document.getElementById("error2").setAttribute("hidden","");
    

                  $('#cmbline').focus();
                } else {
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("error2").removeAttribute("hidden");
                }


              }
        };
             xmlhttp.open("GET", "../php/kanban_didinquiry.php?DID="+document.getElementById("txtdid").value, true);
            xmlhttp.send();
          }

          }

        });



});
    

             

  </script>