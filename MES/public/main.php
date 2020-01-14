
<!------ Include the above in your HEAD tag ---------->
<?php
session_start();

include_once("../classes/menu.php");
include_once("../classes/submenu.php");
include_once("../classes/account.php");
include_once("../classes/user.php");
include_once("../classes/authentication.php");
include_once("../classes/module.php");

  $cmbAccount ="";
  $disabled ="disabled";
  $empCode = '';
  $nickname = '';
  $password = '';
  $compassword = '';
  $moduleAcc = '';
  $gender = '';
  $auth = '';

    if(!isset($_SESSION['logged'])){
        header("location:../");
        
    }

    if(isset($_GET['logout'])){
      session_destroy();
      header("location:../");
    }

    if(isset($_GET['MenuCode'])){
      
      $_SESSION['submenu'] = $_GET['MenuCode'];
      ?>
      <style>
      #linkcolor<?php echo $_SESSION['submenu'];?>
      {
        background-color:#00BCD4;
      }
      </style>
      <?php

      $Sub = new SubMenu();
      $Sub->setAccount($_SESSION['account']);
      $Sub->setModule($_SESSION['module']);
      $Sub->setSubMenuCode($_GET['MenuCode']);
      $Sub->setFlowsequence($_GET['SubMenuCode']);
      $Sub->SelectTopOne();
      $_SESSION['submenucode'] = $Sub->getFileName();
 
      
    }

    if(isset($_GET['SubMenuCode'])){

      $_SESSION['submenucode'] = $_GET['SubMenuCode'];
       ?>
      <style>
      #Subcolor<?php echo $_SESSION['submenucode'];?>
      {
        background-color:#D3D3D3;
      }
      </style>
      <?php
      
      $Sub = new SubMenu();
      $Sub->setAccount($_SESSION['account']);
      $Sub->setModule($_SESSION['module']);
      $Sub->setSubMenuCode($_GET['MenuCode']);
      $Sub->setFlowsequence($_GET['SubMenuCode']);
      $Sub->SelectTopOne();
      $_SESSION['submenucode'] = $Sub->getFileName();

   
    }   
          $Account = new Account;
          $Account->setCustomerCode($_SESSION['account']);
          $Account->SelectAccount();
          if($Account->getCustomerName()==''){
          $cmbAccount = '';
          }else{
          $cmbAccount = $Account->getCustomerName(); 
        }


