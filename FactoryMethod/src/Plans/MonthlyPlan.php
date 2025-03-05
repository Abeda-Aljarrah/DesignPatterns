<?php

namespace FactoryMethod\Plans;

use FactoryMethod\Periods\MonthlyPeriods\OnceAWeek;
use FactoryMethod\Periods\MonthlyPeriods\TwiceAMonth;
use FactoryMethod\Periods\MonthlyPeriods\TwiceAWeek;
use FactoryMethod\Periods\Period;

use FactoryMethod\Plans\PlanFactory;

class MonthlyPlan extends PlanFactory
{
    // Map period_id to class names
    public array $monthlyPeriods = [
        1 => OnceAWeek::class,
        2 => TwiceAWeek::class,
        3 => TwiceAMonth::class,
    ];

    const MONTHLY_FEES = 10; 

    public function getPeriod(int $period_id, $start_date): Period
    {

        if (isset($this->monthlyPeriods[$period_id])) {
            // Get the class name based on the period_id
            $periodClass = $this->monthlyPeriods[$period_id];
            
            // Dynamically instantiate the correct period class
            return new $periodClass($start_date, self::MONTHLY_FEES);
        }

        throw new \Exception('The requested period does not exist');
    }
}
