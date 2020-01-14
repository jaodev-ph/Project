<main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >

            <?php 
                include_once("../classes/connection2.php"); 
                
                $page = "maintenance"; 
                $disabled = '';

                $mode = 0;

            $visible = '';
            $disabled ='disabled';
            $readonly = 'readonly';
            $statdisable = 'readonly onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;"';

            $username ='';
            $name = '';
            $password = '';
            $section = '';
            $department = '';
            $active = '0';
            $add = false;
            $update = false;
            $delete = false;
            $Gender='';
            $fullname ='';




if(isset($_POST['btnDelete'])){
	include_once("../classes/users.php");

	if (isset($_POST['btnDelete'])) {
		$users = new Users();

		$users->getUsername($_POST['txtUsername']);
		$users->getPassword($_POST['txtPassword']);
		$users->getDepartment($_POST['txtDepartment']);
		$users->delete();

		$delete = true;
	}
}


            if(isset($_POST['btnSave'])){
                include_once("../classes/users.php");

                if($_POST['mode']==1){

        $users = new Users();

        $users->setUsername($_POST['txtUsername']);
        $users->setPassword($_POST['txtPassword']);
        $users->setDepartment($_POST['txtDepartment']);
        $users->setSection($_POST['cmbSection']);
        $users->setFullName($_POST['txtFullname']);
        //$fullname = $_POST['txtFullname'];

        if(isset($_POST['chkActive'])){
                $users->setActive('1');
        }else{
                $users->setActive('0');
        }

        if(isset($_POST['cmbGender'])=="Male"){
           $Gender = 'http://103.219.69.30:8080/cms/worker/male.png';
        }else{
           $Gender = 'http://103.219.69.30:8080/cms/worker/female.png';
        }

        $users->add();
        $users->add1($Gender);
        $add = true;
     	
        }

        else if($_POST['mode']==2){
            include_once("../classes/users.php");

            if(isset($_POST['btnSave'])){
                $users = new Users();

                $users->setUsername($_POST['txtUsername']);
                $users->setPassword($_POST['txtPassword']);
                $users->setDepartment($_POST['txtDepartment']);
                $users->setSection($_POST['cmbSection']);
                $users->setFullname($_POST['txtFullname']);
                // $fullname = $_POST['txtFullname'];

                if(isset($_POST['chkActive'])){
                    $users->setActive('1');
                }else{
                    $users->setActive('0');
                }

                if(isset($_POST['cmbGender'])=="Male"){
                    $Gender = 'http://103.219.69.30:8080/cms/worker/male.png';
                }else{
                    $Gender = 'http://103.219.69.30:8080/cms/worker/female.png';
                }

                $users->update($Gender,$fullname);
                $update = true;
            }
        }
            $mode = 0;
            $mode = 0;
        }


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //btnAdd.click
if(isset($_GET['add'])){
        $readonly = '';
        $disabled = ''; 

        $mode = 1;
 }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //btnCancel.click
