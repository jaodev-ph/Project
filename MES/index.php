<!------ 
  Program/Design by: Rito Balaquaio
 ---------->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - MES</title>
    <link rel="stylesheet" href="assets/css/fontdesign.css">
    <link rel="stylesheet" href="assets/css/navdesign.css">
    <link rel="stylesheet" href="assets/css/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/design.css">
   
    <?php

    session_start();
    include_once("classes/connection.php");
    include_once("classes/user.php");
    include_once("classes/account.php");
    include_once("classes/module.php");
	
	$success = true;
  $proceedAccount = true;
  $proceedModule = true;
  $cmbAccount = 'Select Account';
  $cmbModule = 'Select Module';
  $disabled ='disabled selected';

	if (isset($_POST['btnSignin'])){

        $Account = new Account;
        $Account->setCustomerCode($_POST['cmbAccount']);
        $Account->SelectAccount();
        if($Account->getCustomerName()==''){
        $cmbAccount = '';
        }else{
        $cmbAccount = $Account->getCustomerName(); 
        
        }
        $cmbModule = $_POST['cmbModule'];

      if(User::validateUser($_POST['txtEmployeeCode'], $_POST['txtPass']) == true){

        $superAdmin = User::getAuth($_POST['txtEmployeeCode'], $_POST['txtPass'],$_POST['cmbAccount'],$_POST['cmbModule'],true);

        if($superAdmin != 'Super Administrator'){
        $auth = User::getAuth($_POST['txtUser'], $_POST['txtEmployeeCode'],$_POST['cmbAccount'],$_POST['cmbModule'],false);

        }else{
        $auth = 'Super Administrator';
        }

        if(trim(User::validateAccount($_POST['txtEmployeeCode'], $_POST['txtPass'], $_POST['cmbAccount'],$_POST['cmbModule']))==trim($_POST['cmbAccount']) OR $auth == 'Super Administrator'){
           if(trim(strtolower(User::userModule($_POST['txtEmployeeCode'], $_POST['txtPass'], $_POST['cmbAccount'],$_POST['cmbModule']))) == trim(strtolower($_POST['cmbModule'])) OR $auth == 'Super Administrator'){

				    $_SESSION['logged']=true;
      
            $_SESSION['password']=$_POST['txtPass'];
             $admin = false;
            if($auth == 'Super Administrator')
            {
              $_SESSION['authentication'] = User::getAuth($_POST['txtEmployeeCode'], $_POST['txtPass'], $_POST['cmbAccount'], $_POST['cmbModule'],true);
              $admin = true;

            }else{
              $_SESSION['authentication'] = User::getAuth($_POST['txtEmployeeCode'], $_POST['txtPass'], $_POST['cmbAccount'], $_POST['cmbModule'],false);
              $admin = false;

            }
            
            $_SESSION['module'] = $_POST['cmbModule'];
            $_SESSION['account'] = $_POST['cmbAccount'];
            $_SESSION['submenu'] = '001';
            $_SESSION['submenucode'] =1;
            echo $admin;
            $details = new User();
            $details->setEmployeeCode($_POST['txtEmployeeCode']);
            $details->setPassword($_POST['txtPass']);
            $details->setAccount($_POST['cmbAccount']);
            $details->setModule(trim($_POST['cmbModule']));
            $details->userDetails($admin);
            $_SESSION['name'] = $details->getUsername();
            $_SESSION['employeeCode'] = $details->getEmployeeCode();
            $_SESSION['icon_image'] = strtolower(trim($details->getGender()));
            
            
        }else{
        $proceedModule = false;
      }   
        
      }else{
        $proceedAccount = false;
      }   

			}else{

        $_SESSION['logged']=false;
        $success = false;
   }

	}

    if(isset($_SESSION['logged'])){
              if ($_SESSION['logged']) {
              header("location:public/main.php?MenuCode=001&SubMenuCode=1");
               }
            }


	?>

  </head>
  <body>
    
   <div class="login-box">
    <div class="login-logo">
        <img src="assets/image/logo.png" alt="Logo"></p>
      </div>

    <div class="login-box-body">
        <p><b>LOGIN </b></p>
        <form  method="post"> 
          <div class="form-group">
          <select name="cmbModule" id="cmbModule" class="form-control" required="required">
           <option  value="" <?php echo $disabled;?> ><?php echo $cmbModule;?></option>
           <?php $Module = Module::SelectAllModule();
                     for($i=0;$i<count($Module);$i++){
                ?>
              <option value="<?php echo $Module[$i]->getModuleName(); ?>" <?php if($Module[$i]->getModuleName() == $cmbModule){echo 'selected';}?>><?php echo $Module[$i]->getModuleName(); ?></option>
                <?php
              }
                ?>
           </select>                   
          </div>
 <div class="form-group ">
          <select name="cmbAccount" id="cmbAccount" class="form-control" placeholder="Username" required="required">
           <option  value="" <?php echo $disabled;?>><?php echo $cmbAccount;?></option>
             <?php $Account = Account::SelectAllAccount();
                     for($i=0;$i<count($Account);$i++){
                ?>
            <option value="<?php echo $Account[$i]->getCustomerCode(); ?>" <?php if($Account[$i]->getCustomerName() == $cmbAccount){echo 'selected';}?>><?php echo $Account[$i]->getCustomerName(); ?></option>
                <?php
              }
                ?>
           </select>         
          </div>
       
        <div class="form-group ">
         
        <input type="text" name="txtEmployeeCode" value="" placeholder="Employee Code" class="form-control" id="login" maxlength="80" required="required" autocomplete="off">
    
        </div>
        <div class="form-group">
            <input type="password" name="txtPass" value="" placeholder="Password" class="form-control" id="password" required="required">            
            <span><font color="red"></font></span>
        </div>
             
        <div class="form-group ">
                <input type="submit" name="btnSignin" value="Sign In" id="submit" class="btn btn-primary btn-block btn-flat">          
      
       
          <?php

              if($proceedAccount == false)
              {
                  
                 ?>
              
                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Error!</strong> This user is not allow for this account!.
                </div>
              <?php 
                }else{

          if($proceedModule == false)
              {
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Error!</strong> This user is not allow for this module!
                </div>
              <?php 
              }else{
                if(!$success){              
              ?>             
                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Error!</strong> Invalid username or password, Please try again.
                </div>
              <?php 
            }
            }
            }
               ?>
              <div>

    </div>
        </form>       
            </div>
</div>

  </body>
  <script src="assets/js/material.min.js"></script>
  <script src="assets/js/jquery-3.2.1.slim.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</html>