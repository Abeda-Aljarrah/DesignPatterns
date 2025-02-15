<?php

namespace SortingGame\Strategies;

require_once "SortingInterface.php";

class ConcreteSortingAlphabetical implements SortingInterface 
{
    public function checkSorting(array $items): bool
    {
        $sortedItems = $items;
        usort($sortedItems, fn($a, $b) => $a['name'] <=> $b['name']);

        return $items === $sortedItems;
    }
}
