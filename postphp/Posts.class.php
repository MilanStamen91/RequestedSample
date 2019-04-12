<?php

class Posts {
  private $db;
  public $id;
  public $title;
  public $description;
  public $date;
  public $img;
  public $image_info;
  public $created_at;
  public $deleted_at;
  public $post_images_directory;
  public $max_image_size;

  function __construct($id = null) {
    $this->db = require './db.inc.php';

    $this->post_images_directory = "./img/posts/";
    $this->max_image_size = 5 * 1024 * 1024;

    if( $id ) {
      $this->id = $id;
      $this->loadFromDb();
    }
  }

  public function loadFromDb() {
    $stmt_load = $this->db->prepare("
      SELECT *
      FROM `posts`
      WHERE `id` = :id
    ");
    $stmt_load->execute([ ':id' => $this->id ]);
    $post = $stmt_load->fetch();

    if ( $post ) {
      foreach($post as $key => $value) {
        $this->$key = $value;
      }
    }
  }

  public function fromPost($postId) {
    $stmt_getFromPosts = $this->db->prepare("
      SELECT *
      FROM `posts`
      WHERE `id` = :id
      AND `deleted_at` IS NULL
    ");
    $stmt_getFromPosts->execute([
      ':id' => $postId
    ]);
    return $stmt_getFromPosts->fetchAll();
  }

  public function all() {
    $stmt_all = $this->db->prepare("
      SELECT *
      FROM `posts`
      WHERE `deleted_at` IS NULL
      ORDER BY `id` ASC
    ");
    $stmt_all->execute();
    return $stmt_all->fetchAll();
  }

  public function insert() {
    $stmt_insert = $this->db->prepare("
      INSERT INTO `posts`
      (`title`, `description`, `date`)
      VALUES
      (:title, :description, :date)
    ");
    $inserted = $stmt_insert->execute([
      ':title' => $this->title,
      ':description' => $this->description,
      ':date' => $this->date
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
      UPDATE `posts`
      SET
        `title` = :title,
        `description` = :description,
        `date` = :date,
        `img` = :img
      WHERE `id` = :id
    ");
    return $stmt_update->execute([
      ':title' => $this->title,
      ':description' => $this->description,
      ':date' => $this->date,
      ':img' => $this->img,
      ':id' => $this->id
    ]);
  }

  public function handleImageUpload() {

    if( $this->image_info['error'] != 0 ) {
      return false;
    }

    if ( !file_exists($this->post_images_directory) ) {
      mkdir($this->post_images_directory, 0777, true);
    }

    $path_info = pathinfo($this->image_info['name']);

    $img_dest = "";
    $img_dest .= $this->post_images_directory;
    $img_dest .= $this->id;
    $img_dest .= ".";
    $img_dest .= $path_info['extension'];

    move_uploaded_file($this->image_info['tmp_name'], $img_dest);

    $this->img = $img_dest;
    $this->update();
  }

  public function fromPosts($catId) {
    $stmt_getFromPosts = $this->db->prepare("
      SELECT *
      FROM `posts`
      WHERE `id` = :id
      AND `deleted_at` IS NULL
    ");
    $stmt_getFromPosts->execute([
      'id' => $Id
    ]);
    return $stmt_getFromPosts->fetchAll();
  }

  public function search($query) {

    $searchQuery = "%$query%";

    $stmt_getFromPosts = $this->db->prepare("
      SELECT *
      FROM `posts`
      WHERE (
        `title` LIKE :query
        OR `description` LIKE :query
      )
      AND `deleted_at` IS NULL
    ");
    $stmt_getFromPosts->execute([
      ':query' => $searchQuery
    ]);
    return $stmt_getFromPosts->fetchAll();
  }

  public function paginate($page = 1) {
    $conf = require './config.inc.php';
    $offset = ( $page - 1 ) * $conf['posts_per_page'];
    $stmt_get = $this->db->prepare("
      SELECT *
      FROM `posts`
      WHERE `deleted_at` IS NULL
      LIMIT {$conf['posts_per_page']}
      OFFSET {$offset}
    ");
    $stmt_get->execute();
    return $stmt_get->fetchAll();
  }

  public function numOfPosts() {
    $stmt_get = $this->db->prepare("
      SELECT count(*) as num_of_posts
      FROM `posts`
      WHERE `deleted_at` IS NULL
    ");
    $stmt_get->execute();
    // $numOfProductsObj = $stmt_get->fetch();
    // return $numOfProductsObj->num_of_products;
    return $stmt_get->fetch()->num_of_posts;
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
