<?php
define('__ROOT__', "../app/");
require_once("Header.php");
require_once(__ROOT__ . "View/ContractManagerView.php");
require_once(__ROOT__ . "Model/ContractManagerModel.php");
require_once(__ROOT__ . "Controller/ContractManagerController.php");
if (  isset( $_SESSION['username'])){
$username=$_SESSION['username'];
}else {
 echo '<script>window.location.href= "mainlogin.php";</script>';
}
$model= new ContractManagerModel();
$controller=new ContractManagerController($model);
$view = new ContractManagerView($controller,$model);
//echo $model->getcontracts();
if (isset($_GET['action']) && !empty($_GET['action'])) {
  if($_GET['action'] == "createcontract"){
   echo $view->{$_GET['action']}();
  }
  else if($_GET['action'] == "additemsform"){
    echo $view->{$_GET['action']}();
  }
  else if($_GET['action'] == "deletecontract"){
     $controller->{$_GET['action']}();
  }
  else if($_GET['action'] == "editcontractform"){
       $editid=$_REQUEST['contractid'];
      echo $view->{$_GET['action']}( $editid);
  }
  else if($_GET['action'] == "editcontractformstatus"){

      echo $view->editcontractform( $_SESSION['contractidedit']);
  }
  else if($_GET['action'] == "edititemsform"){
    //   $editid=$_REQUEST['contractid'];
      // $_SESSION['contractid']= $editid;
       $ss= $_SESSION['contractid'];
         echo "<script>alert('session contract id is $ss');</script>";
      echo $view->{$_GET['action']}( $_SESSION['contractid']);
  }else if($_GET['action'] == "viewcontractdetails"){
     $contractid=$_REQUEST['contractid'];
      echo $view->{$_GET['action']}($contractid);
  }else if($_GET['action'] == "viewallinvoices"){
    $contractid=$_REQUEST['contractid'];
  //echo "from  main contract id is".$contractid;
   echo $view->{$_GET['action']}($contractid);
  }
}
else{
echo $view->output();
}

if(isset($_POST['insertcontract'])){
//  echo "<script>alert('submit insert contract');</script>";

$controller->insertcontract();
}
if (isset($_POST['additems'])){
$controller->insertitem($zero=0);

}
if (isset($_POST['finish'])){
  $controller->insertitem($one=1);

}
if (isset($_POST['submitedit'])){
  $controller->editcontract($zero=0);

}
if (isset($_POST['edititems'])){
  $controller->editcontract($one=1);

}
if (isset($_POST['edititem'])){
  $controller->edititem();

}
//require_once"Footer.php";
?>
