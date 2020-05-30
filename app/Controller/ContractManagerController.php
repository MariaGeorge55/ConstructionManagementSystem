<?php
require_once(__ROOT__ . "controller/Controller.php");
class ContractManagerController extends controller{
  private $newcontractid;
  function checknum($number){
     if($number < 0)
     throw new Exception ("number should be greater than 0!");

     }
     //ay batekh
public function insertcontract(){

  $downpayement=$_REQUEST['downpayment'];//
  $date=$_REQUEST['date'];//
  $duration=$_REQUEST['duration'];//
  $clientname=$_REQUEST['clientname'];//
  $taxfileno=$_REQUEST['taxfileno'];//
  $engid=$_POST['engineerid'];
  $retention=$_REQUEST['retention'];//
   if (  isset( $_SESSION['username'])  && !empty ($_SESSION['username'])){
     $creatorid=$_SESSION['username'];//
   }
   else{echo '<script>window.location.href= "mainlogin.php";</script>';}

  try{
    $this->checknum(  $downpayement);
    $this->checknum(  $taxfileno);
      $this->checknum(  $retention);
  }
    catch(Exception $e){
      $emesg=	$e->getMessage();
      echo "<script>alert('$emesg')</script>";
      trigger_error($emesg);
      echo '<script>window.location.href= "Contract.php?action=createcontract";</script>';
       die();
    }

  $_SESSION['newcontractid']=$this->model->InsertContract($retention,$duration,$clientname,$engid,$taxfileno,$creatorid,$date,$downpayement);


}
public function insertitem($zeroorone){
  $newcontractid = $_SESSION['newcontractid'];
  $itemname=$_REQUEST['itemname'];
  $priceperunit=$_REQUEST['priceperunit'];
  $unit=$_REQUEST['unit'];
  $quantity=$_REQUEST['quantity'];
  $testing=$_REQUEST['testing'];
  $vat=$_REQUEST['vat'];
  try{
    $this->checknum($priceperunit);
    $this->checknum($quantity);
    $this->checknum($testing);
    $this->checknum($vat);
  }
    catch(Exception $e){
      $emesg=	$e->getMessage();
      echo "<script>alert('$emesg')</script>";
      trigger_error($emesg);
      echo '<script>window.location.href= "Contract.php?action=additemsform";</script>';
       die();
    }

  $this->model->insertitem($zeroorone,$itemname,$priceperunit,$unit,$quantity,$testing,$vat,$newcontractid);
}
public function deletecontract(){

$contractid=$_REQUEST['contractid'];//
$this->model->deletecontract($contractid);
}

public function editcontract($zeroorone){
  $issuedate=$_REQUEST['issueduration'];
  $downpayment=$_REQUEST['downpayment'];
  $taxfileno=$_REQUEST['taxfileno'];
  $clientname=$_REQUEST['clientname'];
  $contractid=$_REQUEST['contractid'];
  $newduration=$_REQUEST['newduration'];
  $oldenddate=$_REQUEST['oldenddate'];
  if($newduration === ""){
    $newduration=$oldenddate;
  }

  try{
    $this->checknum($downpayment);
    $this->checknum($taxfileno);

  }
    catch(Exception $e){
      $emesg=	$e->getMessage();
      echo "<script>alert('$emesg')</script>";
      trigger_error($emesg);
      echo '<script>window.location.href= "Contract.php?action=editcontractform";</script>';
       die();
    }
    $this->model->EditContract($zeroorone,$downpayment,$taxfileno,$clientname,$contractid,$newduration);

}

public function edititem(){
  $newquantity=$_REQUEST['newquantity'];
    $itemid=$_REQUEST['itemid'];
    //   echo "<script>alert('session contract id is $itemid);</script>";
       try{
         $this->checknum($newquantity);
     }
         catch(Exception $e){
           $emesg=	$e->getMessage();
           echo "<script>alert('$emesg')</script>";
           trigger_error($emesg);
           echo '<script>window.location.href= "Contract.php?action=edititemsform";</script>';
            die();
         }

      $this->model->EditItem($itemid,$newquantity);
}

} ?>
