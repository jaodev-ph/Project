  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
     <?php
     include_once("../classes/batch.php");
     include_once("../classes/linking.php");
        include_once("../classes/logbatch.php");
        include_once("../classes/station.php");
        include_once("../classes/batchrepair.php");
        include_once("../classes/modelroute.php");
        include_once("../classes/defectcatprod.php");
        include_once("../classes/defectprod.php");
       
         $disabled = '';
        $serial = '';
        $location = '';
        $status = '';
        $model = '';
        $createdby = '';
        $sublot ='';
        $pallet ='';
        $ref ='';
        $exist = 'false';


          if(isset($_POST['btnView'])){

          	$exist = Batch::checkExist(trim($_SESSION['account']),$_POST['txtSerial']);

  			if($exist == 'true'){
          $disabled = 'disabled';
          $serial = $_POST['txtSerial'];
          $batch = new Batch(trim($_SESSION['account']),$_POST['txtSerial']);
          $location = $batch->getCurtStage();
          $status = $batch->getStatus();
          $model = $batch->getPartNo();
 
          $createdby = $batch->getLastUpdatedBy();
          $sublot = $batch->getLotno();
          $ref = $batch->getRefno();
            if($batch->getCurtStage() != ""){
             $nextstage = $batch->getCurtStage();
          }else{
            $nextstage ='001';
          }

          $ModelRoute = new ModelRoute();
          $ModelRoute->setAccount(trim($_SESSION['account']));
          $ModelRoute->setStation($location);
          $ModelRoute->setModelNo($model);
          $ModelRoute->getStationDetails2();
          $location = $ModelRoute->getnextstage1(trim($_SESSION['account']),$batch->getPartNo(),$ModelRoute->getFlowsequence());
     	 }else{
     	 	$exist == 'false';
     	 }

        }

     ?>     	
	 <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
	 	<?php if($exist == 'false'){ ?>
	 	<div id = "error1" class="alert alert-danger alert-dismissible" role="alert" hidden>
   		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   		<strong>Error!</strong> Serial is not exist!</div>
		<?php } ?>
      <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Batch</h3>
                        <input type="text" name="txtSerial" value="<?php echo $serial; ?>" class="form-control input-md" <?php echo $disabled; ?> autofocus required>
                    </div>
                </div>
       		<br />
                  <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success emp-btn" name="btnView" <?php echo $disabled; ?>>VIEW</button>
                 
                 
                        <a class="btn btn-warning emp-btn" href="">CLEAR</a>
                  </div>
                </div>
             <br />   
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Batch  Number Details</div>
                    <div class="panel-body">
                          <div class="row">
                            <div class="col-md-3">
                                <label>Model:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" name="txtModel" value="<?php echo $model; ?>" class="form-control input-sm"  readonly><br>
                            </div>
                        
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                                <label>Location:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtLocation" value="<?php echo $location; ?>" name="txtLocation" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                            <div class="row">
                            <div class="col-md-3">
                                <label>Lot Number:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="txtSublot" value="<?php echo strtoupper($sublot); ?>" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                             <div class="row">
                            <div class="col-md-3">
                                <label>Reference Number:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="txtref" value="<?php echo strtoupper($ref); ?>" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Pallet No:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="txtPallet" value="<?php echo $pallet; ?>" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                              <div class="row">
                            <div class="col-md-3">
                                <label>Status:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="txtStatus" value="<?php echo $status; ?>" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                        
                           <div class="row">
                            <div class="col-md-3">
                                <label>Created By:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="txtCreatedBy" value="<?php echo $createdby; ?>" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                  </div>      
              </div>
            </div>
        </div>
         
                <div class="panel panel-primary">
                  <div class="panel-heading">History</div>
                  <div class="panel-body">
                      
                         <div class="table-responsive">
                            <table class="table table-bordered"  id="tbldetails" >
                                <thead>
                                    <tr>
                                        <th class="info">Station</th>
                                        <th class="info">Description</th>
                                        <th class="info">Line</th>
                                        <th class="info">Machine</th>
                                        <th class="info">Status</th>
                                        <th class="info">Last Update</th>
                                        <th class="info">Last Updated By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
                                        if(isset($_POST['btnView'])){
                                        	if($exist == 'true'){
                                          if(strlen($batch->getCardno())>0){

                                            $logs = LogBatch::viewAllLogBatch(trim($_SESSION['account']),$batch->getCardno());

                                            for($i=0;$i<count($logs);$i++){ 
                                            	?>

                                                <tr>
                                                  <td><?php echo $logs[$i]->getCurtstage(); ?></td>
                                                  <td><?php 
                                                  $descrip = new Station();
                                                  $descrip->StationDetails(trim($_SESSION['account']),$logs[$i]->getCurtstage());
                                                  echo $descrip->getDescription(); ?></td>
                                                  <td><?php echo $logs[$i]->getLine(); ?></td>
                                                  <td><?php echo $logs[$i]->getMachine(); ?></td>
                                                  <td><?php echo $logs[$i]->getStatus(); ?></td>
                                                  <td><?php echo $logs[$i]->getLastUpdate(); ?></td>
                                                  <td><?php echo $logs[$i]->getLastUpdatedBy(); ?></td>
                                                </tr>
                                            <?php }
                                          }
                                        }
                                    	}
                                    ?>

                                    <?php ?> 
                                </tbody>
                            </table>
                         </div>
                  </div>    
                  
                </div>
                                <div class="panel panel-primary" style="margin-top:20px;">
                  <div class="panel-heading">Reject Details</div>
                  <div class="panel-body">
                      
                         <div class="table-responsive">
                            <table class="table table-bordered"  id="tbldetails" >
                                <thead>
                                    <tr>
                                        <th class="info">Tracking No</th>
                                        <th class="info">Reject Category</th>
                                        <th class="info">Reject Category Description</th>
                                        <th class="info">Reject Code</th>
                                        <th class="info">Reject Code Description</th>
                                        <th class="info">Location</th>
                                        <th class="info">Details</th>
                                        <th class="info">Remarks</th>
                                        <th class="info">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                        if(isset($_POST['btnView'])){ 
                                        if($exist == 'true'){                    
                                          if(strlen($batch->getCardno())>0){
                                            $logs = BatchRepair::GetAllReject2(trim($_SESSION['account']),$batch->getCardno());
                                            for($i=0;$i<count($logs);$i++){ ?>
                                                <tr>
                                                  <td><?php echo $logs[$i]->getTrackingNo(); ?></td>
                                                  <td><?php echo $logs[$i]->getCategory(); ?></td>
                                                  <td><?php $defect = new DefectCatProd(trim($_SESSION['account']),$logs[$i]->getCategory());
                                                  echo $defect->getDescription(); ?></td>
                                                  <td><?php echo $logs[$i]->getDefect(); ?></td>
                                                  <td>
                                                  	<?php  $defectprod = new DefectCodeProd(trim($_SESSION['account']),$logs[$i]->getDefect());

                                                  	echo $defectprod->getDescription(); ?>

                                                  </td>
                                                  <td><?php echo $logs[$i]->getLocation(); ?></td>
                                                  <td><?php echo $logs[$i]->getDetails(); ?></td>
                                                  <td><?php echo $logs[$i]->getRemarks(); ?></td>
                                                  <td><?php echo $logs[$i]->getStatus()==1?"Repaired":"Pending"; ?></td>
                                                </tr>
                                            <?php }
                                          }
                                        }
                                    }
                                    ?>

                                    <?php ?>
                                </tbody>
                            </table>
                         </div>
                  </div>    
                  
                </div>
                    <div class="panel panel-primary">
                  <div class="panel-heading">Link Serials</div>
                  <div class="panel-body">
                      
                         <div class="table-responsive">
                            <table class="table table-bordered"  id="tbldetails" >
                                <thead>
                                    <tr>
                                        <th class="info">Serialno</th>
                                        <th class="info">Partno</th>
                                        <th class="info">Link Serial</th>
                                        <th class="info">Link Partno</th>
                                        <th class="info">Last Update</th>
                                        <th class="info">Last Updated By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
                                        if(isset($_POST['btnView'])){
                                          if($exist == 'true'){
                                        /*  if(strlen($batch->getCardNo())>0){*/

                                            $logs = Link2::viewAllLinkdetails(trim($_SESSION['account']),$serial);

                                            for($i=0;$i<count($logs);$i++){ 
                                              ?>

                                                <tr>
                                                  <td><?php echo $logs[$i]->getSerialNo(); ?></td>
                                                  <td><?php echo $logs[$i]->getPartno(); ?></td>
                                                  <td><?php echo $logs[$i]->getSerialNoLink(); ?></td>
                                                  <td><?php echo $logs[$i]->getPartNoLink(); ?></td>
                                                  <td><?php echo $logs[$i]->getLastUpdate(); ?></td>
                                                  <td><?php echo $logs[$i]->getLastUpdatedBy(); ?></td>
                                                </tr>
                                            <?php }
                                        /*  }*/
                                        }
                                      }
                                    ?>

                                    <?php ?> 
                                </tbody>
                            </table>
                         </div>
                  </div>    
                  
                </div>


           
            
      </form>
    </div>     
          </div>
        </div>
  </main>