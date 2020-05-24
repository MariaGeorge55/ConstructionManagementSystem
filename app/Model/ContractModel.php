<?php
require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "model/ItemModel.php");
require_once(__ROOT__ . "model/InvoiceDescription.php");
require_once(__ROOT__ . "model/InvoiceDescriptionAmount.php");
class ContractModel extends Model{
private $contractid;
private $date;
private $status;
private $totalprice=0;
private $downpayment;
private $testing;
private $retention;
private $duration;
private $clientname;
private $engineerid;
private $taxfileno;
private $creatorid;
private $downpaymentpercentage;
private $items;//array of items
private $invoicesdescriptionsamount;///array of invoices
function __construct($contractid,$retention="",$duration="",$clientname="",$engineerid="",$taxfileno="",$creatorid="",$date="",$downpayment="",$downpaymentpercentage="")
{    $db = $this->connect();
     $this->contractid=$contractid;
     $this->fillarrayitems();
     $this->fillarrayinvoicedescriptionamount();

  if($date === ""  OR $retention === "" OR $duration === ""  OR $clientname=== "" OR $engineerid ===""
  OR $taxfileno ==="" OR $creatorid === "" OR $downpayment==="" OR $downpaymentpercentage===""){
    $this->readcontract($contractid);

  }
else{ $this->contractid=$contractid;
      $this->date=$date;
      $this->retention=$retention;
      $this->duration=$duration;
      $this->clientname=$clientname;
      $this->downpayment=$downpayment;
      $this->engineerid=$engineerid;
      $this->taxfileno=$taxfileno;
      $this->creatorid=$creatorid;
      $this->downpaymentpercentage=$downpaymentpercentage;
    }

}

function readitems(){
 $sql = "SELECT * FROM `items` where contractid='$this->contractid'";
 $db=$this->connect();
 $result = $db->query($sql);
 if($result){
 if ($result->num_rows > 0){
   return $result;
 }
 else {
   return false;
 }
}
else{
   $errorconn=mysqli_error($db->getConn());
           trigger_error("$errorconn");
  }
}

function fillarrayitems(){
    $this->items= array();
    $this->db = $this->connect();
  $result=$this->readitems();
  while($row = $this->db->fetchRow($result)){
    array_push($this->items, new ItemModel($row['itemID'],$row['name'],$row['quantity'],$row['price'],$row['unit'],$row['vat'],$row['testing']));

  }
}

function readinvoicedescriptionamount(){
 $sql = "SELECT * FROM `invoicedescriptionamount` where contractID=$this->contractid ";
 $this->db=$this->connect();
 $result = $this->db->query($sql);
 if($result){
 if ($result->num_rows > 0){
   return $result;
 }
 else {
   return false;
 }
}
else{ $errorconn=mysqli_error($db->getConn());
           trigger_error("$errorconn");
      }

}

function fillarrayinvoicedescriptionamount(){
    $this->invoicesdescriptionsamount= array();
  $result=$this->readinvoicedescriptionamount();
  while($row = $this->db->fetchRow($result)){
    array_push($this->invoicesdescriptionsamount, new InvoiceDescriptionAmount($this->contractid ,$row['invoiceID'],$row['totalprice']
    ,$row['totalvat'],$row['issuedate']));
  echo "invoiceid  ".$row['invoiceID'] ."total ". $row['totalprice'] ."vat ".$row['totalvat']."date ". $row['issuedate'];
  }

}
function getarraylength(){
  return sizeof($this->invoicesdescriptionsamount);
}

function readcontract($contractid){

    $sql = "SELECT * FROM `contract` where contractID=$contractid";
     $this->db = $this->connect();
    $result = $this->db->query($sql);
    if ($result){
      while($row = $this->db->fetchRow($result)){

              $this->date=$row['issuedate'];
              $this->testing=$row['testing'];
              $this->retention=$row['retention'];
              $this->duration=$row['duration'];
              $this->clientname=$row['clientname'];
              $this->engineerid=$row['engID'];
              $this->downpayment=$row['downpayment'];
              $this->taxfileno=$$row['taxfileno'];
              $this->creatorid=$row['creatorID'];
              $this->downpaymentpercentage=$row['downpaymentpercentage'];
    }
  }
    else {
      $errorconn=mysqli_error($this->db->getConn());
         trigger_error("$errorconn");
    echo "<script>alert('Contract Doesn't Exist');</script>";
    }

}


function CalculateDownPaymentPercentage(){
$this->downpaymentpercentage=($this->downpayment*100)/$this->totalprice;
$sql="UPDATE `contract` SET `downpaymentpercentage`=$this->downpaymentpercentage WHERE contractID=$this->contractid";
$db=$this->connect();
$result = $db->query($sql);
if($result){

    echo "<script>alert('downpayment percentage Calculated Successfully');</script>";
}
  else{  echo "<script>alert('downpayment percentage could not be  Calculated Successfully ');</script>";
    $errorconn=mysqli_error($db->getConn());
       trigger_error("$errorconn");
     }

}
function CheckDownPayment(){
  if($this->totalprice < $this->downpayment){
    $sql="UPDATE `contract` SET `status`='Error' WHERE contractID=$this->contractid";
    $db=$this->connect();
    $result = $db->query($sql);
    if($result){
    echo "<script>alert('Status error updated');</script>";
    $_SESSION['contractidedit']=$this->contractid;
     echo '<script>window.location.href= "Contract.php?action=editcontractformstatus";</script>';
    }
      else{  echo "<script>alert('couldn't update status error ');</script>";
        $errorconn=mysqli_error($db->getConn());
           trigger_error("$errorconn");
         }

  }else {
    $sql="UPDATE `contract` SET `status`='ongoing' WHERE contractID=$this->contractid";
    $db=$this->connect();
    $result = $db->query($sql);
    if($result){
    echo "<script>alert('Status ongoing updated');</script>";
  //   echo '<script>window.location.href= "Contract.php";</script>';
    }
      else{  echo "<script>alert('couldn't update status error ');</script>";
        $errorconn=mysqli_error($db->getConn());
           trigger_error("$errorconn");
         }
  }
}

function CalculateTotalPrice(){
foreach($this->items as $item){
  $this->totalprice=$this->totalprice+($item->getquantity()*$item->getprice());

}
$sql="UPDATE `contract` SET `totalprice`=$this->totalprice WHERE contractID=$this->contractid";
$db=$this->connect();
$result = $db->query($sql);
if($result){

    echo "<script>alert('Total Price Calculated Successfully $this->totalprice ,id= $this->contractid');</script>";
      $this->CalculateDownPaymentPercentage();
      $this->CheckDownPayment();
}
  else{  echo "<script>alert('Total Price could not be Calculated ');</script>";
    $errorconn=mysqli_error($db->getConn());
       trigger_error("$errorconn");}

}
function getitemnameinfo($itemid){
  foreach($this->items as $item){
    if($item->getitemid() == $itemid){
      $name=$item->getname();
       return $name ;
    }
  }
}
function getitemunitinfo($itemid){
  foreach($this->items as $item){
    if($item->getitemid() == $itemid){
      $unit=$item->getunit();
       return $unit ;
    }
  }
}
function getitemquantityinfo($itemid){
  foreach($this->items as $item){
    if($item->getitemid() == $itemid){
      $quantity=$item->getquantity();
       return $quantity ;
    }
  }
}
function getitempriceinfo($itemid){
  foreach($this->items as $item){
    if($item->getitemid() == $itemid){
      $price=$item->getprice();
       return $price ;
    }
  }
}


 function setcontractID($id){
  $this->contractid=$id;
}
public function getdate(){
  return $this->date;
}
public function getcontractID(){
  return $this->contractid;
}
public function getRetention(){
  return $this->retention;
}
public function getinvoicesarray(){
  return $this->invoicesdescriptionsamount;
}
public function getduration(){
  return $this->duration;
}
public function getdownpayment(){
  return $this->downpayment;
}
public function gettax(){
  return $this->taxfileno;
}
function setclient($clientname){
  $this->clientname=$clientname;
}
public function getclient(){
  return $this->clientname;
}
public function getitems(){
  return $this->items;
}

public function getdownpaymentpercentage(){
  return  $this->downpaymentpercentage;
}
public function gettesting(){
  return $this->testing;
}
public function getengineerid(){
  return $this->engineerid;
}
public function gettaxfileno(){
  return $this->taxfileno;
}public function getcreatorid(){
  return $this->creatorid;
}
}
 ?>
