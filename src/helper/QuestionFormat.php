<?php

namespace App\helper;

class QuestionFormat
{
    public $responses;

    public $correct;

    public function __construct($responses, $correct)
    {
        $this->responses = $responses;
        $this->correct = $correct;
    }

    public function toRadio()
    {
      for ($i = 0; $i < count($this->responses); $i++)
      {
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="radio" name="reponse" id="reponse' . $i . '" value="'. $i .'">';
        echo '<label class="form-check-label" for="reponse' . $i . '">';
        echo $this->responses[$i]->reponse;
        echo '</label>';
        echo '</div>';
      }
    }

    public function toCheckbox()
    {
      for ($i = 0; $i < count($this->responses); $i++)
      {
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="checkbox" name="reponse[]" id="reponse' . $i . '" value="'. $i .'">';
        echo '<label class="form-check-label" for="reponse' . $i . '">';
        echo $this->responses[$i]->reponse;
        echo '</label>';
        echo '</div>';
      }
    }

    public function toHtml()
    {

        if (count($this->responses) === 1)
        {
            echo '<input type="text" class="form-control" name="reponse" id="reponse" placeholder="Réponse">';
        }
        else if ($this->correct > 1)
        {
            $this->toCheckbox();
        }
        else if ($this->correct === 1)
        {
            $this->toRadio();
        } 
    }

    public static function sumScore($questions)
    {
        $score = 0;
        foreach ($questions as $question)
        {
            $score += $question->value;
        }
        return $score;
    }
}
