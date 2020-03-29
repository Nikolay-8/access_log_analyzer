<?php
namespace Counter;

use Interfaces;
use Counter\Element;

class CounterManager implements Interfaces\CounterInterface {
    /**
     * @var Interfaces\ParserInterface
     */
    private $parser = null;

    /**
     * @var Interfaces\CounterElementrInterface
     */
    private $viewsCounter = null;

    /**
     * @var Interfaces\CounterElementrInterface
     */
    private $trafficCounter = null;

    /**
     * @var Interfaces\CounterElementrInterface
     */
    private $urlsCounter = null;

    /**
     * @var Interfaces\CounterElementrInterface
     */
    private $crawlersCounter = null;

    /**
     * @var Interfaces\CounterElementrInterface
     */
    private $statusCodesCounter = null;

    /**
     * @var array
     */
    private $paramsForParser = array(
        'views' => '(.*[^\s])',
        'url'   => '(\s/.* HTTP)',
        'traffic' => '(200 \d+)',
        'client_info' => '("[^"]{0,}"$)',
        'status_code' => '(\s\d{3}\s)'
    );

    /**
     * @return array
     */
    public function paramsForParser() {
        return $this->paramsForParser;
    }

    public function init() {
        $this->viewsCounter = new Element\ViewsCounter();
        $this->trafficCounter = new Element\TrafficCounter();
        $this->urlsCounter = new Element\UrlsCounter();
        $this->crawlersCounter = new Element\CrawlersCounter();
        $this->statusCodesCounter = new Element\StatusCodesCounter();
    }

    /**
     * @param Interfaces\ParserInterface $parser
     */
    public function setParser(Interfaces\ParserInterface $parser) {
        $parser->setParams($this->paramsForParser());
        $this->parser = $parser;
    }

    /**
     * @return Interfaces\ParserInterface
     */
    public function getParser() {
        return $this->parser;
    }

    /**
     * @param string $logLine
     */
    public function calculateLogLine($logLine) {
        $parsedForLine = $this->getParser()->parseLogLine($logLine);
        $parsedData = $this->prepareParsedData($parsedForLine);

        $this->viewsCounter->addValue($parsedData['views']);
        $this->urlsCounter->addValue($parsedData['url']);
        $this->trafficCounter->addValue($parsedData['traffic']);
        $this->statusCodesCounter->addValue($parsedData['status_code']);
        $this->crawlersCounter->addValue($parsedData['client_info']);
    }

    /**
     * @return array
     */
    public function getResult() : array {
        $result = array();
        $result[] = $this->viewsCounter->getResult();
        $result[] = $this->urlsCounter->getResult();
        $result[] = $this->trafficCounter->getResult();
        $result[] = $this->statusCodesCounter->getResult();
        $result[] = $this->crawlersCounter->getResult();

        return $result;
    }

    /**
     * @param array $parsedForLine
     * @return array
     */
    private function prepareParsedData(array $parsedForLine) : array {
        $result = array();
        $result['views'] = is_null($parsedForLine['views']) ? 0 : 1;

        $url = str_replace(" HTTP", "", $parsedForLine['url']);
        $result['url'] = trim($url);

        $traffic = isset ($parsedForLine['traffic'])
            ? str_replace("200 ", "", $parsedForLine['traffic'])
            : 0;
        $result['traffic'] = (int) $traffic;

        $result['client_info'] = $parsedForLine['client_info'];

        $statusCode = trim($parsedForLine['status_code']);
        $statusCode = (int) $statusCode;
        $result['status_code'] = $statusCode;

        return $result;
    }
}