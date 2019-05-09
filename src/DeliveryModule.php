<?php

namespace TestDeliveryTask;

use TestDeliveryTask\Adapters\DeliveryServiceInterface;
use TestDeliveryTask\Common\CalculatingResult;
use TestDeliveryTask\Common\DeliveryCommonException;
use TestDeliveryTask\Common\Position;
use TestDeliveryTask\Common\ServiceCalculatingException;
use TestDeliveryTask\Common\ServiceDoesNotExistException;

class DeliveryModule
{
    private static $instance = null;
    /** @var DeliveryServiceInterface[] */
    protected $delivery_services = [];

    /**
     * @return DeliveryModule
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

    private function __clone() {}
    private function __construct() {}

    protected function loadConfig()
    {
        //loading config (hardcode)
        return [
            'Bird' => \TestDeliveryTask\Adapters\Bird::class,
            'Turtle' => \TestDeliveryTask\Adapters\Turtle::class,
        ];
    }

    protected function init()
    {
        foreach ($this->loadConfig() as $service => $class)
            $this->delivery_services[$service] = new $class;
    }

    /**
     * @return string[]
     */
    public function getAvailableServices()
    {
        return array_keys($this->delivery_services);
    }

    /**
     * @param string $sender address of sender
     * @param string $receiver address of receiver
     * @param Position[] $list list of positions
     * @return CalculatingResult[]
     */
    public function calculate(string $sender, string $receiver, array $list)
    {
        $result = [];
        foreach ($this->delivery_services as $name => $service) {
            try {
                $result[$name] = $service->calculate($sender, $receiver, $list);
            } catch (ServiceCalculatingException $e) {
                // Возможно логировать
            }
        }

        return $result;
    }

    /**
     * @param string $service name of delivery service
     * @param string $sender address of sender
     * @param string $receiver address of receiver
     * @param Position[] $list list of positions
     * @return CalculatingResult
     * @throws DeliveryCommonException
     */
    public function calculateBy(string $service, string $sender, string $receiver, array $list) : CalculatingResult
    {
        if (in_array($service, $this->getAvailableServices())) throw new ServiceDoesNotExistException;
        return $this->delivery_services[$service]->calculate($sender, $receiver, $list);
    }
}