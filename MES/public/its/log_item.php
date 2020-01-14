<?php
include_once("../classes/connection.php");
include_once("../classes/its_report.php");



?>

<main class="mdl-layout__content mdl-color--grey-100">
         <?php
         include_once("../classes/its_workstation.php");
         include_once("../classes/connection.php");
         ?>
          <div class="panel panel-primary" >
             <div class="panel-heading" >WORKSTATION</div>
               <div class="panel-body">

               
                <div class="row">
                  <form method ="get">
                  <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Type
                    </span>
                    <select name="filter" id="filter" class="form-control">
                      <option value="">All</option>

                        <option value="WKS">Workstation</option>
                        <option value="LPTP">Laptop</option>
                        <option value="SRVR">Server</option>
                       
                    </select>
                  </div>
                </div>
             <div class="row">
                <div class="col-md-3">
                  <div class="input-group">
                    <input type="text" id ="search" name="search" placeholder="Search" value="<?php if(isset($_GET['myInput'])){echo $_GET['myInput'];} ?>"  class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="btn" class="btn btn-default">Go</button>
                      <a href="?MenuCode=002&SubMenuCode=1" class="btn btn-info" value ="">View All</a>
                    </span>
                  </div>
                </div>
               </div>
               <input type="date" name="bday">
              </form>

              
            
            </div>

                  <div class="table-responsive" style="overflow-x:scroll">
                    <table id="myTable" class="table table-hover table-bordered" align="center" >
                      <thead>
                            <tr class="info">
                              <th  style="color: black" onclick="sortTable(0)">Tracking No.</th>
                              <th  style="color: black" onclick="sortTable(0)">PC Serial</th>
                              <th  style="color: black" onclick="sortTable(1)">Item Serial</th>
                              <th  style="color: black" onclick="sortTable(2)">Description</th>
                              <th  style="color: black" onclick="sortTable(4)">Status</th>
                              <th  style="color: black" onclick="sortTable(4)">Last Update</th>
                              <th  style="color: black" onclick="sortTable(4)">lastupdateBy</th>
                  
                              <!-- <th  style="color: black" onclick="sortTable(4)">Status</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            //start of pagination

                            if(isset($_GET['pageno'])){
                              $pageno = $_GET['pageno'];
                            }else{
                              $pageno = 1;
                            }
                            $filter = (isset($_GET['filter']) && !empty($_GET['filter'])? $_GET['filter'] : '');
                            $search = (isset($_GET['search'])  && !empty($_GET['search'])? $_GET['search'] : '');
                            $totalcount =  Its_Report::getTotalCount($filter);
                            $rowcount = 10;
                            $pagecount = ceil($totalcount/$rowcount);


                              $log = Its_Report::getLogs();
                              for($i = 0; $i < count($log); $i++){  
                            ?>
                            <tr>
                                <td><?php echo $log[$i]->getTrackingNo(); ?></td>
                                <td><?php echo $log[$i]->getPcserial(); ?></td>
                                <td><?php echo $log[$i]->getItemserial(); ?></td>
                                <td><?php echo $log[$i]->getDesc(); ?></td>  
                                <td><?php echo $log[$i]->getStatus(); ?></td>
                                <td><?php echo $log[$i]->getLastupdate(); ?></td>
                                <td><?php echo $log[$i]->getLastupdatedby(); ?></td>

                            </tr>       
                   <?php 
                      }
                   ?>

            

                  </tbody>
                </table>
             </div>
          </div>
        </div>
     </div>


     

</main>      



<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>