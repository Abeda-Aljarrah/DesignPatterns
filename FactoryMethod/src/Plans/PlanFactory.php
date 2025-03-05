<?php

namespace FactoryMethod\Plans;

use FactoryMethod\Periods\Period;

abstract class PlanFactory
{
    abstract public function getPeriod(int $period_id, $start_date): Period;

}