?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>MES</title>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="MES">
    
    <link rel="stylesheet" href="../assets/css/fontdesign.css">
    <link rel="stylesheet" href="../assets/css/navdesign.css">
    <link rel="stylesheet" href="../assets/css/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" rel="stylesheet">


  </head>
  <body>
   

    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header ">
     <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <img src="../assets/image/<?php           
          echo Module::SelectIcon($_SESSION['module']);
          ?>.png" style="width:40px; height:40px; margin-right:15px;">
          <span class="mdl-layout-title" style="color:black;"><?php 
          echo $_SESSION['module']." ".$cmbAccount; ?></span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>
       
          
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer" style="background-color:#1F618D; ">
        <header class="demo-drawer-header">
          <div>
   <div class="row">
      <div class="col-sm-4"><img src="../assets/image/<?php echo $_SESSION['icon_image'];?>.png" class="demo-avatar" > </div>
      <div class="col-sm-6"><div id='div_name'> <span style="color: white;"><?php echo strtoupper($_SESSION['name']); ?></span></div>
      <div id='div_name'> <span style="color: white;"><?php echo $_SESSION['employeeCode']; ?></span></div>
    </div>
    </div>
            
         </div>  <br />    
      
          <div class="demo-avatar-dropdown">
           
            <span style="color: white; font-size:10px;"><?php echo strtoupper($_SESSION['authentication']); ?></span>
                     
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" style="color: white;">
              <i class="material-icons" role="presentation"> arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>


            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <li class="mdl-menu__item" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Modal_User">Change Password</li>
              <a href="?logout" style="text-decoration:none;"><li class="mdl-menu__item" >Exit</li></a>
              <?php if($_SESSION['authentication'] == 'Super Administrator' OR $_SESSION['authentication'] == 'Administrator'){?>
              <li class="mdl-menu__item" data-toggle="modal" data-backdrop="static" data-target="#Modal_AddUser"><i class="material-icons">add</i>Add user account...</li>
              
              <li class="mdl-menu__item" data-toggle="modal" data-backdrop="static" data-target="#Modal_EditUser"><i class="material-icons">edit</i>Edit user account...</li>
              <?php } ?>
            </ul>

          </div>
             
       
        </header>
        

        <nav class="demo-navigation mdl-navigation " style="background-color:#2980B9; ">
          <?php 
           
          $menu = Menu::SelectMenu($_SESSION['account'],$_SESSION['module']);
                     for($i=0;$i<count($menu);$i++){
               $temp = Authentication::SelectAllAuth($_SESSION['authentication'],$menu[$i]->getMenuCode(),$_SESSION['account'],$_SESSION['module']);
                ?>
                                 
          <a class="mdl-navigation__link mdl-color-text--<?php if($menu[$i]->getMenuCode() == $temp OR $_SESSION['authentication'] == 'Super Administrator' OR $_SESSION['authentication'] == 'Administrator'){echo 'white';} ?>" href="?MenuCode=<?php echo $menu[$i]->getMenuCode(); ?>&SubMenuCode=1" id="linkcolor<?php echo $menu[$i]->getMenuCode();  ?>" onclick="return <?php if($menu[$i]->getMenuCode()==$temp OR $_SESSION['authentication'] == 'Super Administrator' OR $_SESSION['authentication'] == 'Administrator'){echo 'true';}else{echo 'false';} ?>;"><i class="mdl-color-text--<?php if($menu[$i]->getMenuCode()==$temp OR $_SESSION['authentication'] == 'Super Administrator' OR $_SESSION['authentication'] == 'Administrator'){echo 'white';} ?> material-icons" role="presentation""><?php  echo $menu[$i]->getIcon(); ?> </i><?php  echo $menu[$i]->getMenuName(); ?></a>
          <?php 
        }
         ?>  
      </div>
  
       
      <div class="mdl-layout__header mdl-color--grey-100 ">
      <div class=" mdl-color--grey-100  mdl-cell--12-col "  >
       
      <?php $submenu = SubMenu::SelectAllSubMenu($_SESSION['account'],$_SESSION['submenu'],$_SESSION['module']);
        for($i=0;$i<count($submenu);$i++)
        {       
                ?>
      <a href="?MenuCode=<?php echo $_SESSION['submenu'];?>&SubMenuCode=<?php  echo $submenu[$i]->getFlowsequence(); ?>" ><button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-600"  name='' id="Subcolor<?php echo $submenu[$i]->getFlowsequence();  ?>">
           <?php  echo $submenu[$i]->getSubMenuName(); ?>
          </button></a>
          <?php 
        }
         ?> 
        </div>
      </div>     
    </nav>
        
      <?php 


      if($_SESSION['submenucode'] == ''){
        include($_SESSION['module']."/undermaintenance.php"); 
      }else{      
      include($_SESSION['module']."/".$_SESSION['submenucode'].".php"); 
      }
      
     
      ?>
  
<!-- Add Edit User Modal -->
<div class="modal fade " id="Modal_EditUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style=""  >
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1F618D;">
        <button id='modaleditexit'type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;">Edit User</h4>
      </div>
      <div class="modal-body">
   <form method="post" id = "FormEditUser">
<div id = "result_modal4"></div>
 <div id = "editerror1" class="alert alert-danger alert-dismissible" role="alert" hidden>
  <strong>Error!</strong> Employee Not Exist!</div>
  <div id = "editerror2" class="alert alert-danger alert-dismissible" role="alert"  hidden><strong>Error!</strong> Please don't submit with empty value!</div>
   <div id = "editerror3" class="alert alert-danger alert-dismissible" role="alert"  hidden><strong>Error!</strong> New password did not match!</div>
   <div id = "editsuccess1" class="alert alert-success alert-dismissible" role="alert" hidden>
 <strong>Success!</strong> User account successfully edited!</div>
<div class="row">

      <div class="col-sm-1"> 
     <i class="material-icons">search</i>
    </div>
    <div class="col-sm-11"> 
       <input type="text" name="txtSearch" placeholder="Enter Employee Code" class="form-control" id="txtSearch"  maxlength="80" required="required">
</div>
</div>
<br />
<div class="row">
      <div class="col-sm-6"> 
      
<div class="form-group">
    Employee Code:
       <input type="text" name="txtEditEmployee" value="<?php echo $empCode;  ?>"  class="form-control" id="txtEditEmployee" maxlength="80" required="required">

</div>

<div class="form-group">
    Nickname:
       <input type="text" name="txtEditUser" value="<?php echo $nickname;  ?>"  class="form-control" id="txtEditUser" maxlength="80" required="required">        
