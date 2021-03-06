  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
     <?php
        include_once("../classes/lotnumber.php");
        include_once("../classes/batch.php");
        include_once("../classes/card.php");
        include_once("../classes/loglot.php");
        include_once("../classes/station.php");
        include_once("../classes/repair.php");
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
        $lot = '';
        $batchcount = 0;
        $cardcount = 0;
        $exist = 'false';
        $qty = 0;

          if(isset($_POST['btnView'])){

          	$exist = LotNumber::referencelotcheckExist1(trim($_SESSION['account']),$_POST['txtSerial']);
            $cardcount = Card::getCountSerialByRef(trim($_SESSION['account']),$_POST['txtSerial']);
            $batchcount = Batch::getCountBatchByRef(trim($_SESSION['account']),$_POST['txtSerial']);

  			if($exist == 'true'){
          $disabled = 'disabled';
          $serial = $_POST['txtSerial'];
          $LotNumber = LotNumber::getReferenceDetails(trim($_SESSION['account']),$_POST['txtSerial']);
          $location = $LotNumber[0]->getStage();
          $status = $LotNumber[0]->getStatus();
          $model = $LotNumber[0]->getPartno();
          $qty = $LotNumber[0]->getQuantity();
          $createdby = $LotNumber[0]->getLastUpdatedBy();
          $sublot = $LotNumber[0]->getReference();
          $lot = $LotNumber[0]->getLotno();

          $ModelRoute = new ModelRoute();
          $ModelRoute->setAccount(trim($_SESSION['account']));
    		  $ModelRoute->setStation($LotNumber[0]->getStage());
    		  $ModelRoute->getStationDetails();

          $location = $ModelRoute->getnextstage1(trim($_SESSION['account']),$LotNumber[0]->getPartno(),$ModelRoute->getFlowsequence());
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
                        <h3>Reference Number</h3>
                        <input type="text" name="txtSerial" value="<?php echo $serial; ?>" class="form-control input-md" <?php echo $disabled; ?> autocomplete="off" autofocus required>
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
                    <div class="panel-heading">Serial  Number Details</div>
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
                                <label>Quantity:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtQty" value="<?php echo $qty; ?>" name="txtQty" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                              <div class="row">
                            <div class="col-md-3">
                                <label>Serial Count:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtSerialCount" value="<?php echo $cardcount; ?>" name="txtSerialCount" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                              <div class="row">
                            <div class="col-md-3">
                                <label>Batch Count:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="txtBatchCount" value="<?php echo $batchcount; ?>" name="txtBatchCount" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                            <div class="row">
                            <div class="col-md-3">
                                <label>Lot Number:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="txtlot" value="<?php echo strtoupper($lot); ?>" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                            <div class="row">
                            <div class="col-md-3">
                                <label>Reference Number:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="txtSublot" value="<?php echo strtoupper($sublot); ?>" class="form-control input-sm" readonly><br>
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
                                        <th class="info">Sampling size</th>
                                        <th class="info">Status</th>
                                        <th class="info">Last Update</th>
                                        <th class="info">Last Updated By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
                                        if(isset($_POST['btnView'])){
                                        	if($exist == 'true'){
                                          if(strlen($LotNumber[0]->getLotno())>0){

                                            $logs = Loglot::viewAllLogPass(trim($_SESSION['account']),$LotNumber[0]->getLotno());

                                            for($i=0;$i<count($logs);$i++){ 
                                            	?>

                                                <tr>
                                                  <td><?php echo $logs[$i]->getStation(); ?></td>
                                                  <td><?php 
                                                  $descrip = new Station();
                                                  $descrip->StationDetails(trim($_SESSION['account']),$logs[$i]->getStation());
                                                  echo $descrip->getDescription(); ?></td>
                                                  <td><?php echo $logs[$i]->getSamplingsize(); ?></td>
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
                  <div class="panel-heading">Serial Details</div>
                  <div class="panel-body">
        <div class="row">
         <div class="col-md-12" style="overflow-x: scroll;height:500px;">
          <table class="table table-bordered"  id="tbldetails" >
            <thead>
              <th class="info">Serial Count</th>
              <th class="info">Serial</th>
              <th class="info">Model</th>
              <th class="info">Station</th>
              <th class="info">Lastupdate</th>
              <th class="info">Lastupdated By</th>
            </thead>
            <tbody>
              <?php 
              if(isset($_POST['btnView']))
              {

                include_once("../classes/lotnumber.php");
                    $lotbatchexist = Lotnumber::referencebatchcheckExist(trim($_SESSION['account']),trim($_POST['txtSerial'])); 
                    $lotcardexist = Lotnumber::referencecardcheckExist(trim($_SESSION['account']),trim($_POST['txtSerial']));

                  try{
                   $conn = new Connection();     
                   $conn->open();
                   $counter2 = 1;
                    if ($lotcardexist == 'true'){


                    $dataset = $conn->query("SELECT  a.[cardno],a.[serialno],a.[partno],a.[revision],a.[linecode],a.[status],a.[curtstation],b.[description],a.[starttime],a.[lastupdate],a.[lastupdatedby] FROM dbo.card as a inner join dbo.station as b on a.curtstation = b.station where a.account ='".trim($_SESSION['account'])."' and b.account ='".trim($_SESSION['account'])."' and a.lotno = '".$LotNumber[0]->getLotno()."' order by a.cardno,a.lastupdate");
                   while ($row = $conn->fetch_array($dataset)) {

                    ?><tr>
                      <td><?php echo $counter2; ?></td>
                      <td><?php echo $row['serialno']." ".$row['linecode']; ?></td>
                      <td><?php echo $row['partno']." ".$row['revision']; ?></td>
                      <td><?php echo $row['curtstation'].": ".$row['description']; ?></td>
                      <td><?php echo $row['lastupdate']->format('Y-m-d h:i:s a'); ?></td>
                      <td><?php echo $row['lastupdatedby']; ?></td>
                      </tr><?php

                      $counter2++;
                    }

                     }else{

                  $dataset = $conn->query("SELECT  a.[cardno],a.[batchno],a.[partno],a.[linecode],a.[status],a.[station],b.[description],a.[starttime],a.[lastupdate],a.[lastupdatedby] FROM dbo.batch as a inner join dbo.station as b on a.station = b.station and a.account = b.account where a.account ='".trim($_SESSION['account'])."' and a.lotno = '".$LotNumber[0]->getLotno()."' order by a.cardno,a.lastupdate");
                   while ($row = $conn->fetch_array($dataset)) {

                    ?><tr>
                      <td><?php echo $counter2; ?></td>
                      <td><?php echo $row['batchno']; ?></td>
                      <td><?php echo $row['partno']; ?></td>
                      <td><?php echo $row['station'].": ".$row['description']; ?></td>
                      <td><?php echo $row['lastupdate']->format('Y-m-d h:i:s a'); ?></td>
                      <td><?php echo $row['lastupdatedby']; ?></td>
                      </tr><?php

                      $counter2++;
                    }

                     }

                  }catch(Exception $e){

                  }$conn->close();

                  $count = 0;
                  $counter2 =0;

               

              }

              ?>


            </tbody>
          </table>
        </div>
      </div>
    </div>     
                  
                </div>


           
            
      </form>
    </div>     
          </div>
        </div>
  </main>