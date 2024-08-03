<?php

namespace App;
use App\model\User;

/**
 * Auth : this class is used to manage the user authentication.
 */
class Auth {

    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }
    
    /**
     * getUser this fonction get the user in database with his session id.
     * if the user is not connected, it return null.
     *
     * @return User
     */
    public function getUser(): ?User {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['user_details']['id'] ?? null;
        if ($id === null) {
            return null;
        }
        $query = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $query->execute(['id' => $id]);
        $user = $query->fetchObject(User::class);
        if ($user === false) {
            return null;
        }
        return $user;
    }
    
    /**
     * requireRole this function check if the user is connected and if he has the right role to acces on any page.
     *
     * @param  mixed $roles
     * @return void
     */
    public function requireLog(string ...$roles): void {
        // Get the user
    }
    
    public function updateScore($id, $score): void {
        if ($score == -1)
        {
            $query = $this->pdo->prepare('UPDATE users SET score = :score WHERE id = :id');
            $query->execute([
                'id' => $id,
                'score' => $score
            ]);
        }
        else
        {
            $query = $this->pdo->prepare('UPDATE users SET score = score + :score WHERE id = :id');
            $query->execute([
                'id' => $id,
                'score' => $score
            ]);
        }
    }

    public function registerUser($id, $pseudo, $img_url, $coalition, $score): void {
        if ($this->getUser() instanceof User) {
            return;
        }
        $query = $this->pdo->prepare('INSERT INTO users (id, pseudo, img_url, coalition, score) VALUES (:id, :pseudo, :img_url, :coalition, :score)');
        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'img_url' => $img_url,
            'coalition' => $coalition,
            'score' => $score
          ]);
    }
}