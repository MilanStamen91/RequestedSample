<?php

$db = require './db.inc.php';


$stmt_createUsersTable = $db->prepare("
  CREATE TABLE IF NOT EXISTS `users` (
    `id` int AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(30) NOT NULL,
    `last_name` varchar(30) DEFAULT NULL,
    `email` varchar(100) UNIQUE NOT NULL,
    `password` varchar(32) NOT NULL,
    `acc_type` enum('user', 'admin') DEFAULT 'user',
    `created_at` datetime DEFAULT now(),
    `updated_at` datetime DEFAULT now() ON UPDATE now(),
    `deleted_at` datetime DEFAULT NULL
  )
");
$stmt_createUsersTable->execute();

/**
 * Create posts table
 * 
 * id, cat_id, title, description, price, img, created_at, deleted_at
 */
$stmt_createPostsTable = $db->prepare("
  CREATE TABLE IF NOT EXISTS `posts` (
    `id` int AUTO_INCREMENT PRIMARY KEY,
    `title` varchar(255),
    `description` text,
    `date` date,
    `img` varchar(255),
    `created_at` datetime DEFAULT now(),
    `deleted_at` datetime DEFAULT NULL
  )
");
$stmt_createPostsTable->execute();


