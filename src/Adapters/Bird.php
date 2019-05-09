<?php

namespace TestDeliveryTask\Adapters;

use TestDeliveryTask\Common\Position;
use TestDeliveryTask\Common\ServiceCalculatingException;
use External\BirdDelivery\Bird as BirdService;
use TestDeliveryTask\Common\CalculatingResult;

class Bird implements DeliveryServiceInterface
{
    protected $service;

    public function __construct()
    {
        $this->service = new BirdService();
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
        foreach ($list as $item) {
            for($i = 1;  $i <= $item->count; $i++) $prepared_list[] = [
                'weight' => $item->weight,
                'size' => $item->size
            ];
        }
        try {
            $result = $this->service->calculate($sender, $receiver, $prepared_list);
            //обработать результат и обернуть в объект CalculatingResult
            $result = json_decode($result);
            $result = new CalculatingResult($result->cost, $this->calculateDate($result->days));
            return $result;
        } catch (\Throwable $e) {
            //возможно логирование, проброс
            throw new ServiceCalculatingException();
        }
    }

    protected function calculateDate($days)
    {
        return date("d.m.Y", strtotime("+$days days"));
    }
}