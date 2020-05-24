<?php

require_once(__ROOT__ . "controller/Controller.php");

class UsersController extends Controller{

public function  login(){
  $name = $_REQUEST['username'];
  $password = $_REQUEST['password'];

if($this->validatepassword($password)){
  $this->model->login($name,$password);}
  else
  {echo "<script>alert('password incorect');</script>";}
    ////  header("Location:index.php");}
  }

	public function checkusername($username){
			$sql="SELECT 'username' FROM user WHERE username='$username'";
			$db=$this->model->connect();
      $result=$db->query($sql);

			if($result){
				if($result->num_rows > 0)
				{     echo "<script>alert('Username already taken , try another one!');</script>";
	                  echo '<script>window.location.href= "Admin.php?action=insertuser";</script>';
	                     return false;
			}
			else {return true;}

			}
			else{       $errorconn=mysqli_error($this->conn);
			            trigger_error("$errorconn");
						echo "<script>alert('invalid input try agaian!');</script>";
						echo '<script>window.location.href= "Admin.php?action=insertuser";</script>';
						}
		}

  function validatepassword($password )
    {      $passlength=strlen("$password");
          if($passlength < 8){
            echo "<script>alert('Password must be more than 8 characters');</script>";
            echo '<script>window.location.href= "Admin.php?action=insertuser";</script>';
            return false;}
  //  throw new Exception ("Invalid password !!");
      return true;
}
public function editemployee(){
//	echo "<script>alert('in edit controller');</script>";
	$username=$_REQUEST["username"];
	$acctype=$_REQUEST["AccTypeID"];
	$this->model->edit($username,$acctype);

}
public function adduser(){
	$username=$_REQUEST["username"];
	$acctype=$_REQUEST["acctype"];
	$password=$_REQUEST["password"];
	if($this->checkusername($username) && $this->validatepassword($password)){
		//	echo "<script>alert('after checking password  !');</script>";
	$this->model->insertUser($username,$acctype,$password);
}
}
public function deleteuser(){
		$username=$_REQUEST["username"];
	$this->model->delete($username);
}

}
?>
