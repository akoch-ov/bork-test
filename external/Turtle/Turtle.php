<?php

namespace External\TurtleDelivery;


class Turtle
{

    public function calculate($sender, $receiver, $list)
    {
        $obj = new \stdClass();
        $obj->multiplier = 1.7;
        $obj->date = '17.05.2019';
        return $obj;
    }
}