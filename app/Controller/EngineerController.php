<?php

require_once(__ROOT__ . "controller/Controller.php");

class EngineerController extends Controller{

  public function editinvoiceditems(){
    $invoiceid=$_REQUEST['invoiceid'];
    $itemid=$_REQUEST['itemid'];
    $previous=$_REQUEST['previous'];
    $quantity=$_REQUEST['quantity'];
    $contractquantity=$_REQUEST['contractquantity'];
    $this->model->EditInvoice($invoiceid,$itemid,$previous,$quantity,$contractquantity);

  }
}
