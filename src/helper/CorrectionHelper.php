<?php
namespace App\helper;

class CorrectionHelper
{
    public static function comp_reponse($reponse, $reponse_correcte)
    {
        $reponse = trim(strtolower($reponse));
        $reponse_correcte = trim(strtolower($reponse_correcte));
        if ($reponse == $reponse_correcte)
        {
            return true;
        }
        return false;
    }

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
          if (CorrectionHelper::comp_reponse($responses[0], $correctResponse[0]->reponse))
          {
            return true;
          }
          echo "false\n";
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
