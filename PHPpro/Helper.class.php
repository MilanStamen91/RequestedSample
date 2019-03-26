<?php

class Helper {

  public static function sessionStart() {
    if( !isset($_SESSION) ) {
      @session_start();
    }
  }

  public static function addError($error) {
    self::sessionStart();
    $_SESSION['error'] = $error;
  }

  public static function getError() {
    if( isset($_SESSION['error']) ) {
      $error = $_SESSION['error'];
      unset($_SESSION['error']);
      return $error;
    }
  }

  public static function addMessage($message) {
    self::sessionStart();
    $_SESSION['message'] = $message;
  }

  public static function getMessage() {
    if( isset($_SESSION['message']) ) {
      $message = $_SESSION['message'];
      unset($_SESSION['message']);
      return $message;
    }
  }

  public static function redirect($url) {
    if (headers_sent()) {
      die('<script type="text/javascript">window.location = \''.$url.'\';</script‌​>');
    } else {
      header('Location: ' . $url);
      die();
    }
  }

  public static function formatPrice($number) {
    return number_format($number, 2, '.', ',');
  }


}


/// NOVI FAJL:
// require_once './Helper.class.php';
// Helper::sessionStart();

//Helper::addError("Ovo je greska...");
