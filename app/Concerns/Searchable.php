<?php

namespace App\Concerns;

trait Searchable
{
    protected static $hasSearchableTrait = true;

    public function getSearchable()
    {
        return $this->searchable;
    }

    public function searchable(array $search)
    {
        return array_intersect_key($search, $this->getSearchable());
    }

    public function getTables(array $search)
    {
        return array_intersect_key($this->getSearchable(), $search);
    }

    public function isSearchable($key)
    {
        return array_key_exists($key, $this->getSearchable());
    }
}
