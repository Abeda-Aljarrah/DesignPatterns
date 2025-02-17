<?php

namespace SortingGame\Strategies;

require_once "SortingInterface.php";

class ConcreteSortingCategory implements SortingInterface 
{
    public function checkSorting(array $items): bool
    {
        $sortedItems = $items;
        usort($sortedItems, fn($a, $b) => $a['category'] <=> $b['category']);

        return $items === $sortedItems;
    }
}
