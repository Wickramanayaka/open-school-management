<?php

namespace App;

/**
 * 
 */
trait FullTextSearch
{
    protected function fullTextWildcards($term){
        $reservedSymbols = ['-','+','<','>','@','(',')','~'];
        $term = str_replace($reservedSymbols,'',$term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            if(strlen($word) >= 3){
                $word[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode(' ', $words);
        return $searchTerm;
    }

    public function scopeSearch($query, $term)
    {
        $columns = implode(',', $this->searchable);

        $searchableTerm = $this->fullTextWildcards($term);

        return $query->selectRaw("*,MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$searchableTerm])
        ->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)" , $searchableTerm)
        ->orderByDesc('relevance_score');

    }
}