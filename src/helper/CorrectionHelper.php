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