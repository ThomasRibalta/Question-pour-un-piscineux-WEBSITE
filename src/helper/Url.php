<?php

namespace App\Helper;

class Url {  

  /**
   * getIntValue method to get the value of a parameter in the URL (only integer values)
   *
   * @param  mixed $value
   * @param  mixed $Null
   * @return int
   */
  public static function getIntValue(string $value, bool $Null = false) : int {
    if (!isset($_GET[$value]) && $Null === false) {
      return 1;
    }
    if (!isset($_GET[$value]) && $Null === true) {
      return 0;
    }
    if ($_GET[$value] === '0' && $Null === false) {
      return 1;
    }
    if ($_GET[$value] === '0' && $Null === true) {
      return 0;
    }
    $value = (int)$_GET[$value];
    if ($value <= 0) {
      return 1;
    }
    return $value;
  }
  
  /**
   * request_slash method to remove the last slash of the URL
   *
   * @param  mixed $url
   * @return void
   */
  public static function request_slash($url){
    if ($url !== '/' && substr($url, -1) === '/') {
      header('Location: ' . substr($url, 0, -1));
      exit();
    }
  }
}