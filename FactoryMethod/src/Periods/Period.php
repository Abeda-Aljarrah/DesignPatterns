<?php

namespace FactoryMethod\Periods;

interface Period
{
    public function calculatePrice(): float;

    public function nextDeliveryDate(): string;
}
