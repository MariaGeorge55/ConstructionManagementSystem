<?php
require_once("../app/Model/Model.php");
require_once("../app/Model/usermodel.php");
require_once("../app/Model/ContractModel.php");
class EngineerModel extends Model {
private $contracts ;
private $invoicedescription;

function __construct() {
  $this->fillArraycontracts();
}
function getcontractarray(){
  return $this->contracts;
}
function fillArraycontracts() {
  $this->contracts = array();
  $this->db = $this->connect();
  $result = $this->readcontracts();
  if($result){
  while($row = $this->db->fetchRow($result)){
    array_push($this->contracts, new Contractmodel($row["contractID"]
     , $row['retention'] , $row['duration'] ,$row['clientname'],$row['engID'],$row['taxfileno'],$row['creatorID'],$row['issuedate'],$row['downpayment'],$row['downpaymentpercentage'])); }
}
else{
  $errorconn=mysqli_error($this->db->getConn());
           trigger_error("$errorconn");}
}
function readcontracts(){
  $username=$_SESSION['username'];
  $sql = "SELECT * FROM `contract` WHERE engID='$username'";

  $result = $this->db->query($sql);
  if ($result){
    return $result;
  }
  else {
    return false;
  }
}
function checkquantity($previous,$quantity,$contractquantity){
  if($contractquantity < ($quantity+$previous)){
    return false;
  }
  return true;
}
function EditInvoice($invoiceid,$itemid,$previous,$quantity,$contractquantity){
  if($this->checkquantity($previous,$quantity,$contractquantity)){
  $sql="UPDATE `invoicedescriptionitems` SET `quantity`=$quantity WHERE `invoiceID`=$invoiceid AND `itemID`=$itemid";
  $this->db=$this->connect();
  $result=$this->db->query($sql);
  if($result){
    $this->fillArraycontracts();
    echo "<script>alert(Invoice updated Successfully)</script>";
     echo '<script>window.location.href= "Engineer.php?action=edititem";</script>';
  }else{echo "<script>alert(error in updateding Invoice)</script>";
    $errorconn=mysqli_error($this->db->getConn());
           trigger_error("$errorconn");
           //echo '<script>window.location.href= "mainlogin.php";</script>';
         }
}else{
  echo "<script>alert(you exceeded total quantity in contract)</script>";
  //   echo '<script>window.location.href= "Engineer.php?action=editinvoice";</script>';
}
}

}
 ?>
