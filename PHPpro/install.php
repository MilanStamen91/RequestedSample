<?php

$db = require './db.inc.php';

/**
 * Create categories table
 * 
 * id, title
 */
$stmt_createCategoriesTable = $db->prepare("
  CREATE TABLE IF NOT EXISTS `categories` (
    `id` int AUTO_INCREMENT PRIMARY KEY,
    `title` varchar(255)
  )
");
$stmt_createCategoriesTable->execute();

/**
 * Create users table
 * 
 * id, name, last_name, email, password, acc_type, created_at
 * updated_at, deleted_at
 */
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
 * Create products table
 * 
 * id, cat_id, title, description, price, img, created_at, deleted_at
 */
$stmt_createProductsTable = $db->prepare("
  CREATE TABLE IF NOT EXISTS `products` (
    `id` int AUTO_INCREMENT PRIMARY KEY,
    `cat_id` int,
    `title` varchar(255),
    `description` text,
    `price` decimal(10, 2) DEFAULT 0,
    `img` varchar(255),
    `created_at` datetime DEFAULT now(),
    `deleted_at` datetime DEFAULT NULL
  )
");
$stmt_createProductsTable->execute();

/**
 * Create carts table
 * 
 * id, product_id, user_id, quantity
 */
$stmt_createCartsTable = $db->prepare("
  CREATE TABLE IF NOT EXISTS `carts` (
    `id` int AUTO_INCREMENT PRIMARY KEY,
    `product_id` int,
    `user_id` int,
    `quantity` int
  )
");
$stmt_createCartsTable->execute();

/**
 *  CREATE PRODUCT_RATINGS TABLE
 */
$stmt_createProductRatingsTable = $db->prepare("
  CREATE TABLE IF NOT EXISTS `product_ratings` (
    `id` int AUTO_INCREMENT PRIMARY KEY,
    `user_id` int,
    `product_id` int,
    `rating` int,
    `created_at` datetime DEFAULT now()
  )
");
$stmt_createProductRatingsTable->execute();

