<main class="mdl-layout__content mdl-color--grey-100">

        <div class="mdl-grid demo-content">
<span style="color:gray;font-family: verdana;font-size: 25px;font-weight:bold;">REGISTRATION</span>
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >

 <!-- -------------------------------------------------------------------------------------------------------------------------------- --> 

<?php 
include_once("../classes/pmdetails.php");
$readonly = 'readonly';
$date = date("mdyhis");
$id = "PM-$date";

$cmbprodline = "";
$cmbjobtype = "";
$lineid="";
$jobtypeid="";

?>


<div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">

<div class="form-group ">
  <div class="col-md-6">
  <label for="usr">Production Line</label>
    <select class="form-control" id="Scmbprodline" name="Scmbprodline" onchange="prodline(this);" placeholder="Select Line" required="required">
    <option ></option> 
        <?php  
            $selectline = line::getallLine();
            for($i=0;$i<count($selectline);$i++){
          ?>
      <option value='<?php echo $selectline[$i]->getLine(); ?>'<?php if($cmbprodline==$selectline[$i]->getLine()) {echo "selected";} ?> ><?php echo $selectline[$i]->getLine(); ?></option>
          <?php }?>
    </select>
  </div>
  <div class="col-md-6">
  <label for="usr">Job Type</label>
    <select class="form-control" id="Scmbjobtype"  name="Scmbjobtype" onchange="jobtype(this);" placeholder="Select Type" disabled required="required" >
    <option></option> 
          <?php  
            $selecttype = Tasktype::getallTasktype();
            for($i=0;$i<count($selecttype);$i++){
          ?>
      <option value='<?php echo $selecttype[$i]->getTasktype(); ?>' <?php if($cmbjobtype==$selecttype[$i]->getTasktype()) {echo "selected";} ?>><?php echo $selecttype[$i]->getTasktype(); ?></option>
          <?php } ?>
    </select>
  </div>
</div>

<div class="form-group ">
  <div class="col-md-6">
      <label for="usr">Date Start</label>
      <input class="form-control" id="SdateStart" name="SdateStart" type="Date" disabled required="required">
  </div>
  <div class="col-md-6">
      <label for="usr">Date End</label>
      <input class="form-control" id="SdateEnd" name="SdateEnd" type="Date" disabled required="required">
  </div>
</div>

<div class="form-group ">
  <div class="col-md-6">
      <label for="usr">Time Start</label>
      <input class="form-control" id="StimeStart" name="StimeStart" type="time" disabled required="required">
  </div>

  <div class="col-md-6">
      <label for="usr">Time End</label>
      <input class="form-control" id="StimeEnd" name="StimeEnd" type="time" disabled required="required">
  </div>
</div>

<div class="form-group ">
  <div class="col-md-12"><br>
  <button type ="button" class="btn btn-success emp-btn" id ="btnRegister" name="btnRegister" style="margin-right:10px;" disabled>REGISTER</button>
  <button type ="button" class="btn btn-warning emp-btn" id ="btnClear" name="btnClear" onclick="window.location.reload()">CLEAR</button> 
  </div>
</div>

</div>

 <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">

  <div class="panel panel-primary">
    <div class="panel-heading">Registration Details</div>
      <div class="panel-body">
    
    <div class="row">
    <div class="col-md-3">
      <label for="usr">Job Order Id:</label>
    </div>
    <div class="col-md-9">
      <input type="text" id="StxtId" name="StxtId" value="<?php echo $id;?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
      </div>
    </div>

    <div class="row">
    <div class="col-md-3">
      <label for="usr">Line:</label>
    </div>
      <div class="col-md-9">
      <input type="text" id="Stxtline" name="Stxtline" class="form-control input-sm" <?php echo $readonly; ?>><br>
      </div>
    </div>

    <div class="row">
    <div class="col-md-3">
      <label for="usr">Job Type:</label>
    </div>
      <div class="col-md-9">
      <input type="text" id="Stxttype" name="Stxttype"  class="form-control input-sm" <?php echo $readonly; ?>><br>
      </div>
    </div>

    <div class="row">
    <div class="col-md-3">
      <label for="usr">Date Created:</label>
    </div>
    <div class="col-md-9">
      <input type="text" id="txtdatecreated" name="txtdatecreated" value="<?php echo date("m/d/Y");?>" class="form-control input-sm" <?php echo $readonly; ?>><br>
      </div>
    </div>

    <div class="row">
    <div class="col-md-3">
      <label for="usr">Planned By:</label>
    </div>
    <div class="col-md-9">
      <input type="text" id="txtplannedBy" name="txtplannedBy" value="<?php echo ucwords($_SESSION['name']); ?>" class="form-control input-sm" <?php echo $readonly;  ?>><br>
      </div>
    </div>

      </div>
    </div>      
  </div>

  <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
 <div class="panel panel-primary">
    <div class="panel-heading">Production Line Details</div>
      <div class="panel-body">
        <table class="table table-bordered">
        <tr class="info">
                <thead id="linetableheading" name="linetableheading">  
                  
                    <th><label for="usr" style="text-align: center;">Line   </label></th>
                    <th><label for="usr" style="text-align: center;">Jobtype </label></th>   
                    <th><label for="usr" style="text-align: center;">Name   </label></th>   
                    <th><label for="usr" style="text-align: center;">Machineid   </label></th> 
                    <th><label for="usr" style="text-align: center;">Machinetypeid    </label></th>
                    <th><label for="usr" style="text-align: center;">Machinesequence    </label></th>
                    <th><label for="usr" style="text-align: center;">Joblists    </label></th>
                    <th><label for="usr" style="text-align: center;">Jobsequence    </label></th>
                      
                </thead>  

              
              <tbody id="linedetails" name="linedetails">
              
         
              </tbody>
              </tr>
        </table>
      </div>
    </div>
  </div>