</div>

<div class="form-group">
    Password:
       <input type="password" name="txtEditNewPass" value="<?php echo $password;  ?>"  class="form-control" id="txtEditNewPass" maxlength="80" required="required">
</div>

<div class="form-group">
    Comfirm Password:
       <input type="password" name="txtEditComPass" value="<?php echo $password;  ?>"  class="form-control" id="txtEditComPass" maxlength="80" required="required">
</div>
<div class="form-group">
Module:
  <select name="txtEditModule" class="form-control" id="txtEditModule">
           <option <?php if($moduleAcc != ''){echo 'disabled';}?>><?php echo strtoupper($moduleAcc);  ?></option>
           <?php $Module = Module::SelectAllModule();
                     for($i=0;$i<count($Module);$i++){
                ?>
           <option value ='<?php echo $Module[$i]->getModuleName(); ?>' ><?php echo $Module[$i]->getModuleName(); ?></option>
                <?php
              }
                ?>
  </select> 
</div>
<div class="form-group" >
    Gender:
       <select class="form-control" id="txtEditGender" name="txtEditGender">
        <option  <?php if($gender != ''){echo 'disabled';}?>><?php echo ucwords($gender); ?></option>
       <option value='Male'>Male</option>
        <option value='Female'>Female</option>
       </select>
</div>

<div class="form-group" >
    Authentication:
       <select class="form-control"  id="txtEditAuth"   name="txtEditAuth">
       <option  <?php if($auth != ''){echo 'disabled';}?>><?php echo $auth; ?></option>
       <option value ='Operator'>Operator</option>
       <option value ='Tester'>Tester</option>
       <option value ='Quality Control'>Quality Control</option>
       <option value ='Packing Operator'>Packing Operator</option>
       <option value ='Repair Operator'>Repair Operator</option>
       <option value ='Parts Preparation'>Parts Preparation</option>
       <option value ='Supervisor'>Supervisor</option>
       <option value ='Engineer'>Engineer</option>
       <option value ='Administrator'>Administrator</option>
       <option value ='Super Administrator'>Super Administrator</option>
       </select>
</div> 

</div>

<div class="col-sm-6">

   <div class="table-responsive" style="height:455px;">    
      <table class="table table-striped table-sm  " id="tableUser">
        <thead>
    <tr>
      <th>Employee Code</th>
      <th>Username</th>
      <th>Gender</th>
      <th>Authentication</th>
      <th>Module</th>
    </tr>
  </thead>
  <tbody>
 
  <?php $alluser = User::SelectAllUser($_SESSION['account'],$_SESSION['module']);

        for($i=0; $i < count($alluser); $i++)
        { ?>
      <tr>
      <td ><a><?php echo $alluser[$i]->getEmployeeCode(); ?></a></td>
      <td><?php echo $alluser[$i]->getUsername(); ?></td>
      <td><?php echo $alluser[$i]->getGender(); ?></td>
      <td><?php echo $alluser[$i]->getAuthentication(); ?></td>
      <td><?php echo $alluser[$i]->getModule(); ?></td> 
      </tr>
       <?php } ?>
   
  </tbody>
</table>
</div>

</div>
</div>

      <div class="modal-footer">
         <button type="submit" class="btn btn-light" id="Edituser" name="Edituser" data-dismiss="static" data-backdrop="static" disabled>Edit </button>
        <!-- <button type="submit" id="changepass" class="btn bt n-success" >Change</button> -->
        <button type="button" class="btn btn-light"  id="Edituser_cancel" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


    </div>



<!-- Change Password Modal -->

