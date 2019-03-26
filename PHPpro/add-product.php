<?php
require './admin.only.php';
require_once './Category.class.php';
require_once './Product.class.php';
require_once './Helper.class.php';

$c = new Category();
$categories = $c->all();

if( isset($_POST['btn_addProduct']) ) {
  $newProduct = new Product();
  $newProduct->title = $_POST['title'];
  $newProduct->cat_id = $_POST['cat_id'];
  $newProduct->price = $_POST['price'];
  $newProduct->description = $_POST['description'];
  $newProduct->image_info = $_FILES['image'];
  if( $newProduct->insert() ) {
    Helper::addMessage('Product added.');
  }

}

?>

<?php include './header.layout.php'; ?>

<h1 class="my-5">Add product</h1>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-row">
  
    <div class="form-group col-md-6">
      <label for="inputTitle">Title</label>
      <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Product title" require />
    </div>
    <div class="form-group col-md-6">
      <label for="inputCategory">Category</label>
      <select name="cat_id" class="form-control" id="inputCategory">
        <?php foreach($categories as $category) { ?>
          <option value="<?php echo $category->id; ?>">
            <?php echo $category->title; ?>
          </option>
        <?php } ?>
      </select>
    </div>

  </div>

  <div class="form-row">

    <div class="form-group col-md-6">
      <label for="inputImage">Image</label>
      <input type="file" name="image" class="form-control-file" id="inputImage"  />
    </div>
    <div class="form-group col-md-6">
      <label for="inputPrice">Price</label>

      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">RSD</span>
        </div>
        <input type="number" name="price" class="form-control" id="inputPrice" step="0.01" placeholder="Product price" required />
      </div>
    </div>

  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputDescription">Description</label>
      <textarea name="description" class="form-control" id="inputDescription" rows="3" placeholder="Product description..."></textarea>
    </div>
  </div>

  <div class="d-flex justify-content-end">
    <button class="btn btn-outline-primary" name="btn_addProduct">
      Add Product
    </button>
  </div>

</form>

<?php include './footer.layout.php'; ?>
