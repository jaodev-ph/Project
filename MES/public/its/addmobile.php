<?php
include_once("../classes/its_workstation.php");
include_once("../classes/its_additem.php");
include_once("../classes/its_mobile.php");
include_once("../classes/its_brandmodel.php");
include_once("../classes/connection.php");
include_once("../classes/connection2.php");



$lastupdatedby = $_SESSION['name'];


if(isset($_POST['btnaddMobile']))
{

      $its_add = new Its_Mobile();

      $its_add->addMobile($_POST['imeitxt'],$_POST['serialtxt'],$_POST['mobilenotxt'],$_POST['simserialtxt'],$_POST['type'],$_POST['mobilebrand'],$_POST['mobilemodel'],$_POST['mobileiptxt'],$_POST['mobilemactxt'],$_POST['userselect'],$_POST['companyselect'],$_POST['departmentselect'],$_POST['mobilepurpose'],$_POST['statusselect'],$lastupdatedby);

      echo "<script type='text/javascript'>alert('Success');</script>";
}


?>

  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
        
            <div class="container">
              <form method="post">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <label>Mobile IMEI:</label>
                      <input type="text" name="imeitxt" id="imeitxt" class="form-control" maxlength="16" onkeypress="numberOnly(event)" placeholder="Enter IMEI" required>
                    </div>
                    <div class="col-md-6">
                      <label>Serial:</label>
                      <input type="text" name="serialtxt" id="serialtxt" class="form-control" placeholder="Enter Serial" required>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-3">
                      <label>Type:</label>
                      <select class="form-control" name="type" id="type">
                        <option></option>
                        <option>Mobile</option>
                        <option>Tablet</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Sim Serial:</label>
                      <input type="text" name="simserialtxt" id="simserialtxt" class="form-control" placeholder="Enter Sim Serial" required>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <label>Mobile Brand</label>
                    <select class="form-control" name="mobilebrand" id="mobilebrand">
                      <option></option>
                      <?php

                      $selectBrand = Its_Mobile::getAllMobileBrand();
                      for($i=0;$i<count($selectBrand);$i++)
                      {
                        ?>
                        <option value="<?php echo $selectBrand[$i]->getMobileBrand(); ?>"><?php echo $selectBrand[$i]->getMobileBrand(); ?></option>
                      <?php
                       } ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Mobile Model</label>
                    <select class="form-control" name="mobilemodel" id="mobilemodel">
                      <option></option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Mobile Number</label>
                    <input type="text" name="mobilenotxt" id="mobilenotxt" maxlength="11" class="form-control" onkeypress="numberOnly(event)" placeholder="Enter Mobile Number" required>
                  </div>
                </div>
              </div>
              <br>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>IP Address</label>
                    <input type="text" name="mobileiptxt" id="mobileiptxt" class="form-control" maxlength="15" onkeypress="ipAdd(event)" placeholder="Enter IP Address" required>
                  </div>
                  <div class="col-md-6">
                    <label>MAC Address</label>
                    <input type="text" name="mobilemactxt" id="mobilemactxt" class="form-control" placeholder="Enter MAC Address" required>
                  </div>
                </div>
              </div>
              <br>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <label>Dispatch To</label>
                    <select class="form-control" name="userselect" id="userselect">
                      <option></option>
                       <?php

                       $selectUser = Its_Workstation::selectAllUser();
                       for($i=0;$i<count($selectUser);$i++)
                       {
                        ?>
                        <option value="<?php echo $selectUser[$i]->getDispatchTo(); ?>"><?php echo $selectUser[$i]->getDispatchTo(); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Company</label>
                    <select class="form-control" name="companyselect" id="companyselect">
                      <option></option>
                      <option>HQ Calamba</option>
                      <option>Plant 5/6</option>
                      <option>Iomni</option>
                      <option>Logistics Hub</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Department</label>
                    <select class="form-control" name="departmentselect" id="departmentselect">
                      <option></option>
                      <option value="Information Technology">Information Technology</option>
                      <option value="Finance">Finance</option>
                      <option value="Internal Audit">Internal Audit</option>
                      <option value="Accounting">Accounting</option>
                      <option value="Design and Dev Group">Design and Dev Group</option>
                      <option value="NPR">NPR</option>
                      <option value="Warehouse">Warehouse</option>
                      <option value="Human Resource">Human Resource</option>
                      <option value="Facilities">Facilities</option>
                      <option value="Corporate">Corporate</option>
                      <option value="Customer Service and Sales">Customer Service and Sales</option>
                      <option value="Recruitment">Recruitment</option>
                      <option value="Manpower Dev Board">Manpower Dev Board</option>
                      <option value="Supply Chain Management">Supply Chain Management</option>
                      <option value="Admin">Admin</option>
                    </select>
                  </div>
                </div>
              </div>
              <br>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-9">
                    <label>Purpose</label>
                    <input type="text" name="mobilepurpose" id="mobilepurpose" class="form-control" placeholder="Enter Purpose" required>
                  </div>
                  <div class="col-md-3">
                    <label>Status</label>
                    <select class="form-control" name="statusselect" id="statusselect">
                      <option></option>
                      <option value="Healthy">Healthy</option>
                      <option value="For Repair">For Repair</option>
                      <option value="Scrap">Scrap</option>
                      <option value="Spare/Vacant">Spare/Vacant</option>
                    </select>
                  </div>
                </div>
              </div>
              <br>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit"class="btn btn-default btn-lg">Cancel</button> 
                  <button type="submit" id="btnaddMobile" name="btnaddMobile" class="btn btn-success btn-lg pull-right">Save</button> 
                </div>
              </div>
              </form>
            </div>
        </div>
    </div>
</main>


<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

      function numberOnly(evt){

        var ch = String.fromCharCode(evt.which);

        if(!(/[0-9]/.test(ch)))
        {
          evt.preventDefault();
        }
      }

       function ipAdd(evt){

        var ch = String.fromCharCode(evt.which);

        if(!(/[0-9 || .]/.test(ch)))
        {
          evt.preventDefault();
        }
      }

      $(document).ready(function(){


            $('#mobilebrand').change(function (){

                  if (document.getElementById("mobilebrand").value == '') { 
                        document.getElementById("mobilemodel").disabled = true;
                        document.getElementById("mobilemodel").value == '';
                        document.getElementById("mobilemodel").innerHTML = "";
                        return;

          }else {

            document.getElementById("mobilemodel").disabled = false;
            document.getElementById("mobilemodel").innerHTML = "";  
             $('#mobilemodel').focus();
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
                //alert(result);
               var res = result.split("_");
               var x1 = document.getElementById("mobilemodel");
               var option1 = document.createElement("option");
               option1.text = '';
               x1.add(option1);
               for (i = 0; i < res.length - 1; i++) { 
                     
                      var x = document.getElementById("mobilemodel");
                      var option = document.createElement("option");
                      option.text = res[i];
                      x.add(option); 
                    }
              }
            };

            xmlhttp.open("GET", "../php/its_getmobilemodel.php?brand="+ document.getElementById("mobilebrand").value, true);
            xmlhttp.send();
          }


       
           });

       });
</script>

</main>
