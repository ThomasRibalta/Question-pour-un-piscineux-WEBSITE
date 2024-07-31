<?php

namespace App\helper;

class Url { 
  
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
