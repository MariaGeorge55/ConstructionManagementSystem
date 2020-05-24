<?php
define('__ROOT__', "../app/");
require_once("Header.php");
require_once(__ROOT__ . "View/AdminView.php");
require_once(__ROOT__ . "Model/usersmodel.php");
require_once(__ROOT__ . "Controller/Usercontroller.php");
if ( ! isset( $_SESSION['username'])  ||  $_SESSION['page'] !== "Admin.php" ){
 echo '<script>window.location.href= "mainlogin.php";</script>';
}
else{
$model= new usersmodel();
$controller=new UsersController($model);
$view = new AdminView($controller,$model);

if (isset($_GET['action']) && !empty($_GET['action'])) {
  if($_GET['action'] == "editemployeeform"){
    $username=$_POST['username'];
    echo $view->{$_GET['action']}($username);
  }else if($_GET['action'] == "deleteuser"){

    echo $controller->{$_GET['action']}();
  }
    if($_GET['action'] == "insertuser"){
        echo $view->{$_GET['action']}();
    }
}
else{
  echo $view->output();
}
if(isset($_POST['edit']))	{
	$controller->editemployee();
	}
  if(isset($_POST['adduser']))	{
  	$controller->adduser();
  	}

}
require_once("Footer.php");
?>
