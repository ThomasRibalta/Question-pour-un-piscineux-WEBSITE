<?php
namespace App\helper;

class CorrectionHelper
{
    public static function comp_reponse($reponse, $reponse_correcte)
    {
        $reponse = strtolower($reponse);
        $reponse_correcte = strtolower($reponse_correcte);
        $indice = 0;
        echo "[";
        while ($reponse[$indice])
        {
           echo $reponse[$indice]. "|";
           $indice++;
        }
        echo "]\n";        
        $indice = 0;
        echo "[";
        while ($reponse_correcte[$indice])
        {
           echo $reponse_correcte[$indice]. "|";
            $indice++;
        }
        echo "]\n"; 
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
          //echo strtolower($correctResponse[0]->reponse). "\n";
          //echo strtolower($responses[0]). "\n";
          //var_dump(CorrectionHelper::comp_reponse($responses[0], $correctResponse[0]->reponse));
          if (strtolower($correctResponse[0]->reponse) == strtolower($responses[0]))
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
