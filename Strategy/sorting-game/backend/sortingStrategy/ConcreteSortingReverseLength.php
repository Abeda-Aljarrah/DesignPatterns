<?php

namespace SortingGame\Strategies;

require_once "SortingInterface.php";

class ConcreteSortingReverseLength implements SortingInterface 
{
    public function checkSorting(array $items): bool
    {
        $sortedItems = $items;
        usort($sortedItems, fn($a, $b) => strlen($b['name']) <=> strlen($a['name']));

        return $items === $sortedItems;
    }
}
