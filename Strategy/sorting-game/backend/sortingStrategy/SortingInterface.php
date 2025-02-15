<?php

namespace SortingGame\Strategies;

interface SortingInterface 
{
    public function checkSorting(array $items): bool;
}