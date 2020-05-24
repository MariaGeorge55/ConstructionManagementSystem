<?php
require_once(__ROOT__ . "View/View.php");
require_once("../Main/Contract.php");
require_once(__ROOT__ ."/Model/ContractModel.php");
require_once(__ROOT__ ."/Model/ContractManagerModel.php");

class ContractManagerView extends view{

public function output(){

/*  <td><form  method="post" action="Contract.php?action=deletecontract">
  <input type="hidden" value="'.$contract->getcontractID().'" name="contractid">
  <button tye="submit" name="deletecontract" class="buttonViewAllInvoices">Delete</button>
  </form></td>*/

  $str=' <section id="contracts" class="contact">
      <div class="container">
          <div class="containerViewContracts">
            <table class="contracts" style="width:700px">
            <tr  class="contracts">
              <th class="contracts">ContractID</th>
  			      <th class="contracts">Client Name</th>
              <th class="contracts">Actions</th>
            </tr>';
              foreach($this->model->getcontracts() as $contract){
        $str=$str.'<tr class="contracts">
        <td class="contracts">'.$contract->getcontractID() .'</td>
          <td class="contracts">'.$contract->getclient() .' </td>
          <td class="contracts"><form method="post" action="Contract.php?action=editcontractform">
          <input type="hidden" value="'.$contract->getcontractID().'" name="contractid">
          <button type="submit" name="editcontract"class="buttonViewAllInvoices">Edit Contract </button>
          </form></td>
          <td class="contracts"><form  method="post" action="Contract.php?action=viewcontractdetails">
          <input type="hidden" value="'.$contract->getcontractID().'" name="contractid">
          <button tye="submit" name="viewdetails" class="buttonViewAllInvoices">View more details</button>
          </form></td>
         </tr>';
       }
       $str=$str.'  </table><br>
  <form action="Contract.php?action=createcontract" method="post">
  <button  class="buttonAddEmployee" >Create contract</button></form>
   </div>
  </section>';
    return $str;
}

public function createcontract(){

$str='
    <section id="Login" class="contact">
      <div class="container">

        <div class="section-login" data-aos="fade-up">
          <h2 class="createcontractheader">Create New Contract</h2>
        </div>
          <div class="containerLogin">
            <div class="col-md-12">
          <div class="col-md-6">
                  <div class="card-body card-block">
            <form class="form-horizontal" method = "post" action = "Contract.php?action=additemsform">
                Client/Companys Name:<br>
                <input type="text" class="form-control" placeholder="name" name ="clientname" required="required">
                Date of Creation:<br>
                <input type="date" class="form-control" placeholder="creation date" name="date" required="required">
				End Date:<br>
                <input type="date" class="form-control" placeholder="Duration" name="duration" required="required">
				Down-Payment:<br>
                <input type="number" class="form-control" placeholder="down-payment" name="downpayment" required="required">
				Tax File number:<br>
                <input type="number" class="form-control" placeholder="Tax File no." name="taxfileno" required="required">
				Retention%:<br>
                <input type="percent" class="form-control" placeholder="retention" name="retention" required="required">
				 <label>Assigned Engineer: </label>
         <select name="engineerid"  class="form-control" required="required">';
foreach($this->model->getengineers() as $rows){
$str=$str. '<option value="'.$rows.'">'.$rows.'</option>';
}
$str=$str.'</select><br><br><br>';
              $str=$str.'  <button type="submit" class="btn btn-success btn-smLogin" name = "insertcontract"  >
                <i class="fa fa-dot-circle-o"></i> Submit
              </button>
              <br><br>
		    </form>
 </div>
        </div>
        </div>
        </div>


              <br>
              <br>


    </section><!-- End Contact Section -->';
return $str;

}
public function additemsform(){
$str='
<section id="Login" class="contact">
  <div class="container">
<div class="containerAddItems" id="item" >
              <div class="col-md-12">
            <div class="col-md-6">
                    <div class=" -body card-block">
              <form class="form-horizontal" method = "post" action = "Contract.php?action=additemsform">
                  Items description:<br>
                  <input type="text" class="form-control" placeholder="name" id="description" name ="itemname" required="required">
                  Price per unit:<br>
                  <input type="number" class="form-control" placeholder="Price per unit" name="priceperunit" required="required">
  				Unit:<br>
                  <input type="text" class="form-control" placeholder="Unit" name="unit" required="required">
  				Quantity:<br>
                  <input type="number" class="form-control" placeholder="Quantity" name="quantity" required="required">
  				Testing%:<br>
                  <input type="percent" class="form-control" placeholder="Testing" name="testing" required="required">
  				<br>
  				VAT%:<br>
                  <input type="percent" class="form-control" placeholder="VAT" name="vat" required="required">
  				<br>
                  <button type="submit" class="btn btn-success btn-smLogin" name = "additems"  >
                  <i class="fa fa-dot-circle-o"></i> Submit
                </button>
                <form action="Contract.php?action=finishitems" method="post">
                <button type="submit" name="finish" class="btn btn-danger btn-smLogin">
                  <i class="fa fa-ban"></i> Finish-Submit
                </button></form><br><br>


                <br>
                <br>
                </form>
          </div>
          </div>
          </div>
          </div>
          </div></section><br><br>';
          return $str;

}

public function editcontractform($editid){
  foreach($this->model->getcontracts() as $contract){
    if($contract->getcontractID() == $editid){
    $downpayment=$contract->getdownpayment();
    $duration=$contract->getduration();
    $clientname=$contract->getclient();
    $issuedate=$contract->getdate();
    $tax=$contract->gettax();
  //  $itemsarr=array();
  //  $itemsarr=$contract->getitems();
    break;
  }
  }
$str='  <section id="editemployee" class="contact">
       <div class="container">
         <div class="section-EditContract" data-aos="fade-up">
           <h2 class="editc">Edit Contract</h2>
         </div>
            <div class="containerLogin">
              <div class="col-md-12">
                 <div class="col-md-6">
                    <div class="card-body card-block">
            <form class="form-horizontal" method = "post" action = "Contract.php?action=edititemsform"">
                 Client/Companys Name:<br>
                 <input type="text" class="form-control" value="'.$clientname.'" name ="clientname" required="required">
         End date:<br>
                 <input type="date" class="form-control" value="'.$duration.'" name="newduration" >
         Down-Payment:<br>
                 <input type="number" class="form-control" value="'.$downpayment.'" name="downpayment" required="required">
         Tax File number:<br>
                 <input type="number" class="form-control" value="'.$tax.'" name="taxfileno" required="required">
                       <br>
                        ';


              $str=$str.'<br><button type="submit" class="btn btn-success btn-smSubmitEditCC" name = "submitedit"  >
                 <i class="fa fa-dot-circle-o"></i> Submit
               </button><br>
               <button type="submit" class="btn btn-success btn-smSubmitEditCC" name = "edititems"  >
                  <i class="fa fa-dot-circle-o"></i> Edit Item
                </button><br>
               <input type="hidden" value="'.  $issuedate.'" name="issueduration">
               <input type="hidden" value="'.  $duration.'" name="oldenddate">
               <input type="hidden" value="'.$editid.'" name="contractid">';
               $_SESSION['contractid']=$editid;
            $str=$str.'   </form><br><br>
               </div>
               </div>
               </div>
                 </div>
                   </div>';
 return $str;


}
public function edititemsform($contractid){
  foreach($this->model->getcontracts() as $contract){
    if($contract->getcontractID() == $contractid){
   $itemsarr=array();
   $itemsarr=$contract->getitems();
    break;
  }
  }
$str=' <section id="items" class="edititemsform">
    <div class="container">
     <div class="containerViewContracts">
  <table id="items" style="width:700px">
         <tr>
           <th>item name &nbsp;  </th>
           <th>Quantity  &nbsp;  </th>
          <th>New Quantity  &nbsp;  </th>
         </tr>';
  foreach($itemsarr as $item){
      $itemid=$item->getitemid();
      $oldquantity=$item->getquantity() ;////to be validate with new quantity
   $str=$str.'<tr><form method="post" action="Contract.php">
              <td>'.$item->getname() .'</td>
              <td>'.$item->getquantity() .' </td>
              <td>
              <input type="number" name="newquantity" value="'.$item->getquantity() .'" >
              <button type="submit" class="btn btn-success " name = "edititem">
                 <i class="fa fa-dot-circle-o"></i> Edit </button> </td>
               <input type="hidden" value="'.$itemid.'" name="itemid">
               </form></tr> ';

            }
 $str=$str.'</table><br>
  </div> </div></section>';

return $str;

}

public function viewcontractdetails($contractid){
$str='<section id="EngInv" class="contact">
      <div class="container">
          <div class="containerEngInv2">';
  foreach($this->model->getcontracts() as $contract){
    if($contract->getcontractID() == $contractid){
      $str=$str.'
       <p> ContractID :  '.$contract->getcontractID().' </P>
      <tr><td>  <p>Contracts Date : '.$contract->getdate().'</P> </td></tr>
      <tr><td><p> Contracts Ends : '.$contract->getduration().' </P> </td> </tr>
      <tr><td><p> Contracts creator : '.$contract->getcreatorid().' </P> </td> </tr>
      <tr><td><p> Client Name : '.$contract->getclient().' </P> </td> </tr>
      <tr><td><p> Company tax file number  :  '.$contract->gettaxfileno().' </P> </td> </tr>
      <tr><td><p> Engineer name  : '.$contract->getengineerid().' </P> </td> </tr>

          <table id="EngViewAllInv" style="width:700px">
          <tr>
          <th>Item name </th>
          <th>Item Quantity </th>
          <th>Item Price </th>
          <th>Item Unit </th>
          <th> Vat </th>
          <th>Testing </th>
          </tr>' ;
        foreach($contract->getitems() as $item){
          $str=$str.'<tr><td>'  .$item->getname().' </td>
                    <td>'  .$item->getquantity().' </td>
                     <td>'  .$item->getprice().' </td>
                     <td>'  .$item->getunit().' </td>
                     <td>'  .$item->getvat().' </td>
                     <td>'  .$item->gettesting().' </td></tr>
                          ';
        }
       $str=$str.'</table> <br>  <div class="container">
       <form  method="post" action="Contract.php?action=viewallinvoices">
       <input type="hidden" value="'.$contract->getcontractID().'" name="contractid">
       <button type="submit" name="viewinvoices" class="buttonAddEmployee">View All Invoices</button>
       </form></div>';

    }
  }
  $str=$str.'</div></div></section>';

return $str;
}

public function viewallinvoices($contractid){
  $str='';
      foreach($this->model->getcontracts() as $contract){
        if($contract->getcontractID()==$contractid){
          $contractdate=$contract->getdate();
          $clientname=$contract->getclient();


  $str=' <section id="EngInv" class="contact">
        <div class="container">

            ';
              foreach($contract->getinvoicesarray() as $invoiceamount){
    $str=$str.'  </div>  <div class="containerEngInv3">
              <p>ContractID:'.$contract->getcontractID().' </P>
              <p>Contracts Date:'.$contractdate.'</P>
              <p>Companys Name:'.$clientname.'</P>
              <p>Invoices Date:'.$invoiceamount->getdate().'</P>
              <p>Invoices ID:'.$invoiceamount->getinvoiceid().'</P>';

            $str=$str.'  <table id="EngViewAllInv" style="width:700px">';
          $str=$str.'    <tr>
              <th>Item</th>
              <th>Unit</th>
              <th>Previous</th>
              <th>Current</th>
              <th>Overall Quantity</th>
              <th> price</th>
              <th>Total price</th>
            </tr>';
            $itemsprice=0;
              foreach($invoiceamount->getinvoiceitemsarray() as $invoiceitem){
                $itemname=$contract->getitemnameinfo($invoiceitem->getitemid());
                $iteminfo=$contract->getitemunitinfo($invoiceitem->getitemid());
                $itemprice=$contract->getitempriceinfo($invoiceitem->getitemid());
            $str=$str.'<tr>
              <td>'.$itemname.'</td>
              <td>'.$iteminfo.'</td>
              <td>'.$invoiceitem->getprevious().'</td>
              <td>'.$invoiceitem->getquantity().'</td>
              <td>'.($invoiceitem->getquantity() + $invoiceitem->getprevious()).'</td>
              <td>'.$itemprice.'</td>
              <td>'.($invoiceitem->getquantity() * $itemprice).'</td>
            </tr>';
                $itemsprice=$itemsprice+($invoiceitem->getquantity() + $itemprice);
          }

         $downpaymentamout=($contract->getdownpaymentpercentage() * $itemsprice)/100;
         $retentionamout=($contract->getRetention() * $itemsprice) /100;
        $str=$str.'
        <tr><td colspan="6">  Invoice Price  </td><td>'.$itemsprice .'</td></tr>
        <tr><td colspan="6"> Downpayment %   '.$contract->getdownpaymentpercentage() .'</td>
        <td>'.$downpaymentamout.'</td> </tr>
        <tr><td colspan="6"> Retention %   '.$contract->getRetention() .'</td>
        <td>'.$retentionamout.'</td> </tr>
       <tr><td colspan="6"> Total Invoice Price </td><td> '.($itemsprice-$downpaymentamout-$retentionamout) .'</td></tr>
        </table><br>
         <form  method="post" action="Contract.php">
         <input type="hidden" value="'.$contract->getcontractID().'" name="contractid">
         <button type="submit" name="print" class="buttonAddEmployee">Print Invoice</button>
         </form>' ;
    }
        $str=$str.'
        </section>';
    }
  }
return $str;
}

}
?>
