<?php
namespace Counter\Element;
use Interfaces\CounterElementrInterface;

class UrlsCounter implements CounterElementrInterface {
    /**
     * @var array
     */
    private $urlList = array();

    /**
     * @param $url
     */
    public function addValue($url) {
        if (!in_array($url, $this->urlList)) {
            $this->urlList[] = $url;
        }
    }

    /**
     * @return array
     */
    public function getResult() : array {
        return array('urls' => count($this->urlList));
    }
}