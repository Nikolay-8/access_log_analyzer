<?php
namespace Counter\Element;
use Interfaces\CounterElementrInterface;

class ViewsCounter implements CounterElementrInterface {
    /**
     * @var int
     */
    private $views = 0;

    /**
     * @param $views
     */
    public function addValue($views) {
        $this->views += $views;
    }

    /**
     * @return array
     */
    public function getResult() : array {
        return array('views' => $this->views);
    }
}