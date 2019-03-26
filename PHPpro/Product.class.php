<?php

class Product {
  private $db;
  public $id;
  public $cat_id;
  public $title;
  public $description;
  public $price;
  public $img;
  public $image_info;
  public $created_at;
  public $deleted_at;
  public $product_images_directory;
  public $max_image_size;

  function __construct($id = null) {
    $this->db = require './db.inc.php';
    require_once './User.class.php';

    $this->product_images_directory = "./img/products/";
    $this->max_image_size = 5 * 1024 * 1024;

    if( $id ) {
      $this->id = $id;
      $this->loadFromDb();
    }
  }

  public function loadFromDb() {
    $stmt_load = $this->db->prepare("
      SELECT *
      FROM `products`
      WHERE `id` = :id
    ");
    $stmt_load->execute([ ':id' => $this->id ]);
    $product = $stmt_load->fetch();

    if ( $product ) {
      foreach($product as $key => $value) {
        $this->$key = $value;
      }
    }
  }

  public function all() {
    $stmt_all = $this->db->prepare("
      SELECT *
      FROM `products`
      WHERE `deleted_at` IS NULL
      ORDER BY `id` ASC
    ");
    $stmt_all->execute();
    return $stmt_all->fetchAll();
  }

  public function insert() {
    $stmt_insert = $this->db->prepare("
      INSERT INTO `products`
      (`cat_id`, `title`, `description`, `price`)
      VALUES
      (:cat_id, :title, :description, :price)
    ");
    $inserted = $stmt_insert->execute([
      ':cat_id' => $this->cat_id,
      ':title' => $this->title,
      ':description' => $this->description,
      ':price' => $this->price
    ]);

    if( $inserted ) {
      $this->id = $this->db->lastInsertId();
      $this->loadFromDb();
      $this->handleImageUpload();
    }

    return $inserted;
  }

  public function update() {
    $stmt_update = $this->db->prepare("
      UPDATE `products`
      SET
        `cat_id` = :cat_id,
        `title` = :title,
        `description` = :description,
        `price` = :price,
        `img` = :img
      WHERE `id` = :id
    ");
    return $stmt_update->execute([
      ':cat_id' => $this->cat_id,
      ':title' => $this->title,
      ':description' => $this->description,
      ':price' => $this->price,
      ':img' => $this->img,
      ':id' => $this->id
    ]);
  }

  public function handleImageUpload() {

    if( $this->image_info['error'] != 0 ) {
      return false;
    }

    if ( !file_exists($this->product_images_directory) ) {
      mkdir($this->product_images_directory, 0777, true);
    }

    $path_info = pathinfo($this->image_info['name']);

    $img_dest = "";
    $img_dest .= $this->product_images_directory;
    $img_dest .= $this->id;
    $img_dest .= ".";
    $img_dest .= $path_info['extension'];

    move_uploaded_file($this->image_info['tmp_name'], $img_dest);

    $this->img = $img_dest;
    $this->update();
  }

  public function addToCart($quantity = 1) {

    if( !User::isLoggedIn() ) {
      Helper::addError("You have to be logged in to add to cart.");
      return false;
    }

    $stmt_getCartRow = $this->db->prepare("
      SELECT *
      FROM `carts`
      WHERE `user_id` = :user_id
      AND `product_id` = :product_id
    ");
    $stmt_getCartRow->execute([
      ':user_id' => User::loggedInUserId(),
      ':product_id' => $this->id
    ]);

    $cartRow = $stmt_getCartRow->fetch();

    if( $cartRow ) {
      return $this->updateQuantity($cartRow->quantity + $quantity);
    } else {
      $stmt_addToCart = $this->db->prepare("
        INSERT INTO `carts`
        (`product_id`, `user_id`, `quantity`)
        VALUES
        (:product_id, :user_id, :quantity)
      ");
      return $stmt_addToCart->execute([
        ':product_id' => $this->id,
        ':user_id' => User::loggedInUserId(),
        ':quantity' => $quantity
      ]);
    }
  }

  public function updateQuantity($newQuantity) {
    $stmt_updateQuantity = $this->db->prepare("
      UPDATE `carts`
      SET `quantity` = :new_quantity
      WHERE `product_id` = :product_id
      AND `user_id` = :user_id
    ");
    return $stmt_updateQuantity->execute([
      ':new_quantity' => $newQuantity,
      ':product_id' => $this->id,
      ':user_id' => User::loggedInUserId()
    ]);
  }

  public function getCart() {
    $stmt_getCart = $this->db->prepare("
      SELECT
        `carts`.`id` as carts_id,
        `carts`.`quantity`,
        `products`.`id` as product_id,
        `products`.`title`,
        `products`.`price`
      FROM `carts`, `products`
      WHERE `carts`.`user_id` = :user_id
      AND `carts`.`product_id` = `products`.`id`
    ");
    $stmt_getCart->execute([
      ':user_id' => User::loggedInUserId()
    ]);
    return $stmt_getCart->fetchAll();
  }

  public function removeFromCart() {
    $stmt_remove = $this->db->prepare("
      DELETE
      FROM `carts`
      WHERE `product_id` = :product_id
      AND `user_id` = :user_id
    ");
    return $stmt_remove->execute([
      ':product_id' => $this->id,
      ':user_id' => User::loggedInUserId()
    ]);
  }

  public function fromCategory($catId) {
    $stmt_getFromCategory = $this->db->prepare("
      SELECT *
      FROM `products`
      WHERE `cat_id` = :cat_id
      AND `deleted_at` IS NULL
    ");
    $stmt_getFromCategory->execute([
      ':cat_id' => $catId
    ]);
    return $stmt_getFromCategory->fetchAll();
  }

  public function search($query) {

    $searchQuery = "%$query%";

    $stmt_getFromCategory = $this->db->prepare("
      SELECT *
      FROM `products`
      WHERE (
        `title` LIKE :query
        OR `description` LIKE :query
      )
      AND `deleted_at` IS NULL
    ");
    $stmt_getFromCategory->execute([
      ':query' => $searchQuery
    ]);
    return $stmt_getFromCategory->fetchAll();
  }

  public function paginate($page = 1) {
    $conf = require './config.inc.php';
    $offset = ( $page - 1 ) * $conf['products_per_page'];
    $stmt_get = $this->db->prepare("
      SELECT *
      FROM `products`
      WHERE `deleted_at` IS NULL
      LIMIT {$conf['products_per_page']}
      OFFSET {$offset}
    ");
    $stmt_get->execute();
    return $stmt_get->fetchAll();
  }

  public function numOfProducts() {
    $stmt_get = $this->db->prepare("
      SELECT count(*) as num_of_products
      FROM `products`
      WHERE `deleted_at` IS NULL
    ");
    $stmt_get->execute();
    // $numOfProductsObj = $stmt_get->fetch();
    // return $numOfProductsObj->num_of_products;
    return $stmt_get->fetch()->num_of_products;
  }
  
  public function rate($rating) {
    
    if( !User::isLoggedIn() ) {
      Helper::addError('You have to login to be able to rate product.');
      return false;
    }

    if( $rating > 5 || $rating < 1 ) {
      Helper::addError("Error! Rating not allowed.");
      return false;
    }

    $stmt_getRating = $this->db->prepare("
      SELECT *
      FROM `product_ratings`
      WHERE `user_id` = :user_id
      AND `product_id` = :product_id
    ");
    $stmt_getRating->execute([
      ':user_id' => User::loggedInUserId(),
      ':product_id' => $this->id
    ]);

    $ratingRow = $stmt_getRating->fetch();

    if( $ratingRow ) {
      $stmt_updateRating = $this->db->prepare("
        UPDATE `product_ratings`
        SET `rating` = :rating
        WHERE `user_id` = :user_id
        AND `product_id` = :product_id
      ");
      $stmt_updateRating->execute([
        ':rating' => $rating,
        ':user_id' => User::loggedInUserId(),
        ':product_id' => $this->id
      ]);
    } else {
      $stmt_insertRating = $this->db->prepare("
        INSERT INTO `product_ratings`
        (`user_id`, `product_id`, `rating`)
        VALUES
        (:user_id, :product_id, :rating)
      ");
      $stmt_insertRating->execute([
        ':user_id' => User::loggedInUserId(),
        ':product_id' => $this->id,
        ':rating' => $rating
      ]);
    }
  }

  public function getRating() {
    $stmt_getRating = $this->db->prepare("
      SELECT AVG(rating) as avg_rating
      FROM `product_ratings`
      WHERE `product_id` = :product_id
    ");

    $stmt_getRating->execute([ ':product_id' => $this->id ]);
    return $stmt_getRating->fetch()->avg_rating;
  }
}
// $a;
// var_dump("pocetna vrednost za a:");
// var_dump($a);

// function test() {
//   global $a;
//   var_dump("globalna vrednost za a:");
//   var_dump($a);
//   return $a = false;
// }

// var_dump("posle funkcije vrednost za a:");
// var_dump($a);
