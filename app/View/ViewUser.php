<?php

  require_once(__ROOT__ . "View/View.php");
  require_once("../Main/mainlogin.php");
class ViewUser extends View{
  function loginForm(){
    $str='<section id="Login" class="contact">
      <div class="container">

        <div class="section-login" data-aos="fade-up">
          <h2>Login</h2>
        </div>
          <div class="containerLogin">
            <div class="col-md-12">
          <div class="col-md-6">
                  <div class="card-body card-block">
            <form class="form-horizontal" method = "post" action = "mainlogin.php">
                Username:<br>
                <input type="text" class="form-control" placeholder="Username" name ="username" required="required">
                Password:<br>
                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                <br>
                <button type="submit" class="btn btn-success btn-smLogin" name = "login">
                <i class="fa fa-dot-circle-o"></i> Submit
              </button>
              <button type="reset" class="btn btn-danger btn-smLogin">
                <i class="fa fa-ban"></i> Reset
              </button>
              <br>
              <br>
              </form>
        </div>
        </div>
        </div>
        </div>
    </section><!-- End Contact Section -->
';
    return $str;
  }
}
