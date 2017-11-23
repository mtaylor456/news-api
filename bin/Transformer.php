<?php

namespace AppBundle\Api\NewsApi;

class Transformer
{
    public function sourceLabels(array $sources)
    {
        $ids = [];
        
        foreach($sources as $source){
            $ids[] = [$source['id'], $source['id']];
        }
        
        return $ids;
    }
    
    
    
}