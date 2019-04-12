
<?php require_once './Posts.class.php'; ?>

<?php

if( !isset($_GET['id']) ) {
  header("Location: ../index.php");
  die();
}

$post = new Posts($_GET['id']);

?>


<h1 class="my-5"><?php $post->title; ?></h1>

<div class="row">

  <div class="col-md-5">
    <img src="<?php echo $post->img; ?>" class="products-details-img" />
  </div>

  <div class="col-md-7">
    <h3 class="mb-5">Description</h3>
    <p class="mb-5">
    <?php echo $post->description; ?>
    </p>

    <div class="d-flex flex-column align-items-end">
      <h5 class="mt-5"><?php echo $post->date; ?> Date</h5>
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-12 my-5">
  </div>
</div>




