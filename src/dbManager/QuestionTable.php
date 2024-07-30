<?php

namespace App\dbManager;

class QuestionTable extends Table
{    
    /**
     * getQuestionsSortedByValue
     *
     * @return array(Question)
     */
    public function getQuestionsSortedByValue()
    {
        $query = $this->pdo->query('SELECT * FROM questions');
        return $query->fetchAll(\PDO::FETCH_CLASS, "\App\model\Question");
    }
    
    /**
     * getCountQuestions return number of question
     *
     * @return int
     */
    public function getCountQuestions()
    {
        $query = $this->pdo->query('SELECT COUNT(*) FROM questions');
        return $query->fetchColumn();
    }
    
    /**
     * getResponseById
     *
     * @param  int $id
     * @return array(Reponse)
     */
    public function getResponseById(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM reponse WHERE id_question = :id');
        $query->execute(['id' => $id]);
        return $query->fetchall(\PDO::FETCH_CLASS, "\App\model\Reponse");
    }
    
    /**
     * getCountCorrectResponse number of correct response
     *
     * @param  int $id
     * @return int
     */
    public function getCountCorrectResponse(int $id)
    {
        $query = $this->pdo->prepare('SELECT COUNT(*) FROM reponse WHERE id_question = :id AND correcte = 1');
        $query->execute(['id' => $id]);
        return $query->fetchColumn();
    }
    
    /**
     * getCorrectResponseId 
     *
     * @param  int $id
     * @return array(int)
     */
    public function getCorrectResponseId(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM reponse WHERE id_question = :id AND correcte = 1');
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

}