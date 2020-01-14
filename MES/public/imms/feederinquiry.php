<?php  
 
  $feederId = '';
  $feederType = '';
  $feederSize = '';
  $feederDescription = '';
  $plantNoFeeder ='';
  $line='';
  $status='';
  $disabled = 'disabled';
  $mode = 'inquiry';

  if(isset($_POST['btnView'])){
      $feederId = $_POST['feederId'];
      include_once("../classes/feeder_maintenance.php");
      $feeder = new Maintenance($feederId,$mode);
      $feederId = $feeder->getfeederId();
      $feederType = $feeder->getfeederType();
      $feederSize = $feeder->getfeederSize();
      $feederDescription = $feeder->getfeederDescription();
      $plantNoFeeder = $feeder->getplantNoFeeder();
      $line = $feeder->getline();
      $status = $feeder->getstatus();
      $disabled='';
  }
  else if(isset($_POST['btnView'])=='')
  {
    $feederId = '';
  }
?>

  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >      
   <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
      <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Feeder</h3>
                        <input type="text" id ="feederId" name="feederId" value="<?php echo $feederId; ?>" class="form-control input-md" autofocus required>
                    </div>
                </div>
          <br />
                  <div class="row">
                    <div class="col-md-12">
                        <a href="?id=<?php echo $_POST['feederId']; ?>"><button class="btn btn-success emp-btn" name="btnView">VIEW</button></a>
                 
                        <a class="btn btn-warning emp-btn" href="">CLEAR</a>
                  </div>
                </div>
             <br />   
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Feeder Details</div>
                    <div class="panel-body">
                          <div class="row">
                            <div class="col-md-3">
                                <label>Feeder Type:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" name="feederType" value="<?php echo $feederType; ?>" class="form-control input-sm"  readonly><br>
                            </div>
                        
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                                <label>Feeder Size:</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" id="feederSize" value="<?php echo $feederSize; ?>" name="txtLocation" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                            <div class="row">
                            <div class="col-md-3">
                                <label>Current location:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="feederDescription" value="<?php echo $feederDescription; ?>" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Plant No(Feeder):</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="plantNoFeeder" value="<?php echo $plantNoFeeder; ?>" class="form-control input-sm" readonly><br>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-md-3">
                                <label>Line:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="line" value="<?php echo $line; ?>" class="form-control input-sm" readonly><br>
                            </div>
                          </div>

                              <div class="row">
                            <div class="col-md-3">
                                <label>Status:</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="status" value="<?php echo $status; ?>" class="form-control input-sm" readonly><br>
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
                                        <th class="info">Status</th> 
                                        <th class="info">Endorsed By(Feeder)</th>
                                        <th class="info">Received By(Feeder)</th>
                                        <th class="info">Endorsed By(Issuance)</th>
                                        <th class="info">Received By(Issuance</th>
                                        <th class="info">Last Updated By</th>
                                        <th class="info">Last Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php include_once("../classes/feeder_getdata.php");
                                      $feeder = Getdata::getHistory($feederId);
                                        for ($i=0; $i < count($feeder); $i++) 
                                          { 
                                            /*echo "<td>".$feeder[$i]->getfeederId()."</td>";*/
                                    ?>
                                  <tr>    
                                            <td><?php echo $feeder[$i]->getfeederDescription(); ?></td>
                                            <td><?php echo $feeder[$i]->getstatus(); ?></td>
                                            <td><?php echo $feeder[$i]->getendorsedByFeeder(); ?></td>
                                            <td><?php echo $feeder[$i]->getreceivedByFeeder(); ?></td>
                                            <td><?php echo $feeder[$i]->getendorsedByIssuance(); ?></td>
                                            <td><?php echo $feeder[$i]->getreceivedByIssuance(); ?></td>
                                            <td><?php echo $feeder[$i]->getlastupdatedBy(); ?></td>
                                            <td><?php echo $feeder[$i]->getlastupdate(); ?></td>
                                    <?php } ?>
                                  </tr>
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
                                        <th class="info">Station:</th>
                                        <th class="info">Defect:</th>
                                        <th class="info">Action Taken:</th>
                                        <th class="info">Parts Replaced:</th>
                                        <th class="info">Repaired By:</th>
                                        <th class="info">Last Update</th>

                                    </tr>
                                </thead>
                                   <?php include_once("../classes/feeder_getdata.php");
                                      $feeder = Getdata::getRejHistory($feederId);
                                        for ($i=0; $i < count($feeder); $i++) 
                                          { 
                                            /*echo "<td>".$feeder[$i]->getfeederId()."</td>";*/
                                    ?>
                                  <tr>    
                                            <td><?php echo $feeder[$i]->getfeederDescription(); ?></td>
                                            <td><?php echo $feeder[$i]->getdefect(); ?></td>
                                            <td><?php echo $feeder[$i]->getdefectDetails(); ?></td>
                                            <td><?php echo $feeder[$i]->getpartsReplaced(); ?></td>
                                            <td><?php echo $feeder[$i]->getlastupdatedBy(); ?></td>
                                            <td><?php echo $feeder[$i]->getlastupdate(); ?></td>
                                    <?php } ?>
                                  </tr>
                                <tbody>
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