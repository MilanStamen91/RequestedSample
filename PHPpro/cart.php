<?php

require_once './Product.class.php';
require_once './Helper.class.php';

if( isset($_POST['btn_removeFromCart']) ) {
  $productToRemove = new Product($_POST['product_id']);
  $productToRemove->removeFromCart();
}

if( isset($_POST['btn_updateQuantity']) ) {
  $productToUpdate = new Product($_POST['product_id']);
  $productToUpdate->updateQuantity($_POST['new_quantity']);
}

$p = new Product();
$carts = $p->getCart();

?>

<?php include './header.layout.php'; ?>

<h1 class="my-5">Cart</h1>

<table class="table table-hover">
  <thead>
    <tr>
      <th>Product title</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Total price</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php $total = 0; ?>
    <?php foreach($carts as $product) { ?>
    <?php $total += $product->quantity * $product->price; ?>
      <tr>
        <th><?php echo $product->title; ?></th>
        <td>
          <form action="" method="post">
            <div class="input-group input-group-sm">
              <input
                type="number"
                name="new_quantity"
                min="1"
                placeholder="New quantity"
                class="form-control"
                value="<?php echo $product->quantity; ?>">
              <input
                type="hidden"
                name="product_id"
                value="<?php echo $product->product_id ?>" />
              <div class="input-group-append">
                <button
                  name="btn_updateQuantity"
                  class="btn btn-outline-success">Update</button>
              </div>
            </div>
          </form>
        </td>
        <td><?php echo Helper::formatPrice($product->price); ?></td>
        <td><?php echo Helper::formatPrice($product->quantity * $product->price); ?></td>
        <td>
          <form action="" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>" />
            <button class="btn btn-outline-danger btn-sm" name="btn_removeFromCart">Remove from cart</button>
          </form>
        </td>
      </tr>
    <?php } ?>

  </tbody>
  <tfoot>
      <tr>
        <td></td>
        <td></td>
        <th>Total:</th>
        <td><?php echo Helper::formatPrice($total); ?></td>
        <td></td>
      </tr>
  </tfoot>
</table>

<?php include './footer.layout.php'; ?>
