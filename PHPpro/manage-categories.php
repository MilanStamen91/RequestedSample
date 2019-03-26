<?php
require './admin.only.php';
require_once './Category.class.php';


if( isset($_POST['btn_addCategory']) ) {
  $newCategory = new Category();
  $newCategory->title = $_POST['category_title'];
  $newCategory->icon = $_FILES['category_icon'];
  $newCategory->insert();
}

if( isset($_POST['btn_deleteCategory']) ) {
  $categoryToDelete = new Category($_POST['category_id']);
  $categoryToDelete->delete();
}

$c = new Category();
$categories = $c->all();

?>

<?php include './header.layout.php'; ?>

<h1 class="my-5">Add new category</h1>

<form action="" method="post">
<!-- <div class="form-row">
    <div class="col-md-12" style="font-size: 30px;">
      <label for="inputCategoryIcon">Category icon</label>
        <label>
          <input type="radio" name="category_icon" value="fab fa-500px">
          <i class="fab fa-500px"></i>
        </label>
        <label>
          <input type="radio" name="category_icon" value="fab fa-accessible-icon">
          <i class="fab fa-accessible-icon"></i>
        </label>
        <label>
          <input type="radio" name="category_icon" value="fab fa-accusoft">
          <i class="fab fa-accusoft"></i>
        </label>
        <label>
          <input type="radio" name="category_icon" value="fab fa-acquisitions-incorporated">
          <i class="fab fa-acquisitions-incorporated"></i>
        </label>
        <label>
          <input type="radio" name="category_icon" value="fas fa-ad">
          <i class="fas fa-ad"></i>
        </label>
      </div>
  </div> -->

  <div class="form-row">

    <div class="col-md-8 mb-3">
      <label for="inputTitle">Title</label>
      <input type="text" name="category_title" class="form-control" id="inputTitle" placeholder="Category title" required>
    </div>

    <div class="col-md-4 mb-3 d-flex justify-content-center align-items-end">
      <button name="btn_addCategory" class="btn btn-primary btn-block">Add Category</button>
    </div>

  </div>
</form>

<h1 class="my-5">Existing categories</h1>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Icon</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach($categories as $category) { ?>
      <tr>
        <th><?php echo $category->id; ?></th>
        <td><?php echo $category->title; ?></td>
        <td>
          <form action="" method="post">
            <input type="hidden" name="category_id" value="<?php echo $category->id; ?>" />
            <button name="btn_deleteCategory" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </td>
      </tr>
    <?php } ?>

  </tbody>
</table>


<?php include './footer.layout.php'; ?>
