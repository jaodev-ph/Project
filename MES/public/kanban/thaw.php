 <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">



<div class=" mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop " >
 

   <div id = "success1" name = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Success!</strong> Solder Paste/PWB <b id="SerialNumber" name="SerialNumber"></b> successfully Start!</div>
  
   <div id = "error1" name = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Part <b id="SerialNumber" name="SerialNumber"></b> is not pwb/solder paste!</div>

   <div id = "error2" name = "error2" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> DID <b id="SerialNumber" name="SerialNumber"></b> doesn't exist!</div>
   <br />

     <div id = "error3" name = "error3" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> PWB <b id="SerialNumber" name="SerialNumber"></b> not include from database dbo.kanban_thawpwb!</div>
   <br />

    <div id = "error4" name = "error4" class="alert alert-danger alert-dismissible" role="alert" hidden>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Error!</strong> Solder Paste/PWB <b id="SerialNumber" name="SerialNumber"></b> already thaw and bake!</div>
   <br />
  
  
    <div class="row">
      <div class="col-md-3">
           <label>DID:</label>
       </div>
     <div class="col-md-7">
      <input type="text" class="form-control" id="txtdid" name="txtdid" onkeyup="if (event.keyCode == 13)  return false;">
        </div>
</div>


<br />
<div class="row">
        <div class="col-md-3">
           <label>Start Thaw Date:</label>
       </div>
     <div class="col-md-7">
      <input type="text" class="form-control" id="txtstart" name="txtstart" readonly>
        </div>
        </div>
<br />
        <div class="row">
        <div class="col-md-3">
           <label>End Thaw Date:</label>
       </div>
     <div class="col-md-7">
      <input type="text" class="form-control" id="txtend" name="txtend" readonly>
        </div>
        </div>

    
    <br />

  

   

    <div class="row">

      <div class="col-md-3">
      </div>
         <div class="col-md-7">

         <button class="form-btn btn btn-lg btn-success" name="btnthaw" id = "btnthaw" disabled>Start</button>
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
        
       $("#btnreset").click(function() {
         
                    document.getElementById("txtpartno").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("txtcompotype").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtregby").value = '';
                    document.getElementById("txtstatus").value = '';
                    document.getElementById("txtinvoiceno").value = '';
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtline").value = '';
            
                    document.getElementById("txtdid").disabled = false;
                    document.getElementById("btnthaw").disabled = true;
                    document.getElementById("txtstart").value = '';
                    document.getElementById("txtend").value = '';
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                   document.getElementById("error3").setAttribute("hidden","");
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("success1").setAttribute("hidden","");
                   $("#txtdid").focus()
                });



$("#btnthaw").click(function() {

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

                    document.getElementById("txtpartno").value = '';
                    document.getElementById("txtdescription").value = '';
                    document.getElementById("txtcompotype").value = '';
                    document.getElementById("txtqty").value = '';
                    document.getElementById("txtregby").value = '';
                    document.getElementById("txtstatus").value = '';
                    document.getElementById("txtinvoiceno").value = '';
                    document.getElementById("txtdid").value = '';
                    document.getElementById("txtline").value = '';
                    document.getElementById("txtdid").disabled = false;
                    document.getElementById("btnthaw").disabled = true;
                    document.getElementById("txtstart").value = '';
                    document.getElementById("txtend").value = '';
                    document.getElementById("error1").setAttribute("hidden","");
                    document.getElementById("error2").setAttribute("hidden","");
                     document.getElementById("error3").setAttribute("hidden","");
                     document.getElementById("error4").setAttribute("hidden","");

                     document.getElementById("success1").setAttribute("hidden","");
                    document.getElementById("success1").removeAttribute("hidden");
                    $("#txtdid").focus()
                 
                } else {

                }


              }
        };
             xmlhttp.open("GET", "../php/kanban_thawupdate.php?DID="+document.getElementById("txtdid").value+"&EndDate="+document.getElementById("txtend").value+"&StartDate="+document.getElementById("txtstart").value, true);
            xmlhttp.send();
         
                
                 }
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
                //alert(result);
               var res = result.split("_");
                if (res[0].trim() == 'ok'){

                  if(res[7] =='P-PWB' || res[7] =='SP-Solder Paste' || res[7] == 'NM-NAMICS'){
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

                  document.getElementById("txtend").value = res[13];
                  document.getElementById("txtstart").value = res[14];

                  document.getElementById("btnthaw").disabled = false;
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("error3").setAttribute("hidden","");
                   document.getElementById("error4").setAttribute("hidden","");
                   document.getElementById("success1").setAttribute("hidden","");
                  document.getElementById("txtdid").disabled = true;

                  }else{
                  document.getElementById("error2").setAttribute("hidden","");
                   document.getElementById("error3").setAttribute("hidden","");
                   document.getElementById("error4").setAttribute("hidden","");
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("error1").removeAttribute("hidden");
                  document.getElementById("success1").setAttribute("hidden","");
                  }

                 
                }else if(res[0].trim() == 'nohours'){

                  document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("error2").setAttribute("hidden","")
                   document.getElementById("error4").setAttribute("hidden","");
                  document.getElementById("error3").setAttribute("hidden","");
                  document.getElementById("error3").removeAttribute("hidden");
                  document.getElementById("success1").setAttribute("hidden","");
                }else if(res[0].trim() == 'alreadyscan'){

                  document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("error2").setAttribute("hidden","")
                  document.getElementById("error3").setAttribute("hidden","");
                  document.getElementById("success1").setAttribute("hidden","");
                  document.getElementById("error4").setAttribute("hidden","");
                  document.getElementById("error4").removeAttribute("hidden");

                } else {
                  document.getElementById("error1").setAttribute("hidden","");
                  document.getElementById("error3").setAttribute("hidden","");
                  document.getElementById("error2").setAttribute("hidden","");
                  document.getElementById("success1").setAttribute("hidden","");
                  document.getElementById("error4").setAttribute("hidden","");
                  document.getElementById("error2").removeAttribute("hidden");
                }


              }
        };
             xmlhttp.open("GET", "../php/kanban_thawpwb.php?DID="+document.getElementById("txtdid").value, true);
            xmlhttp.send();
          }

          }

        });



});
    

             

  </script>