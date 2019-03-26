<?php

require_once './Product.class.php';
require_once './Category.class.php';
$p = new Product();

if( isset($_GET['page']) ) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$conf = require './config.inc.php';
$numOfProducts = $p->numOfProducts();
$numOfPages = ceil($numOfProducts / $conf['products_per_page']);

if ( $page <= 1 ) {
  $prev = 1;
} else {
  $prev = $page - 1;
}

if( $page >= $numOfPages ) {
  $next = $numOfPages;
  /* Da se posle poslednje strane vrati na prvi */
  // $next = 1;
} else {
  $next = $page + 1;
}


$min = $page - 2;
$max = $page + 2;

if( $min < 1 ) {
  $min = 1;
}
if( $max > $numOfPages ) {
  $max = $numOfPages;
}

if( isset($_GET['cat_id']) ) {
  $products = $p->fromCategory($_GET['cat_id']);
  $productCategory = new Category($_GET['cat_id']);
  $pageTitle = "Products from " . $productCategory->title;
  // $pageTitle = "Products from " . (new Category($_GET['cat_id']))->title;
} else if ( isset($_GET['search']) ) {
  $products = $p->search($_GET['search']);
  $pageTitle = "Search results results for " . $_GET['search'];
} else {
  $products = $p->paginate($page);
  $pageTitle = "Products";
}


?>
<?php include './header.layout.php'; ?>

<h1 class="my-5"><?php echo $pageTitle; ?></h1>

<div class="row">

  <?php foreach($products as $product) { ?>
    <div class="col-md-4">
      <div class="card mb-4">
        <img class="card-img-top products-img" src="<?php echo $product->img; ?>" />
        <div class="card-body">
          <h5 class="card-title">
            <?php echo $product->title; ?>
          </h5>
          <p class="card-text">
            <strong>Price:</strong>
            <?php echo $product->price; ?>
          </p>
          <div class="d-flex justify-content-end">
            <a href="./product-details.php?id=<?php echo $product->id; ?>" class="btn btn-primary">Details</a>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">

    <li class="page-item">
      <a class="page-link" href="./products.php?page=<?php echo $prev; ?>">Previous</a>
    </li>

    <?php for($i = $min; $i <= $max; $i++) { ?>
      <li class="page-item<?php
          if ($page == $i) {
            echo " active";
          }
        ?>">
        <a class="page-link" href="./products.php?page=<?php echo $i; ?>">
          <?php echo $i; ?>
        </a>
      </li>
    <?php } ?>

    <li class="page-item">
      <a class="page-link" href="./products.php?page=<?php echo $next; ?>">Next</a>
    </li>

  </ul>
</nav>


<?php include './footer.layout.php'; ?>
