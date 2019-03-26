<?php

class Category {
  private $db;
  public $id;
  public $title;
  public $icon;

  function __construct($id = null) {
    $this->db = require './db.inc.php';

    if( $id ) {
      $this->id = $id;
      $this->loadFromDb();
    }
  }

  public function loadFromDb() {
    $stmt_get = $this->db->prepare("
      SELECT *
      FROM `categories`
      WHERE `id` = :id
    ");
    $stmt_get->execute([
      ':id' => $this->id
    ]);

    $category = $stmt_get->fetch();

    foreach($category as $key => $value) {
      $this->$key = $value;
    }
  }

  public function insert() {
    $stmt_insert = $this->db->prepare("
      INSERT INTO `categories`
      (`title`)
      VALUES
      (:title)
    ");
    $result = $stmt_insert->execute([
    ':title' => $this->title
    ]);
    $this->id = $this->db->lastInsertId();
    return $result;
  }

  public function update() {
    $stmt_update = $this->db->prepare("
      UPDATE `categories`
      SET `title` = :title
      WHERE `id` = :id
    ");
    return $stmt_update->execute([
      ':title' => $this->title,
      ':id' => $this->id
    ]);
  }

  public function delete() {
    $stmt_delete = $this->db->prepare("
      DELETE
      FROM `categories`
      WHERE `id` = :id
    ");
    $stmt_delete->execute([ ':id' => $this->id ]);
  }

  public function all() {
    $stmt_getAll = $this->db->prepare("
    SELECT
    `id`,
    `title`,
    (
      SELECT count(*)
      FROM `products`
      WHERE `products`.`cat_id` = `categories`.`id`
      AND `products`.`deleted_at` IS NULL
    ) as num_of_products
    FROM `categories`
    ORDER BY `categories`.`title` ASC
    ");
    $stmt_getAll->execute();

    return $stmt_getAll->fetchAll();
  }

  // public function save() {
  //   if( $this->id ) {
  //     return $this->update();
  //   } else {
  //     return $this->insert();
  //   }
  // }
}
