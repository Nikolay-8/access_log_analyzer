<?php
namespace Counter\Element;
use Interfaces\CounterElementrInterface;

class StatusCodesCounter implements CounterElementrInterface {
    /**
     * @var array
     */
    private $statuses = array();

    /**
     * @param $statusCode
     */
    public function addValue($statusCode) {
        $this->statuses[$statusCode] = isset($this->statuses[$statusCode])
            ? ++$this->statuses[$statusCode]
            : 1;
    }

    /**
     * @return array
     */
    public function getResult() : array {
        return array('statusCodes' => $this->statuses);
    }
}