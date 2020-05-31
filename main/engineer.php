<?php
define('__ROOT__', "../app/");
require_once("header.php");
require_once(__ROOT__ . "View/engineerview.php");
require_once(__ROOT__ . "Model/engineermodel.php");
require_once(__ROOT__ . "Controller/engineercontroller.php");
if ( ! isset( $_SESSION['username'])){
 echo '<script>window.location.href= "mainlogin.php";</script>';
}
else{

$model= new engineermodel();
$controller=new engineercontroller($model);
$view = new engineerview($controller,$model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
  if($_GET['action'] == "viewallinvoices"){
    $contractid=$_REQUEST['contractid'];

   echo $view->{$_GET['action']}($contractid);
  }
else  if($_GET['action'] == "addInvoice"){

      $contractid=$_REQUEST['contractid'];

   echo $view->{$_GET['action']}($contractid);
  }
  else  if($_GET['action'] == "insertquantity"){
      $contractid=$_REQUEST['contractid'];
      $itemid=$_REQUEST['item'];
     echo $view->{$_GET['action']}($itemid,$contractid);
    }
  else if($_GET['action'] == "editinvoice"){

  $invoiceamountid=$_SESSION['invoiceamountid'];
   $contractid=  $_SESSION['contractid'];

   echo $view->{$_GET['action']}($_SESSION['invoiceamountid'],$_SESSION['contractid']);
  }
  else   if($_GET['action'] == "edititem"){
    /*  $invoiceamountid=$_REQUEST['invoiceid'];
      $contractid=$_REQUEST['contractid'];*/
    $invoiceamountid=$_SESSION['invoiceamountid'];
     $contractid=  $_SESSION['contractid'];
    //  echo "from eng2 main contract id is".$contractid;
     echo $view->viewallinvoices($contractid);}
}
  else{
echo $view->output();

}
if (isset($_POST['UpdateInvoice'])){
  $controller->editinvoiceditems();

}
if (isset($_POST['additem'])){
  $controller->additemtoinvoice();

}
if (isset($_POST['addinvoice'])){
  $contractid=$_REQUEST['contractid'];
$controller->addinvoiceamount($contractid);
}

}
require_once("footer.php");
?>
