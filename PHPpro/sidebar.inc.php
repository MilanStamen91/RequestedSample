<?php

require_once './Category.class.php';

$c = new Category();
$categories = $c->all();

?>

<h2 class="my-4">Categories</h2>

<div class="list-group">

  <?php foreach($categories as $category) { ?>
    <a href="./products.php?cat_id=<?php echo $category->id; ?>" 
    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<?php
      
      if(isset($_GET['cat_id']) && $_GET['cat_id'] == $category->id) {
        echo " active";
      }
      
      ?>">
    
    <?php echo $category->title; ?>
      <span class="badge <?php
      
      if(isset($_GET['cat_id']) && $_GET['cat_id'] == $category->id) {
        echo "badge-light";
      } else {
        echo "badge-primary";
      }

      ?>">
        <?php echo $category->num_of_products; ?>
      </span>

    </a>
  <?php } ?>
  
</div>
