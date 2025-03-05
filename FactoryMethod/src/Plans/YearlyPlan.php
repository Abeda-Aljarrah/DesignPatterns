<?php

namespace FactoryMethod\Plans;

use FactoryMethod\Periods\YearlyPeriods\OnceAMonth;
use FactoryMethod\Periods\YearlyPeriods\OnceTwoMonths;
use FactoryMethod\Periods\YearlyPeriods\TwiceAMonth;
use FactoryMethod\Periods\Period;

use FactoryMethod\Plans\PlanFactory;

class YearlyPlan extends PlanFactory
{
    // Map the period_id to class names
    public array $yearlyPeriods = [
        4 => OnceAMonth::class,
        6 => TwiceAMonth::class,
        5 => OnceTwoMonths::class
    ];

    const QUARTER_FEES = 20; 

    public function getPeriod(int $period_id, $start_date): Period
    {
        
        if (isset($this->yearlyPeriods[$period_id])) {
            // Get the class name based on the period_id
            $periodClass = $this->yearlyPeriods[$period_id];
            
            // Dynamically instantiate the correct period class
            return new $periodClass($start_date, self::QUARTER_FEES);
        }

        throw new \Exception('The requested period does not exist');
    }
}
