<?php

namespace SortingGame\Strategies;

require_once "SortingInterface.php";

class ConcreteSortingLength implements SortingInterface 
{
    public function checkSorting(array $items): bool
    {
        $sortedItems = $items;
        usort($sortedItems, fn($a, $b) => strlen($a['name']) <=> strlen($b['name']));

        return $items === $sortedItems;
    }
}
