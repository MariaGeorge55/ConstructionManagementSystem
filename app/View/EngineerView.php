<?php
require_once(__ROOT__ . "View/View.php");
require_once("../Main/Engineer.php");
require_once(__ROOT__ ."/Model/ContractModel.php");
require_once(__ROOT__ ."/Model/EngineerModel.php");
require_once(__ROOT__ ."/Model/InvoiceDescription.php");
require_once(__ROOT__ ."/Model/InvoiceDescriptionAmount.php");
require_once(__ROOT__ ."/Model/ItemModel.php");

class EngineerView extends view{
public function output(){

$str=' <section id="contracts" class="contact">
      <div class="container">
          <div class="containerEngViewInv">
            <table id="contracts" style="width:700px">
            <tr class="contracts">
              <th class="contracts">ContractID</th>
  			      <th class="contracts">Client Name</th>
              <th class="contracts">Actions</th>
            </tr>';
              foreach($this->model->getcontractarray() as $contract){
        $str=$str.'<tr class="contracts">
        <td class="contracts">'.$contract->getcontractID() .'</td>
          <td class="contracts">'.$contract->getclient() .' </td>
          <td class="contracts"><form method="post" action="Engineer.php?action=editcontractform">
          <input type="hidden" value="'.$contract->getcontractID().'" name="contractid">
          <button type="submit" name="addinvoice"class="buttonAddInvoice">Add Invoice </button>
          </form></td>
          <td class="contracts"><form  method="post" action="Engineer.php?action=viewallinvoices">
          <input type="hidden" value="'.$contract->getcontractID().'" name="contractid">
          <button tye="submit" name="viewinvoices" class="buttonViewAllInvoices">View All Invoices</button>
          </form></td>
         </tr>';
       }
       $str=$str.'  </table><br>
   </div>
  </section>';
    return $str;

}

public function viewallinvoices($contractid){
  $str='';
      foreach($this->model->getcontractarray() as $contract){
        if($contract->getcontractID()==$contractid){
          $contractdate=$contract->getdate();
          $clientname=$contract->getclient();


  $str=' <section id="EngInv" class="contact">
        <div class="container">

            <div class="containerEngInv">
              <p>ContractID:'.$contract->getcontractID().' </P>
              <p>Contracts Date:'.$contractdate.'</P>
              <p>Companys Name:'.$clientname.'</P>';
              $length=$contract->getarraylength();
            //  echo "length array =".$length;;
              $count=0;
              foreach($contract->getinvoicesarray() as $invoiceamount){
              //  echo "invoice amount id=".$invoiceamount->getinvoiceid();

    $str=$str.'  </div>  <div class="containerEngInv2">
              <p>Invoices Date:'.$invoiceamount->getdate().'</P>';
          //  echo "invoice amount date from engineer view=". $invoiceamount->getdate();
            $str=$str.'  <table id="EngViewAllInv" style="width:700px">';
          $str=$str.'    <tr>
              <th>Item</th>
              <th>Unit</th>
              <th>Previous</th>
              <th>Current</th>
              <th>Status</th>
            </tr>';
              foreach($invoiceamount->getinvoiceitemsarray() as $invoiceitem){
              //  echo "invoice items id=".$invoiceitem->getinvoicedescriptionid();
              //    echo "itemid is  =".$invoiceitem->getitemid()."  ";
              //  $item=new ItemModel($invoiceitem->getitemid());
                $itemname=$contract->getitemnameinfo($invoiceitem->getitemid());
                $iteminfo=$contract->getitemunitinfo($invoiceitem->getitemid());
            $str=$str.'<tr>
              <td>'.$itemname.'</td>
              <td>'.$iteminfo.'</td>
              <td>'.$invoiceitem->getprevious().'</td>
              <td>'.$invoiceitem->getquantity().'</td>
              <td>'.$invoiceitem->getstatus().'</td>
            </tr>';

          }
        /*if($count == $length-1 ){
            $str=$str.'<tr><form  method="post" action="Engineer.php?action=editinvoice">
            <input type="hidden" value="'.$invoiceamount->getinvoiceid().'" name="invoiceid">
            <input type="hidden" value="'.$contractid.'" name="contractid">
            <button tye="submit" name="editinvoice" class="btn btn-success btn-smLogi">Edit Invoices</button>
            </form></tr>';
        }*/

        $str=$str.'</table>' ;

    if($count == ($length-1) ){
        $str=$str.'<form  method="post" action="Engineer.php?action=editinvoice">
        <input type="hidden" value="'.$invoiceamount->getinvoiceid().'" name="invoiceid">';
//echo "view invoices view ".$contractid;
$_SESSION['invoiceamountid']= $invoiceamount->getinvoiceid();
$_SESSION['contractid']= $contractid;
        $str=$str.'  <input type="hidden" value="'.$contractid.'" name="contractid">
        <br>
        <button tye="submit" name="editinvoice" class="buttonViewAllInvoices2">Edit Invoices</button>
        </form>';
      }
      $count=$count+1;

    }
        $str=$str.'
        </div>
        </section>';
    }
  }
return $str;
}

public function editinvoice($invoiceamountid,$contractid){
  $str="";
  foreach($this->model->getcontractarray() as $contract){
    if($contract->getcontractID()==$contractid){
      echo "in contract if condition";
      foreach($contract->getinvoicesarray() as $invoiceamount){
          if($invoiceamount->getinvoiceid()==$invoiceamountid){
              echo "in invoice amount if condition";
            //  foreach($invoiceamount->getinvoiceitemsarray() as $invoiceitem){
                  echo "in foreach des item";
$str='<section id="EngInv" class="contact">
  <div class="containerEngInv4">

    <div >';
    foreach($invoiceamount->getinvoiceitemsarray() as $invoiceitem){
      $str=$str.'<form class="formEng-horizontal" method = "post" action = "Engineer.php">';
       echo "item id == ". $invoiceitem->getitemid();
        $str=$str.'  <div>
            <p class="Item"> Item: '.$contract->getitemnameinfo($invoiceitem->getitemid()).'</p>
          </div>

        <input type="number" class="formEngAddInvoice" value="'.$invoiceitem->getquantity() .'" name ="quantity" >
        <div class="movebuttonsEngUpdateinv">
      <button type="submit" class="buttonViewAllInvoices" name = "UpdateInvoice">Update Invoice</button>
      <input type="hidden" value="'.$invoiceitem->getitemid().'" name="itemid">
      <input type="hidden" value="'.$contract->getitemquantityinfo($invoiceitem->getitemid()).'" name="contractquantity">
      <input type="hidden" value="'.$invoiceamountid.'" name="invoiceid">
       <input type="hidden" value="'.$contractid.'" name="contractid">

      <input type="hidden" value="'.$invoiceitem->getprevious().'" name="previous">
     <br>
  </form> ';
  $_SESSION['invoiceamountid']= $invoiceamountid;
  $_SESSION['contractid']= $contractid;
    $str=$str.'</div>';
}
    $str=$str.' </div>
          </section>';
        }
}}}
return $str;
}

}

?>
