




<?php
$active =0;

?>





<main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >
        	
            <div class="w3-container">
		 	 <div class="card-panel hoverable">
        <div class="row">
           <div class="col-md-12">
            <form method="post" action="main.php">
            	<h1>Factory</h1>
            		<p>Please fill in the form below to add/edit.</p>
            		<hr>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Factory:</b></h5></label><input type="text"  name="mode" class="form-control" style='display:none;'><br>
                        <select class="form-control">
                        	<option selected="selected" disabled="">Factory</option>
                        	<option>Factory 1</option>
                        	<option>Factory 2</option>
                        	<option>Factory 3</option>
                        	<option>Factory 4</option>
                        	<option>Factory 5</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Line:</b></h5></label><br>
                  			<select class="form-control">
                  				<option>Line 1</option>
                  				<option>Line 2</option>
                  			</select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Account :</b></h5></label><br>
                        <input type="text" name="txtDepartment" class="form-control" placeholder="Department" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Model :</b></h5></label><br>
                        <select class="form-control" name="cmbSection" <?php echo $disabled;?>>
                   						<option>- Select Position -</option>
															<!-- <option <?php //if($section=="Section"){ echo "selected"; } ?>>Section</option>
															<option <?php //if($section=="Manager"){ echo "selected"; } ?>>Manager</option>
															<option <?php //if($section=="Engineer"){ echo "selected"; }?>>Engineer</option>
															<option <?php //if($section=="Supervisor"){ echo "selected"; }?>>Supervisor</option>
															<option <?php //if($section=="Staff"){ echo "selected"; }?>>Staff</option>
                                                            <option <?php //if($section=="Expert"){ echo "selected"; }?>>Expert</option>
                                                            <option <?php //if($section=="Head"){ echo "selected"; }?>>Head</option>
															<option <?php// if($section=="IT"){ echo "selected"; }?>>IT</option>
															<option <?php //if($section=="NPI"){ echo "selected"; }?>>NPI</option>
															<option <?php //if($section=="Software Developer"){ echo "selected"; }?>>Software Developer</option> -->
                        </select> 
                  </div>
                </div>
             
                <div class="row">
                    <div class="col-md-10">
                    	<div class="checkbox">
   											  <input type="checkbox" id="scales" name="chkActive" <?php if($active=='1'){echo "checked";} ?><?php echo $disabled;?>>
  												<label for="scales"><b>Active</b></label>
                    	</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <a class="form-btn btn btn-lg btn-success" href="?add">Add</a>
                        <button class="form-btn btn btn-lg btn-info" name="btnSave">Save</button>
                        <a class="form-btn btn btn-lg btn-warning" href="?cancel">Cancel</a>
                    </div>
                </div>
                </form>
            </div>
            
          </div>
        </div>
  </main>