<?php
require_once(__ROOT__ . "Model/Model.php");
require_once(__ROOT__ . "Model/ContractModel.php");
require_once(__ROOT__ . "Model/InvoiceDescription.php");
class InvoiceDescriptionAmount extends Model{
private $invoiceid;
private $contractid;
private $totalprice;
private $totalvat;
private $issuedate;

private $invoicedescriptionitems;///array of inv des items
function __construct($contractid="" ,$invoiceid,$totalprice="",$totalvat="",$issuedate=""){
      $this->db = $this->connect();
      $this->invoiceid=$invoiceid;
      $this->contractid=$contractid;
      $this->fillarrayinvoicedescription();
      if($totalprice=== "" OR $totalvat==="" OR $issuedate===""){
        $this->ReadInvoiceAmount($contractid);

      }
    else{
          $this->totalprice=$totalprice;
          $this->totalvat=$totalvat;
          $this->issuedate=$issuedate;

  }
          }
function ReadInvoiceAmount($contractid){
           $sql = "SELECT * FROM `invoicedescriptionamount` where contractID=$contractid  AND invoiceID=$this->invoicedesID ";
           $this->db=$this->connect();
           $result = $this->db->query($sql);
if($result){
           if ($result->num_rows > 0){
             $this->totalprice=$row['totalprice'];
             $this->totalvat=$row['totalvat'];
             $this->issuedate=$row['issuedate'];

           }
           else {
             return false;
           }
         }
      else{      $errorconn=mysqli_error($db->getConn());
                 trigger_error("$errorconn");
          }

          }

          function readinvoicedescription(){
           $sql = "SELECT * FROM `invoicedescriptionitems` where  invoiceID='$this->invoiceid'";
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

      function fillarrayinvoicedescription(){
            $this->invoicedescriptionitems= array();
            $result=$this->readinvoicedescription();
            while($row = $this->db->fetchRow($result)){
              array_push($this->invoicedescriptionitems, new InvoiceDescription($this->contractid ,$this->invoiceid,$row['itemID'],
              $row['previousquantity'],$row['quantity'],$row['date'],$row['status']));
//echo "from invoice amount fillarray :invoiceid  ".$row['invoiceID'] ."itemid  ". $row['itemID'] ."previous  ".$row['previousquantity']."quantity  ". $row['quantity']."date  ".$row['date'];
            }

          }

          public function getinvoiceid(){
           return $this->invoiceid;
          }

          public function gettotalprice(){
           return $this->totalprice;
          }

          public function getdate(){
  //          echo "issueadte in invoice amount=".$this->issuedate;
 return $this->issuedate;
          }

          public function gettotalvat(){
           return $this->totalvat;
          }
          public function getcontractid(){
           return $this->contractid;
          }
          public function getinvoiceitemsarray(){
            return $this->invoicedescriptionitems;
          }
}
 ?>
