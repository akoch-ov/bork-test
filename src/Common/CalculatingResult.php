<?php

namespace TestDeliveryTask\Common;

/**
 * @property int $cost
 * @property string $date
 */
class CalculatingResult
{
    public $cost;
    public $date;

    public function __construct(int $cost = null, $date = null)
    {
        $this->cost = $cost;
        $this->date = $date;
    }
}