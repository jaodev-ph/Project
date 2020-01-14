<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
      <?php
      include_once("../classes/lotnumber.php");
      include_once("../classes/loglot.php");
      include_once("../classes/station.php");
      include_once("../classes/card.php");
      include_once("../classes/repair.php");
      include_once("../classes/modelroute.php");
      include_once("../classes/defectcatprod.php");
      include_once("../classes/defectprod.php");
      $disabled = '';
      $serial = '';
      $location = '';
      $status = '';
      $lotstatus = '';
      $model = '';
      $createdby = '';
      $rejectQty = 0;
      $rejectedserial = '';
      $sublot ='';
      $success = false;
      $pallet ='';
      $exist = 'true';
      $try = array();
      $name = trim($_SESSION['name']);
      $qty = 0;
      $Serialexist = false;
      $Serialreject = false;
      $SerialRoute = false;
      //$_POST['rejectserial'.$i] = array();

      if(isset($_POST['btnView'])){
        $exist = LotNumber::lotcheckExist(trim($_SESSION['account']),$_POST['txtSerial']);

        if($exist == 'true'){
          $disabled = 'disabled';
          $serial = $_POST['txtSerial'];
          $LotNumber = new LotNumber(trim($_SESSION['account']),$_POST['txtSerial']);
          $lotstatus = $LotNumber->getStatus();
          if( $lotstatus == 'REJECT'){

            $location = $LotNumber->getStage();
            $status = $LotNumber->getStatus();
            $model = $LotNumber->getPartno();
            $qty = $LotNumber->getQuantity();
            $createdby = $LotNumber->getLastUpdatedBy();
            $sublot = $LotNumber->getReference();

            $ModelRoute = new ModelRoute();
            $ModelRoute->setAccount(trim($_SESSION['account']));
            $ModelRoute->setStation($LotNumber->getStage());
            $ModelRoute->getStationDetails();
            $location = $ModelRoute->getnextstage(trim($_SESSION['account']),$LotNumber->getPartno(),$ModelRoute->getFlowsequence());
            $_SESSION['serial_session'] = $_POST['txtSerial'];  
          }else{

          }
        }else{
          $exist == 'false';
        }
      }

      if(isset($_POST['btnUpdatenew'])){

        $_SESSION['rejectserial_session'] = $_POST['rejectserial'.$i];
        $proceed = false;
        $proceedGood = false;
        $proceedGoodRoute = false;
        $Qas = new ModelRoute();
        $Qas->setAccount(trim($_SESSION['account']));
        $Qas->setModelNo($_POST['txtModel']);
        $Qas->getQASOBAstation();

        $rejectQty = Card::rejectCount(trim($_SESSION['account']),$_SESSION['serial_session']);

        for($i=0;$i<$rejectQty;$i++){
          $Serial = Card::checkExistSerial($_POST['newserial'.$i],trim($_SESSION['account']));
          if($Serial == true){
            $proceed = true;
          }else{
            $Serialexist = true;
            $proceed = false;
            break;
          }
        }
        if($proceed == true){
          for($i=0;$i<$rejectQty;$i++){
            $checkSerial = Card::checkIfSerialIsGood(trim($_SESSION['account']), $_POST['newserial'.$i]);
            if($checkSerial == true){
              $proceedGood = true;
            }else{
              $Serialreject = false;
              $proceedGood = false;
              break;
            }
          }
        }
        if($proceedGood == true){
          for($i=0;$i<$rejectQty;$i++){
            $checkSerialRouteGood = Card::checkSerialRoute($Qas->getStation(), trim($_SESSION['account']), $_POST['newserial'.$i]);
            if($checkSerialRouteGood == true){
              $proceedGoodRoute = true;
            }else{
              $SerialRoute = false;
              $proceedGoodRoute = false;
              break;
            }
          }
        }
        if($proceedGoodRoute == true){
          for($i=0;$i<$rejectQty;$i++){
            $CardUpdate = new Card();
            $CardUpdate->setLotnoNew($_POST['newserial'.$i], $name, trim($_SESSION['account']), $Qas->getStation(), $_SESSION['serial_session']);

            echo "<pre>";
              var_dump($_SESSION['rejectserial_session']);
              echo "</pre>";

            //$CardUpdate->emptyLotno($_POST['rejectserial'.$i], $name, trim($_SESSION['account']));
          }
          $success = true;
        }
      }
      ?>
      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-desktop">
        <?php if($exist == 'false'){ ?>
          <div id = "error1" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Lot is not exist!</div>
          <?php } ?>
          <?php if($success == 'true'){ ?>
            <div id = "success" class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Lot Number is succesfully updated!</div>
            <?php } ?>
            <?php if($Serialexist == 'false'){ ?>
              <div id = "error1" class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> Serial does not exist!</div>
              <?php } ?>
              <?php if($Serialreject == 'false'){ ?>
                <div id = "error1" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> Serial is reject!</div>
                <?php } ?>
                <?php if($SerialRoute == 'false'){ ?>
                  <div id = "error1" class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Serial is not Good!</div>
                  <?php } ?>
                  <form method="post">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Lot Number</h3>
                            <input type="text" name="txtSerial" id="txtSerial" value="<?php echo $serial; ?>" class="form-control input-md" <?php echo $disabled; ?> autofocus required>
                          </div>
                        </div>
                        <br />
                        <div class="row">
                          <div class="col-md-12">
                            <button class="btn btn-success emp-btn" name="btnView" <?php echo $disabled; ?>>VIEW</button>
                            <a class="btn btn-warning emp-btn" href="">CLEAR</a>
                          </div>
                        </div>
                        <br>
                        <?php
                        if(isset($_POST['btnView'])){
                          if($lotstatus == 'REJECT'){
                            $rejectQty = Card::rejectCount(trim($_SESSION['account']),$_POST['txtSerial']);
                            ?>
                            <div class="row">
                              <div class="col-md-6" >
                                <label for="">Qty of Reject : </label>
                                <input type="text" name="qtyReject" id="qtyReject"  class="form-control input-md" disabled="true" value="<?php echo $rejectQty; ?>">
                              </div>
                            </div>
                            <?php
                            $try = Card::showReject(trim($_SESSION['account']),$_POST['txtSerial']);
                            for($i=0;$i<count($try);$i++){
                              ?>
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <label for="rejectserial">Rejected Serial :</label>
                                    <input type="text" class="form-control" id="rejectserial<?php echo $i; ?>" name="rejectserial<?php echo $i; ?>" value ="<?php echo $try[$i]->getSerialno(); ?>" disabled>
                                  </div>
                                  <div class="col-sm-6">
                                    <label for="newserial">New Serial :</label>
                                    <input type="text" name="newserial<?php echo $i; ?>" id="newserial<?php echo $i; ?>" class="form-control" autofocus required>
                                  </div>
                                </div>
                              </div>
                              <?php
                            }
                            ?>
                            <button class="btn btn-success emp-btn" name="btnUpdatenew" id="btnUpdatenew" >UPDATE</button>
                            <?php
                          }else{

                          }
                        }
                        ?>
                        <br />
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
                                <input type="text" name="txtModel" id="txtModel" value="<?php echo $model; ?>" class="form-control input-sm"  readonly><br>
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
                                <th class="info">Status</th>
                                <th class="info">Lastupdate</th>
                                <th class="info">Lastupdated By</th>
                              </thead>
                              <tbody>
                                <?php 
                                if(isset($_POST['btnView'])){
                                  if($lotstatus == 'REJECT'){
                                    try{
                                      $conn = new Connection();     
                                      $conn->open();
                                      $counter2 = 1;
                                      $dataset = $conn->query("SELECT  a.[cardno],a.[serialno],a.[partno],a.[revision],a.[linecode],a.[status],a.[curtstation],b.[description],a.[starttime],a.[lastupdate],a.[lastupdatedby] FROM dbo.card as a inner join dbo.station as b on a.curtstation = b.station where a.account ='".trim($_SESSION['account'])."' and a.lotno = '".$LotNumber->getLotno()."'");
                                      while ($row = $conn->fetch_array($dataset)) {
                                        ?>
                                        <tr>
                                          <td><?php echo $counter2; ?></td>
                                          <td><?php echo $row['serialno']." ".$row['linecode']; ?></td>
                                          <td><?php echo $row['partno']." ".$row['revision']; ?></td>
                                          <td><?php echo $row['curtstation'].": ".$row['description']; ?></td>
                                          <td><?php echo $row['status'] ?></td>
                                          <td><?php echo $row['lastupdate']->format('Y-m-d h:i:s a'); ?></td>
                                          <td><?php echo $row['lastupdatedby']; ?></td>
                                        </tr>
                                        <?php
                                        $counter2++;
                                      }
                                    }catch(Exception $e){

                                    }
                                    $conn->close();
                                    $count = 0;
                                    $counter2 =0;
                                  }
                                }else{

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

                <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
                <script type="text/javascript">

                  $(document).ready(function () {
                    $('#btnUpdatenew').click(function (){
                      var rejectedserialno =  document.getElementById("rejectserial").value;
                      var newserial = document.getElementById("newserial").value;
                      var account = <?php echo trim($_SESSION['account']); ?>;
                      var lastupdatedby = <?php echo $name; ?>;

                      var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          var result = this.responseText;
                          //alert(result);
                        }
                      };

                      xmlhttp.open("GET", "../php/lotsorting1.php?serialno=" + rejectedserialno +"&lastupdatedby="+ lastupdatedby +"&account=" + account, true);
                      xmlhttp.send();
                    });
                  });
                </script> 
              </div>
            </div>
          </main>