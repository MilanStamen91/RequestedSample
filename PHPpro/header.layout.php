<?php 
  require_once './Helper.class.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>WebShop</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css" />
  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="./css/all.min.css" />
  
</head>
<body>
  
  <?php include './navbar.inc.php'; ?>

  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="sidebar">
          <?php include './sidebar.inc.php'; ?>
        </div>
      </div>
      <div class="col-md-9">
        <div class="main-content">
        <?php
          $error = Helper::getError();
          if( $error ) {
        ?>
            <div class="alert alert-danger my-3">
              <strong>Error!</strong>
              <?php echo $error; ?>
            </div>
        <?php } ?>

        <?php
          $message = Helper::getMessage();
          if( $message ) {
        ?>
            <div class="alert alert-success my-3">
              <strong>Success!</strong>
              <?php echo $message; ?>
            </div>
        <?php } ?>