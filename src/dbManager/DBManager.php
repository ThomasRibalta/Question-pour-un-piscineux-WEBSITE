<?php

namespace App\dbManager;

use PDO;

class dbManager{  

  /**
   * pdoConnexion - Connect to the database
   *
   * @return PDO
   */
  public static function pdoConnexion(): PDO{
    $user = 'root';
    $pass = 'root';
    $dsn = "mysql:host=127.0.0.1;port=3306;dbname=42Quizz;charset=utf8mb4";
    return new PDO($dsn,$user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }
}