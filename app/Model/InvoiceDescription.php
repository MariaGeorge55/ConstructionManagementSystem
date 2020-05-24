<?php
require_once(__ROOT__ . "Model/Model.php");
require_once(__ROOT__ . "Model/ContractModel.php");
class InvoiceDescription extends Model{
private $invoicedescriptionid;
private $quantity;
private $previous;
private $date;
private $itemid;
private $status;
private $contractid;
function __construct($contractid="" ,$invoicedescriptionid,$itemid="",$previous="",$quantity="",$issuedate="",$status=""){
      $this->db = $this->connect();
      $this->itemid=$itemid;
    //  echo "item id from invoice des items constructor=".$itemid;
      $this->invoicedescriptionid=$invoicedescriptionid;
      $this->contractid=$contractid;
      $this->status=$status;
      if($previous === "" OR $quantity === "" OR $issuedate ==="" OR $itemid==="" OR $status===""){
        $this->readinvoicedescription();

      }
    else{
          $this->quantity=$quantity;
          $this->previous=$previous;
          $this->issuedate=$issuedate;
          $this->itemid=$itemid;
  }
          }
function readinvoicedescription(){
           $sql = "SELECT * FROM `invoicedescriptionitems` where itemID='$this->itemid'  AND invoiceID='$this->invoicedescriptionid' ";
           $db=$this->connect();
           $result = $db->query($sql);
      if($result){
           if ($result->num_rows > 0){
                while($row=$db->fetchRow($result)){
             $this->quantity=$row['quantity'];
             $this->previous=$row['testing'];
             $this->issuedate=$row['issuedate'];
             $this->itemid=$row['itemid'];
           }
           }
           else {
             return false;
           }
         }
      else{       $errorconn=mysqli_error($db->getConn());
                    trigger_error("$errorconn");
              }

          }

          function setitemid($id){
           $this->itemid=$id;
          }
          public function getitemid(){
           return $this->itemid;
          }
          function setinvoicedescriptionid($id){
           $this->invoicedescriptionid=$id;
          }
          public function getinvoicedescriptionid(){
           return $this->invoicedescriptionid;
          }
          function setdate($issuedate){
           $this->issuedate=$issuedate;
          }

          public function getdate(){
           return $this->issuedate;
          }
          function setquantity($quantity){
           $this->quantity=$quantity;
          }
          public function getquantity(){
           return $this->quantity;
          }
          function setprevious($previous){
           $this->previous=$previous;
          }
          public function getprevious(){
           return $this->previous;
          }
          public function getstatus(){
           return $this->status;
          }
}
 ?>
