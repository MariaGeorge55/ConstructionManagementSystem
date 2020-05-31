<?php
define('__ROOT__', "../app/");
require_once("header.php");
require_once(__ROOT__ . "View/technicalmanagerview.php");
require_once(__ROOT__ . "Model/techmanagermodel.php");
require_once(__ROOT__ . "Controller/technicalmanagercontroller.php");
if ( ! isset( $_SESSION['username'])){
 echo '<script>window.location.href= "mainlogin.php";</script>';
}
else{

$model= new technicalmanagermodel();
$controller=new technicalmanagercontroller($model);
$view = new technicalmanagerview($controller,$model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
  if($_GET['action'] == "viewallinvoices"){
    $contractid=$_REQUEST['contractid'];

   echo $view->{$_GET['action']}($contractid);
  }

   else if ($_GET['action']=="viewallcontracts"){
    echo $view->viewallcontracts();
  }
  else if ($_GET['action'] == "viewinvoices")
  {
         $contractid=$_REQUEST['contractid'];

    //echo $contractid."tech mainn";
    echo $view->viewinvoices($contractid);

  }

}
  else{
echo $view->output();

}

if(isset($_POST['acceptinvoice'])){
  echo "<script>alert ('main tech') </script>";
$controller->editinvoice($one=1);
}
if(isset($_POST['rejectinvoice'])){
$controller->editinvoice($zero=0);
}

}
require_once("footer.php");
?>
