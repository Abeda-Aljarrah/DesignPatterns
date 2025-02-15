<?php

namespace SortingGame\Strategies;

require_once "SortingInterface.php";

class ConcreteSortingReverseAlphabetical implements SortingInterface 
{
    public function checkSorting(array $items): bool
    {
        $sortedItems = $items;
        usort($sortedItems, fn($a, $b) => $b['name'] <=> $a['name']);

        return $items === $sortedItems;
    }
}
