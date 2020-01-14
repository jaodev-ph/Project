
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

<?php


$readonly ="readonly";
$model ="";
$revision ="";
$line ="";
$location ="";
$status = "";
$createdby ="";
$cmbmodel ="";
$cmbline ="";
$qty="";
$partcode ="";


?>

  <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop">
    
   <div id = "success" class="alert alert-success alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Success!</strong> Lot number <b id="SerialNumber" name="SerialNumber"></b> is successfully completed!</div>

   <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Wrong Lot number!</div>

      <div id = "lotnotexist" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot <b id="Serial_Error7" name="Serial_Error7"></b> is not exist!</div>

         <div id = "lotreject" class="alert alert-danger alert-dismissible" role="alert" hidden>
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
   <strong>Error!</strong> Lot <b id="Serial_Error7" name="Serial_Error7"></b> is Reject!</div>




     <form method="POST">
      <div class="col-md-12">    
    <div class="form-group">

      <label for="usr">Lot Number:</label>
      <input type="text" class="form-control" id="StextLotNo" name="StextLotNo" readonly>
    </div>

    <div class="form-group">
      <label for="usr">Reference Number:</label>
      <input type="text" class="form-control" id="StextReferenceno" name="StextReferenceno" onkeypress="if (event.keyCode == 13)  return false;"  >
    </div>

  
    
      <div class="row" >
                    <div class="col-md-12">
                       
                        <button type ="button" class="btn btn-success emp-btn" id ="btnreprint" name="btnreprint" disabled style="margin-right:10px;">Reprint</button>  
                        <button type ="submit" class="btn btn-warning emp-btn" id ="btnCancel" name="btnCancel"  style="margin-right:10px;">Cancel</button>                    
                    </div>
      </div>

</div>

    </div>
    <div class="mdl-cell--top mdl-cell--12-col mdl-cell--6-col-desktop">
      
        <div class="panel panel-primary">
                  <div class="panel-heading">Lot  Number Details</div>
                    <div class="panel-body">
                          <div class="row">
                            <div class="col-md-3">
                                <label>Model:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="lottxtModel" name="lottxtModel" value="<?php echo $model;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          
                          </div>                    
                          <div class="row">
                            <div class="col-md-3">
                                <label>Station:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="lottxtLocation" name="lottxtLocation" value="<?php echo $location;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                             <div class="row">
                            <div class="col-md-3">
                                <label>Partcode:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="lottxtpartcode" name="lottxtpartcode" value="<?php echo $partcode;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                              <div class="row">
                            <div class="col-md-3">
                                <label>Status:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="lottxtStatus" name="lottxtStatus" value="<?php echo $status;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>

                              <div class="row">
                            <div class="col-md-3">
                                <label>Quantity:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="lottxtquantity" name="lottxtquantity" value="<?php echo $qty;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Created By:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" id="lottxtCreatedBy" name="lottxtCreatedBy" value="<?php echo $createdby;?>" class="form-control input-sm" <?php echo $readonly;  ?>><br>
                            </div>
                          </div>
                  </div>      
              </div>
                </div>
    </div>
  
 </form>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">


  $(document).ready(function () {


          $('#StextReferenceno').keyup(function(event){
              var keycode = (event.keyCode ? event.keyCode : event.which);
            var exist = false;

          if(keycode == '13'){

              var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split("_");
               /* alert(result);*/
                if(res[0].trim() == 'success'){
             
                document.getElementById("StextLotNo").value= res[1];
                document.getElementById("lottxtModel").value = res[2];
                document.getElementById("lottxtStatus").value = res[3];
                document.getElementById("lottxtLocation").value = res[4];
                document.getElementById("lottxtpartcode").value = res[5];
                document.getElementById("lottxtquantity").value = res[6];
                document.getElementById("lottxtCreatedBy").value = res[7];

                document.getElementById("btnreprint").disabled = false;

                /*document.getElementById("error1").setAttribute("hidden","");
                document.getElementById("lotnotexist").setAttribute("hidden","");
                document.getElementById("lotreject").setAttribute("hidden","");
                document.getElementById("success").setAttribute("hidden","");
                document.getElementById("success").removeAttribute("hidden");*/ 
                }

                if(res[0].trim() == 'lotnotexist'){
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("lotreject").setAttribute("hidden","");
                   document.getElementById("lotnotexist").setAttribute("hidden","");
                   document.getElementById("lotnotexist").removeAttribute("hidden");         
                 }

                if(res[0].trim() == 'error1'){
                   document.getElementById("lotnotexist").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("lotreject").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("error1").removeAttribute("hidden");         
                 }

                    if(res[0].trim() == 'lotreject'){
                   document.getElementById("lotnotexist").setAttribute("hidden","");
                   document.getElementById("success").setAttribute("hidden","");
                   document.getElementById("error1").setAttribute("hidden","");
                   document.getElementById("lotreject").setAttribute("hidden","");
                   document.getElementById("lotreject").removeAttribute("hidden");         
                 }
                
               }
              
            };

            xmlhttp.open("GET", "../php/lotreference.php?reference=" + document.getElementById("StextReferenceno").value, true);
            xmlhttp.send();
           
          }

          });

           $( "#btnreprint" ).click(function() {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
                var res = result.split("_"); 
/* alert(result);*/
                if(res[0].trim() == 'true'){


                window.open('http://192.168.1.22:30/mes/print/B9_lotPT.php?lot='+document.getElementById("StextLotNo").value+'&ref='+document.getElementById("StextReferenceno").value+'&model='+document.getElementById("lottxtModel").value+'&partcode='+document.getElementById("lottxtpartcode").value+'&qty='+document.getElementById("lottxtquantity").value)  


                document.getElementById("StextLotNo").value = '';
                document.getElementById("StextReferenceno").value = ''; 
                document.getElementById("lottxtModel").value = ''; 
                document.getElementById("lottxtLocation").value = ''; 
                document.getElementById("lottxtpartcode").value = ''; 
                document.getElementById("lottxtStatus").value = ''; 
                document.getElementById("lottxtquantity").value = ''; 
                document.getElementById("lottxtCreatedBy").value = '';

                document.getElementById("StextReferenceno").focus();   

                }else if(res[0].trim() == 'false'){
                
                window.open('http://192.168.1.22:30/mes/print/B9_lotSN.php?lot='+document.getElementById("StextLotNo").value+'&ref='+document.getElementById("StextReferenceno").value+'&model='+document.getElementById("lottxtModel").value+'&partcode='+document.getElementById("lottxtpartcode").value+'&qty='+document.getElementById("lottxtquantity").value)

                document.getElementById("StextLotNo").value = '';
                document.getElementById("StextReferenceno").value = ''; 
                document.getElementById("lottxtModel").value = ''; 
                document.getElementById("lottxtLocation").value = ''; 
                document.getElementById("lottxtpartcode").value = ''; 
                document.getElementById("lottxtStatus").value = ''; 
                document.getElementById("lottxtquantity").value = ''; 
                document.getElementById("lottxtCreatedBy").value = '';
                
                document.getElementById("StextReferenceno").focus(); 

                }
        
              }
            };
            
            xmlhttp.open("GET", "../php/B9_lotreprint.php?lotno="+ document.getElementById("StextLotNo").value +"&reference=" + document.getElementById("StextReferenceno").value, true);
            xmlhttp.send();


             });



//        End----------------------------------------------------------------------------------------------------------------------------------

      });

  </script>  		
          </div>
        </div>
  </main>
