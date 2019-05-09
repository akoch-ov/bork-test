<?php

namespace TestDeliveryTask\Common;

class ServiceCalculatingException extends DeliveryCommonException
{

    public function __construct()
    {
        parent::__construct('The requested service does not exist.');
    }
}