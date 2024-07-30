<?php

namespace App\dbManager;

use App\model\User;

/**
 * UserTable class manage user for classement
 */
class UserTable extends Table
{
    
    /**
     * getUserByCoalition
     *
     * @param  mixed $coalition
     * @return array(User)
     */
    public function getUserByCoalition($coalition)
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE coalition = :coalition");
        $query->execute(['coalition' => $coalition]);
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $query->fetchAll();
    }
    
}