<?php

namespace TestDeliveryTask\Adapters;

use TestDeliveryTask\Common\Position;
use TestDeliveryTask\Common\ServiceCalculatingException;
use External\TurtleDelivery\Turtle as TurtleService;
use TestDeliveryTask\Common\CalculatingResult;

class Turtle implements DeliveryServiceInterface
{
    const BASE_PRICE = 150;

    protected $service;

    public function __construct()
    {
        $this->service = new TurtleService();
    }

    /**
     * @param string $sender address of sender
     * @param string $receiver address of receiver
     * @param Position[] $list list of positions
     * @return CalculatingResult
     * @throws ServiceCalculatingException
     */
    public function calculate(string $sender, string $receiver, array $list): CalculatingResult
    {
        $prepared_list = [];
        //TODO: подготовить список
        try {
            $result = $this->service->calculate($sender, $receiver, $prepared_list);
            return new CalculatingResult($this->calculateCost($result->multiplier), $result->date);
        } catch (\Throwable $e) {
            //возможно логирование, проброс
            throw new ServiceCalculatingException();
        }
    }

    protected function calculateCost($multiplier)
    {
        return self::BASE_PRICE * $multiplier;
    }
}