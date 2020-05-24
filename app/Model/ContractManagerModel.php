<?php
require_once(__ROOT__ . "Model/Model.php");
require_once(__ROOT__ . "Model/Contractmodel.php");

 class ContractManagerModel extends Model{
  private $contracts;
  function __construct(){
    $this->fillarray();
  }
  function fillarray(){
    $this->contracts= array();
    $result=$this->readcontracts();
    if($result){
    while($row = $result->fetch_assoc()){
      array_push($this->contracts, new Contractmodel($row["contractID"], $row['retention'] , $row['duration'] ,
       $row['clientname'],$row['engID'],$row['taxfileno'],$row['creatorID'],$row['issuedate'],$row['downpayment'],$row['downpaymentpercentage']));

    }
  /*  foreach($this->contracts as $contract){
        //  if($contract->getcontractID() == $contractid){
            //$contract->fillarrayitems();
            $contract->CalculateTotalPrice();


        }*/

    }
  else {
  echo "<script>alert('No Contracts Found');</script>";}
  }
  function getengineers(){
  	$arr=array();
  	$sql = "SELECT `username` FROM `user` WHERE acctype ='Engineer' ";
  	$result=$this->db->query($sql);
  	if($result){
  				while ($row = $this->db->fetchRow($result)) {

  	      array_push($arr,$row['username']);
  	   }

  	}
   return $arr;
  }
   function readcontracts(){
     $username=$_SESSION['username'];
   $sql = "SELECT * FROM `contract` WHERE creatorID='$username'";
    $db=$this->connect();
    $result = $db->query($sql);
		if ($result->num_rows > 0){
			return $result;
		}
		else {
      $errorconn=mysqli_error($db->getConn());
                    trigger_error("$errorconn");
      echo "<script>alert('No Contracts Found');</script>";
			return false;
		}
	}

  function InsertContract($retention,$duration,$clientname,$engineerid,$taxfileno,$creatorid,$date,$downpayement){
  $sql="INSERT INTO `contract`(`issuedate`, `downpayment`, `retention`, `duration`, `engID`, `clientname`, `taxfileno`, `creatorID`)
  VALUES ('$date',$downpayement,$retention,'$duration','$engineerid','$clientname',$taxfileno,'$creatorid')";
  $db=$this->connect();
  $result=$db->query($sql);

  if($result){
    echo "<script>alert('Contract Created successfully');</script>";
    $this->fillarray();
    $sql2="SELECT `contractID` FROM `contract` WHERE issuedate='$date' AND clientname='$clientname'";
    $result2=$db->query($sql2);
    while($row2=$db->fetchRow($result2)){
    $newcontractid=$row2['contractID'];

      return $newcontractid;
    }
  }
  else{
    echo "<script>alert('Contract Couldn't Be Created successfully');</script>"; }

  }

  public function getcontracts(){
    return $this->contracts;
  }
  public function  deletecontract($id){
    $sql="DELETE FROM `contract` WHERE `contractID`='$id'";
     $db=$this->connect();
    $result=$db->query($sql);
    if($result){
      echo "<script>alert(Contract Deleted successfully);</script>";
      echo '<script>window.location.href= "Contract.php";</script>';
    }
    else{     $errorconn=mysqli_error($db->getConn());
               trigger_error("$errorconn");
            echo "<script>alert('couldn't delete Contract');</script>";
        }

}

 public function insertitem($zeroorone,$itemname,$priceperunit,$unit,$quantity,$testing,$vat,$contractid){
 $sql="INSERT INTO `items`(`contractID`, `name`, `quantity`, `price`, `unit`, `vat`, `testing`)
 VALUES ($contractid,'$itemname',$quantity,$priceperunit,'$unit',$vat,$testing)";
 $db=$this->connect();
 $result=$db->query($sql);
if($result){
  echo "<script>alert('Item inserted successfully');</script>";
  if($zeroorone == 1){
  foreach($this->contracts as $contract){
      if($contract->getcontractID() == $contractid){
        $contract->fillarrayitems();
        $contract->CalculateTotalPrice();
        break;
      }
    }
    $this->fillarray();
      echo '<script>window.location.href= "Contract.php";</script>';
    }
} else{
         $errorconn=mysqli_error($db->getConn());
           trigger_error("$errorconn");
}


  }
  function EditContract($zeroorone,$downpayment,$taxfileno,$clientname,$contractid,$newduration){
$sql="UPDATE `contract` SET `downpayment`=$downpayment,`duration`=$newduration,`clientname`='$clientname',`taxfileno`=$taxfileno
WHERE `contractID`=$contractid";
$db=$this->connect();
$result=$db->query($sql);
if($result){
 echo "<script>alert('Contract edited successfully');</script>";
 if($zeroorone == 0){
     echo '<script>window.location.href= "Contract.php";</script>';
 }
} else{
        $errorconn=mysqli_error($db->getConn());
          trigger_error("$errorconn");
}
  }

  function EditItem($itemid,$newquantity){
    $sql="UPDATE `items` SET `quantity`=$newquantity WHERE `itemID`=$itemid";
    $db=$this->connect();
    $result=$db->query($sql);
    if($result){
     echo "<script>alert('Item edited successfully');</script>";
     $ccid=$_SESSION['contractid'];
       foreach($this->contracts as $contract){
         if($contract->getcontractID() == $ccid){
           $contract->fillarrayitems();
           $contract->CalculateTotalPrice();
           $this->fillarray();
           echo '<script>window.location.href= "Contract.php?action=edititemsform";</script>';
           break;
         }
       }
    }
    else{   echo "<script>alert('no item upated');</script>";
            $errorconn=mysqli_error($db->getConn());
              trigger_error("$errorconn");
    }

  }

  function checkquantity($new){
    /////new quantity not greater than last delivered
  }
  function checkdate($new){
  /////mayenf3sh el new date yeb2a abl akher issunce of akher invoice
  }


 }

?>
