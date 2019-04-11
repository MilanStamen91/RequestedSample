<?php

require_once './User.class.php';
require_once './Helper.class.php';

if ( !User::isLoggedIn() ) {
  Helper::addError('You have to be logged in.');
  header('Location: ./postphp/login.php');
  die();
}
