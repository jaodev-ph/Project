
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >

              <?php 
  include_once("../classes/test2.php");
  ?>
             <div class="form-group">
      <ul>
        <li>
        <label for="pwd">Serial Number:</label>
      <input type="text" class="form-control" id="StextSerial" name="StextSerial" onkeypress="if (event.keyCode == 13)  return false;" value="" >
    </li>
    <li>
      <label for="pwd">Card Number :</label>
      <input type="text" class="form-control" id="StextCardNo" name="StextCardNo" onkeypress="if (event.keyCode == 13)  return false;" >
    </li>
    <li>
      <label for="pwd">System 21 :</label>
      <input type="text" class="form-control" id="StextSys21" name="StextSys21" onkeypress="if (event.keyCode == 13)  return false;" >
    </li>
    <li>
      <label for="pwd">Work Order :</label>
      <input type="text" class="form-control" id="StextWorkOrder" name="StextWorkOrder" onkeypress="if (event.keyCode == 13)  return false;" >
    </li>
    <li>
      <label for="pwd">Part No :</label>
      <input type="text" class="form-control" id="StextPartNum" name="StextPartNum" onkeypress="if (event.keyCode == 13)  return false;" >
    </li>
    <li>
      <label for="pwd">Revision :</label>
      <input type="text" class="form-control" id="StextRevision" name="StextRevision" onkeypress="if (event.keyCode == 13)  return false;" >
    </li>
    <li>
      <label for="pwd">Line Code :</label>
      <input type="text" class="form-control" id="StextLineCode" name="StextLineCode" onkeypress="if (event.keyCode == 13)  return false;" >
    </li>
    <li>
      <label for="pwd">Hold Flag :</label>
      <input type="text" class="form-control" id="StextHoldFlag" name="StextHoldFlag"  onkeypress="if (event.keyCode == 13)  return false;" >
    </li>
    <li>
      <label for="pwd">Pack Flag :</label>
      <input type="text" class="form-control" id="StextPackFlag" name="StextPackFlag" onkeypress="if (event.keyCode == 13)  return false;" >
    </li>
  </ul>
</div>

      <div class="form-group">
      <ul>
        <label for="pwd">Ship Flag :</label>
        <input type="text" class="form-control" id="StextShipFlag" name="StextShipFlag" onkeypress="if (event.keyCode == 13)  return false;" >

      <label for="pwd">Rtv Flag :</label>
      <input type="text" class="form-control" id="StextRtvFlag" name="StextRtvFlag" onkeypress="if (event.keyCode == 13)  return false;" >
      <label for="pwd">Status :</label>
      <input type="text" class="form-control" id="StextStatus" name="StextStatus" onkeypress="if (event.keyCode == 13)  return false;" >

      <label for="pwd">Lot Number :</label>
      <input type="text" class="form-control" id="StextLotNum" name="StextLotNum" onkeypress="if (event.keyCode == 13)  return false;" >

      <label for="pwd">Lot Type :</label>
      <input type="text" class="form-control" id="StextLotType" name="StextLotType" onkeypress="if (event.keyCode == 13)  return false;" >

      <label for="pwd">Curt Station :</label>
      <input type="text" class="form-control" id="StextCurtStation" name="StextCurtStation" onkeypress="if (event.keyCode == 13)  return false;" >

      <label for="pwd">Start Time :</label>
      <input type="text" class="form-control" id="StextStartTime" name="StextStartTime" onkeypress="if (event.keyCode == 13)  return false;" >

      <label for="pwd">Last Update :</label>
      <input type="text" class="form-control" id="StextLastUpdate" name="StextLastUpdate" onkeypress="if (event.keyCode == 13)  return false;" >

      <label for="pwd">Last Update By:</label>
      <input type="text" class="form-control" id="StextLastUpdateBy" name="StextLastUpdateBy" onkeypress="if (event.keyCode == 13)  return false;" >
    </ul>
    </div>
    <div class="form-group">
      <ul>
        <button type ="button" class="btn btn-success emp-btn" id ="btnUpdate" name="btnUpdate" style="margin-right:10px;">UPDATE</button>
      </ul>
    </div>






<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">



 $(document).ready(function () {



 $('#btnUpdate').click(function (){

  var serialno =  document.getElementById("StextSerial").value;
  var cardno =  document.getElementById("StextCardNo").value;
  var system21 =  document.getElementById("StextSys21").value;
  var workorder =  document.getElementById("StextWorkOrder").value;
  var partnum =  document.getElementById("StextPartNum").value;
  var revision =  document.getElementById("StextRevision").value;
  var linecode = document.getElementById("StextLineCode").value;
  var holdflag =  document.getElementById("StextHoldFlag").value;
  var packflag =  document.getElementById("StextPackFlag").value;
  var shipflag =  document.getElementById("StextShipFlag").value;
  var rtvflag =  document.getElementById("StextRtvFlag").value;
  var status =  document.getElementById("StextStatus").value;
  var lotnum =  document.getElementById("StextLotNum").value;
  var lottype =  document.getElementById("StextLotType").value;
  var curtstation =  document.getElementById("StextCurtStation").value;
  var starttime =  document.getElementById("StextStartTime").value;
  var lastupdate =  document.getElementById("StextLastUpdate").value;
  var lastupdateby =  document.getElementById("StextLastUpdateBy").value;
  // alert(value1);

   var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               alert(result);
            
              }
            };

            xmlhttp.open("GET", "../php/updatetest.php?value1=" + serialno + "&value2=" + cardno + "&value3=" + system21 + "&value4=" + workorder + "&value5=" + partnum + "&value6=" + revision + "&value7=" + linecode + "&value8=" + holdflag + "&value9=" + packflag + "&value10=" + shipflag + "&value11=" + rtvflag + "&value12=" + status + "&value13=" + lotnum + "&value14=" + lottype + "&value15=" + curtstation + "&value16=" + starttime + "&value17=" + lastupdate + "&value18=" + lastupdateby, true);
            xmlhttp.send();

 });


 });

</script> 

          </div>
        </div>
  </main>
