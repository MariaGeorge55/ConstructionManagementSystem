<?php
define('__ROOT__', "../app/");
require_once("Header.php");
require_once(__ROOT__ . "View/EngineerView.php");
require_once(__ROOT__ . "Model/EngineerModel.php");
require_once(__ROOT__ . "Controller/EngineerController.php");
if ( ! isset( $_SESSION['username'])){
 echo '<script>window.location.href= "mainlogin.php";</script>';
}
else{

$model= new EngineerModel();
$controller=new EngineerController($model);
$view = new EngineerView($controller,$model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
  if($_GET['action'] == "viewallinvoices"){
    $contractid=$_REQUEST['contractid'];
  echo "from eng1 main contract id is".$contractid;
   echo $view->{$_GET['action']}($contractid);
  }
  else if($_GET['action'] == "editinvoice"){
  /*  $invoiceamountid=$_REQUEST['invoiceid'];
    $contractid=$_REQUEST['contractid'];*/
  $invoiceamountid=$_SESSION['invoiceamountid'];
   $contractid=  $_SESSION['contractid'];
    echo "from eng2 main contract id is".$contractid;
   echo $view->{$_GET['action']}($_SESSION['invoiceamountid'],$_SESSION['contractid']);
  }
  else   if($_GET['action'] == "edititem"){
    /*  $invoiceamountid=$_REQUEST['invoiceid'];
      $contractid=$_REQUEST['contractid'];*/
    $invoiceamountid=$_SESSION['invoiceamountid'];
     $contractid=  $_SESSION['contractid'];
      echo "from eng2 main contract id is".$contractid;
     echo $view->viewallinvoices($contractid);}
}
  else{
echo $view->output();

}
if (isset($_POST['UpdateInvoice'])){
  $controller->editinvoiceditems();

}



}
?>
