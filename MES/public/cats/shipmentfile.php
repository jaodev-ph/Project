<script lang="javascript" src="../assets/js/xlsx.full.min.js"></script>
 

  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
<!--  -->

<?php
include_once("../classes/shipment.php");



?>



     <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
 <div class="panel panel-primary">
                    <div class="panel-heading">Excel File</div>
                    <div class="panel-body">
                             <div class="table-responsive" style="overflow-x: scroll;height:300px;">
                            <table class="table table-bordered"  id="tblreject" >
                                <thead>
                                    <tr>
                                       <th class="info">Items</th>
                                        <th class="info">KanbanNo</th>
                                        <th class="info">ItemCode</th>
                                        <th class="info">Description</th>
                                        <th class="info">Model</th>
                                        <th class="info">FrUser</th>
                                        <th class="info">ReqDate</th>
                                        <th class="info">Qty</th>
                                        <th class="info">TransitDate</th>
                                        <th class="info">ETA</th>
                                        <th class="info">StrLoc</th>
                                        <th class="info">SupplyArea</th>
                                        <th class="info">Remarks</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                                  <label>Choose Excel File</label> 
<div id="wrapper">

                    <!-- <input type="file" name="file" id="file" accept=".xls,.xlsx" onchange="loadFile(event)"> -->
<input type="file" id="input-excel" />
</div>
       
                                </tbody>
                            </table>
                      </div>
                 
                  </div>      
              </div>
            </div>

               <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
              <div class="panel panel-primary" >
                  <div class="panel-heading" >Kanban Shipment</div>
                  <div class="panel-body">
                      <br />
                      <div class="table-responsive" style="overflow-x: scroll;height:500px;">
                            <table class="table table-bordered"  id="tblreject" >
                                <thead>
                                    <tr>
                                       <!--  <th class="info">Items</th> -->
                                        <th class="info">KanbanNo</th>
                                        <th class="info">ItemCode</th>
                                        <th class="info">Description</th>
                                        <th class="info">Model</th>
                                        <th class="info">FrUser</th>
                                        <th class="info">ReqDate</th>
                                        <th class="info">Qty</th>
                                        <th class="info">TransitDate</th>
                                        <th class="info">ETA</th>
                                        <th class="info">StrLoc</th>
                                        <th class="info">SupplyArea</th>
                                        <th class="info">Remarks</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php  $logs = Shipment::B9ShipmentFile();

                                            for($i=0;$i<count($logs);$i++){ 

                                              ?>
                                              <tr>
                                                <!-- <td><?php echo $logs[$i]->getItems(); ?></td> -->
                                                 <td><?php echo $logs[$i]->getKanbanNo(); ?></td>
                                                  <td><?php echo $logs[$i]->getPurOrg(); ?></td>
                                                   <td><?php echo $logs[$i]->getItemDescription(); ?></td>
                                                   <td><?php echo $logs[$i]->getModel(); ?></td>
                                                   <td><?php echo $logs[$i]->getFrUser(); ?></td>
                                                   <td><?php echo $logs[$i]->getReqDate(); ?></td>
                                                   <td><?php echo $logs[$i]->getQty(); ?></td>
                                                   <td><?php echo $logs[$i]->getTransitDate(); ?></td>
                                                   <td><?php echo $logs[$i]->getETA(); ?></td>
                                                   <td><?php echo $logs[$i]->getStrLoc(); ?></td>
                                                   <td><?php echo $logs[$i]->getSupplyArea(); ?></td>
                                                   <td><?php echo $logs[$i]->getRemarks(); ?></td>
                                                   
                                              </tr>
                                            <?php } ?>


                                </tbody>
                            </table>
                      </div>
                  </div>    
      
                </div>
      
          </div>


      </div>
 </form>

<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

 $('#input-excel').change(function(e){
                var reader = new FileReader();
                reader.readAsArrayBuffer(e.target.files[0]);
                reader.onload = function(e) {
                        var data = new Uint8Array(reader.result);
                        var wb = XLSX.read(data,{type:'array'});
                        var htmlstr = XLSX.write(wb,{sheet:"Sheet1", type:'binary',bookType:'html'});
                        $('#wrapper')[0].innerHTML += htmlstr;
                }
        });



  </script>


  <!-- -------------------------------------------------------------------------------------------------------------------------------- -->       
          </div>
        </div>
  </main>
