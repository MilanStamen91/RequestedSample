<?php
require './admin.only.php';
require_once './Posts.class.php';
require_once './Helper.class.php';


if( isset($_POST['btn_addPost']) ) {
  $newPosts = new Posts();
  $newPosts->title = $_POST['title'];
  $newPosts->price = $_POST['date'];
  $newPosts->description = $_POST['description'];
  $newPosts->image_info = $_FILES['image'];
  if( $newPosts->insert() ) {
    Helper::addMessage('Post added.');
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Corporate Law</title>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:400,700"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/all.min.css" />
    <link rel="stylesheet" href="./css/animate.min.css" />
    <link rel="stylesheet" href="css/aos.css"/>
  </head>
  <body>
<!-- nav bar -->
<div class="container-flex fixed-top">
  <div class="row">
    <div class="col-12">
      <ul class="social nav bg-dark text-white justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="#"
            >Connect with us on linkendin <i class="fab fa-linkedin"></i
          ></a>
        </li>
        <li class="nav-item">
          <a class="nav-link">|</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Subscribe To AKD</a>
        </li>
        <li class="nav-item">
          <a class="nav-link">|</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">AKDFocus Login </a>
        </li>
        <li class="nav-item">
          <a class="nav-link">|</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
        </li>
      </ul>
    </div>
    <div class="col-12 border border-primary">
      <nav class="navm navbar navbar-expand-xl">
        <a class="nav-link" href="index"
          ><img src="./img/pravo_i_vaga.jpg"
        /></a>
        <button
          id="bt"
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
        <i class="fas fa-bars fa-2x" style="color:rgb(0, 0, 0);"></i>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarSupportedContent"
        >
          <form class="form-inline">
            <div class="bord">
              <ul id="nav" class="nav navbar-nav">
              <li class="nav-item">
                    <a class="nav-link" href="index">Home</a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="about_us" id="navbarDropdownMenuLink" 
                          aria-haspopup="true" aria-expanded="false">
                          About Us
                      </a>
                      <div class="drp dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="itm dropdown-item" href="our_history">Our History</a>
                          <a class="itm dropdown-item" href="our_promise">Our Promise</a>
                      </div>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="service" id="navbarDropdownMenuLink" 
                          aria-haspopup="true" aria-expanded="false">
                          Service
                      </a>
                      <div class="drp dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="itm dropdown-item" href="#">Banking</a>
                          <a class="itm dropdown-item" href="it">IT</a>
                          <a class="itm dropdown-item" href="#">Corporate</a>
                          <a class="itm dropdown-item" href="#">Energy</a>
                          <a class="itm dropdown-item" href="#">Litigation</a>
                          <a class="itm dropdown-item" href="#">Arbitration</a>
                          <a class="itm dropdown-item" href="#">Mediation/Conciliation</a>
                          <a class="itm dropdown-item" href="#">Science</a>
                      </div>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="people">People</a>
                </li>           
                <li class="nav-item">
                  <a class="nav-link" href="news">News</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="careers">Careers</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact">Contact</a>
                </li>
              </ul>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
</div>

<h1 class="my-5">Add post</h1>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-row">
  
    <div class="form-group col-md-12">
      <label for="inputTitle">Title</label>
      <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Post title" require />
    </div>

  </div>

  <div class="form-row">

    <div class="form-group col-md-6">
      <label for="inputImage">Image</label>
      <input type="file" name="image" class="form-control-file" id="inputImage"  />
    </div>
    <div class="form-group col-md-6">
      <label for="inputDate">Date</label>

      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Date</span>
        </div>
        <input type="date" name="date" class="form-control" id="inputDate" step="0.01" placeholder="Post Date" required />
      </div>
    </div>

  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputDescription">Description</label>
      <textarea name="description" class="form-control" id="inputDescription" rows="3" placeholder="Post description..."></textarea>
    </div>
  </div>

  <div class="d-flex justify-content-end">
    <button class="btn btn-outline-primary" name="btn_addPost">
      Add Post
    </button>
  </div>

</form>

<script src="./js/jquery-3.3.1.min.js"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.bundle.js"></script>
<script src="./js/index.js"></script>
<script src="./js/aos.js"></script>
<script>
    AOS.init();
  </script>
</body>
</html>