<?php
namespace App\helper;

class CorrectionHelper
{
    public static function correct($responses, $correctResponse, $nResponses)
    {
        $count = 0;
        if (!isset($responses))
          return false;
        if (!is_array($responses))
        {
          $responses = [$responses];
        }
        if (count($correctResponse) == 1 && $nResponses == 1)
        {
          if (strtolower($correctResponse[0]->reponse) == strtolower($responses[0]))
          {
            return true;
          }
          return false;
        }
        if ($nResponses == count($correctResponse))
        {
          return true;
        }
        foreach ($responses as $r)
        {
          if ($correctResponse[$r]->correcte == 0)
          {
            return false;
          }
          $count++;
        }
        if ($nResponses == 4)
        {
          if ($count >= 1 && $count <= 4)
          {
            return true;
          }
          return false;
        }
        if ($count == $nResponses)
        {
          return true;
        }
        return false;
    }
}
