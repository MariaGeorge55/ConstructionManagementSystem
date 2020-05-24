<?php
require_once("../app/Model/Model.php");
class usermodel extends Model{
 private $username;
 private $acctype;
 private $password;

 public function __construct($username,$acctype="",$password=""){
      $this->username = $username;
	    $this->db = $this->connect();

    if(""===$acctype){
      $this->readUser($username);
    }else{
      $this->username = $username;
	    $this->password=$password;
      $this->acctype = $acctype;
    }
 }
 function readUser($username){
    $sql = "SELECT * FROM user where username=".$username;
    $db = $this->connect();
    $result = $db->query($sql);
    if ($result->num_rows == 1){
        $row = $db->fetchRow();
        $this->acctype = $row["acctype"];
		$_SESSION["acctype"]=$row["acctype"];
    }
    else {
      echo "<script>alert('username doesn't exist ,try again)";
      	header("Location:index.php");
    }
  }


     function getPassword() {
      return $this->password;
    }
    function setPassword($password) {
      return $this->password = $password;
    }
    function setacctype($acctype) {
      return $this->acctype = $acctype;
    }
    function getacctype() {
      return $this->acctype;
    }
    function setusername($username) {
      return $this->username = $username;
    }

    function getusername() {
      return $this->username;
    }

}

 ?>
