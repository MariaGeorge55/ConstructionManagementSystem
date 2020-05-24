<?php
require_once(__ROOT__ . "View/View.php");
require_once("../Main/Admin.php");
////require_once("../Model/usersmodel.php");
class AdminView extends view{
public function output(){

  $str='<section id="contracts" class="contact">
      <div class="container">
          <div class="containerEngViewInv">
          <table class="contracts"  style="width:700px">
          <tr>
            <th>Employees username</th>
			<th>Account Type</th>
            <th>Actions</th>
          </tr>';
      foreach($this->model->getUsers() as $user){
        $str=$str.' <tr>
			<td>'.$user->getusername() .'  </td>
      	<td>'.$user->getacctype() .' </td>
        <td><form method="post" action="Admin.php?action=editemployeeform">
        <input type="hidden" value="'.$user->getusername().'" name="username">
        <button class="buttonViewAllInvoices">Edit Employee</button></form></td>
        <td><form method="post" action="Admin.php?action=deleteuser">
        <input type="hidden" value="'.$user->getusername().'" name="username">
        <button class="buttonViewAllInvoices">Delete</button></form></td>
          </tr>';
		 	 }
     $str=$str.'  </table><br>
    <form action="Admin.php?action=insertuser" method="post">
    <button  class="buttonAddEmployee" onclick="window.location.href="Admin.php?action=insertuser">Add New Employee</button></form>
     </div>
    </section>';
    return $str;
}
public function editemployeeform($username)
{
  $editusername=$username;
$str='<section id="editemployee" class="contact">
      <div  class="container">
        <div class="section-login" data-aos="fade-up">
          <h2 >Edit Employee</h2>
        </div>
          <div class="containerLogin">
            <div class="col-md-12">
          <div class="col-md-6">
                  <div class="card-body card-block">
            <form class="form-horizontal" method = "post" action = "Admin.php?action=editemployee">';
    $str=$str. '<Label placeholder="Username" name ="username" >Employee Name: &nbsp;';
    $str=$str.$editusername.'</label>';
    $str=$str.'<label>Account Type: </label>
                                       <select name="AccTypeID"  class="form-control" required="required">';
          foreach($this->model->getacctype() as $rows){
     $str=$str. '<option value="'.$rows.'">'.$rows.'</option>';
 }
          $str=$str.'</select><br><br>';
    $str=$str.'<button type="submit" class="btn btn-success btn-smEdit" name ="edit">
               <input type="hidden" value="'.$username.'" name="username">
                <i class="fa fa-dot-circle-o"></i> Edit</button><br><br>
         </form>
        </div>
        </div>
        </div>
        </div>
    </section>';
    return $str;
}
public function insertuser(){
  $str='<section id="addemployee" class="contact">
      <div class="container">
        <div class="section-login" data-aos="fade-up">
          <h2 >Add Employee</h2>
        </div>
          <div class="containerLogin">
            <div class="col-md-12">
          <div class="col-md-6">
                  <div class="card-body card-block">
            <form class="form-horizontal" method = "post" action = "Admin.php?action=adduser">
                Username:<br>
                <input type="text" class="form-control" placeholder="Username" name ="username" required="required">
                Password:<br>
                <input type="password" class="form-control" placeholder="Password" name="password" required="required">';

		 $str=$str.'<label>Account Type: </label>
                                        <select name="acctype"  class="form-control" required="required">';
           foreach($this->model->getacctype() as $rows){
      $str=$str. '<option>'.$rows.'</option>';
  }
           $str=$str.'</select>
										  <br>
										  <br>
                <button type="submit" class="buttonAddEmployee" name = "adduser">
                <i class="fa fa-dot-circle-o"></i> Add </button>
              <br>
              <br>
              </form>
        </div>
        </div>
        </div>
        </div>
    </section>';
    return $str;
}



}
  ?>
