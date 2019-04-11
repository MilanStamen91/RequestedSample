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

<?php include '../index.php'; ?>

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
