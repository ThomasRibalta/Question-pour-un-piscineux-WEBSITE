<?php

namespace App\Helper;

class QuestionFormat
{
    public $reponses;

    public $correct;

    public function __construct($reponses, $correct)
    {
        $this->reponses = $reponses;
        $this->correct = $correct;
    }

    public function toRadio()
    {
      for ($i = 0; $i < count($this->reponses); $i++)
      {
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="radio" name="reponse" id="reponse' . $i . '" value="'. $i .'">';
        echo '<label class="form-check-label" for="reponse' . $i . '">';
        echo $this->reponses[$i]->reponse;
        echo '</label>';
        echo '</div>';
      }
    }

    public function toCheckbox()
    {
      for ($i = 0; $i < count($this->reponses); $i++)
      {
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="checkbox" name="reponse[]" id="reponse' . $i . '" value="'. $i .'">';
        echo '<label class="form-check-label" for="reponse' . $i . '">';
        echo $this->reponses[$i]->reponse;
        echo '</label>';
        echo '</div>';
      }
    }

    public function toHtml()
    {
        if ($this->correct > 1)
        {
            $this->toCheckbox();
        }
        else if ($this->correct === 1)
        {
            $this->toRadio();
        }
        else if (count($this->reponses) === 1)
        {
            echo '<input type="text" class="form-control" name="reponse" id="reponse" placeholder="Réponse">';
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