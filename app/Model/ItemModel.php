<?php
require_once(__ROOT__ . "Model/Model.php");
require_once(__ROOT__ . "Model/ContractModel.php");
require_once("../app/db/Dbh.php");
class ItemModel extends Model{
private $itemid;
private $name;
private $quantity;
private $price;
private $unit;
private $vat;
private $testing;
protected $db;

function __construct($itemid,$name="",$quantity="",$price="",$unit="",$vat="",$testing=""){
  $this->db=new Dbh();
      $this->db = $this->connect();
      $this->itemid=$itemid;
      if($name === "" OR $quantity === "" OR $price === "" OR $unit === ""  OR $vat=== "" OR $testing ===""){
        $this->readitem($itemid);

      }
    else{ $this->name=$name;
          $this->quantity=$quantity;
          $this->testing=$testing;
          $this->price=$price;
          $this->unit=$unit;
          $this->vat=$vat;
             }
          }

  function readitem($itemid){
           $sql = "SELECT * FROM `items` WHERE itemID=".$itemid;
           $this->db=$this->connect();
           $result = $this->db->query($sql);
    if($result){
      if ($result->num_rows > 0){
             while($row=$this->db->fetchRow($result)){
                   $this->name=$row['name'];
                   $this->quantity=$row['quantity'];
                   $this->testing=$row['testing'];
                   $this->price=$row['price'];
                   $this->unit=$row['unit'];
                   $this->vat=$row['vat'];
                 }

      }
      else{ echo "<script>alert('No Items Found $itemid');</script>";}
      }
     else {
             echo "<script>alert('error in sql $itemid ');</script>";
             $errorconn=mysqli_error($this->db->getConn());
             trigger_error("$errorconn");}
             return false;
           }

function setitemsid($id){
 $this->itemid=$id;
}
public function getitemid(){
 return $this->itemid;
}
function setname($name){
 $this->name=$name;
}

public function getname(){
 return $this->name;
}
function setquantity($quantity){
 $this->quantity=$quantity;
}
public function getquantity(){
 return $this->quantity;
}
function setprice($price){
 $this->price=$price;
}
public function getprice(){
 return $this->price;
}
function setvat($vat){
 $this->vat=$vat;
}
public function getvat(){
 return $this->vat;
}
function settesting($testing){
 $this->testing=$testing;
}
public function gettesting(){
 return $this->testing;
}
function setunit($unit){
 $this->unit=$unit;
}
public function getunit(){
 return $this->unit;
}


}



 ?>
