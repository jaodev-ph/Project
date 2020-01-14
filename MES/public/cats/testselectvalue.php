
<main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >

          	<div class="form-group">
          		<label>Value 1</label>
          		<input type="text" class="form-control" id="textSerial" name="textSerial">
          		<button type="button" class="btn btn-success emp-btn" id="btnTest" name="btnTest" style="margin-right: 10px;"> CHECK</button>

          <div class="table-responsive">
                            <table class="table table-bordered"  id="tbldetails" >
                                <thead>
                                    <tr>
                                        <th class="info">Value1</th>
                                        <th class="info">Value2</th>
                                        <th class="info">Value3</th>
                                        <th class="info">Value4</th>
                                        <th class="info">Value5</th>
                                        <th class="info">Value6</th>
                                        <th class="info">Value7</th>
                                        <th class="info">Value8</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<!-- <?php
                                	//include_once("../classes/test2.php");
                                	$array //= Test::SelectAll();
                                	//for($i=0;$i<count($array);$i++){ 
                                            	?>
                                                <tr>
                                                  <td><?php //echo $array[$i]->getValue1(); ?></td>     
                                                  <td><?php //echo $array[$i]->getValue2(); ?></td>
                                                  <td><?php //echo $array[$i]->getValue3(); ?></td>
                                                  <td><?php //echo $array[$i]->getValue4(); ?></td>
                                                  <td><?php //echo $array[$i]->getValue5(); ?></td>
                                                  <td><?php //echo $array[$i]->getValue6(); ?></td>
                                                  <td><?php //echo $array[$i]->getValue7(); ?></td>
                                                </tr>
                                            <?php 
                                    ?> -->
                                </tbody>

			</table>


<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">



 $(document).ready(function () {

 	$('#btnTest').click(function() {

 		var serialno =  document.getElementById("textSerial").value;

 		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;
               var res = result.split('|');
            	
            alert(result);
              }
            };

            xmlhttp.open("GET", "../php/testselect.php?value1=" + serialno, true);
            xmlhttp.send();


 	});
 });
 </script>