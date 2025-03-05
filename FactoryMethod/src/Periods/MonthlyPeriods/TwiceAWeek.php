<?php

namespace FactoryMethod\Periods\MonthlyPeriods;

use FactoryMethod\Periods\Period;
use DateTime;

class TwiceAWeek implements Period
{
    private string $start_date;
    private float $plan_fees;

    public function __construct(string $start_date, float $plan_fees)
    {
        $this->start_date = $start_date;
        $this->plan_fees = $plan_fees;
    }


    public function calculatePrice(): float
    {
        return $this->plan_fees + 40.00;
    }

    public function nextDeliveryDate(): string
    {
        $date = new DateTime($this->start_date);
        $date->modify('+3 days'); // Add 3 days to represent "Twice a Week" 
        return $date->format('Y-m-d'); 
    }
}
