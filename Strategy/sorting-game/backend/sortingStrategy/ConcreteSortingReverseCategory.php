<?php

namespace SortingGame\Strategies;

require_once "SortingInterface.php";

class ConcreteSortingReverseCategory implements SortingInterface 
{
    public function checkSorting(array $items): bool
    {
        $sortedItems = $items;
        usort($sortedItems, fn($a, $b) => $b['category'] <=> $a['category']);

        return $items === $sortedItems;
    }
}