</div>

 <!-- -------------------------------------------------------------------------------------------------------------------------------- --> 


          </div>
        </div>
</main>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

  function prodline(line) {
    if (line.selectedIndex > 0) {
    var selectedText = line.options[line.selectedIndex].innerHTML;
    var selectedValue = line.value;
    document.getElementById("Stxtline").value = selectedText;
     } else {
    document.getElementById("Stxtline").value = "";
    }
      }

  function jobtype(type) {
    if (type.selectedIndex > 0) {
    var selectedText = type.options[type.selectedIndex].innerHTML;
    var selectedValue = type.value;
    document.getElementById("Stxttype").value = selectedText;
      } else {
    document.getElementById("Stxttype").value = "";
    }
      }

 $(document).ready(function () {


$('#Scmbprodline').change(function (){
  
  if (document.getElementById("Scmbprodline").value == '') { 

        document.getElementById("Scmbjobtype").disabled = true;
        document.getElementById("Stxtline").value = '';
        document.getElementById("Stxttype").value = '' ;

    return;
      }else{
        document.getElementById("Scmbjobtype").disabled = false ;
       }
    });

$('#Scmbjobtype').change(function (){

      if (document.getElementById("Scmbprodline").value == '') { 

          return;
          }else {

        document.getElementById("SdateStart").disabled = false;
        document.getElementById("SdateEnd").disabled = false;

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var result = this.responseText;
        var res = result.split("&");
               // alert(result);
        for (i = 0; i < res.length - 1; i++) { 
                   
          var lineid = res[i]; 
          var res2 = res[i].split("_");
          $('#linedetails').append("<tr><td>"+res2[0]+"</td><td>"+res2[1]+"</td><td>"+res2[2]+"</td><td>"+res2[3]+"</td><td>"+res2[4]+"</td><td>"+res2[5]+"</td><td>"+res2[6]+"</td><td>"+res2[7]+"</td></tr>")
                    }
              }
            };

            xmlhttp.open("GET", "../php/getpmdetails.php?lineid=" + document.getElementById("Scmbprodline").value+"&jobtypeid="+document.getElementById("Scmbjobtype").value, true);
            xmlhttp.send();
          }
       });

$('#SdateEnd').change(function (){

      if (document.getElementById("SdateEnd").value == '') { 
        document.getElementById("StimeStart").disabled = true ;
        document.getElementById("StimeEnd").disabled = true ;
       return;
      }else{
        document.getElementById("StimeStart").disabled = false ;
        document.getElementById("StimeEnd").disabled = false ;
       }
           });

$('#StimeEnd').change(function (){

      if (document.getElementById("StimeEnd").value == '') { 
        document.getElementById("btnRegister").disabled = true ;
       return;
      }else{
       
        document.getElementById("btnRegister").disabled = false ;
       }
           });

 $('#btnRegister').click(function (){


   var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {

              var result = this.responseText;
              var res = result.split("_"); 
              //alert(result);
              if(res[0].trim() == 'Success'){
              document.getElementById("StxtId").value=res[1];
              document.getElementById("Scmbprodline").value='';
              document.getElementById("Scmbjobtype").value='';
              document.getElementById("SdateStart").value=''; 
              document.getElementById("SdateEnd").value=''; 
              document.getElementById("StimeStart").value='';
              document.getElementById("StimeEnd").value='';     
              document.getElementById("Stxtline").value='';
              document.getElementById("Stxttype").value='';
              document.getElementById("btnRegister").disabled = false;
              $('#Scmbprodline').focus();
              $('#linedetails').empty();
              }
                }
            };

            xmlhttp.open("GET", "../php/pmregistration.php?jobOrder=" + document.getElementById("StxtId").value+"&line="+document.getElementById("Scmbprodline").value+"&jobType="+document.getElementById("Scmbjobtype").value+"&dateStart="+document.getElementById("SdateStart").value+"&dateEnd="+document.getElementById("SdateEnd").value+"&timeStart="+document.getElementById("StimeStart").value+"&timeEnd="+document.getElementById("StimeEnd").value+"&status=Registration", true);
            xmlhttp.send();
           
 });


 });

</script>
