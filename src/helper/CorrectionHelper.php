<?php
namespace App\Helper;

class CorrectionHelper
{
    public static function correct($reponses, $correctReponse, $nReponses)
    {
        $count = 0;
        if (!isset($reponses))
          return false;
        if (!is_array($reponses))
        {
          $reponses = [$reponses];
        }
        if (count($correctReponse) == 1 && $nReponses == 1)
        {
          if (strtolower($correctReponse[0]->reponse) == strtolower($reponses[0]))
          {
            return true;
          }
          return false;
        }
        if ($nReponses == count($correctReponse))
        {
          return true;
        }
        foreach ($reponses as $r)
        {
          if ($correctReponse[$r]->correcte == 0)
          {
            return false;
          }
          $count++;
        }
        if ($nReponses == 4)
        {
          if ($count >= 1 && $count <= 4)
          {
            return true;
          }
          return false;
        }
        if ($count == $nReponses)
        {
          return true;
        }
        return false;
    }
}