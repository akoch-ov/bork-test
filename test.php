<?php

require __DIR__ . '/vendor/autoload.php';

$module = \TestDeliveryTask\DeliveryModule::getInstance();

$positions = [];
$positions[] = new \TestDeliveryTask\Common\Position(55, '5x10x15', 3);
$positions[] = new \TestDeliveryTask\Common\Position(22, '3x8x7', 1);

var_dump($module->calculate('addr1', 'addr2', $positions));