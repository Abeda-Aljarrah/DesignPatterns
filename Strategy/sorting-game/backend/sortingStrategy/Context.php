<?php

namespace SortingGame\Strategies;

require_once "SortingInterface.php";

class Context 
{
    private SortingInterface $sortingMethod;

    public function __construct(SortingInterface $sortingMethod) 
    {
        $this->sortingMethod = $sortingMethod;
    }

    public function checkSorting(array $items): bool 
    {
        return $this->sortingMethod->checkSorting($items);
    }
}
