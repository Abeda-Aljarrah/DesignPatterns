<?php

namespace FactoryMethod\Periods\YearlyPeriods;

use FactoryMethod\Periods\Period;
use DateTime;

class OnceTwoMonths implements Period
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
        return $this->plan_fees + 10.00; 
    }

    public function nextDeliveryDate(): string
    {
        $date = new DateTime($this->start_date);
        $date->modify('+60 days'); // Add 60 days to represent "Once Every Two Months"
        return $date->format('Y-m-d'); 
    }
}
