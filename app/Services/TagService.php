<?php

namespace App\Services;

class TagService 
{

    public function getTags() {
        
        
        $tags = Tag::pluck('name', 'id');
        return $tags;
        
    }

}
