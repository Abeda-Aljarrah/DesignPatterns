<?php

namespace FactoryMethod\Plans;

use FactoryMethod\Periods\QuarterPeriods\OnceAWeek;
use FactoryMethod\Periods\QuarterPeriods\OnceAMonth;
use FactoryMethod\Periods\QuarterPeriods\TwiceAMonth;
use FactoryMethod\Periods\Period;

use DateTime;

use FactoryMethod\Plans\PlanFactory;

class QuarterPlan extends PlanFactory
{
    // Map the period_id to class names
    public array $quarterPeriods = [
        8 => OnceAWeek::class,
        7 => OnceAMonth::class,
        9 => TwiceAMonth::class
    ];

    const QUARTER_FEES = 10; 

    public function getPeriod(int $period_id, $start_date): Period
    {
        
        if (isset($this->quarterPeriods[$period_id])) {
            // Get the class name based on the period_id
            $periodClass = $this->quarterPeriods[$period_id];
            
            // Dynamically instantiate the correct period class
            return new $periodClass($start_date, self::QUARTER_FEES);
        }

        throw new \Exception('The requested period does not exist');
    }

    public function setEndDate($start_date): string
    {
        $date = new DateTime($start_date);
        $date->modify('+90 days');
        return $date->format('Y-m-d');
    }
}