<div class="modal fade " id="Modal_User" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style=""  >
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1F618D;">
        <button id='modalmenuclose'type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;">Change Password</h4>
      </div>
      <div class="modal-body">
   <form method="post" id = "FormChangePass">
    <div id = "result_modal"></div>
    <div id = "error1" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> Please fill up the old password!</div>
    <div id = "error2" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> Please fill up the new password!</div> 
    <div id = "error3" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> Please fill up the confirm password!</div>
    <div id = "error4" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> Incorrect old password!</div>
    <div id = "error5" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> New password did not match!</div>                                     
    <div id = "success1" class="alert alert-success alert-dismissible" role="alert" hidden>
                <strong>Success!</strong> Password successfully change!</div>

        <div class="form-group ">
          
        <input type="password" name="txtoldPass" value="" placeholder="Old Password" class="form-control" id="txtoldPass" maxlength="80" required="required">
      
        </div>
        <div class="form-group">
            <input type="password" name="txtPass" value="" placeholder="New Password" class="form-control" id="txtPass" required="required">            
            <span><font color="red"></font></span>
        </div>
        <div class="form-group">
            <input type="password" name="txtComPass" value="" placeholder="Confirm Password" class="form-control" id="txtComPass" required="required">            
            <span><font color="red"></font></span>
        </div>
        <div class="table-responsive">    
      <table class="table table-striped ">
        <thead>
    <tr>
      <th>Employee Code</th>
      <th>Username</th>
      <th>Gender</th>
      <th>Authentication</th>
      <th>Module</th>
    </tr>
  </thead>
  <tbody>
 <tr>
  <?php $userInfo = User::SelectCurrentUser($_SESSION['account'],$_SESSION['module'],$_SESSION['employeeCode'],$_SESSION['password']);
        for($i=0;$i<count($userInfo);$i++)
        { ?>
      <td><?php echo $userInfo[$i]->getEmployeeCode(); ?></td>
      <td><?php echo $userInfo[$i]->getUsername(); ?></td>
      <td><?php echo $userInfo[$i]->getGender(); ?></td>
      <td><?php echo $userInfo[$i]->getAuthentication(); ?></td>
      <td><?php echo $userInfo[$i]->getModule(); ?></td> 
       <?php } ?>
   </tr>
  </tbody>
</table>
</div>
 </div>

      <div class="modal-footer">
         <button type="submit" class="btn btn-light" id="changepass" name="changepass" data-dismiss="static" data-backdrop="static"> Change </button>
        <!-- <button type="submit" id="changepass" class="btn btn-success" >Change</button> -->
        <button type="button" class="btn btn-light"  id="cancel" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Add User Modal -->

<div class="modal fade " id="Modal_AddUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style=""  >
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1F618D;">
        <button id='modalmenuexit'type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;">New User</h4>
      </div>
      <div class="modal-body">
   <form method="post" id = "FormAddUser">
<div id = "result_modal2"></div>
    <div id = "adderror1" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> Please fill up the Employee Code!</div>
    <div id = "adderror2" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> Please fill up the User Name!</div> 
    <div id = "adderror3" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> Please fill up the password!</div>
    <div id = "adderror4" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> Please fill up the confirm password!</div>
    <div id = "adderror5" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> password did not match!</div> 
    <div id = "adderror6" class="alert alert-danger alert-dismissible" role="alert" id='Error' hidden>
                <strong>Error!</strong> Employee is already exist!</div>
    <div id = "addsuccess1" class="alert alert-success alert-dismissible" role="alert" hidden>
                <strong>Success!</strong> User account successfully added!</div> 

<div class="form-group">
    Employee Code:
       <input type="text" name="txtEmployee" value=""  class="form-control" id="txtEmployee" maxlength="80" required="required">

</div>

<div class="form-group">
    Nickname:
       <input type="text" name="txtAddUser" value=""  class="form-control" id="txtAddUser" maxlength="80" required="required">       
</div>

<div class="form-group">
    Password:
       <input type="password" name="txtaddNewPass" value=""  class="form-control" id="txtaddNewPass" maxlength="80" required="required">
</div>

<div class="form-group">
    Comfirm Password:
       <input type="password" name="txtAddComPass" value=""  class="form-control" id="txtAddComPass" maxlength="80" required="required">
</div>

<div class="form-group">
    Gender:
       <select class="form-control" name="txtGender"  id="txtGender">
       <option>Male</option>
        <option>Female</option>
       </select>
</div>

<div class="form-group">
    Authentication:
       <select class="form-control"  name="txtAuth"  id="txtAuth">
       <option>Operator</option>
       <option>Tester</option>
       <option>Quality Control</option>
       <option>Packing Operator</option>
       <option>Repair Operator</option>
       <option>Parts Preparation</option>
       <option>Supervisor</option>
       <option>Engineer</option>
       <option>Administrator</option>
       <option>Super Administrator</option>
       </select>
</div> 
      <div class="modal-footer">
         <button type="submit" class="btn btn-light" id="adduser" name="adduser" data-dismiss="static" data-backdrop="static"> Add </button>
        <!-- <button type="submit" id="changepass" class="btn btn-success" >Change</button> -->
        <button type="button" class="btn btn-light"  id="adduser_cancel" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


  
  <script src="../assets/js/material.min.js"></script>
  <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/modal.js"></script>
  </body>
</html>
