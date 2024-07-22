<?php
namespace App\Helper;

class CorrectionHelper
{
    public static function correct($responses, $correctResponse, $nReponses)
    {
        $count = 0;
        if (!isset($responses))
          return ;
        if (!is_array($responses))
        {
          $responses = [$responses];
        }
        foreach ($responses as $r)
        {
          if ($correctResponse[$r]->correcte == 0)
          {
            return false;
          }
          $count++;
        }
        if ($count == $nReponses)
        {
          return true;
        }
        return false;
    }
}