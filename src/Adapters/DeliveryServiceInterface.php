<?php

namespace TestDeliveryTask\Adapters;

use TestDeliveryTask\Common\Position;
use TestDeliveryTask\Common\CalculatingResult;
use TestDeliveryTask\Common\ServiceCalculatingException;

interface DeliveryServiceInterface
{
    /**
     * @param string $sender address of sender
     * @param string $receiver address of receiver
     * @param Position[] $list list of positions
     * @return CalculatingResult
     * @throws ServiceCalculatingException
     */
    public function calculate(string $sender,string $receiver, array $list) : CalculatingResult;
}