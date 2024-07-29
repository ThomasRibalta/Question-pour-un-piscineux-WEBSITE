<?php

namespace App\dbManager;

use App\model\User;

class UserTable extends Table
{

    public function getUserByCoalition($coalition)
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE coalition = :coalition");
        $query->execute(['coalition' => $coalition]);
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $query->fetchAll();
    }
    
}