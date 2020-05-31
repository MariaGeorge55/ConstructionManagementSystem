<?php
define('__ROOT__', "../app/");
require_once("header.php");
require_once(__ROOT__ . "View/adminview.php");
require_once(__ROOT__ . "Model/adminmodel.php");
require_once(__ROOT__ . "Controller/admincontroller.php");
if ( !isset($_SESSION['username'])  ||  $_SESSION['page'] != "Admin.php" ){
 echo '<script>window.location.href= "mainlogin.php";</script>';
}
else{
$model= new usersmodel();
$controller=new admincontroller($model);
$view = new adminview($controller,$model);

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
require_once("footer.php");
?>
