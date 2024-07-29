<?php

namespace App\Helper;

use App\dbManager\dbManager;
use App\model\User;
use App\dbManager\UserTable;

class Classement
{
  private $laHeap = [];
  private $laStack = [];

  public function __construct($pdo)
  {
    $users = new UserTable($pdo);
    $this->laHeap = $users->getUserByCoalition('La Heap');
    $this->laStack = $users->getUserByCoalition('La Stack');
  }

  public function getLaHeap()
  {
    return $this->laHeap;
  }

  public function getLaStack()
  {
    return $this->laStack;
  }

  public function getLaHeapScore()
  {
    $score = 0;
    foreach ($this->laHeap as $user)
    {
      if ($user->score == -1)
        $score += 0;
      else
        $score += $user->score;
    }
    return $score;
  }

  public function getLaStackScore()
  {
    $score = 0;
    foreach ($this->laStack as $user)
    {
      $score += $user->score;
    }
    return $score;
  }

}