if(isset($_GET['cancel'])){
        $readonly = 'readonly';
        $disabled = 'disabled'; 

        $username ='';
        $password = '';
        $section = '';

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //link.click

if(isset($_GET['username'])){
        $username = $_GET['username'];

        include_once("../classes/users.php");
        $users = new Users($_GET['username']);
        //$users1 = new Users($_GET['id']);

        // $authentication = $users->getAuthentication();
        $section = $users->getSection();
        $active = $users->getActive();
        $department = $users->getDepartment();
        $password = $users->getPassword();
        $fullname = $users->getFullname();
        $readonly = '';
        $disabled = ''; 
        
        if($users->getPath()=="http://103.219.69.30:8080/cms/worker/male.png")
        {
            $cmbValue = 0;
            if($cmbValue == 1)
            {

            }
        }else{
            
        }

     $mode = 2;

}
            ?>
        	
            <div class="w3-container">
		 	 <div class="card-panel hoverable">
        <div class="row">
           <div class="col-md-6">
            <form method="post" action="main.php">
            	<h1>Users</h1>
          
            		<p>Please fill in the form below to add/edit an account.</p>
            		<hr>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Username:</b></h5></label><input type="text"  name="mode" class="form-control" style='display:none;' value="<?php echo $mode; ?>"><br>
                        <input type="text" name="txtUsername" class="form-control" placeholder="Username" value="<?php echo $username; ?>" <?php echo $readonly;?> required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Name:</b></h5></label><input type="text"  name="mode" class="form-control" style='display:none;' value="<?php echo $mode; ?>"><br>
                        <input type="text" name="txtFullname" class="form-control" placeholder="Full Name" value="<?php echo $fullname; ?>" <?php echo $readonly;?> required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Password:</b></h5></label><br>
                  			<input type="password" name="txtPassword" class="form-control" placeholder="Password" id="password" value="<?php echo $password; ?>" <?php echo $readonly;?>>
                  			<input type="checkbox" id="scale1" name="hideShowPassword" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'" <?php echo $disabled; ?>>
                  			<label for="scale1"><b>Show Password:</b></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Department :</b></h5></label><br>
                        <input type="text" name="txtDepartment" class="form-control" placeholder="Department" value="<?php echo $department; ?>" <?php echo $readonly;?>>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Position :</b></h5></label><br>
                        <select class="form-control" name="cmbSection" <?php echo $disabled;?>>
                   			<option>- Select Position -</option>
							<option <?php if($section=="Section"){ echo "selected"; } ?>>Section</option>
							<option <?php if($section=="Manager"){ echo "selected"; } ?>>Manager</option>
							<option <?php if($section=="Engineer"){ echo "selected"; }?>>Engineer</option>
							<option <?php if($section=="Supervisor"){ echo "selected"; }?>>Supervisor</option>
							<option <?php if($section=="Staff"){ echo "selected"; }?>>Staff</option>
                            <option <?php if($section=="Expert"){ echo "selected"; }?>>Expert</option>
                            <option <?php if($section=="Head"){ echo "selected"; }?>>Head</option>
							<option <?php if($section=="IT"){ echo "selected"; }?>>IT</option>
							<option <?php if($section=="NPI"){ echo "selected"; }?>>NPI</option>
							<option <?php if($section=="Software Developer"){ echo "selected"; }?>>Software Developer</option>
                        </select> 
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <label><h5><b>Gender:</b></h5></label><input type="text"  name="mode" class="form-control" style='display:none;' value="<?php echo $mode; ?>"><br>
                        <select class="form-control" name="cmbGender" <?php echo $disabled;?>>
                                        <option>- Select Gender -</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Female</option>
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
                        <button class="form-btn btn btn-lg btn-danger" name="btnDelete">Delete</button>
                        <a class="form-btn btn btn-lg btn-warning" href="?cancel">Cancel</a>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-md-5">
            	<h1>Accounts</h1>
            		<p>Select an account</p>
            		<hr>

                <div class="form-group" >
                    <input type="text" class="form-control pull-center" id="SearchBy" name="SearchBy" value="" onkeyup="SearchByFunc()" placeholder="Search" >
                </div>
                <table class="table table-striped table-bordered" id="search_user" name="search_user">
                    <tr class="info">
                        <th class="text-center" style="color: white">Username</th>
                        <th class="text-center" style="color: white">Section</th>
                        <th class="text-center" style="color: white">Department</th>
                        <th class="text-center" style="color: white">Active</th>
                    </tr>
                    <?php
                     include_once("../classes/users.php");
                     $users2 = Users::getAllUsers();

                     for($i=0;$i<count($users2);$i++){
                    ?>

                    <tr>
                        <td><a href="?username=<?php echo $users2[$i]->getUsername(); ?>"><?php echo $users2[$i]->getUsername(); ?></a></td>
                        <td><?php echo $users2[$i]->getSection(); ?></td>
                        <td><?php echo $users2[$i]->getDepartment(); ?></td>
                        <td><?php echo $users2[$i]->getActive(); ?></td>

                    </tr>

                    <?php } ?>
                </table>
          </div>
        </div>
      </div>
    </div>
            	
            </div>
          </div>
  </main>
<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script>


function SearchByFunc() {

  var input, filter, table, tr, td,td1, i;
  input = document.getElementById("SearchBy");
  filter = input.value.toUpperCase();
  table = document.getElementById("search_user");
  tr = table.getElementsByTagName("tr");


  for (i = 0; i < tr.length; i++) {

    td = tr[i].getElementsByTagName("td");

  if(td.length > 0){ // to avoid th

       if (td[0].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1 || td[2].innerHTML.toUpperCase().indexOf(filter) > -1 || td[3].innerHTML.toUpperCase().indexOf(filter) > -1) 
       {
         tr[i].style.display = "";
       } 

       else {
         tr[i].style.display = "none";
       }

    }
 }
}



</script>
