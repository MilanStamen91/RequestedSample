<?php include './header.layout.php'; ?>

<h1 class="my-5">Main content</h1>

<!-- <h3><i class="fab fa-angular" style="font-size: 100px;"></i></h3> -->

<button class="show-p">Show paragraph</button>
<button class="hide-p">Hide paragraph</button>

<br>

<p class="moj-p" style="display: none;">
Lorem ipsum dolor sit amet consectetur adipisicing elit. 
Adipisci, minus iste officia natus obcaecati assumenda 
praesentium nesciunt maiores odit enim et inventore 
ab fugit sed excepturi error rem dignissimos eveniet?
</p>

<br>

<ul class="list-group">
  <li class="list-group-item prva">
    <i class="fab fa-angular"></i>
    Prva
  </li>
  <li class="list-group-item druga">
    <i class="fab fa-angular"></i>
    Druga
  </li>
  <div class="druga2" style="display: none;">
    <li class="list-group-item">Druga 1</li>
    <li class="list-group-item">Druga 2</li>
  </div>
  <li class="list-group-item treca">
    <i class="fab fa-angular"></i>
    Treca
  </li>
</ul>

<!-- <?php require_once './User.class.php';  ?> -->
<!-- <?php var_dump(User::isLoggedIn());  ?> -->

<?php include './footer.layout.php'; ?>
