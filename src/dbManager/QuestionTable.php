<?php

namespace App\dbManager;

class QuestionTable extends Table
{
    public function getQuestionsSortedByValue()
    {
        $query = $this->pdo->query('SELECT * FROM questions');
        return $query->fetchAll(\PDO::FETCH_CLASS, "\App\model\Question");
    }

    public function getCountQuestions()
    {
        $query = $this->pdo->query('SELECT COUNT(*) FROM questions');
        return $query->fetchColumn();
    }

    public function getResponseById($id)
    {
        $query = $this->pdo->prepare('SELECT * FROM reponse WHERE id_question = :id');
        $query->execute(['id' => $id]);
        return $query->fetchall(\PDO::FETCH_CLASS, "\App\model\Reponse");
    }

    public function getCountCorrectResponse($id)
    {
        $query = $this->pdo->prepare('SELECT COUNT(*) FROM reponse WHERE id_question = :id AND correcte = 1');
        $query->execute(['id' => $id]);
        return $query->fetchColumn();
    }

    public function getCorrectResponseId($id)
    {
        $query = $this->pdo->prepare('SELECT * FROM reponse WHERE id_question = :id AND correcte = 1');
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

}