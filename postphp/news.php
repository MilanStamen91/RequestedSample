<?php

require_once './Posts.class.php';

$p = new Posts();

$post = $p->all();


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

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/animate.min.css" />
    <link rel="stylesheet" href="../css/aos.css" />
  </head>
  <body>
    <!-- Navbar -->

    <section>
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
              <a class="nav-link" href="../index"
                ><img src="../img/pravo_i_vaga.jpg"
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
                    <a class="nav-link" href="../index">Home</a>
                      </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="../about_us" id="navbarDropdownMenuLink" 
                                aria-haspopup="true" aria-expanded="false">
                                About Us
                            </a>
                            <div class="drp dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="itm dropdown-item" href="../our_history">Our History</a>
                                <a class="itm dropdown-item" href="../our_promise">Our Promise</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="../service" id="navbarDropdownMenuLink" 
                                aria-haspopup="true" aria-expanded="false">
                                Service
                            </a>
                            <div class="drp dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="itm dropdown-item" href="#">Banking</a>
                                <a class="itm dropdown-item" href="../it">IT</a>
                                <a class="itm dropdown-item" href="#">Corporate</a>
                                <a class="itm dropdown-item" href="#">Energy</a>
                                <a class="itm dropdown-item" href="#">Litigation</a>
                                <a class="itm dropdown-item" href="#">Arbitration</a>
                                <a class="itm dropdown-item" href="#">Mediation/Conciliation</a>
                                <a class="itm dropdown-item" href="#">Science</a>
                            </div>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../people">People</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="./news">News</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="../careers">Careers</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="../contact">Contact</a>
                      </li>
                    </ul>
                  </div>
                </form>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </section>

<!-- About -->
<section>
  <div class="news conatiner-fluid">
    <div class="row">
      <div class="col-lg-3">
        <img src="../img/arc.jpg" width="100%" height="100%">
      </div>
      <div class="col-lg-6" style="background-color:lightblue;">
        <h2 class="py-3 text-center">AKD News</h2>
        <div id="news" class="container">
          <!-- First row -->
          <div class="row">

          <?php foreach($post as $posts) { ?>
            <div class="my-3 col-xs-12 col-md-6">
              <!-- Card -->
              <article class="card">
                <img class="card-img-top img-responsive" src="<?php echo $posts->img; ?>" alt="Deer in nature" />
                <div class="card-block">
                  <h4 class="m-3 card-title"><?php echo $posts->title; ?></h4>
                  <h6 class="m-3 text-muted"><?php echo $posts->date; ?></h6>
                  <p class="m-3 card-text text-justify" style="height:150px;max-width:100%;overflow:auto;"><?php echo $posts->description; ?></p>
                  <a href="#" class="m-3 p-2 btn btn-primary float-right">Read more</a>
                </div>
              </article><!-- .end Card -->
            </div> 
            <?php } ?>
           
          </div><!-- .end Second row -->
        </div>

      </div>
      <div class="col-lg-3" style="background-color: lightblue;">
      </div>
    </div>
  </div>
</section>


<!-- Footer   -->

<footer class="contact_form">
    <div class="container-fluid">
    <div class="row p-3 mb-2 bg-light text-dark">
      <div class="col-md-12 justify-content-end">
          <ul class="nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link active" href="#">Terms of Use</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Privacy policy</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-copyright"></i> Copyright AKDLegal 2019</a>
              </li>
            </ul>
      </div>
    </div>
  </div>
</footer>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/aos.js"></script>
    <script>
        AOS.init();
        </script>
  </body>
</html>