<?php
namespace Counter\Element;
use Interfaces\CounterElementrInterface;

class TrafficCounter implements CounterElementrInterface {
    /**
     * @var int
     */
    private $trafficTotal = 0;

    /**
     * @param $traffic
     */
    public function addValue($traffic) {
        $this->trafficTotal += $traffic;
    }

    /**
     * @return array
     */
    public function getResult() : array {
        return array('traffic' => $this->trafficTotal);
    }
}