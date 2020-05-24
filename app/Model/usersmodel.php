<?php
require_once(__ROOT__ . "Model/Model.php");
require_once(__ROOT__ . "Model/usermodel.php");
//session_start();
class usersmodel extends Model {
	private $users;
	function __construct() {
		$this->fillArray();
	}

	function fillArray() {
		$this->users = array();
		$this->db = $this->connect();
		$result = $this->readUsers();
		while ($row = $result->fetch_assoc()) {
			array_push($this->users, new usermodel($row["username"],$row["acctype"],$row["password"]));
		}
	}

	function getUsers() {
		return $this->users;
	}

	function readUsers(){
		$sql = "SELECT * FROM user";

		$result = $this->db->query($sql);
		if ($result->num_rows > 0){
			return $result;
		}
		else {
			return false;
		}
	}

  function login($username,$password){
     $sql = "SELECT * FROM `user` WHERE username='$username' AND password='$password'";
     $db=$this->connect();
     $result=$db->query($sql);
     if ($result->num_rows == 1){
			 $row=$db->fetchRow($result);
			 $_SESSION['acctype']=$row['acctype'];
			 echo "<script>alert('Logged in Successfully');</script>";
				   $acctype=$row['acctype'];
				   $_SESSION['username']=$username;
	         $_SESSION['acctype']=$acctype;
				   $sql2="SELECT page , pagename FROM accountype WHERE acctype='$acctype'";

				   if($result2=$db->query($sql2)){
                while($row2=$db->fetchRow($result2)){
	              $_SESSION['page']=$row2['page'];
							  $_SESSION['pagename']=$row2['pagename'];}
							}
          else{  $errorconn=mysqli_error($db->getConn());
				                trigger_error("$errorconn");
							}
		        echo '<script>window.location.href= "index.php";</script>';
     return true;
      }
  else{
		  echo "<script>alert('not found');</script>";
      }
}


	function insertuser($name, $acctype, $password){
		$sql = "INSERT INTO user (username, password, acctype) VALUES ('$name','$password','$acctype')";
		if($this->db->query($sql) === true){
			echo "Records inserted successfully.";
			$this->fillArray();
			echo '<script>window.location.href= "Admin.php";</script>';
		}
		else{
			$errorconn=mysqli_error($this->db->getConn());
		                trigger_error("$errorconn");
			echo "ERROR: Could not able to execute $sql. " . $conn->error;
		}
	}

function edit($username ,$acctype){
	//	echo "<script>alert(edit model);</script>";
$sql="UPDATE `user` SET `acctype`='$acctype' WHERE `username`='$username'";
$result=$this->db->query($sql);
if($result){
	echo "<script>alert(User upated successfully);</script>";
	echo '<script>window.location.href= "Admin.php";</script>';
}
else{$errorconn=mysqli_error($this->db->getConn());
							trigger_error("$errorconn");
				echo "<script>alert('couldn't update user');</script>";
		}
}
function delete($username){
	$sql="DELETE FROM `user` WHERE `username`='$username'";
	$result=$this->db->query($sql);
	if($result){
		echo "<script>alert(User Deleted successfully);</script>";
		echo '<script>window.location.href= "Admin.php";</script>';
	}
	else{$errorconn=mysqli_error($this->db->getConn());
                trigger_error("$errorconn");
					echo "<script>alert('couldn't delete user');</script>";
			}

}


function getacctype(){
	$arr=array();
	$sql = "SELECT `acctype` FROM `accountype`  ";
	$result=$this->db->query($sql);
	if($result){
				while ($row = $this->db->fetchRow($result)) {

	      array_push($arr,$row['acctype']);
	   }

	}else {$errorconn=mysqli_error($this->db->getConn());
                trigger_error("$errorconn");}
 return $arr;
}
}
