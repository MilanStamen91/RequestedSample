<?php

require_once './User.class.php';
require_once './Helper.class.php';

if( isset($_POST['btn_login']) ) {
  $u = new User();
  $u->email = $_POST['email'];
  $u->password = $_POST['password'];
  if( !$u->login() ) {
    Helper::addError('Login failed. Check your credentials.');
  }
}

if( User::isLoggedIn() ) {
  header("Location: ./index.php");
  die();
}

?>

<?php include './header.layout.php'; ?>

  <h1 class="mt-5">Login</h1>

  <div class="row justify-content-center">
    <div class="col-md-5">
    
    <form action="" method="post" class="clearfix mt-5">
      <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
      </div>
      <div class="d-flex justify-content-end">
        <button name="btn_login" class="btn btn-primary">
          Log in
        </button>
      </div>
    </form>

    </div>
  </div>

<?php include './footer.layout.php'; ?>