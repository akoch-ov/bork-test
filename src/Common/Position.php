<?php

namespace TestDeliveryTask\Common;

/**
 * @property float $weight
 * @property string $size
 * @property int $count
 */
class Position
{
    public $weight;
    public $size;
    public $count;

    public function __construct($weight, $size, $count)
    {
        $this->weight = $weight;
        $this->size = $size;
        $this->count = $count;
    }
}